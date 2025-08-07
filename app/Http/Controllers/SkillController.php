<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\Exchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SkillController extends Controller
{
    /**
     * Show skill details and initiate exchange
     */
    public function showSkill($id)
    {
        $id = Crypt::decrypt($id);
        $skill = Skill::with(['user', 'reviews.reviewer', 'user.skills'])
            ->findOrFail($id);

        // Get user's skills for potential exchange
        $userSkills = Auth::user()->skills;

        // Check if user already has an exchange with this skill owner
        $existingExchange = Exchange::where(function($query) use ($skill) {
            $query->where('initiator_id', Auth::id())
                  ->where('participant_id', $skill->user_id)
                  ->orWhere('initiator_id', $skill->user_id)
                  ->where('participant_id', Auth::id());
        })->whereIn('status', ['pending', 'in_progress'])->first();

        return view('user-side.exchanges.skill-details', compact('skill', 'userSkills', 'existingExchange'));
    }
}
