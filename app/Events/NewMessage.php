<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('exchange.' . $this->message->exchange_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->message->sender->name,
            'sender_avatar' => $this->message->sender->avatar ? asset('storage/' . $this->message->sender->avatar) : asset('assets/images/default-avatar.jpg'),
            'message' => $this->message->message,
            'created_at' => $this->message->created_at->format('Y-m-d H:i:s'),
            'created_at_human' => $this->message->created_at->diffForHumans(),
        ];
    }
} 