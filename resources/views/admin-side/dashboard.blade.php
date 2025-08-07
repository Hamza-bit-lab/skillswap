@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Stats Overview -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
            <div class="stat-change positive">+12% this month</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-exchange"></i>
            </div>
            <div class="stat-number">{{ $totalExchanges }}</div>
            <div class="stat-label">Total Exchanges</div>
            <div class="stat-change positive">+8% this month</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-star"></i>
            </div>
            <div class="stat-number">{{ $pendingSkills }}</div>
            <div class="stat-label">Pending Skills</div>
            <div class="stat-change neutral">Needs attention</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-chart-line"></i>
            </div>
            <div class="stat-number">{{ number_format($avgRating, 1) }}</div>
            <div class="stat-label">Average Rating</div>
            <div class="stat-change positive">+0.2 this week</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Quick Actions</h3>
        </div>
        <div class="quick-actions-grid">
            <a href="{{ route('admin.skills') }}" class="quick-action-card">
                <div class="action-icon">
                    <i class="fa fa-star"></i>
                </div>
                <div class="action-content">
                    <h4>Review Skills</h4>
                    <p>{{ $pendingSkills }} skills pending approval</p>
                </div>
                <div class="action-arrow">
                    <i class="fa fa-chevron-right"></i>
                </div>
            </a>
            
            <a href="{{ route('admin.users') }}" class="quick-action-card">
                <div class="action-icon">
                    <i class="fa fa-users"></i>
                </div>
                <div class="action-content">
                    <h4>Manage Users</h4>
                    <p>{{ $newUsersThisWeek }} new users this week</p>
                </div>
                <div class="action-arrow">
                    <i class="fa fa-chevron-right"></i>
                </div>
            </a>
            
            <a href="{{ route('admin.exchanges') }}" class="quick-action-card">
                <div class="action-icon">
                    <i class="fa fa-exchange"></i>
                </div>
                <div class="action-content">
                    <h4>Monitor Exchanges</h4>
                    <p>{{ $activeExchanges }} active exchanges</p>
                </div>
                <div class="action-arrow">
                    <i class="fa fa-chevron-right"></i>
                </div>
            </a>
            
            <a href="{{ route('admin.reports') }}" class="quick-action-card">
                <div class="action-icon">
                    <i class="fa fa-chart-bar"></i>
                </div>
                <div class="action-content">
                    <h4>View Reports</h4>
                    <p>Analytics and insights</p>
                </div>
                <div class="action-arrow">
                    <i class="fa fa-chevron-right"></i>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Activities</h3>
                    <div class="card-actions">
                        <button class="btn-admin btn-secondary">View All</button>
                    </div>
                </div>
                <div class="activity-list">
                    @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-{{ $activity->icon }}"></i>
                        </div>
                        <div class="activity-content">
                            <h5>{{ $activity->title }}</h5>
                            <p>{{ $activity->description }}</p>
                            <span class="activity-time">{{ $activity->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="activity-status">
                            <span class="status-badge status-{{ $activity->status }}">{{ ucfirst($activity->status) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Platform Health</h3>
                </div>
                <div class="health-metrics">
                    <div class="metric-item">
                        <div class="metric-label">User Growth</div>
                        <div class="metric-value positive">+15%</div>
                        <div class="metric-bar">
                            <div class="bar-fill" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-label">Exchange Success</div>
                        <div class="metric-value positive">+8%</div>
                        <div class="metric-bar">
                            <div class="bar-fill" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-label">Response Time</div>
                        <div class="metric-value neutral">2.3s</div>
                        <div class="metric-bar">
                            <div class="bar-fill" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-label">Uptime</div>
                        <div class="metric-value positive">99.9%</div>
                        <div class="metric-bar">
                            <div class="bar-fill" style="width: 99%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Categories & Recent Exchanges -->
    <div class="row">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Top Skill Categories</h3>
                </div>
                <div class="category-stats">
                    @foreach($topCategories as $category)
                    <div class="category-item">
                        <div class="category-info">
                            <div class="category-name">{{ $category->name }}</div>
                            <div class="category-count">{{ $category->skills_count }} skills</div>
                        </div>
                        <div class="category-bar">
                            <div class="bar-fill" style="width: {{ ($category->skills_count / $maxCategoryCount) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Recent Exchanges</h3>
                    <div class="card-actions">
                        <button class="btn-admin btn-secondary">View All</button>
                    </div>
                </div>
                <div class="exchange-list">
                    @foreach($recentExchanges as $exchange)
                    <div class="exchange-item">
                        <div class="exchange-users">
                            <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" alt="User" class="user-avatar">
                            <div class="exchange-arrow">
                                <i class="fa fa-exchange"></i>
                            </div>
                            <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" alt="User" class="user-avatar">
                        </div>
                        <div class="exchange-info">
                            <h5>{{ $exchange->title }}</h5>
                            <p>{{ Str::limit($exchange->description, 50) }}</p>
                            <span class="exchange-time">{{ $exchange->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="exchange-status">
                            <span class="status-badge status-{{ $exchange->status }}">{{ ucfirst($exchange->status) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Dashboard Specific Styles */
    .stat-change {
        font-size: 0.8rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    .stat-change.positive {
        color: #28a745;
    }

    .stat-change.negative {
        color: #dc3545;
    }

    .stat-change.neutral {
        color: #6c757d;
    }

    /* Quick Actions */
    .quick-actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .quick-action-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 12px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .quick-action-card:hover {
        background: white;
        border-color: #14a800;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        text-decoration: none;
        color: #333;
    }

    .action-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .action-content {
        flex: 1;
    }

    .action-content h4 {
        font-size: 1rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }

    .action-content p {
        font-size: 0.8rem;
        color: #6c757d;
        margin: 0;
    }

    .action-arrow {
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .quick-action-card:hover .action-arrow {
        color: #14a800;
        transform: translateX(3px);
    }

    /* Activity List */
    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: white;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        background: #14a800;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
    }

    .activity-content {
        flex: 1;
    }

    .activity-content h5 {
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }

    .activity-content p {
        font-size: 0.8rem;
        color: #6c757d;
        margin: 0 0 0.25rem;
    }

    .activity-time {
        font-size: 0.75rem;
        color: #6c757d;
    }

    /* Health Metrics */
    .health-metrics {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .metric-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .metric-label {
        flex: 1;
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
    }

    .metric-value {
        font-size: 1rem;
        font-weight: 600;
        min-width: 60px;
        text-align: right;
    }

    .metric-value.positive {
        color: #28a745;
    }

    .metric-value.negative {
        color: #dc3545;
    }

    .metric-value.neutral {
        color: #6c757d;
    }

    .metric-bar {
        width: 100px;
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    /* Category Stats */
    .category-stats {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .category-info {
        flex: 1;
    }

    .category-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .category-count {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .category-bar {
        width: 120px;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }

    /* Exchange List */
    .exchange-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .exchange-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .exchange-item:hover {
        background: white;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .exchange-users {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .exchange-users .user-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .exchange-arrow {
        color: #14a800;
        font-size: 0.8rem;
    }

    .exchange-info {
        flex: 1;
    }

    .exchange-info h5 {
        font-size: 0.9rem;
        font-weight: 600;
        margin: 0 0 0.25rem;
    }

    .exchange-info p {
        font-size: 0.8rem;
        color: #6c757d;
        margin: 0 0 0.25rem;
    }

    .exchange-time {
        font-size: 0.75rem;
        color: #6c757d;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .quick-actions-grid {
            grid-template-columns: 1fr;
        }
        
        .activity-item,
        .exchange-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .metric-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .metric-bar {
            width: 100%;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Add any dashboard-specific JavaScript here
document.addEventListener('DOMContentLoaded', function() {
    // Animate stat numbers
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent.replace(/,/g, ''));
        let currentValue = 0;
        const increment = finalValue / 50;
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(timer);
            }
            stat.textContent = Math.floor(currentValue).toLocaleString();
        }, 20);
    });
});
</script>
@endsection 