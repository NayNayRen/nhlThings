<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
  public function game($id)
  {
    $teamRoster = [];
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    $gameBoxscores = ApiController::getBoxscores($id);
    $gameMatchup = ApiController::getGameMatchup($id);
    // dd($gameMatchup);
    return view('game', [
      'favIcon' => '../img/nhl-shield.png',
      'title' => $gameMatchup['awayTeam']['abbrev'] . ' vs ' . $gameMatchup['homeTeam']['abbrev'],
      'currentDate' => $currentDate,
      'teamRoster' => $teamRoster,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
