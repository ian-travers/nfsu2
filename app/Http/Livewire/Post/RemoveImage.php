<?php

namespace App\Http\Livewire\Post;

use Livewire\Component;

class RemoveImage extends Component
{
    public $post;

    public function submit()
    {
        $this->post->removeImage();

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Image has been removed.'),
        ]);

        return redirect()->route('adm.posts.edit', $this->post);
    }

    public function render()
    {
        return view('livewire.post.remove-image');
    }
}
