@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-matchup-container">

      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <div class="game-matchup-heading-container">
          <div class="game-matchup-heading-left">
            <h2>{{ $gameMatchup['awayTeam']['abbrev'] }}</h2>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="game-matchup-heading-center">
            <span>FINAL</span>
            <span>00:00</span>
          </div>
          <div class="game-matchup-heading-right">
            <h2>{{ $gameMatchup['homeTeam']['abbrev'] }}</h2>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
        </div>
      @endif

      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <div class="game-matchup-heading-container">
          <div class="game-matchup-heading-left">
            <h2>{{ $gameMatchup['awayTeam']['abbrev'] }}</h2>
          </div>
          <div class="game-matchup-heading-center">
            <div class="game-periods">
              @foreach ($gameMatchup['summary']['linescore']['byPeriod'] as $period)
                @if ($period['period'] >= 5)
                  <h3 class="game-period">SO</h3>
                @elseif ($period['period'] === 4)
                  <h3 class="game-period">OT</h3>
                @elseif ($period['period'] === 3)
                  <h3 class="game-period">3rd</h3>
                @elseif ($period['period'] === 2)
                  <h3 class="game-period">2nd</h3>
                @elseif ($period['period'] === 1)
                  <h3 class="game-period">1st</h3>
                @endif
              @endforeach
              <span>{{ $gameMatchup['clock']['timeRemaining'] }}</span>
            </div>
          </div>
          <div class="game-matchup-heading-right">
            <h2>{{ $gameMatchup['homeTeam']['abbrev'] }}</h2>
          </div>
        </div>
      @endif

      @if ($gameMatchup['gameState'] === 'PRE')
        <div class="game-matchup-heading-container">
          <div class="game-matchup-heading-left">
            <h2>{{ $gameMatchup['awayTeam']['abbrev'] }}</h2>
          </div>
          <div class="game-matchup-heading-center">
            <span>PREGAME</span>
          </div>
          <div class="game-matchup-heading-right">
            <h2>{{ $gameMatchup['homeTeam']['abbrev'] }}</h2>
          </div>
        </div>
      @endif
    </div>
  </div>
</main>
@include('includes._footer')
