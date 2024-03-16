{{-- finished games dropdown menu --}}
@if ($game['gameState'] === 'OFF' || $game['gameState'] === 'FINAL')
  <div class="game-dropdown-button">
    <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
  </div>
  <div class="game-dropdown-container">
    <ul class="game-dropdown-details">
      <li class='game-dropdown-header'>
        <div class='game-finished-date'>
          <p>{{ $formattedGameDate }}</p>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['awayTeam']['logo'] }} alt='{{ $game['awayTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
        <div>
          <h3>FINAL</h3>
          @if ($game['gameOutcome']['lastPeriodType'] === 'SO')
            <span>SO</span>
          @elseif ($game['gameOutcome']['lastPeriodType'] === 'OT')
            <span>OT</span>
          @elseif ($game['gameOutcome']['lastPeriodType'] === 'REG')
            <span>REG</span>
          @endif
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $game['awayTeam']['score'] }}</p>
          <h3>Goals</h3>
          <p>{{ $game['homeTeam']['score'] }}</p>
        </div>
      </li>
      <li class="game-winning-player">
        <h3>Winning Goalie</h3>
        @if (array_key_exists('winningGoalie', $game))
          <p>{{ $game['winningGoalie']['firstInitial']['default'] }}
            {{ $game['winningGoalie']['lastName']['default'] }}
          </p>
        @else
          <p>No Data</p>
        @endif
      </li>
      <li class="game-winning-player">
        <h3>Winning Goal Scorer</h3>
        @if (array_key_exists('winningGoalScorer', $game))
          <p>{{ $game['winningGoalScorer']['firstInitial']['default'] }}
            {{ $game['winningGoalScorer']['lastName']['default'] }}
          </p>
        @else
          <p>No Data</p>
        @endif
      </li>
      <a href="{{ route('games.game', $game['id']) }}" class="game-stats-button" target="_blank">
        Final Stats <i class='fa fa-arrow-right' aria-hidden='true'></i>
      </a>
    </ul>
  </div>
@endif
{{-- critical and live time games dropdown menu --}}
@if ($game['gameState'] === 'CRIT' || $game['gameState'] === 'LIVE')
  @php
    $gameClock = App\Http\Controllers\ApiController::getBoxscores($game['id']);
    $gameData = App\Http\Controllers\ApiController::getGameMatchup($game['id']);
  @endphp
  <div class="game-dropdown-button">
    <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
  </div>
  <div class="game-dropdown-container">
    <ul class="game-dropdown-details">
      <li class='game-dropdown-header'>
        <div class='game-finished-date'>
          <p>{{ $formattedGameDate }}</p>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['awayTeam']['logo'] }} alt='{{ $game['awayTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
        <div class="game-periods">
          @if ($gameClock['clock']['inIntermission'] === true)
            <h3 class="game-period">INT</h3>
            <span>{{ $gameClock['clock']['timeRemaining'] }}</span>
          @else
            @foreach ($gameData['summary']['linescore']['byPeriod'] as $period)
              @if ($periodDescriptor['number'] >= 5)
                <h3 class="game-period">SO</h3>
              @elseif ($periodDescriptor['number'] === 4)
                <h3 class="game-period">OT</h3>
              @elseif ($periodDescriptor['number'] === 3)
                <h3 class="game-period">3rd</h3>
              @elseif ($periodDescriptor['number'] === 2)
                <h3 class="game-period">2nd</h3>
              @elseif ($periodDescriptor['number'] === 1)
                <h3 class="game-period">1st</h3>
              @endif
            @endforeach
            <span>{{ $gameClock['clock']['timeRemaining'] }}</span>
          @endif
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $game['awayTeam']['score'] }}</p>
          <h3>Goals</h3>
          <p>{{ $game['homeTeam']['score'] }}</p>
        </div>
        @foreach ($gameData['summary']['linescore']['byPeriod'] as $goals)
          <div>
            <p>{{ $goals['away'] }}</p>
            @if ($periodDescriptor['number'] === 1)
              <span>1st</span>
            @endif
            @if ($periodDescriptor['number'] === 2)
              <span>2nd</span>
            @endif
            @if ($periodDescriptor['number'] === 3)
              <span>3rd</span>
            @endif
            @if ($periodDescriptor['number'] === 4)
              <span>OT</span>
            @endif
            @if ($periodDescriptor['number'] >= 5)
              <span>SO</span>
            @endif
            <p>{{ $goals['home'] }}</p>
          </div>
        @endforeach
      </li>
      <li class='game-dropdown-shots'>
        <div>
          <p>{{ $gameData['awayTeam']['sog'] }}</p>
          <h3>Shots</h3>
          <p>{{ $gameData['homeTeam']['sog'] }}</p>
        </div>
        @foreach ($gameData['summary']['shotsByPeriod'] as $shots)
          <div>
            @if ($periodDescriptor['number'] === 1)
              <p>{{ $shots['away'] }}</p>
              <span>1st</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($periodDescriptor['number'] === 2)
              <p>{{ $shots['away'] }}</p>
              <span>2nd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($periodDescriptor['number'] === 3)
              <p>{{ $shots['away'] }}</p>
              <span>3rd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($periodDescriptor['number'] === 4)
              <p>{{ $shots['away'] }}</p>
              <span>OT</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($periodDescriptor['number'] >= 5)
              <p></p>
            @endif
          </div>
        @endforeach
      </li>
      <a href="{{ route('games.game', $game['id']) }}" class="game-stats-button" target="_blank">
        Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
      </a>
    </ul>
  </div>
@endif
{{-- pregame dropdown menu --}}
@if ($game['gameState'] === 'PRE')
  @php
    $gameData = App\Http\Controllers\ApiController::getGameMatchup($game['id']);
  @endphp
  <div class="game-dropdown-button">
    <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
  </div>
  <div class="game-dropdown-container">
    <ul class="game-dropdown-details">
      <li class='game-dropdown-header'>
        <div class='game-finished-date'>
          <p>{{ $formattedGameDate }}</p>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['awayTeam']['logo'] }} alt='{{ $game['awayTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
        <div>
          <h3>{{ $formattedGameTime }} EST</h3>
          <span>Stats Leaders</span>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][0]['awayLeader']['value'] }}</p>
          <h3>Points</h3>
          <p>{{ $gameData['matchup']['teamLeadersL5'][0]['homeLeader']['value'] }}</p>
        </div>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][0]['awayLeader']['name']['default'] }}</p>
          <span></span>
          <p>{{ $gameData['matchup']['teamLeadersL5'][0]['homeLeader']['name']['default'] }}</p>
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][1]['awayLeader']['value'] }}</p>
          <h3>Goals</h3>
          <p>{{ $gameData['matchup']['teamLeadersL5'][1]['homeLeader']['value'] }}</p>
        </div>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][1]['awayLeader']['name']['default'] }}</p>
          <span></span>
          <p>{{ $gameData['matchup']['teamLeadersL5'][1]['homeLeader']['name']['default'] }}</p>
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][2]['awayLeader']['value'] }}</p>
          <h3>Assists</h3>
          <p>{{ $gameData['matchup']['teamLeadersL5'][2]['homeLeader']['value'] }}</p>
        </div>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][2]['awayLeader']['name']['default'] }}</p>
          <span></span>
          <p>{{ $gameData['matchup']['teamLeadersL5'][2]['homeLeader']['name']['default'] }}</p>
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][3]['awayLeader']['value'] }}</p>
          <h3>+ / -</h3>
          <p>{{ $gameData['matchup']['teamLeadersL5'][3]['homeLeader']['value'] }}</p>
        </div>
        <div>
          <p>{{ $gameData['matchup']['teamLeadersL5'][3]['awayLeader']['name']['default'] }}</p>
          <span></span>
          <p>{{ $gameData['matchup']['teamLeadersL5'][3]['homeLeader']['name']['default'] }}</p>
        </div>
      </li>
      @if (array_key_exists('goalieComparison', $gameData['matchup']))
        <li class='game-dropdown-goals'>
          <div>
            <p>{{ $gameData['matchup']['goalieComparison']['awayTeam'][0]['record'] }}</p>
            <h3>Goalies</h3>
            <p>{{ $gameData['matchup']['goalieComparison']['homeTeam'][0]['record'] }}</p>
          </div>
          <div>
            <p>{{ $gameData['matchup']['goalieComparison']['awayTeam'][0]['name']['default'] }}</p>
            <span></span>
            <p>{{ $gameData['matchup']['goalieComparison']['homeTeam'][0]['name']['default'] }}</p>
          </div>
        </li>
      @else
        <li class='game-dropdown-goals'>
          <div>
            <p>No Data</p>
            <h3>Goalies</h3>
            <p>No Data</p>
          </div>
          <div>
            <p>No Data</p>
            <span></span>
            <p>No Data</p>
          </div>
        </li>
      @endif

      <a href="{{ route('games.game', $game['id']) }}" class="game-stats-button" target="_blank">
        Match Up <i class='fa fa-arrow-right' aria-hidden='true'></i>
      </a>
    </ul>
  </div>
@endif
