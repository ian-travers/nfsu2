<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase;

    protected function signIn($user = null): TestCase
    {
        $user = $user ?: User::factory()->create();

        $this->actingAs($user);

        return $this;
    }

}
