<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read integer $id
 * @property string $name
 * @property int $power
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class Team extends Model
{
    protected $fillable = [
        'name',
        'power',
        'created_at',
        'updated_at',
    ];
}
