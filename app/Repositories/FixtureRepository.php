<?php

namespace App\Repositories;

use App\Contracts\FixtureInterface;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class FixtureRepository implements FixtureInterface
{
    /**
     * @param Fixture $model
     */
    public function __construct(protected Fixture $model)
    {
    }

    /**
     * @param int $week
     * @return Fixture
     */
    public function getByWeek(int $week): Fixture
    {
        return $this->model->where('week', $week)->first();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param Team $team
     * @return Collection
     */
    public function getByTeam(Team $team): Collection
    {
        return $this->model->where('home_team_id', $team->id)
            ->orWhere('away_team_id', $team->id)
            ->orderBy('week')
            ->get();
    }

    /**
     * @param array $data
     * @return Fixture
     */
    public function store(array $data): Fixture
    {
        return $this->model->create($data);
    }

    /**
     * @param Fixture $fixture
     * @param array $data
     * @return Fixture
     */
    public function update(Fixture $fixture, array $data): Fixture
    {
        $fixture->update($data);

        return $fixture;
    }
}
