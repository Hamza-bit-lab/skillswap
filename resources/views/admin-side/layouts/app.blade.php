<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>@yield('title', 'SkillSwap Admin')</title>
</head>

<body>
    <!-- Admin Sidebar -->
    <div class="admin-sidebar">
        <div class="sidebar-header">
            <div class="brand">
                <i class="fa fa-exchange"></i>
                <span>SkillSwap Admin</span>
            </div>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                        <i class="fa fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.skills') }}" class="nav-link {{ request()->routeIs('admin.skills') ? 'active' : '' }}">
                        <i class="fa fa-star"></i>
                        <span>Skills</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.exchanges') }}" class="nav-link {{ request()->routeIs('admin.exchanges') ? 'active' : '' }}">
                        <i class="fa fa-exchange"></i>
                        <span>Exchanges</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reviews') }}" class="nav-link {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
                        <i class="fa fa-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.reports') }}" class="nav-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                        <i class="fa fa-chart-bar"></i>
                        <span>Reports</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                        <i class="fa fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Admin Header -->
    <header class="admin-header">
        <div class="header-content">
            <div class="header-left">
                <button class="sidebar-toggle">
                    <i class="fa fa-bars"></i>
                </button>
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="header-right">
                <div class="admin-user">
                    <div class="user-info">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span class="user-role">Administrator</span>
                    </div>
                    <div class="user-avatar">
                        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.jpg') }}" alt="Admin">
                    </div>
                    <div class="dropdown-menu">
                        <a href="{{ route('user.profile') }}" class="dropdown-item">
                            <i class="fa fa-user"></i> Profile
                        </a>
                        <a href="{{ route('admin.settings') }}" class="dropdown-item">
                            <i class="fa fa-cog"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('logout') }}" class="dropdown-item" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="admin-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <style>
    /* Admin Layout Styles */
    body {
        font-family: 'Inter', sans-serif;
        background: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    /* Sidebar */
    .admin-sidebar {
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        width: 280px;
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        color: white;
        z-index: 1000;
        transition: all 0.3s ease;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar-header {
        padding: 2rem 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 1.5rem;
        font-weight: 700;
        color: #14a800;
    }

    .brand i {
        font-size: 2rem;
    }

    .sidebar-nav {
        padding: 2rem 0;
    }

    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .nav-item {
        margin-bottom: 0.5rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        color: rgba(255,255,255,0.8);
        text-decoration: none;
        transition: all 0.3s ease;
        border-left: 3px solid transparent;
    }

    .nav-link:hover {
        background: rgba(255,255,255,0.1);
        color: white;
        border-left-color: #14a800;
    }

    .nav-link.active {
        background: rgba(20, 168, 0, 0.2);
        color: #14a800;
        border-left-color: #14a800;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
    }

    /* Header */
    .admin-header {
        position: fixed;
        top: 0;
        left: 280px;
        right: 0;
        background: white;
        border-bottom: 1px solid #e9ecef;
        z-index: 999;
        padding: 1rem 2rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .sidebar-toggle {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #6c757d;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    .sidebar-toggle:hover {
        background: #f8f9fa;
        color: #14a800;
    }

    .page-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .admin-user {
        position: relative;
        display: flex;
        align-items: center;
        gap: 1rem;
        cursor: pointer;
        padding: 0.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .admin-user:hover {
        background: #f8f9fa;
    }

    .user-info {
        text-align: right;
    }

    .user-name {
        display: block;
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
    }

    .user-role {
        display: block;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #14a800;
    }

    .user-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 0.5rem 0;
        min-width: 200px;
        display: none;
        z-index: 1000;
    }

    .admin-user:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        color: #333;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .dropdown-item:hover {
        background: #f8f9fa;
        color: #14a800;
        text-decoration: none;
    }

    .dropdown-divider {
        height: 1px;
        background: #e9ecef;
        margin: 0.5rem 0;
    }

    /* Main Content */
    .admin-main {
        margin-left: 280px;
        margin-top: 80px;
        padding: 2rem;
        min-height: calc(100vh - 80px);
    }

    /* Cards */
    .admin-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .admin-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin: 0;
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Buttons */
    .btn-admin {
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(20, 168, 0, 0.3);
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-success {
        background: #28a745;
        color: white;
    }

    .btn-danger {
        background: #dc3545;
        color: white;
    }

    .btn-warning {
        background: #ffc107;
        color: #212529;
    }

    /* Tables */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    .admin-table th {
        background: #f8f9fa;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        color: #333;
        border-bottom: 2px solid #e9ecef;
    }

    .admin-table td {
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
        vertical-align: middle;
    }

    .admin-table tr:hover {
        background: #f8f9fa;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .status-active {
        background: #cce5ff;
        color: #004085;
    }

    .status-completed {
        background: #d1ecf1;
        color: #0c5460;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        text-align: center;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .admin-sidebar {
            transform: translateX(-100%);
        }

        .admin-sidebar.open {
            transform: translateX(0);
        }

        .admin-header {
            left: 0;
        }

        .admin-main {
            margin-left: 0;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
    </style>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    // Sidebar toggle
    document.querySelector('.sidebar-toggle').addEventListener('click', function() {
        document.querySelector('.admin-sidebar').classList.toggle('open');
    });

    // Close sidebar on mobile when clicking outside
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            const sidebar = document.querySelector('.admin-sidebar');
            const toggle = document.querySelector('.sidebar-toggle');
            
            if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        }
    });
    </script>

    @yield('scripts')
</body>

</html> 