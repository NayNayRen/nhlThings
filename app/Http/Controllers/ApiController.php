<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  // 2023020327
  // 2023-11-26
  public static function getGamesByDate($date)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/score/' . $date);
    $gamesByDate = json_decode($request->getBody()->getContents(), true);
    return $gamesByDate;
  }

  public static function getWeeklyGames($date)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/schedule/' . $date);
    $weeklyGames = json_decode($request->getBody()->getContents(), true);
    return $weeklyGames['gameWeek'];
  }

  // good for finished game
  // finished games have player game stats
  // if upcoming game, there is no boxscore object with data
  public static function getBoxscores($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/boxscore');
    $boxscores = json_decode($request->getBody()->getContents(), true);
    return $boxscores;
  }

  // good for all games
  // gameday head to head stats, each teams category leaders
  public static function getGameMatchup($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/landing');
    $matchup = json_decode($request->getBody()->getContents(), true);
    return $matchup;
  }

  // everything from shot time and coordinates to hit time and coordinates
  public static function getPlayByPlay($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/play-by-play');
    $playByPlay = json_decode($request->getBody()->getContents(), true);
    return $playByPlay;
  }

  // gets all teams and their stats, current standings, goals, wins, losses etc.
  public static function getAllTeams()
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/standings/now');
    $allTeams = json_decode($request->getBody()->getContents(), true);
    return $allTeams['standings'];
  }

  public static function getTeamRoster($team)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/roster/' . $team  . '/current');
    $teamStats = json_decode($request->getBody()->getContents(), true);
    return $teamStats;
  }

  public static function getTeamSchedule($team)
  {
    $upcoming = [];
    $finished = [];
    $preseason = [];
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/club-schedule-season/' . $team . '/now');
    $response = json_decode($request->getBody()->getContents(), true);
    for ($i = 0; $i < count($response['games']); $i++) {
      if ($response['games'][$i]['gameType'] === 2) {
        if ($response['games'][$i]['gameState'] === 'OFF') {
          $finished[] = $response['games'][$i];
        }
        if ($response['games'][$i]['gameState'] === 'FUT' || $response['games'][$i]['gameState'] === 'PRE' || $response['games'][$i]['gameState'] === 'LIVE' || $response['games'][$i]['gameState'] === 'CRIT' || $response['games'][$i]['gameState'] === 'FINAL') {
          $upcoming[] = $response['games'][$i];
        }
      } else if ($response['games'][$i]['gameType'] === 1) {
        $preseason[] = $response['games'][$i];
      }
    }
    return array($upcoming, $finished, $preseason);
  }

  public static function getPlayer($id)
  {
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/player/' . $id . '/landing');
    $player = json_decode($request->getBody()->getContents(), true);
    return $player;
  }
}
