# SkillSwap Chat System

## Overview

The SkillSwap chat system provides a full-featured messaging platform that allows users to communicate with each other through exchanges. The system includes both a main messages page and a floating chat widget for quick access.

## Features

### ✅ Implemented Features

1. **User-based Conversations**
   - Conversations are grouped by user rather than by exchange
   - One conversation per user, regardless of multiple exchanges
   - Clean, organized conversation list

2. **Real-time Message Updates**
   - Automatic polling every 5 seconds for new messages
   - Real-time unread message count updates
   - Live conversation list updates

3. **Message Read Status**
   - Automatic marking of messages as read when conversation is opened
   - Unread message badges with count
   - Visual indicators for unread messages

4. **Floating Chat Widget**
   - Quick access to latest unread message
   - Minimizable chat window
   - Unread message badge on toggle button
   - Responsive design for mobile devices

5. **Search Functionality**
   - Search conversations by user name or message content
   - Real-time filtering of conversation list

6. **Message Management**
   - Send messages to users with active exchanges
   - Message validation and error handling
   - Message deletion (for own messages)
   - Message search within conversations

7. **Notification System**
   - Toast notifications for new messages
   - Unread message count badges
   - Quick access to conversations from notifications

## API Endpoints

### Chat Routes

```php
// Get all conversations for current user
GET /dashboard/exchanges/chats/exchanges

// Get messages between current user and another user
GET /dashboard/exchanges/messages/user/{userId}

// Send message to a specific user
POST /dashboard/exchanges/messages/user/{userId}/send

// Mark messages from a user as read
POST /dashboard/exchanges/messages/user/{userId}/read

// Get unread message count
GET /dashboard/exchanges/messages/unread

// Get latest unread message
GET /dashboard/exchanges/messages/latest-unread

// Get recent messages
GET /dashboard/exchanges/messages/recent

// Search messages in conversation
GET /dashboard/exchanges/{id}/messages/search

// Get message statistics
GET /dashboard/exchanges/{id}/messages/stats

// Delete a message
DELETE /dashboard/exchanges/messages/{id}

// Send typing indicator
POST /dashboard/exchanges/{id}/typing
```

## Database Structure

### Messages Table
```sql
CREATE TABLE messages (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sender_id BIGINT UNSIGNED NOT NULL,
    receiver_id BIGINT UNSIGNED NOT NULL,
    exchange_id BIGINT UNSIGNED NOT NULL,
    subject VARCHAR(255) NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    message_type ENUM('exchange', 'system') DEFAULT 'exchange',
    attachments JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    FOREIGN KEY (sender_id) REFERENCES users(id),
    FOREIGN KEY (receiver_id) REFERENCES users(id),
    FOREIGN KEY (exchange_id) REFERENCES exchanges(id)
);
```

## Frontend Components

### 1. Messages Page (`resources/views/user-side/messages.blade.php`)
- Main chat interface with conversation list and chat area
- Responsive design for desktop and mobile
- Search functionality for conversations
- Real-time updates with polling

### 2. Floating Chat Widget (`resources/views/user-side/partials/floating-chat.blade.php`)
- Quick access chat window
- Unread message notifications
- Minimizable interface
- Mobile-responsive design

### 3. Notification Toast (`resources/views/user-side/partials/notification-toast.blade.php`)
- Toast notifications for new messages
- Quick action buttons
- Auto-dismiss functionality

## JavaScript Functions

### Core Functions
```javascript
// Load conversations
loadConversations()

// Open conversation with user
openConversation(userId, userName, userAvatar)

// Send message
sendMessage()

// Mark messages as read
markMessagesAsRead()

// Refresh conversations
refreshConversations()

// Floating chat functions
toggleFloatingChat()
minimizeFloatingChat()
closeFloatingChat()
loadLatestUnreadMessage()
```

### Event Handlers
```javascript
// Chat form submission
setupChatEventListeners()

// Search functionality
setupEventListeners()

// Real-time polling
startMessagePolling()
```

## Styling

### CSS Classes
- `.conversations-panel` - Main conversation list container
- `.conversation-item` - Individual conversation items
- `.chat-panel` - Main chat area
- `.message` - Individual message styling
- `.floating-chat-widget` - Floating chat container
- `.notification-toast` - Toast notification styling

### Responsive Design
- Mobile-first approach
- Flexible layouts for different screen sizes
- Touch-friendly interface elements

## Security Features

1. **Authentication**
   - All chat routes require authentication
   - User can only access their own conversations

2. **Authorization**
   - Users can only send messages to users with active exchanges
   - Users can only delete their own messages
   - Users can only mark messages as read for messages sent to them

3. **Input Validation**
   - Message content validation (max 1000 characters)
   - XSS protection through HTML escaping
   - CSRF protection on all forms

## Performance Optimizations

1. **Database Queries**
   - Efficient queries with proper indexing
   - Eager loading of relationships
   - Pagination for large message lists

2. **Frontend Performance**
   - Debounced search functionality
   - Efficient DOM updates
   - Minimal re-renders

3. **Real-time Updates**
   - Polling instead of WebSockets for simplicity
   - Configurable polling intervals
   - Efficient data transfer

## Error Handling

1. **Network Errors**
   - Graceful error messages
   - Retry functionality
   - Fallback UI states

2. **Validation Errors**
   - Clear error messages
   - Form validation feedback
   - User-friendly error display

3. **Authorization Errors**
   - Proper HTTP status codes
   - Clear error messages
   - Redirect to appropriate pages

## Usage Examples

### Opening a Conversation
```javascript
// Open conversation with user ID 123
openConversation(123, 'John Doe', '/path/to/avatar.jpg');
```

### Sending a Message
```javascript
// Send message to current conversation
sendMessage();
```

### Checking Unread Messages
```javascript
// Check for unread messages
fetch('/dashboard/exchanges/messages/unread')
    .then(response => response.json())
    .then(data => {
        console.log('Unread count:', data.count);
    });
```

## Future Enhancements

1. **WebSocket Integration**
   - Real-time message delivery
   - Typing indicators
   - Online/offline status

2. **File Attachments**
   - Image sharing
   - Document uploads
   - File preview

3. **Message Reactions**
   - Emoji reactions
   - Message reactions
   - Quick responses

4. **Advanced Search**
   - Full-text search
   - Date range filtering
   - Message content search

5. **Message Encryption**
   - End-to-end encryption
   - Secure message storage
   - Privacy features

## Troubleshooting

### Common Issues

1. **Messages not loading**
   - Check network connectivity
   - Verify user authentication
   - Check browser console for errors

2. **Real-time updates not working**
   - Verify polling is enabled
   - Check for JavaScript errors
   - Ensure proper API responses

3. **Floating chat not appearing**
   - Check if user has unread messages
   - Verify JavaScript is loaded
   - Check for CSS conflicts

### Debug Information

Enable debug mode by adding to browser console:
```javascript
localStorage.setItem('chatDebug', 'true');
```

This will enable additional logging for troubleshooting.

## Testing

### Manual Testing Checklist

- [ ] Load conversations page
- [ ] Search conversations
- [ ] Open conversation
- [ ] Send message
- [ ] Mark messages as read
- [ ] Test floating chat
- [ ] Test notifications
- [ ] Test mobile responsiveness
- [ ] Test error scenarios

### Automated Testing

Run the test suite:
```bash
php artisan test --filter=ChatTest
```

## Deployment Notes

1. **Database Migrations**
   - Ensure messages table is created
   - Run any pending migrations

2. **File Permissions**
   - Ensure storage directory is writable
   - Check avatar upload permissions

3. **Environment Variables**
   - Verify CSRF token configuration
   - Check asset URL configuration

4. **Performance Monitoring**
   - Monitor database query performance
   - Check memory usage for large conversations
   - Monitor polling frequency impact

## Support

For issues or questions about the chat system:

1. Check the browser console for errors
2. Verify API endpoints are accessible
3. Check database connectivity
4. Review server logs for errors

## Contributing

When contributing to the chat system:

1. Follow the existing code style
2. Add appropriate error handling
3. Include tests for new features
4. Update documentation
5. Test on multiple devices/browsers 