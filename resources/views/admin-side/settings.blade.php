@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Settings')
@section('page-title', 'Settings')

@section('content')
    <!-- Settings Navigation -->
    <div class="settings-nav">
        <button class="nav-tab active" data-tab="general">
            <i class="fa fa-cog"></i> General
        </button>
        <button class="nav-tab" data-tab="security">
            <i class="fa fa-shield"></i> Security
        </button>
        <button class="nav-tab" data-tab="notifications">
            <i class="fa fa-bell"></i> Notifications
        </button>
        <button class="nav-tab" data-tab="integrations">
            <i class="fa fa-plug"></i> Integrations
        </button>
        <button class="nav-tab" data-tab="backup">
            <i class="fa fa-database"></i> Backup
        </button>
    </div>

    <!-- General Settings -->
    <div class="settings-content" id="general">
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">General Settings</h3>
            </div>
            <form id="generalForm">
                <div class="settings-section">
                    <h4>Platform Information</h4>
                    <div class="form-group">
                        <label for="platformName">Platform Name</label>
                        <input type="text" class="form-control" id="platformName" value="SkillSwap" required>
                    </div>
                    <div class="form-group">
                        <label for="platformDescription">Platform Description</label>
                        <textarea class="form-control" id="platformDescription" rows="3">Exchange skills with professionals worldwide</textarea>
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Contact Email</label>
                        <input type="email" class="form-control" id="contactEmail" value="admin@skillswap.com" required>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Exchange Settings</h4>
                    <div class="form-group">
                        <label for="maxSkillsPerUser">Maximum Skills per User</label>
                        <input type="number" class="form-control" id="maxSkillsPerUser" value="10" min="1" max="50">
                    </div>
                    <div class="form-group">
                        <label for="exchangeDuration">Default Exchange Duration (days)</label>
                        <input type="number" class="form-control" id="exchangeDuration" value="30" min="1" max="365">
                    </div>
                    <div class="form-group">
                        <label for="autoApproveSkills">Auto-approve Skills</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="autoApproveSkills">
                            <label class="form-check-label" for="autoApproveSkills">Automatically approve new skills</label>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>User Settings</h4>
                    <div class="form-group">
                        <label for="requireEmailVerification">Require Email Verification</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="requireEmailVerification" checked>
                            <label class="form-check-label" for="requireEmailVerification">Users must verify their email</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="allowUserRegistration">Allow User Registration</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="allowUserRegistration" checked>
                            <label class="form-check-label" for="allowUserRegistration">Allow new users to register</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="defaultUserRole">Default User Role</label>
                        <select class="form-control" id="defaultUserRole">
                            <option value="user">User</option>
                            <option value="moderator">Moderator</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-admin btn-primary">
                        <i class="fa fa-save"></i> Save General Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Security Settings -->
    <div class="settings-content" id="security" style="display: none;">
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">Security Settings</h3>
            </div>
            <form id="securityForm">
                <div class="settings-section">
                    <h4>Password Policy</h4>
                    <div class="form-group">
                        <label for="minPasswordLength">Minimum Password Length</label>
                        <input type="number" class="form-control" id="minPasswordLength" value="8" min="6" max="20">
                    </div>
                    <div class="form-group">
                        <label for="requireStrongPassword">Require Strong Password</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="requireStrongPassword" checked>
                            <label class="form-check-label" for="requireStrongPassword">Require uppercase, lowercase, numbers, and symbols</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordExpiry">Password Expiry (days)</label>
                        <input type="number" class="form-control" id="passwordExpiry" value="90" min="0" max="365">
                        <small class="form-text text-muted">0 = No expiry</small>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Session Management</h4>
                    <div class="form-group">
                        <label for="sessionTimeout">Session Timeout (minutes)</label>
                        <input type="number" class="form-control" id="sessionTimeout" value="120" min="15" max="1440">
                    </div>
                    <div class="form-group">
                        <label for="maxLoginAttempts">Maximum Login Attempts</label>
                        <input type="number" class="form-control" id="maxLoginAttempts" value="5" min="3" max="10">
                    </div>
                    <div class="form-group">
                        <label for="lockoutDuration">Account Lockout Duration (minutes)</label>
                        <input type="number" class="form-control" id="lockoutDuration" value="30" min="5" max="1440">
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Two-Factor Authentication</h4>
                    <div class="form-group">
                        <label for="require2FA">Require 2FA for Admins</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="require2FA" checked>
                            <label class="form-check-label" for="require2FA">Administrators must use two-factor authentication</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="allow2FAUsers">Allow 2FA for Users</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="allow2FAUsers" checked>
                            <label class="form-check-label" for="allow2FAUsers">Allow regular users to enable two-factor authentication</label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-admin btn-primary">
                        <i class="fa fa-save"></i> Save Security Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notification Settings -->
    <div class="settings-content" id="notifications" style="display: none;">
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">Notification Settings</h3>
            </div>
            <form id="notificationForm">
                <div class="settings-section">
                    <h4>Email Notifications</h4>
                    <div class="form-group">
                        <label for="newUserNotification">New User Registration</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="newUserNotification" checked>
                            <label class="form-check-label" for="newUserNotification">Notify admins when new users register</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="newExchangeNotification">New Exchange Requests</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="newExchangeNotification" checked>
                            <label class="form-check-label" for="newExchangeNotification">Notify admins when new exchanges are created</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="reportNotification">User Reports</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="reportNotification" checked>
                            <label class="form-check-label" for="reportNotification">Notify admins when users report issues</label>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>System Notifications</h4>
                    <div class="form-group">
                        <label for="systemAlerts">System Alerts</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="systemAlerts" checked>
                            <label class="form-check-label" for="systemAlerts">Receive system alerts and warnings</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="backupNotifications">Backup Notifications</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="backupNotifications" checked>
                            <label class="form-check-label" for="backupNotifications">Notify when backups are completed or failed</label>
                        </div>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Notification Recipients</h4>
                    <div class="form-group">
                        <label for="adminEmails">Admin Email Addresses</label>
                        <textarea class="form-control" id="adminEmails" rows="3" placeholder="Enter email addresses separated by commas">admin@skillswap.com, support@skillswap.com</textarea>
                        <small class="form-text text-muted">Multiple email addresses can be separated by commas</small>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-admin btn-primary">
                        <i class="fa fa-save"></i> Save Notification Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Integration Settings -->
    <div class="settings-content" id="integrations" style="display: none;">
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">Integration Settings</h3>
            </div>
            <form id="integrationForm">
                <div class="settings-section">
                    <h4>Email Service</h4>
                    <div class="form-group">
                        <label for="smtpHost">SMTP Host</label>
                        <input type="text" class="form-control" id="smtpHost" value="smtp.gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="smtpPort">SMTP Port</label>
                        <input type="number" class="form-control" id="smtpPort" value="587">
                    </div>
                    <div class="form-group">
                        <label for="smtpUsername">SMTP Username</label>
                        <input type="email" class="form-control" id="smtpUsername" value="noreply@skillswap.com">
                    </div>
                    <div class="form-group">
                        <label for="smtpPassword">SMTP Password</label>
                        <input type="password" class="form-control" id="smtpPassword" placeholder="Enter SMTP password">
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Social Media</h4>
                    <div class="form-group">
                        <label for="facebookAppId">Facebook App ID</label>
                        <input type="text" class="form-control" id="facebookAppId" placeholder="Enter Facebook App ID">
                    </div>
                    <div class="form-group">
                        <label for="googleClientId">Google Client ID</label>
                        <input type="text" class="form-control" id="googleClientId" placeholder="Enter Google Client ID">
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Analytics</h4>
                    <div class="form-group">
                        <label for="googleAnalytics">Google Analytics ID</label>
                        <input type="text" class="form-control" id="googleAnalytics" placeholder="Enter Google Analytics ID">
                    </div>
                    <div class="form-group">
                        <label for="enableAnalytics">Enable Analytics</label>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="enableAnalytics" checked>
                            <label class="form-check-label" for="enableAnalytics">Enable Google Analytics tracking</label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-admin btn-primary">
                        <i class="fa fa-save"></i> Save Integration Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Backup Settings -->
    <div class="settings-content" id="backup" style="display: none;">
        <div class="admin-card">
            <div class="card-header">
                <h3 class="card-title">Backup Settings</h3>
            </div>
            <form id="backupForm">
                <div class="settings-section">
                    <h4>Backup Configuration</h4>
                    <div class="form-group">
                        <label for="backupFrequency">Backup Frequency</label>
                        <select class="form-control" id="backupFrequency">
                            <option value="daily">Daily</option>
                            <option value="weekly" selected>Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="backupRetention">Backup Retention (days)</label>
                        <input type="number" class="form-control" id="backupRetention" value="30" min="1" max="365">
                    </div>
                    <div class="form-group">
                        <label for="backupLocation">Backup Location</label>
                        <input type="text" class="form-control" id="backupLocation" value="/backups" placeholder="Enter backup directory path">
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Manual Backup</h4>
                    <div class="backup-actions">
                        <button type="button" class="btn-admin btn-success" onclick="createBackup()">
                            <i class="fa fa-download"></i> Create Backup Now
                        </button>
                        <button type="button" class="btn-admin btn-secondary" onclick="restoreBackup()">
                            <i class="fa fa-upload"></i> Restore from Backup
                        </button>
                    </div>
                </div>

                <div class="settings-section">
                    <h4>Recent Backups</h4>
                    <div class="backup-list">
                        <div class="backup-item">
                            <div class="backup-info">
                                <div class="backup-name">backup_2024_01_15_143022.sql</div>
                                <div class="backup-date">January 15, 2024 - 14:30</div>
                                <div class="backup-size">45.2 MB</div>
                            </div>
                            <div class="backup-actions">
                                <button class="btn-admin btn-sm btn-primary">Download</button>
                                <button class="btn-admin btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                        <div class="backup-item">
                            <div class="backup-info">
                                <div class="backup-name">backup_2024_01_08_143022.sql</div>
                                <div class="backup-date">January 8, 2024 - 14:30</div>
                                <div class="backup-size">42.8 MB</div>
                            </div>
                            <div class="backup-actions">
                                <button class="btn-admin btn-sm btn-primary">Download</button>
                                <button class="btn-admin btn-sm btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-admin btn-primary">
                        <i class="fa fa-save"></i> Save Backup Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
    /* Settings Specific Styles */
    .settings-nav {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        border-bottom: 2px solid #e9ecef;
        padding-bottom: 1rem;
    }

    .nav-tab {
        background: none;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        color: #6c757d;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .nav-tab:hover {
        background: #f8f9fa;
        color: #14a800;
    }

    .nav-tab.active {
        background: #14a800;
        color: white;
    }

    .settings-content {
        margin-bottom: 2rem;
    }

    .settings-section {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e9ecef;
    }

    .settings-section:last-child {
        border-bottom: none;
    }

    .settings-section h4 {
        color: #333;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        font-weight: 500;
        color: #333;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #14a800;
        box-shadow: 0 0 0 0.2rem rgba(20, 168, 0, 0.25);
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .form-check-input {
        width: 18px;
        height: 18px;
        accent-color: #14a800;
    }

    .form-check-label {
        font-size: 0.9rem;
        color: #333;
        cursor: pointer;
    }

    .form-text {
        font-size: 0.8rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    .form-actions {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .backup-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .backup-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .backup-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 1px solid #e9ecef;
    }

    .backup-info {
        flex: 1;
    }

    .backup-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .backup-date {
        font-size: 0.8rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .backup-size {
        font-size: 0.8rem;
        color: #14a800;
        font-weight: 500;
    }

    .backup-actions {
        display: flex;
        gap: 0.5rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .settings-nav {
            flex-wrap: wrap;
        }
        
        .nav-tab {
            flex: 1;
            min-width: 120px;
        }
        
        .backup-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .backup-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Tab navigation
document.querySelectorAll('.nav-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.nav-tab').forEach(t => t.classList.remove('active'));
        
        // Add active class to clicked tab
        this.classList.add('active');
        
        // Hide all content sections
        document.querySelectorAll('.settings-content').forEach(content => {
            content.style.display = 'none';
        });
        
        // Show selected content
        const targetId = this.dataset.tab;
        document.getElementById(targetId).style.display = 'block';
    });
});

// Form submissions
document.getElementById('generalForm').addEventListener('submit', function(e) {
    e.preventDefault();
    saveSettings('general', this);
});

document.getElementById('securityForm').addEventListener('submit', function(e) {
    e.preventDefault();
    saveSettings('security', this);
});

document.getElementById('notificationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    saveSettings('notifications', this);
});

document.getElementById('integrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    saveSettings('integrations', this);
});

document.getElementById('backupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    saveSettings('backup', this);
});

function saveSettings(type, form) {
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    submitBtn.disabled = true;
    
    // Simulate API call
    setTimeout(() => {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        
        // Show success message
        showNotification(`${type.charAt(0).toUpperCase() + type.slice(1)} settings saved successfully!`, 'success');
    }, 1500);
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} alert-dismissible fade show`;
    notification.innerHTML = `
        <i class="fa fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-2"></i>
        ${message}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    `;
    
    // Insert at the top of the main content
    const mainContent = document.querySelector('.admin-main');
    mainContent.insertBefore(notification, mainContent.firstChild);
    
    // Auto-remove after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Backup functions
function createBackup() {
    if (confirm('Are you sure you want to create a backup now? This may take a few minutes.')) {
        const btn = event.target;
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Creating Backup...';
        btn.disabled = true;
        
        // Simulate backup creation
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            showNotification('Backup created successfully!', 'success');
        }, 3000);
    }
}

function restoreBackup() {
    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = '.sql,.zip';
    
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (confirm(`Are you sure you want to restore from ${file.name}? This will overwrite current data.`)) {
                // Simulate restore process
                showNotification('Restore process started. Please wait...', 'info');
                
                setTimeout(() => {
                    showNotification('Backup restored successfully!', 'success');
                }, 5000);
            }
        }
    });
    
    fileInput.click();
}

// Initialize settings
document.addEventListener('DOMContentLoaded', function() {
    // Load saved settings (in a real app, this would fetch from server)
    console.log('Settings page loaded');
});
</script>
@endsection 