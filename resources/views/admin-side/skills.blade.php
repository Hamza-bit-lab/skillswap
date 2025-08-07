@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Skills Management')
@section('page-title', 'Skills Management')

@section('content')
    <!-- Skills Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-star"></i>
            </div>
            <div class="stat-number">{{ $totalSkills }}</div>
            <div class="stat-label">Total Skills</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-clock-o"></i>
            </div>
            <div class="stat-number">{{ $pendingSkills }}</div>
            <div class="stat-label">Pending Approval</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $approvedSkills }}</div>
            <div class="stat-label">Approved Skills</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $rejectedSkills }}</div>
            <div class="stat-label">Rejected Skills</div>
        </div>
    </div>

    <!-- Skills Management -->
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Skills Management</h3>
            <div class="card-actions">
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="filter-group">
                    <select class="form-control" id="categoryFilter">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn-admin btn-primary" onclick="exportSkills()">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <div class="skills-table-container">
            <table class="admin-table" id="skillsTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>User</th>
                        <th>Skill</th>
                        <th>Category</th>
                        <th>Level</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($skills as $skill)
                    <tr data-skill-id="{{ $skill->id }}" data-status="{{ $skill->is_verified ? 'approved' : 'pending' }}">
                        <td>
                            <input type="checkbox" class="skill-checkbox" value="{{ $skill->id }}">
                        </td>
                        <td>
                            <div class="user-info">
                                <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                     alt="User" class="user-avatar">
                                <div>
                                    <div class="user-name">{{ $skill->user->name }}</div>
                                    <div class="user-email">{{ $skill->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="skill-info">
                                <div class="skill-name">{{ $skill->name }}</div>
                                <div class="skill-description">{{ Str::limit($skill->description, 50) }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="category-badge">{{ $skill->category }}</span>
                        </td>
                        <td>
                            <span class="level-badge level-{{ strtolower($skill->level) }}">{{ $skill->level }}</span>
                        </td>
                        <td>
                            @if($skill->is_verified)
                                <span class="status-badge status-approved">Approved</span>
                            @else
                                <span class="status-badge status-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div>{{ $skill->created_at->format('M d, Y') }}</div>
                                <div class="time">{{ $skill->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-admin btn-sm btn-primary" onclick="viewSkill({{ $skill->id }})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @if(!$skill->is_verified)
                                <button class="btn-admin btn-sm btn-success" onclick="approveSkill({{ $skill->id }})">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button class="btn-admin btn-sm btn-danger" onclick="rejectSkill({{ $skill->id }})">
                                    <i class="fa fa-times"></i>
                                </button>
                                @endif
                                <button class="btn-admin btn-sm btn-warning" onclick="editSkill({{ $skill->id }})">
                                    <i class="fa fa-edit"></i>
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
                <span id="selectedCount">0</span> skills selected
            </div>
            <div class="bulk-buttons">
                <button class="btn-admin btn-success" onclick="bulkApprove()">
                    <i class="fa fa-check"></i> Approve Selected
                </button>
                <button class="btn-admin btn-danger" onclick="bulkReject()">
                    <i class="fa fa-times"></i> Reject Selected
                </button>
                <button class="btn-admin btn-secondary" onclick="clearSelection()">
                    <i class="fa fa-times"></i> Clear Selection
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $skills->links() }}
        </div>
    </div>

    <!-- Skill Details Modal -->
    <div class="modal fade" id="skillModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Skill Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="skillModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-admin btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-admin btn-success" id="approveSkillBtn" style="display: none;">
                        <i class="fa fa-check"></i> Approve
                    </button>
                    <button type="button" class="btn-admin btn-danger" id="rejectSkillBtn" style="display: none;">
                        <i class="fa fa-times"></i> Reject
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Skills Management Specific Styles */
    .filter-group {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .filter-group .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .skills-table-container {
        overflow-x: auto;
        margin-top: 1rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-info .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
    }

    .user-email {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .skill-info {
        max-width: 200px;
    }

    .skill-name {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .skill-description {
        font-size: 0.8rem;
        color: #6c757d;
        line-height: 1.4;
    }

    .category-badge {
        background: #e9ecef;
        color: #495057;
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .level-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .level-beginner {
        background: #d4edda;
        color: #155724;
    }

    .level-intermediate {
        background: #fff3cd;
        color: #856404;
    }

    .level-advanced {
        background: #cce5ff;
        color: #004085;
    }

    .level-expert {
        background: #f8d7da;
        color: #721c24;
    }

    .date-info {
        text-align: center;
    }

    .date-info .time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .action-buttons {
        display: flex;
        gap: 0.25rem;
    }

    .btn-admin.btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }

    /* Bulk Actions */
    .bulk-actions {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 2px solid #e9ecef;
    }

    .bulk-info {
        font-weight: 600;
        color: #333;
    }

    .bulk-buttons {
        display: flex;
        gap: 0.5rem;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 10px 40px rgba(0,0,0,0.2);
    }

    .modal-header {
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        color: white;
        border-radius: 15px 15px 0 0;
        border: none;
    }

    .skill-detail-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .skill-detail-section:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        color: #6c757d;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .bulk-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .bulk-buttons {
            flex-wrap: wrap;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Filter functionality
document.getElementById('statusFilter').addEventListener('change', filterSkills);
document.getElementById('categoryFilter').addEventListener('change', filterSkills);

function filterSkills() {
    const statusFilter = document.getElementById('statusFilter').value;
    const categoryFilter = document.getElementById('categoryFilter').value;
    const rows = document.querySelectorAll('#skillsTable tbody tr');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const category = row.querySelector('.category-badge').textContent;
        
        const statusMatch = !statusFilter || status === statusFilter;
        const categoryMatch = !categoryFilter || category === categoryFilter;
        
        row.style.display = statusMatch && categoryMatch ? 'table-row' : 'none';
    });
}

// Select all functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.skill-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

// Update bulk actions visibility
function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.skill-checkbox:checked');
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
    document.querySelectorAll('.skill-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
}

// View skill details
function viewSkill(skillId) {
    fetch(`/admin/skills/${skillId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('skillModalBody').innerHTML = data.html;
                document.getElementById('approveSkillBtn').onclick = () => approveSkill(skillId);
                document.getElementById('rejectSkillBtn').onclick = () => rejectSkill(skillId);
                
                // Show/hide action buttons based on status
                const skill = data.skill;
                if (!skill.is_verified) {
                    document.getElementById('approveSkillBtn').style.display = 'inline-block';
                    document.getElementById('rejectSkillBtn').style.display = 'inline-block';
                } else {
                    document.getElementById('approveSkillBtn').style.display = 'none';
                    document.getElementById('rejectSkillBtn').style.display = 'none';
                }
                
                $('#skillModal').modal('show');
            }
        });
}

// Approve skill
function approveSkill(skillId) {
    if (confirm('Are you sure you want to approve this skill?')) {
        fetch(`/admin/skills/${skillId}/approve`, {
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

// Reject skill
function rejectSkill(skillId) {
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch(`/admin/skills/${skillId}/reject`, {
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

// Bulk approve
function bulkApprove() {
    const selectedSkills = Array.from(document.querySelectorAll('.skill-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedSkills.length === 0) {
        alert('Please select skills to approve.');
        return;
    }
    
    if (confirm(`Are you sure you want to approve ${selectedSkills.length} skills?`)) {
        fetch('/admin/skills/bulk-approve', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ skills: selectedSkills })
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

// Bulk reject
function bulkReject() {
    const selectedSkills = Array.from(document.querySelectorAll('.skill-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedSkills.length === 0) {
        alert('Please select skills to reject.');
        return;
    }
    
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch('/admin/skills/bulk-reject', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ skills: selectedSkills, reason: reason })
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

// Export skills
function exportSkills() {
    const statusFilter = document.getElementById('statusFilter').value;
    const categoryFilter = document.getElementById('categoryFilter').value;
    
    window.location.href = `/admin/skills/export?status=${statusFilter}&category=${categoryFilter}`;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Update bulk actions when checkboxes change
    document.querySelectorAll('.skill-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});
</script>
@endsection 