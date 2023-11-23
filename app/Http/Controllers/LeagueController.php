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
    $linescores = ApiController::getLinescores();
    $weeklyGames = ApiController::getWeeklyGames();
    $currentStandings = ApiController::getCurrentStandings();
    $sortedStandingsByName = collect($currentStandings)->sortBy('teamName');
    // dd($weeklyGames);
    for ($i = 0; $i < count($weeklyGames); $i++) {
      if ($weeklyGames[$i]['date'] === $today->toDateString()) {
        $dailyGames[] = $weeklyGames[$i]['games'];
        for ($x = 0; $x < count($weeklyGames[$i]['games']); $x++) {
          $boxscores[] = ApiController::getBoxscores($weeklyGames[$i]['games'][$x]['id']);
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
