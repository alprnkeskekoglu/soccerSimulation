<?php

namespace App\Services;

use App\Repositories\FixtureRepository;
use App\Repositories\TeamRepository;

class PredictionService
{

    public function __construct(
        protected TeamRepository    $teamRepository,
        protected FixtureRepository $fixtureRepository)
    {
    }

    public function predict(): array
    {
        $teams = $this->teamRepository->getAll();
        $remainingWeekCount = $this->fixtureRepository->getRemainingWeekCount();

        $maxPoint = $teams->first()->points;
        $maxGainPoint = $remainingWeekCount * 3;

        $total = $teams->where('points', '>=', $maxPoint - $maxGainPoint)->sum('points');

        $predicts = [];
        foreach ($teams as $team) {
            if ($team->points + $maxGainPoint < $maxPoint) {
                $predicts[] = [
                    'name' => $team->name,
                    'point' => 0,
                ];
            } else {
                $predicts[] = [
                    'name' => $team->name,
                    'point' => floor($team->points / ($total ?: 1) * 100),
                ];
            }
        }

        return $predicts;
    }
}
