<?php

namespace Tests\Unit\Like;

use App\Models\Like;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToggleTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    function it_can_toggle()
    {
        // like -> to dislike
        /** @var Like $like */
        $like = Like::factory()->create();

        $this->assertEquals('like', $like->type_id);

        $like->toggle();
        $this->assertEquals('dislike', $like->fresh()->type_id);

        // dislike -> to like
        /** @var Like $dislike */
        $dislike = Like::factory()->create(['type_id' => Like::DISLIKE]);

        $this->assertEquals('dislike', $dislike->type_id);

        $dislike->toggle();
        $this->assertEquals('like', $dislike->fresh()->type_id);
    }
}
