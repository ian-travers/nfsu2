<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    /** @test */
    function it_return_a_slug()
    {
        $this->assertEquals('the-best-post-00000001', $this->createTestPost()->slug);
    }

    /** @test */
    function it_has_unique_slug()
    {
        $this->assertEquals('the-best-post-00000001', $this->createTestPost()->slug);
        $this->assertEquals('the-best-post-00000002', $this->createTestPost()->slug);
    }

    /** @test */
    function it_might_be_published()
    {
        /** @var Post $post */
        $post = Post::factory()->create();

        $this->assertFalse($post->published);

        $post->publish();

        $this->assertTrue($post->published);
    }

    /** @test */
    function it_might_be_unpublished()
    {
        /** @var Post $post */
        $post = Post::factory()->published()->create();

        $this->assertTrue($post->published);

        $post->unpublish();

        $this->assertFalse($post->published);
    }

    /** @test */
    function it_detect_when_it_has_image()
    {
        /** @var Post $post */
        $post = Post::factory()->make();

        $this->assertFalse($post->hasImage());

        /** @var Post $postWithImage */
        $postWithImage = Post::factory()->make([
            'image' => 'cover-image.jpeg',
        ]);

        $this->assertTrue($postWithImage->hasImage());
    }

    /** @test */
    function it_detect_when_its_image_file_exists()
    {
        /** @var User $author */
        $author = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->create(['author_id' => $author->id]);

        $this->assertFalse($post->imageFileExists());

        Storage::fake();
        $uf = UploadedFile::fake()->image('cover.png');
        $post->update(['image' => $uf->store("blogs/{$author->username}", 'public')]);

        $this->assertTrue($post->imageFileExists());
    }

    /** @test */
    function it_deletes_image_file_when_the_image_attribute_sets_to_null()
    {
        /** @var User $author */
        $author = User::factory()->create();

        /** @var Post $post */
        $post = Post::factory()->create(['author_id' => $author->id]);

        Storage::fake();
        $uf = UploadedFile::fake()->image('cover.png');
        $filepath = $uf->store("blogs/{$author->username}", 'public');
        $post->update(['image' => $filepath]);

        Storage::disk('public')->assertExists($filepath);

        $post->removeImage();

        Storage::disk('public')->assertMissing($filepath);
    }

    protected function createTestPost(): Post
    {
        return Post::factory()->create([
            'title' => 'The best post',
        ]);
    }
}
