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

<!-- Registration Container -->
<div class="registration-container">
    <!-- Header Section -->
    <div class="registration-header-section">
        <div class="header-background">
            <div class="header-overlay"></div>
        </div>
        
        <div class="registration-header-content">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="header-content">
                            <h1 class="header-title">
                                <i class="fa fa-exchange" style="color: #14a800;"></i> SkillSwap
                            </h1>
                            <p class="header-subtitle">Join our community of skilled professionals and start exchanging your expertise</p>
                            <div class="header-features">
                                <div class="feature-item">
                                    <i class="fa fa-users"></i>
                                    <span>Connect with talented professionals</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-exchange"></i>
                                    <span>Exchange skills and services</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fa fa-star"></i>
                                    <span>Build your professional reputation</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="registration-form-container">
                            <!-- Progress Bar -->
                            <div class="wizard-progress mb-4">
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

                            <div class="registration-card">
                                <div class="registration-card-header">
                                    <h3>Step 1: Personal Information</h3>
                                    <p>Let's start by getting to know you better</p>
                                </div>
                                
                                <div class="registration-card-body">
                                    <div class="alert alert-info mb-4">
                                        <i class="fa fa-info-circle"></i>
                                        <strong>Welcome to SkillSwap!</strong> This information will help other members find you for skill exchanges.
                                    </div>

                                    <form method="POST" action="{{ route('register.step1.store') }}" enctype="multipart/form-data">
                                        @csrf

                                        <!-- Avatar Upload Section -->
                                        <div class="form-group text-center mb-4">
                                            <label class="form-label">{{ __('Profile Picture') }}</label>
                                            <div class="avatar-upload-container">
                                                <div class="avatar-preview" id="avatarPreview">
                                                    <img src="{{ asset('assets/images/default-avatar.jpg') }}" alt="Avatar Preview" id="avatarImage" class="avatar-img">
                                                    <div class="avatar-overlay">
                                                        <i class="fa fa-camera"></i>
                                                        <span>Upload Photo</span>
                                                    </div>
                                                </div>
                                                <input type="file" id="avatar" name="avatar" class="avatar-input @error('avatar') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                                                <small class="form-text text-muted">Optional. JPEG or PNG, max 3MB, min 100x100px</small>
                                                @error('avatar')
                                                    <div class="invalid-feedback d-block">
                                                        <strong>{{ $message }}</strong>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fa fa-user"></i> Full Name <span class="text-danger">*</span>
                                            </label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Enter your full name">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="username" class="form-label">
                                                <i class="fa fa-at"></i> Username <span class="text-danger">*</span>
                                            </label>
                                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Choose a unique username">
                                            <small class="form-text text-muted">This will be your unique identifier on SkillSwap (letters, numbers, and underscores only)</small>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fa fa-envelope"></i> Email Address <span class="text-danger">*</span>
                                            </label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter your email address">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="form-label">
                                                <i class="fa fa-lock"></i> Password <span class="text-danger">*</span>
                                            </label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Create a strong password">
                                            <small class="form-text text-muted">Minimum 8 characters</small>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">
                                                <i class="fa fa-lock"></i> Confirm Password <span class="text-danger">*</span>
                                            </label>
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fa fa-phone"></i> Phone Number
                                            </label>
                                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="location" class="form-label">
                                                <i class="fa fa-map-marker"></i> Location
                                            </label>
                                            <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location') }}" placeholder="City, Country">
                                            @error('location')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="bio" class="form-label">
                                                <i class="fa fa-info-circle"></i> Bio
                                            </label>
                                            <textarea id="bio" class="form-control @error('bio') is-invalid @enderror" name="bio" rows="3" placeholder="Tell us a bit about yourself, your interests, and what you're looking for in skill exchanges...">{{ old('bio') }}</textarea>
                                            @error('bio')
                                                <div class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                                Next Step <i class="fa fa-arrow-right ml-2"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="registration-footer">
                                <p class="text-center">
                                    Already have an account? 
                                    <a href="{{ route('login') }}" class="login-link">
                                        <i class="fa fa-sign-in"></i> Sign In
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('avatar');
    const avatarPreview = document.getElementById('avatarPreview');
    const avatarImage = document.getElementById('avatarImage');

    // Handle avatar preview click
    avatarPreview.addEventListener('click', function() {
        avatarInput.click();
    });

    // Handle file selection
    avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a JPEG or PNG image.');
                avatarInput.value = '';
                return;
            }

            // Validate file size (3MB)
            if (file.size > 3 * 1024 * 1024) {
                alert('File size must be less than 3MB.');
                avatarInput.value = '';
                return;
            }

            // Preview the image
            const reader = new FileReader();
            reader.onload = function(e) {
                avatarImage.src = e.target.result;
                avatarPreview.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    // Handle drag and drop
    avatarPreview.addEventListener('dragover', function(e) {
        e.preventDefault();
        avatarPreview.classList.add('drag-over');
    });

    avatarPreview.addEventListener('dragleave', function(e) {
        e.preventDefault();
        avatarPreview.classList.remove('drag-over');
    });

    avatarPreview.addEventListener('drop', function(e) {
        e.preventDefault();
        avatarPreview.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            avatarInput.files = files;
            avatarInput.dispatchEvent(new Event('change'));
        }
    });
});
</script>

<style>
.registration-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    overflow-x: hidden;
}

.registration-header-section {
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

.registration-header-content {
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

.registration-form-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 2rem;
    margin: 0 auto;
    max-width: 100%;
}

.registration-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    overflow: hidden;
    width: 100%;
    max-width: 600px;
    margin: 0 auto 2rem auto;
}

.registration-card-header {
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
    color: white;
    padding: 2rem;
    text-align: center;
}

.registration-card-header h3 {
    font-size: 1.75rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.registration-card-header p {
    opacity: 0.9;
    margin: 0;
}

.registration-card-body {
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

.registration-footer {
    text-align: center;
    color: white;
}

.registration-footer p {
    margin: 0;
    font-size: 1.1rem;
    opacity: 0.9;
}

.login-link {
    color: #14a800;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: #0d7a00;
    text-decoration: none;
}

/* Avatar Upload Styles */
.avatar-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.avatar-preview {
    position: relative;
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
    border: 3px solid #e9ecef;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.avatar-preview:hover {
    border-color: #14a800;
    transform: scale(1.05);
}

.avatar-preview.drag-over {
    border-color: #28a745;
    background-color: #d4edda;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.3s ease;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 12px;
}

.avatar-preview:hover .avatar-overlay {
    opacity: 1;
}

.avatar-preview.has-image .avatar-overlay {
    background: rgba(0, 0, 0, 0.5);
}

.avatar-overlay i {
    font-size: 20px;
    margin-bottom: 5px;
}

.avatar-input {
    display: none;
}

.avatar-preview.has-image {
    border-color: #28a745;
}

/* Progress Bar Styles */
.wizard-progress {
    width: 100%;
    max-width: 600px;
}

.wizard-progress .progress {
    height: 8px;
    border-radius: 10px;
    background-color: rgba(255,255,255,0.3);
    margin-bottom: 20px;
}

.wizard-progress .progress-bar {
    border-radius: 10px;
    transition: width 0.3s ease;
    background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: relative;
}

.progress-steps::before {
    content: '';
    position: absolute;
    top: 15px;
    left: 0;
    right: 0;
    height: 2px;
    background-color: rgba(255,255,255,0.3);
    z-index: 1;
}

.step {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    z-index: 2;
    background: transparent;
    padding: 0 10px;
}

.step-number {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: rgba(255,255,255,0.3);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.step-label {
    font-size: 12px;
    color: rgba(255,255,255,0.8);
    text-align: center;
    font-weight: 500;
    transition: color 0.3s ease;
}

.step.active .step-number {
    background-color: #14a800;
    color: white;
    box-shadow: 0 0 0 3px rgba(20, 168, 0, 0.3);
}

.step.active .step-label {
    color: white;
    font-weight: 600;
}

.step.completed .step-number {
    background-color: #14a800;
    color: white;
}

.step.completed .step-label {
    color: white;
}

@media (max-width: 991px) {
    .header-title {
        font-size: 2.5rem;
    }
    
    .header-subtitle {
        font-size: 1.1rem;
    }
    
    .registration-form-container {
        min-height: auto;
        padding: 1rem;
    }
    
    .registration-card {
        margin: 1rem auto;
        width: calc(100% - 2rem);
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
    
    .registration-form-container {
        padding: 0.5rem;
    }
    
    .registration-card {
        margin: 0.5rem auto;
        width: calc(100% - 1rem);
    }
    
    .registration-card-header {
        padding: 1.5rem;
    }
    
    .registration-card-body {
        padding: 1.5rem;
    }
    
    .avatar-preview {
        width: 100px;
        height: 100px;
    }
}
</style>

</body>

</html>