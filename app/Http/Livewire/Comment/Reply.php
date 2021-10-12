<?php

namespace App\Http\Livewire\Comment;

use App\Models\Comment;
use App\Models\User;
use Livewire\Component;

class Reply extends Component
{
    public $parentId;
    public $commentable;
    public User $user;
    public $body;
    public $isShow = false;

    protected $rules = [
        'body' => 'required|min:2|max:5000',
    ];

    protected $listeners = ['setParentComment'];

    public function setParentComment($id)
    {
        $this->parentId = $id;
        $this->isShow = true;
    }

    public function hide()
    {
        $this->body = '';
        $this->isShow = false;
    }

    public function submitForm()
    {
        $this->validate();

        Comment::createComment($this->commentable, $this->body, $this->user, $this->parentId);

        $this->hide();

        $this->emitTo('comment.all', 'updateComments');
        $this->emitTo('generic-alert', 'saved');

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.comment.reply');
    }
}
