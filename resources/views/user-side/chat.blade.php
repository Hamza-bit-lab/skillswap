@extends('user-side.layouts.app')

@section('title', 'SkillSwap - Chat')

@section('content')
<div class="chat-container">
    <div class="row">
        <!-- Chat Sidebar -->
        <div class="col-md-4">
            <div class="chat-sidebar">
                <div class="chat-sidebar-header">
                    <h4><i class="fa fa-comments"></i> Messages</h4>
                    <div class="chat-actions">
                        <button class="btn btn-sm btn-outline-primary" id="refresh-chats">
                            <i class="fa fa-refresh"></i>
                        </button>
                    </div>
                </div>
                
                <div class="chat-search">
                    <input type="text" id="chat-search-input" class="form-control" placeholder="Search exchanges...">
                </div>
                
                <div class="chat-list" id="chat-list">
                    <!-- Chat items will be loaded here -->
                    <div class="loading-spinner text-center py-4">
                        <i class="fa fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="mt-2 text-muted">Loading chats...</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chat Main Area -->
        <div class="col-md-8">
            <div class="chat-main">
                <div class="chat-welcome" id="chat-welcome">
                    <div class="welcome-content text-center">
                        <i class="fa fa-comments fa-4x text-muted mb-4"></i>
                        <h3>Welcome to SkillSwap Chat</h3>
                        <p class="text-muted">Select an exchange from the sidebar to start chatting with your exchange partner.</p>
                    </div>
                </div>
                
                <div class="chat-area" id="chat-area" style="display: none;">
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <div class="chat-user-info">
                            <img id="chat-user-avatar" src="" alt="User Avatar" class="chat-user-avatar">
                            <div class="chat-user-details">
                                <h5 id="chat-user-name"></h5>
                                <small id="chat-exchange-title" class="text-muted"></small>
                            </div>
                        </div>
                        <div class="chat-header-actions">
                            <button class="btn btn-sm btn-outline-secondary" id="chat-search-btn" title="Search messages">
                                <i class="fa fa-search"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" id="chat-stats-btn" title="Message statistics">
                                <i class="fa fa-chart-bar"></i>
                            </button>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#" id="view-exchange-details">
                                        <i class="fa fa-eye"></i> View Exchange Details
                                    </a>
                                    <a class="dropdown-item" href="#" id="export-chat">
                                        <i class="fa fa-download"></i> Export Chat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Messages -->
                    <div class="chat-messages-container">
                        <div class="chat-messages" id="chat-messages">
                            <!-- Messages will be loaded here -->
                        </div>
                        <div class="typing-indicator" id="typing-indicator" style="display: none;">
                            <div class="typing-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <small class="text-muted ml-2" id="typing-text"></small>
                        </div>
                    </div>
                    
                    <!-- Chat Input -->
                    <div class="chat-input-container">
                        <form id="chat-form" enctype="multipart/form-data">
                            @csrf
                            <div class="chat-input-wrapper">
                                <div class="chat-attachments" id="chat-attachments">
                                    <!-- File attachments will be shown here -->
                                </div>
                                <div class="chat-input-group">
                                    <textarea id="chat-message-input" class="form-control" placeholder="Type your message..." rows="1" maxlength="2000"></textarea>
                                    <div class="chat-input-actions">
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="attach-file-btn" title="Attach file">
                                            <i class="fa fa-paperclip"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="emoji-btn" title="Add emoji">
                                            <i class="fa fa-smile-o"></i>
                                        </button>
                                        <button type="submit" class="btn btn-primary" id="send-message-btn">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="file" id="file-input" multiple accept="image/*,.pdf,.doc,.docx,.txt" style="display: none;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Search Messages</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="search-input" class="form-control" placeholder="Search in messages...">
                </div>
                <div id="search-results">
                    <!-- Search results will be shown here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Modal -->
<div class="modal fade" id="statsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chat Statistics</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number" id="total-messages">0</div>
                        <div class="stat-label">Total Messages</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="unread-messages">0</div>
                        <div class="stat-label">Unread Messages</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" id="attachments-count">0</div>
                        <div class="stat-label">Attachments</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
.chat-container {
    height: calc(100vh - 100px);
    background: #f8f9fa;
}

.chat-sidebar {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chat-sidebar-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-search {
    padding: 15px 20px;
    border-bottom: 1px solid #e9ecef;
}

.chat-list {
    flex: 1;
    overflow-y: auto;
}

.chat-item {
    padding: 15px 20px;
    border-bottom: 1px solid #f8f9fa;
    cursor: pointer;
    transition: background-color 0.2s;
}

.chat-item:hover {
    background-color: #f8f9fa;
}

.chat-item.active {
    background-color: #e3f2fd;
    border-left: 4px solid #14a800;
}

.chat-item-header {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.chat-item-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
    object-fit: cover;
}

.chat-item-info {
    flex: 1;
}

.chat-item-name {
    font-weight: 600;
    margin: 0;
    font-size: 14px;
}

.chat-item-skill {
    font-size: 12px;
    color: #6c757d;
    margin: 0;
}

.chat-item-meta {
    text-align: right;
}

.chat-item-time {
    font-size: 11px;
    color: #6c757d;
}

.chat-item-unread {
    background: #14a800;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    margin-top: 5px;
}

.chat-main {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.chat-welcome {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-area {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.chat-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-user-info {
    display: flex;
    align-items: center;
}

.chat-user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}

.chat-messages-container {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
    background: #f8f9fa;
}

.chat-messages {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.message {
    display: flex;
    align-items: flex-start;
    max-width: 70%;
}

.message.sent {
    align-self: flex-end;
    flex-direction: row-reverse;
}

.message.received {
    align-self: flex-start;
}

.message-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    margin: 0 10px;
    object-fit: cover;
}

.message-content {
    background: white;
    padding: 12px 16px;
    border-radius: 18px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    position: relative;
}

.message.sent .message-content {
    background: #14a800;
    color: white;
}

.message-text {
    margin: 0;
    word-wrap: break-word;
}

.message-time {
    font-size: 11px;
    color: #6c757d;
    margin-top: 5px;
}

.message.sent .message-time {
    color: rgba(255,255,255,0.8);
}

.message-attachments {
    margin-top: 10px;
}

.attachment-item {
    display: flex;
    align-items: center;
    padding: 8px;
    background: rgba(0,0,0,0.05);
    border-radius: 5px;
    margin-bottom: 5px;
}

.attachment-icon {
    margin-right: 8px;
    color: #6c757d;
}

.attachment-name {
    flex: 1;
    font-size: 12px;
}

.attachment-download {
    color: #14a800;
    cursor: pointer;
}

.typing-indicator {
    padding: 10px 20px;
    display: flex;
    align-items: center;
}

.typing-dots {
    display: flex;
    gap: 4px;
}

.typing-dots span {
    width: 8px;
    height: 8px;
    background: #6c757d;
    border-radius: 50%;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) { animation-delay: -0.32s; }
.typing-dots span:nth-child(2) { animation-delay: -0.16s; }

@keyframes typing {
    0%, 80%, 100% { transform: scale(0.8); opacity: 0.5; }
    40% { transform: scale(1); opacity: 1; }
}

.chat-input-container {
    padding: 20px;
    border-top: 1px solid #e9ecef;
}

.chat-input-wrapper {
    background: #f8f9fa;
    border-radius: 25px;
    padding: 10px;
}

.chat-attachments {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 10px;
}

.attachment-preview {
    display: flex;
    align-items: center;
    background: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 12px;
}

.attachment-preview .remove-attachment {
    margin-left: 8px;
    color: #dc3545;
    cursor: pointer;
}

.chat-input-group {
    display: flex;
    align-items: flex-end;
    gap: 10px;
}

#chat-message-input {
    flex: 1;
    border: none;
    background: transparent;
    resize: none;
    max-height: 100px;
}

.chat-input-actions {
    display: flex;
    gap: 5px;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
}

.stat-number {
    font-size: 2rem;
    font-weight: bold;
    color: #14a800;
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 5px;
}

.loading-spinner {
    color: #6c757d;
}

.message-actions {
    position: absolute;
    top: -10px;
    right: -10px;
    background: white;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    cursor: pointer;
    opacity: 0;
    transition: opacity 0.2s;
}

.message:hover .message-actions {
    opacity: 1;
}

.message-actions i {
    font-size: 10px;
    color: #6c757d;
}
</style>
@endsection

@section('scripts')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
let currentExchangeId = null;
let typingTimer = null;
let pusher = null;

$(document).ready(function() {
    initializePusher();
    loadChats();
    setupEventListeners();
});

function initializePusher() {
    // Initialize Pusher for real-time messaging
    pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
        cluster: '{{ env("PUSHER_APP_CLUSTER") }}',
        encrypted: true
    });
}

function setupEventListeners() {
    // Refresh chats
    $('#refresh-chats').click(function() {
        loadChats();
    });

    // Chat search
    $('#chat-search-input').on('input', function() {
        filterChats($(this).val());
    });

    // Message input
    $('#chat-message-input').on('input', function() {
        if (currentExchangeId) {
            sendTypingIndicator();
        }
    });

    // Send message
    $('#chat-form').submit(function(e) {
        e.preventDefault();
        sendMessage();
    });

    // Attach file
    $('#attach-file-btn').click(function() {
        $('#file-input').click();
    });

    // File input change
    $('#file-input').change(function() {
        handleFileAttachments();
    });

    // Search messages
    $('#chat-search-btn').click(function() {
        $('#searchModal').modal('show');
    });

    // Stats
    $('#chat-stats-btn').click(function() {
        loadMessageStats();
    });

    // Search input
    $('#search-input').on('input', function() {
        searchMessages($(this).val());
    });
}

function loadChats() {
    $.get('{{ route("user.chat.exchanges") }}')
        .done(function(response) {
            displayChats(response.exchanges);
        })
        .fail(function() {
            showError('Failed to load chats');
        });
}

function displayChats(exchanges) {
    const chatList = $('#chat-list');
    chatList.empty();

    if (exchanges.length === 0) {
        chatList.html(`
            <div class="text-center py-4">
                <i class="fa fa-comments fa-2x text-muted mb-3"></i>
                <p class="text-muted">No exchanges found</p>
            </div>
        `);
        return;
    }

    exchanges.forEach(function(exchange) {
        const chatItem = $(`
            <div class="chat-item" data-exchange-id="${exchange.exchange_id}">
                <div class="chat-item-header">
                    <img src="${exchange.other_user.avatar}" alt="Avatar" class="chat-item-avatar">
                    <div class="chat-item-info">
                        <h6 class="chat-item-name">${exchange.other_user.name}</h6>
                        <p class="chat-item-skill">${exchange.other_user.skill}</p>
                    </div>
                    <div class="chat-item-meta">
                        <div class="chat-item-time">${exchange.last_message ? exchange.last_message.created_at : ''}</div>
                        ${exchange.unread_count > 0 ? `<div class="chat-item-unread">${exchange.unread_count}</div>` : ''}
                    </div>
                </div>
                ${exchange.last_message ? `
                    <div class="chat-item-preview">
                        <small class="text-muted">
                            ${exchange.last_message.is_mine ? 'You: ' : exchange.last_message.sender_name + ': '}
                            ${exchange.last_message.message}
                        </small>
                    </div>
                ` : ''}
            </div>
        `);

        chatItem.click(function() {
            selectChat(exchange.exchange_id);
        });

        chatList.append(chatItem);
    });
}

function selectChat(exchangeId) {
    currentExchangeId = exchangeId;
    
    // Update UI
    $('.chat-item').removeClass('active');
    $(`.chat-item[data-exchange-id="${exchangeId}"]`).addClass('active');
    
    $('#chat-welcome').hide();
    $('#chat-area').show();
    
    // Load messages
    loadMessages(exchangeId);
    
    // Subscribe to Pusher channel
    subscribeToChannel(exchangeId);
}

function loadMessages(exchangeId) {
    $.get(`/dashboard/exchanges/${exchangeId}/messages`)
        .done(function(response) {
            displayMessages(response.messages);
            updateChatHeader(response.exchange);
            scrollToBottom();
        })
        .fail(function() {
            showError('Failed to load messages');
        });
}

function displayMessages(messages) {
    const chatMessages = $('#chat-messages');
    chatMessages.empty();

    messages.forEach(function(message) {
        const messageElement = createMessageElement(message);
        chatMessages.append(messageElement);
    });
}

function createMessageElement(message) {
    const isSent = message.sender_id === {{ auth()->id() }};
    const messageClass = isSent ? 'sent' : 'received';
    
    let attachmentsHtml = '';
    if (message.attachments && message.attachments.length > 0) {
        attachmentsHtml = '<div class="message-attachments">';
        message.attachments.forEach(function(attachment) {
            attachmentsHtml += `
                <div class="attachment-item">
                    <i class="fa fa-file attachment-icon"></i>
                    <span class="attachment-name">${attachment.filename}</span>
                    <a href="/storage/${attachment.path}" target="_blank" class="attachment-download">
                        <i class="fa fa-download"></i>
                    </a>
                </div>
            `;
        });
        attachmentsHtml += '</div>';
    }

    return $(`
        <div class="message ${messageClass}" data-message-id="${message.id}">
            <img src="${message.sender.avatar || '/assets/images/default-avatar.jpg'}" alt="Avatar" class="message-avatar">
            <div class="message-content">
                <div class="message-actions">
                    <i class="fa fa-ellipsis-h"></i>
                </div>
                <p class="message-text">${message.message}</p>
                ${attachmentsHtml}
                <div class="message-time">${formatTime(message.created_at)}</div>
            </div>
        </div>
    `);
}

function updateChatHeader(exchange) {
    const otherUser = exchange.initiator_id === {{ auth()->id() }} ? exchange.participant : exchange.initiator;
    
    $('#chat-user-avatar').attr('src', otherUser.avatar || '/assets/images/default-avatar.jpg');
    $('#chat-user-name').text(otherUser.name);
    $('#chat-exchange-title').text(exchange.title);
}

function sendMessage() {
    const message = $('#chat-message-input').val().trim();
    const formData = new FormData();
    formData.append('message', message);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    // Add file attachments
    const fileInput = $('#file-input')[0];
    if (fileInput.files.length > 0) {
        for (let i = 0; i < fileInput.files.length; i++) {
            formData.append('attachments[]', fileInput.files[i]);
        }
    }

    if (!message && fileInput.files.length === 0) return;

    $.ajax({
        url: `/dashboard/exchanges/${currentExchangeId}/messages`,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                $('#chat-message-input').val('');
                $('#file-input').val('');
                $('#chat-attachments').empty();
                
                // Add message to chat
                const messageElement = createMessageElement(response.message);
                $('#chat-messages').append(messageElement);
                scrollToBottom();
            }
        },
        error: function(xhr) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                showError(Object.values(xhr.responseJSON.errors).flat().join(', '));
            } else {
                showError('Failed to send message');
            }
        }
    });
}

function sendTypingIndicator() {
    if (typingTimer) clearTimeout(typingTimer);
    
    $.post(`/dashboard/exchanges/${currentExchangeId}/typing`)
        .done(function() {
            typingTimer = setTimeout(function() {
                // Stop typing indicator after 3 seconds
            }, 3000);
        });
}

function subscribeToChannel(exchangeId) {
    const channel = pusher.subscribe(`private-exchange.${exchangeId}`);
    
    channel.bind('App\\Events\\NewMessage', function(data) {
        const messageElement = createMessageElement(data);
        $('#chat-messages').append(messageElement);
        scrollToBottom();
        
        // Mark as read
        markMessagesAsRead([data.id]);
    });
    
    channel.bind('App\\Events\\UserTyping', function(data) {
        if (data.user_id !== {{ auth()->id() }}) {
            showTypingIndicator(data.user_name);
        }
    });
}

function showTypingIndicator(userName) {
    $('#typing-text').text(`${userName} is typing...`);
    $('#typing-indicator').show();
    
    setTimeout(function() {
        $('#typing-indicator').hide();
    }, 3000);
}

function markMessagesAsRead(messageIds) {
    $.post(`/dashboard/exchanges/${currentExchangeId}/messages/read`, {
        message_ids: messageIds,
        _token: $('meta[name="csrf-token"]').attr('content')
    });
}

function scrollToBottom() {
    const chatMessages = document.getElementById('chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

function formatTime(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const diff = now - date;
    
    if (diff < 60000) { // Less than 1 minute
        return 'Just now';
    } else if (diff < 3600000) { // Less than 1 hour
        return Math.floor(diff / 60000) + 'm ago';
    } else if (diff < 86400000) { // Less than 1 day
        return Math.floor(diff / 3600000) + 'h ago';
    } else {
        return date.toLocaleDateString();
    }
}

function filterChats(query) {
    $('.chat-item').each(function() {
        const text = $(this).text().toLowerCase();
        if (text.includes(query.toLowerCase())) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

function handleFileAttachments() {
    const files = $('#file-input')[0].files;
    const attachmentsContainer = $('#chat-attachments');
    attachmentsContainer.empty();
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const attachmentPreview = $(`
            <div class="attachment-preview">
                <i class="fa fa-file"></i>
                <span>${file.name}</span>
                <i class="fa fa-times remove-attachment" data-index="${i}"></i>
            </div>
        `);
        
        attachmentPreview.find('.remove-attachment').click(function() {
            attachmentPreview.remove();
        });
        
        attachmentsContainer.append(attachmentPreview);
    }
}

function searchMessages(query) {
    if (!query.trim()) {
        $('#search-results').empty();
        return;
    }
    
    $.get(`/dashboard/exchanges/${currentExchangeId}/messages/search`, { query: query })
        .done(function(response) {
            displaySearchResults(response.messages);
        })
        .fail(function() {
            showError('Failed to search messages');
        });
}

function displaySearchResults(messages) {
    const resultsContainer = $('#search-results');
    resultsContainer.empty();
    
    if (messages.length === 0) {
        resultsContainer.html('<p class="text-muted">No messages found</p>');
        return;
    }
    
    messages.forEach(function(message) {
        const resultElement = $(`
            <div class="search-result-item p-2 border-bottom">
                <div class="d-flex justify-content-between">
                    <strong>${message.sender.name}</strong>
                    <small class="text-muted">${formatTime(message.created_at)}</small>
                </div>
                <p class="mb-0">${message.message}</p>
            </div>
        `);
        
        resultElement.click(function() {
            $('#searchModal').modal('hide');
            // Scroll to message in chat
            scrollToMessage(message.id);
        });
        
        resultsContainer.append(resultElement);
    });
}

function loadMessageStats() {
    $.get(`/dashboard/exchanges/${currentExchangeId}/messages/stats`)
        .done(function(response) {
            $('#total-messages').text(response.total_messages);
            $('#unread-messages').text(response.unread_messages);
            $('#attachments-count').text(response.messages_with_attachments);
            $('#statsModal').modal('show');
        })
        .fail(function() {
            showError('Failed to load statistics');
        });
}

function scrollToMessage(messageId) {
    const messageElement = $(`.message[data-message-id="${messageId}"]`);
    if (messageElement.length > 0) {
        messageElement[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        messageElement.addClass('highlight');
        setTimeout(function() {
            messageElement.removeClass('highlight');
        }, 2000);
    }
}

function showError(message) {
    // You can implement a toast notification system here
    alert(message);
}
</script>
@endsection 