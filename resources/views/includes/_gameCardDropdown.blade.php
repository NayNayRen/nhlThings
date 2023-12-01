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
          <span>{{ $gameData['clock']['timeRemaining'] }}</span>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['awayTeam']['score'] }}</p>
          <h3>Goals</h3>
          <p>{{ $gameData['homeTeam']['score'] }}</p>
        </div>
        @foreach ($gameData['summary']['linescore']['byPeriod'] as $goals)
          <div>
            <p>{{ $goals['away'] }}</p>
            @if ($goals['period'] === 1)
              <span>{{ $goals['period'] }}st</span>
            @endif
            @if ($goals['period'] === 2)
              <span>{{ $goals['period'] }}nd</span>
            @endif
            @if ($goals['period'] === 3)
              <span>{{ $goals['period'] }}rd</span>
            @endif
            @if ($goals['period'] === 4)
              <p>OT</p>
            @endif
            @if ($goals['period'] >= 5)
              <p>SO</p>
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
            @if ($shots['period'] === 1)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}st</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 2)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}nd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 3)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}rd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 4)
              <p>{{ $shots['away'] }}</p>
              <p>OT</p>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] >= 5)
              <p></p>
            @endif
          </div>
        @endforeach
      </li>
      <button type='button' class='game-slideout-show-button'>
        Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
      </button>
    </ul>
  </div>
@endif
{{-- critical time games dropdown menu --}}
@if ($game['gameState'] === 'CRIT' || $game['gameState'] === 'LIVE')
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
          @if ($game['periodDescriptor']['number'] === 1)
            <h3>{{ $game['periodDescriptor']['number'] }}st</h3>
          @endif
          @if ($game['periodDescriptor']['number'] === 2)
            <h3>{{ $game['periodDescriptor']['number'] }}nd</h3>
          @endif
          @if ($game['periodDescriptor']['number'] === 3)
            <h3>{{ $game['periodDescriptor']['number'] }}rd</h3>
          @endif
          @if ($game['periodDescriptor']['number'] === 4)
            <h3>OT</h3>
          @endif
          @if ($game['periodDescriptor']['number'] >= 5)
            <h3>SO</h3>
          @endif
          <span>{{ $gameData['clock']['timeRemaining'] }}</span>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>{{ $gameData['awayTeam']['score'] }}</p>
          <h3>Goals</h3>
          <p>{{ $gameData['homeTeam']['score'] }}</p>
        </div>
        @foreach ($gameData['summary']['linescore']['byPeriod'] as $goals)
          <div>
            <p>{{ $goals['away'] }}</p>
            @if ($goals['period'] === 1)
              <span>{{ $goals['period'] }}st</span>
            @endif
            @if ($goals['period'] === 2)
              <span>{{ $goals['period'] }}nd</span>
            @endif
            @if ($goals['period'] === 3)
              <span>{{ $goals['period'] }}rd</span>
            @endif
            @if ($goals['period'] === 4)
              <p>OT</p>
            @endif
            @if ($goals['period'] >= 5)
              <p>SO</p>
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
            @if ($shots['period'] === 1)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}st</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 2)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}nd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 3)
              <p>{{ $shots['away'] }}</p>
              <span>{{ $shots['period'] }}rd</span>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] === 4)
              <p>{{ $shots['away'] }}</p>
              <p>OT</p>
              <p>{{ $shots['home'] }}</p>
            @endif
            @if ($shots['period'] >= 5)
              <p></p>
            @endif
          </div>
        @endforeach
      </li>
      <button type='button' class='game-slideout-show-button'>
        Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
      </button>
    </ul>
  </div>
@endif
{{-- pregame dropdown menu --}}
@if ($game['gameState'] === 'PRE')
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
          <h3>PREGAME</h3>
          <span>00:00</span>
        </div>
        <div class="game-dropdown-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $game['homeTeam']['placeName']['default'] }} Logo'
            width="75" height="75">
        </div>
      </li>
      <li class='game-dropdown-goals'>
        <div>
          <p>Coming...</p>
          {{-- <p>{{ $game['awayTeam']['score'] }}</p> --}}
          <h3>Goals</h3>
          <p>Coming...</p>
          {{-- <p>{{ $game['homeTeam']['score'] }}</p> --}}
        </div>
      </li>
    </ul>
  </div>
@endif
