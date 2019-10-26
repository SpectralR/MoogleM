<?php

namespace App\Notifications;

use App\Category;
use App\Message;
use App\Topic;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ForumNewMsg extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $topic = Topic::select('id', 'category_id')
            ->where('id', '=', $message->topic_id)
            ->first();
        $category = Category::select('id')
            ->where('id', '=', $topic->category_id)
            ->first();

        $this->topic = $topic;
        $this->category = $category;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'category_id' => $this->category->id,
            'topic_id' => $this->topic->id
        ];
    }
}
