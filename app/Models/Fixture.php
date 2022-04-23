<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fixture
 * @property-read int $id
 * @property int $week
 * @property int $home_team_id
 * @property int $away_team_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */

class Fixture extends Model
{
    protected $fillable = [
        'id',
        'week',
        'home_team_id',
        'away_team_id',
        'created_at',
        'updated_at'
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
