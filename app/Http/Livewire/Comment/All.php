<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;

class All extends Component
{
    public $comments;
    public $count;
    public $commentable;

    protected $listeners = ['updateComments'];

    public function updateComments()
    {
        $this->comments = Comment::treeRecursive($this->commentable->comments, null);
//        $this->comments = [];
        $this->count = $this->commentable->comments()->count();
    }

    public function render()
    {
        return view('livewire.comment.all');
    }
}
