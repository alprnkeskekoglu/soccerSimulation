<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Repositories\FixtureRepository;
use App\Repositories\TeamRepository;
use App\Services\FixtureGenerateService;
use App\Services\GamePlayService;

class SimulationController extends Controller
{
    public function __construct(
        protected TeamRepository         $teamRepository,
        protected FixtureRepository      $fixtureRepository,
        protected FixtureGenerateService $fixtureGenerateService,
        protected GamePlayService        $gamePlayService
    )
    {
    }

    public function getLastWeek()
    {
        $week = $this->fixtureRepository->getLastWeek();
        return response()->json($week);
    }

    public function getWeekCount()
    {
        $week = $this->fixtureRepository->getWeekCount();
        return response()->json($week);
    }

    public function play(int $week)
    {
        $fixtures = $this->fixtureRepository->getByWeek($week);
        foreach ($fixtures as $fixture) {
            $this->playGame($fixture);
        }
    }

    public function playAll()
    {
        $fixtures = $this->fixtureRepository->getUnplayedMatches();
        foreach ($fixtures as $fixture) {
            $this->playGame($fixture);
        }
    }

    public function refresh()
    {
        $this->fixtureRepository->refresh();

        $teams = $this->teamRepository->getAll();
        $fixtures = $this->fixtureGenerateService->generate($teams->toArray());

        foreach ($fixtures as $fixture) {
            foreach ($fixture as $item) {
                $this->fixtureRepository->store($item);
            }
        }
    }

    private function playGame(Fixture $fixture)
    {
        if ($fixture->homeTeam && $fixture->awayTeam) {
            $result = $this->gamePlayService->play($fixture);
            $this->fixtureRepository->update($fixture, $result);
            $this->teamRepository->update($fixture, $result);
        }
    }
}
