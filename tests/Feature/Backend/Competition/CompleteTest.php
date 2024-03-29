<?php

namespace Tests\Feature\Backend\Competition;

use App\Http\Livewire\Competition\Complete;
use App\Models\Competition\Competition;
use App\Models\Tourney\SeasonRacer;
use App\Models\Trophy;
use App\Models\User;
use App\Settings\SeasonSettings;
use Livewire\Livewire;
use Tests\TestCase;

class CompleteTest extends TestCase
{
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
    function completing_a_competition_creates_competition_users_records_with_valid_pts()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        // Create several users with usernames from NFSUServer test data
        User::factory()->create(['username' => 'Muxomor']);     // 100 + 0 pts
        User::factory()->create(['username' => 'Stas']);        // 91 + 91 pts
        User::factory()->create(['username' => 'Spier']);       // 86 + 0 pts
        User::factory()->create(['username' => 'samurai']);     // 0 + 100 pts

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $muxomor = $competition->racers()->where('username', 'Muxomor')->firstOrFail();
        $stas = $competition->racers()->where('username', 'Stas')->firstOrFail();
        $spies = $competition->racers()->where('username', 'Spier')->firstOrFail();
        $samurai = $competition->racers()->where('username', 'samurai')->firstOrFail();

        $this->assertEquals(100, $muxomor->pts);
        $this->assertEquals(182, $stas->pts);
        $this->assertEquals(86, $spies->pts);
        $this->assertEquals(100, $samurai->pts);

        $this->assertDatabaseCount('competition_racers', 4);
    }

    /** @test */
    function each_competition_racer_earns_site_points_when_the_competition_is_completed()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        /** @var User $muxomor */
        $muxomor = User::factory()->create(['username' => 'Muxomor']);     // 100 + 0 pts
        /** @var User $stas */
        $stas = User::factory()->create(['username' => 'Stas']);        // 91 + 91 pts

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertEquals(1, $muxomor->fresh()->competitions_count);
        $this->assertEquals(10, $muxomor->fresh()->site_points);
        $this->assertEquals(1, $stas->fresh()->competitions_count);
        $this->assertEquals(10, $stas->fresh()->site_points);
    }

    /** @test */
    function winners_get_trophies_when_the_competition_is_completed()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $muxomor = User::factory()->create(['username' => 'Muxomor']);     // 100 + 0 pts
        $stas = User::factory()->create(['username' => 'Stas']);        // 91 + 91 pts
        $spier = User::factory()->create(['username' => 'Spier']);     // 86 + 0 pts

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertDatabaseCount('trophies', 3);

        $winner = Trophy::where('place', 1)->first();
        $second = Trophy::where('place', 2)->first();
        $third = Trophy::where('place', 3)->first();

        $this->assertTrue($winner->user->is($stas));
        $this->assertTrue($second->user->is($muxomor));
        $this->assertTrue($third->user->is($spier));
    }

    /** @test */
    function each_competition_racer_updates_their_season_statistic_when_the_competition_is_completed()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        User::factory()->create(['username' => 'Muxomor']);     // 100 + 0 pts
        User::factory()->create(['username' => 'Stas']);        // 91 + 91 pts
        User::factory()->create(['username' => 'samurai']);     // 0 + 100 pts

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $muxomor = $competition->racers()->where('username', 'Muxomor')->firstOrFail();
        $stas = $competition->racers()->where('username', 'Stas')->firstOrFail();
        $samurai = $competition->racers()->where('username', 'samurai')->firstOrFail();

        $sr = SeasonRacer::where(['user_id' => $stas->user_id, 'season_index' => app(SeasonSettings::class)->index])->first();
        $this->assertEquals(1, $sr->competition_count);
        $this->assertEquals(182, $sr->competition_pts);

        $sr = SeasonRacer::where(['user_id' => $muxomor->user_id, 'season_index' => app(SeasonSettings::class)->index])->first();
        $this->assertEquals(1, $sr->competition_count);
        $this->assertEquals(100, $sr->competition_pts);

        $sr = SeasonRacer::where(['user_id' => $samurai->user_id, 'season_index' => app(SeasonSettings::class)->index])->first();
        $this->assertEquals(1, $sr->competition_count);
        $this->assertEquals(100, $sr->competition_pts);

        $this->assertDatabaseCount('season_racers', 3);
    }

    /** @test */
    function each_competition_racer_get_activity_log_record()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        User::factory()->create(['username' => 'Muxomor']);     // 100 + 0 pts
        User::factory()->create(['username' => 'Stas']);        // 91 + 91 pts
        User::factory()->create(['username' => 'samurai']);     // 0 + 100 pts

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertDatabaseCount('activity_log', 3);
    }
}
