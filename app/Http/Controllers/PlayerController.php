<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
  public function player($id)
  {
    try {
      // 8473419
      $team = [];
      $teamRoster = [];
      $firstHalfSeason = [];
      $secondHalfSeason = [];
      $regularSeason = [];
      $playoffSeason = [];
      $proCareer = [];
      $player = ApiController::getPlayer($id);
      $playerName = $player['firstName']['default'] . ' ' . $player['lastName']['default'];
      $allTeams = ApiController::getAllTeams();
      $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
      $season = (string)$allTeams[0]['seasonId'];
      $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
      $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];

      function minutesToSeconds($time)
      {
        $parts = explode(':', $time);
        $seconds = ($parts[0] * 60) + $parts[1];
        return $seconds;
      }
      function secondsToMinutes($secondsArray)
      {
        $totalSeconds = array_sum($secondsArray);
        $secondsToMinutes = gmdate("H:i:s", $totalSeconds);
        return $secondsToMinutes;
      }

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
          $regularSeason[] = $player['seasonTotals'][$i];
        }
        if ($player['seasonTotals'][$i]['leagueAbbrev'] === 'NHL' && $player['seasonTotals'][$i]['gameTypeId'] === 3) {
          $playoffSeason[] = $player['seasonTotals'][$i];
        }
      }
      // dd($player);
      return view('player', [
        'favIcon' => $team[0]['teamLogo'],
        'title' => $playerName,
        'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
        'player' => $player,
        'proCareer' => array_reverse($proCareer),
        'regularSeason' => array_reverse($regularSeason),
        'playoffSeason' => array_reverse($playoffSeason),
        'teamRoster' => $teamRoster[0],
        'soloTeam' => $team[0],
        'allTeams' => $allTeams,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } catch (Exception $error) {
      $message = $error->getMessage();
      $code = $error->getCode();
      if ($code === 404) {
        return view('errors/404', [
          'favIcon' => '../img/nhl-shield.png',
          'title' => 'Resource Not Found',
          'message' => 'Code ' . $code . " : We can't seem to find that resource..."
        ]);
      } elseif ($code != 404) {
        return view('errors/404', [
          'favIcon' => '../img/nhl-shield.png',
          'title' => 'Internal Server Error',
          'message' => 'Code ' . $code . ' : ' . $message
        ]);
      }
    }
  }
}
