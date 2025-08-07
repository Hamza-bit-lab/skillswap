<div class="exchange-detail-section">
    <div class="exchange-detail-header">
        <h4>{{ $exchange->title }}</h4>
        <span class="status-badge status-{{ $exchange->status }}">{{ ucfirst($exchange->status) }}</span>
    </div>
    <p class="exchange-description">{{ $exchange->description }}</p>
</div>

<div class="exchange-detail-section">
    <h5>Participants</h5>
    <div class="exchange-detail-participants">
        <div class="participant-detail">
            <img src="{{ $exchange->initiator->avatar ? asset('storage/' . $exchange->initiator->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                 alt="Initiator" class="participant-detail-avatar">
            <div class="participant-detail-info">
                <h5>{{ $exchange->initiator->name }}</h5>
                <p>Initiator</p>
                <p>{{ $exchange->initiatorSkill->name }} ({{ ucfirst($exchange->initiatorSkill->level) }})</p>
            </div>
        </div>
        
        <div class="exchange-detail-arrow">
            <i class="fa fa-exchange"></i>
        </div>
        
        <div class="participant-detail">
            @if($exchange->participant)
                <img src="{{ $exchange->participant->avatar ? asset('storage/' . $exchange->participant->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                     alt="Participant" class="participant-detail-avatar">
                <div class="participant-detail-info">
                    <h5>{{ $exchange->participant->name }}</h5>
                    <p>Participant</p>
                    @if($exchange->participantSkill)
                        <p>{{ $exchange->participantSkill->name }} ({{ ucfirst($exchange->participantSkill->level) }})</p>
                    @else
                        <p class="text-muted">No skill selected</p>
                    @endif
                </div>
            @else
                <div class="participant-detail-info">
                    <h5 class="text-muted">Pending</h5>
                    <p>No participant yet</p>
                    <p class="text-muted">Awaiting acceptance</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="exchange-detail-section">
    <h5>Exchange Details</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Created:</span>
                <span class="detail-value">{{ $exchange->created_at->format('M d, Y H:i') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Terms:</span>
                <span class="detail-value">{{ $exchange->terms }}</span>
            </div>
        </div>
    </div>
    @if($exchange->start_date)
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Started:</span>
                <span class="detail-value">{{ $exchange->start_date->format('M d, Y') }}</span>
            </div>
        </div>
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Progress:</span>
                <span class="detail-value">{{ $exchange->progress ?? 0 }}%</span>
            </div>
        </div>
    </div>
    @endif
    @if($exchange->completed_at)
    <div class="row">
        <div class="col-md-6">
            <div class="detail-item">
                <span class="detail-label">Completed:</span>
                <span class="detail-value">{{ $exchange->completed_at->format('M d, Y H:i') }}</span>
            </div>
        </div>
    </div>
    @endif
</div>

@if($exchange->messages->count() > 0)
<div class="exchange-detail-section">
    <h5>Messages</h5>
    <div class="messages-list">
        @foreach($exchange->messages->take(10) as $message)
            <div class="message-item">
                <img src="{{ $message->sender->avatar ? asset('storage/' . $message->sender->avatar) : asset('assets/images/default-avatar.jpg') }}" 
                     alt="User" class="message-avatar">
                <div class="message-content">
                    <div class="message-header">
                        <span class="message-sender">{{ $message->sender->name }}</span>
                        <span class="message-time">{{ $message->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="message-text">{{ $message->content }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

<style>
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
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.exchange-detail-header h4 {
    margin: 0;
    color: #333;
    font-size: 1.2rem;
}

.exchange-description {
    color: #6c757d;
    line-height: 1.5;
    margin: 0;
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
</style> 