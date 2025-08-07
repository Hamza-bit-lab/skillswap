@extends('admin-side.layouts.app')

@section('title', 'SkillSwap Admin - Reviews Management')
@section('page-title', 'Reviews Management')

@section('content')
    <!-- Reviews Overview Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-star"></i>
            </div>
            <div class="stat-number">{{ $totalReviews }}</div>
            <div class="stat-label">Total Reviews</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-clock-o"></i>
            </div>
            <div class="stat-number">{{ $pendingReviews }}</div>
            <div class="stat-label">Pending Review</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-check-circle"></i>
            </div>
            <div class="stat-number">{{ $approvedReviews }}</div>
            <div class="stat-label">Approved</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="stat-number">{{ $rejectedReviews }}</div>
            <div class="stat-label">Rejected</div>
        </div>
    </div>

    <!-- Reviews Management -->
    <div class="admin-card">
        <div class="card-header">
            <h3 class="card-title">Reviews Management</h3>
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
                    <select class="form-control" id="ratingFilter">
                        <option value="">All Ratings</option>
                        <option value="5">5 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="2">2 Stars</option>
                        <option value="1">1 Star</option>
                    </select>
                </div>
                <button class="btn-admin btn-primary" onclick="exportReviews()">
                    <i class="fa fa-download"></i> Export
                </button>
            </div>
        </div>

        <div class="reviews-table-container">
            <table class="admin-table" id="reviewsTable">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                        </th>
                        <th>Review</th>
                        <th>Reviewer</th>
                        <th>Reviewed User</th>
                        <th>Rating</th>
                        <th>Exchange</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr data-review-id="{{ $review->id }}" data-status="{{ $review->is_approved ? 'approved' : ($review->is_rejected ? 'rejected' : 'pending') }}" data-rating="{{ $review->rating }}">
                        <td>
                            <input type="checkbox" class="review-checkbox" value="{{ $review->id }}">
                        </td>
                        <td>
                            <div class="review-info">
                                <div class="review-title">{{ $review->title }}</div>
                                <div class="review-comment">{{ Str::limit($review->comment, 80) }}</div>
                                <div class="review-type">
                                    <span class="type-badge">{{ ucfirst($review->review_type) }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="user-info">
                                @if($review->reviewer)
                                    <img src="{{ $review->reviewer->avatar ? asset('storage/' . $review->reviewer->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                         alt="Reviewer" class="user-avatar">
                                    <div class="user-details">
                                        <div class="user-name">{{ $review->reviewer->name }}</div>
                                        <div class="user-email">{{ $review->reviewer->email }}</div>
                                    </div>
                                @else
                                    <div class="user-details">
                                        <div class="user-name text-muted">Unknown</div>
                                        <div class="user-email text-muted">N/A</div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="user-info">
                                @if($review->reviewedUser)
                                    <img src="{{ $review->reviewedUser->avatar ? asset('storage/' . $review->reviewedUser->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                                         alt="Reviewed User" class="user-avatar">
                                    <div class="user-details">
                                        <div class="user-name">{{ $review->reviewedUser->name }}</div>
                                        <div class="user-email">{{ $review->reviewedUser->email }}</div>
                                    </div>
                                @else
                                    <div class="user-details">
                                        <div class="user-name text-muted">Unknown</div>
                                        <div class="user-email text-muted">N/A</div>
                                    </div>
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="rating-display">
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <div class="rating-number">{{ $review->rating }}/5</div>
                            </div>
                        </td>
                        <td>
                            @if($review->exchange)
                                <div class="exchange-info">
                                    <div class="exchange-title">{{ $review->exchange->title }}</div>
                                    <div class="exchange-status">
                                        <span class="status-badge status-{{ $review->exchange->status }}">{{ ucfirst($review->exchange->status) }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="exchange-info">
                                    <div class="exchange-title text-muted">No exchange</div>
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($review->is_approved)
                                <span class="status-badge status-approved">Approved</span>
                            @elseif($review->is_rejected)
                                <span class="status-badge status-rejected">Rejected</span>
                            @else
                                <span class="status-badge status-pending">Pending</span>
                            @endif
                        </td>
                        <td>
                            <div class="date-info">
                                <div>{{ $review->created_at->format('M d, Y') }}</div>
                                <div class="time">{{ $review->created_at->format('H:i') }}</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-admin btn-sm btn-primary" onclick="viewReview({{ $review->id }})">
                                    <i class="fa fa-eye"></i>
                                </button>
                                @if(!$review->is_approved && !$review->is_rejected)
                                <button class="btn-admin btn-sm btn-success" onclick="approveReview({{ $review->id }})">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button class="btn-admin btn-sm btn-danger" onclick="rejectReview({{ $review->id }})">
                                    <i class="fa fa-times"></i>
                                </button>
                                @endif
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
                <span id="selectedCount">0</span> reviews selected
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
            {{ $reviews->links() }}
        </div>
    </div>

    <!-- Review Details Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review Details</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="reviewModalBody">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-admin btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-admin btn-success" id="approveReviewBtn" style="display: none;">
                        <i class="fa fa-check"></i> Approve
                    </button>
                    <button type="button" class="btn-admin btn-danger" id="rejectReviewBtn" style="display: none;">
                        <i class="fa fa-times"></i> Reject
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
    /* Reviews Management Specific Styles */
    .review-info {
        max-width: 250px;
    }

    .review-title {
        font-weight: 600;
        font-size: 0.9rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .review-comment {
        font-size: 0.8rem;
        color: #6c757d;
        line-height: 1.4;
        margin-bottom: 0.5rem;
    }

    .review-type {
        display: flex;
        gap: 0.25rem;
    }

    .type-badge {
        background: #e9ecef;
        color: #495057;
        padding: 0.1rem 0.5rem;
        border-radius: 10px;
        font-size: 0.7rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        object-fit: cover;
    }

    .user-details {
        display: flex;
        flex-direction: column;
    }

    .user-name {
        font-weight: 600;
        font-size: 0.8rem;
        color: #333;
    }

    .user-email {
        font-size: 0.7rem;
        color: #6c757d;
    }

    .rating-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .stars {
        display: flex;
        gap: 0.1rem;
    }

    .stars i {
        font-size: 0.8rem;
    }

    .rating-number {
        font-size: 0.7rem;
        color: #6c757d;
        font-weight: 600;
    }

    .exchange-info {
        max-width: 150px;
    }

    .exchange-title {
        font-weight: 600;
        font-size: 0.8rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .exchange-status {
        display: flex;
        gap: 0.25rem;
    }

    /* Status Badges */
    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .status-in_progress {
        background: #cce5ff;
        color: #004085;
    }

    .status-completed {
        background: #d1ecf1;
        color: #0c5460;
    }

    /* Modal Styles */
    .review-detail-section {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .review-detail-section:last-child {
        border-bottom: none;
    }

    .review-detail-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .review-detail-users {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-bottom: 1rem;
    }

    .user-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 10px;
        border: 2px solid #e9ecef;
    }

    .user-detail-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #14a800;
    }

    .user-detail-info h5 {
        margin: 0 0 0.25rem;
        color: #333;
    }

    .user-detail-info p {
        margin: 0;
        color: #6c757d;
        font-size: 0.9rem;
    }

    .review-detail-arrow {
        color: #14a800;
        font-size: 1.5rem;
    }

    .review-content {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin: 1rem 0;
    }

    .review-content h6 {
        color: #333;
        margin-bottom: 0.5rem;
    }

    .review-content p {
        color: #6c757d;
        line-height: 1.5;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .user-info {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .review-detail-users {
            flex-direction: column;
            gap: 1rem;
        }
    }
    </style>
@endsection

@section('scripts')
<script>
// Filter functionality
document.getElementById('statusFilter').addEventListener('change', filterReviews);
document.getElementById('ratingFilter').addEventListener('change', filterReviews);

function filterReviews() {
    const statusFilter = document.getElementById('statusFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    const rows = document.querySelectorAll('#reviewsTable tbody tr');
    
    rows.forEach(row => {
        const status = row.dataset.status;
        const rating = row.dataset.rating;
        
        const statusMatch = !statusFilter || status === statusFilter;
        const ratingMatch = !ratingFilter || rating === ratingFilter;
        
        row.style.display = statusMatch && ratingMatch ? 'table-row' : 'none';
    });
}

// Select all functionality
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.review-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
    
    updateBulkActions();
}

// Update bulk actions visibility
function updateBulkActions() {
    const checkboxes = document.querySelectorAll('.review-checkbox:checked');
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
    document.querySelectorAll('.review-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    updateBulkActions();
}

// View review details
function viewReview(reviewId) {
    fetch(`/admin/reviews/${reviewId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reviewModalBody').innerHTML = data.html;
                
                // Set up action buttons based on status
                const review = data.review;
                const isApproved = review.is_approved;
                const isRejected = review.is_rejected;
                
                // Hide all action buttons first
                document.getElementById('approveReviewBtn').style.display = 'none';
                document.getElementById('rejectReviewBtn').style.display = 'none';
                
                // Show relevant buttons if review is pending
                if (!isApproved && !isRejected) {
                    document.getElementById('approveReviewBtn').style.display = 'inline-block';
                    document.getElementById('rejectReviewBtn').style.display = 'inline-block';
                    document.getElementById('approveReviewBtn').onclick = () => approveReview(reviewId);
                    document.getElementById('rejectReviewBtn').onclick = () => rejectReview(reviewId);
                }
                
                $('#reviewModal').modal('show');
            }
        });
}

// Approve review
function approveReview(reviewId) {
    if (confirm('Are you sure you want to approve this review?')) {
        fetch(`/admin/reviews/${reviewId}/approve`, {
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

// Reject review
function rejectReview(reviewId) {
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch(`/admin/reviews/${reviewId}/reject`, {
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

// Bulk actions
function bulkApprove() {
    const selectedReviews = Array.from(document.querySelectorAll('.review-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedReviews.length === 0) {
        alert('Please select reviews to approve.');
        return;
    }
    
    if (confirm(`Are you sure you want to approve ${selectedReviews.length} reviews?`)) {
        fetch('/admin/reviews/bulk-approve', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ reviews: selectedReviews })
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
    const selectedReviews = Array.from(document.querySelectorAll('.review-checkbox:checked'))
        .map(checkbox => checkbox.value);
    
    if (selectedReviews.length === 0) {
        alert('Please select reviews to reject.');
        return;
    }
    
    const reason = prompt('Please provide a reason for rejection:');
    if (reason) {
        fetch('/admin/reviews/bulk-reject', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ reviews: selectedReviews, reason: reason })
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

// Export reviews
function exportReviews() {
    const statusFilter = document.getElementById('statusFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    
    window.location.href = `/admin/reviews/export?status=${statusFilter}&rating=${ratingFilter}`;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Update bulk actions when checkboxes change
    document.querySelectorAll('.review-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });
});
</script>
@endsection 