<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Services\AvatarService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    protected $avatarService;

    /**
     * Constructor to inject dependencies and apply middleware.
     */
    public function __construct(AvatarService $avatarService)
    {
        $this->avatarService = $avatarService;
    }

    /**
     * Display the user's profile.
     */
    public function show()
    {
        
        $user = Auth::user();
        $skills = $user->skills()->get();
        $initiatedExchanges = $user->initiatedExchanges()->with(['initiatorSkill', 'participant'])->latest()->get();
        $participatedExchanges = $user->participatedExchanges()->with(['participantSkill', 'initiator'])->latest()->get();
        $exchanges = $initiatedExchanges->merge($participatedExchanges)->sortByDesc('created_at');
        $reviews = $user->receivedReviews()->with('reviewer')->latest()->get();
        $portfolioItems = $user->portfolioItems()->latest()->get();
      

        return view('user-side.profile', compact('user', 'skills', 'exchanges', 'reviews', 'portfolioItems'));
    }

    /**
     * Display any user's profile by username.
     */
    public function showPublic(User $user)
    {
        $skills = $user->skills()->get();
        $initiatedExchanges = $user->initiatedExchanges()->with(['initiatorSkill', 'participant'])->latest()->get();
        $participatedExchanges = $user->participatedExchanges()->with(['participantSkill', 'initiator'])->latest()->get();
        $exchanges = $initiatedExchanges->merge($participatedExchanges)->sortByDesc('created_at');
        $reviews = $user->receivedReviews()->with('reviewer')->latest()->get();
        $portfolioItems = $user->portfolioItems()->latest()->get();
        return view('user-side.profile', compact('user', 'skills', 'exchanges', 'reviews', 'portfolioItems'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('user-side.profile-edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'bio' => 'nullable|string|max:1000',
            'location' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only([
            'name',
            'username',
            'email',
            'bio',
            'location',
            'phone',
            'website',
            'linkedin',
            'github',
            'twitter'
        ]));

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request)
    {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg|max:3072',
            ]);

            $user = Auth::user();

            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                
                // Validate avatar using service
                $validationErrors = $this->avatarService->validateAvatar($file);
                if (!empty($validationErrors)) {
                    return response()->json([
                        'success' => false,
                        'message' => implode(' ', $validationErrors),
                    ], 400);
                }

                // Delete old avatar if exists
                if ($user->avatar) {
                    $this->avatarService->deleteOldAvatar($user->avatar);
                }

                // Upload new avatar
                $path = $this->avatarService->uploadAvatar($file);

                // Update user record
                $user->avatar = $path;
                $user->save();

                return response()->json([
                    'success' => true,
                    'avatar_url' => asset('storage/' . $path),
                    'message' => 'Avatar updated successfully!',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No avatar file provided.',
            ], 400);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Avatar upload failed: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'file_info' => $request->hasFile('avatar') ? [
                    'name' => $request->file('avatar')->getClientOriginalName(),
                    'size' => $request->file('avatar')->getSize(),
                    'mime' => $request->file('avatar')->getMimeType(),
                ] : 'No file'
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to update avatar: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Add a new skill to the user's profile.
     */
    public function addSkill(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
            'description' => 'nullable|string|max:1000',
            'experience_years' => 'nullable|integer|min:0|max:50',
        ]);
    
        $skill = Auth::user()->skills()->create([
            'name' => $request->name,
            'category' => $request->category,
            'level' => ucfirst($request->level),
            'description' => $request->description,
            'experience_years' => $request->experience_years,
        ]);
    
        return redirect()->back()->with('success', 'Skill added successfully!');
    }
    
    


    /**
     * Update an existing skill.
     */
    public function updateSkill(Request $request, Skill $skill)
    {
        // Ensure the skill belongs to the authenticated user
        if ($skill->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own skills.'
            ], 403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'level' => 'required|in:beginner,intermediate,advanced,expert',
            'description' => 'nullable|string|max:1000',
            'experience_years' => 'nullable|integer|min:0|max:50',
            'hourly_rate' => 'nullable|numeric|min:0',
        ]);

        $skill->update([
            'name' => $request->name,
            'category' => $request->category,
            'level' => $request->level,
            'description' => $request->description,
            'experience_years' => $request->experience_years,
            'hourly_rate' => $request->hourly_rate,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Skill updated successfully!',
            'skill' => $skill,
        ]);
    }

    /**
     * Get skill data for editing.
     */
    public function editSkill(Skill $skill)
    {
        // Ensure the skill belongs to the authenticated user
        if ($skill->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You can only edit your own skills.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'skill' => $skill,
        ]);
    }

    /**
     * Delete a skill.
     */
    public function deleteSkill(Skill $skill)
    {
        // Ensure the skill belongs to the authenticated user
        if ($skill->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You can only delete your own skills.'
            ], 403);
        }

        $skill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Skill deleted successfully!',
        ]);
    }

    /**
     * Add a portfolio item.
     */
    public function addPortfolioItem(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('portfolio', 'public');

        $portfolioItem = Auth::user()->portfolioItems()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
        ]);

        return response()->json([
            'success' => true,
            'item' => $portfolioItem,
        ]);
    }

    /**
     * Delete a portfolio item.
     */
    public function deletePortfolioItem($id)
    {
        $item = Auth::user()->portfolioItems()->findOrFail($id);

        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}