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
                    <a class="nav-link dropdown-toggle" href="#" id="exploreDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-compass"></i> Explore
                    </a>
                    <div class="dropdown-menu" style="min-width: 200px; padding: 10px; overflow: hidden; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-search" style="margin-right: 8px;"></i> Find Skills
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-users" style="margin-right: 8px;"></i> Browse Members
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-exchange" style="margin-right: 8px;"></i> Recent Exchanges
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-star" style="margin-right: 8px;"></i> Featured Skills
                        </a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-users"></i> Community
                    </a>
                    <div class="dropdown-menu" style="min-width: 200px; padding: 10px; overflow: hidden; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-comments" style="margin-right: 8px;"></i> Forums
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-calendar" style="margin-right: 8px;"></i> Events
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-book" style="margin-right: 8px;"></i> Blog
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-trophy" style="margin-right: 8px;"></i> Success Stories
                        </a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="helpDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-question-circle"></i> Help
                    </a>
                    <div class="dropdown-menu" style="min-width: 200px; padding: 10px; overflow: hidden; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-info-circle" style="margin-right: 8px;"></i> How It Works
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-shield" style="margin-right: 8px;"></i> Safety Guidelines
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-question" style="margin-right: 8px;"></i> FAQ
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-envelope" style="margin-right: 8px;"></i> Contact Support
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- User Menu -->
            <div class="user-menu">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="badge badge-danger">3</span>
                    </a>
                    <div class="dropdown-menu" style="min-width: 300px; max-width: 90vw; padding: 10px; overflow: auto; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transform: translateX(-75%);">
                        <h6 class="dropdown-header" style="padding: 8px 10px; margin: 0; font-size: 14px; color: #333;">Notifications</h6>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-exchange" style="margin-right: 8px;"></i> New exchange request
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-comment" style="margin-right: 8px;"></i> New message from Sarah
                        </a>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-star" style="margin-right: 8px;"></i> Exchange completed!
                        </a>
                        <div class="dropdown-divider" style="margin: 8px 0;"></div>
                        <a class="dropdown-item" href="#" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-cog" style="margin-right: 8px;"></i> Settings
                        </a>
                    </div>
                </div>
                
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="user-avatar-small">
                        <span>{{ Auth::user()->username }}</span>
                    </a>
                    <div class="dropdown-menu" style="min-width: 300px; max-width: 90vw; padding: 10px; overflow: auto; border-radius: 5px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); transform: translateX(-75%);">
                        <a class="dropdown-item" href="{{ route('user.profile') }}" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-user" style="margin-right: 8px;"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="{{ route('user.my-exchanges') }}" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-exchange" style="margin-right: 8px;"></i> My Exchanges
                        </a>
                        <a class="dropdown-item" href="{{ route('user.my-skills') }}" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-star" style="margin-right: 8px;"></i> My Skills
                        </a>
                        <a class="dropdown-item" href="{{ route('user.favorites') }}" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-heart" style="margin-right: 8px;"></i> Favorites
                        </a>
                        <div class="dropdown-divider" style="margin: 8px 0;"></div>
                        <a class="dropdown-item" href="{{ route('user.settings') }}" style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-cog" style="margin-right: 8px;"></i> Settings
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           style="padding: 8px 12px; margin: 5px 0; display: flex; align-items: center; overflow-wrap: break-word; white-space: normal;">
                            <i class="fa fa-sign-out" style="margin-right: 8px;"></i> Logout
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