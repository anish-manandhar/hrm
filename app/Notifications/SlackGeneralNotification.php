<?php

namespace App\Notifications;

use App\Models\Holiday;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;

class SlackGeneralNotification extends Notification
{
    use Queueable;

    public function __construct(Holiday $holiday)
    {
        $this->holiday = $holiday;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $message = $this->holiday->title.' Holiday Announced From '.$this->holiday->from.' to '.$this->holiday->to;
        return (new SlackMessage)
            ->success()
            ->content($message);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
