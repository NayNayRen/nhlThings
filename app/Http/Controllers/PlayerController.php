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
    $nhlRegularCareer = [];
    $nhlPlayoffCareer = [];
    $proCareer = [];
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
    for ($i = 0; $i < count($player['seasonTotals']); $i++) {
      if ($player['seasonTotals'][$i]['leagueAbbrev'] === 'NHL') {
        $proCareer[] = $player['seasonTotals'][$i];
      }
      if ($player['seasonTotals'][$i]['leagueAbbrev'] === 'NHL' && $player['seasonTotals'][$i]['gameTypeId'] === 2) {
        $nhlRegularCareer[] = $player['seasonTotals'][$i];
      }
      if ($player['seasonTotals'][$i]['leagueAbbrev'] === 'NHL' && $player['seasonTotals'][$i]['gameTypeId'] === 3) {
        $nhlPlayoffCareer[] = $player['seasonTotals'][$i];
      }
    }
    // dd($proCareer);
    return view('player', [
      'favIcon' => $team[0]['teamLogo'],
      'title' => $playerName,
      'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
      'player' => $player,
      'proCareer' => array_reverse($proCareer),
      'nhlRegularCareer' => array_reverse($nhlRegularCareer),
      'nhlPlayoffCareer' => array_reverse($nhlPlayoffCareer),
      'teamRoster' => $teamRoster[0],
      'soloTeam' => $team[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
