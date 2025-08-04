<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>@yield('title', 'SkillSwap - Exchange Skills, Build Together')</title>
</head>

<body>

<!-- Header starts -->
<header class="main-header">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg main-nav px-0">
                            <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                <i class="fa fa-exchange"></i> SkillSwap
            </a>
            
            <!-- Search Bar -->
            <div class="search-container-header">
                <div class="search-box">
                    <i class="fa fa-search"></i>
                    <input type="text" placeholder="Search for skills, people, or exchanges...">
                </div>
            </div>
            
            <!-- Navigation Menu -->
            <div class="navbar-nav ml-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="exploreDropdown" role="button" data-toggle="dropdown">
                        <i class="fa fa-compass"></i> Explore
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="fa fa-search"></i> Find Skills</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-users"></i> Browse Members</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-exchange"></i> Recent Exchanges</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-star"></i> Featured Skills</a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-toggle="dropdown">
                        <i class="fa fa-users"></i> Community
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="fa fa-comments"></i> Forums</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-calendar"></i> Events</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-book"></i> Blog</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-trophy"></i> Success Stories</a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="helpDropdown" role="button" data-toggle="dropdown">
                        <i class="fa fa-question-circle"></i> Help
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#"><i class="fa fa-info-circle"></i> How It Works</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-shield"></i> Safety Guidelines</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-question"></i> FAQ</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-envelope"></i> Contact Support</a>
                    </div>
                </div>
            </div>
            
            <!-- User Menu -->
            <div class="user-menu">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <h6 class="dropdown-header">Notifications</h6>
                        <a class="dropdown-item" href="#"><i class="fa fa-exchange"></i> New exchange request</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-comment"></i> New message from Sarah</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-star"></i> Exchange completed!</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings</a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="user-avatar-small">
                        <span>{{Auth::user()->username}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('user.profile')}}"><i class="fa fa-user"></i> My Profile</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-exchange"></i> My Exchanges</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-star"></i> My Skills</a>
                        <a class="dropdown-item" href="#"><i class="fa fa-heart"></i> Favorites</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="fa fa-cog"></i> Settings</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<!-- Main Content with Sidebar -->
<div class="main-container">
    <!-- Include Sidebar -->
    @include('user-side.partials.sidebar')

    <!-- Main Content Area -->
    <main class="main-content">
        @yield('content')
    </main>
</div>

<!-- Footer -->


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html> 