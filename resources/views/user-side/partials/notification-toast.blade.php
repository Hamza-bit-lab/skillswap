<!-- Notification Toast -->
<div id="notification-toast" class="notification-toast" style="display: none;">
    <div class="toast-content">
        <img id="toast-avatar" src="" alt="Avatar" class="toast-avatar">
        <div class="toast-info">
            <div id="toast-sender" class="toast-sender"></div>
            <div id="toast-preview" class="toast-preview"></div>
        </div>
        <div class="toast-actions">
            <button class="btn btn-sm btn-primary" onclick="openChatFromNotification()">Open Chat</button>
            <button class="btn btn-sm btn-outline-secondary" onclick="closeNotificationToast()">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
</div>

<style>
.notification-toast {
    position: fixed;
    top: 20px;
    right: 20px;
    width: 350px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    z-index: 1001;
    border: 1px solid #e9ecef;
    animation: slideInRight 0.3s ease;
}

.toast-content {
    display: flex;
    align-items: center;
    padding: 1rem;
    gap: 0.75rem;
}

.toast-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
}

.toast-info {
    flex: 1;
    min-width: 0;
}

.toast-sender {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
}

.toast-preview {
    color: #6c757d;
    font-size: 0.75rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.toast-actions {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@media (max-width: 768px) {
    .notification-toast {
        width: calc(100vw - 40px);
        right: 20px;
        left: 20px;
    }
}
</style> 