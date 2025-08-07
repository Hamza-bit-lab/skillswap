@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Messages')

@section('content')
<div class="messages-container">
    <div class="messages-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1><i class="fa fa-comments"></i> Messages</h1>
                </div>
                <div class="col-md-6 text-right">
                    <div class="messages-actions">
                        <button class="btn btn-outline-primary btn-sm" onclick="refreshConversations()">
                            <i class="fa fa-refresh"></i> Refresh
                        </button>
                        <a href="{{ route('user.messages') }}?unread=1" class="btn btn-outline-warning btn-sm">
                            <i class="fa fa-envelope"></i> Unread Only
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="messages-content">
        <div class="container">
            <div class="row">
                <!-- Conversations List -->
                <div class="col-lg-4">
                    <div class="conversations-panel">
                        <div class="conversations-header">
                            <h5><i class="fa fa-list"></i> Conversations</h5>
                            <div class="conversations-search">
                                <input type="text" id="conversation-search" placeholder="Search conversations..." class="form-control">
                            </div>
                        </div>
                        <div class="conversations-list" id="conversations-list">
                            <div class="conversations-loading">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p>Loading conversations...</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="col-lg-8">
                    <div class="chat-panel" id="chat-panel">
                        <div class="chat-welcome">
                            <div class="chat-welcome-content">
                                <i class="fa fa-comments"></i>
                                <h3>Welcome to Messages</h3>
                                <p>Select a conversation to start chatting</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Window Template (Hidden) -->
<div id="chat-window-template" style="display: none;">
    <div class="chat-window">
        <div class="chat-header">
            <div class="chat-user-info">
                <img id="chat-user-avatar" src="" alt="User Avatar" class="chat-user-avatar">
                <div class="chat-user-details">
                    <h5 id="chat-user-name"></h5>
                    <small class="text-muted" id="chat-user-status">Online</small>
                </div>
            </div>
            <div class="chat-actions">
                <button class="btn btn-sm btn-outline-secondary" onclick="closeChat()">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        
        <div class="chat-messages" id="chat-messages">
            <!-- Messages will be loaded here -->
        </div>
        
        <div class="chat-input-area">
            <form id="chat-form" class="chat-form">
                <div class="input-group">
                    <input type="text" id="chat-input" class="form-control" placeholder="Type your message..." maxlength="1000">
                    <div class="input-group-append">
                        <button type="submit" id="chat-send-btn" class="btn btn-primary" disabled>
                            <i class="fa fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.messages-container {
    min-height: calc(100vh - 100px);
    background: #f8f9fa;
}

.messages-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    padding: 1rem 0;
    margin-bottom: 2rem;
}

.messages-header h1 {
    margin: 0;
    font-size: 1.5rem;
    color: #333;
}

.messages-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: flex-end;
}

.conversations-panel {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 600px;
    display: flex;
    flex-direction: column;
}

.conversations-header {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
}

.conversations-header h5 {
    margin: 0 0 1rem 0;
    color: #333;
}

.conversations-search input {
    border-radius: 20px;
    border: 1px solid #ddd;
}

.conversations-list {
    flex: 1;
    overflow-y: auto;
    padding: 0;
}

.conversations-loading {
    text-align: center;
    padding: 2rem;
    color: #6c757d;
}

.conversations-loading i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.conversation-item {
    display: flex;
    align-items: center;
    padding: 1rem;
    border-bottom: 1px solid #f1f3f4;
    cursor: pointer;
    transition: background-color 0.2s;
    position: relative;
}

.conversation-item:hover {
    background-color: #f8f9fa;
}

.conversation-item.active {
    background-color: #e3f2fd;
    border-left: 3px solid #2196f3;
}

.conversation-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 1rem;
}

.conversation-info {
    flex: 1;
    min-width: 0;
}

.conversation-name {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.conversation-preview {
    color: #6c757d;
    font-size: 0.875rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.conversation-meta {
    text-align: right;
    min-width: 80px;
}

.conversation-time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.unread-badge {
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    margin: 0 auto;
}

.chat-panel {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 600px;
    display: flex;
    flex-direction: column;
}

.chat-welcome {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #6c757d;
}

.chat-welcome-content i {
    font-size: 4rem;
    margin-bottom: 1rem;
    color: #dee2e6;
}

.chat-welcome-content h3 {
    margin-bottom: 0.5rem;
    color: #333;
}

.chat-window {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.chat-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    background: #f8f9fa;
}

.chat-user-info {
    display: flex;
    align-items: center;
}

.chat-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    margin-right: 0.75rem;
}

.chat-user-details h5 {
    margin: 0;
    font-size: 1rem;
}

.chat-user-details small {
    font-size: 0.875rem;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 1rem;
    background: #f8f9fa;
}

.message {
    display: flex;
    margin-bottom: 1rem;
    position: relative;
}

.message.sent {
    justify-content: flex-end;
}

.message.received {
    justify-content: flex-start;
}

.message-content {
    max-width: 70%;
    padding: 0.75rem 1rem;
    border-radius: 18px;
    position: relative;
}

.message.sent .message-content {
    background: #007bff;
    color: white;
    border-bottom-right-radius: 4px;
}

.message.received .message-content {
    background: white;
    color: #333;
    border: 1px solid #e9ecef;
    border-bottom-left-radius: 4px;
}

.message-time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 0.25rem;
    text-align: right;
}

.message.sent .message-time {
    color: rgba(255,255,255,0.8);
}

.chat-input-area {
    padding: 1rem;
    border-top: 1px solid #e9ecef;
    background: white;
}

.chat-form {
    margin: 0;
}

.chat-input-area .input-group {
    border-radius: 25px;
    overflow: hidden;
}

.chat-input-area .form-control {
    border: 1px solid #ddd;
    border-right: none;
    border-radius: 25px 0 0 25px;
}

.chat-input-area .btn {
    border-radius: 0 25px 25px 0;
    border-left: none;
}

.chat-empty {
    text-align: center;
    padding: 2rem;
    color: #6c757d;
}

.chat-error {
    text-align: center;
    padding: 2rem;
    color: #dc3545;
}

@media (max-width: 768px) {
    .conversations-panel,
    .chat-panel {
        height: 400px;
        margin-bottom: 1rem;
    }
    
    .messages-content .row {
        flex-direction: column;
    }
    
    .messages-content .col-lg-4,
    .messages-content .col-lg-8 {
        width: 100%;
    }
}
</style>

<script>
let conversations = [];
let currentUserId = null;
let currentUserName = null;
let messagePollingInterval = null;

// Initialize when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadConversations();
    setupEventListeners();
});

function setupEventListeners() {
    // Chat input handling
    const chatInput = document.getElementById('chat-input');
    if (chatInput) {
        chatInput.addEventListener('input', function() {
            const sendBtn = document.getElementById('chat-send-btn');
            if (sendBtn) {
                sendBtn.disabled = !this.value.trim();
            }
        });
    }

    // Chat form submission
    const chatForm = document.getElementById('chat-form');
    if (chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });
    }

    // Search functionality
    const searchInput = document.getElementById('conversation-search');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const filteredConversations = conversations.filter(conversation => 
                conversation.user_name.toLowerCase().includes(searchTerm) ||
                (conversation.last_message && conversation.last_message.message.toLowerCase().includes(searchTerm))
            );
            displayConversations(filteredConversations);
        });
    }
}

function loadConversations() {
    const conversationsList = document.getElementById('conversations-list');
    
    // Check if we should filter for unread messages
    const urlParams = new URLSearchParams(window.location.search);
    const unreadOnly = urlParams.get('unread') === '1';
    
    fetch('/dashboard/exchanges/chats/exchanges')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.exchanges) {
                conversations = data.exchanges;
                
                // Filter for unread messages if requested
                if (unreadOnly) {
                    conversations = conversations.filter(conversation => conversation.unread_count > 0);
                }
                
                displayConversations(conversations);
            } else {
                throw new Error('Invalid data format');
            }
        })
        .catch(error => {
            console.error('Error loading conversations:', error);
            conversationsList.innerHTML = `
                <div class="conversations-loading">
                    <i class="fa fa-exclamation-triangle"></i>
                    <p>Error loading conversations</p>
                    <button class="btn btn-sm btn-primary mt-2" onclick="loadConversations()">Retry</button>
                </div>
            `;
        });
}

function displayConversations(conversations) {
    const conversationsList = document.getElementById('conversations-list');
    
    if (conversations.length === 0) {
        conversationsList.innerHTML = `
            <div class="conversations-loading">
                <i class="fa fa-comments"></i>
                <p>No conversations yet</p>
                <small>Start an exchange to begin chatting</small>
            </div>
        `;
        return;
    }
    
    conversationsList.innerHTML = conversations.map(conversation => `
        <div class="conversation-item" onclick="openConversation(${conversation.user_id}, '${conversation.user_name}', '${conversation.user_avatar}')">
            <img src="${conversation.user_avatar}" alt="${conversation.user_name}" class="conversation-avatar">
            <div class="conversation-info">
                <div class="conversation-name">${conversation.user_name}</div>
                <div class="conversation-preview">${conversation.last_message ? conversation.last_message.message : 'No messages yet'}</div>
            </div>
            <div class="conversation-meta">
                <div class="conversation-time">${conversation.last_message ? conversation.last_message.created_at : ''}</div>
                ${conversation.unread_count > 0 ? `<div class="unread-badge">${conversation.unread_count}</div>` : ''}
            </div>
        </div>
    `).join('');
}

function openConversation(userId, userName, userAvatar) {
    currentUserId = userId;
    currentUserName = userName;
    
    // Update active conversation
    document.querySelectorAll('.conversation-item').forEach(item => {
        item.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
    
    // Load chat interface
    loadChatInterface(userName, userAvatar);
    
    // Load messages
    loadMessages();
    
    // Mark messages as read
    markMessagesAsRead();
    
    // Start polling
    startMessagePolling();
}

function loadChatInterface(userName, userAvatar) {
    const chatPanel = document.getElementById('chat-panel');
    const template = document.getElementById('chat-window-template');
    
    chatPanel.innerHTML = template.innerHTML;
    
    // Update user info
    document.getElementById('chat-user-name').textContent = userName;
    document.getElementById('chat-user-avatar').src = userAvatar || '{{ asset("assets/images/default-avatar.jpg") }}';
    
    // Set up event listeners
    setupChatEventListeners();
}

function setupChatEventListeners() {
    // Chat form submission
    const chatForm = document.getElementById('chat-form');
    if (chatForm) {
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            sendMessage();
        });
    }

    // Chat input handling
    const chatInput = document.getElementById('chat-input');
    if (chatInput) {
        chatInput.addEventListener('input', function() {
            const sendBtn = document.getElementById('chat-send-btn');
            if (sendBtn) {
                sendBtn.disabled = !this.value.trim();
            }
        });
    }
}

function loadMessages() {
    const messagesContainer = document.getElementById('chat-messages');
    if (!messagesContainer || !currentUserId) return;
    
    fetch(`/dashboard/exchanges/messages/user/${currentUserId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                messagesContainer.innerHTML = '';
                
                if (data.messages.length === 0) {
                    messagesContainer.innerHTML = `
                        <div class="chat-empty">
                            <i class="fa fa-comments"></i>
                            <p>No messages yet</p>
                            <small>Start the conversation!</small>
                        </div>
                    `;
                } else {
                    data.messages.forEach(message => {
                        const messageHtml = createMessageHtml(message);
                        messagesContainer.innerHTML += messageHtml;
                    });
                    
                    scrollToBottom();
                }
            } else {
                throw new Error('Invalid response format');
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            if (messagesContainer) {
                messagesContainer.innerHTML = `
                    <div class="chat-error">
                        <i class="fa fa-exclamation-triangle"></i>
                        <p>Error loading messages</p>
                        <button class="btn btn-sm btn-primary mt-2" onclick="loadMessages()">Retry</button>
                    </div>
                `;
            }
        });
}

function createMessageHtml(message) {
    const isMine = message.sender_id === {{ Auth::id() }};
    const messageClass = isMine ? 'sent' : 'received';
    const time = new Date(message.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    return `
        <div class="message ${messageClass}">
            <div class="message-content">
                <div class="message-text">${escapeHtml(message.message)}</div>
                <div class="message-time">${time}</div>
            </div>
        </div>
    `;
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function sendMessage() {
    const chatInput = document.getElementById('chat-input');
    const message = chatInput.value.trim();
    
    if (!message || !currentUserId) return;
    
    const formData = new FormData();
    formData.append('message', message);
    formData.append('_token', '{{ csrf_token() }}');
    
    fetch(`/dashboard/exchanges/messages/user/${currentUserId}/send`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add message to chat
            const messagesContainer = document.getElementById('chat-messages');
            if (messagesContainer) {
                const messageHtml = createMessageHtml(data.message);
                messagesContainer.innerHTML += messageHtml;
                
                scrollToBottom();
            }
            
            // Clear input and disable send button
            if (chatInput) {
                chatInput.value = '';
            }
            const sendBtn = document.getElementById('chat-send-btn');
            if (sendBtn) {
                sendBtn.disabled = true;
            }
            
            // Refresh conversations list
            loadConversations();
        } else {
            alert('Error sending message: ' + (data.errors?.message?.[0] || data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        alert('Error sending message. Please try again.');
    });
}

function markMessagesAsRead() {
    if (currentUserId) {
        fetch(`/dashboard/exchanges/messages/user/${currentUserId}/read`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(() => {
            // Refresh conversations to update unread counts
            loadConversations();
        })
        .catch(error => {
            console.error('Error marking messages as read:', error);
        });
    }
}

function startMessagePolling() {
    // Stop existing polling
    if (messagePollingInterval) {
        clearInterval(messagePollingInterval);
    }
    
    // Start new polling
    messagePollingInterval = setInterval(() => {
        if (currentUserId) {
            loadMessages();
            loadConversations(); // Refresh conversation list
        }
    }, 5000);
}

function scrollToBottom() {
    const messagesContainer = document.getElementById('chat-messages');
    if (messagesContainer) {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}

function closeChat() {
    const chatPanel = document.getElementById('chat-panel');
    if (chatPanel) {
        chatPanel.innerHTML = `
            <div class="chat-welcome">
                <div class="chat-welcome-content">
                    <i class="fa fa-comments"></i>
                    <h3>Welcome to Messages</h3>
                    <p>Select a conversation to start chatting</p>
                </div>
            </div>
        `;
    }
    
    // Stop polling
    if (messagePollingInterval) {
        clearInterval(messagePollingInterval);
        messagePollingInterval = null;
    }
    
    currentUserId = null;
    currentUserName = null;
}

function refreshConversations() {
    loadConversations();
}
</script>
@endsection 