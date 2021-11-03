<?php

namespace App\Http\Livewire\Comment;

use App\Events\CommentLeft;
use App\Models\Comment;
use Livewire\Component;

class Form extends Component
{
    public $commentable;
    public $parentId = null;
    public $user;
    public $body;

    protected $rules = [
        'body' => 'required|min:2|max:5000',
    ];

    public function clear()
    {
        $this->body = '';
        $this->resetValidation();
    }

    public function submitForm()
    {
        $this->validate();

        event(new CommentLeft(Comment::createComment($this->commentable, $this->body, $this->user, $this->parentId)));

        $this->body = '';

        $this->emitTo('generic-alert', 'saved');
        $this->emit('updateComments');
    }

    public function render()
    {
        return view('livewire.comment.form');
    }
}
