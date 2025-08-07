@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Dashboard')

@section('content')

@if(session('success'))
    <div class="container-fluid mt-3">
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<!-- Dashboard Container -->
<div class="dashboard-container">
    <!-- Dashboard Header -->
    <div class="dashboard-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="dashboard-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="welcome-content">
                            <h1 class="welcome-title">Welcome back, {{ auth()->user()->name }}! 👋</h1>
                            <p class="welcome-subtitle">Here's what's happening with your skill exchanges today</p>
                            <div class="welcome-meta">
                                <span class="meta-item">
                                    <i class="fa fa-calendar"></i>
                                    {{ now()->format('l, F j, Y') }}
                                </span>
                                <span class="meta-item">
                                    <i class="fa fa-clock-o"></i>
                                    Last login {{ auth()->user()->last_active ? auth()->user()->last_active->diffForHumans() : 'Recently' }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-right">
                        <div class="header-actions">
                            <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-search"></i> Discover Skills
                            </a>
                            <a href="{{ route('user.exchanges.my-exchanges') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fa fa-list"></i> My Exchanges
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="dashboard-stats-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ auth()->user()->getTotalExchangesCount() }}</h3>
                            <p>Total Exchanges</p>
                            <small class="text-success">{{ auth()->user()->getCompletedExchangesCount() }} completed</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="stat-content">
                            <h3>2</h3>
                            <p>Active Exchanges</p>
                            <small class="text-info">In progress</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ number_format(auth()->user()->getAverageRating(), 1) }}</h3>
                            <p>Average Rating</p>
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= auth()->user()->getAverageRating() ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="stat-content">
                            <h3>5</h3>
                            <p>Unread Messages</p>
                            <small class="text-primary">New conversations</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Main Content -->
    <div class="dashboard-main-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content Area -->
                <div class="col-lg-8">
                    <!-- Recent Exchanges Section -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <div class="section-title">
                                <h3><i class="fa fa-exchange"></i> Recent Exchanges</h3>
                                <p class="section-subtitle">Your latest skill exchange activities</p>
                            </div>
                            <a href="{{ route('user.exchanges.discover') }}" class="btn btn-outline-primary">
                                <i class="fa fa-eye"></i> View All
                            </a>
                        </div>
                        
                        <div class="exchanges-list">
                            @php
                                $recentExchanges = \App\Models\Exchange::where(function($query) {
                                    $query->where('initiator_id', auth()->id())
                                          ->orWhere('participant_id', auth()->id());
                                })->with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
                                ->orderBy('created_at', 'desc')
                                ->limit(3)
                                ->get();
                            @endphp
                            
                            @forelse($recentExchanges as $exchange)
                                @php
                                    $otherUser = $exchange->initiator_id === auth()->id() ? $exchange->participant : $exchange->initiator;
                                    $otherUserSkill = $exchange->initiator_id === auth()->id() ? $exchange->participantSkill : $exchange->initiatorSkill;
                                    $mySkill = $exchange->initiator_id === auth()->id() ? $exchange->initiatorSkill : $exchange->participantSkill;
                                    $unreadCount = \App\Models\Message::where('exchange_id', $exchange->id)
                                        ->where('receiver_id', auth()->id())
                                        ->where('is_read', false)
                                        ->count();
                                @endphp
                                
                                <div class="exchange-card">
                                    <div class="exchange-header">
                                        <div class="exchange-users">
                                            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.jpg') }}" alt="User" class="user-avatar">
                                            <div class="exchange-arrow">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <img src="{{ $otherUser->avatar ? asset('storage/' . $otherUser->avatar) : asset('assets/images/default-avatar.jpg') }}" alt="User" class="user-avatar">
                                            <div class="user-actions mt-2">
                                                <a href="{{ route('user.profile.public', ['user' => $otherUser->username]) }}" class="btn btn-sm btn-outline-primary">View Profile</a>
                                                <button class="btn btn-sm btn-outline-secondary" onclick="navigator.clipboard.writeText('{{ url('/profile/' . $otherUser->username) }}'); alert('Profile link copied!')"><i class="fa fa-share"></i> Share</button>
                                            </div>
                                        </div>
                                        <div class="exchange-status">
                                            <span class="status-badge status-{{ $exchange->status }}">{{ ucfirst(str_replace('_', ' ', $exchange->status)) }}</span>
                                        </div>
                                    </div>
                                    <div class="exchange-content">
                                        <h5>{{ $exchange->title }}</h5>
                                        <p>{{ $exchange->description }}</p>
                                        <div class="exchange-meta">
                                            <span class="meta-item">
                                                <i class="fa fa-calendar"></i>
                                                {{ $exchange->created_at->diffForHumans() }}
                                            </span>
                                            @if($exchange->estimated_hours)
                                            <span class="meta-item">
                                                <i class="fa fa-clock-o"></i>
                                                {{ $exchange->estimated_hours }} hours estimated
                                            </span>
                                            @endif
                                        </div>
                                        <div class="exchange-tags">
                                            <span class="tag">{{ $mySkill->name }}</span>
                                            <span class="tag">{{ $otherUserSkill->name }}</span>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <i class="fa fa-exchange fa-2x text-muted mb-3"></i>
                                    <p class="text-muted">No exchanges yet. Start by finding skills to exchange!</p>
                                </div>
                            @endforelse
                                        <span class="meta-item">
                                            <i class="fa fa-star"></i>
                                            Rated 5 stars
                                        </span>
                                    </div>
                                    <div class="exchange-tags">
                                        <span class="tag">UI/UX Design</span>
                                        <span class="tag">Data Analysis</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Messages Section -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <div class="section-title">
                                <h3><i class="fa fa-envelope"></i> Recent Messages</h3>
                                <p class="section-subtitle">Your latest conversations</p>
                            </div>
                            <a href="{{ route('user.messages') }}" class="btn btn-outline-primary">
                                <i class="fa fa-eye"></i> View All
                            </a>
                        </div>
                        
                        <div class="messages-list">
                            <div class="message-card unread">
                                <div class="message-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User">
                                    <div class="online-indicator"></div>
                                </div>
                                <div class="message-content">
                                    <div class="message-header">
                                        <h5>Sarah Johnson</h5>
                                        <span class="message-time">2 hours ago</span>
                                    </div>
                                    <p>Hi! I'm interested in your web development skills. Would you like to exchange for my logo design services?</p>
                                    <div class="message-actions">
                                        <button class="btn btn-sm btn-primary">Reply</button>
                                        <button class="btn btn-sm btn-outline-secondary">View Profile</button>
                                    </div>
                                </div>
                                <div class="message-status">
                                    <span class="unread-badge"></span>
                                </div>
                            </div>

                            <div class="message-card">
                                <div class="message-avatar">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                                </div>
                                <div class="message-content">
                                    <div class="message-header">
                                        <h5>Mike Chen</h5>
                                        <span class="message-time">1 day ago</span>
                                    </div>
                                    <p>Thanks for the great work on the website! The exchange was perfect.</p>
                                    <div class="message-actions">
                                        <button class="btn btn-sm btn-outline-primary">Reply</button>
                                    </div>
                                </div>
                            </div>

                            <div class="message-card">
                                <div class="message-avatar">
                                    <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="User">
                                </div>
                                <div class="message-content">
                                    <div class="message-header">
                                        <h5>Maria Garcia</h5>
                                        <span class="message-time">3 days ago</span>
                                    </div>
                                    <p>When can we start working on the content writing project?</p>
                                    <div class="message-actions">
                                        <button class="btn btn-sm btn-outline-primary">Reply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Sidebar -->
                <div class="col-lg-4">
                    <!-- Quick Actions -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h3><i class="fa fa-bolt"></i> Quick Actions</h3>
                        </div>
                        
                        <div class="quick-actions">
                            <a href="{{ route('user.skills') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Add New Skill</h5>
                                    <p>Showcase your expertise</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                            
                            <a href="{{ route('user.exchanges.discover') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fa fa-search"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Find Exchanges</h5>
                                    <p>Discover opportunities</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                            
                            <a href="{{ route('user.profile') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Update Profile</h5>
                                    <p>Keep it current</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                            
                            <a href="{{ route('user.messages') }}" class="action-card">
                                <div class="action-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="action-content">
                                    <h5>Send Message</h5>
                                    <p>Connect with others</p>
                                </div>
                                <div class="action-arrow">
                                    <i class="fa fa-chevron-right"></i>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h3><i class="fa fa-history"></i> Recent Activity</h3>
                        </div>
                        
                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Received 5-star review</h6>
                                    <p>From Sarah Johnson</p>
                                    <span class="activity-time">2 hours ago</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Started new exchange</h6>
                                    <p>With Mike Chen</p>
                                    <span class="activity-time">1 day ago</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Completed exchange</h6>
                                    <p>With Emma Davis</p>
                                    <span class="activity-time">3 days ago</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <h6>Added new skill</h6>
                                    <p>React Development</p>
                                    <span class="activity-time">1 week ago</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Skill Recommendations -->
                    <div class="dashboard-section">
                        <div class="section-header">
                            <h3><i class="fa fa-lightbulb"></i> Recommended Skills</h3>
                        </div>
                        
                        <div class="skill-recommendations">
                            <div class="skill-recommendation">
                                <div class="skill-icon">
                                    <i class="fa fa-code"></i>
                                </div>
                                <div class="skill-info">
                                    <h5>Python Development</h5>
                                    <p>High demand in your area</p>
                                    <div class="skill-meta">
                                        <span class="demand-badge high">High Demand</span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary">Add</button>
                            </div>

                            <div class="skill-recommendation">
                                <div class="skill-icon">
                                    <i class="fa fa-paint-brush"></i>
                                </div>
                                <div class="skill-info">
                                    <h5>UI/UX Design</h5>
                                    <p>Matches your profile well</p>
                                    <div class="skill-meta">
                                        <span class="demand-badge medium">Medium Demand</span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary">Add</button>
                            </div>

                            <div class="skill-recommendation">
                                <div class="skill-icon">
                                    <i class="fa fa-bullhorn"></i>
                                </div>
                                <div class="skill-info">
                                    <h5>Digital Marketing</h5>
                                    <p>Popular in your network</p>
                                    <div class="skill-meta">
                                        <span class="demand-badge high">High Demand</span>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Dashboard Container */
.dashboard-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 0;
}

/* Header Section */
.dashboard-header-section {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 60px 0 40px;
    margin-bottom: 30px;
}

.header-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1974&q=80') center/cover;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
}

.dashboard-header-content {
    position: relative;
    z-index: 2;
}

/* Welcome Content */
.welcome-content {
    color: #fff;
}

.welcome-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.welcome-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 10px 0 20px;
}

.welcome-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.9;
    font-size: 0.9rem;
}

.meta-item i {
    width: 16px;
}

/* Header Actions */
.header-actions .btn {
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Stats Section */
.dashboard-stats-section {
    margin-bottom: 30px;
}

.stat-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
    height: 100%;
    border: 1px solid rgba(255,255,255,0.1);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #fff;
    font-size: 24px;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
    color: #333;
}

.stat-content p {
    color: #666;
    margin: 5px 0;
    font-weight: 500;
}

.stat-content small {
    font-size: 0.8rem;
    font-weight: 500;
}

.rating-stars {
    margin-top: 5px;
}

.rating-stars i {
    font-size: 0.8rem;
    margin: 0 1px;
}

/* Main Content */
.dashboard-main-content {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
}

/* Dashboard Sections */
.dashboard-section {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #f8f9fa;
}

.section-title h3 {
    font-size: 1.3rem;
    font-weight: 600;
    color: #333;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title h3 i {
    color: #667eea;
}

.section-subtitle {
    color: #6c757d;
    font-size: 0.9rem;
    margin: 5px 0 0;
}

.section-header .btn {
    border-radius: 20px;
    padding: 8px 16px;
    font-weight: 500;
}

/* Exchange Cards */
.exchanges-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.exchange-card {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
}

.exchange-card:hover {
    background: #fff;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.unread-badge-small {
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: bold;
    margin-left: 5px;
}

.message-btn {
    position: relative;
}

.exchange-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.exchange-users {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.exchange-arrow {
    color: #667eea;
    font-size: 18px;
}

.exchange-status {
    text-align: right;
}

.status-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-in_progress { background: #cce5ff; color: #004085; }
.status-completed { background: #d4edda; color: #155724; }
.status-cancelled { background: #f8d7da; color: #721c24; }

.exchange-content h5 {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.exchange-content p {
    color: #666;
    margin-bottom: 15px;
    line-height: 1.5;
}

.exchange-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6c757d;
    font-size: 0.85rem;
}

.exchange-tags {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.tag {
    background: #e9ecef;
    color: #495057;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Message Cards */
.messages-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.message-card {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.message-card:hover {
    background: #fff;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.message-card.unread {
    background: #fff;
    border-left: 4px solid #667eea;
}

.message-avatar {
    position: relative;
    flex-shrink: 0;
}

.message-avatar img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.online-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 12px;
    height: 12px;
    background: #28a745;
    border-radius: 50%;
    border: 2px solid #fff;
}

.message-content {
    flex: 1;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
}

.message-header h5 {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.message-time {
    font-size: 0.8rem;
    color: #6c757d;
}

.message-content p {
    color: #666;
    margin-bottom: 12px;
    line-height: 1.4;
}

.message-actions {
    display: flex;
    gap: 8px;
}

.message-actions .btn {
    border-radius: 15px;
    padding: 4px 12px;
    font-size: 0.8rem;
}

.message-status {
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

.unread-badge {
    width: 10px;
    height: 10px;
    background: #667eea;
    border-radius: 50%;
    display: block;
}

/* Quick Actions */
.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.action-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    color: #495057;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
}

.action-card:hover {
    background: #667eea;
    color: #fff;
    text-decoration: none;
    transform: translateX(5px);
}

.action-icon {
    width: 45px;
    height: 45px;
    background: #667eea;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    transition: all 0.3s ease;
}

.action-card:hover .action-icon {
    background: #fff;
    color: #667eea;
}

.action-content {
    flex: 1;
}

.action-content h5 {
    font-size: 0.95rem;
    font-weight: 600;
    margin: 0 0 3px;
}

.action-content p {
    font-size: 0.8rem;
    margin: 0;
    opacity: 0.8;
}

.action-arrow {
    color: #6c757d;
    transition: all 0.3s ease;
}

.action-card:hover .action-arrow {
    color: #fff;
}

/* Activity List */
.activity-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.activity-icon {
    width: 35px;
    height: 35px;
    background: #667eea;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    flex-shrink: 0;
}

.activity-content h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 3px;
}

.activity-content p {
    font-size: 0.8rem;
    color: #666;
    margin: 0 0 5px;
}

.activity-time {
    font-size: 0.75rem;
    color: #6c757d;
}

/* Skill Recommendations */
.skill-recommendations {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.skill-recommendation {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.skill-icon {
    width: 45px;
    height: 45px;
    background: #667eea;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    flex-shrink: 0;
}

.skill-info {
    flex: 1;
}

.skill-info h5 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 3px;
}

.skill-info p {
    font-size: 0.8rem;
    color: #666;
    margin: 0 0 8px;
}

.skill-meta {
    display: flex;
    gap: 5px;
}

.demand-badge {
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.7rem;
    font-weight: 500;
}

.demand-badge.high {
    background: #d4edda;
    color: #155724;
}

.demand-badge.medium {
    background: #fff3cd;
    color: #856404;
}

.skill-recommendation .btn {
    border-radius: 15px;
    padding: 6px 12px;
    font-size: 0.8rem;
}

/* Floating Alert */
.floating-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    min-width: 300px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-title {
        font-size: 2rem;
    }
    
    .welcome-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .header-actions {
        text-align: center;
        margin-top: 20px;
    }
    
    .header-actions .btn {
        width: 100%;
    }
    
    .stat-card {
        margin-bottom: 20px;
    }
    
    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .section-header .btn {
        align-self: flex-end;
    }
    
    .exchange-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .exchange-status {
        text-align: left;
    }
    
    .message-card {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .message-status {
        align-self: flex-end;
    }
}

@media (max-width: 576px) {
    .dashboard-header-section {
        padding: 40px 0 30px;
    }
    
    .dashboard-main-content {
        padding: 20px 0;
    }
    
    .dashboard-section {
        padding: 20px;
    }
    
    .welcome-title {
        font-size: 1.8rem;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .stat-content h3 {
        font-size: 1.5rem;
    }
}
</style>
@endsection 