<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeagueController extends Controller
{
  public function index()
  {
    $dailyGames = [];
    $boxscores = [];
    $teamRoster = [];
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $weeklyGames = ApiController::getWeeklySchedule();
    $allTeams = ApiController::getAllTeams();
    $linescores = ApiController::getLinescores();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    // dd($sortedTeamsByName[19]);
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
        for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
          $boxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
        }
      }
    }
    // dd($dailyGames);
    return view('index', [
      'title' => 'NHL Teams, Stats & Things',
      'currentDate' => $currentDate,
      'linescores' => $linescores,
      'boxscores' => $boxscores,
      'dailyGames' => $dailyGames[0],
      'weeklyGames' => $weeklyGames,
      'allTeams' => $allTeams,
      'teamRoster' => $teamRoster,
      'sortedTeamsByName' => $sortedTeamsByName
    ]);
  }
}
