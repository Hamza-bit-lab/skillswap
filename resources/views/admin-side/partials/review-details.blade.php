<div class="review-detail-section">
    <div class="review-detail-header">
        <div class="review-rating">
            @for($i = 1; $i <= 5; $i++)
                <i class="fa fa-star {{ $i <= $review->rating ? 'filled' : 'empty' }}"></i>
            @endfor
            <span class="rating-text">{{ $review->rating }}/5</span>
        </div>
        <span class="status-badge status-{{ $review->is_approved ? 'approved' : ($review->is_rejected ? 'rejected' : 'pending') }}">
            {{ $review->is_approved ? 'Approved' : ($review->is_rejected ? 'Rejected' : 'Pending') }}
        </span>
    </div>
</div>

<div class="review-detail-section">
    <h5>Review Information</h5>
    <div class="review-detail-content">
        <div class="review-comment">
            <strong>Comment:</strong>
            <p>{{ $review->comment }}</p>
        </div>
        
        <div class="review-meta">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Created:</span>
                        <span class="detail-value">{{ $review->created_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-item">
                        <span class="detail-label">Exchange:</span>
                        <span class="detail-value">{{ $review->exchange->title ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="review-detail-section">
    <h5>Participants</h5>
    <div class="review-detail-participants">
        <div class="participant-detail">
            <img src="{{ $review->reviewer->avatar ? asset('storage/' . $review->reviewer->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                 alt="Reviewer" class="participant-detail-avatar">
            <div class="participant-detail-info">
                <h5>{{ $review->reviewer->name }}</h5>
                <p>Reviewer</p>
                <p>{{ $review->reviewer->email }}</p>
            </div>
        </div>
        
        <div class="review-detail-arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
        
        <div class="participant-detail">
            <img src="{{ $review->reviewedUser->avatar ? asset('storage/' . $review->reviewedUser->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                 alt="Reviewed" class="participant-detail-avatar">
            <div class="participant-detail-info">
                <h5>{{ $review->reviewedUser->name }}</h5>
                <p>Reviewed</p>
                <p>{{ $review->reviewedUser->email }}</p>
            </div>
        </div>
    </div>
</div>

@if($review->exchange)
<div class="review-detail-section">
    <h5>Exchange Details</h5>
    <div class="exchange-summary">
        <div class="row">
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">Title:</span>
                    <span class="detail-value">{{ $review->exchange->title }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="detail-item">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">{{ ucfirst($review->exchange->status) }}</span>
                </div>
            </div>
        </div>
        <div class="detail-item">
            <span class="detail-label">Description:</span>
            <div class="detail-value">{{ $review->exchange->description }}</div>
        </div>
    </div>
</div>
@endif

<style>
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
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.review-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.review-rating .fa-star {
    font-size: 1.2rem;
}

.review-rating .fa-star.filled {
    color: #ffc107;
}

.review-rating .fa-star.empty {
    color: #e9ecef;
}

.rating-text {
    font-weight: 600;
    color: #333;
    margin-left: 0.5rem;
}

.review-detail-content {
    margin-top: 1rem;
}

.review-comment {
    margin-bottom: 1rem;
}

.review-comment strong {
    color: #333;
    display: block;
    margin-bottom: 0.5rem;
}

.review-comment p {
    color: #6c757d;
    line-height: 1.5;
    margin: 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 3px solid #14a800;
}

.review-meta {
    margin-top: 1rem;
}

.detail-item {
    margin-bottom: 0.75rem;
}

.detail-label {
    font-weight: 600;
    color: #333;
    display: inline-block;
    min-width: 100px;
}

.detail-value {
    color: #6c757d;
}

.review-detail-participants {
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

.review-detail-arrow {
    color: #14a800;
    font-size: 1.2rem;
}

.exchange-summary {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 1rem;
    border: 1px solid #e9ecef;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

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
</style> 