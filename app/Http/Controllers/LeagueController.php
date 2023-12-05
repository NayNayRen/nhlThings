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
    $east = [];
    $west = [];
    $atlantic = [];
    $central = [];
    $metro = [];
    $pacific = [];
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
    for ($i = 0; $i < count($allTeams); $i++) {
      if ($allTeams[$i]['conferenceName'] === 'Eastern') {
        $east[] = $allTeams[$i];
      }
      if ($allTeams[$i]['conferenceName'] === 'Western') {
        $west[] = $allTeams[$i];
      }
      if ($allTeams[$i]['divisionName'] === 'Atlantic') {
        $atlantic[] = $allTeams[$i];
      }
      if ($allTeams[$i]['divisionName'] === 'Central') {
        $central[] = $allTeams[$i];
      }
      if ($allTeams[$i]['divisionName'] === 'Metropolitan') {
        $metro[] = $allTeams[$i];
      }
      if ($allTeams[$i]['divisionName'] === 'Pacific') {
        $pacific[] = $allTeams[$i];
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
        'season' => $dailyGames[0][0]['season'],
        'currentDate' => Carbon::parse($selectedDate)->toFormattedDateString(),
        'dailyGames' => $selectedGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName,
        'east' => $east,
        'west' => $west,
        'atlantic' => $atlantic,
        'central' => $central,
        'metro' => $metro,
        'pacific' => $pacific
      ]);
    } else {
      // dd($allTeams);
      return view('index', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => 'NHL Teams, Stats & Things',
        'season' => $dailyGames[0][0]['season'],
        'currentDate' => $currentDate,
        'dailyGames' => $dailyGames[0],
        'weeklyGames' => $weeklyGames,
        'allTeams' => $allTeams,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName,
        'east' => $east,
        'west' => $west,
        'atlantic' => $atlantic,
        'central' => $central,
        'metro' => $metro,
        'pacific' => $pacific
      ]);
    }
  }
}
