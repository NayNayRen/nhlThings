<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  public static function getLinescores()
  {
    $linescores = Http::get('https://api-web.nhle.com/v1/score/now')['games'];
    return $linescores;
  }

  public static function getWeeklyGames()
  {
    $weeklyGames = Http::get('https://api-web.nhle.com/v1/schedule/now')['gameWeek'];
    return $weeklyGames;
  }

  public static function getCurrentStandings()
  {
    $currentStandings = Http::get('https://api-web.nhle.com/v1/standings/now')['standings'];
    return $currentStandings;
  }

  public static function getBoxscores($id)
  {
    $boxscores = Http::get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/boxscore')->json();
    return $boxscores;
  }

  // public static function getTeam($teamAbbr)
  // {
  //   $team = Http::get('https://api-web.nhle.com/v1/club-stats-season/' . $teamAbbr)->json();
  //   return $team;
  // }
}
