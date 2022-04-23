<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fixture
 * @property-read int $id
 * @property int $week
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $home_team_score
 * @property int $away_team_score
 * @property boolean $played
 * @property Team $homeTeam
 * @property Team $awayTeam
 * @mixin Builder
 */
class Fixture extends Model
{
    protected $fillable = [
        'id',
        'week',
        'home_team_id',
        'away_team_id',
        'home_team_score',
        'away_team_score',
        'played'
    ];
    public $timestamps = false;

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
