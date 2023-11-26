<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\PlayerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LeagueController::class, 'index'])->name('league.index');

Route::get('/league/{team}', [TeamController::class, 'team'])->name('league.team');

Route::get('/team/{player}', [PlayerController::class, 'player'])->name('team.player');
