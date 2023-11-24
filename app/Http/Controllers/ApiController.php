<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  public static function getWeeklySchedule()
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/schedule/now');
    $weeklyGames = json_decode($request->getBody()->getContents(), true);
    return $weeklyGames['gameWeek'];
  }

  public static function getLinescores()
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/score/now');
    $linescores = json_decode($request->getBody()->getContents(), true);
    return $linescores['games'];
  }

  public static function getBoxscores($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/boxscore');
    $boxscores = json_decode($request->getBody()->getContents(), true);
    return $boxscores;
  }
  // gets all teams and their stats
  public static function getAllTeams()
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/standings/now');
    $allTeams = json_decode($request->getBody()->getContents(), true);
    return $allTeams['standings'];
  }

  public static function getTeamSchedule($team)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/club-schedule-season/' . $team . '/now');
    $teamSchedule = json_decode($request->getBody()->getContents(), true);
    return $teamSchedule;
  }

  public static function getTeamRoster($team)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/club-stats/' . $team  . '/now');
    $teamStats = json_decode($request->getBody()->getContents(), true);
    return $teamStats;
  }
}
