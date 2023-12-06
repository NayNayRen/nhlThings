@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-container">
      <div class="game-heading-container">
        <h2>{{ $gameMatchup['awayTeam']['abbrev'] }} vs {{ $gameMatchup['homeTeam']['abbrev'] }}</h2>
      </div>
    </div>
  </div>
</main>
@include('includes._footer')
