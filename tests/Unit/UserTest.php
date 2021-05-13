<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    function it_may_have_an_avatar()
    {
        /** @var User $user */
        $user = User::factory()->make([
            'avatar' => 'path_to_avatar',
        ]);

        $this->assertTrue($user->hasAvatar());
    }
}
