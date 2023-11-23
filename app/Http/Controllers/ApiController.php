<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
  public static function getWeeklyGames()
  {
    // $weeklyGames = Http::get('https://api-web.nhle.com/v1/schedule/now')['gameWeek'];
    // return $weeklyGames;
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/schedule/now');
    $weeklyGames = json_decode($request->getBody()->getContents(), true);
    return $weeklyGames['gameWeek'];
  }

  public static function getLinescores()
  {
    // $linescores = Http::get('https://api-web.nhle.com/v1/score/now')['games'];
    // return $linescores;
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/score/now');
    $linescores = json_decode($request->getBody()->getContents(), true);
    return $linescores['games'];
  }

  public static function getBoxscores($id)
  {
    // $boxscores = Http::get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/boxscore')->json();
    // return $boxscores;
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/gamecenter/' . $id . '/boxscore');
    $boxscores = json_decode($request->getBody()->getContents(), true);
    return $boxscores;
  }

  public static function getAllTeams()
  {
    // $currentStandings = Http::get('https://api-web.nhle.com/v1/standings/now')['standings'];
    // return $currentStandings;
    $client = new \GuzzleHttp\Client();
    $request = $client->get('https://api-web.nhle.com/v1/standings/now');
    $allTeams = json_decode($request->getBody()->getContents(), true);
    return $allTeams['standings'];
  }
}
