<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Message;

class NewMessageNotification extends Notification
{
    use Queueable;

    public $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Message from ' . $this->message->sender->name)
            ->line('You have received a new message in your exchange.')
            ->line('From: ' . $this->message->sender->name)
            ->line('Message: ' . \Str::limit($this->message->message, 100))
            ->action('View Message', url('/dashboard/exchanges/' . $this->message->exchange_id))
            ->line('Thank you for using SkillSwap!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'id' => $this->id,
            'type' => 'new_message',
            'message_id' => $this->message->id,
            'exchange_id' => $this->message->exchange_id,
            'sender_id' => $this->message->sender_id,
            'sender_name' => $this->message->sender->name,
            'message_preview' => \Str::limit($this->message->message, 50),
            'created_at' => $this->message->created_at,
        ];
    }
} 