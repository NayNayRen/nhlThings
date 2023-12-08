@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-matchup-container">
      {{-- FINISHED GAME --}}
      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">FINAL</h3>
            <p class="game-matchup-heading-clock">00:00</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          {{-- three stars --}}
          <h3>Three Stars</h3>
          <div class="game-matchup-three-stars">
            <p>
              <span aria-label="Game First Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][0]['name'] }}
              </span>
            </p>
            <p>
              <span aria-label="Game Second Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][1]['name'] }}
              </span>
            </p>
            <p>
              <span aria-label="Game Third Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][2]['name'] }}
              </span>
            </p>
          </div>
        </div>
      @endif
      {{-- LIVE GAME --}}
      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <div class="game-matchup-periods">
              @foreach ($gameMatchup['summary']['linescore']['byPeriod'] as $period)
                @if ($period['period'] >= 5)
                  <h3 class="game-matchup-heading-live-period">SO</h3>
                @elseif ($period['period'] === 4)
                  <h3 class="game-matchup-heading-live-period">OT</h3>
                @elseif ($period['period'] === 3)
                  <h3 class="game-matchup-heading-live-period">3rd</h3>
                @elseif ($period['period'] === 2)
                  <h3 class="game-matchup-heading-live-period">2nd</h3>
                @elseif ($period['period'] === 1)
                  <h3 class="game-matchup-heading-live-period">1st</h3>
                @endif
              @endforeach
              <p class="game-matchup-heading-clock">{{ $gameMatchup['clock']['timeRemaining'] }}</p>
            </div>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Goals</h3>
          <ul class="game-matchup-goals">
            @foreach ($gameBoxscores['boxscore']['linescore']['byPeriod'] as $goals)
              <li>
                <p>{{ $goals['away'] }}</p>
                @if ($goals['period'] === 1)
                  <p>{{ $goals['period'] }}st</p>
                @endif
                @if ($goals['period'] === 2)
                  <p>{{ $goals['period'] }}nd</p>
                @endif
                @if ($goals['period'] === 3)
                  <p>{{ $goals['period'] }}rd</p>
                @endif
                @if ($goals['period'] === 4)
                  <p>OT</p>
                @endif
                @if ($goals['period'] >= 5)
                  <p>SO</p>
                @endif
                <p>{{ $goals['home'] }}</p>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      {{-- PREGAME HEAD TO HEAD --}}
      @if ($gameMatchup['gameState'] === 'PRE')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">{{ $formattedGameTime }} EST</h3>
            <p class="game-matchup-heading-clock">Stats Leaders</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Pregame Head to Head</h3>
        </div>
      @endif
      {{-- used to highlight game winner --}}
      <div class="game-state" hidden>{{ $gameMatchup['gameState'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/gameScript.js') }}"></script>
@include('includes._footer')
