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
     * @return Collection
     */
    public function getByWeek(int $week): Collection
    {
        return $this->model->where('week', $week)->get();
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Collection
     */
    public function getGroupedByWeek(): Collection
    {
        return $this->model->all()->groupBy('week');
    }

    /**
     * @return Collection
     */
    public function getUnplayedMatches(): Collection
    {
        return $this->model->where('played', false)->get();
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
        $data['played'] = true;
        $fixture->update($data);

        return $fixture;
    }
}
