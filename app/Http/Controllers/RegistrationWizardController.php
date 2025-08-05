<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Services\AvatarService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationWizardController extends Controller
{
    protected $avatarService;

    public function __construct(AvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }
    /**
     * Show the first step of registration (personal info)
     */
    public function showStep1()
    {
        return view('auth.wizard.step1');
    }

    /**
     * Store personal info and show step 2
     */
    public function storeStep1(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'username' => 'required|string|max:255|unique:users|regex:/^[a-zA-Z0-9_]+$/',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ], [
            'username.regex' => 'Username can only contain letters, numbers, and underscores.',
            'username.unique' => 'This username is already taken.',
            'email.unique' => 'This email is already registered.',
            'avatar.image' => 'Avatar must be an image file.',
            'avatar.mimes' => 'Avatar must be a JPEG or PNG image.',
            'avatar.max' => 'Avatar file size must be less than 3MB.',
        ]);

        $step1Data = $request->only(['name', 'email', 'password', 'username', 'phone', 'location', 'bio']);

        // Handle avatar upload if provided
        if ($request->hasFile('avatar')) {
            try {
                // Validate avatar using service
                $validationErrors = $this->avatarService->validateAvatar($request->file('avatar'));
                if (!empty($validationErrors)) {
                    return back()->withErrors(['avatar' => implode(' ', $validationErrors)])->withInput();
                }

                // Upload avatar
                $avatarPath = $this->avatarService->uploadAvatar($request->file('avatar'));
                $step1Data['avatar'] = $avatarPath;
            } catch (\Exception $e) {
                return back()->withErrors(['avatar' => 'Failed to upload avatar. Please try again.'])->withInput();
            }
        }

        // Store in session for now
        $request->session()->put('registration_data', [
            'step1' => $step1Data
        ]);

        return redirect()->route('register.step2');
    }

    /**
     * Show the second step (education)
     */
    public function showStep2(Request $request)
    {
        if (!$request->session()->has('registration_data.step1')) {
            return redirect()->route('register.step1');
        }

        return view('auth.wizard.step2');
    }

    /**
     * Store education info and show step 3
     */
    public function storeStep2(Request $request)
    {
        $request->validate([
            'education_level' => 'required|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            'institution' => 'nullable|string|max:255',
            'graduation_year' => 'nullable|integer|min:1950|max:' . (date('Y') + 10),
            'certifications' => 'nullable|array',
            'certifications.*' => 'string|max:255',
        ]);

        $registrationData = $request->session()->get('registration_data', []);
        $registrationData['step2'] = $request->only(['education_level', 'field_of_study', 'institution', 'graduation_year', 'certifications']);
        $request->session()->put('registration_data', $registrationData);

        return redirect()->route('register.step3');
    }

    /**
     * Show the third step (experience)
     */
    public function showStep3(Request $request)
    {
        if (!$request->session()->has('registration_data.step1') || !$request->session()->has('registration_data.step2')) {
            return redirect()->route('register.step1');
        }

        return view('auth.wizard.step3');
    }

    /**
     * Store experience info and show step 4
     */
    public function storeStep3(Request $request)
    {
        $request->validate([
            'years_of_experience' => 'required|integer|min:0|max:50',
            'current_role' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'website' => 'nullable|url|max:255',
        ]);

        $registrationData = $request->session()->get('registration_data', []);
        $registrationData['step3'] = $request->only(['years_of_experience', 'current_role', 'company', 'portfolio_url', 'linkedin', 'github', 'website']);
        $request->session()->put('registration_data', $registrationData);

        return redirect()->route('register.step4');
    }

    /**
     * Show the fourth step (skills)
     */
    public function showStep4(Request $request)
    {
        if (!$request->session()->has('registration_data.step1') || 
            !$request->session()->has('registration_data.step2') || 
            !$request->session()->has('registration_data.step3')) {
            return redirect()->route('register.step1');
        }

        return view('auth.wizard.step4');
    }

    /**
     * Store skills and complete registration
     */
    public function storeStep4(Request $request)
    {
        $request->validate([
            'skills' => 'required|array|min:1|max:10',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.category' => 'required|string|max:255',
            'skills.*.level' => 'required|in:beginner,intermediate,advanced,expert',
            'skills.*.description' => 'nullable|string|max:1000',
            'skills.*.experience_years' => 'nullable|integer|min:0|max:50',
        ], [
            'skills.min' => 'You must add at least one skill.',
            'skills.max' => 'You can add a maximum of 10 skills.',
        ]);

        $registrationData = $request->session()->get('registration_data', []);
        $registrationData['step4'] = $request->only(['skills']);
        $request->session()->put('registration_data', $registrationData);

        try {
            DB::beginTransaction();

            // Create the user
            $userData = $registrationData['step1'];
            $userData['password'] = Hash::make($userData['password']);
            $userData['member_since'] = now();
            $userData['last_active'] = now();

            // Merge additional data from other steps
            $userData['bio'] = $userData['bio'] ?? '';
            $userData['location'] = $userData['location'] ?? '';
            $userData['phone'] = $userData['phone'] ?? '';
            $userData['avatar'] = $userData['avatar'] ?? null;
            $userData['website'] = $registrationData['step3']['website'] ?? '';
            $userData['linkedin'] = $registrationData['step3']['linkedin'] ?? '';
            $userData['github'] = $registrationData['step3']['github'] ?? '';

            $user = User::create($userData);

            // Create skills
            foreach ($registrationData['step4']['skills'] as $skillData) {
                $skillData['user_id'] = $user->id;
                $skillData['experience_years'] = $skillData['experience_years'] ?? 0;
                Skill::create($skillData);
            }

            DB::commit();

            // Clear session data
            $request->session()->forget('registration_data');

            // Log in the user
            Auth::login($user);

            // Automatically send OTP for email verification
            $this->sendWelcomeOtp($user);

            return redirect()->route('verification.notice')->with('success', 'Welcome to SkillSwap! Please verify your email to complete your registration.');

        } catch (\Exception $e) {
            DB::rollback();
            
            return back()->withErrors(['error' => 'Registration failed. Please try again.'])->withInput();
        }
    }

    /**
     * Send welcome OTP to newly registered user
     */
    private function sendWelcomeOtp($user)
    {
        // Generate 4-digit OTP
        $otp = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        
        // Store OTP in session with expiration (10 minutes)
        Session::put('otp', [
            'code' => $otp,
            'expires_at' => now()->addMinutes(10),
            'attempts' => 0
        ]);

        // Send OTP email
        try {
            Mail::send('emails.otp', ['otp' => $otp, 'user' => $user], function ($message) use ($user) {
                $message->to($user->email, $user->name)
                        ->subject('Welcome to SkillSwap - Verify Your Email');
            });
        } catch (\Exception $e) {
            // Log error but don't fail registration
            Log::error('Failed to send welcome OTP: ' . $e->getMessage());
        }
    }

    /**
     * Go back to previous step
     */
    public function goBack(Request $request, $step)
    {
        $currentStep = (int) $step;
        $previousStep = $currentStep - 1;

        if ($previousStep >= 1) {
            return redirect()->route("register.step{$previousStep}");
        }

        return redirect()->route('register.step1');
    }
}
