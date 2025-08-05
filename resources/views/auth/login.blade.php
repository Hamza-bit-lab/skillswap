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
    <title>SkillSwap - Login</title>
</head>

<body style="background: #f8f9fa;">

<!-- Login Container -->
<div class="login-container">
    <!-- Header Section -->
    <div class="login-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="login-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-content">
                            <h1 class="header-title">
                                <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                            </h1>
                            <p class="header-subtitle">Welcome back! Sign in to continue your skill exchange journey</p>
                            <div class="header-features">
                                <div class="feature-item">
                                    <i class="fa fa-users"></i>
                                    <span>Connect with skilled professionals</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-exchange"></i>
                                    <span>Exchange skills and services</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-star"></i>
                                    <span>Build your professional network</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="login-form-container">
                            <div class="login-card">
                                <div class="login-card-header">
                                    <h3>Sign In to Your Account</h3>
                                    <p>Enter your credentials to access your dashboard</p>
                                </div>
                                
                                <div class="login-card-body">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fa fa-envelope"></i> Email Address
                                            </label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email address">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="form-label">
                                                <i class="fa fa-lock"></i> Password
                                            </label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">
                                                    Remember me for 30 days
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                <i class="fa fa-sign-in"></i> Sign In
                                            </button>
                                        </div>

                                        <div class="text-center mt-3">
                                            @if (Route::has('password.request'))
                                                <a class="forgot-password-link" href="{{ route('password.request') }}">
                                                    <i class="fa fa-question-circle"></i> Forgot Your Password?
                                                </a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="login-footer">
                                <p class="text-center">
                                    Don't have an account? 
                                    <a href="{{ route('register.step1') }}" class="register-link">
                                        <i class="fa fa-user-plus"></i> Join SkillSwap
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<style>
.login-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.login-header-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
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

.login-header-content {
    position: relative;
    z-index: 3;
    width: 100%;
}

.header-content {
    color: white;
    padding: 2rem 0;
}

.header-title {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.header-subtitle {
    font-size: 1.25rem;
    font-weight: 400;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.header-features {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1.1rem;
    opacity: 0.9;
}

.feature-item i {
    font-size: 1.5rem;
    color: #14a800;
    background: rgba(255,255,255,0.2);
    padding: 0.5rem;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem 0;
}

.login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 100%;
    max-width: 450px;
    margin-bottom: 2rem;
}

.login-card-header {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.login-card-header h3 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.login-card-header p {
    opacity: 0.9;
    margin: 0;
}

.login-card-body {
    padding: 2rem;
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

.form-control::placeholder {
    color: #6c757d;
    opacity: 0.7;
}

.btn-primary {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    border: none;
    border-radius: 10px;
    padding: 0.875rem 1.5rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(20, 168, 0, 0.3);
}

.form-check-label {
    color: #6c757d;
    font-weight: 500;
}

.forgot-password-link {
    color: #14a800;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.forgot-password-link:hover {
    color: #0d7a00;
    text-decoration: none;
}

.login-footer {
    text-align: center;
    color: white;
}

.login-footer p {
    margin: 0;
    font-size: 1.1rem;
    opacity: 0.9;
}

.register-link {
    color: #14a800;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.register-link:hover {
    color: #0d7a00;
    text-decoration: none;
}

@media (max-width: 991px) {
    .header-title {
        font-size: 2.5rem;
    }
    
    .header-subtitle {
        font-size: 1.1rem;
    }
    
    .login-form-container {
        min-height: auto;
        padding: 1rem 0;
    }
    
    .login-card {
        margin: 1rem;
    }
}

@media (max-width: 576px) {
    .header-title {
        font-size: 2rem;
    }
    
    .header-features {
        gap: 0.75rem;
    }
    
    .feature-item {
        font-size: 1rem;
    }
    
    .login-card-header {
        padding: 1.5rem;
    }
    
    .login-card-body {
        padding: 1.5rem;
    }
}
</style>

</body>

</html>
