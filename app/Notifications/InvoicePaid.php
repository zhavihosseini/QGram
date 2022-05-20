<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use williamcruzme\FCM\Messages\FcmMessage;

class InvoicePaid extends Notification
{
    use Queueable;
    public $article;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($article)
    {
        $this->article=$article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['article'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \williamcruzme\FCM\Messages\FcmMessage
     */
    public function toFcm($article)
    {
        return (new FcmMessage)
            ->notification([
                'title' => 'Happy Code!',
                'body' => 'This is a test',
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
