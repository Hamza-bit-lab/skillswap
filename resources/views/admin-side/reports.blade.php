@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Reports & Analytics')
@section('page-title', 'Reports & Analytics')

@section('content')
    <!-- Reports Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-chart-line"></i>
            </div>
            <div class="stat-number">{{ $growthRate }}%</div>
            <div class="stat-label">Growth Rate</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-number">{{ $activeUsers }}</div>
            <div class="stat-label">Active Users</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-exchange"></i>
            </div>
            <div class="stat-number">{{ $successRate }}%</div>
            <div class="stat-label">Success Rate</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-star"></i>
            </div>
            <div class="stat-number">{{ $avgRating }}</div>
            <div class="stat-label">Avg Rating</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-lg-8">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Platform Growth</h3>
                    <div class="card-actions">
                        <select class="form-control" id="chartPeriod">
                            <option value="7">Last 7 Days</option>
                            <option value="30" selected>Last 30 Days</option>
                            <option value="90">Last 90 Days</option>
                            <option value="365">Last Year</option>
                        </select>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="growthChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Top Categories</h3>
                </div>
                <div class="chart-container">
                    <canvas id="categoriesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Grid -->
    <div class="row">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">User Demographics</h3>
                </div>
                <div class="analytics-grid">
                    <div class="analytics-item">
                        <div class="analytics-label">Age Groups</div>
                        <div class="analytics-chart">
                            <div class="chart-bar">
                                <div class="bar-label">18-25</div>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 35%"></div>
                                </div>
                                <div class="bar-value">35%</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-label">26-35</div>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 45%"></div>
                                </div>
                                <div class="bar-value">45%</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-label">36-45</div>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 15%"></div>
                                </div>
                                <div class="bar-value">15%</div>
                            </div>
                            <div class="chart-bar">
                                <div class="bar-label">46+</div>
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: 5%"></div>
                                </div>
                                <div class="bar-value">5%</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="analytics-item">
                        <div class="analytics-label">Geographic Distribution</div>
                        <div class="analytics-list">
                            <div class="list-item">
                                <span class="country">United States</span>
                                <span class="percentage">40%</span>
                            </div>
                            <div class="list-item">
                                <span class="country">United Kingdom</span>
                                <span class="percentage">25%</span>
                            </div>
                            <div class="list-item">
                                <span class="country">Canada</span>
                                <span class="percentage">15%</span>
                            </div>
                            <div class="list-item">
                                <span class="country">Australia</span>
                                <span class="percentage">10%</span>
                            </div>
                            <div class="list-item">
                                <span class="country">Others</span>
                                <span class="percentage">10%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Exchange Performance</h3>
                </div>
                <div class="performance-metrics">
                    <div class="metric-item">
                        <div class="metric-icon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="metric-content">
                            <div class="metric-value">2.3 days</div>
                            <div class="metric-label">Average Exchange Duration</div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="metric-content">
                            <div class="metric-value">4.8/5</div>
                            <div class="metric-label">Average User Satisfaction</div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-icon">
                            <i class="fa fa-repeat"></i>
                        </div>
                        <div class="metric-content">
                            <div class="metric-value">78%</div>
                            <div class="metric-label">Repeat Exchange Rate</div>
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="metric-content">
                            <div class="metric-value">1,250</div>
                            <div class="metric-label">Active Exchanges This Week</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="row">
        <div class="col-lg-12">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Detailed Reports</h3>
                    <div class="card-actions">
                        <button class="btn-admin btn-primary" onclick="generateReport('users')">
                            <i class="fa fa-download"></i> Users Report
                        </button>
                        <button class="btn-admin btn-primary" onclick="generateReport('exchanges')">
                            <i class="fa fa-download"></i> Exchanges Report
                        </button>
                        <button class="btn-admin btn-primary" onclick="generateReport('skills')">
                            <i class="fa fa-download"></i> Skills Report
                        </button>
                        <button class="btn-admin btn-primary" onclick="generateReport('revenue')">
                            <i class="fa fa-download"></i> Revenue Report
                        </button>
                    </div>
                </div>
                
                <div class="reports-table">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Report Type</th>
                                <th>Last Generated</th>
                                <th>Records</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Monthly Users Report</td>
                                <td>{{ now()->subDays(2)->format('M d, Y H:i') }}</td>
                                <td>1,250 records</td>
                                <td><span class="status-badge status-approved">Ready</span></td>
                                <td>
                                    <button class="btn-admin btn-sm btn-primary">Download</button>
                                    <button class="btn-admin btn-sm btn-secondary">Regenerate</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Exchange Analytics</td>
                                <td>{{ now()->subDays(5)->format('M d, Y H:i') }}</td>
                                <td>2,500 records</td>
                                <td><span class="status-badge status-approved">Ready</span></td>
                                <td>
                                    <button class="btn-admin btn-sm btn-primary">Download</button>
                                    <button class="btn-admin btn-sm btn-secondary">Regenerate</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Skills Performance</td>
                                <td>{{ now()->subDays(1)->format('M d, Y H:i') }}</td>
                                <td>3,200 records</td>
                                <td><span class="status-badge status-pending">Processing</span></td>
                                <td>
                                    <button class="btn-admin btn-sm btn-warning" disabled>Processing...</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Revenue Analysis</td>
                                <td>{{ now()->subDays(7)->format('M d, Y H:i') }}</td>
                                <td>850 records</td>
                                <td><span class="status-badge status-approved">Ready</span></td>
                                <td>
                                    <button class="btn-admin btn-sm btn-primary">Download</button>
                                    <button class="btn-admin btn-sm btn-secondary">Regenerate</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Real-time Analytics -->
    <div class="row">
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">Real-time Activity</h3>
                </div>
                <div class="realtime-activity">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">New user registered: John Doe</div>
                            <div class="activity-time">2 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">Exchange completed: Web Development ↔ Graphic Design</div>
                            <div class="activity-time">5 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">New skill added: Mobile App Development</div>
                            <div class="activity-time">8 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-comment"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">New review posted: 5-star rating</div>
                            <div class="activity-time">12 minutes ago</div>
                        </div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">Exchange initiated: Photography ↔ Video Editing</div>
                            <div class="activity-time">15 minutes ago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="card-header">
                    <h3 class="card-title">System Health</h3>
                </div>
                <div class="system-health">
                    <div class="health-item">
                        <div class="health-label">Server Response Time</div>
                        <div class="health-value positive">125ms</div>
                        <div class="health-bar">
                            <div class="health-fill" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="health-item">
                        <div class="health-label">Database Performance</div>
                        <div class="health-value positive">98%</div>
                        <div class="health-bar">
                            <div class="health-fill" style="width: 98%"></div>
                        </div>
                    </div>
                    
                    <div class="health-item">
                        <div class="health-label">Uptime</div>
                        <div class="health-value positive">99.9%</div>
                        <div class="health-bar">
                            <div class="health-fill" style="width: 99%"></div>
                        </div>
                    </div>
                    
                    <div class="health-item">
                        <div class="health-label">Active Connections</div>
                        <div class="health-value neutral">1,247</div>
                        <div class="health-bar">
                            <div class="health-fill" style="width: 65%"></div>
                        </div>
                    </div>
                    
                    <div class="health-item">
                        <div class="health-label">Storage Usage</div>
                        <div class="health-value warning">78%</div>
                        <div class="health-bar">
                            <div class="health-fill warning" style="width: 78%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Reports Specific Styles */
    .chart-container {
        position: relative;
        height: 300px;
        margin-top: 1rem;
    }

    .analytics-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }

    .analytics-item {
        margin-bottom: 1.5rem;
    }

    .analytics-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 1rem;
    }

    .chart-bar {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .bar-label {
        min-width: 60px;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .bar-container {
        flex: 1;
        height: 8px;
        background: #e9ecef;
        border-radius: 4px;
        overflow: hidden;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .bar-value {
        min-width: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #333;
        text-align: right;
    }

    .analytics-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .list-item:last-child {
        border-bottom: none;
    }

    .country {
        font-size: 0.9rem;
        color: #333;
    }

    .percentage {
        font-weight: 600;
        color: #14a800;
    }

    .performance-metrics {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .metric-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .metric-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .metric-content {
        flex: 1;
    }

    .metric-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .metric-label {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .realtime-activity {
        max-height: 400px;
        overflow-y: auto;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-bottom: 1px solid #f8f9fa;
        transition: all 0.3s ease;
    }

    .activity-item:hover {
        background: #f8f9fa;
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

    .activity-text {
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .activity-time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .system-health {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .health-item {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .health-label {
        flex: 1;
        font-size: 0.9rem;
        color: #333;
        font-weight: 500;
    }

    .health-value {
        min-width: 80px;
        font-weight: 600;
        text-align: right;
    }

    .health-value.positive {
        color: #28a745;
    }

    .health-value.warning {
        color: #ffc107;
    }

    .health-value.negative {
        color: #dc3545;
    }

    .health-value.neutral {
        color: #6c757d;
    }

    .health-bar {
        width: 120px;
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }

    .health-fill {
        height: 100%;
        background: #28a745;
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .health-fill.warning {
        background: #ffc107;
    }

    .health-fill.negative {
        background: #dc3545;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .analytics-grid {
            grid-template-columns: 1fr;
        }
        
        .performance-metrics {
            grid-template-columns: 1fr;
        }
        
        .chart-container {
            height: 250px;
        }
    }
    </style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Initialize charts
document.addEventListener('DOMContentLoaded', function() {
    // Growth Chart
    const growthCtx = document.getElementById('growthChart').getContext('2d');
    const growthChart = new Chart(growthCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Users',
                data: [1200, 1350, 1500, 1650, 1800, 1950, 2100, 2250, 2400, 2550, 2700, 2850],
                borderColor: '#14a800',
                backgroundColor: 'rgba(20, 168, 0, 0.1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Exchanges',
                data: [800, 950, 1100, 1250, 1400, 1550, 1700, 1850, 2000, 2150, 2300, 2450],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Categories Chart
    const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
    const categoriesChart = new Chart(categoriesCtx, {
        type: 'doughnut',
        data: {
            labels: ['Development', 'Design', 'Marketing', 'Writing', 'Photography', 'Video', 'Business', 'Other'],
            datasets: [{
                data: [35, 25, 15, 10, 8, 5, 2, 0],
                backgroundColor: [
                    '#14a800',
                    '#007bff',
                    '#ffc107',
                    '#dc3545',
                    '#6f42c1',
                    '#fd7e14',
                    '#20c997',
                    '#6c757d'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Update chart period
    document.getElementById('chartPeriod').addEventListener('change', function() {
        const period = this.value;
        // Update chart data based on selected period
        updateChartData(period);
    });
});

// Update chart data based on period
function updateChartData(period) {
    // This would typically fetch new data from the server
    console.log('Updating chart data for period:', period);
}

// Generate reports
function generateReport(type) {
    const loadingText = {
        'users': 'Generating Users Report...',
        'exchanges': 'Generating Exchanges Report...',
        'skills': 'Generating Skills Report...',
        'revenue': 'Generating Revenue Report...'
    };

    if (confirm(`Are you sure you want to generate the ${type} report?`)) {
        // Show loading state
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Generating...';
        button.disabled = true;

        // Simulate API call
        setTimeout(() => {
            button.innerHTML = originalText;
            button.disabled = false;
            alert(`${loadingText[type]} Report generated successfully!`);
        }, 2000);
    }
}

// Real-time updates simulation
setInterval(() => {
    // Simulate real-time activity updates
    const activities = [
        'New user registered: Sarah Johnson',
        'Exchange completed: Logo Design ↔ Website Development',
        'New skill added: Digital Marketing',
        'New review posted: 4-star rating',
        'Exchange initiated: Content Writing ↔ Social Media Management'
    ];
    
    const randomActivity = activities[Math.floor(Math.random() * activities.length)];
    
    // Add new activity to the list (in a real app, this would come from WebSocket)
    console.log('New activity:', randomActivity);
}, 30000); // Update every 30 seconds
</script>
@endsection 