<?php

namespace App\Services;

class FixtureGenerateService
{
    /**
     * @param array $teams
     * @return array
     */
    public function generate(array $teams, bool $shuffle = true): array
    {
        $teamsCount = count($teams);

        if ($teamsCount % 2 === 1) { // for odd number of teams
            $teamsCount++;
            $teams[] = ['id' => null];
        }

        $halfTeamCount = $teamsCount / 2;
        $weeks = $this->getWeeks($teamsCount);

        if ($shuffle) {
            $this->shuffle($teams);
        }

        $fixtures = [];
        for ($week = 1; $week <= $weeks; $week++) {
            foreach ($teams as $index => $team) {
                if ($index >= $halfTeamCount) {
                    break;
                }
                $team1 = $team;
                $team2 = $teams[($teamsCount - $index - 1)];

                $fixtures[$week][] = $week % 2 === 1 ?
                    ['home_team_id' => $team1['id'], 'away_team_id' => $team2['id'], 'week' => $week] :
                    ['home_team_id' => $team2['id'], 'away_team_id' => $team1['id'], 'week' => $week];
            }
            $this->rotate($teams);
        }
        return $fixtures;
    }

    /**
     * @param array $teams
     * @return void
     */
    public function rotate(array &$teams): void
    {
        $temp[] = $teams[0];
        $secondItem = $teams[1];
        array_shift($teams);
        array_shift($teams);
        $temp = array_merge($temp, $teams);
        $temp[] = $secondItem;
        $teams = $temp;
    }

    /**
     * @param int $teamsCount
     * @return int
     */
    public function getWeeks(int $teamsCount): int
    {
        return ($teamsCount % 2 === 0 ? $teamsCount - 1 : $teamsCount) * 2;
    }

    /**
     * @param array $teams
     * @return void
     * @throws \Exception
     */
    public function shuffle(array &$teams): void
    {
        srand(random_int(PHP_INT_MIN, PHP_INT_MAX));
        shuffle($teams);
    }
}
