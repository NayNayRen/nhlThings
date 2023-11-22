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
    $today = Carbon::now();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $weeklyGames = Http::get('https://api-web.nhle.com/v1/schedule/now')['gameWeek'];
    $currentStandings = Http::get('https://api-web.nhle.com/v1/standings/now')['standings'];
    $sortedStandingsByName = collect($currentStandings)->sortBy('teamName');
    // dd($weeklyGames);
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
      }
    }
    // dd($dailyGames[0]);
    return view('index', [
      'currentDate' => $currentDate,
      'dailyGames' => $dailyGames,
      'weeklyGames' => $weeklyGames,
      'currentStandings' => $currentStandings,
      'sortedStandingsByName' => $sortedStandingsByName
    ]);
  }
}
