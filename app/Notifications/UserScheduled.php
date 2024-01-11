<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserScheduled extends Notification
{
    use Queueable;

    public function __construct(public User $user)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->success()
            ->subject('Scheduled vaccination')
            ->greeting("Hello! {$this->user->name}")
            ->line("We are confirming your registration for vaccination.")
            ->line('You have been scheduled for tomorrow. The vaccination process will be continued until 3PM. We expect your attendance.')
            ->salutation('Thanks');
    }
}
