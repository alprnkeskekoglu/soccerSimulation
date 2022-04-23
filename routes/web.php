<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/fixture', function () {
    return view('fixture');
})->name('fixtures.index');

Route::get('/simulation', function () {
    return view('simulation');
})->name('simulations.index');

