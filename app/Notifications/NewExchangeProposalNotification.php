<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Exchange;

class NewExchangeProposalNotification extends Notification
{
    use Queueable;

    protected $exchange;

    public function __construct(Exchange $exchange)
    {
        $this->exchange = $exchange;
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
        $actionUrl = url(route('user.exchanges.show', $exchange->id));
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('You have a new exchange proposal on SkillSwap')
            ->view('emails.proposal', [
                'user' => $notifiable,
                'exchange' => $exchange,
                'actionUrl' => $actionUrl,
            ]);
    }
}