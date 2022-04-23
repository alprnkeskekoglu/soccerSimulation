<?php

use App\Http\Controllers\FixtureController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SimulationController;
use Illuminate\Support\Facades\Route;

Route::controller(FixtureController::class)->prefix('fixtures')->group(function () {
    Route::get('get-grouped-by-week', 'getGroupedByWeek');
    Route::get('get-by-week/{week}', 'getByWeek');
    Route::get('generate', 'generate');
    Route::get('play/{week}', 'play');
    Route::get('play-all', 'playAll');
});
Route::controller(SimulationController::class)->prefix('simulations')->group(function () {
    Route::get('get-last-week', 'getLastWeek');
    Route::get('get-week-count', 'getWeekCount');
    Route::get('play/{week}', 'play');
    Route::get('play-all', 'playAll');
    Route::get('refresh', 'refresh');
});

Route::controller(TeamController::class)->prefix('teams')->group(function () {
    Route::get('get-all', 'getAll');
});
