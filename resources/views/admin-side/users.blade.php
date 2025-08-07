@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Users Management')
@section('page-title', 'Users Management')

@section('content')
    <!-- Users Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-users"></i>
            </div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-user-plus"></i>
            </div>
            <div class="stat-number">{{ $newUsersThisWeek }}</div>
            <div class="stat-label">New This Week</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $verifiedUsers }}</div>
            <div class="stat-label">Verified Users</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-ban"></i>
            </div>
            <div class="stat-number">{{ $suspendedUsers }}</div>
            <div class="stat-label">Suspended Users</div>
        </div>
    </div>

    <!-- Users Management -->
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Users Management</h3>
            <div class="card-actions">
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="suspended">Suspended</option>
                        <option value="pending">Pending Verification</option>
                    </select>
                </div>
                <div class="filter-group">
                    <input type="text" class="form-control" id="searchInput" placeholder="Search users...">
                </div>
                <button class="btn-admin btn-primary" onclick="exportUsers()">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <div class="users-table-container">
            <table class="admin-table" id="usersTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Skills</th>
                        <th>Exchanges</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr data-user-id="{{ $user->id }}" data-status="{{ $user->is_suspended ? 'suspended' : 'active' }}">
                        <td>
                            <input type="checkbox" class="user-checkbox" value="{{ $user->id }}">
                        </td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                     alt="User" class="user-avatar">
                                <div>
                                    <div class="user-name">{{ $user->name }}</div>
                                    <div class="user-location">{{ $user->location ?? 'Location not set' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="email-info">
                                <div>{{ $user->email }}</div>
                                @if($user->email_verified_at)
                                    <span class="verified-badge">Verified</span>
                                @else
                                    <span class="unverified-badge">Unverified</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="skills-info">
                                <div class="skills-count">{{ $user->skills->count() }} skills</div>
                                <div class="skills-preview">
                                    @foreach($user->skills->take(3) as $skill)
                                        <span class="skill-tag">{{ $skill->name }}</span>
                                    @endforeach
                                    @if($user->skills->count() > 3)
                                        <span class="more-skills">+{{ $user->skills->count() - 3 }} more</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="exchanges-info">
                                <div class="exchanges-count">{{ $user->initiatedExchanges->count() + $user->participatedExchanges->count() }} exchanges</div>
                                <div class="exchanges-breakdown">
                                    <span class="completed">{{ $user->initiatedExchanges->where('status', 'completed')->count() + $user->participatedExchanges->where('status', 'completed')->count() }} completed</span>
                                    <span class="active">{{ $user->initiatedExchanges->where('status', 'active')->count() + $user->participatedExchanges->where('status', 'active')->count() }} active</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="rating-info">
                                <div class="rating-stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $user->getAverageRating() ? 'filled' : '' }}"></i>
                                    @endfor
                                </div>
                                <div class="rating-value">{{ number_format($user->getAverageRating(), 1) }}</div>
                                <div class="rating-count">({{ $user->receivedReviews->count() }} reviews)</div>
                            </div>
                        </td>
                        <td>
                            @if($user->is_suspended)
                                <span class="status-badge status-suspended">Suspended</span>
                            @elseif(!$user->email_verified_at)
                                <span class="status-badge status-pending">Pending</span>
                            @else
                                <span class="status-badge status-active">Active</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div>{{ $user->created_at->format('M d, Y') }}</div>
                                <div class="time">{{ $user->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-admin btn-sm btn-primary" onclick="viewUser({{ $user->id }})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                <button class="btn-admin btn-sm btn-warning" onclick="editUser({{ $user->id }})">
                                    <i class="fa fa-edit"></i>
                                </button>
                                @if($user->is_suspended)
                                    <button class="btn-admin btn-sm btn-success" onclick="unsuspendUser({{ $user->id }})">
                                        <i class="fa fa-check"></i>
                                    </button>
                                @else
                                    <button class="btn-admin btn-sm btn-danger" onclick="suspendUser({{ $user->id }})">
                                        <i class="fa fa-ban"></i>
                                    </button>
                                @endif
                                <button class="btn-admin btn-sm btn-secondary" onclick="sendMessage({{ $user->id }})">
                                    <i class="fa fa-envelope"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Bulk Actions -->
        <div class="bulk-actions" id="bulkActions" style="display: none;">
            <div class="bulk-info">
                <span id="selectedCount">0</span> users selected
            </div>
            <div class="bulk-buttons">
                <button class="btn-admin btn-success" onclick="bulkActivate()">
                    <i class="fa fa-check"></i> Activate Selected
                </button>
                <button class="btn-admin btn-danger" onclick="bulkSuspend()">
                    <i class="fa fa-ban"></i> Suspend Selected
                </button>
                <button class="btn-admin btn-secondary" onclick="bulkMessage()">
                    <i class="fa fa-envelope"></i> Send Message
                </button>
                <button class="btn-admin btn-secondary" onclick="clearSelection()">
                    <i class="fa fa-times"></i> Clear Selection
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    </div>

    <!-- User Details Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="userModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-admin btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-admin btn-warning" id="editUserBtn">
                        <i class="fa fa-edit"></i> Edit User
                    </button>
                    <button type="button" class="btn-admin btn-danger" id="suspendUserBtn" style="display: none;">
                        <i class="fa fa-ban"></i> Suspend User
                    </button>
                    <button type="button" class="btn-admin btn-success" id="activateUserBtn" style="display: none;">
                        <i class="fa fa-check"></i> Activate User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Send Message Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Send Message to User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="messageForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="messageSubject">Subject</label>
                            <input type="text" class="form-control" id="messageSubject" required>
                        </div>
                        <div class="form-group">
                            <label for="messageContent">Message</label>
                            <textarea class="form-control" id="messageContent" rows="5" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-admin btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-admin btn-primary">
                            <i class="fa fa-send"></i> Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
    /* Users Management Specific Styles */
    .email-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .verified-badge {
        background: #d4edda;
        color: #155724;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .unverified-badge {
        background: #f8d7da;
        color: #721c24;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .skills-info {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .skills-count {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
    }

    .skills-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    .skill-tag {
        background: #e9ecef;
        color: #495057;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.7rem;
    }

    .more-skills {
        color: #6c757d;
        font-size: 0.7rem;
        font-style: italic;
    }

    .exchanges-info {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .exchanges-count {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
    }

    .exchanges-breakdown {
        display: flex;
        gap: 0.5rem;
        font-size: 0.7rem;
    }

    .exchanges-breakdown .completed {
        color: #28a745;
    }

    .exchanges-breakdown .active {
        color: #007bff;
    }

    .rating-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .rating-stars {
        display: flex;
        gap: 0.1rem;
    }

    .rating-stars .fa-star {
        color: #e9ecef;
        font-size: 0.8rem;
    }

    .rating-stars .fa-star.filled {
        color: #ffc107;
    }

    .rating-value {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
    }

    .rating-count {
        font-size: 0.7rem;
        color: #6c757d;
    }

    .status-suspended {
        background: #f8d7da;
        color: #721c24;
    }

    /* Modal Styles */
    .user-detail-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .user-detail-section:last-child {
        border-bottom: none;
    }

    .user-detail-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .user-detail-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #14a800;
    }

    .user-detail-info h4 {
        margin: 0 0 0.5rem;
        color: #333;
    }

    .user-detail-info p {
        margin: 0;
        color: #6c757d;
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .skill-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        border: 1px solid #e9ecef;
    }

    .skill-card h5 {
        margin: 0 0 0.5rem;
        color: #333;
        font-size: 0.9rem;
    }

    .skill-card p {
        margin: 0;
        color: #6c757d;
        font-size: 0.8rem;
    }

    .exchanges-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .exchange-item {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 0.75rem;
        border-left: 3px solid #14a800;
    }

    .exchange-item h6 {
        margin: 0 0 0.25rem;
        color: #333;
        font-size: 0.9rem;
    }

    .exchange-item p {
        margin: 0;
        color: #6c757d;
        font-size: 0.8rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .skills-preview {
            flex-direction: column;
        }
        
        .exchanges-breakdown {
            flex-direction: column;
            gap: 0.25rem;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Filter functionality
document.getElementById('statusFilter').addEventListener('change', filterUsers);
document.getElementById('searchInput').addEventListener('input', filterUsers);

function filterUsers() {
    const statusFilter = document.getElementById('statusFilter').value;
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#usersTable tbody tr');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const userName = row.querySelector('.user-name').textContent.toLowerCase();
        const userEmail = row.querySelector('.email-info div').textContent.toLowerCase();
        
        const statusMatch = !statusFilter || status === statusFilter;
        const searchMatch = !searchTerm || userName.includes(searchTerm) || userEmail.includes(searchTerm);
        
        row.style.display = statusMatch && searchMatch ? 'table-row' : 'none';
    });
}

// Select all functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

// Update bulk actions visibility
function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.user-checkbox:checked');
    const bulkActions = document.getElementById('bulkActions');
    const selectedCount = document.getElementById('selectedCount');
    
    if (checkboxes.length > 0) {
        bulkActions.style.display = 'flex';
        selectedCount.textContent = checkboxes.length;
    } else {
        bulkActions.style.display = 'none';
    }
}

// Clear selection
function clearSelection() {
    document.getElementById('selectAll').checked = false;
    document.querySelectorAll('.user-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
}

// View user details
function viewUser(userId) {
    fetch(`/admin/users/${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('userModalBody').innerHTML = data.html;
                
                // Set up action buttons
                const user = data.user;
                if (user.is_suspended) {
                    document.getElementById('activateUserBtn').style.display = 'inline-block';
                    document.getElementById('suspendUserBtn').style.display = 'none';
                    document.getElementById('activateUserBtn').onclick = () => unsuspendUser(userId);
                } else {
                    document.getElementById('suspendUserBtn').style.display = 'inline-block';
                    document.getElementById('activateUserBtn').style.display = 'none';
                    document.getElementById('suspendUserBtn').onclick = () => suspendUser(userId);
                }
                
                document.getElementById('editUserBtn').onclick = () => editUser(userId);
                
                $('#userModal').modal('show');
            }
        });
}

// Suspend user
function suspendUser(userId) {
    const reason = prompt('Please provide a reason for suspension:');
    if (reason) {
        fetch(`/admin/users/${userId}/suspend`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

// Unsuspend user
function unsuspendUser(userId) {
    if (confirm('Are you sure you want to activate this user?')) {
        fetch(`/admin/users/${userId}/activate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

// Edit user
function editUser(userId) {
    // Implement edit user functionality
    alert('Edit user functionality will be implemented here');
}

// Send message
function sendMessage(userId) {
    document.getElementById('messageSubject').value = '';
    document.getElementById('messageContent').value = '';
    
    document.getElementById('messageForm').onsubmit = function(e) {
        e.preventDefault();
        
        const subject = document.getElementById('messageSubject').value;
        const content = document.getElementById('messageContent').value;
        
        fetch(`/admin/users/${userId}/message`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ subject: subject, content: content })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#messageModal').modal('hide');
                alert('Message sent successfully!');
            } else {
                alert('Error: ' + data.message);
            }
        });
    };
    
    $('#messageModal').modal('show');
}

// Bulk actions
function bulkActivate() {
    const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedUsers.length === 0) {
        alert('Please select users to activate.');
        return;
    }
    
    if (confirm(`Are you sure you want to activate ${selectedUsers.length} users?`)) {
        fetch('/admin/users/bulk-activate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ users: selectedUsers })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

function bulkSuspend() {
    const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedUsers.length === 0) {
        alert('Please select users to suspend.');
        return;
    }
    
    const reason = prompt('Please provide a reason for suspension:');
    if (reason) {
        fetch('/admin/users/bulk-suspend', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ users: selectedUsers, reason: reason })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

function bulkMessage() {
    const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedUsers.length === 0) {
        alert('Please select users to message.');
        return;
    }
    
    // Implement bulk messaging functionality
    alert('Bulk messaging functionality will be implemented here');
}

// Export users
function exportUsers() {
    const statusFilter = document.getElementById('statusFilter').value;
    const searchTerm = document.getElementById('searchInput').value;
    
    window.location.href = `/admin/users/export?status=${statusFilter}&search=${searchTerm}`;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Update bulk actions when checkboxes change
    document.querySelectorAll('.user-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});
</script>
@endsection 