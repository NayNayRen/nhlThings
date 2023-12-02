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
    $upcomingGames = [];
    $upcomingDates = [];
    $finishedGames = [];
    $finishedDates = [];
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['teamAbbrev']['default'] === $teamAbbr) {
        $team[] = $allTeams[$i];
        $teamSchedule[] = ApiController::getTeamSchedule($teamAbbr);
        $teamRoster[] = ApiController::getTeamRoster($teamAbbr);
      }
    }
    // for ($i = 0; $i < count($teamSchedule[0][0]); $i++) {
    //   $upcomingDates[] = ApiController::getDailyGames($teamSchedule[0][0][$i]['gameDate']);
    // }
    // for ($i = 0; $i < count($upcomingDates); $i++) {
    //   for ($x = 0; $x < count($upcomingDates[$i]['games']); $x++) {
    //     if ($upcomingDates[$i]['games'][$x]['awayTeam']['abbrev'] === $teamAbbr || $upcomingDates[$i]['games'][$x]['homeTeam']['abbrev'] === $teamAbbr) {
    //       $upcomingGames[] = $upcomingDates[$i]['games'][$x];
    //     }
    //   }
    // }
    for ($i = 0; $i < count($teamSchedule[0][1]); $i++) {
      $finishedDates[] = ApiController::getDailyGames($teamSchedule[0][1][$i]['gameDate']);
    }
    for ($i = 0; $i < count($finishedDates); $i++) {
      for ($x = 0; $x < count($finishedDates[$i]['games']); $x++) {
        if ($finishedDates[$i]['games'][$x]['awayTeam']['abbrev'] === $teamAbbr || $finishedDates[$i]['games'][$x]['homeTeam']['abbrev'] === $teamAbbr) {
          $finishedGames[] = $finishedDates[$i]['games'][$x];
        }
      }
    }
    // dd($teamSchedule[0][1]);
    return view('team', [
      'currentDate' => $currentDate,
      'favIcon' => $team[0]['teamLogo'],
      'title' => $team[0]['teamName']['default'],
      'soloTeam' => $team[0],
      'upcomingGames' => $teamSchedule[0][0],
      'finishedGames' => array_reverse($finishedGames),
      'preseason' => $teamSchedule[0][2],
      'teamRoster' => $teamRoster[0],
      'allTeams' => $allTeams,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
