<?php

namespace App\Repositories;

use App\Contracts\TeamInterface;
use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

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

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->orderByDesc('points')->get();
    }


    /**
     * @param Fixture $fixture
     * @param array $data
     * @return void
     */
    public function update(Fixture $fixture, array $data): void
    {
        $homeTeam = $fixture->homeTeam;
        $awayTeam = $fixture->awayTeam;
        $homeScore = $data['home_team_score'];
        $awayScore = $data['away_team_score'];

        if ($homeScore > $awayScore) {
            $this->won($homeTeam, $homeScore, $awayScore);
            $this->lost($awayTeam, $awayScore, $homeScore);
        } elseif ($homeScore < $awayScore) {
            $this->won($awayTeam, $awayScore, $homeScore);
            $this->lost($homeTeam, $homeScore, $awayScore);
        } else {
            $this->drawn($homeTeam, $homeScore, $awayScore);
            $this->drawn($awayTeam, $awayScore, $homeScore);
        }
    }

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function won(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->won++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->points += 3;
        $team->save();
    }

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function drawn(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->drawn++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->points++;
        $team->save();
    }

    /**
     * @param Team $team
     * @param int $goalsFor
     * @param int $goalsAgainst
     * @return void
     */
    public function lost(Team $team, int $goalsFor, int $goalsAgainst): void
    {
        $team->lost++;
        $team->goals_for += $goalsFor;
        $team->goals_against += $goalsAgainst;
        $team->save();
    }
}
