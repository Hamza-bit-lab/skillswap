<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Models\Exchange;
use App\Models\Review;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Show admin dashboard with statistics
     */
    public function dashboard()
    {
        // Get basic statistics
        $totalUsers = User::count();
        $totalExchanges = Exchange::count();
        $pendingSkills = Skill::where('is_verified', false)->count();
        $avgRating = Review::avg('rating') ?? 0;
        
        // Get weekly statistics
        $newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $activeExchanges = Exchange::where('status', 'active')->count();
        
        // Get recent activities (simulated for now)
        $recentActivities = collect([
            (object) [
                'icon' => 'user-plus',
                'title' => 'New User Registration',
                'description' => 'John Doe registered as a new user',
                'status' => 'completed',
                'created_at' => Carbon::now()->subMinutes(5)
            ],
            (object) [
                'icon' => 'exchange',
                'title' => 'Exchange Completed',
                'description' => 'Web Development ↔ Graphic Design exchange completed',
                'status' => 'completed',
                'created_at' => Carbon::now()->subMinutes(15)
            ],
            (object) [
                'icon' => 'star',
                'title' => 'Skill Added',
                'description' => 'Mobile App Development skill added by Sarah',
                'status' => 'pending',
                'created_at' => Carbon::now()->subMinutes(30)
            ],
            (object) [
                'icon' => 'comment',
                'title' => 'New Review',
                'description' => '5-star review posted for exchange #123',
                'status' => 'completed',
                'created_at' => Carbon::now()->subMinutes(45)
            ]
        ]);
        
        // Get top categories
        $topCategories = Skill::select('category', DB::raw('count(*) as skills_count'))
            ->groupBy('category')
            ->orderBy('skills_count', 'desc')
            ->limit(5)
            ->get();
        
        $maxCategoryCount = $topCategories->max('skills_count') ?? 1;
        
        // Get recent exchanges
        $recentExchanges = Exchange::with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
            ->latest()
            ->limit(5)
            ->get();
        
        return view('admin-side.dashboard', compact(
            'totalUsers',
            'totalExchanges',
            'pendingSkills',
            'avgRating',
            'newUsersThisWeek',
            'activeExchanges',
            'recentActivities',
            'topCategories',
            'maxCategoryCount',
            'recentExchanges'
        ));
    }
    
    /**
     * Show users management page
     */
    public function users()
    {
        $users = User::with(['skills', 'initiatedExchanges', 'participatedExchanges', 'reviews', 'receivedReviews'])
            ->latest()
            ->paginate(20);
            
        $totalUsers = User::count();
        $newUsersThisWeek = User::where('created_at', '>=', Carbon::now()->subWeek())->count();
        $verifiedUsers = User::whereNotNull('email_verified_at')->count();
        $suspendedUsers = User::where('is_suspended', true)->count();
        
        return view('admin-side.users', compact(
            'users',
            'totalUsers',
            'newUsersThisWeek',
            'verifiedUsers',
            'suspendedUsers'
        ));
    }
    
    /**
     * Show skills management page
     */
    public function skills()
    {
        $skills = Skill::with('user')
            ->latest()
            ->paginate(20);
            
        $totalSkills = Skill::count();
        $pendingSkills = Skill::where('is_verified', false)->count();
        $approvedSkills = Skill::where('is_verified', true)->count();
        $rejectedSkills = 0; // Assuming no rejected status for now
        
        $categories = Skill::distinct()->pluck('category')->toArray();
        
        return view('admin-side.skills', compact(
            'skills',
            'totalSkills',
            'pendingSkills',
            'approvedSkills',
            'rejectedSkills',
            'categories'
        ));
    }
    
    /**
     * Show exchanges management page
     */
    public function exchanges()
    {
        try {
            $exchanges = Exchange::with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
                ->whereHas('initiator') // Ensure initiator exists
                ->whereHas('initiatorSkill') // Ensure initiator skill exists
                ->latest()
                ->paginate(20);
                
            $totalExchanges = Exchange::count();
            $activeExchanges = Exchange::whereIn('status', ['pending', 'in_progress'])->count();
            $completedExchanges = Exchange::where('status', 'completed')->count();
            $cancelledExchanges = Exchange::where('status', 'cancelled')->count();
            
            $categories = Skill::distinct()->pluck('category')->toArray();
            
            // Log for debugging
            \Log::info('Admin exchanges page accessed', [
                'totalExchanges' => $totalExchanges,
                'activeExchanges' => $activeExchanges,
                'completedExchanges' => $completedExchanges,
                'cancelledExchanges' => $cancelledExchanges
            ]);
            
            return view('admin-side.exchanges', compact(
                'exchanges',
                'totalExchanges',
                'activeExchanges',
                'completedExchanges',
                'cancelledExchanges',
                'categories'
            ));
        } catch (\Exception $e) {
            \Log::error('Error in admin exchanges: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading exchanges: ' . $e->getMessage());
        }
    }
    
    /**
     * Show reports and analytics page
     */
    public function reports()
    {
        $growthRate = 15; // Simulated growth rate
        $activeUsers = User::where('last_active', '>=', Carbon::now()->subDay())->count();
        $successRate = 85; // Simulated success rate
        $avgRating = number_format(Review::avg('rating') ?? 4.5, 1);
        
        return view('admin-side.reports', compact(
            'growthRate',
            'activeUsers',
            'successRate',
            'avgRating'
        ));
    }
    
    /**
     * Show settings page
     */
    public function settings()
    {
        return view('admin-side.settings');
    }
    
    /**
     * Get skill details for modal
     */
    public function getSkill($id)
    {
        $skill = Skill::with('user')->findOrFail($id);
        
        $html = view('admin-side.partials.skill-details', compact('skill'))->render();
        
        return response()->json([
            'success' => true,
            'skill' => $skill,
            'html' => $html
        ]);
    }
    
    /**
     * Approve a skill
     */
    public function approveSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update(['is_verified' => true]);
        
        return response()->json([
            'success' => true,
            'message' => 'Skill approved successfully'
        ]);
    }
    
    /**
     * Reject a skill
     */
    public function rejectSkill(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        $skill->update(['is_verified' => false]);
        
        return response()->json([
            'success' => true,
            'message' => 'Skill rejected successfully'
        ]);
    }
    
    /**
     * Bulk approve skills
     */
    public function bulkApproveSkills(Request $request)
    {
        $skillIds = $request->input('skills', []);
        Skill::whereIn('id', $skillIds)->update(['is_verified' => true]);
        
        return response()->json([
            'success' => true,
            'message' => count($skillIds) . ' skills approved successfully'
        ]);
    }
    
    /**
     * Bulk reject skills
     */
    public function bulkRejectSkills(Request $request)
    {
        $skillIds = $request->input('skills', []);
        Skill::whereIn('id', $skillIds)->update(['is_verified' => false]);
        
        return response()->json([
            'success' => true,
            'message' => count($skillIds) . ' skills rejected successfully'
        ]);
    }
    
    /**
     * Get user details for modal
     */
    public function getUser($id)
    {
        $user = User::with(['skills', 'exchanges', 'reviews'])->findOrFail($id);
        
        $html = view('admin-side.partials.user-details', compact('user'))->render();
        
        return response()->json([
            'success' => true,
            'user' => $user,
            'html' => $html
        ]);
    }
    
    /**
     * Suspend a user
     */
    public function suspendUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_suspended' => true]);
        
        return response()->json([
            'success' => true,
            'message' => 'User suspended successfully'
        ]);
    }
    
    /**
     * Activate a user
     */
    public function activateUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_suspended' => false]);
        
        return response()->json([
            'success' => true,
            'message' => 'User activated successfully'
        ]);
    }
    
    /**
     * Bulk activate users
     */
    public function bulkActivateUsers(Request $request)
    {
        $userIds = $request->input('users', []);
        User::whereIn('id', $userIds)->update(['is_suspended' => false]);
        
        return response()->json([
            'success' => true,
            'message' => count($userIds) . ' users activated successfully'
        ]);
    }
    
    /**
     * Bulk suspend users
     */
    public function bulkSuspendUsers(Request $request)
    {
        $userIds = $request->input('users', []);
        User::whereIn('id', $userIds)->update(['is_suspended' => true]);
        
        return response()->json([
            'success' => true,
            'message' => count($userIds) . ' users suspended successfully'
        ]);
    }
    
    /**
     * Get exchange details for modal
     */
    public function getExchange($id)
    {
        $exchange = Exchange::with(['initiator', 'participant', 'initiatorSkill', 'participantSkill', 'messages'])
            ->findOrFail($id);
        
        $html = view('admin-side.partials.exchange-details', compact('exchange'))->render();
        
        return response()->json([
            'success' => true,
            'exchange' => $exchange,
            'html' => $html
        ]);
    }
    
    /**
     * Approve an exchange
     */
    public function approveExchange($id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->update(['status' => 'in_progress']);
        
        return response()->json([
            'success' => true,
            'message' => 'Exchange approved successfully'
        ]);
    }
    
    /**
     * Reject an exchange
     */
    public function rejectExchange(Request $request, $id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->update(['status' => 'cancelled']);
        
        return response()->json([
            'success' => true,
            'message' => 'Exchange rejected successfully'
        ]);
    }
    
    /**
     * Pause an exchange
     */
    public function pauseExchange($id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->update(['status' => 'paused']);
        
        return response()->json([
            'success' => true,
            'message' => 'Exchange paused successfully'
        ]);
    }
    
    /**
     * Complete an exchange
     */
    public function completeExchange($id)
    {
        $exchange = Exchange::findOrFail($id);
        $exchange->update(['status' => 'completed']);
        
        return response()->json([
            'success' => true,
            'message' => 'Exchange completed successfully'
        ]);
    }
    
    /**
     * Bulk approve exchanges
     */
    public function bulkApproveExchanges(Request $request)
    {
        $exchangeIds = $request->input('exchanges', []);
        Exchange::whereIn('id', $exchangeIds)->update(['status' => 'in_progress']);
        
        return response()->json([
            'success' => true,
            'message' => count($exchangeIds) . ' exchanges approved successfully'
        ]);
    }
    
    /**
     * Bulk reject exchanges
     */
    public function bulkRejectExchanges(Request $request)
    {
        $exchangeIds = $request->input('exchanges', []);
        Exchange::whereIn('id', $exchangeIds)->update(['status' => 'cancelled']);
        
        return response()->json([
            'success' => true,
            'message' => count($exchangeIds) . ' exchanges rejected successfully'
        ]);
    }
    
    /**
     * Bulk complete exchanges
     */
    public function bulkCompleteExchanges(Request $request)
    {
        $exchangeIds = $request->input('exchanges', []);
        Exchange::whereIn('id', $exchangeIds)->update(['status' => 'completed']);
        
        return response()->json([
            'success' => true,
            'message' => count($exchangeIds) . ' exchanges completed successfully'
        ]);
    }
    
    /**
     * Send message to exchange participants
     */
    public function sendExchangeMessage(Request $request, $id)
    {
        $exchange = Exchange::findOrFail($id);
        
        // Create message for both participants
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $exchange->initiator_id,
            'exchange_id' => $exchange->id,
            'content' => $request->input('message'),
            'type' => 'admin'
        ]);
        
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $exchange->participant_id,
            'exchange_id' => $exchange->id,
            'content' => $request->input('message'),
            'type' => 'admin'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    }
    
    /**
     * Send message to user
     */
    public function sendUserMessage(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'content' => $request->input('content'),
            'subject' => $request->input('subject'),
            'type' => 'admin'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully'
        ]);
    }
    
    /**
     * Export skills
     */
    public function exportSkills(Request $request)
    {
        $query = Skill::with('user');
        
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('is_verified', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_verified', true);
            }
        }
        
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        $skills = $query->get();
        
        // Generate CSV
        $filename = 'skills_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($skills) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'User', 'Name', 'Category', 'Level', 'Description', 'Status', 'Created At']);
            
            foreach ($skills as $skill) {
                fputcsv($file, [
                    $skill->id,
                    $skill->user->name,
                    $skill->name,
                    $skill->category,
                    $skill->level,
                    $skill->description,
                    $skill->is_verified ? 'Approved' : 'Pending',
                    $skill->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Export users
     */
    public function exportUsers(Request $request)
    {
        $query = User::with(['skills', 'exchanges']);
        
        if ($request->filled('status')) {
            if ($request->status === 'suspended') {
                $query->where('is_suspended', true);
            } elseif ($request->status === 'active') {
                $query->where('is_suspended', false);
            }
        }
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        $users = $query->get();
        
        // Generate CSV
        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Skills Count', 'Exchanges Count', 'Status', 'Created At']);
            
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->skills->count(),
                    $user->exchanges->count(),
                    $user->is_suspended ? 'Suspended' : 'Active',
                    $user->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Export exchanges
     */
    public function exportExchanges(Request $request)
    {
        $query = Exchange::with(['initiator', 'participant', 'initiatorSkill', 'participantSkill']);
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('category')) {
            $query->whereHas('initiatorSkill', function($q) use ($request) {
                $q->where('category', $request->category);
            })->orWhereHas('participantSkill', function($q) use ($request) {
                $q->where('category', $request->category);
            });
        }
        
        $exchanges = $query->get();
        
        // Generate CSV
        $filename = 'exchanges_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($exchanges) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Title', 'Initiator', 'Participant', 'Status', 'Created At']);
            
            foreach ($exchanges as $exchange) {
                fputcsv($file, [
                    $exchange->id,
                    $exchange->title,
                    $exchange->initiator->name,
                    $exchange->participant->name,
                    $exchange->status,
                    $exchange->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    /**
     * Show reviews management page
     */
    public function reviews()
    {
        try {
            $reviews = Review::with(['reviewer', 'reviewedUser', 'exchange'])
                ->latest()
                ->paginate(20);
                
            $totalReviews = Review::count();
            $pendingReviews = Review::where('is_approved', false)->where('is_rejected', false)->count();
            $approvedReviews = Review::where('is_approved', true)->count();
            $rejectedReviews = Review::where('is_rejected', true)->count();
            
            // Log for debugging
            \Log::info('Admin reviews page accessed', [
                'totalReviews' => $totalReviews,
                'pendingReviews' => $pendingReviews,
                'approvedReviews' => $approvedReviews,
                'rejectedReviews' => $rejectedReviews
            ]);
            
            return view('admin-side.reviews', compact(
                'reviews',
                'totalReviews',
                'pendingReviews',
                'approvedReviews',
                'rejectedReviews'
            ));
        } catch (\Exception $e) {
            \Log::error('Error in admin reviews: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading reviews: ' . $e->getMessage());
        }
    }
    
    /**
     * Get review details for modal
     */
    public function getReview($id)
    {
        try {
            $review = Review::with(['reviewer', 'reviewedUser', 'exchange'])->findOrFail($id);
            
            $html = view('admin-side.partials.review-details', compact('review'))->render();
            
            return response()->json([
                'success' => true,
                'review' => $review,
                'html' => $html
            ]);
        } catch (\Exception $e) {
            \Log::error('Error getting review details: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading review details'
            ], 500);
        }
    }
    
    /**
     * Approve a review
     */
    public function approveReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => true, 'is_rejected' => false]);
        
        return response()->json([
            'success' => true,
            'message' => 'Review approved successfully'
        ]);
    }
    
    /**
     * Reject a review
     */
    public function rejectReview($id)
    {
        $review = Review::findOrFail($id);
        $review->update(['is_rejected' => true, 'is_approved' => false]);
        
        return response()->json([
            'success' => true,
            'message' => 'Review rejected successfully'
        ]);
    }
    
    /**
     * Bulk approve reviews
     */
    public function bulkApproveReviews(Request $request)
    {
        $reviewIds = $request->input('reviews', []);
        Review::whereIn('id', $reviewIds)->update(['is_approved' => true, 'is_rejected' => false]);
        
        return response()->json([
            'success' => true,
            'message' => count($reviewIds) . ' reviews approved successfully'
        ]);
    }
    
    /**
     * Bulk reject reviews
     */
    public function bulkRejectReviews(Request $request)
    {
        $reviewIds = $request->input('reviews', []);
        Review::whereIn('id', $reviewIds)->update(['is_rejected' => true, 'is_approved' => false]);
        
        return response()->json([
            'success' => true,
            'message' => count($reviewIds) . ' reviews rejected successfully'
        ]);
    }
    
    /**
     * Export reviews
     */
    public function exportReviews(Request $request)
    {
        $query = Review::with(['reviewer', 'reviewed', 'exchange']);
        
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false)->where('is_rejected', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            } elseif ($request->status === 'rejected') {
                $query->where('is_rejected', true);
            }
        }
        
        $reviews = $query->get();
        
        // Generate CSV
        $filename = 'reviews_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];
        
        $callback = function() use ($reviews) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Reviewer', 'Reviewed', 'Rating', 'Comment', 'Status', 'Created At']);
            
            foreach ($reviews as $review) {
                $status = $review->is_approved ? 'Approved' : ($review->is_rejected ? 'Rejected' : 'Pending');
                fputcsv($file, [
                    $review->id,
                    $review->reviewer->name,
                    $review->reviewed->name,
                    $review->rating,
                    $review->comment,
                    $status,
                    $review->created_at->format('Y-m-d H:i:s')
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
} 