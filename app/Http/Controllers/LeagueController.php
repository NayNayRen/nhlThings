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
    $selectedGames = [];
    $teamRoster = [];
    $selectedDate = $request->input('date');
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $allTeams = ApiController::getAllTeams();
    $weeklyGames = ApiController::getWeeklyGames('now');
    $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
      }
    }
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
        'dailyGames' => $selectedGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } else {
      // dd($allTeams[0]);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'currentDate' => $currentDate,
        'dailyGames' => $dailyGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    }
  }
}
