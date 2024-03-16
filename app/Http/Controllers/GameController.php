<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GameController extends Controller
{
  public function game($id)
  {
    try {
      $teamRoster = [];
      $firstHalfSeason = [];
      $secondHalfSeason = [];
      $today = Carbon::today();
      $currentDate = Carbon::create($today)->toFormattedDateString();
      $allTeams = ApiController::getAllTeams();
      $sortedTeamsByName = collect($allTeams)->sortBy('teamName');
      $season = (string)$allTeams[0]['seasonId'];
      $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
      $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
      $gameBoxscores = ApiController::getBoxscores($id);
      $gameMatchup = ApiController::getGameMatchup($id);
      $formattedGameTime = Carbon::create($gameMatchup['startTimeUTC'])->tz('America/New_York');
      // dd($gameMatchup);
      return view('game', [
        'favIcon' => '../img/nhl-shield.png',
        'title' => $gameMatchup['awayTeam']['abbrev'] . ' vs ' . $gameMatchup['homeTeam']['abbrev'],
        'formattedSeason' => $firstHalfSeason[0] . '/' . $secondHalfSeason[0],
        'formattedGameDate' => $formattedGameTime->format('D M j, Y'),
        'formattedGameTime' => $formattedGameTime->format('h:i A'),
        'gameBoxscores' => $gameBoxscores,
        'allTeams' => $allTeams,
        'gameMatchup' => $gameMatchup,
        'currentDate' => $currentDate,
        'teamRoster' => $teamRoster,
        'sortedTeamsByName' => $sortedTeamsByName
      ]);
    } catch (Exception $error) {
      $message = $error->getMessage();
      $code = $error->getCode();
      if ($code === 404) {
        return view('errors/404', [
          'favIcon' => '../img/nhl-shield.png',
          'title' => 'Resource Not Found',
          'message' => 'Code ' . $code . " : We can't seem to find that resource..."
        ]);
      } elseif ($code != 404) {
        return view('errors/404', [
          'favIcon' => '../img/nhl-shield.png',
          'title' => 'Internal Server Error',
          'message' => 'Code ' . $code . ' : ' . $message
        ]);
      }
    }
  }
}
