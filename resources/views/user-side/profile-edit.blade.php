@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Edit Profile')

@section('content')
<!-- CSRF Token Meta Tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="profile-edit-container">
    <!-- Header Section -->
    <div class="edit-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col">
                    <h1 class="edit-title">
                        <i class="fa fa-pencil"></i> Edit Profile
                    </h1>
                    <p class="edit-subtitle">Update your information and preferences</p>
                </div>
                <div class="col-auto">
                    <a href="{{ route('user.profile') }}" class="btn btn-outline-light">
                        <i class="fa fa-arrow-left"></i> Back to Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="edit-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Avatar Section -->
                <div class="col-lg-4">
                    <div class="avatar-section">
                        <div class="avatar-card">
                            <div class="card-header">
                                <h5><i class="fa fa-camera"></i> Profile Picture</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="current-avatar-container">
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                         alt="{{ Auth::user()->name }}" 
                                         class="current-avatar" 
                                         id="currentAvatar">
                                    <div class="avatar-overlay" id="avatarOverlay">
                                        <i class="fa fa-camera"></i>
                                        <span>Change Photo</span>
                                    </div>
                                </div>
                                
                                <form id="avatarForm" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" 
                                           id="avatarInput" 
                                           name="avatar" 
                                           accept="image/jpeg,image/png,image/jpg" 
                                           style="display: none;">
                                </form>
                                
                                <div class="avatar-actions mt-3">
                                    <button type="button" class="btn btn-primary" id="changeAvatarBtn">
                                        <i class="fa fa-upload"></i> Change Avatar
                                    </button>
                                    @if(Auth::user()->avatar)
                                    <button type="button" class="btn btn-outline-danger" id="removeAvatarBtn">
                                        <i class="fa fa-trash"></i> Remove
                                    </button>
                                    @endif
                                </div>
                                
                                <small class="text-muted mt-2 d-block">
                                    JPEG or PNG, max 3MB, min 100x100px
                                </small>
                                
                                <div id="avatarProgress" class="progress mt-3" style="display: none;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Stats -->
                        <div class="stats-card mt-4">
                            <div class="card-header">
                                <h5><i class="fa fa-chart-bar"></i> Profile Stats</h5>
                            </div>
                            <div class="card-body">
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-value">{{ number_format(Auth::user()->getAverageRating(), 1) }}</span>
                                        <span class="stat-label">Rating</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fa fa-exchange"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-value">{{ Auth::user()->getTotalExchangesCount() }}</span>
                                        <span class="stat-label">Exchanges</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fa fa-cogs"></i>
                                    </div>
                                    <div class="stat-info">
                                        <span class="stat-value">{{ Auth::user()->skills()->count() }}</span>
                                        <span class="stat-label">Skills</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="col-lg-8">
                    <form action="{{ route('user.profile.update') }}" method="POST" id="profileForm" class="profile-form">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Card -->
                        <div class="form-card">
                            <div class="card-header">
                                <h5><i class="fa fa-user"></i> Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fa fa-user"></i> Full Name <span class="required">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('name') is-invalid @enderror" 
                                                   id="name" 
                                                   name="name" 
                                                   value="{{ old('name', Auth::user()->name) }}" 
                                                   required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label">
                                                <i class="fa fa-at"></i> Username <span class="required">*</span>
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('username') is-invalid @enderror" 
                                                   id="username" 
                                                   name="username" 
                                                   value="{{ old('username', Auth::user()->username) }}" 
                                                   required>
                                            @error('username')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fa fa-envelope"></i> Email Address <span class="required">*</span>
                                            </label>
                                            <input type="email" 
                                                   class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" 
                                                   name="email" 
                                                   value="{{ old('email', Auth::user()->email) }}" 
                                                   required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fa fa-phone"></i> Phone Number
                                            </label>
                                            <input type="tel" 
                                                   class="form-control @error('phone') is-invalid @enderror" 
                                                   id="phone" 
                                                   name="phone" 
                                                   value="{{ old('phone', Auth::user()->phone) }}"
                                                   placeholder="+1 (555) 123-4567">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="location" class="form-label">
                                                <i class="fa fa-map-marker"></i> Location
                                            </label>
                                            <input type="text" 
                                                   class="form-control @error('location') is-invalid @enderror" 
                                                   id="location" 
                                                   name="location" 
                                                   value="{{ old('location', Auth::user()->location) }}"
                                                   placeholder="City, Country">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About Me Card -->
                        <div class="form-card">
                            <div class="card-header">
                                <h5><i class="fa fa-info-circle"></i> About Me</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="bio" class="form-label">
                                        <i class="fa fa-pencil"></i> Bio
                                    </label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" 
                                              id="bio" 
                                              name="bio" 
                                              rows="4"
                                              placeholder="Tell us about yourself, your skills, interests, and what you're looking to learn or teach...">{{ old('bio', Auth::user()->bio) }}</textarea>
                                    <small class="form-text text-muted">
                                        <span id="bioCount">{{ strlen(Auth::user()->bio ?? '') }}</span>/1000 characters
                                    </small>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social Links Card -->
                        <div class="form-card">
                            <div class="card-header">
                                <h5><i class="fa fa-share-alt"></i> Social Links</h5>
                                <small class="text-muted">Connect your social profiles</small>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website" class="form-label">
                                                <i class="fa fa-globe"></i> Website
                                            </label>
                                            <input type="url" 
                                                   class="form-control @error('website') is-invalid @enderror" 
                                                   id="website" 
                                                   name="website" 
                                                   value="{{ old('website', Auth::user()->website) }}"
                                                   placeholder="https://yourwebsite.com">
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="linkedin" class="form-label">
                                                <i class="fa fa-linkedin"></i> LinkedIn
                                            </label>
                                            <input type="url" 
                                                   class="form-control @error('linkedin') is-invalid @enderror" 
                                                   id="linkedin" 
                                                   name="linkedin" 
                                                   value="{{ old('linkedin', Auth::user()->linkedin) }}"
                                                   placeholder="https://linkedin.com/in/username">
                                            @error('linkedin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="github" class="form-label">
                                                <i class="fa fa-github"></i> GitHub
                                            </label>
                                            <input type="url" 
                                                   class="form-control @error('github') is-invalid @enderror" 
                                                   id="github" 
                                                   name="github" 
                                                   value="{{ old('github', Auth::user()->github) }}"
                                                   placeholder="https://github.com/username">
                                            @error('github')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter" class="form-label">
                                                <i class="fa fa-twitter"></i> Twitter
                                            </label>
                                            <input type="url" 
                                                   class="form-control @error('twitter') is-invalid @enderror" 
                                                   id="twitter" 
                                                   name="twitter" 
                                                   value="{{ old('twitter', Auth::user()->twitter) }}"
                                                   placeholder="https://twitter.com/username">
                                            @error('twitter')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-save"></i> Save Changes
                            </button>
                            <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary btn-lg">
                                <i class="fa fa-times"></i> Cancel
                            </a>
                            <button type="button" class="btn btn-outline-warning btn-lg" id="resetForm">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
    <i class="fa fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show floating-alert" role="alert">
    <i class="fa fa-exclamation-circle"></i> {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
</div>
@endif

<style>
/* Profile Edit Container */
.profile-edit-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Header Section */
.edit-header {
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
    padding: 40px 0;
    color: #fff;
}

.edit-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.edit-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 5px 0 0;
}

/* Content Section */
.edit-content {
    padding: 40px 0;
    background: #f8f9fa;
    min-height: calc(100vh - 140px);
}

/* Avatar Section */
.avatar-section .avatar-card,
.avatar-section .stats-card,
.form-card {
    background: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 30px;
}

.avatar-card .card-header,
.stats-card .card-header,
.form-card .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 20px;
    border: none;
}

.avatar-card .card-header h5,
.stats-card .card-header h5,
.form-card .card-header h5 {
    margin: 0;
    font-weight: 600;
}

.avatar-card .card-body,
.stats-card .card-body,
.form-card .card-body {
    padding: 30px;
}

/* Current Avatar */
.current-avatar-container {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.current-avatar {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #fff;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #fff;
    opacity: 0;
    transition: opacity 0.3s ease;
    cursor: pointer;
}

.current-avatar-container:hover .avatar-overlay {
    opacity: 1;
}

.avatar-overlay i {
    font-size: 24px;
    margin-bottom: 5px;
}

.avatar-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
    flex-wrap: wrap;
}

/* Stats Card */
.stat-item {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #eee;
}

.stat-item:last-child {
    border-bottom: none;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    margin-right: 15px;
}

.stat-info {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: #333;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
}

/* Form Styling */
.profile-form {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label i {
    color: #667eea;
    width: 16px;
}

.required {
    color: #dc3545;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    display: block;
    font-size: 0.875rem;
    color: #dc3545;
    margin-top: 5px;
}

/* Textarea Character Count */
#bioCount {
    font-weight: 600;
    color: #667eea;
}

/* Action Buttons */
.form-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    padding: 30px 0;
    flex-wrap: wrap;
}

.form-actions .btn {
    border-radius: 25px;
    padding: 12px 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.form-actions .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.form-actions .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

/* Progress Bar */
.progress {
    height: 8px;
    border-radius: 10px;
    background: #e9ecef;
}

.progress-bar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    transition: width 0.3s ease;
}

/* Floating Alerts */
.floating-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1050;
    min-width: 300px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

/* Responsive Design */
@media (max-width: 768px) {
    .edit-title {
        font-size: 2rem;
    }
    
    .current-avatar {
        width: 120px;
        height: 120px;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn {
        width: 100%;
    }
    
    .avatar-actions {
        flex-direction: column;
    }
    
    .avatar-actions .btn {
        width: 100%;
    }
}

@media (max-width: 576px) {
    .edit-header {
        padding: 30px 0;
    }
    
    .edit-content {
        padding: 20px 0;
    }
    
    .avatar-card .card-body,
    .stats-card .card-body,
    .form-card .card-body {
        padding: 20px;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar Upload Functionality
    const changeAvatarBtn = document.getElementById('changeAvatarBtn');
    const avatarInput = document.getElementById('avatarInput');
    const currentAvatar = document.getElementById('currentAvatar');
    const avatarOverlay = document.getElementById('avatarOverlay');
    const avatarProgress = document.getElementById('avatarProgress');
    const removeAvatarBtn = document.getElementById('removeAvatarBtn');

    // Change Avatar Button Click
    changeAvatarBtn.addEventListener('click', function() {
        avatarInput.click();
    });

    // Avatar Overlay Click
    avatarOverlay.addEventListener('click', function() {
        avatarInput.click();
    });

    // Avatar File Selection
    avatarInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        if (file) {
            // Validate file
            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a JPEG or PNG image.');
                return;
            }

            if (file.size > 3 * 1024 * 1024) {
                alert('File size must be less than 3MB.');
                return;
            }

            // Preview image
            const reader = new FileReader();
            reader.onload = function(e) {
                currentAvatar.src = e.target.result;
            };
            reader.readAsDataURL(file);

            // Upload avatar
            uploadAvatar(file);
        }
    });

    // Upload Avatar Function
    function uploadAvatar(file) {
        const formData = new FormData();
        formData.append('avatar', file);

        // Show progress
        avatarProgress.style.display = 'block';
        const progressBar = avatarProgress.querySelector('.progress-bar');

        fetch('{{ route("user.profile.avatar") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update avatar
                currentAvatar.src = data.avatar_url;
                showAlert('Avatar updated successfully!', 'success');
                
                // Add remove button if it doesn't exist
                if (!removeAvatarBtn && data.avatar_url) {
                    setTimeout(() => {
                        location.reload(); // Reload to show remove button
                    }, 1000);
                }
            } else {
                showAlert(data.message || 'Failed to update avatar', 'error');
                console.error('Avatar update failed:', data);
            }
        })
        .catch(error => {
            console.error('Error uploading avatar:', error);
            showAlert('Failed to update avatar. Please try again.', 'error');
        })
        .finally(() => {
            avatarProgress.style.display = 'none';
            progressBar.style.width = '0%';
        });

        // Simulate progress
        let progress = 0;
        const interval = setInterval(() => {
            progress += 10;
            progressBar.style.width = progress + '%';
            if (progress >= 90) {
                clearInterval(interval);
            }
        }, 100);
    }

    // Remove Avatar
    if (removeAvatarBtn) {
        removeAvatarBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Remove Avatar?',
                text: 'Are you sure you want to remove your avatar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    currentAvatar.src = '{{ asset("assets/images/default-avatar.jpg") }}';
                    showAlert('Avatar removed successfully!', 'success');
                    // You might want to make an API call here to actually remove the avatar from the server
                }
            });
        });
    }

    // Bio Character Count
    const bioTextarea = document.getElementById('bio');
    const bioCount = document.getElementById('bioCount');
    
    bioTextarea.addEventListener('input', function() {
        const count = this.value.length;
        bioCount.textContent = count;
        
        if (count > 1000) {
            bioCount.style.color = '#dc3545';
        } else if (count > 800) {
            bioCount.style.color = '#ffc107';
        } else {
            bioCount.style.color = '#667eea';
        }
    });

    // Reset Form
    const resetFormBtn = document.getElementById('resetForm');
    resetFormBtn.addEventListener('click', function() {
        Swal.fire({
            title: 'Reset Changes?',
            text: 'Are you sure you want to reset all changes?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, reset!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('profileForm').reset();
                bioCount.textContent = '{{ strlen(Auth::user()->bio ?? "") }}';
            }
        });
    });

    // Show Alert Function
    function showAlert(message, type) {
        const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
        const iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        const alert = document.createElement('div');
        alert.className = `alert ${alertClass} alert-dismissible fade show floating-alert`;
        alert.innerHTML = `
            <i class="fa ${iconClass}"></i> ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(alert);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            alert.remove();
        }, 5000);
    }

    // Form Validation Enhancement
    const form = document.getElementById('profileForm');
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        // Check required fields
        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showAlert('Please fill in all required fields', 'error');
        }
    });
});
</script>
@endsection
