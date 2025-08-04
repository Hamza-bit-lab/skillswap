<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'exchange_id',
        'subject',
        'message',
        'is_read',
        'message_type',
        'attachments',
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'attachments' => 'array',
    ];

    /**
     * Get the sender user
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * Get the receiver user
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the exchange this message belongs to
     */
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }

    /**
     * Scope for unread messages
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for messages by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('message_type', $type);
    }

    /**
     * Mark message as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Check if message is from system
     */
    public function isSystemMessage()
    {
        return $this->message_type === 'system';
    }

    /**
     * Check if message is from exchange
     */
    public function isExchangeMessage()
    {
        return $this->message_type === 'exchange';
    }
}
