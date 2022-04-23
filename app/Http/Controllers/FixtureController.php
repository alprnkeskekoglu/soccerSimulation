<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureResource;
use App\Models\Fixture;
use App\Repositories\FixtureRepository;
use App\Repositories\TeamRepository;
use App\Services\FixtureGenerateService;
use App\Services\GamePlayService;
use App\Services\PredictionService;

class FixtureController extends Controller
{
    /**
     * @param TeamRepository $teamRepository
     * @param FixtureRepository $fixtureRepository
     * @param FixtureGenerateService $fixtureGenerateService
     * @param PredictionService $predictionService
     * @param GamePlayService $gamePlayService
     */
    public function __construct(
        protected TeamRepository $teamRepository,
        protected FixtureRepository $fixtureRepository,
        protected FixtureGenerateService $fixtureGenerateService,
        protected PredictionService $predictionService,
        protected GamePlayService $gamePlayService
    ) {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getGroupedByWeek()
    {
        $fixtures = $this->fixtureRepository->getGroupedByWeek();
        $data = [];

        foreach ($fixtures as $week => $fixture) {
            $data[$week] = FixtureResource::collection($fixture);
        }
        return response()->json($data);
    }

    /**
     * @param int $week
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByWeek(int $week)
    {
        $fixtures = $this->fixtureRepository->getByWeek($week);
        $data = FixtureResource::collection($fixtures);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function generate()
    {
        $teams = $this->teamRepository->getAll();
        foreach ($teams as $team) {
            $this->predictionService->predict();
        }
        if (Fixture::exists()) {
            return response()->json(['message' => 'Fixtures already generated']);
        }

        $teams = $this->teamRepository->getAll();
        $fixtures = $this->fixtureGenerateService->generate($teams->toArray());

        foreach ($fixtures as $fixture) {
            foreach ($fixture as $item) {
                $this->fixtureRepository->store($item);
            }
        }

        return response()->json(['message' => 'Fixtures generated successfully']);
    }
}
