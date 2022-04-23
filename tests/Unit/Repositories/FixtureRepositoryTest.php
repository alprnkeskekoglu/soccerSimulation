<?php

namespace Tests\Unit\Repositories;

use App\Models\Fixture;
use App\Models\Team;
use App\Repositories\FixtureRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

class FixtureRepositoryTest extends TestCase
{
    use WithFaker;

    protected FixtureRepository|Mockery $repository;
    protected Team|Mockery $team;
    protected Fixture|Mockery $fixture;

    public function setUp(): void
    {
        parent::setUp();
        $this->team = Mockery::mock(Team::class);
        $this->fixture = Mockery::mock(Fixture::class);
        $this->repository = Mockery::mock(FixtureRepository::class, [$this->fixture])->makePartial();
    }

    public function testGetByWeek()
    {
        $week = $this->faker->randomDigitNotNull;

        $collection = Mockery::mock(Collection::class);

        $this->fixture->shouldReceive('where')->with('week', $week)->andReturnSelf();
        $this->fixture->shouldReceive('get')->andReturn($collection);

        $this->assertSame($collection, $this->repository->getByWeek($week));
    }

    public function testGetAll()
    {
        $collection = Mockery::mock(Collection::class);

        $this->fixture->shouldReceive('all')->andReturn($collection);
        $this->assertSame($collection, $this->repository->getAll());
    }

    public function testGetGroupedByWeek()
    {
        $collection = Mockery::mock(Collection::class);

        $this->fixture->shouldReceive('all')->andReturnSelf();
        $this->fixture->shouldReceive('groupBy')->with('week')->andReturn($collection);

        $this->assertSame($collection, $this->repository->getGroupedByWeek());
    }

    public function testGetUnplayedMatches()
    {
        $collection = Mockery::mock(Collection::class);

        $this->fixture->shouldReceive('where')->with('played', false)->andReturnSelf();
        $this->fixture->shouldReceive('get')->andReturn($collection);

        $this->assertSame($collection, $this->repository->getUnplayedMatches());
    }

    public function testGetByTeam()
    {
        $collection = Mockery::mock(Collection::class);

        $this->team->shouldReceive('getAttribute')->with('id')->andReturn($this->team->id);

        $this->fixture->shouldReceive('where')->with('home_team_id', $this->team->id)->andReturnSelf();
        $this->fixture->shouldReceive('orWhere')->with('away_team_id', $this->team->id)->andReturnSelf();
        $this->fixture->shouldReceive('orderBy')->with('week')->andReturnSelf();
        $this->fixture->shouldReceive('get')->andReturn($collection);


        $this->assertSame($collection, $this->repository->getByTeam($this->team));
    }

    public function testStore()
    {
        $data = [
            'week' => $this->faker->randomDigitNotNull,
            'home_team_id' => $this->faker->randomDigitNotNull,
            'away_team_id' => $this->faker->randomDigitNotNull,
        ];

        $this->fixture->shouldReceive('create')->with($data)->andReturnSelf();

        $this->assertSame($this->fixture, $this->repository->store($data));
    }

    public function testUpdate()
    {
        $data = [
            'week' => $this->faker->randomDigitNotNull,
            'home_team_score' => $this->faker->randomDigitNotNull,
            'away_team_score' => $this->faker->randomDigitNotNull,
            'played' => true,
        ];

        $this->fixture->shouldReceive('update')->with($data)->andReturnSelf();

        $this->assertSame($this->fixture, $this->repository->update($this->fixture, $data));
    }

    public function testGetLastWeek()
    {
        $week = $this->faker->randomDigitNotNull;

        $this->fixture->shouldReceive('getAttribute')->with('week')->andReturn($week);

        $this->fixture->shouldReceive('where')->with('played', true)->andReturnSelf();
        $this->fixture->shouldReceive('whereNotNull')->with(['home_team_id', 'away_team_id'])->andReturnSelf();
        $this->fixture->shouldReceive('groupBy')->with('week')->andReturnSelf();
        $this->fixture->shouldReceive('orderByDesc')->with('week')->andReturnSelf();
        $this->fixture->shouldReceive('first')->andReturnSelf();

        if ($this->fixture) {
            $this->assertSame($week + 1, $this->repository->getLastWeek());
        } else {
            $this->assertSame(1, $this->repository->getLastWeek());
        }
    }

    public function testGetWeekCount()
    {
        $week = $this->faker->randomDigitNotNull;

        $this->fixture->shouldReceive('getAttribute')->with('week')->andReturn($week);

        $this->fixture->shouldReceive('whereNotNull')->with(['home_team_id', 'away_team_id'])->andReturnSelf();
        $this->fixture->shouldReceive('groupBy')->with('week')->andReturnSelf();
        $this->fixture->shouldReceive('orderByDesc')->with('week')->andReturnSelf();
        $this->fixture->shouldReceive('first')->andReturnSelf();

        if ($this->fixture) {
            $this->assertSame($week, $this->repository->getWeekCount());
        } else {
            $this->assertSame(1, $this->repository->getWeekCount());
        }
    }

    public function testCheckFixtureIsGenerated()
    {
        $bool = $this->faker->boolean;

        $this->fixture->shouldReceive('exists')->andReturn($bool);

        $this->assertSame($bool, $this->repository->checkFixtureIsGenerated());
    }
}
