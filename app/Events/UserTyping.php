<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserTyping implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $exchangeId;
    public $userId;
    public $userName;
    public $isTyping;

    public function __construct($exchangeId, $userId, $userName, $isTyping = true)
    {
        $this->exchangeId = $exchangeId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->isTyping = $isTyping;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('exchange.' . $this->exchangeId);
    }

    public function broadcastWith()
    {
        return [
            'exchange_id' => $this->exchangeId,
            'user_id' => $this->userId,
            'user_name' => $this->userName,
            'is_typing' => $this->isTyping,
            'timestamp' => now()->toISOString()
        ];
    }
} 