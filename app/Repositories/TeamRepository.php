<?php

namespace App\Repositories;

use App\Contracts\TeamInterface;
use App\Models\Team;

class TeamRepository implements TeamInterface
{
    /**
     * @param Team $model
     */
    public function __construct(protected Team $model)
    {
    }

    /**
     * @param int $id
     * @return Team
     */
    public function getById(int $id): Team
    {
        return $this->model->find($id);
    }

    public function getChampionshipRate(Team $team): float
    {
        // TODO: Implement getChampionshipRate() method.
    }

    public function won(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->won++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->points += 3;
        $team->save();
    }

    public function drawn(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->drawn++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->points++;
        $team->save();
    }

    public function lost(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->lost++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->save();
    }
}
