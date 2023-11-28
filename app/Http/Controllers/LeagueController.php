<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LeagueController extends Controller
{
  public function index(Request $request)
  {
    $dailyGames = [];
    $dailyScoreboard = [];
    $selectedGames = [];
    $selectedScoreboard = [];
    $teamRoster = [];
    $selectedDate = $request->input('date');
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $weeklyGames = ApiController::getWeeklySchedule('now');
    // $linescores = ApiController::getLinescores();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
        $dailyScoreboard[] = ApiController::getScoreboard($weeklyGames[$i]['date']);
        // for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
        //   $dailyBoxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
        // }
      }
    }
    if ($selectedDate) {
      for ($i = 0; $i < count($weeklyGames); $i++) {
        if ($weeklyGames[$i]['date'] === $selectedDate) {
          $selectedGames[] = $weeklyGames[$i]['games'];
          $selectedScoreboard[] = ApiController::getScoreboard($weeklyGames[$i]['date']);
          // for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
          //   $selectedBoxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
          // }
        }
      }
      // dd($selectedGames);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => Carbon::parse($selectedDate)->toFormattedDateString(),
        // 'linescores' => $linescores,
        // 'scoreboard' => $selectedScoreboard,
        'dailyGames' => $selectedGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } else {
      // dd($dailyScoreboard);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => $currentDate,
        // 'linescores' => $linescores,
        // 'scoreboard' => $dailyScoreboard,
        'dailyGames' => $dailyGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    }
  }
}
