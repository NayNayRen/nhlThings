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
    $today = Carbon::today();
    $currentDate = Carbon::create($today)->toFormattedDateString();
    $linescores = Http::get('https://api-web.nhle.com/v1/score/now')['games'];
    $weeklyGames = Http::get('https://api-web.nhle.com/v1/schedule/now')['gameWeek'];
    $currentStandings = Http::get('https://api-web.nhle.com/v1/standings/now')['standings'];
    $sortedStandingsByName = collect($currentStandings)->sortBy('teamName');
    // dd($weeklyGames);
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
        for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
          $boxscores[] = Http::get('https://api-web.nhle.com/v1/gamecenter/' . $weeklyGames[$i]['games'][$x]['id'] . '/boxscore')->json();
        }
      }
    }
    // dd($linescores);
    return view('index', [
      'currentDate' => $currentDate,
      'linescores' => $linescores,
      'boxscores' => $boxscores,
      'dailyGames' => $dailyGames,
      'weeklyGames' => $weeklyGames,
      'currentStandings' => $currentStandings,
      'sortedStandingsByName' => $sortedStandingsByName
    ]);
  }
}
