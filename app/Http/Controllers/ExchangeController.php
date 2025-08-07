<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Skill;
use App\Models\User;
use App\Models\Message;
use App\Notifications\NewExchangeProposalNotification;
use App\Notifications\ExchangeProposalStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class ExchangeController extends Controller
{
    /**
     * Display the skill discovery page
     */
    public function index(Request $request)
    {
        $query = Skill::with(['user', 'reviews'])
            ->where('user_id', '!=', Auth::id())
            ->where('is_verified', true);

        // Enhanced search functionality
        if ($request->filled('looking_for') || $request->filled('will_offer')) {
            $lookingFor = $request->looking_for;
            $willOffer = $request->will_offer;
            
            // Search for skills that match what user is looking for
            if ($lookingFor) {
                $query->where(function($q) use ($lookingFor) {
                    $q->where('name', 'like', "%{$lookingFor}%")
                      ->orWhere('category', 'like', "%{$lookingFor}%")
                      ->orWhere('description', 'like', "%{$lookingFor}%");
                });
            }
            
            // If user specified what they will offer, find users who might want that skill
            if ($willOffer) {
                $query->whereHas('user.skills', function($q) use ($willOffer) {
                    $q->where('name', 'like', "%{$willOffer}%")
                      ->orWhere('category', 'like', "%{$willOffer}%")
                      ->orWhere('description', 'like', "%{$willOffer}%");
                });
            }
        } else {
            // Fallback to regular search
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
                });
            }
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('location', 'like', "%{$request->location}%");
            });
        }

        // Filter by hourly rate range
        if ($request->filled('min_rate') || $request->filled('max_rate')) {
            $minRate = $request->min_rate ?: 0;
            $maxRate = $request->max_rate ?: 999999;
            $query->whereBetween('hourly_rate', [$minRate, $maxRate]);
        }

        // Sort options
        $sortBy = $request->get('sort', 'featured');
        switch ($sortBy) {
            case 'rating':
                $query->orderBy(DB::raw('(SELECT AVG(rating) FROM reviews WHERE skill_id = skills.id)'), 'desc');
                break;
            case 'price_low':
                $query->orderBy('hourly_rate', 'asc');
                break;
            case 'price_high':
                $query->orderBy('hourly_rate', 'desc');
                break;
            case 'recent':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->orderBy('is_featured', 'desc')
                      ->orderBy('created_at', 'desc');
        }

        $skills = $query->paginate(12);

        // Get user's skills for matching
        $userSkills = Auth::user()->skills;

        // Get categories for filter
        $categories = Skill::distinct()->pluck('category')->filter();

        return view('user-side.exchanges.discover', compact('skills', 'userSkills', 'categories'));
    }

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

    /**
     * Show exchange creation form
     */
    public function create(Request $request)
    {
        $targetSkillId = $request->skill_id;
        $targetSkill = null;
        $userSkills = Auth::user()->skills;

        if ($targetSkillId) {
            $targetSkill = Skill::with('user')->find($targetSkillId);
        }

        return view('user-side.exchanges.create', compact('targetSkill', 'userSkills'));
    }

    /**
     * Store new exchange
     */
    public function store(Request $request)
    {
        $request->validate([
            'participant_skill_id' => 'required|exists:skills,id',
            'initiator_skill_id' => 'required|exists:skills,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'estimated_hours' => 'nullable|integer|min:1|max:200',
            'terms' => 'nullable|array',
            'communication_preference' => 'nullable|string|in:chat,video,email,phone',
        ]);

        // Get the target skill to find the participant
        $participantSkill = Skill::findOrFail($request->participant_skill_id);
        $initiatorSkill = Skill::findOrFail($request->initiator_skill_id);

        // Ensure user owns the initiator skill
        if ($initiatorSkill->user_id !== Auth::id()) {
            return back()->withErrors(['initiator_skill_id' => 'You can only offer your own skills.']);
        }

        // Ensure user doesn't own the participant skill
        if ($participantSkill->user_id === Auth::id()) {
            return back()->withErrors(['participant_skill_id' => 'You cannot exchange with yourself.']);
        }

        // Check for existing exchange
        $existingExchange = Exchange::where(function($query) use ($participantSkill) {
            $query->where('initiator_id', Auth::id())
                  ->where('participant_id', $participantSkill->user_id)
                  ->orWhere('initiator_id', $participantSkill->user_id)
                  ->where('participant_id', Auth::id());
        })->whereIn('status', ['pending', 'in_progress'])->first();

        if ($existingExchange) {
            return back()->withErrors(['general' => 'You already have an active exchange with this user.']);
        }

        $exchange = Exchange::create([
            'initiator_id' => Auth::id(),
            'participant_id' => $participantSkill->user_id,
            'initiator_skill_id' => $initiatorSkill->id,
            'participant_skill_id' => $participantSkill->id,
            'title' => $request->title,
            'description' => $request->description,
            'estimated_hours' => $request->estimated_hours,
            'terms' => $request->terms,
            'communication_preference' => $request->communication_preference,
            'status' => 'pending',
        ]);

        // Send notification to participant
        $participant = $exchange->participant;
        $participant->notify(new NewExchangeProposalNotification($exchange));

        return redirect()->route('user.exchanges.show', $exchange->id)
                        ->with('success', 'Exchange proposal sent successfully!');
    }

    /**
     * Display user's exchanges
     */
    public function myExchanges(Request $request)
    {
        $status = $request->get('status', 'all');
        
        $query = Exchange::with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
            ->where(function($q) {
                $q->where('initiator_id', Auth::id())
                  ->orWhere('participant_id', Auth::id());
            });

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $exchanges = $query->orderBy('created_at', 'desc')->paginate(10);

        $stats = [
            'total' => Exchange::where(function($q) {
                $q->where('initiator_id', Auth::id())->orWhere('participant_id', Auth::id());
            })->count(),
            'pending' => Exchange::where(function($q) {
                $q->where('initiator_id', Auth::id())->orWhere('participant_id', Auth::id());
            })->where('status', 'pending')->count(),
            'in_progress' => Exchange::where(function($q) {
                $q->where('initiator_id', Auth::id())->orWhere('participant_id', Auth::id());
            })->where('status', 'in_progress')->count(),
            'completed' => Exchange::where(function($q) {
                $q->where('initiator_id', Auth::id())->orWhere('participant_id', Auth::id());
            })->where('status', 'completed')->count(),
        ];

        return view('user-side.exchanges.my-exchanges', compact('exchanges', 'stats', 'status'));
    }

    /**
     * Show exchange details
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $exchange = Exchange::with([
            'initiator', 'participant', 'initiatorSkill', 'participantSkill',
            'messages.sender', 'reviews.reviewer'
        ])->findOrFail($id);

        // Ensure user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        $messages = $exchange->messages()->with('sender')->orderBy('created_at', 'asc')->get();

        return view('user-side.exchanges.show', compact('exchange', 'messages'));
    }

    /**
     * Accept exchange proposal
     */
    public function accept($id)
    {
        $id = Crypt::decrypt($id);
        $exchange = Exchange::findOrFail($id);

        // Ensure user is the participant
        if ($exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        if ($exchange->status !== 'pending') {
            return back()->withErrors(['general' => 'This exchange cannot be accepted.']);
        }

        $exchange->update([
            'status' => 'in_progress',
            'start_date' => now(),
        ]);

        // Send notification to initiator
        $initiator = $exchange->initiator;
        $initiator->notify(new ExchangeProposalStatusNotification($exchange, 'accepted'));

        return back()->with('success', 'Exchange accepted! You can now start working together.');
    }

    /**
     * Reject exchange proposal
     */
    public function reject($id)
    {
        $id = Crypt::decrypt($id);
        $exchange = Exchange::findOrFail($id);

        // Ensure user is the participant
        if ($exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        if ($exchange->status !== 'pending') {
            return back()->withErrors(['general' => 'This exchange cannot be rejected.']);
        }

        $exchange->update(['status' => 'cancelled']);

        // Send notification to initiator
        $initiator = $exchange->initiator;
        $initiator->notify(new ExchangeProposalStatusNotification($exchange, 'rejected'));

        return redirect()->route('user.exchanges.my-exchanges')
                        ->with('success', 'Exchange proposal rejected.');
    }

    /**
     * Complete exchange
     */
    public function complete($id)
    {
        $id = Crypt::decrypt($id);
        $exchange = Exchange::findOrFail($id);

        // Ensure user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        if ($exchange->status !== 'in_progress') {
            return back()->withErrors(['general' => 'This exchange cannot be completed.']);
        }

        $exchange->update([
            'status' => 'completed',
            'end_date' => now(),
        ]);

        return back()->with('success', 'Exchange completed successfully!');
    }

    /**
     * Cancel exchange
     */
    public function cancel($id)
    {
        $id = Crypt::decrypt($id);
        $exchange = Exchange::findOrFail($id);

        // Ensure user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($exchange->status, ['pending', 'in_progress'])) {
            return back()->withErrors(['general' => 'This exchange cannot be cancelled.']);
        }

        $exchange->update(['status' => 'cancelled']);

        return redirect()->route('user.exchanges.my-exchanges')
                        ->with('success', 'Exchange cancelled successfully.');
    }

    /**
     * Send message in exchange
     */
    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $id = Crypt::decrypt($id);
        $exchange = Exchange::findOrFail($id);

        // Ensure user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            abort(403);
        }

        Message::create([
            'exchange_id' => $exchange->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return back()->with('success', 'Message sent successfully!');
    }

    /**
     * Get skill recommendations for user
     */
    public function getRecommendations()
    {
        $userSkills = Auth::user()->skills;
        $userSkillCategories = $userSkills->pluck('category')->unique();

        // Find skills that match user's skill categories
        $recommendations = Skill::with(['user', 'reviews'])
            ->where('user_id', '!=', Auth::id())
            ->where('is_verified', true)
            ->whereIn('category', $userSkillCategories)
            ->orderBy('is_featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return response()->json($recommendations);
    }

    /**
     * Show quick exchange modal
     */
    public function showQuickExchange($skillId)
    {
        $skillId = Crypt::decrypt($skillId);
        $targetSkill = Skill::with('user')->findOrFail($skillId);
        $userSkills = Auth::user()->skills;

        $html = view('user-side.exchanges.partials.quick-exchange-modal', compact('targetSkill', 'userSkills'))->render();

        return response()->json([
            'success' => true,
            'html' => $html
        ]);
    }

    /**
     * Store quick exchange
     */
    public function storeQuickExchange(Request $request)
    {
        try {
            $request->validate([
                'target_skill_id' => 'required|exists:skills,id',
                'user_skill_id' => 'required|exists:skills,id',
                'title' => 'required|string|max:255',
                'description' => 'required|string|min:20',
                'estimated_hours' => 'nullable|integer|min:1|max:200',
                'communication_preference' => 'nullable|string|in:chat,video,email,phone',
            ]);

            $targetSkill = Skill::findOrFail($request->target_skill_id);
            $userSkill = Skill::findOrFail($request->user_skill_id);

            if ($userSkill->user_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You can only offer your own skills.'
                ], 400);
            }

            if ($targetSkill->user_id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot exchange with yourself.'
                ], 400);
            }

            $existingExchange = Exchange::where(function($query) use ($targetSkill) {
                $query->where('initiator_id', Auth::id())
                      ->where('participant_id', $targetSkill->user_id)
                      ->orWhere('initiator_id', $targetSkill->user_id)
                      ->where('participant_id', Auth::id());
            })->whereIn('status', ['pending', 'in_progress'])->first();

            if ($existingExchange) {
                return response()->json([
                    'success' => false,
                    'message' => 'You already have an active exchange with this user.'
                ], 400);
            }

            $exchange = Exchange::create([
                'initiator_id' => Auth::id(),
                'participant_id' => $targetSkill->user_id,
                'initiator_skill_id' => $userSkill->id,
                'participant_skill_id' => $targetSkill->id,
                'title' => $request->title,
                'description' => $request->description,
                'estimated_hours' => $request->estimated_hours,
                'communication_preference' => $request->communication_preference,
                'status' => 'pending',
            ]);

            $participant = $exchange->participant;
            $participant->notify(new NewExchangeProposalNotification($exchange));

            return response()->json([
                'success' => true,
                'message' => 'Exchange proposal sent successfully!',
                'redirect' => route('user.exchanges.show', \Illuminate\Support\Facades\Crypt::encrypt($exchange->id))
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating exchange. Please try again.'
            ], 500);
        }
    }

    /**
     * Search skills with advanced filters
     */
    public function search(Request $request)
    {
        $query = Skill::with(['user', 'reviews'])
            ->where('user_id', '!=', Auth::id())
            ->where('is_verified', true);

        // Search by skill name or category
        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by location
        if ($request->filled('location')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('location', 'like', "%{$request->location}%");
            });
        }

        // Filter by rating
        if ($request->filled('min_rating')) {
            $query->whereHas('reviews', function($q) use ($request) {
                $q->havingRaw('AVG(rating) >= ?', [$request->min_rating]);
            });
        }

        $skills = $query->orderBy('is_featured', 'desc')
                       ->orderBy('created_at', 'desc')
                       ->paginate(12);

        if ($request->ajax()) {
            return response()->json([
                'skills' => $skills,
                'html' => view('user-side.exchanges.partials.skills-grid', compact('skills'))->render()
            ]);
        }

        return view('user-side.exchanges.search', compact('skills'));
    }

    /**
     * Mark as done for initiator or participant
     */
    public function markAsDone($id)
    {
        $id = \Illuminate\Support\Facades\Crypt::decrypt($id);
        $exchange = \App\Models\Exchange::findOrFail($id);
        $userId = \Illuminate\Support\Facades\Auth::id();

        // Only allow if in progress and user is part of exchange
        if ($exchange->status !== 'in_progress' || ($exchange->initiator_id !== $userId && $exchange->participant_id !== $userId)) {
            abort(403);
        }

        if ($userId == $exchange->initiator_id) {
            $exchange->initiator_marked_done = true;
        } elseif ($userId == $exchange->participant_id) {
            $exchange->participant_marked_done = true;
        }
        $exchange->save();

        return back()->with('success', 'Marked as done!');
    }
} 