<?php

namespace App\Http\Controllers;

use App\Models\Exchange;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    /**
     * Get messages for an exchange
     */
    public function getMessages(Request $request, $exchangeId)
    {
        $exchange = Exchange::findOrFail($exchangeId);
        
        // Check if user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $messages = Message::where('exchange_id', $exchangeId)
            ->with(['sender:id,name,avatar'])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'exchange' => $exchange
        ]);
    }

    /**
     * Send a message
     */
    public function sendMessage(Request $request, $exchangeId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $exchange = Exchange::findOrFail($exchangeId);
        
        // Check if user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Determine receiver (the other person in the exchange)
        $receiverId = $exchange->initiator_id === Auth::id() 
            ? $exchange->participant_id 
            : $exchange->initiator_id;

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiverId,
            'exchange_id' => $exchangeId,
            'message' => $request->message,
            'message_type' => 'exchange',
            'is_read' => false,
        ]);

        // Load the sender relationship
        $message->load('sender:id,name,avatar');

        // Send notification to receiver
        $receiver = User::find($receiverId);
        if ($receiver) {
            $receiver->notify(new NewMessageNotification($message));
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'html' => view('user-side.partials.chat-message', compact('message'))->render()
        ]);
    }

    /**
     * Mark messages as read
     */
    public function markAsRead(Request $request, $exchangeId)
    {
        $exchange = Exchange::findOrFail($exchangeId);
        
        // Check if user is part of this exchange
        if ($exchange->initiator_id !== Auth::id() && $exchange->participant_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        Message::where('exchange_id', $exchangeId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Get unread message count for user
     */
    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get latest unread message details for notifications
     */
    public function getLatestUnreadMessage()
    {
        $latestMessage = Message::where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->with(['sender:id,name,avatar', 'exchange:id,title'])
            ->orderBy('created_at', 'desc')
            ->first();

        if ($latestMessage) {
            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $latestMessage->id,
                    'sender_name' => $latestMessage->sender->name,
                    'sender_avatar' => $latestMessage->sender->avatar ? asset('storage/' . $latestMessage->sender->avatar) : asset('assets/images/default-avatar.jpg'),
                    'message_preview' => \Str::limit($latestMessage->message, 50),
                    'exchange_id' => $latestMessage->exchange_id,
                    'exchange_title' => $latestMessage->exchange->title,
                    'created_at' => $latestMessage->created_at->diffForHumans()
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => null]);
    }

    /**
     * Get all conversations grouped by user for current user
     */
    public function getExchangeChats()
    {
        // Get all exchanges where the current user is involved
        $userExchanges = Exchange::where(function($query) {
                $query->where('initiator_id', Auth::id())
                      ->orWhere('participant_id', Auth::id());
            })
            ->whereIn('status', ['pending', 'in_progress', 'completed'])
            ->with(['initiator', 'participant', 'initiatorSkill', 'participantSkill'])
            ->get();

        // Group conversations by the other user
        $conversations = [];
        
        foreach ($userExchanges as $exchange) {
            $otherUser = $exchange->initiator_id === Auth::id() ? $exchange->participant : $exchange->initiator;
            $otherUserId = $otherUser->id;
            
            // If we already have a conversation with this user, skip
            if (isset($conversations[$otherUserId])) {
                continue;
            }
            
            // Get all messages between current user and other user
            $allMessages = Message::where(function($query) use ($otherUserId) {
                    $query->where('sender_id', Auth::id())
                          ->where('receiver_id', $otherUserId)
                          ->orWhere('sender_id', $otherUserId)
                          ->where('receiver_id', Auth::id());
                })
                ->orderBy('created_at', 'desc')
                ->get();
            
            // Get the latest message
            $lastMessage = $allMessages->first();
            
            // Get unread count for this user
            $unreadCount = Message::where('sender_id', $otherUserId)
                ->where('receiver_id', Auth::id())
                ->where('is_read', false)
                ->count();
            
            // Get the most recent exchange with this user
            $latestExchange = $userExchanges->where('initiator_id', $otherUserId)
                ->merge($userExchanges->where('participant_id', $otherUserId))
                ->sortByDesc('created_at')
                ->first();
            
            $conversations[$otherUserId] = [
                'user_id' => $otherUserId,
                'exchange_id' => $latestExchange ? $latestExchange->id : null,
                'user_name' => $otherUser->name,
                'user_avatar' => $otherUser->avatar ? asset('storage/' . $otherUser->avatar) : asset('assets/images/default-avatar.jpg'),
                'last_message' => $lastMessage ? [
                    'message' => \Str::limit($lastMessage->message, 50),
                    'sender_name' => $lastMessage->sender->name,
                    'created_at' => $lastMessage->created_at->diffForHumans(),
                    'is_mine' => $lastMessage->sender_id === Auth::id()
                ] : null,
                'unread_count' => $unreadCount,
                'last_activity' => $lastMessage ? $lastMessage->created_at : $latestExchange->created_at
            ];
        }
        
        // Sort conversations by last activity
        $conversations = collect($conversations)
            ->sortByDesc('last_activity')
            ->values()
            ->toArray();

        return response()->json(['exchanges' => $conversations]);
    }

    /**
     * Get messages between current user and another user
     */
    public function getUserMessages(Request $request, $userId)
    {
        $messages = Message::where(function($query) use ($userId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $userId)
                      ->orWhere('sender_id', $userId)
                      ->where('receiver_id', Auth::id());
            })
            ->with(['sender:id,name,avatar'])
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'messages' => $messages
        ]);
    }

    /**
     * Mark messages from a specific user as read
     */
    public function markUserMessagesAsRead(Request $request, $userId)
    {
        Message::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Send a message to a specific user
     */
    public function sendUserMessage(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if there's an exchange between these users
        $exchange = Exchange::where(function($query) use ($userId) {
                $query->where('initiator_id', Auth::id())
                      ->where('participant_id', $userId)
                      ->orWhere('initiator_id', $userId)
                      ->where('participant_id', Auth::id());
            })
            ->whereIn('status', ['pending', 'in_progress', 'completed'])
            ->first();

        if (!$exchange) {
            return response()->json([
                'success' => false,
                'error' => 'No active exchange found with this user'
            ], 400);
        }

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $userId,
            'exchange_id' => $exchange->id,
            'message' => $request->message,
            'message_type' => 'exchange',
            'is_read' => false,
        ]);

        // Load the sender relationship
        $message->load('sender:id,name,avatar');

        // Send notification to receiver
        $receiver = User::find($userId);
        if ($receiver) {
            $receiver->notify(new NewMessageNotification($message));
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }

    /**
     * Get recent messages for the current user
     */
    public function getRecentMessages()
    {
        $recentMessages = Message::where('receiver_id', Auth::id())
            ->with(['sender:id,name,avatar', 'exchange:id,title'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function($message) {
                return [
                    'id' => $message->id,
                    'sender_name' => $message->sender->name,
                    'sender_avatar' => $message->sender->avatar ? asset('storage/' . $message->sender->avatar) : asset('assets/images/default-avatar.jpg'),
                    'message_preview' => \Str::limit($message->message, 50),
                    'exchange_id' => $message->exchange_id,
                    'exchange_title' => $message->exchange->title,
                    'created_at' => $message->created_at->diffForHumans(),
                    'is_read' => $message->is_read
                ];
            });

        return response()->json(['messages' => $recentMessages]);
    }

    /**
     * Search messages in a conversation
     */
    public function searchMessages(Request $request, $exchangeId)
    {
        $query = $request->get('q');
        
        if (!$query) {
            return response()->json(['messages' => []]);
        }

        $messages = Message::where('exchange_id', $exchangeId)
            ->where('message', 'like', "%{$query}%")
            ->with(['sender:id,name,avatar'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    /**
     * Get message statistics
     */
    public function getMessageStats(Request $request, $exchangeId)
    {
        $totalMessages = Message::where('exchange_id', $exchangeId)->count();
        $unreadMessages = Message::where('exchange_id', $exchangeId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->count();
        
        $myMessages = Message::where('exchange_id', $exchangeId)
            ->where('sender_id', Auth::id())
            ->count();
        
        $otherMessages = $totalMessages - $myMessages;

        return response()->json([
            'total_messages' => $totalMessages,
            'unread_messages' => $unreadMessages,
            'my_messages' => $myMessages,
            'other_messages' => $otherMessages
        ]);
    }

    /**
     * Delete a message
     */
    public function deleteMessage(Request $request, $messageId)
    {
        $message = Message::findOrFail($messageId);
        
        // Check if user owns this message
        if ($message->sender_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Send typing indicator
     */
    public function sendTypingIndicator(Request $request, $exchangeId)
    {
        // This would typically broadcast to other users via WebSockets
        // For now, we'll just return success
        return response()->json(['success' => true]);
    }
} 