@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="player-container">
      <div class="player-heading-container">
        <div class="player-heading-left">
          <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
          <div class="player-number-position-container">
            <p class="player-number">{{ $player['sweaterNumber'] }}</p>
            <p class="player-position">{{ $player['position'] }}</p>
          </div>
        </div>
        <div class="player-heading-logo">
          <img src={{ $player['headshot'] }}
            alt="{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}" width="100"
            height="100">
        </div>
      </div>
      {{-- player data --}}
      <div class="horizontal-scrolling-container">
        <ul class="player-stats">
          <li>
            <h3 title="Season">Season</h3>
            <h3 title="Games Played">GP</h3>
            <h3 title="Goals">G</h3>
            <h3 title="Assists">A</h3>
            <h3 title="Points">P</h3>
            <h3 title="Plus Minus">+/-</h3>
            <h3 title="Penalty Minutes">PIM</h3>
            <h3 title="Power Play Goals">PPG</h3>
            <h3 title="Power Play Points">PPP</h3>
            <h3 title="Short Handed Goals">SHG</h3>
            <h3 title="Game Winning Goals">GWG</h3>
            <h3 title="Over Time Goals">OTG</h3>
            <h3 title="Shots">S</h3>
            <h3 title="Shot %">S%</h3>
            <h3 title="Time on Ice">TOI</h3>
            <h3 title="Total TOI">TTOI</h3>
          </li>

          <li>
            <p title="Regular Season">{{ $formattedSeason }}</p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
            <p></p>
          </li>
        </ul>
      </div>
    </div>
  </div>
</main>
@include('includes._footer')
