<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Repositories\FixtureRepository;
use App\Repositories\TeamRepository;
use App\Services\FixtureGenerateService;
use App\Services\GamePlayService;
use App\Services\PredictionService;

class SimulationController extends Controller
{
    /**
     * @param TeamRepository $teamRepository
     * @param FixtureRepository $fixtureRepository
     * @param FixtureGenerateService $fixtureGenerateService
     * @param GamePlayService $gamePlayService
     * @param PredictionService $predictionService
     */
    public function __construct(
        protected TeamRepository $teamRepository,
        protected FixtureRepository $fixtureRepository,
        protected FixtureGenerateService $fixtureGenerateService,
        protected GamePlayService $gamePlayService,
        protected PredictionService $predictionService
    ) {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLastWeek()
    {
        $week = $this->fixtureRepository->getLastWeek();
        return response()->json($week);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWeekCount()
    {
        $week = $this->fixtureRepository->getWeekCount();
        return response()->json($week);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPredictions()
    {
        $data = $this->predictionService->predict();
        return response()->json($data);
    }

    /**
     * @param int $week
     * @return void
     */
    public function play(int $week)
    {
        $fixtures = $this->fixtureRepository->getByWeek($week);
        foreach ($fixtures as $fixture) {
            $this->playGame($fixture);
        }
    }

    /**
     * @return void
     */
    public function playAll()
    {
        $fixtures = $this->fixtureRepository->getUnplayedMatches();
        foreach ($fixtures as $fixture) {
            $this->playGame($fixture);
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
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

    /**
     * @param Fixture $fixture
     * @return void
     */
    private function playGame(Fixture $fixture)
    {
        $result = [];
        if ($fixture->homeTeam && $fixture->awayTeam) {
            $result = $this->gamePlayService->play($fixture);
            $this->teamRepository->update($fixture, $result);
        }
        $this->fixtureRepository->update($fixture, $result);
    }
}
