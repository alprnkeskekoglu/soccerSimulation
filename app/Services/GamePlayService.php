<?php

namespace App\Services;

use App\Models\Fixture;

class GamePlayService
{
    /**
     * @param Fixture $fixture
     * @return array
     */
    public function play(Fixture $fixture): array
    {
        $homeTeam = $fixture->homeTeam;
        $awayTeam = $fixture->awayTeam;

        $homeScore = $awayScore = 0;
        for ($i = 10; $i <= 90; $i += 10) {
            if ($this->roll(65)) { // attack change for homeTeam
                $homeScore += $this->score($homeTeam->power);
            } else {
                $awayScore += $this->score($awayTeam->power);
            }
        }

        return [
            'home_team_score' => $homeScore,
            'away_team_score' => $awayScore,
        ];
    }

    /**
     * @param int $power
     * @return int
     */
    public function score(int $power): int
    {
        if ($this->roll($power)) {
            return 1;
        }
        return 0;
    }

    /**
     * @param int $change
     * @return bool
     */
    public function roll(int $change): bool
    {
        if (rand(0, 100) <= $change) {
            return true;
        }
        return false;
    }
}
