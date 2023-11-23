<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TeamController extends Controller
{
  public function team($teamAbbr)
  {
    $team = [];
    $currentStandings = ApiController::getCurrentStandings();
    $sortedStandingsByName = collect($currentStandings)->sortBy('teamName');
    for ($i = 0; $i < count($currentStandings); $i++) {
      if ($currentStandings[$i]['teamAbbrev']['default'] === $teamAbbr) {
        $team[] = $currentStandings[$i];
      }
    }
    // dd($team);
    return view('team', [
      'title' => $team[0]['teamName']['default'],
      'team' => $team,
      'sortedStandingsByName' => $sortedStandingsByName
    ]);
  }
}
