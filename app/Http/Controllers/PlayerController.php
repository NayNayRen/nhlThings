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
    $firstHalfSeason = [];
    $secondHalfSeason = [];
    $player = ApiController::getPlayer($id);
    $playerName = $player['firstName']['default'] . ' ' . $player['lastName']['default'];
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    $season = (string)$allTeams[0]['seasonId'];
    $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
    $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $player['currentTeamAbbrev']) {
        $team[] = $allTeams[$i];
        $teamRoster[] = ApiController::getTeamRoster($player['currentTeamAbbrev']);
      }
    }
    // dd($player);
    return view('player', [
      'favIcon' => $team[0]['teamLogo'],
      'title' => $playerName,
      'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
      'player' => $player,
      'teamRoster' => $teamRoster[0],
      'soloTeam' => $team[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
