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
          <h2>
            Regular Season
            <p>
              Made Playoffs :
              <span></span>
            </p>
          </h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- goalie regular season --}}
              @include('includes._goalie_header')
              {{-- stats --}}
              @foreach ($regularSeason as $key => $stat)
                <li class="regular-season-row">
                  @include('includes._goalie_table')
                </li>
              @endforeach
            </ul>
          </div>
          @if (count($playoffSeason) > 0)
            <h2>Playoffs</h2>
            <div class="horizontal-scrolling-container">
              <ul class="player-stats">
                {{-- goalie playoffs --}}
                @include('includes._goalie_header')
                {{-- stats --}}
                @foreach ($playoffSeason as $key => $stat)
                  <li class="playoff-season-row">
                    @include('includes._goalie_table')
                  </li>
                @endforeach
              </ul>
            </div>
          @else
            <h2>No Playoffs Yet...</h2>
          @endif
        @else
          {{-- skater stuff --}}
          <h2>
            Regular Season
            <p>
              Made Playoffs :
              <span></span>
            </p>
          </h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              {{-- player regular season --}}
              @include('includes._player_header')
              {{-- stats --}}
              @foreach ($regularSeason as $key => $stat)
                <li class="regular-season-row">
                  @include('includes._player_table')
                </li>
              @endforeach
            </ul>
          </div>
          @if (count($playoffSeason) > 0)
            <h2>Playoffs</h2>
            <div class="horizontal-scrolling-container">
              <ul class="player-stats">
                {{-- player playoffs --}}
                @include('includes._player_header')
                {{-- stats --}}
                @foreach ($playoffSeason as $key => $stat)
                  <li class="playoff-season-row">
                    @include('includes._player_table')
                  </li>
                @endforeach
              </ul>
            </div>
          @else
            <h2>No Playoffs Yet...</h2>
          @endif

        @endif
      </div>
    </div>
  </div>
</main>
<script src="{{ asset('js/playerScript.js') }}"></script>
@include('includes._footer')
