<div class="user-detail-section">
    <div class="user-detail-header">
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/images/default-avatar.jpg') }}" 
             alt="User" class="user-detail-avatar">
        <div class="user-detail-info">
            <h4>{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>
            <p>Member since {{ $user->created_at->format('M d, Y') }}</p>
        </div>
    </div>
</div>

<div class="user-detail-section">
    <h5>User Statistics</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="stat-item">
                <div class="stat-number">{{ $user->skills->count() }}</div>
                <div class="stat-label">Skills</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <div class="stat-number">{{ $user->initiatedExchanges->count() + $user->participatedExchanges->count() }}</div>
                <div class="stat-label">Exchanges</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <div class="stat-number">{{ $user->reviews->count() }}</div>
                <div class="stat-label">Reviews</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-item">
                <div class="stat-number">{{ number_format($user->getAverageRating(), 1) }}</div>
                <div class="stat-label">Avg Rating</div>
            </div>
        </div>
    </div>
</div>

<div class="user-detail-section">
    <h5>Skills</h5>
    @if($user->skills->count() > 0)
        <div class="skills-grid">
            @foreach($user->skills as $skill)
                <div class="skill-card">
                    <h5>{{ $skill->name }}</h5>
                    <p>{{ $skill->category }} - {{ ucfirst($skill->level) }}</p>
                    <p>{{ Str::limit($skill->description, 100) }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No skills added yet.</p>
    @endif
</div>

<div class="user-detail-section">
    <h5>Recent Exchanges</h5>
    @if(($user->initiatedExchanges->count() + $user->participatedExchanges->count()) > 0)
        <div class="exchanges-list">
            @foreach($user->getAllExchanges()->take(5) as $exchange)
                <div class="exchange-item">
                    <h6>{{ $exchange->title }}</h6>
                    <p>{{ Str::limit($exchange->description, 100) }}</p>
                    <span class="exchange-status status-{{ $exchange->status }}">{{ ucfirst($exchange->status) }}</span>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No exchanges yet.</p>
    @endif
</div>

<style>
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
    font-size: 1.3rem;
}

.user-detail-info p {
    margin: 0;
    color: #6c757d;
    font-size: 0.9rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    border: 1px solid #e9ecef;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #14a800;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    color: #6c757d;
    font-weight: 500;
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
    margin-top: 1rem;
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
    margin: 0 0 0.25rem;
    color: #6c757d;
    font-size: 0.8rem;
}

.exchange-status {
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.1rem 0.5rem;
    border-radius: 10px;
    text-transform: uppercase;
}

.status-active {
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

.status-pending {
    background: #fff3cd;
    color: #856404;
}
</style> 