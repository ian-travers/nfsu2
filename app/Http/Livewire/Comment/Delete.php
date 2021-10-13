<?php

namespace App\Http\Livewire\Comment;

use Illuminate\Database\QueryException;
use Livewire\Component;

class Delete extends Component
{
    public bool $showDialog = false;
    public $comment;

    public function handle()
    {
        try {
            $this->comment->delete();

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('Comment has been deleted.'),
            ]);
        } catch (QueryException $e) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => __('This comment cannot be deleted! There are descendants.'),
            ]);
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.comment.delete', [
            'confirmationMessage' => __('You are going to delete this comment. Continue?'),
        ]);
    }
}
