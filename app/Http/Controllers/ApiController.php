<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  public static function getWeeklySchedule($date)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/schedule/' . $date);
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
    $regularSeason = [];
    $preseason = [];
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/club-schedule-season/' . $team . '/now');
    $response = json_decode($request->getBody()->getContents(), true);
    for ($i = 0; $i < count($response['games']); $i++) {
      if ($response['games'][$i]['gameType'] != 1) {
        $regularSeason[] = $response['games'][$i];
      } else if ($response['games'][$i]['gameType'] === 1) {
        $preseason[] = $response['games'][$i];
      }
    }
    // dd($preseason);
    return array($regularSeason, $preseason);
  }

  public static function getTeamRoster($team)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/club-stats/' . $team  . '/now');
    $teamStats = json_decode($request->getBody()->getContents(), true);
    return $teamStats;
  }

  public static function getPlayer($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/player/' . $id . '/landing');
    $player = json_decode($request->getBody()->getContents(), true);
    return $player;
  }
}
