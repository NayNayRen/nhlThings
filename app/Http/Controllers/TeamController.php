<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
  public function team($teamAbbr)
  {
    $team = [];
    $teamSchedule = [];
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
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $teamAbbr) {
        $team[] = $allTeams[$i];
        $teamSchedule[] = ApiController::getTeamSchedule($teamAbbr);
        $teamRoster[] = ApiController::getTeamRoster($teamAbbr);
      }
    }
    // dd($defensemen);
    return view('team', [
      'currentDate' => $currentDate,
      'favIcon' => $team[0]['teamLogo'],
      'title' => $team[0]['teamName']['default'],
      'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
      'soloTeam' => $team[0],
      'upcomingGames' => $teamSchedule[0][0],
      'finishedGames' => array_reverse($teamSchedule[0][1]),
      'preseason' => $teamSchedule[0][2],
      'teamRoster' => $teamRoster[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
