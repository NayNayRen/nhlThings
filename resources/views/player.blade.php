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
          {{-- goalie regular season --}}
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              @include('includes._goalie_header')
              {{-- stats --}}
              @foreach ($regularSeason as $key => $stat)
                <li class="regular-season-row">
                  @include('includes._goalie_table')
                </li>
              @endforeach
            </ul>
          </div>
          {{-- goalie career regular season --}}
          <h2>Career Regular Season</h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
              @include('includes._goalie_header')
              {{-- stats --}}
              <li>
                <p title="Season">Career</p>
                <p>Regular Season</p>
                <p>{{ array_sum(array_column($regularSeason, 'gamesPlayed')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'gamesStarted')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'wins')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'losses')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'shutouts')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'shotsAgainst')) }}</p>
                <p>
                  {{ array_sum(array_column($regularSeason, 'shotsAgainst')) - array_sum(array_column($regularSeason, 'goalsAgainst')) }}
                </p>
                <p>
                  {{ round((float) ((array_sum(array_column($regularSeason, 'shotsAgainst')) - array_sum(array_column($regularSeason, 'goalsAgainst'))) / array_sum(array_column($regularSeason, 'shotsAgainst'))), 3) }}%
                </p>
                <p>{{ array_sum(array_column($regularSeason, 'goalsAgainst')) }}</p>
                <p>
                  {{ round((float) (array_sum(array_column($regularSeason, 'goalsAgainst')) / array_sum(array_column($regularSeason, 'gamesPlayed'))) * 1, 2) }}%
                </p>
                <p>{{ array_sum(array_column($regularSeason, 'timeOnIce')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'goals')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'assists')) }}</p>
                <p>{{ array_sum(array_column($regularSeason, 'pim')) }}</p>
              </li>
            </ul>
          </div>
          @if (count($playoffSeason) > 0)
            {{-- goalie playoffs --}}
            <h2>Playoffs</h2>
            <div class="horizontal-scrolling-container">
              <ul class="player-stats">
                @include('includes._goalie_header')
                {{-- stats --}}
                @foreach ($playoffSeason as $key => $stat)
                  <li class="playoff-season-row">
                    @include('includes._goalie_table')
                  </li>
                @endforeach
              </ul>
            </div>
            {{-- goalie career playoffs --}}
            <h2>Career Playoffs</h2>
            <div class="horizontal-scrolling-container">
              <ul class="player-stats">
                @include('includes._goalie_header')
                {{-- stats --}}
                <li>
                  <p title="Season">Career</p>
                  <p>Playoffs</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'gamesPlayed')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'gamesStarted')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'wins')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'losses')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'shutouts')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'shotsAgainst')) }}</p>
                  <p>
                    {{ array_sum(array_column($playoffSeason, 'shotsAgainst')) - array_sum(array_column($playoffSeason, 'goalsAgainst')) }}
                  </p>
                  <p>
                    {{ round((float) ((array_sum(array_column($playoffSeason, 'shotsAgainst')) - array_sum(array_column($playoffSeason, 'goalsAgainst'))) / array_sum(array_column($playoffSeason, 'shotsAgainst'))), 3) }}%
                  </p>
                  <p>{{ array_sum(array_column($playoffSeason, 'goalsAgainst')) }}</p>
                  <p>
                    {{ round((float) (array_sum(array_column($playoffSeason, 'goalsAgainst')) / array_sum(array_column($playoffSeason, 'gamesPlayed'))) * 1, 2) }}%
                  </p>
                  <p>{{ array_sum(array_column($playoffSeason, 'timeOnIce')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'goals')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'assists')) }}</p>
                  <p>{{ array_sum(array_column($playoffSeason, 'pim')) }}</p>
                </li>
              </ul>
            </div>
          @else
            <h2>No Playoffs Yet...</h2>
          @endif

          {{-- skater stuff --}}
        @else
          <h2>
            Regular Season
            <p>
              Made Playoffs :
              <span></span>
            </p>
          </h2>
          {{-- player regular season --}}
          <div class="horizontal-scrolling-container">
            <ul class="player-stats">
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
            {{-- player playoffs --}}
            <h2>Playoffs</h2>
            <div class="horizontal-scrolling-container">
              <ul class="player-stats">
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
