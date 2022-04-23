<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FixtureResource extends JsonResource
{
    /**
     * @param $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'home_team' => $this->homeTeam ? $this->homeTeam->name : "N\A",
            'away_team' => $this->awayTeam ? $this->awayTeam->name : "N\A",
            'home_team_score' => $this->home_team_score === null ? '' : $this->home_team_score,
            'away_team_score' => $this->away_team_score === null ? '' : $this->away_team_score,
            'played_at' => $this->played,
        ];
    }
}
