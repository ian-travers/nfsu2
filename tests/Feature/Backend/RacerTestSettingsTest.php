<?php

namespace Tests\Feature\Backend;

use App\Http\Livewire\Dashboard\DashboardRacerTest;
use App\Models\User;
use App\RacerTestSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RacerTestSettingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function authenticated_user_can_update_racer_test_settings()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->assertEquals(6, app(RacerTestSettings::class)->questions_count);
        $this->assertEquals(0, app(RacerTestSettings::class)->allowed_errors_count);

        Livewire::test(DashboardRacerTest::class)
            ->set('questionsCount', 12)
            ->set('allowedErrorsCount', 2)
            ->call('submit');

        $this->assertEquals(12, app(RacerTestSettings::class)->questions_count);
        $this->assertEquals(2, app(RacerTestSettings::class)->allowed_errors_count);
    }
}
