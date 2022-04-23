<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::controller(FixtureController::class)->prefix('fixtures')->group(function () {
    Route::get('get-grouped-by-week', 'getGroupedByWeek');
    Route::get('generate', 'generate');
    Route::get('play/{week}', 'play');
    Route::get('play-all', 'playAll');
});

Route::controller(TeamController::class)->prefix('teams')->group(function () {
    Route::get('get-all', 'getAll');
});
