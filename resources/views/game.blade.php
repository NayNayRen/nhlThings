@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-container">
      <div class="game-heading-container">
        <h2>{{ $gameMatchup['awayTeam']['abbrev'] }} vs {{ $gameMatchup['homeTeam']['abbrev'] }}</h2>
      </div>
      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <p>FINAL</p>
        <span>{{ $gameMatchup['clock']['timeRemaining'] }}</span>
      @endif

      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <p>LIVE</p>
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
      @endif

      @if ($gameMatchup['gameState'] === 'PRE')
        <p>PREGAME</p>
      @endif

      <div class="game-state">{{ $gameMatchup['gameState'] }}</div>
    </div>
  </div>
</main>
<script src={{ asset('js/gameScript.js') }}></script>
@include('includes._footer')
