<?php

namespace Tests\Feature\Backend\Blog;

use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class RemoveImageTest extends TestCase
{
    /** @test */
    function admin_can_remove_post_image()
    {
        $this->signIn(User::factory()->admin()->create());

        /** @var \App\Models\Post $post */
        $post = Post::factory()->create([
            'image' => 'fake.png',
        ]);

        $this->assertTrue($post->hasImage());

        Livewire::test('post.remove-image', ['post' => $post])
            ->call('submit');

        $this->assertFalse($post->fresh()->hasImage());
    }
}
