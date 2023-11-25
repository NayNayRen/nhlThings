<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
  public function team($teamAbbr)
  {
    $team = [];
    $teamSchedule = [];
    $teamRoster = [];
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $teamAbbr) {
        $team[] = $allTeams[$i];
        $teamSchedule[] = ApiController::getTeamSchedule($teamAbbr);
        $teamRoster[] = ApiController::getTeamRoster($teamAbbr);
      }
    }

    dd($teamSchedule[0][0]);
    return view('team', [
      'title' => $team[0]['teamName']['default'],
      'soloTeam' => $team[0],
      'regularSeason' => $teamSchedule[0][0],
      'preseason' => $teamSchedule[0][1],
      'teamRoster' => $teamRoster[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
