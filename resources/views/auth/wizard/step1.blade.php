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
    <title>SkillSwap - Join Us (Step 1)</title>
</head>

<body style="background: #f8f9fa;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <!-- Progress Bar -->
            <div class="wizard-progress mt-4 mb-4">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="progress-steps">
                    <div class="step active">
                        <div class="step-number">1</div>
                        <div class="step-label">Personal Info</div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-label">Education</div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-label">Experience</div>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-label">Skills</div>
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <h1 class="mb-0">
                    <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                </h1>
                <p class="text-muted">Step 1: Personal Information</p>
            </div>
            
            <div class="card shadow">
                <div class="card-body p-4">
                    <div class="alert alert-info mb-4">
                        <i class="fa fa-info-circle"></i>
                        <strong>Welcome to SkillSwap!</strong> Let's start by getting to know you. This information will help other members find you for skill exchanges.
                    </div>

                    <form method="POST" action="{{ route('register.step1.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">{{ __('Username') }} <span class="text-danger">*</span></label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required>
                            <small class="form-text text-muted">This will be your unique identifier on SkillSwap (letters, numbers, and underscores only)</small>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }} <span class="text-danger">*</span></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <small class="form-text text-muted">Minimum 8 characters</small>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">{{ __('Location') }}</label>
                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="City, Country">
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="bio">{{ __('Bio') }}</label>
                            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="3" placeholder="Tell us a bit about yourself, your interests, and what you're looking for in skill exchanges...">{{ old('bio') }}</textarea>
                            @error('bio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block">
                                Next Step <i class="fa fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">Already have an account? 
                    <a href="{{ route('login') }}" class="text-primary">Sign In</a>
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