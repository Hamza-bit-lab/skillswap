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
    <title>SkillSwap - Verify Email</title>
</head>

<body style="background: #f8f9fa;">

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-6 col-lg-4">
            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Verify your email address</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},

                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                            {{ __('click here to request another') }}
                        </button>.
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    <a href="{{ route('user.dashboard') }}" class="text-primary">Go to Dashboard</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</body>

</html>
