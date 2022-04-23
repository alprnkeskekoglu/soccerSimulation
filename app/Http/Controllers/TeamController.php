<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeamResource;
use App\Models\Team;
use App\Repositories\TeamRepository;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function __construct(protected TeamRepository $teamRepository)
    {
    }

    public function getAll()
    {
        $teams = $this->teamRepository->getAll();
        $data = TeamResource::collection($teams);

        return response()->json($data);
    }
}
