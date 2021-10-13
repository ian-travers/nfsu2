<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;

class View extends Component
{
    public Comment $comment;
    public $children;
    public $user;
    public bool $authorized;

    public function mount()
    {
        $this->user = auth()->user() ?: null;
        $this->authorized = $this->comment->author->is($this->user);
    }

    public function reply()
    {
        $this->emitTo('comment.reply', 'activate', ['parentId', $this->comment->id]);
    }

    public function render()
    {
        return view('livewire.comment.view');
    }
}
