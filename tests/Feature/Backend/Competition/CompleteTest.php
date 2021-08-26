<?php

namespace Tests\Feature\Backend\Competition;

use App\Http\Livewire\Competition\Complete;
use App\Models\Competition\Competition;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_complete_a_competition()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertTrue($competition->fresh()->isCompleted());
    }

    /** @test */
    function completing_a_competition_creates_competition_users_records()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        // Create a couple user with usernames from NFSUServer test data
        User::factory()->create(['username' => 'Muxomor']);
        User::factory()->create(['username' => 'Stas']);
        User::factory()->create(['username' => 'Spier']);
        User::factory()->create(['username' => 'samurai']);

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertDatabaseCount('competition_users', 4);
    }
}
