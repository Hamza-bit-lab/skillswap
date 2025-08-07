@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Exchanges Management')
@section('page-title', 'Exchanges Management')

@section('content')
    <!-- Exchanges Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-exchange"></i>
            </div>
            <div class="stat-number">{{ $totalExchanges }}</div>
            <div class="stat-label">Total Exchanges</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-clock-o"></i>
            </div>
            <div class="stat-number">{{ $activeExchanges }}</div>
            <div class="stat-label">Active Exchanges</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $completedExchanges }}</div>
            <div class="stat-label">Completed</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $cancelledExchanges }}</div>
            <div class="stat-label">Cancelled</div>
        </div>
    </div>

    <!-- Exchanges Management -->
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Exchanges Management</h3>
            <div class="card-actions">
                <div class="filter-group">
                    <select class="form-control" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
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
                <button class="btn-admin btn-primary" onclick="exportExchanges()">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <div class="exchanges-table-container">
            <table class="admin-table" id="exchangesTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>Exchange</th>
                        <th>Participants</th>
                        <th>Skills</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exchanges as $exchange)
                    <tr data-exchange-id="{{ $exchange->id }}" data-status="{{ $exchange->status }}">
                        <td>
                            <input type="checkbox" class="exchange-checkbox" value="{{ $exchange->id }}">
                        </td>
                        <td>
                            <div class="exchange-info">
                                <div class="exchange-title">{{ $exchange->title }}</div>
                                <div class="exchange-description">{{ Str::limit($exchange->description, 60) }}</div>
                                <div class="exchange-terms">
                                    @if($exchange->terms && is_array($exchange->terms))
                                        @foreach($exchange->terms as $term)
                                            <span class="term-badge">{{ $term }}</span>
                                        @endforeach
                                    @elseif($exchange->terms)
                                        <span class="term-badge">{{ $exchange->terms }}</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="participants-info">
                                <div class="participant">
                                    @if($exchange->initiator)
                                        <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="Initiator" class="participant-avatar">
                                        <div class="participant-details">
                                            <div class="participant-name">{{ $exchange->initiator->name }}</div>
                                            <div class="participant-role">Initiator</div>
                                        </div>
                                    @else
                                        <div class="participant-details">
                                            <div class="participant-name text-muted">Unknown</div>
                                            <div class="participant-role">Initiator</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="exchange-arrow">
                                    <i class="fa fa-exchange"></i>
                                </div>
                                <div class="participant">
                                    @if($exchange->participant)
                                        <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                             alt="Participant" class="participant-avatar">
                                        <div class="participant-details">
                                            <div class="participant-name">{{ $exchange->participant->name }}</div>
                                            <div class="participant-role">Participant</div>
                                        </div>
                                    @else
                                        <div class="participant-details">
                                            <div class="participant-name text-muted">Pending</div>
                                            <div class="participant-role">No participant yet</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="skills-info">
                                <div class="skill-pair">
                                    <div class="skill-item">
                                        @if($exchange->initiatorSkill)
                                            <span class="skill-name">{{ $exchange->initiatorSkill->name }}</span>
                                            <span class="skill-level">{{ $exchange->initiatorSkill->level }}</span>
                                        @else
                                            <span class="skill-name text-muted">Unknown</span>
                                            <span class="skill-level" style="background: #6c757d;">N/A</span>
                                        @endif
                                    </div>
                                    <div class="skill-arrow">
                                        <i class="fa fa-arrow-right"></i>
                                    </div>
                                    <div class="skill-item">
                                        @if($exchange->participantSkill)
                                            <span class="skill-name">{{ $exchange->participantSkill->name }}</span>
                                            <span class="skill-level">{{ $exchange->participantSkill->level }}</span>
                                        @else
                                            <span class="skill-name text-muted">Pending</span>
                                            <span class="skill-level" style="background: #6c757d;">N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="status-badge status-{{ $exchange->status }}">{{ ucfirst($exchange->status) }}</span>
                        </td>
                        <td>
                            <div class="progress-info">
                                @if($exchange->status === 'in_progress')
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: {{ $exchange->progress ?? 0 }}%"></div>
                                    </div>
                                    <div class="progress-text">{{ $exchange->progress ?? 0 }}%</div>
                                @elseif($exchange->status === 'completed')
                                    <div class="progress-complete">
                                        <i class="fa fa-check-circle"></i> Complete
                                    </div>
                                @else
                                    <div class="progress-pending">
                                        <i class="fa fa-clock-o"></i> Pending
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <div>{{ $exchange->created_at->format('M d, Y') }}</div>
                                <div class="time">{{ $exchange->created_at->format('H:i') }}</div>
                                @if($exchange->start_date)
                                    <div class="start-date">Started: {{ $exchange->start_date->format('M d') }}</div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-admin btn-sm btn-primary" onclick="viewExchange({{ $exchange->id }})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @if($exchange->status === 'pending')
                                <button class="btn-admin btn-sm btn-success" onclick="approveExchange({{ $exchange->id }})">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button class="btn-admin btn-sm btn-danger" onclick="rejectExchange({{ $exchange->id }})">
                                    <i class="fa fa-times"></i>
                                </button>
                                @endif
                                @if($exchange->status === 'in_progress')
                                <button class="btn-admin btn-sm btn-warning" onclick="pauseExchange({{ $exchange->id }})">
                                    <i class="fa fa-pause"></i>
                                </button>
                                <button class="btn-admin btn-sm btn-success" onclick="completeExchange({{ $exchange->id }})">
                                    <i class="fa fa-check-circle"></i>
                                </button>
                                @endif
                                <button class="btn-admin btn-sm btn-secondary" onclick="sendMessage({{ $exchange->id }})">
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
                <span id="selectedCount">0</span> exchanges selected
            </div>
            <div class="bulk-buttons">
                <button class="btn-admin btn-success" onclick="bulkApprove()">
                    <i class="fa fa-check"></i> Approve Selected
                </button>
                <button class="btn-admin btn-danger" onclick="bulkReject()">
                    <i class="fa fa-times"></i> Reject Selected
                </button>
                <button class="btn-admin btn-warning" onclick="bulkComplete()">
                    <i class="fa fa-check-circle"></i> Mark Complete
                </button>
                <button class="btn-admin btn-secondary" onclick="clearSelection()">
                    <i class="fa fa-times"></i> Clear Selection
                </button>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            {{ $exchanges->links() }}
        </div>
    </div>

    <!-- Exchange Details Modal -->
    <div class="modal fade" id="exchangeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exchange Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="exchangeModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-admin btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-admin btn-success" id="approveExchangeBtn" style="display: none;">
                        <i class="fa fa-check"></i> Approve
                    </button>
                    <button type="button" class="btn-admin btn-danger" id="rejectExchangeBtn" style="display: none;">
                        <i class="fa fa-times"></i> Reject
                    </button>
                    <button type="button" class="btn-admin btn-warning" id="pauseExchangeBtn" style="display: none;">
                        <i class="fa fa-pause"></i> Pause
                    </button>
                    <button type="button" class="btn-admin btn-success" id="completeExchangeBtn" style="display: none;">
                        <i class="fa fa-check-circle"></i> Complete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Exchanges Management Specific Styles */
    .exchange-info {
        max-width: 250px;
    }

    .exchange-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .exchange-description {
        font-size: 0.8rem;
        color: #6c757d;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    .exchange-terms {
        display: flex;
        gap: 0.25rem;
    }

    .term-badge {
        background: #e9ecef;
        color: #495057;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.7rem;
    }

    .participants-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .participant {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .participant-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .participant-details {
        display: flex;
        flex-direction: column;
    }

    .participant-name {
        font-weight: 600;
        font-size: 0.8rem;
        color: #333;
    }

    .participant-role {
        font-size: 0.7rem;
        color: #6c757d;
    }

    .exchange-arrow {
        color: #14a800;
        font-size: 0.8rem;
    }

    .skills-info {
        max-width: 200px;
    }

    .skill-pair {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .skill-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .skill-name {
        font-weight: 600;
        font-size: 0.8rem;
        color: #333;
    }

    .skill-level {
        background: #14a800;
        color: white;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.6rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .skill-arrow {
        color: #6c757d;
        font-size: 0.7rem;
    }

    .progress-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .progress-bar {
        width: 100px;
        height: 6px;
        background: #e9ecef;
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, #14a800 0%, #0d7a00 100%);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .progress-text {
        font-size: 0.7rem;
        color: #6c757d;
        font-weight: 600;
    }

    .progress-complete {
        color: #28a745;
        font-size: 0.7rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .progress-pending {
        color: #ffc107;
        font-size: 0.7rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .date-info {
        text-align: center;
    }

    .date-info .time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .date-info .start-date {
        font-size: 0.7rem;
        color: #14a800;
        font-weight: 600;
    }

    /* Status Badges */
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-in_progress {
        background: #cce5ff;
        color: #004085;
    }

    .status-completed {
        background: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    /* Modal Styles */
    .exchange-detail-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .exchange-detail-section:last-child {
        border-bottom: none;
    }

    .exchange-detail-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .exchange-detail-participants {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .participant-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .participant-detail.active {
        border-color: #14a800;
        background: rgba(20, 168, 0, 0.1);
    }

    .participant-detail-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #14a800;
    }

    .participant-detail-info h5 {
        margin: 0 0 0.25rem;
        color: #333;
    }

    .participant-detail-info p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .exchange-detail-arrow {
        color: #14a800;
        font-size: 1.5rem;
    }

    .messages-list {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 1rem;
    }

    .message-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #f8f9fa;
    }

    .message-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .message-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .message-content {
        flex: 1;
    }

    .message-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .message-sender {
        font-weight: 600;
        color: #333;
        font-size: 0.9rem;
    }

    .message-time {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .message-text {
        color: #6c757d;
        line-height: 1.4;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .participants-info {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .skill-pair {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .exchange-detail-participants {
            flex-direction: column;
            gap: 1rem;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Filter functionality
document.getElementById('statusFilter').addEventListener('change', filterExchanges);
document.getElementById('categoryFilter').addEventListener('change', filterExchanges);

function filterExchanges() {
    const statusFilter = document.getElementById('statusFilter').value;
    const categoryFilter = document.getElementById('categoryFilter').value;
    const rows = document.querySelectorAll('#exchangesTable tbody tr');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const skills = row.querySelectorAll('.skill-name');
        const categories = Array.from(skills).map(skill => skill.textContent);
        
        const statusMatch = !statusFilter || status === statusFilter;
        const categoryMatch = !categoryFilter || categories.some(cat => cat.includes(categoryFilter));
        
        row.style.display = statusMatch && categoryMatch ? 'table-row' : 'none';
    });
}

// Select all functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.exchange-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

// Update bulk actions visibility
function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.exchange-checkbox:checked');
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
    document.querySelectorAll('.exchange-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
}

// View exchange details
function viewExchange(exchangeId) {
    fetch(`/admin/exchanges/${exchangeId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('exchangeModalBody').innerHTML = data.html;
                
                // Set up action buttons based on status
                const exchange = data.exchange;
                const status = exchange.status;
                
                // Hide all action buttons first
                document.getElementById('approveExchangeBtn').style.display = 'none';
                document.getElementById('rejectExchangeBtn').style.display = 'none';
                document.getElementById('pauseExchangeBtn').style.display = 'none';
                document.getElementById('completeExchangeBtn').style.display = 'none';
                
                // Show relevant buttons based on status
                if (status === 'pending') {
                    document.getElementById('approveExchangeBtn').style.display = 'inline-block';
                    document.getElementById('rejectExchangeBtn').style.display = 'inline-block';
                    document.getElementById('approveExchangeBtn').onclick = () => approveExchange(exchangeId);
                    document.getElementById('rejectExchangeBtn').onclick = () => rejectExchange(exchangeId);
                } else if (status === 'in_progress') {
                    document.getElementById('pauseExchangeBtn').style.display = 'inline-block';
                    document.getElementById('completeExchangeBtn').style.display = 'inline-block';
                    document.getElementById('pauseExchangeBtn').onclick = () => pauseExchange(exchangeId);
                    document.getElementById('completeExchangeBtn').onclick = () => completeExchange(exchangeId);
                }
                
                $('#exchangeModal').modal('show');
            }
        });
}

// Approve exchange
function approveExchange(exchangeId) {
    if (confirm('Are you sure you want to approve this exchange?')) {
        fetch(`/admin/exchanges/${exchangeId}/approve`, {
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

// Reject exchange
function rejectExchange(exchangeId) {
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch(`/admin/exchanges/${exchangeId}/reject`, {
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

// Pause exchange
function pauseExchange(exchangeId) {
    if (confirm('Are you sure you want to pause this exchange?')) {
        fetch(`/admin/exchanges/${exchangeId}/pause`, {
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

// Complete exchange
function completeExchange(exchangeId) {
    if (confirm('Are you sure you want to mark this exchange as complete?')) {
        fetch(`/admin/exchanges/${exchangeId}/complete`, {
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

// Send message
function sendMessage(exchangeId) {
    const message = prompt('Enter your message to the exchange participants:');
    if (message) {
        fetch(`/admin/exchanges/${exchangeId}/message`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Message sent successfully!');
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
}

// Bulk actions
function bulkApprove() {
    const selectedExchanges = Array.from(document.querySelectorAll('.exchange-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedExchanges.length === 0) {
        alert('Please select exchanges to approve.');
        return;
    }
    
    if (confirm(`Are you sure you want to approve ${selectedExchanges.length} exchanges?`)) {
        fetch('/admin/exchanges/bulk-approve', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ exchanges: selectedExchanges })
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

function bulkReject() {
    const selectedExchanges = Array.from(document.querySelectorAll('.exchange-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedExchanges.length === 0) {
        alert('Please select exchanges to reject.');
        return;
    }
    
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch('/admin/exchanges/bulk-reject', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ exchanges: selectedExchanges, reason: reason })
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

function bulkComplete() {
    const selectedExchanges = Array.from(document.querySelectorAll('.exchange-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedExchanges.length === 0) {
        alert('Please select exchanges to complete.');
        return;
    }
    
    if (confirm(`Are you sure you want to mark ${selectedExchanges.length} exchanges as complete?`)) {
        fetch('/admin/exchanges/bulk-complete', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ exchanges: selectedExchanges })
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

// Export exchanges
function exportExchanges() {
    const statusFilter = document.getElementById('statusFilter').value;
    const categoryFilter = document.getElementById('categoryFilter').value;
    
    window.location.href = `/admin/exchanges/export?status=${statusFilter}&category=${categoryFilter}`;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Update bulk actions when checkboxes change
    document.querySelectorAll('.exchange-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});
</script>
@endsection 