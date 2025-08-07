<div class="chat-message {{ $message->sender_id === auth()->id() ? 'message-mine' : 'message-other' }}" data-message-id="{{ $message->id }}">
    <div class="message-avatar">
        <img src="{{ $message->sender->avatar ? asset('storage/' . $message->sender->avatar) : asset('assets/images/default-avatar.jpg') }}" 
             alt="{{ $message->sender->name }}" class="avatar-img">
    </div>
    <div class="message-content">
        <div class="message-header">
            <span class="message-sender">{{ $message->sender->name }}</span>
            <span class="message-time">{{ $message->created_at->format('g:i A') }}</span>
        </div>
        <div class="message-text">
            {{ $message->message }}
        </div>
        @if($message->sender_id === auth()->id())
            <div class="message-status">
                @if($message->is_read)
                    <i class="fa fa-check-double text-primary" title="Read"></i>
                @else
                    <i class="fa fa-check text-muted" title="Sent"></i>
                @endif
            </div>
        @endif
    </div>
</div> 