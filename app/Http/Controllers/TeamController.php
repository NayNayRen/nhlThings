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
    // $team = ApiController::getTeam($teamAbbr);
    // dd($currentStandings);
    return view('team', [
      'title' => 'Team Name',
      'team' => $team,
      'sortedStandingsByName' => $sortedStandingsByName
    ]);
  }
}
