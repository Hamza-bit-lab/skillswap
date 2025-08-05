@extends('user-side.layouts.app')

@section('title', 'SkillSwap - My Exchanges')

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

<!-- My Exchanges Container -->
<div class="my-exchanges-container">
    <!-- Header Section -->
    <div class="my-exchanges-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="my-exchanges-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="header-content">
                            <h1 class="header-title">My Exchanges</h1>
                            <p class="header-subtitle">Track and manage all your skill exchange activities</p>
                            <div class="header-stats">
                                <div class="stat-item">
                                    <span class="stat-number">{{ auth()->user()->getTotalExchangesCount() }}</span>
                                    <span class="stat-label">Total Exchanges</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">{{ auth()->user()->getCompletedExchangesCount() }}</span>
                                    <span class="stat-label">Completed</span>
                                </div>
                                <div class="stat-item">
                                    <span class="stat-number">2</span>
                                    <span class="stat-label">Active</span>
                                </div>
                            </div>
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

    <!-- Filter Section -->
    <div class="filter-section">
        <div class="container-fluid">
            <div class="filter-card">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="status-filter" class="form-label">
                                <i class="fa fa-filter"></i> Status
                            </label>
                            <select class="form-control" id="status-filter">
                                <option value="all">All Exchanges</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="type-filter" class="form-label">
                                <i class="fa fa-exchange"></i> Type
                            </label>
                            <select class="form-control" id="type-filter">
                                <option value="all">All Types</option>
                                <option value="initiated">Initiated by Me</option>
                                <option value="received">Received Requests</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="date-filter" class="form-label">
                                <i class="fa fa-calendar"></i> Date Range
                            </label>
                            <select class="form-control" id="date-filter">
                                <option value="all">All Time</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="quarter">This Quarter</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-outline-primary btn-block" id="clear-filters">
                                <i class="fa fa-refresh"></i> Clear Filters
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exchanges List -->
    <div class="exchanges-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="exchanges-header">
                        <h3>Recent Exchanges</h3>
                        <div class="view-options">
                            <button class="btn btn-outline-secondary btn-sm active" data-view="grid">
                                <i class="fa fa-th"></i> Grid
                            </button>
                            <button class="btn btn-outline-secondary btn-sm" data-view="list">
                                <i class="fa fa-list"></i> List
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="exchanges-grid">
                <!-- Exchange Card 1 -->
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="exchange-card">
                        <div class="exchange-header">
                            <div class="exchange-users">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="user-avatar">
                                <div class="exchange-arrow">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="user-avatar">
                            </div>
                            <div class="exchange-status">
                                <span class="status-badge active">In Progress</span>
                            </div>
                        </div>
                        <div class="exchange-content">
                            <h4>Web Development for Logo Design</h4>
                            <p>Building a responsive website in exchange for professional logo design services.</p>
                            <div class="exchange-details">
                                <div class="detail-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Started 3 days ago</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-calendar"></i>
                                    <span>Due: Dec 15, 2024</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-star"></i>
                                    <span>Estimated: 20 hours</span>
                                </div>
                            </div>
                            <div class="exchange-tags">
                                <span class="tag">Web Development</span>
                                <span class="tag">Logo Design</span>
                            </div>
                        </div>
                        <div class="exchange-actions">
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> View Details
                            </a>
                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="fa fa-comment"></i> Message
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Exchange Card 2 -->
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="exchange-card">
                        <div class="exchange-header">
                            <div class="exchange-users">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                                <div class="exchange-arrow">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="User" class="user-avatar">
                            </div>
                            <div class="exchange-status">
                                <span class="status-badge pending">Pending</span>
                            </div>
                        </div>
                        <div class="exchange-content">
                            <h4>Content Writing for Social Media</h4>
                            <p>Creating engaging blog content in exchange for social media management.</p>
                            <div class="exchange-details">
                                <div class="detail-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Requested 1 day ago</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-calendar"></i>
                                    <span>Due: Dec 20, 2024</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-star"></i>
                                    <span>Estimated: 15 hours</span>
                                </div>
                            </div>
                            <div class="exchange-tags">
                                <span class="tag">Content Writing</span>
                                <span class="tag">Social Media</span>
                            </div>
                        </div>
                        <div class="exchange-actions">
                            <a href="#" class="btn btn-success btn-sm">
                                <i class="fa fa-check"></i> Accept
                            </a>
                            <a href="#" class="btn btn-danger btn-sm">
                                <i class="fa fa-times"></i> Decline
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Exchange Card 3 -->
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="exchange-card">
                        <div class="exchange-header">
                            <div class="exchange-users">
                                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="User" class="user-avatar">
                                <div class="exchange-arrow">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="User" class="user-avatar">
                            </div>
                            <div class="exchange-status">
                                <span class="status-badge completed">Completed</span>
                            </div>
                        </div>
                        <div class="exchange-content">
                            <h4>UI/UX Design for Photography</h4>
                            <p>Designing a mobile app interface in exchange for professional photography services.</p>
                            <div class="exchange-details">
                                <div class="detail-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span>Completed 1 week ago</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-star"></i>
                                    <span>Rating: 5.0</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fa fa-thumbs-up"></i>
                                    <span>Both parties satisfied</span>
                                </div>
                            </div>
                            <div class="exchange-tags">
                                <span class="tag">UI/UX Design</span>
                                <span class="tag">Photography</span>
                            </div>
                        </div>
                        <div class="exchange-actions">
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i> View Details
                            </a>
                            <a href="#" class="btn btn-outline-success btn-sm">
                                <i class="fa fa-star"></i> Leave Review
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-outline-primary btn-lg" id="load-more">
                        <i class="fa fa-plus"></i> Load More Exchanges
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.my-exchanges-container {
    min-height: 100vh;
    background: #f8f9fa;
}

.my-exchanges-header-section {
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 3rem 0;
    margin-bottom: 2rem;
}

.header-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    z-index: 1;
}

.header-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 2;
}

.my-exchanges-header-content {
    position: relative;
    z-index: 3;
}

.header-content {
    color: white;
}

.header-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.header-stats {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 700;
    color: #14a800;
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

.header-actions {
    text-align: right;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-card {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.form-label i {
    color: #14a800;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.form-control:focus {
    border-color: #14a800;
    box-shadow: 0 0 0 3px rgba(20, 168, 0, 0.1);
    background: white;
}

.exchanges-section {
    padding: 0 1rem;
}

.exchanges-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.exchanges-header h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.view-options {
    display: flex;
    gap: 0.5rem;
}

.exchange-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.exchange-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.exchange-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.exchange-users {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.exchange-arrow {
    color: #14a800;
    font-size: 1.2rem;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.active {
    background: #d4edda;
    color: #155724;
}

.status-badge.pending {
    background: #fff3cd;
    color: #856404;
}

.status-badge.completed {
    background: #d1ecf1;
    color: #0c5460;
}

.exchange-content h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.exchange-content p {
    color: #6c757d;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.exchange-details {
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #6c757d;
}

.detail-item i {
    color: #14a800;
    width: 16px;
}

.exchange-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.tag {
    background: #e9ecef;
    color: #495057;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.exchange-actions {
    display: flex;
    gap: 0.5rem;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    border: none;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(20, 168, 0, 0.3);
}

.btn-outline-primary {
    border: 2px solid #14a800;
    color: #14a800;
}

.btn-outline-primary:hover {
    background: #14a800;
    border-color: #14a800;
    color: white;
}

.btn-success {
    background: #28a745;
    border: none;
}

.btn-danger {
    background: #dc3545;
    border: none;
}

.btn-outline-success {
    border: 2px solid #28a745;
    color: #28a745;
}

.btn-outline-success:hover {
    background: #28a745;
    border-color: #28a745;
    color: white;
}

@media (max-width: 768px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-stats {
        flex-direction: column;
        gap: 1rem;
    }
    
    .header-actions {
        text-align: center;
        margin-top: 1rem;
    }
    
    .exchanges-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .exchange-actions {
        flex-direction: column;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const statusFilter = document.getElementById('status-filter');
    const typeFilter = document.getElementById('type-filter');
    const dateFilter = document.getElementById('date-filter');
    const clearFiltersBtn = document.getElementById('clear-filters');
    
    function applyFilters() {
        // Add your filter logic here
        console.log('Applying filters...');
    }
    
    statusFilter.addEventListener('change', applyFilters);
    typeFilter.addEventListener('change', applyFilters);
    dateFilter.addEventListener('change', applyFilters);
    
    clearFiltersBtn.addEventListener('click', function() {
        statusFilter.value = 'all';
        typeFilter.value = 'all';
        dateFilter.value = 'all';
        applyFilters();
    });
    
    // View toggle functionality
    const viewButtons = document.querySelectorAll('.view-options button');
    const exchangesGrid = document.getElementById('exchanges-grid');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            if (view === 'list') {
                exchangesGrid.classList.add('list-view');
            } else {
                exchangesGrid.classList.remove('list-view');
            }
        });
    });
    
    // Load more functionality
    const loadMoreBtn = document.getElementById('load-more');
    loadMoreBtn.addEventListener('click', function() {
        // Add your load more logic here
        console.log('Loading more exchanges...');
    });
});
</script>

@endsection 