<?php

namespace Tests\Unit\NFSUServer;

use App\Models\NFSUServer\BestPerformers;
use DomainException;
use Illuminate\Support\Collection;
use Tests\TestCase;

class BestPerformersTest extends TestCase
{
    protected string $dataPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->dataPath = base_path('tests/NFSUServerData');
    }

    /** @test */
    function it_checks_whether_the_track_is_invalid()
    {
        $this->expectException(DomainException::class);

        new BestPerformers($this->dataPath, 9999);
    }

    /** @test */
    function it_detects_a_drift_track()
    {
        $this->assertFalse((new BestPerformers($this->dataPath, 1001))->isDrift());
        $this->assertFalse((new BestPerformers($this->dataPath, 1102))->isDrift());
        $this->assertFalse((new BestPerformers($this->dataPath, 1201))->isDrift());
        $this->assertTrue((new BestPerformers($this->dataPath, 1301))->isDrift());
    }

    /** @test */
    function it_returns_rating_as_a_collection()
    {
        $rating = (new BestPerformers($this->dataPath, 1301))->rating();


        $this->assertInstanceOf(Collection::class, $rating);
    }
}
