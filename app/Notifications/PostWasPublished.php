<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PostWasPublished extends Notification
{
    use Queueable;

    protected Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'author' => $this->post->author->username,
            'action' => 'publish',
            'at' => $this->post->published_at,
            'title' => $this->post->title,
            'link' => $this->post->path(),
        ];
    }
}
