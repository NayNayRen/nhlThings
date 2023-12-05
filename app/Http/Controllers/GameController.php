<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
  public function game($id)
  {
    $teamRoster = [];
    $firstHalfSeason = [];
    $secondHalfSeason = [];
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    $season = (string)$allTeams[0]['seasonId'];
    $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
    $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
    $gameBoxscores = ApiController::getBoxscores($id);
    $gameMatchup = ApiController::getGameMatchup($id);
    // dd($gameMatchup);
    return view('game', [
      'favIcon' => '../img/nhl-shield.png',
      'title' => $gameMatchup['awayTeam']['abbrev'] . ' vs ' . $gameMatchup['homeTeam']['abbrev'],
      'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
      'gameBoxscores' => $gameBoxscores,
      'gameMatchup' => $gameMatchup,
      'currentDate' => $currentDate,
      'teamRoster' => $teamRoster,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
