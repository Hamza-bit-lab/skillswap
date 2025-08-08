@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Settings')

@section('content')

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show floating-alert" role="alert">
            <i class="fa fa-check-circle mr-2"></i>
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif

<!-- Settings Container -->
<div class="settings-container">
    <!-- Header Section -->
    <div class="settings-header">
        <div class="container">
            <div class="header-content">
                <div class="header-info">
                    <h1 class="header-title">
                        <i class="fa fa-cog"></i> Account Settings
                    </h1>
                    <p class="header-subtitle">Manage your account preferences and security settings</p>
                </div>
                <div class="header-actions">
                    <button class="btn btn-primary" onclick="saveAllSettings()">
                        <i class="fa fa-save"></i> Save All Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Settings Content -->
    <div class="settings-section">
        <div class="container-fluid">
            <div class="settings-layout">
                <!-- Settings Navigation -->
                <div class="settings-nav">
                    <div class="nav-item active" data-tab="profile">
                        <i class="fa fa-user"></i>
                        <span>Profile Settings</span>
                    </div>
                    <div class="nav-item" data-tab="security">
                        <i class="fa fa-shield"></i>
                        <span>Security</span>
                    </div>
                    <div class="nav-item" data-tab="notifications">
                        <i class="fa fa-bell"></i>
                        <span>Notifications</span>
                    </div>
                    <div class="nav-item" data-tab="privacy">
                        <i class="fa fa-lock"></i>
                        <span>Privacy</span>
                    </div>
                    <div class="nav-item" data-tab="preferences">
                        <i class="fa fa-cog"></i>
                        <span>Preferences</span>
                    </div>
                    <div class="nav-item" data-tab="billing">
                        <i class="fa fa-credit-card"></i>
                        <span>Billing</span>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="settings-content">
                    <!-- Profile Settings Tab -->
                    <div class="settings-tab active" id="profile-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-user"></i> Profile Settings
                                </h3>
                                <p>Update your personal information and profile details</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label for="name" class="form-label">
                                                <i class="fa fa-user"></i> Full Name <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class="form-label">
                                                <i class="fa fa-at"></i> Username <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="form-label">
                                                <i class="fa fa-envelope"></i> Email Address <span class="required">*</span>
                                            </label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="form-label">
                                                <i class="fa fa-phone"></i> Phone Number
                                            </label>
                                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="location" class="form-label">
                                                <i class="fa fa-map-marker"></i> Location
                                            </label>
                                            <input type="text" class="form-control" id="location" name="location" value="{{ auth()->user()->location }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="bio" class="form-label">
                                                <i class="fa fa-info-circle"></i> Bio
                                            </label>
                                            <textarea class="form-control" id="bio" name="bio" rows="3">{{ auth()->user()->bio }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings Tab -->
                    <div class="settings-tab" id="security-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-shield"></i> Security Settings
                                </h3>
                                <p>Manage your password and account security</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label for="current_password" class="form-label">
                                                <i class="fa fa-lock"></i> Current Password <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="new_password" class="form-label">
                                                <i class="fa fa-key"></i> New Password <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="new_password" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password_confirmation" class="form-label">
                                                <i class="fa fa-key"></i> Confirm New Password <span class="required">*</span>
                                            </label>
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i> Update Password
                                        </button>
                                    </div>
                                </form>
                                
                                <hr>
                                
                                <div class="security-options">
                                    <h4>Additional Security</h4>
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h5>Two-Factor Authentication</h5>
                                            <p>Add an extra layer of security to your account</p>
                                        </div>
                                        <div class="security-action">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-plus"></i> Enable 2FA
                                            </button>
                                        </div>
                                    </div>
                                    <div class="security-item">
                                        <div class="security-info">
                                            <h5>Login Sessions</h5>
                                            <p>Manage your active login sessions</p>
                                        </div>
                                        <div class="security-action">
                                            <button class="btn btn-outline-secondary btn-sm">
                                                <i class="fa fa-eye"></i> View Sessions
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="settings-tab" id="notifications-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-bell"></i> Notification Settings
                                </h3>
                                <p>Choose how and when you want to be notified</p>
                            </div>
                            <div class="card-body">
                                <div class="notification-section">
                                    <h4>Email Notifications</h4>
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <h5>Exchange Requests</h5>
                                            <p>Get notified when someone requests an exchange with you</p>
                                        </div>
                                        <div class="notification-toggle">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <h5>Messages</h5>
                                            <p>Receive email notifications for new messages</p>
                                        </div>
                                        <div class="notification-toggle">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <h5>Exchange Updates</h5>
                                            <p>Get notified about status changes in your exchanges</p>
                                        </div>
                                        <div class="notification-toggle">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="notification-section">
                                    <h4>Push Notifications</h4>
                                    <div class="notification-item">
                                        <div class="notification-info">
                                            <h5>Browser Notifications</h5>
                                            <p>Receive notifications in your browser</p>
                                        </div>
                                        <div class="notification-toggle">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" onclick="saveNotificationSettings()">
                                        <i class="fa fa-save"></i> Save Notification Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Privacy Settings Tab -->
                    <div class="settings-tab" id="privacy-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-lock"></i> Privacy Settings
                                </h3>
                                <p>Control who can see your information</p>
                            </div>
                            <div class="card-body">
                                <div class="privacy-section">
                                    <h4>Profile Visibility</h4>
                                    <div class="privacy-item">
                                        <div class="privacy-info">
                                            <h5>Profile Visibility</h5>
                                            <p>Choose who can see your profile</p>
                                        </div>
                                        <div class="privacy-action">
                                            <select class="form-control">
                                                <option value="public">Public - Anyone can see</option>
                                                <option value="members">Members only</option>
                                                <option value="private">Private - Only you</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="privacy-item">
                                        <div class="privacy-info">
                                            <h5>Contact Information</h5>
                                            <p>Control who can see your contact details</p>
                                        </div>
                                        <div class="privacy-action">
                                            <select class="form-control">
                                                <option value="public">Public</option>
                                                <option value="members">Members only</option>
                                                <option value="exchanges">Exchange partners only</option>
                                                <option value="private">Private</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="privacy-section">
                                    <h4>Data & Privacy</h4>
                                    <div class="privacy-item">
                                        <div class="privacy-info">
                                            <h5>Data Usage</h5>
                                            <p>Allow SkillSwap to use your data for improving services</p>
                                        </div>
                                        <div class="privacy-toggle">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="privacy-item">
                                        <div class="privacy-info">
                                            <h5>Marketing Communications</h5>
                                            <p>Receive promotional emails and updates</p>
                                        </div>
                                        <div class="privacy-toggle">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" onclick="savePrivacySettings()">
                                        <i class="fa fa-save"></i> Save Privacy Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Preferences Settings Tab -->
                    <div class="settings-tab" id="preferences-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-cog"></i> Preferences
                                </h3>
                                <p>Customize your SkillSwap experience</p>
                            </div>
                            <div class="card-body">
                                <div class="preferences-section">
                                    <h4>Display Settings</h4>
                                    <div class="preference-item">
                                        <div class="preference-info">
                                            <h5>Theme</h5>
                                            <p>Choose your preferred color theme</p>
                                        </div>
                                        <div class="preference-action">
                                            <select class="form-control">
                                                <option value="light">Light Theme</option>
                                                <option value="dark">Dark Theme</option>
                                                <option value="auto">Auto (System)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="preference-item">
                                        <div class="preference-info">
                                            <h5>Language</h5>
                                            <p>Select your preferred language</p>
                                        </div>
                                        <div class="preference-action">
                                            <select class="form-control">
                                                <option value="en">English</option>
                                                <option value="es">Spanish</option>
                                                <option value="fr">French</option>
                                                <option value="de">German</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="preferences-section">
                                    <h4>Exchange Preferences</h4>
                                    <div class="preference-item">
                                        <div class="preference-info">
                                            <h5>Default Exchange Duration</h5>
                                            <p>Set your preferred exchange duration</p>
                                        </div>
                                        <div class="preference-action">
                                            <select class="form-control">
                                                <option value="1">1 week</option>
                                                <option value="2">2 weeks</option>
                                                <option value="4">1 month</option>
                                                <option value="8">2 months</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="preference-item">
                                        <div class="preference-info">
                                            <h5>Auto-accept Exchanges</h5>
                                            <p>Automatically accept exchange requests from trusted users</p>
                                        </div>
                                        <div class="preference-toggle">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" onclick="savePreferences()">
                                        <i class="fa fa-save"></i> Save Preferences
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Settings Tab -->
                    <div class="settings-tab" id="billing-tab">
                        <div class="settings-card">
                            <div class="card-header">
                                <h3 class="section-title">
                                    <i class="fa fa-credit-card"></i> Billing & Subscription
                                </h3>
                                <p>Manage your billing information and subscription</p>
                            </div>
                            <div class="card-body">
                                <div class="billing-section">
                                    <h4>Current Plan</h4>
                                    <div class="plan-card">
                                        <div class="plan-info">
                                            <h5>Free Plan</h5>
                                            <p>Basic features with limited exchanges per month</p>
                                            <ul>
                                                <li>5 exchanges per month</li>
                                                <li>Basic profile features</li>
                                                <li>Community support</li>
                                            </ul>
                                        </div>
                                        <div class="plan-action">
                                            <button class="btn btn-primary">
                                                <i class="fa fa-arrow-up"></i> Upgrade Plan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="billing-section">
                                    <h4>Payment Methods</h4>
                                    <div class="payment-methods">
                                        <div class="payment-method">
                                            <div class="payment-info">
                                                <i class="fa fa-credit-card"></i>
                                                <span>No payment methods added</span>
                                            </div>
                                            <div class="payment-action">
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="fa fa-plus"></i> Add Payment Method
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr>
                                
                                <div class="billing-section">
                                    <h4>Billing History</h4>
                                    <div class="billing-history">
                                        <p class="text-muted">No billing history available</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Settings Container */
.settings-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

/* Header Section */
.settings-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    padding: 80px 0;
    color: #fff;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-info {
    flex: 1;
}

.header-title {
    font-size: 2rem;
    font-weight: 600;
    margin: 0 0 10px 0;
    text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-subtitle {
    font-size: 1rem;
    color: rgba(255,255,255,0.9);
    margin: 0;
}

.header-actions {
    flex-shrink: 0;
}

/* Settings Section */
.settings-section {
    padding: 40px 0;
}

.settings-layout {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 30px;
}

/* Settings Navigation */
.settings-nav {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
    height: fit-content;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 15px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    margin-bottom: 8px;
    color: #6c757d;
    font-weight: 500;
}

.nav-item:hover {
    background: rgba(75, 156, 211, 0.1);
    color: #4B9CD3;
    transform: translateX(5px);
}

.nav-item.active {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
}

.nav-item i {
    font-size: 1.1rem;
    width: 20px;
}

/* Settings Content */
.settings-content {
    flex: 1;
}

.settings-tab {
    display: none;
}

.settings-tab.active {
    display: block;
}

.settings-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    border: 1px solid #e9ecef;
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.settings-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.15);
}

.card-header {
    background: linear-gradient(135deg, #4B9CD3 0%, #3a7bb3 100%);
    color: #fff;
    padding: 25px;
    border: none;
}

.section-title {
    font-size: 1.3rem;
    font-weight: 600;
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.card-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.95rem;
}

.card-body {
    padding: 30px;
}

/* Form Styles */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
}

.form-label i {
    color: #4B9CD3;
    width: 16px;
}

.required {
    color: #dc3545;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
    background: #fff;
    width: 100%;
}

.form-control:focus {
    border-color: #4B9CD3;
    box-shadow: 0 0 0 3px rgba(75, 156, 211, 0.1);
    outline: none;
}

/* Buttons */
.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.2s ease;
    padding: 10px 20px;
    font-size: 0.95rem;
}

.btn-primary {
    background: #4B9CD3;
    border-color: #4B9CD3;
    color: #fff;
}

.btn-primary:hover {
    background: #3a7bb3;
    border-color: #3a7bb3;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(75, 156, 211, 0.3);
}

.btn-outline-primary {
    border: 2px solid #4B9CD3;
    color: #4B9CD3;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4B9CD3;
    border-color: #4B9CD3;
    color: #fff;
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    background: transparent;
}

.btn-outline-secondary:hover {
    background: #6c757d;
    border-color: #6c757d;
    color: #fff;
}

/* Switch Toggle */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: .3s;
    border-radius: 24px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .3s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #4B9CD3;
}

input:focus + .slider {
    box-shadow: 0 0 1px #4B9CD3;
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Section Items */
.notification-section,
.privacy-section,
.preferences-section,
.billing-section,
.security-options {
    margin-bottom: 30px;
}

.notification-section h4,
.privacy-section h4,
.preferences-section h4,
.billing-section h4,
.security-options h4 {
    color: #212529;
    margin-bottom: 20px;
    font-weight: 600;
    font-size: 1.1rem;
}

.notification-item,
.privacy-item,
.preference-item,
.security-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #e9ecef;
}

.notification-item:last-child,
.privacy-item:last-child,
.preference-item:last-child,
.security-item:last-child {
    border-bottom: none;
}

.notification-info,
.privacy-info,
.preference-info,
.security-info {
    flex: 1;
}

.notification-info h5,
.privacy-info h5,
.preference-info h5,
.security-info h5 {
    margin: 0 0 5px 0;
    font-weight: 600;
    color: #212529;
    font-size: 1rem;
}

.notification-info p,
.privacy-info p,
.preference-info p,
.security-info p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
}

.notification-toggle,
.privacy-toggle,
.preference-toggle,
.security-action,
.privacy-action,
.preference-action {
    margin-left: 20px;
}

/* Plan Card */
.plan-card {
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border: 1px solid #e9ecef;
}

.plan-info h5 {
    margin: 0 0 8px 0;
    color: #212529;
    font-weight: 600;
    font-size: 1.1rem;
}

.plan-info p {
    margin: 0 0 15px 0;
    color: #6c757d;
    font-size: 0.95rem;
}

.plan-info ul {
    margin: 0;
    padding-left: 20px;
    color: #6c757d;
    font-size: 0.9rem;
}

.plan-info li {
    margin-bottom: 5px;
}

/* Payment Methods */
.payment-method {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    border-radius: 8px;
    border: 1px solid #e9ecef;
}

.payment-info {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #6c757d;
}

.payment-info i {
    font-size: 1.3rem;
    color: #4B9CD3;
}

/* Responsive Design */
@media (max-width: 992px) {
    .settings-layout {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .settings-nav {
        order: 2;
    }
    
    .settings-content {
        order: 1;
    }
}

@media (max-width: 768px) {
    .header-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .header-title {
        font-size: 1.5rem;
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .card-body {
        padding: 20px;
    }
    
    .notification-item,
    .privacy-item,
    .preference-item,
    .security-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .notification-toggle,
    .privacy-toggle,
    .preference-toggle,
    .security-action,
    .privacy-action,
    .preference-action {
        margin-left: 0;
        align-self: flex-end;
    }
    
    .plan-card {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .payment-method {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .settings-header {
        padding: 30px 0;
    }
    
    .settings-section {
        padding: 20px 0;
    }
    
    .header-title {
        font-size: 1.3rem;
    }
    
    .card-body {
        padding: 15px;
    }
    
    .settings-nav {
        padding: 15px;
    }
    
    .nav-item {
        padding: 12px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const navItems = document.querySelectorAll('.nav-item');
    const settingsTabs = document.querySelectorAll('.settings-tab');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabName = this.dataset.tab;
            
            // Remove active class from all nav items and tabs
            navItems.forEach(nav => nav.classList.remove('active'));
            settingsTabs.forEach(tab => tab.classList.remove('active'));
            
            // Add active class to clicked nav item and corresponding tab
            this.classList.add('active');
            document.getElementById(tabName + '-tab').classList.add('active');
        });
    });
});

function saveAllSettings() {
    // Add your save all settings logic here
    console.log('Saving all settings...');
    alert('All settings saved successfully!');
}

function saveNotificationSettings() {
    // Add your notification settings save logic here
    console.log('Saving notification settings...');
    alert('Notification settings saved successfully!');
}

function savePrivacySettings() {
    // Add your privacy settings save logic here
    console.log('Saving privacy settings...');
    alert('Privacy settings saved successfully!');
}

function savePreferences() {
    // Add your preferences save logic here
    console.log('Saving preferences...');
    alert('Preferences saved successfully!');
}
</script>

@endsection 