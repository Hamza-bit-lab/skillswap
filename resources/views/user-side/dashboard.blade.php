@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Dashboard')

@section('content')

@if(session('success'))
    <div class="container-fluid mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="dashboard-title">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="dashboard-subtitle">Here's what's happening with your skill exchanges</p>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('user.exchanges') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Start New Exchange
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Stats -->
<div class="dashboard-stats">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content -->
<div class="dashboard-content">
    <div class="container-fluid">
        <div class="row">
            <!-- Recent Exchanges -->
            <div class="col-lg-8">
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3>Recent Exchanges</h3>
                        <a href="{{ route('user.exchanges') }}" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>
                    
                    <div class="exchanges-list">
                        <!-- Exchange Item 1 -->
                        <div class="exchange-item">
                            <div class="exchange-info">
                                <div class="exchange-users">
                                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                                    <div class="exchange-arrow">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="user-avatar">
                                </div>
                                <div class="exchange-details">
                                    <h4>Website Development for Logo Design</h4>
                                    <p>I need a website for my photography business. In exchange, I can provide professional logo design services.</p>
                                    <div class="exchange-tags">
                                        <span class="tag">Web Development</span>
                                        <span class="tag">Logo Design</span>
                                    </div>
                                </div>
                            </div>
                            <div class="exchange-status active">
                                <span class="status-badge">In Progress</span>
                                <span class="exchange-date">Started 2 days ago</span>
                            </div>
                        </div>

                        <!-- Exchange Item 2 -->
                        <div class="exchange-item">
                            <div class="exchange-info">
                                <div class="exchange-users">
                                    <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="User" class="user-avatar">
                                    <div class="exchange-arrow">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="user-avatar">
                                </div>
                                <div class="exchange-details">
                                    <h4>Content Writing for SEO Optimization</h4>
                                    <p>Looking for content writing services for my blog. I can help with SEO optimization and digital marketing.</p>
                                    <div class="exchange-tags">
                                        <span class="tag">Content Writing</span>
                                        <span class="tag">SEO</span>
                                    </div>
                                </div>
                            </div>
                            <div class="exchange-status pending">
                                <span class="status-badge">Pending</span>
                                <span class="exchange-date">Created 1 week ago</span>
                            </div>
                        </div>

                        <!-- Exchange Item 3 -->
                        <div class="exchange-item">
                            <div class="exchange-info">
                                <div class="exchange-users">
                                    <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="User" class="user-avatar">
                                    <div class="exchange-arrow">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="user-avatar">
                                </div>
                                <div class="exchange-details">
                                    <h4>UI/UX Design for Data Analysis</h4>
                                    <p>Need UI/UX design for my analytics dashboard. I can provide data analysis and Python development.</p>
                                    <div class="exchange-tags">
                                        <span class="tag">UI/UX Design</span>
                                        <span class="tag">Data Analysis</span>
                                    </div>
                                </div>
                            </div>
                            <div class="exchange-status completed">
                                <span class="status-badge">Completed</span>
                                <span class="exchange-date">Finished 3 days ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3>Recent Messages</h3>
                        <a href="{{ route('user.messages') }}" class="btn btn-outline-primary btn-sm">View All</a>
                    </div>
                    
                    <div class="messages-list">
                        <div class="message-item unread">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="message-avatar">
                            <div class="message-content">
                                <h5>Sarah Johnson</h5>
                                <p>Hi! I'm interested in your web development skills. Would you like to exchange for my logo design services?</p>
                                <span class="message-time">2 hours ago</span>
                            </div>
                            <div class="message-status">
                                <span class="unread-badge"></span>
                            </div>
                        </div>

                        <div class="message-item">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="message-avatar">
                            <div class="message-content">
                                <h5>Mike Chen</h5>
                                <p>Thanks for the great work on the website! The exchange was perfect.</p>
                                <span class="message-time">1 day ago</span>
                            </div>
                        </div>

                        <div class="message-item">
                            <img src="https://randomuser.me/api/portraits/women/23.jpg" alt="User" class="message-avatar">
                            <div class="message-content">
                                <h5>Maria Garcia</h5>
                                <p>When can we start working on the content writing project?</p>
                                <span class="message-time">3 days ago</span>
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
                        <h3>Quick Actions</h3>
                    </div>
                    
                    <div class="quick-actions">
                        <a href="{{ route('user.skills') }}" class="action-btn">
                            <i class="fa fa-plus"></i>
                            <span>Add New Skill</span>
                        </a>
                        <a href="{{ route('user.exchanges') }}" class="action-btn">
                            <i class="fa fa-search"></i>
                            <span>Find Exchanges</span>
                        </a>
                        <a href="{{ route('user.profile') }}" class="action-btn">
                            <i class="fa fa-user"></i>
                            <span>Update Profile</span>
                        </a>
                        <a href="{{ route('user.messages') }}" class="action-btn">
                            <i class="fa fa-envelope"></i>
                            <span>Send Message</span>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3>Recent Activity</h3>
                    </div>
                    
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fa fa-star"></i>
                            </div>
                            <div class="activity-content">
                                <p>Received 5-star review from Sarah Johnson</p>
                                <span class="activity-time">2 hours ago</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <div class="activity-content">
                                <p>Started new exchange with Mike Chen</p>
                                <span class="activity-time">1 day ago</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="activity-content">
                                <p>Completed exchange with Emma Davis</p>
                                <span class="activity-time">3 days ago</span>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fa fa-plus"></i>
                            </div>
                            <div class="activity-content">
                                <p>Added new skill: React Development</p>
                                <span class="activity-time">1 week ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skill Recommendations -->
                <div class="dashboard-section">
                    <div class="section-header">
                        <h3>Recommended Skills</h3>
                    </div>
                    
                    <div class="skill-recommendations">
                        <div class="skill-recommendation">
                            <div class="skill-icon">
                                <i class="fa fa-code"></i>
                            </div>
                            <div class="skill-info">
                                <h5>Python Development</h5>
                                <p>High demand in your area</p>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">Add</button>
                        </div>

                        <div class="skill-recommendation">
                            <div class="skill-icon">
                                <i class="fa fa-paint-brush"></i>
                            </div>
                            <div class="skill-info">
                                <h5>UI/UX Design</h5>
                                <p>Matches your profile well</p>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">Add</button>
                        </div>

                        <div class="skill-recommendation">
                            <div class="skill-icon">
                                <i class="fa fa-bullhorn"></i>
                            </div>
                            <div class="skill-info">
                                <h5>Digital Marketing</h5>
                                <p>Popular in your network</p>
                            </div>
                            <button class="btn btn-sm btn-outline-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 