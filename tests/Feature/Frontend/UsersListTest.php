<?php

namespace Tests\Feature\Frontend;

use Tests\TestCase;

class UsersListTest extends TestCase
{
    /** @test */
    function users_list_is_available()
    {
        $this->withoutExceptionHandling();

        $this->get("/players")
            ->assertOk();
    }
}
