@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="player-container">
      <div class="player-heading-container">
        <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
        <div class="player-heading-logo">
          <img src={{ $player['headshot'] }}
            alt="{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}" width="100" height="100">
        </div>
        <div class="player-number-position-container">
          <p class="player-number">{{ $player['sweaterNumber'] }}</p>
          <p class="player-position">{{ $player['position'] }}</p>
        </div>
      </div>
    </div>
  </div>
</main>
@include('includes._footer')
