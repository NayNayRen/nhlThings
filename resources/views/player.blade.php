@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="player-container">
      <div class="player-heading-container">
        <div class="player-heading-left">
          <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
          <p class="player-team">{{ $player['fullTeamName']['default'] }}</p>
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
      <div class="player-data-container">
        @if ($player['position'] === 'G')
          {{-- goalie stuff --}}
          <h2>Regular Season</h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- goalie stuff regular season --}}
              @include('includes._goalie_header')
              {{-- stats --}}
              @foreach ($nhlRegularCareer as $key => $stat)
                @include('includes._goalie_table')
              @endforeach
            </ul>
          </div>

          <h2>Playoffs</h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- goalie stuff playoffs --}}
              @include('includes._goalie_header')
              {{-- stats --}}
              @foreach ($nhlPlayoffCareer as $key => $stat)
                @include('includes._goalie_table')
              @endforeach
            </ul>
          </div>
        @else
          {{-- skater stuff --}}
          <h2>Regular Season</h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- player stuff regular season --}}
              @include('includes._player_header')
              {{-- stats --}}
              @foreach ($nhlRegularCareer as $key => $stat)
                @include('includes._player_table')
              @endforeach
            </ul>
          </div>

          <h2>Playoffs</h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- player stuff playoffs --}}
              @include('includes._player_header')
              {{-- stats --}}
              @foreach ($nhlPlayoffCareer as $key => $stat)
                @include('includes._player_table')
              @endforeach
            </ul>
          </div>
        @endif
      </div>
    </div>
  </div>
</main>
@include('includes._footer')
