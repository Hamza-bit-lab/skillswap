<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-header">
        <h5><i class="fa fa-exchange"></i> Quick Actions</h5>
    </div>
    
    <div class="sidebar-content">
        <div class="sidebar-section">
            <h6><i class="fa fa-search"></i> Find Skills</h6>
            <ul class="sidebar-menu">
                <li><a href="{{ route('user.exchanges.discover') }}"><i class="fa fa-search"></i> Discover Skills</a></li>
                <li><a href="{{ route('user.exchanges.search') }}"><i class="fa fa-filter"></i> Advanced Search</a></li>
                <li><a href="{{ route('user.exchanges.recommendations') }}"><i class="fa fa-lightbulb"></i> Recommendations</a></li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <h6><i class="fa fa-gift"></i> Offer Skills</h6>
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fa fa-plus"></i> Add New Skill</a></li>
                <li><a href="#"><i class="fa fa-edit"></i> Edit Skills</a></li>
                <li><a href="#"><i class="fa fa-star"></i> Featured Skills</a></li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <h6><i class="fa fa-exchange"></i> My Exchanges</h6>
            <ul class="sidebar-menu">
                <li><a href="{{ route('user.exchanges.my-exchanges') }}"><i class="fa fa-list"></i> All Exchanges</a></li>
                <li><a href="{{ route('user.exchanges.my-exchanges', ['status' => 'pending']) }}"><i class="fa fa-clock-o"></i> Pending</a></li>
                <li><a href="{{ route('user.exchanges.my-exchanges', ['status' => 'in_progress']) }}"><i class="fa fa-play"></i> In Progress</a></li>
                <li><a href="{{ route('user.exchanges.my-exchanges', ['status' => 'completed']) }}"><i class="fa fa-check-circle"></i> Completed</a></li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <h6><i class="fa fa-comments"></i> Messages</h6>
            <ul class="sidebar-menu">
                <li><a href="{{ route('user.messages') }}"><i class="fa fa-comments"></i> All Conversations</a></li>
                <li><a href="{{ route('user.messages') }}?unread=1"><i class="fa fa-envelope"></i> Unread Messages</a></li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <h6><i class="fa fa-users"></i> Community</h6>
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fa fa-comments"></i> Forums</a></li>
                <li><a href="#"><i class="fa fa-calendar"></i> Events</a></li>
                <li><a href="#"><i class="fa fa-book"></i> Blog</a></li>
                <li><a href="#"><i class="fa fa-trophy"></i> Success Stories</a></li>
            </ul>
        </div>
        
        <div class="sidebar-section">
            <h6><i class="fa fa-chart-line"></i> Statistics</h6>
            <div class="stats-cards">
                <div class="stat-card">
                    <span class="stat-number">12</span>
                    <span class="stat-label">Exchanges</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">4.8</span>
                    <span class="stat-label">Rating</span>
                </div>
            </div>
        </div>
    </div>
</aside> 