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
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $teamAbbr) {
        $team[] = $allTeams[$i];
        $teamSchedule[] = ApiController::getFullSchedule(($teamAbbr));
      }
    }
    // dd($teamSchedule);
    return view('team', [
      'title' => $team[0]['teamName']['default'],
      'team' => $team[0],
      'teamSchedule' => $teamSchedule[0]['games'],
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
