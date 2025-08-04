<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;
use App\Services\AvatarService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $avatarService;

    /**
     * Constructor to inject dependencies and apply middleware.
     */
  

    /**
     * Display the user's profile.
     */
    public function show()
    {
        $user = Auth::user();
        $skills = $user->skills()->get();
        $exchanges = $user->exchanges()->with(['skill', 'partner'])->latest()->get();
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
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        try {
            if ($request->hasFile('avatar')) {
                // Delete old avatar
                $this->avatarService->deleteOldAvatar($user->avatar);

                // Upload new avatar
                $path = $this->avatarService->uploadAvatar($request->file('avatar'));

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
        } catch (\Exception $e) {
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
            'level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
            'description' => 'nullable|string|max:1000',
        ]);

        $skill = Auth::user()->skills()->create([
            'name' => $request->name,
            'level' => $request->level,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'skill' => $skill,
        ]);
    }

    /**
     * Update an existing skill.
     */
    public function updateSkill(Request $request, Skill $skill)
    {
        $this->authorize('update', $skill);

        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|in:Beginner,Intermediate,Advanced,Expert',
            'description' => 'nullable|string|max:1000',
        ]);

        $skill->update($request->only(['name', 'level', 'description']));

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
        $this->authorize('delete', $skill);
        $skill->delete();

        return response()->json([
            'success' => true,
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