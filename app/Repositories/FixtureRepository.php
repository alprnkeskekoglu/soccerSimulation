<?php

namespace App\Repositories;

use App\Contracts\FixtureInterface;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Artisan;

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

    public function refresh()
    {
        Artisan::call('migrate:refresh', ['--seed' => true]);
    }

    /**
     * @return int
     */
    public function getLastWeek(): int
    {
        $fixture = $this->model->where('played', true)
            ->whereNotNull(['home_team_id', 'away_team_id'])
            ->groupBy('week')
            ->orderByDesc('week')
            ->first();
        if ($fixture) {
            return $fixture->week + 1;
        }
        return 1;
    }

    /**
     * @return int
     */
    public function getWeekCount(): int
    {
        $fixture = $this->model->whereNotNull(['home_team_id', 'away_team_id'])
            ->groupBy('week')
            ->orderByDesc('week')
            ->first();

        if ($fixture) {
            return $fixture->week;
        }
        return 1;
    }

    /**
     * @return bool
     */
    public function checkFixtureIsGenerated(): bool
    {
        return $this->model->exists();
    }
}
