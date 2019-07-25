<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Entities\XmlDownloadControl;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ZipGenerate extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $xmlDownloadControl;
    public function __construct(XmlDownloadControl $xmlDownloadControl)
    {
        $this->xmlDownloadControl = $xmlDownloadControl;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->xmlDownloadControl->user;
        return (new MailMessage)
                    ->from($user->email)
                    ->subject('Novo arquivo ZIP foi gerado '.$this->xmlDownloadControl->code)
                    ->line('Seu arquivo zip foi gerado com sucesso')
                    ->action('Realizar Download', url('/'.$this->xmlDownloadControl->path))
                    ->line('Obrigado por usar nossa aplicação!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'id' => $this->id,
            'data' => ['xmlctl' => $this->xmlDownloadControl->load('user')]
        ]);
    }
}
