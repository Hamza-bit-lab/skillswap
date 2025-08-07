<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Exchange;

class ExchangeProposalStatusNotification extends Notification
{
    use Queueable;

    protected $exchange;
    protected $status;

    public function __construct(Exchange $exchange, $status)
    {
        $this->exchange = $exchange;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $exchange = Exchange::find($this->exchange->id);
        if (!$exchange) {
            return null;
        }
        $participantName = $exchange->participant->name;
        $actionUrl = url(route('user.exchanges.show', $exchange->id));
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Your exchange proposal was ' . $this->status . ' by ' . $participantName)
            ->view('emails.proposal-status', [
                'user' => $notifiable,
                'exchange' => $exchange,
                'participantName' => $participantName,
                'status' => $this->status,
                'actionUrl' => $actionUrl,
            ]);
    }
}