<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeagueController extends Controller
{
  public function index(Request $request)
  {
    $selectedDate = $request->input('date');
    $dailyGames = [];
    $selectedGames = [];
    $boxscores = [];
    $teamRoster = [];
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $weeklyGames = ApiController::getWeeklySchedule('now');
    $allTeams = ApiController::getAllTeams();
    $linescores = ApiController::getLinescores();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
        // for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
        //   $boxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
        // }
      }
    }
    if ($selectedDate) {
      for ($i = 0; $i < count($weeklyGames); $i++) {
        if ($weeklyGames[$i]['date'] === $selectedDate) {
          $selectedGames[] = $weeklyGames[$i]['games'];
          // for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
          //   $boxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
          // }
        }
      }
      // dd($selectedGames);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => Carbon::parse($selectedDate)->toFormattedDateString(),
        'linescores' => $linescores,
        // 'boxscores' => $boxscores,
        'dailyGames' => $selectedGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } else {
      // dd($dailyGames[0]);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => $currentDate,
        'linescores' => $linescores,
        // 'boxscores' => $boxscores,
        'dailyGames' => $dailyGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    }
  }
}
