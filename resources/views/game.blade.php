@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-matchup-container game-matchup-scroll-point">
      {{-- FINISHED GAME --}}
      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
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
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>

        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          {{-- three stars --}}
          <h3>Three Stars</h3>
          <div class="game-matchup-main-container-three-stars">
            <p>
              <span aria-label="Game First Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][0]['name'] }}
                {{ '(' . $gameMatchup['summary']['threeStars'][0]['teamAbbrev'] . ')' }}
              </span>
            </p>
            <p>
              <span aria-label="Game Second Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][1]['name'] }}
                {{ '(' . $gameMatchup['summary']['threeStars'][1]['teamAbbrev'] . ')' }}
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
                {{ '(' . $gameMatchup['summary']['threeStars'][2]['teamAbbrev'] . ')' }}
              </span>
            </p>
          </div>
          <h3>Final Numbers</h3>

          {{-- scoring summary --}}
          @include('includes._matchup_game_scoring')

          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              <li>
                @if ($shots['period'] === 1)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}st Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 2)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}nd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 3)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}rd Period</p>
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
              </li>
            @endforeach
          </ul>

          {{-- matchup stats --}}
          @include('includes._matchup_game_stats')

          {{-- penalties --}}
          @include('includes._matchup_game_penalties')

        </div>
      @endif
      {{-- LIVE GAME --}}
      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
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
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Live Stats</h3>

          {{-- scoring Summary --}}
          @include('includes._matchup_game_scoring')

          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              <li>
                @if ($shots['period'] === 1)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}st Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 2)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}nd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 3)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}rd Period</p>
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
              </li>
            @endforeach
          </ul>

          {{-- matchup stats --}}
          @include('includes._matchup_game_stats')

          {{-- penalties --}}
          @include('includes._matchup_game_penalties')

        </div>
      @endif
      {{-- PREGAME HEAD TO HEAD --}}
      @if ($gameMatchup['gameState'] === 'PRE')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">{{ $formattedGameTime }} EST</h3>
            <p class="game-matchup-heading-clock">Stats Leaders</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-right">
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Head to Head</h3>
        </div>
      @endif
      {{-- used to highlight game winner --}}
      <div class="game-state" hidden>{{ $gameMatchup['gameState'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/gameScript.js') }}"></script>
@include('includes._footer')
