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
    $dailyBoxscores = [];
    $selectedGames = [];
    $teamRoster = [];
    $selectedDate = $request->input('date');
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $weeklyGames = ApiController::getWeeklyGames('now');
    $linescores = ApiController::getLinescores();
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
      }
    }
    // for ($i = 0; $i < count($dailyGames[0]); $i++) {
    //   $dailyBoxscores[] = ApiController::getBoxscores($dailyGames[0][$i]['id']);
    // }
    if ($selectedDate) {
      for ($i = 0; $i < count($weeklyGames); $i++) {
        if ($weeklyGames[$i]['date'] === $selectedDate) {
          $selectedGames[] = $weeklyGames[$i]['games'];
        }
      }
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => Carbon::parse($selectedDate)->toFormattedDateString(),
        // 'linescores' => $linescores,
        'dailyGames' => $selectedGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } else {
      // dd($linescores);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => $currentDate,
        // 'linescores' => $linescores,
        'dailyGames' => $dailyGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    }
  }
}
