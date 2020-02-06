<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CopyRequestMade extends Notification
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
        $url = url('/resources/copies/'.$this->model->id);
        $file = Storage::disk('public')->path($this->model->file);
        $distribute = 'No';
        $distribute_info = NULL;
        if($this->model->distribute){
            $distribute =  'Yes';
            $distribute_info = $this->model->distribute_ammount;
        }
        $finishing =  '';
        
        foreach ($this->model->finishing as $value){
            $finishing .=  $value.',';
         }

        $ministry = 'No Ministry Associated with User Account';
        $campus = 'No Campus Associated with User Account';

        if($this->model->user->ministry){
            Log::debug('ministry exist');

            $ministry = $this->model->user->ministry->name;
        }

        if($this->model->user->campus){
            Log::debug('campus exist');

            $campus = $this->model->user->campus->name;
        }
        Log::debug($this->model->user->ministry);


        return (new MailMessage)
                    ->subject("Copy #". $this->model->id )
                    ->greeting("Copy #". $this->model->id)
                    ->line('Name: '.$this->model->user->name)
                    ->line('Email: '.$this->model->user->email)
                    ->line('Phone: '.$this->model->user->phone)
                    ->line('Campus: '.$ministry)
                    ->line('Ministry: '.$campus)
                    ->line('Date Needed: '.$this->model->due_date)
                    ->line('Copies: '.$this->model->copies)
                    ->line('Paper Size: '.$this->model->papersize)
                    ->line('Paper Type: '.$this->model->papertype)
                    ->line('Paper Color: '.$this->model->papercolour)
                    ->line('Finishing Information: '.$finishing)
                    ->line('Information: '.$this->model->information)
                    ->line('Distribute:'.$distribute)
                    ->line($distribute_info)
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
