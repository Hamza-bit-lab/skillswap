@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Exchanges')

@section('content')
<div class="my-exchanges-container">
    <!-- Header Section -->
    <div class="exchanges-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="exchanges-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-content">
                            <h1 class="header-title">My Exchanges</h1>
                            <p class="header-subtitle">Manage and track all your skill exchanges</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-actions">
                            <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary btn-lg">
                                <i class="fa fa-search"></i> Find New Skills
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['total'] }}</h3>
                            <p>Total Exchanges</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['pending'] }}</h3>
                            <p>Pending</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-play"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['in_progress'] }}</h3>
                            <p>In Progress</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['completed'] }}</h3>
                            <p>Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container-fluid">
            <div class="filter-card">
                <div class="filter-tabs">
                    <a href="{{ route('user.exchanges.my-exchanges') }}" 
                       class="filter-tab {{ $status == 'all' ? 'active' : '' }}">
                        <i class="fa fa-list"></i> All Exchanges
                    </a>
                    <a href="{{ route('user.exchanges.my-exchanges', ['status' => 'pending']) }}" 
                       class="filter-tab {{ $status == 'pending' ? 'active' : '' }}">
                        <i class="fa fa-clock-o"></i> Pending
                        @if($stats['pending'] > 0)
                            <span class="badge">{{ $stats['pending'] }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.exchanges.my-exchanges', ['status' => 'in_progress']) }}" 
                       class="filter-tab {{ $status == 'in_progress' ? 'active' : '' }}">
                        <i class="fa fa-play"></i> In Progress
                        @if($stats['in_progress'] > 0)
                            <span class="badge">{{ $stats['in_progress'] }}</span>
                        @endif
                    </a>
                    <a href="{{ route('user.exchanges.my-exchanges', ['status' => 'completed']) }}" 
                       class="filter-tab {{ $status == 'completed' ? 'active' : '' }}">
                        <i class="fa fa-check"></i> Completed
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Exchanges List -->
    <div class="exchanges-list-section">
        <div class="container-fluid">
            @if($exchanges->count() > 0)
                <div class="exchanges-grid">
                    @foreach($exchanges as $exchange)
                        <div class="exchange-card" data-exchange-id="{{ $exchange->id }}">
                            <div class="exchange-header">
                                <div class="exchange-users">
                                    <div class="user-info">
                                        <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="{{ $exchange->initiator->name }}" class="user-avatar">
                                        <div class="user-details">
                                            <h6>{{ $exchange->initiator->name }}</h6>
                                            <span class="skill-name">{{ $exchange->initiatorSkill->name }}</span>
                                        </div>
                                    </div>
                                    <div class="exchange-arrow">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <div class="user-info">
                                        <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="{{ $exchange->participant->name }}" class="user-avatar">
                                        <div class="user-details">
                                            <h6>{{ $exchange->participant->name }}</h6>
                                            <span class="skill-name">{{ $exchange->participantSkill->name }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="exchange-status">
                                    <span class="status-badge status-{{ $exchange->status }}">
                                        {{ ucfirst(str_replace('_', ' ', $exchange->status)) }}
                                    </span>
                                </div>
                            </div>

                            <div class="exchange-content">
                                <h5 class="exchange-title">{{ $exchange->title }}</h5>
                                <p class="exchange-description">{{ Str::limit($exchange->description, 120) }}</p>
                                
                                <div class="exchange-meta">
                                    <div class="meta-item">
                                        <i class="fa fa-calendar"></i>
                                        <span>{{ $exchange->created_at->format('M d, Y') }}</span>
                                    </div>
                                    @if($exchange->estimated_hours)
                                    <div class="meta-item">
                                        <i class="fa fa-clock-o"></i>
                                        <span>{{ $exchange->estimated_hours }} hours</span>
                                    </div>
                                    @endif
                                    @if($exchange->start_date)
                                    <div class="meta-item">
                                        <i class="fa fa-play"></i>
                                        <span>Started {{ $exchange->start_date->format('M d, Y') }}</span>
                                    </div>
                                    @endif
                                </div>

                                <div class="exchange-role">
                                    @if($exchange->initiator_id == auth()->id())
                                        <span class="role-badge initiator">
                                            <i class="fa fa-user"></i> You initiated this exchange
                                        </span>
                                    @else
                                        <span class="role-badge participant">
                                            <i class="fa fa-user-plus"></i> You were invited to this exchange
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="exchange-actions">
                                <a href="{{ route('user.exchanges.show', $exchange->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                
                                @if($exchange->status == 'pending' && $exchange->participant_id == auth()->id())
                                    <form action="{{ route('user.exchanges.accept', $exchange->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('user.exchanges.reject', $exchange->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to reject this exchange?')">
                                            <i class="fa fa-times"></i> Reject
                                        </button>
                                    </form>
                                @endif

                                @if($exchange->status == 'in_progress')
                                    <form action="{{ route('user.exchanges.complete', $exchange->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Mark this exchange as completed?')">
                                            <i class="fa fa-check-circle"></i> Complete
                                        </button>
                                    </form>
                                @endif

                                @if(in_array($exchange->status, ['pending', 'in_progress']))
                                    <form action="{{ route('user.exchanges.cancel', $exchange->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this exchange?')">
                                            <i class="fa fa-ban"></i> Cancel
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($exchanges->hasPages())
                    <div class="pagination-wrapper">
                        {{ $exchanges->appends(request()->query())->links() }}
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <h4>No Exchanges Found</h4>
                    <p>
                        @if($status == 'all')
                            You haven't started any exchanges yet. Start by discovering skills to swap!
                        @else
                            No {{ $status }} exchanges found.
                        @endif
                    </p>
                    <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary">
                        <i class="fa fa-search"></i> Discover Skills
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
/* My Exchanges Container */
.my-exchanges-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 0;
}

/* Header Section */
.exchanges-header-section {
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

.exchanges-header-content {
    position: relative;
    z-index: 2;
}

.header-content {
    color: #fff;
}

.header-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin: 10px 0 0;
}

.header-actions .btn {
    border-radius: 25px;
    padding: 12px 25px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

/* Stats Section */
.stats-section {
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

/* Filter Section */
.filter-section {
    margin-bottom: 30px;
}

.filter-card {
    background: #fff;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.filter-tabs {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-tab {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #f8f9fa;
    border-radius: 25px;
    color: #495057;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    font-weight: 500;
}

.filter-tab:hover {
    background: #e9ecef;
    color: #495057;
    text-decoration: none;
    transform: translateY(-2px);
}

.filter-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    border-color: transparent;
}

.filter-tab i {
    font-size: 0.9rem;
}

.filter-tab .badge {
    background: rgba(255,255,255,0.2);
    color: #fff;
    font-size: 0.7rem;
    padding: 2px 6px;
    border-radius: 10px;
}

/* Exchanges List Section */
.exchanges-list-section {
    background: #f8f9fa;
    min-height: 60vh;
    padding: 30px 0;
}

.exchanges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.exchange-card {
    background: #fff;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    position: relative;
    overflow: visible;
    min-height: 300px;
}

.exchange-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}

.exchange-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Exchange Header */
.exchange-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.exchange-users {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 10px;
    text-align: center;
}

.user-avatar {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.user-details h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 3px;
}

.skill-name {
    font-size: 0.8rem;
    color: #6c757d;
    display: block;
}

.exchange-arrow {
    color: #667eea;
    font-size: 16px;
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
.status-disputed { background: #f8d7da; color: #721c24; }

/* Exchange Content */
.exchange-content {
    margin-bottom: 20px;
}

.exchange-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin: 0 0 15px;
    line-height: 1.3;
    word-wrap: break-word;
}

.exchange-description {
    color: #666;
    line-height: 1.6;
    margin-bottom: 20px;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.exchange-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6c757d;
    font-size: 0.85rem;
}

.meta-item i {
    width: 14px;
    color: #667eea;
}

.exchange-role {
    margin-bottom: 15px;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.role-badge.initiator {
    background: #e3f2fd;
    color: #1976d2;
}

.role-badge.participant {
    background: #f3e5f5;
    color: #7b1fa2;
}

/* Exchange Actions */
.exchange-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.exchange-actions .btn {
    border-radius: 20px;
    padding: 10px 18px;
    font-size: 0.85rem;
    font-weight: 500;
    min-width: 100px;
    white-space: nowrap;
}

.exchange-actions form {
    margin: 0;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #666;
}

.empty-icon {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #333;
    margin-bottom: 10px;
}

.empty-state p {
    margin-bottom: 20px;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

.pagination {
    display: flex;
    gap: 5px;
}

.page-link {
    border-radius: 10px;
    border: 2px solid #e9ecef;
    color: #667eea;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.page-link:hover {
    background: #667eea;
    border-color: #667eea;
    color: #fff;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: transparent;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-actions {
        text-align: center;
        margin-top: 20px;
    }
    
    .header-actions .btn {
        width: 100%;
    }
    
    .exchanges-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .exchange-card {
        padding: 25px;
        min-height: auto;
    }
    
    .exchange-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .exchange-status {
        text-align: left;
    }
    
    .exchange-users {
        flex-direction: column;
        gap: 10px;
    }
    
    .exchange-arrow {
        transform: rotate(90deg);
    }
    
    .filter-tabs {
        flex-direction: column;
    }
    
    .filter-tab {
        justify-content: center;
    }
    
    .exchange-actions {
        flex-direction: column;
        gap: 8px;
    }
    
    .exchange-actions .btn {
        width: 100%;
        min-width: auto;
    }
}

@media (max-width: 576px) {
    .exchanges-header-section {
        padding: 40px 0 30px;
    }
    
    .exchanges-list-section {
        padding: 20px 0;
    }
    
    .exchange-card {
        padding: 20px;
    }
    
    .header-title {
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