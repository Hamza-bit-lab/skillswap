<div class="skill-detail-section">
    <div class="skill-detail-header">
        <img src="{{ $skill->user->avatar ? asset('storage/' . $skill->user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
             alt="User" class="user-detail-avatar">
        <div class="skill-detail-info">
            <h4>{{ $skill->name }}</h4>
            <p>Added by {{ $skill->user->name }}</p>
            <p>{{ $skill->created_at->format('M d, Y H:i') }}</p>
        </div>
    </div>
</div>

<div class="skill-detail-section">
    <h5>Skill Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Category:</span>
                <span class="detail-value">{{ $skill->category }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Level:</span>
                <span class="detail-value">{{ ucfirst($skill->level) }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Experience:</span>
                <span class="detail-value">{{ $skill->experience_years ?? 'Not specified' }} years</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Hourly Rate:</span>
                <span class="detail-value">{{ $skill->hourly_rate ? '$' . $skill->hourly_rate : 'Not specified' }}</span>
            </div>
        </div>
    </div>
    <div class="detail-item">
        <span class="detail-label">Description:</span>
        <div class="detail-value">{{ $skill->description }}</div>
    </div>
</div>

<div class="skill-detail-section">
    <h5>User Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Name:</span>
                <span class="detail-value">{{ $skill->user->name }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Email:</span>
                <span class="detail-value">{{ $skill->user->email }}</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Location:</span>
                <span class="detail-value">{{ $skill->user->location ?? 'Not specified' }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Member Since:</span>
                <span class="detail-value">{{ $skill->user->created_at->format('M d, Y') }}</span>
            </div>
        </div>
    </div>
</div>

<style>
.skill-detail-section {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.skill-detail-section:last-child {
    border-bottom: none;
}

.skill-detail-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.user-detail-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #14a800;
}

.skill-detail-info h4 {
    margin: 0 0 0.5rem;
    color: #333;
    font-size: 1.2rem;
}

.skill-detail-info p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
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
</style> 