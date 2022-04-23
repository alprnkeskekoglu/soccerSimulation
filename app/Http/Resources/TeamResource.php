<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'power' => $this->power,
            'points' => $this->points,
            'won' => $this->won,
            'drawn' => $this->drawn,
            'lost' => $this->lost,
            'goals_for' => $this->goals_for,
            'goals_against' => $this->goals_against,
            'goal_difference' => $this->goal_difference,
        ];
    }
}
