<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
  public function player($id)
  {
    // 8473419
    $team = [];
    $teamRoster = [];
    $player = ApiController::getPlayer($id);
    $playerName = $player['firstName']['default'] . ' ' . $player['lastName']['default'];
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $player['currentTeamAbbrev']) {
        $team[] = $allTeams[$i];
        $teamRoster[] = ApiController::getTeamRoster($player['currentTeamAbbrev']);
      }
    }
    // dd($player);
    return view('player', [
      'title' => $playerName,
      'player' => $player,
      'teamRoster' => $teamRoster[0],
      'soloTeam' => $team[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
