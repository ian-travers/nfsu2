<?php

namespace Tests\Unit\NFSUServer;

use App\Models\NFSUServer\Ratings;
use DomainException;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RatingsTest extends TestCase
{
    /** @test */
    function it_returns_collections_when_ratings_requested()
    {
        $ratings = new Ratings(base_path('tests/NFSUServerData/stat.dat'));

        $this->assertInstanceOf(Collection::class, $ratings->overall());
        $this->assertInstanceOf(Collection::class, $ratings->circuit());
        $this->assertInstanceOf(Collection::class, $ratings->sprint());
        $this->assertInstanceOf(Collection::class, $ratings->drag());
        $this->assertInstanceOf(Collection::class, $ratings->drift());
    }

    /** @test */
    function it_throws_a_domain_exception_when_no_stat_file_is_found()
    {
        $this->expectException(DomainException::class);

        new Ratings('fake_file');
    }
}
