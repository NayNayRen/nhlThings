<?php

use App\Http\Controllers\GameController;
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

Route::get('/teams/{team}', [TeamController::class, 'team'])->name('teams.team');

Route::get('/players/{player}', [PlayerController::class, 'player'])->name('players.player');

Route::get('/games/{game}', [GameController::class, 'game'])->name('games.game');
