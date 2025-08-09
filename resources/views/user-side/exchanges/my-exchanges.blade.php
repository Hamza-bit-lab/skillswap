@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Exchanges')

@section('content')
<div class="my-exchanges-container">
    <!-- Header Section -->
    <div class="exchanges-header">
        <div class="container">
            <div class="header-content">
                <div class="header-info">
                    <h1 class="header-title">
                        <i class="fa fa-exchange"></i> My Exchanges
                    </h1>
                    <p class="header-subtitle">Manage and track all your skill exchanges</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('user.exchanges.discover') }}" class="btn btn-primary">
                        <i class="fa fa-search"></i> Find New Skills
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-exchange"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['total'] }}</h3>
                        <p>Total Exchanges</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['pending'] }}</h3>
                        <p>Pending</p>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fa fa-play"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['in_progress'] }}</h3>
                        <p>In Progress</p>
                    </div>
                </div>
                <div class="stat-item">
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

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container">
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
        <div class="container">
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
                                <a href="{{ route('user.exchanges.show', Crypt::encrypt($exchange->id)) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                                
                                @if($exchange->status == 'pending' && $exchange->participant_id == auth()->id())
                                    <form action="{{ route('user.exchanges.accept', Crypt::encrypt($exchange->id)) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i> Accept
                                        </button>
                                    </form>
                                    <form action="{{ route('user.exchanges.reject', Crypt::encrypt($exchange->id)) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm swal-reject-btn">
                                            <i class="fa fa-times"></i> Reject
                                        </button>
                                    </form>
                                @endif

                                @if($exchange->status == 'in_progress')
                                    <form action="{{ route('user.exchanges.complete', Crypt::encrypt($exchange->id)) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm swal-complete-btn">
                                            <i class="fa fa-check-circle"></i> Complete
                                        </button>
                                    </form>
                                @endif

                                @if(in_array($exchange->status, ['pending', 'in_progress']))
                                    <form action="{{ route('user.exchanges.cancel', Crypt::encrypt($exchange->id)) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm swal-cancel-btn">
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
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Header Section */
.exchanges-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 40px 0;
    color: #fff;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info {
    flex: 1;
}

.header-title {
    font-size: 2rem;
    font-weight: 600;
    margin: 0 0 10px 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.header-actions {
    flex-shrink: 0;
}

/* Stats Section */
.stats-section {
    background: #fff;
    padding: 30px 0;
    border-bottom: 1px solid #e9ecef;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 30px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    border-radius: 8px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border: 1px solid #e9ecef;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(75, 156, 211, 0.2);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
    color: #fff;
    font-size: 20px;
}

.stat-content h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 5px 0;
    color: #4B9CD3;
}

.stat-content p {
    color: #6c757d;
    margin: 0;
    font-weight: 500;
}

/* Filter Section */
.filter-section {
    background: #fff;
    padding: 20px 0;
    border-bottom: 1px solid #e9ecef;
}

.filter-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
    padding: 10px 16px;
    background: #f8f9fa;
    border-radius: 20px;
    color: #6c757d;
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid #e9ecef;
    font-weight: 500;
    font-size: 0.9rem;
}

.filter-tab:hover {
    background: #e9ecef;
    color: #495057;
    text-decoration: none;
    transform: translateY(-1px);
}

.filter-tab.active {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    border-color: transparent;
}

.filter-tab i {
    font-size: 0.8rem;
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
    background: transparent;
    padding: 40px 0;
}

.exchanges-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 25px;
    margin-bottom: 40px;
}

.exchange-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.exchange-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.15);
}

.exchange-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
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
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.user-details h6 {
    font-size: 0.85rem;
    font-weight: 600;
    color: #212529;
    margin: 0 0 3px;
}

.skill-name {
    font-size: 0.75rem;
    color: #6c757d;
    display: block;
}

.exchange-arrow {
    color: #4B9CD3;
    font-size: 14px;
}

.exchange-status {
    text-align: right;
}

.status-badge {
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.75rem;
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
    font-size: 1rem;
    font-weight: 600;
    color: #212529;
    margin: 0 0 12px;
    line-height: 1.3;
}

.exchange-description {
    color: #6c757d;
    line-height: 1.5;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.exchange-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #6c757d;
    font-size: 0.8rem;
}

.meta-item i {
    width: 12px;
    color: #4B9CD3;
}

.exchange-role {
    margin-bottom: 15px;
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 4px 10px;
    border-radius: 12px;
    font-size: 0.75rem;
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
    gap: 8px;
    flex-wrap: wrap;
    margin-top: 15px;
}

.exchange-actions .btn {
    border-radius: 15px;
    padding: 8px 14px;
    font-size: 0.8rem;
    font-weight: 500;
    min-width: 90px;
    white-space: nowrap;
}

.exchange-actions form {
    margin: 0;
}

/* Buttons */
.btn-primary {
    background: #4B9CD3;
    border-color: #4B9CD3;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-primary:hover {
    background: #3a7bb3;
    border-color: #3a7bb3;
    transform: translateY(-1px);
}

.btn-success {
    background: #28a745;
    border-color: #28a745;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-success:hover {
    background: #218838;
    border-color: #218838;
    transform: translateY(-1px);
}

.btn-danger {
    background: #dc3545;
    border-color: #dc3545;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-danger:hover {
    background: #c82333;
    border-color: #c82333;
    transform: translateY(-1px);
}

.btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
    background: transparent;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-danger:hover {
    background: #dc3545;
    border-color: #dc3545;
    color: #fff;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.empty-icon {
    font-size: 3rem;
    color: #dee2e6;
    margin-bottom: 20px;
}

.empty-state h4 {
    color: #212529;
    margin-bottom: 10px;
}

.empty-state p {
    color: #6c757d;
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
    border-radius: 6px;
    border: 1px solid #e9ecef;
    color: #4B9CD3;
    padding: 8px 12px;
    transition: all 0.2s ease;
}

.page-link:hover {
    background: #4B9CD3;
    border-color: #4B9CD3;
    color: #fff;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    border-color: transparent;
}

/* Responsive Design */
@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .header-title {
        font-size: 1.5rem;
    }
    
    .exchanges-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .exchange-card {
        padding: 20px;
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
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
}

@media (max-width: 576px) {
    .exchanges-header {
        padding: 30px 0;
    }
    
    .exchanges-list-section {
        padding: 20px 0;
    }
    
    .exchange-card {
        padding: 15px;
    }
    
    .header-title {
        font-size: 1.3rem;
    }
    
    .stat-item {
        padding: 15px;
    }
    
    .stat-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
    
    .stat-content h3 {
        font-size: 1.5rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 
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
    // Complete
    document.querySelectorAll('.swal-complete-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Complete Exchange?',
                text: 'Mark this exchange as completed?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, complete!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    // Cancel
    document.querySelectorAll('.swal-cancel-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = btn.closest('form');
            Swal.fire({
                title: 'Cancel Exchange?',
                text: 'Are you sure you want to cancel this exchange?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, cancel!'
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