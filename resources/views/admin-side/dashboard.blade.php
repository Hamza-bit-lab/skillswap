<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <title>SkillSwap Admin - Dashboard</title>
</head>

<body>

<!-- Admin Header -->
<header class="main-header">
    <div class="container">
        <nav class="navbar navbar-expand-lg main-nav px-0">
            <a class="navbar-brand" href="#">
                <i class="fa fa-exchange"></i> SkillSwap Admin
            </a>
            <div class="navbar-nav ml-auto">
                <a href="#" class="nav-link">Dashboard</a>
                <a href="#" class="nav-link">Users</a>
                <a href="#" class="nav-link">Exchanges</a>
                <a href="#" class="nav-link">Reports</a>
                <a href="#" class="nav-link">Settings</a>
            </div>
            <div class="user-menu">
                <button class="btn btn-outline-primary btn-sm">Logout</button>
            </div>
        </nav>
    </div>
</header>

<!-- Admin Dashboard Content -->
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12">
            <h1>Admin Dashboard</h1>
            {{Auth::user()->is_admin}}  
            <p>Welcome to SkillSwap Admin Panel</p>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <h2>1,200</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Active Exchanges</h5>
                    <h2>2,500</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Completed Exchanges</h5>
                    <h2>1,800</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Average Rating</h5>
                    <h2>4.8</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html> 