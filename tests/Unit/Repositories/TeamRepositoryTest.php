<?php

namespace Tests\Unit\Repositories;

use App\Models\Fixture;
use App\Models\Team;
use App\Repositories\TeamRepository;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Mockery;
use Illuminate\Foundation\Testing\WithFaker;

class TeamRepositoryTest extends TestCase
{
    use WithFaker;

    protected TeamRepository|Mockery $repository;
    protected Team|Mockery $team;
    protected Fixture|Mockery $fixture;

    public function setUp(): void
    {
        parent::setUp();
        $this->team = Mockery::mock(Team::class);
        $this->fixture = Mockery::mock(Fixture::class);
        $this->repository = Mockery::mock(TeamRepository::class, [$this->team])->makePartial();
    }

    public function testGetById()
    {
        $id = $this->faker->randomDigitNotNull;

        $this->team->shouldReceive('find')->with($id)->andReturnSelf();

        $this->assertSame($this->team, $this->repository->getById($id));
    }

    public function testGetAll()
    {
        $collection = Mockery::mock(Collection::class);

        $this->team->shouldReceive('orderByDesc', 'points')->andReturnSelf();
        $this->team->shouldReceive('get')->andReturn($collection);

        $this->assertSame($collection, $this->repository->getAll());
    }
}
