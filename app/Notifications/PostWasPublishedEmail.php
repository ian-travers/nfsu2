<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostWasPublishedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New post was published.')
            ->line("Author: {$this->post->author->username}")
            ->line("Title: {$this->post->title}")
            ->line("Published at: {$this->post->published_at->isoFormat('LL')}")
            ->action('View post', url($this->post->path()));
    }
}
