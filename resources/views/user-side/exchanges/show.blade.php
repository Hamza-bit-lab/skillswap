@extends('user-side.layouts.app')

@section('title', 'Exchange Details - ' . $exchange->title)

@section('content')
<div class="my-exchanges-container">
    <!-- Exchange Header Section -->
    <div class="exchange-header-section">
    <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        <div class="exchanges-header-content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                            <div class="header-content">
                                <h1 class="header-title">{{ $exchange->title }}</h1>
                                <p class="header-subtitle">Skill Exchange</p>
                            </div>
                    </div>
                        
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="exchange-icon-container">
                        <div class="exchange-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="exchange-status-indicator {{ $exchange->status }}"></div>
                    </div>
                </div>
                <div class="col">
                    <div class="exchange-info">
                        <h1 class="exchange-title">{{ $exchange->title }}</h1>
                        <p class="exchange-subtitle">Skill Exchange</p>
                        <div class="exchange-meta">
                            <span class="meta-item">
                                <i class="fa fa-calendar"></i>
                                Created {{ $exchange->created_at->format('M d, Y') }}
                            </span>
                            <span class="meta-item">
                                <i class="fa fa-clock-o"></i>
                                {{ $exchange->estimated_hours ?? 'N/A' }} hours estimated
                            </span>
                            <span class="meta-item">
                                <i class="fa fa-users"></i>
                                {{ $exchange->initiator->name }} ↔ {{ $exchange->participant->name }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="exchange-actions">
                        @if($exchange->status == 'in_progress')
                            @php
                                $otherUser = $exchange->initiator_id === auth()->id() ? $exchange->participant : $exchange->initiator;
                            @endphp
                            <button class="btn btn-primary" onclick="openChat({{ $exchange->id }}, '{{ $otherUser->name }}', '{{ $otherUser->avatar ? asset('storage/' . $otherUser->avatar) : asset('assets/images/default-avatar.jpg') }}')">
                                <i class="fa fa-comment"></i> Send Message
                            </button>
                        @endif
                        <a href="{{ route('user.exchanges.my-exchanges') }}" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-left"></i> Back to Exchanges
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exchange Stats -->
    <div class="exchange-stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ ucfirst(str_replace('_', ' ', $exchange->status)) }}</h3>
                            <p>Exchange Status</p>
                            <small class="text-success">{{ $exchange->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $exchange->estimated_hours ?? 'N/A' }}</h3>
                            <p>Estimated Hours</p>
                            <small class="text-info">{{ $exchange->communication_preference ?? 'N/A' }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $exchange->initiatorSkill->name }}</h3>
                            <p>Initiator Skill</p>
                            <small class="text-primary">Level: {{ $exchange->initiatorSkill->level }}</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $exchange->participantSkill->name }}</h3>
                            <p>Participant Skill</p>
                            <small class="text-primary">Level: {{ $exchange->participantSkill->level }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="exchange-main-content">
        <div class="container">
            <div class="row">
                <!-- Left Sidebar -->
                <div class="col-lg-4">
                    <!-- Exchange Details Card -->
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-info-circle"></i> Exchange Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="exchange-details">
                                <div class="detail-item">
                                    <i class="fa fa-tag"></i>
                                    <div class="detail-content">
                                        <strong>Title</strong>
                                        <span>{{ $exchange->title }}</span>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-align-left"></i>
                                    <div class="detail-content">
                                        <strong>Description</strong>
                                        <span>{{ $exchange->description }}</span>
                                    </div>
                                </div>
                                @if($exchange->terms)
                                <div class="detail-item">
                                    <i class="fa fa-file-text"></i>
                                    <div class="detail-content">
                                        <strong>Terms</strong>
                                        <span>{{ $exchange->terms }}</span>
                                    </div>
                                </div>
                                @endif
                                @if($exchange->budget_range)
                                <div class="detail-item">
                                    <i class="fa fa-dollar"></i>
                                    <div class="detail-content">
                                        <strong>Budget Range</strong>
                                        <span>{{ $exchange->budget_range }}</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Participants Card -->
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-users"></i> Participants</h5>
                        </div>
                        <div class="card-body">
                            <div class="participants-container">
                                <div class="participant-card">
                                    <div class="participant-avatar">
                                        <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="{{ $exchange->initiator->name }}">
                                        <div class="participant-status online"></div>
                                    </div>
                                    <div class="participant-info">
                                        <h6>{{ $exchange->initiator->name }}</h6>
                                        <span class="participant-role">Initiator</span>
                                        <div class="participant-skill">
                                            <strong>{{ $exchange->initiatorSkill->name }}</strong>
                                            <span class="skill-level level-{{ strtolower($exchange->initiatorSkill->level) }}">
                                                {{ $exchange->initiatorSkill->level }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="exchange-arrow">
                                    <i class="fa fa-exchange"></i>
                                </div>

                                <div class="participant-card">
                                    <div class="participant-avatar">
                                        <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="{{ $exchange->participant->name }}">
                                        <div class="participant-status online"></div>
                                    </div>
                                    <div class="participant-info">
                                        <h6>{{ $exchange->participant->name }}</h6>
                                        <span class="participant-role">Participant</span>
                                        <div class="participant-skill">
                                            <strong>{{ $exchange->participantSkill->name }}</strong>
                                            <span class="skill-level level-{{ strtolower($exchange->participantSkill->level) }}">
                                                {{ $exchange->participantSkill->level }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Exchange Actions Card -->
                    @if($exchange->status == 'pending' && $exchange->participant_id == auth()->id())
                    <div class="profile-card mb-4">
                        <div class="card-header">
                            <h5><i class="fa fa-cogs"></i> Exchange Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="exchange-actions-container">
                                <form action="{{ route('user.exchanges.accept', Crypt::encrypt($exchange->id)) }}" method="POST" class="mb-3">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fa fa-check"></i> Accept Exchange
                                    </button>
                                </form>
                                <form action="{{ route('user.exchanges.reject', Crypt::encrypt($exchange->id)) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-block swal-reject-btn">
                                        <i class="fa fa-times"></i> Reject Exchange
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($exchange->status == 'in_progress')
                        @php
                            $userId = auth()->id();
                            $isInitiator = $exchange->initiator_id === $userId;
                            $isParticipant = $exchange->participant_id === $userId;
                        @endphp
                        <div class="profile-card mb-4">
                            <div class="card-header">
                                <h5><i class="fa fa-cogs"></i> Exchange Actions</h5>
                            </div>
                            <div class="card-body">
                                <div class="exchange-actions-container">
                                    @if(($isInitiator && !$exchange->initiator_marked_done) || ($isParticipant && !$exchange->participant_marked_done))
                                        <form method="POST" action="{{ route('user.exchanges.mark-done', ['id' => encrypt($exchange->id)]) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success swal-mark-done-btn">
                                                <i class="fa fa-check"></i> Mark as Done
                                            </button>
                                        </form>
                                    @endif
                                    <div class="mt-2">
                                        <span class="badge badge-{{ $exchange->initiator_marked_done ? 'success' : 'secondary' }}">
                                            {{ $exchange->initiator->name }}: {{ $exchange->initiator_marked_done ? 'Done' : 'Not Done' }}
                                        </span>
                                        <span class="badge badge-{{ $exchange->participant_marked_done ? 'success' : 'secondary' }}">
                                            {{ $exchange->participant->name }}: {{ $exchange->participant_marked_done ? 'Done' : 'Not Done' }}
                                        </span>
                                    </div>
                                    @if($exchange->initiator_marked_done && $exchange->participant_marked_done)
                                        <form method="POST" action="{{ route('user.exchanges.complete', ['id' => encrypt($exchange->id)]) }}" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary mt-2 swal-complete-btn">
                                                <i class="fa fa-flag-checkered"></i> Complete Exchange
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Main Content Area -->
                <div class="col-lg-8">
                    <!-- Navigation Tabs -->
                    <div class="profile-tabs">
                        <ul class="nav nav-pills" id="exchangeTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="pill" href="#overview" role="tab">
                                    <i class="fa fa-info-circle"></i> Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="skills-tab" data-toggle="pill" href="#skills" role="tab">
                                    <i class="fa fa-star"></i> Skills Being Exchanged
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="timeline-tab" data-toggle="pill" href="#timeline" role="tab">
                                    <i class="fa fa-clock-o"></i> Timeline
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Content -->
                    <div class="tab-content profile-tab-content" id="exchangeTabsContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel">
                            <div class="overview-section">
                                <div class="overview-grid">
                                    <div class="overview-card">
                                        <div class="overview-icon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <div class="overview-content">
                                            <h6>Created Date</h6>
                                            <p>{{ $exchange->created_at->format('F d, Y') }}</p>
                                            <small>{{ $exchange->created_at->format('g:i A') }}</small>
                                        </div>
                                    </div>
                                    <div class="overview-card">
                                        <div class="overview-icon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                        <div class="overview-content">
                                            <h6>Estimated Time</h6>
                                            <p>{{ $exchange->estimated_hours ?? 'Not specified' }} hours</p>
                                            <small>{{ $exchange->communication_preference ?? 'N/A' }}</small>
                                        </div>
                                    </div>
                                    <div class="overview-card">
                                        <div class="overview-icon">
                                            <i class="fa fa-comments"></i>
                                        </div>
                                        <div class="overview-content">
                                            <h6>Communication</h6>
                                            <p>{{ $exchange->communication_preference ?? 'Not specified' }}</p>
                                            <small>Preferred method</small>
                                        </div>
                                    </div>
                                    <div class="overview-card">
                                        <div class="overview-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <div class="overview-content">
                                            <h6>Exchange Type</h6>
                                            <p>Skill Swap</p>
                                            <small>Direct exchange</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Skills Tab -->
                        <div class="tab-pane fade" id="skills" role="tabpanel">
                            <div class="skills-section">
                                <div class="skills-exchange">
                                    <div class="skill-card">
                                        <div class="skill-header">
                                            <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                                 alt="{{ $exchange->initiator->name }}" class="skill-user-avatar">
                                            <div class="skill-user-info">
                                                <h6>{{ $exchange->initiator->name }}</h6>
                                                <span class="skill-category">{{ $exchange->initiatorSkill->category }}</span>
                                            </div>
                                        </div>
                                        <div class="skill-content">
                                            <h5>{{ $exchange->initiatorSkill->name }}</h5>
                                            <p>{{ $exchange->initiatorSkill->description }}</p>
                                            <div class="skill-meta">
                                                <span class="skill-level level-{{ strtolower($exchange->initiatorSkill->level) }}">
                                                    {{ $exchange->initiatorSkill->level }}
                                                </span>
                                                <span class="skill-rate">${{ $exchange->initiatorSkill->hourly_rate }}/hr</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="exchange-arrow-large">
                                        <i class="fa fa-exchange"></i>
                                    </div>

                                    <div class="skill-card">
                                        <div class="skill-header">
                                            <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                                 alt="{{ $exchange->participant->name }}" class="skill-user-avatar">
                                            <div class="skill-user-info">
                                                <h6>{{ $exchange->participant->name }}</h6>
                                                <span class="skill-category">{{ $exchange->participantSkill->category }}</span>
                                            </div>
                                        </div>
                                        <div class="skill-content">
                                            <h5>{{ $exchange->participantSkill->name }}</h5>
                                            <p>{{ $exchange->participantSkill->description }}</p>
                                            <div class="skill-meta">
                                                <span class="skill-level level-{{ strtolower($exchange->participantSkill->level) }}">
                                                    {{ $exchange->participantSkill->level }}
                                                </span>
                                                <span class="skill-rate">${{ $exchange->participantSkill->hourly_rate }}/hr</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Timeline Tab -->
                        <div class="tab-pane fade" id="timeline" role="tabpanel">
                            <div class="timeline-section">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Exchange Created</h6>
                                            <p>{{ $exchange->initiator->name }} initiated this exchange</p>
                                            <small>{{ $exchange->created_at->format('M d, Y g:i A') }}</small>
                                        </div>
                                    </div>
                                    
                                    @if($exchange->status != 'pending')
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="fa fa-check"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Exchange Accepted</h6>
                                            <p>{{ $exchange->participant->name }} accepted the exchange</p>
                                            <small>{{ $exchange->updated_at->format('M d, Y g:i A') }}</small>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    @if($exchange->status == 'completed')
                                    <div class="timeline-item">
                                        <div class="timeline-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6>Exchange Completed</h6>
                                            <p>This exchange has been marked as completed</p>
                                            <small>{{ $exchange->updated_at->format('M d, Y g:i A') }}</small>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modern Chat Window -->
<div id="chat-window" class="chat-window" style="display: none;">
    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-user-avatar">
                <img src="" alt="" id="chat-user-avatar">
            </div>
            <div class="chat-user-details">
                <h6 id="chat-user-name"></h6>
                <span class="chat-status" id="chat-status">Online</span>
            </div>
        </div>
        <div class="chat-header-actions">
            <button class="btn btn-sm btn-link" onclick="minimizeChat()" title="Minimize">
                <i class="fa fa-minus"></i>
            </button>
            <button class="btn btn-sm btn-link" onclick="closeChat()" title="Close">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    
    <div class="chat-body">
        <div class="chat-messages" id="chat-messages">
            <div class="chat-loading">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <span>Loading messages...</span>
            </div>
        </div>
    </div>
    
    <div class="chat-footer">
        <form id="chat-form">
            @csrf
            <div class="chat-input-container">
                <textarea id="chat-input" class="chat-input" placeholder="Type your message..." rows="1" maxlength="1000"></textarea>
                <button type="submit" class="chat-send-btn" disabled>
                    <i class="fa fa-paper-plane"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Exchange Container */
.exchange-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 0;
}

/* Header Section */
.exchange-header-section {
    position: relative;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 60px 0 40px;
    margin-bottom: 30px;
}

.exchange-icon-container {
    position: relative;
    margin-bottom: 20px;
}

.exchange-icon {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 5px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0 8px 32px rgba(0,0,0,0.3);
}

.exchange-icon i {
    font-size: 48px;
    color: #fff;
}

.exchange-status-indicator {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid #fff;
}

.exchange-status-indicator.pending { background: #ffc107; }
.exchange-status-indicator.in_progress { background: #28a745; }
.exchange-status-indicator.completed { background: #17a2b8; }
.exchange-status-indicator.cancelled { background: #dc3545; }

/* Exchange Info */
.exchange-info {
    color: #fff;
}

.exchange-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.exchange-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 5px 0 15px;
}

.exchange-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    opacity: 0.9;
}

.meta-item i {
    width: 16px;
}

/* Exchange Actions */
.exchange-actions {
    display: flex;
    gap: 10px;
}

.exchange-actions .btn {
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
}

/* Stats Section */
.exchange-stats-section {
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
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #fff;
    font-size: 24px;
}

.stat-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: #333;
}

.stat-content p {
    color: #666;
    margin: 5px 0;
    font-weight: 500;
}

/* Main Content */
.exchange-main-content {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
    margin: 0 15px;
}

/* Profile Cards */
.profile-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 25px;
    border: 1px solid #e9ecef;
}

.profile-card .card-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    padding: 20px;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.profile-card .card-header h5 {
    margin: 0;
    font-weight: 600;
}

.profile-card .card-body {
    padding: 25px;
}

/* Exchange Details */
.exchange-details {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.detail-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.detail-item:hover {
    background: #e9ecef;
    transform: translateX(5px);
}

.detail-item i {
    color: #4B9CD3;
    font-size: 18px;
    width: 20px;
    margin-top: 2px;
}

.detail-content {
    flex: 1;
}

.detail-content strong {
    display: block;
    color: #333;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 5px;
}

.detail-content span {
    color: #666;
    font-size: 15px;
    line-height: 1.5;
}

/* Participants */
.participants-container {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.participant-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.participant-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.participant-avatar {
    position: relative;
}

.participant-avatar img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.participant-status {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.participant-status.online {
    background: #28a745;
}

.participant-info h6 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 16px;
    font-weight: 600;
}

.participant-role {
    color: #667eea;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.participant-skill {
    margin-top: 8px;
}

.participant-skill strong {
    display: block;
    color: #333;
    font-size: 14px;
    margin-bottom: 3px;
}

.skill-level {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

.level-beginner { background: #d4edda; color: #155724; }
.level-intermediate { background: #fff3cd; color: #856404; }
.level-advanced { background: #cce5ff; color: #004085; }
.level-expert { background: #f8d7da; color: #721c24; }

.exchange-arrow {
    text-align: center;
    color: #667eea;
    font-size: 24px;
    margin: 10px 0;
}

/* Exchange Actions */
.exchange-actions-container {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.exchange-actions-container .btn {
    border-radius: 10px;
    padding: 12px 20px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.exchange-actions-container .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Profile Tabs */
.profile-tabs {
    margin-bottom: 30px;
}

.profile-tabs .nav-pills .nav-link {
    border-radius: 25px;
    padding: 12px 20px;
    margin-right: 10px;
    background: #fff;
    color: #667eea;
    border: 2px solid #667eea;
    font-weight: 600;
    transition: all 0.3s ease;
}

.profile-tabs .nav-pills .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-color: transparent;
}

/* Tab Content */
.profile-tab-content {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    min-height: 400px;
}

/* Overview Grid */
.overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.overview-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #fff;
    border-radius: 12px;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.overview-card:hover {
    background: #e9ecef;
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.overview-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 20px;
}

.overview-content h6 {
    margin: 0 0 5px 0;
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

.overview-content p {
    margin: 0 0 3px 0;
    color: #333;
    font-size: 16px;
    font-weight: 600;
}

.overview-content small {
    color: #999;
    font-size: 12px;
}

/* Skills Section */
.skills-exchange {
    display: flex;
    align-items: center;
    gap: 30px;
}

.skill-card {
    flex: 1;
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    transition: all 0.3s ease;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.skill-card:hover {
    background: #e9ecef;
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

.skill-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.skill-user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.skill-user-info h6 {
    margin: 0 0 5px 0;
    color: #333;
    font-size: 16px;
    font-weight: 600;
}

.skill-category {
    color: #666;
    font-size: 14px;
    background: #e9ecef;
    padding: 4px 12px;
    border-radius: 20px;
}

.skill-content h5 {
    margin: 0 0 10px 0;
    color: #333;
    font-size: 18px;
    font-weight: 600;
}

.skill-content p {
    margin: 0 0 15px 0;
    color: #666;
    font-size: 14px;
    line-height: 1.6;
}

.skill-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.skill-rate {
    background: #667eea;
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
}

.exchange-arrow-large {
    color: #667eea;
    font-size: 40px;
    background: #f8f9fa;
    padding: 20px;
    border-radius: 50%;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

/* Timeline */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-icon {
    position: absolute;
    left: -22px;
    top: 0;
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.timeline-content {
    background: #fff;
    padding: 20px;
    border-radius: 12px;
    margin-left: 20px;
    border: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.timeline-content h6 {
    margin: 0 0 8px 0;
    color: #333;
    font-weight: 600;
}

.timeline-content p {
    margin: 0 0 5px 0;
    color: #666;
    font-size: 14px;
}

.timeline-content small {
    color: #999;
    font-size: 12px;
}

/* Modern Chat Window Styles */
.chat-window {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 400px;
    height: 500px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    z-index: 1000;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    transition: all 0.3s ease;
}

.chat-window.minimized {
    height: 60px;
}

.chat-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 15px 15px 0 0;
}

.chat-header-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.chat-user-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid rgba(255,255,255,0.3);
}

.chat-user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.chat-user-details h6 {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
}

.chat-status {
    font-size: 12px;
    opacity: 0.8;
}

.chat-header-actions {
    display: flex;
    gap: 8px;
}

.chat-header-actions button {
    color: white;
    border: none;
    background: none;
    font-size: 14px;
    padding: 4px;
    border-radius: 4px;
    transition: background 0.2s ease;
}

.chat-header-actions button:hover {
    background: rgba(255,255,255,0.2);
}

.chat-body {
    flex: 1;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f8f9fa;
}

.chat-loading, .chat-empty, .chat-error {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: #666;
    text-align: center;
}

.chat-loading i, .chat-empty i, .chat-error i {
    font-size: 2rem;
    margin-bottom: 10px;
    opacity: 0.5;
}

.chat-message {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    animation: fadeInUp 0.3s ease;
}

.chat-message.message-mine {
    flex-direction: row-reverse;
}

.message-avatar {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.message-content {
    max-width: 70%;
    background: white;
    padding: 12px 15px;
    border-radius: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    position: relative;
}

.message-mine .message-content {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

.message-sender {
    font-size: 12px;
    font-weight: 600;
    opacity: 0.8;
}

.message-time {
    font-size: 11px;
    opacity: 0.6;
}

.message-text {
    font-size: 14px;
    line-height: 1.4;
    word-wrap: break-word;
}

.message-status {
    position: absolute;
    bottom: 5px;
    right: 10px;
    font-size: 10px;
}

.chat-footer {
    padding: 15px 20px;
    background: white;
    border-top: 1px solid #e9ecef;
}

.chat-input-container {
    display: flex;
    gap: 10px;
    align-items: flex-end;
}

.chat-input {
    flex: 1;
    border: 1px solid #e9ecef;
    border-radius: 20px;
    padding: 10px 15px;
    font-size: 14px;
    resize: none;
    outline: none;
    transition: border-color 0.2s ease;
    max-height: 120px;
    min-height: 40px;
}

.chat-input:focus {
    border-color: #667eea;
}

.chat-send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

.chat-send-btn:disabled {
    background: #e9ecef;
    color: #999;
    cursor: not-allowed;
}

.chat-send-btn:not(:disabled):hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Chat */
@media (max-width: 768px) {
    .chat-window {
        width: calc(100vw - 40px);
        height: calc(100vh - 100px);
        bottom: 10px;
        right: 20px;
        left: 20px;
    }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .overview-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .exchange-title {
        font-size: 2rem;
    }
    
    .exchange-meta {
        flex-direction: column;
        gap: 10px;
    }
    
    .exchange-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .exchange-actions .btn {
        width: 100%;
    }
    
    .stat-card {
        margin-bottom: 20px;
    }
    
    .skills-exchange {
        flex-direction: column;
        gap: 20px;
    }
    
    .exchange-arrow-large {
        transform: rotate(90deg);
        margin: 10px 0;
    }
    
    .overview-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-tabs .nav-pills {
        flex-direction: column;
    }
    
    .profile-tabs .nav-pills .nav-link {
        margin-right: 0;
        margin-bottom: 10px;
    }
}

@media (max-width: 576px) {
    .exchange-icon {
        width: 100px;
        height: 100px;
    }
    
    .exchange-header-section {
        padding: 40px 0 30px;
    }
    
    .profile-tab-content {
        padding: 20px;
    }
}
</style>

<script>
let currentExchangeId = null;
let currentRecipient = null;
let messagePollingInterval = null;

function openChat(exchangeId, recipientName, recipientAvatar) {
    currentExchangeId = exchangeId;
    currentRecipient = recipientName;
    
    // Set chat header info
    const userNameElement = document.getElementById('chat-user-name');
    const userAvatarElement = document.getElementById('chat-user-avatar');
    const chatWindow = document.getElementById('chat-window');
    const chatInput = document.getElementById('chat-input');
    
    if (userNameElement) {
        userNameElement.textContent = recipientName;
    }
    if (userAvatarElement) {
        userAvatarElement.src = recipientAvatar || '{{ asset("assets/images/default-avatar.jpg") }}';
    }
    
    // Show chat window
    if (chatWindow) {
        chatWindow.style.display = 'flex';
    }
    
    // Load messages
    loadMessages();
    
    // Start polling for new messages
    startMessagePolling();
    
    // Focus on input and enable send button if there's text
    setTimeout(() => {
        if (chatInput) {
            chatInput.focus();
            // Trigger input event to check if send button should be enabled
            chatInput.dispatchEvent(new Event('input'));
        }
    }, 100);
}

function closeChat() {
    const chatWindow = document.getElementById('chat-window');
    const chatInput = document.getElementById('chat-input');
    const sendBtn = document.getElementById('chat-send-btn');
    
    if (chatWindow) {
        chatWindow.style.display = 'none';
    }
    if (chatInput) {
        chatInput.value = '';
    }
    if (sendBtn) {
        sendBtn.disabled = true;
    }
    
    // Stop polling
    if (messagePollingInterval) {
        clearInterval(messagePollingInterval);
        messagePollingInterval = null;
    }
    
    currentExchangeId = null;
    currentRecipient = null;
}

function minimizeChat() {
    const chatWindow = document.getElementById('chat-window');
    if (chatWindow) {
        chatWindow.classList.toggle('minimized');
    }
}

function loadMessages() {
    const messagesContainer = document.getElementById('chat-messages');
    if (!messagesContainer) return;
    
    fetch(`/dashboard/exchanges/${currentExchangeId}/messages`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                messagesContainer.innerHTML = '';
                
                if (data.messages.length === 0) {
                    messagesContainer.innerHTML = `
                        <div class="chat-empty">
                            <i class="fa fa-comments"></i>
                            <p>No messages yet</p>
                            <small>Start the conversation!</small>
                        </div>
                    `;
                } else {
                    data.messages.forEach(message => {
                        const messageHtml = createMessageHtml(message);
                        messagesContainer.innerHTML += messageHtml;
                    });
                    
                    // Scroll to bottom
                    scrollToBottom();
                }
                
                // Mark messages as read
                markMessagesAsRead();
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            if (messagesContainer) {
                messagesContainer.innerHTML = `
                    <div class="chat-error">
                        <i class="fa fa-exclamation-triangle"></i>
                        <p>Error loading messages</p>
                    </div>
                `;
            }
        });
}

function createMessageHtml(message) {
    const isMine = message.sender_id === {{ auth()->id() }};
    const avatar = message.sender.avatar ? `/storage/${message.sender.avatar}` : '{{ asset("assets/images/default-avatar.jpg") }}';
    const time = new Date(message.created_at).toLocaleTimeString('en-US', { 
        hour: 'numeric', 
        minute: '2-digit',
        hour12: true 
    });
    
    return `
        <div class="chat-message ${isMine ? 'message-mine' : 'message-other'}" data-message-id="${message.id}">
            <div class="message-avatar">
                <img src="${avatar}" alt="${message.sender.name}" class="avatar-img">
            </div>
            <div class="message-content">
                <div class="message-header">
                    <span class="message-sender">${message.sender.name}</span>
                    <span class="message-time">${time}</span>
                </div>
                <div class="message-text">
                    ${message.message}
                </div>
                ${isMine ? `
                    <div class="message-status">
                        ${message.is_read ? 
                            '<i class="fa fa-check-double text-primary" title="Read"></i>' : 
                            '<i class="fa fa-check text-muted" title="Sent"></i>'
                        }
                    </div>
                ` : ''}
            </div>
        </div>
    `;
}

function sendMessage(message) {
    const formData = new FormData();
    formData.append('message', message);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch(`/dashboard/exchanges/${currentExchangeId}/messages`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add message to chat
            const messagesContainer = document.getElementById('chat-messages');
            if (messagesContainer) {
                const messageHtml = createMessageHtml(data.message);
                messagesContainer.innerHTML += messageHtml;
                
                // Scroll to bottom
                scrollToBottom();
            }
            
            // Clear input and disable send button
            const chatInput = document.getElementById('chat-input');
            const sendBtn = document.getElementById('chat-send-btn');
            
            if (chatInput) {
                chatInput.value = '';
            }
            if (sendBtn) {
                sendBtn.disabled = true;
            }
        } else {
            alert('Error sending message: ' + (data.errors?.message?.[0] || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        alert('Error sending message. Please try again.');
    });
}

function markMessagesAsRead() {
    fetch(`/dashboard/exchanges/${currentExchangeId}/messages/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
}

function startMessagePolling() {
    // Poll for new messages every 5 seconds
    messagePollingInterval = setInterval(() => {
        if (currentExchangeId) {
            loadMessages();
        }
    }, 5000);
}

function scrollToBottom() {
    const messagesContainer = document.getElementById('chat-messages');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}

// Chat form submission
document.getElementById('chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const chatInput = document.getElementById('chat-input');
    if (chatInput) {
        const message = chatInput.value.trim();
        if (message && currentExchangeId) {
            sendMessage(message);
        }
    }
});

// Chat input handling
document.getElementById('chat-input').addEventListener('input', function() {
    const sendBtn = document.getElementById('chat-send-btn');
    const messageText = this.value.trim();
    
    if (sendBtn) {
        sendBtn.disabled = !messageText;
    }
    
    // Auto-resize textarea
    this.style.height = 'auto';
    this.style.height = Math.min(this.scrollHeight, 120) + 'px';
});

// Enter key to send (Shift+Enter for new line)
document.getElementById('chat-input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        const message = this.value.trim();
        if (message && currentExchangeId) {
            sendMessage(message);
        }
    }
});

// Legacy function for backward compatibility
function openMessageWindow(exchangeId, recipientName) {
    openChat(exchangeId, recipientName);
}
</script>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Reject
    document.querySelectorAll('.swal-reject-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure you want to reject this exchange?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    // Mark as Done
    document.querySelectorAll('.swal-mark-done-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Mark as Done?',
                text: 'Are you sure you want to mark this exchange as done?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, mark as done!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    // Complete Exchange
    document.querySelectorAll('.swal-complete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Complete Exchange?',
                text: 'Are you sure you want to complete this exchange?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, complete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endpush

