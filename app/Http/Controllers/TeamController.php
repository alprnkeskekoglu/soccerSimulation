<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Repositories\TeamRepository;

class TeamController extends Controller
{
    /**
     * @param TeamRepository $teamRepository
     */
    public function __construct(protected TeamRepository $teamRepository)
    {
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $teams = $this->teamRepository->getAll();
        $data = TeamResource::collection($teams);

        return response()->json($data);
    }
}
