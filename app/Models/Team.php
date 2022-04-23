<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read integer $id
 * @property string $name
 * @property int $power
 * @property int $points
 * @property int $won,
 * @property int $drawn,
 * @property int $lost,
 * @property int $goals_for,
 * @property int $goals_against,
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Team extends Model
{
    protected $fillable = [
        'name',
        'power',
        'points',
        'won',
        'drawn',
        'lost',
        'goals_for',
        'goals_against',
        'created_at',
        'updated_at',
    ];
    protected $appends = ['goal_difference'];

    public function fixtures()
    {
        return $this->hasMany(Fixture::class)->where('home_team_id', $this->id)->orWhere('away_team_id', $this->id);
    }

    public function goalDifference(): Attribute
    {
        return new Attribute(
            get: fn() => $this->goals_for - $this->goals_against
        );
    }
}
