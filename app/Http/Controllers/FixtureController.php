<?php

namespace App\Http\Controllers;

use App\Http\Resources\FixtureResource;
use App\Models\Fixture;
use App\Repositories\FixtureRepository;
use App\Repositories\TeamRepository;
use App\Services\FixtureGenerateService;
use App\Services\GamePlayService;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function __construct(
        protected TeamRepository         $teamRepository,
        protected FixtureRepository      $fixtureRepository,
        protected FixtureGenerateService $fixtureGenerateService,
        protected GamePlayService        $gamePlayService
    )
    {
    }

    public function getGroupedByWeek()
    {
        $fixtures = $this->fixtureRepository->getGroupedByWeek();
        $data = [];

        foreach ($fixtures as $week => $fixture) {
            $data[$week] = FixtureResource::collection($fixture);
        }
        return response()->json($data);
    }

    public function generate()
    {
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
