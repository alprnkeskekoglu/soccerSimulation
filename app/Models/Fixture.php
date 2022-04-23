<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Fixture
 * @property-read int $id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property int $home_team_score
 * @property int $away_team_score
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */

class Fixture extends Model
{
    protected $fillable = [
        'id',
        'home_team_id',
        'away_team_id',
        'home_team_score',
        'away_team_score',
        'created_at',
        'updated_at'
    ];

}
