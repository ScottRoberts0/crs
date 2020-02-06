<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ApprovalRequestMade extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/resources/approvals/'.$this->model->id);
        $file = Storage::disk('public')->path($this->model->file);


        return (new MailMessage)
            ->subject("Approval #". $this->model->id )
            ->greeting("Approval #". $this->model->id ." '".$this->model->user->name."'")
            ->line($this->model->user->email)
            ->line($this->model->user->phone)
            ->line($this->model->user->campus->name)
            ->line($this->model->user->ministry->name)
            ->action('View Request', $url)
            ->attach($file);
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
