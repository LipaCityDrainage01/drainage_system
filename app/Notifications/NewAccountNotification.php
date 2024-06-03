<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAccountNotification extends Notification
{
    use Queueable;

    private $emailData;

    /**
     * Create a new notification instance.
     */
    public function __construct($emailData)
    {
        //
        $this->emailData = $emailData;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('no-reply@iconicsocietyofficial.com','RefreshIt')
            ->subject('Welcome')
            ->line('Welcome to RefreshIt. Please see your details below')
            ->line('Name: ' . $this->emailData['name'])
            ->line('Username: ' . $this->emailData['username'])
            ->line('Email: ' . $this->emailData['email'])
            ->line('Temporary Password: ' . $this->emailData['password'])
            ->action('Login to RefreshIt', env('APP_URL'))
            ->line('If you did not create an account, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
