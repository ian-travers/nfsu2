<?php

namespace App\Models;

trait HasLikesDislikes
{
    public function likesAndDislikes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    // Likes
    public function likes()
    {
        return $this->likesAndDislikes()->where('type_id', Like::LIKE);
    }

    public function like()
    {
        // toggle if dislike for logged in user
        if ($dislike = $this->dislikes()->where(['user_id' => auth()->id()])->first()) {
            return $dislike->toggle();
        }

        $attributes = [
            'user_id' => auth()->id(),
            'type_id' => Like::LIKE,
        ];

        if (!$this->likesAndDislikes()->where($attributes)->exists()) {
            return $this->likesAndDislikes()->create($attributes);
        }
    }

    public function unlike()
    {
        if ($like = $this->likes()->where('user_id', auth()->id())->first()) {
            return $like->delete();
        }
    }

    public function isLiked()
    {
        return $this
            ->likes()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }

    // Dislikes
    public function dislikes()
    {
        return $this->likesAndDislikes()->where('type_id', Like::DISLIKE);
    }

    public function dislike()
    {
        // toggle if like for logged in user
        if ($like = $this->likes()->where(['user_id' => auth()->id()])->first()) {
            return $like->toggle();
        }

        $attributes = [
            'user_id' => auth()->id(),
            'type_id' => Like::DISLIKE,
        ];

        if (!$this->likesAndDislikes()->where($attributes)->exists()) {
            return $this->likesAndDislikes()->create($attributes);
        }
    }

    public function undislike()
    {
        if ($dislike = $this->dislikes()->where('user_id', auth()->id())->first()) {
            return $dislike->delete();
        }
    }

    public function isDisliked()
    {
        return $this
            ->dislikes()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getIsDislikedAttribute()
    {
        return $this->isDisliked();
    }
}
