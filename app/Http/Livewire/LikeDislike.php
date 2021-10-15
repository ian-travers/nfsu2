<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeDislike extends Component
{
    public $model;
    public $likesCount;
    public $dislikesCount;
    public $isLiked;
    public $isDisliked;

    public function mount()
    {
        $this->likesCount = $this->model->likes()->count();
        $this->dislikesCount = $this->model->dislikes()->count();
        $this->isLiked = $this->model->isLiked();
        $this->isDisliked = $this->model->isDisliked();
    }

    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->emitTo('generic-alert', 'isGuest');
        }

        if ($this->isLiked) {
            $this->model->unlike();
            $this->likesCount--;
        } else {
            $this->model->like();
            $this->likesCount++;

            if ($this->isDisliked) {
                $this->isDisliked = false;
                $this->dislikesCount--;
            }
        }

        $this->isLiked = !$this->isLiked;
    }

    public function toggleDislike()
    {
        if (auth()->guest()) {
            return $this->emitTo('generic-alert', 'isGuest');
        }

        if ($this->isDisliked) {
            $this->model->undislike();
            $this->dislikesCount--;
        } else {
            $this->model->dislike();
            $this->dislikesCount++;

            if ($this->isLiked) {
                $this->isLiked = false;
                $this->likesCount--;
            }
        }

        $this->isDisliked = !$this->isDisliked;
    }

    public function render()
    {
        return view('livewire.like-dislike');
    }
}
