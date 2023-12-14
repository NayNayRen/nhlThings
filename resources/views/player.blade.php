@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="player-container">
      <div class="player-heading-container">
        <div class="player-heading-left">
          <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
          <p class="player-team">{{ $player['fullTeamName']['default'] }}</p>
          @if (array_key_exists('draftDetails', $player))
            <ul class="player-draft-container">
              <li>Draft</li>
              <li>Year : {{ $player['draftDetails']['year'] }}</li>
              <li>By : {{ $player['draftDetails']['teamAbbrev'] }}</li>
              <li>Round : {{ $player['draftDetails']['round'] }}</li>
              <li>Picked : {{ $player['draftDetails']['pickInRound'] }}</li>
              <li>Overall : {{ $player['draftDetails']['overallPick'] }}</li>
            </ul>
          @else
            <ul class="player-draft-container">
              <li>Undrafted</li>
            </ul>
          @endif
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
          <div class="horizontal-scrolling-container">
            <ul class="player-summary">
              <li>
                <h3>Height</h3>
                <p>{{ $player['heightInInches'] }}"</p>
              </li>
              <li>
                <h3>Weight</h3>
                <p>{{ $player['weightInPounds'] }}lbs.</p>
              </li>
              <li>
                <h3>Number</h3>
                <p>{{ $player['sweaterNumber'] }}</p>
              </li>
              <li>
                <h3>Position</h3>
                <p>{{ $player['position'] }}</p>
              </li>
              <li>
                <h3>Shoots</h3>
                <p>{{ $player['shootsCatches'] }}</p>
              </li>
              <li>
                <h3>DOB</h3>
                <p>{{ $player['birthDate'] }}</p>
              </li>
              <li>
                <h3>Birthplace</h3>
                <p>{{ $player['birthCity']['default'] }}, {{ $player['birthCountry'] }}</p>
              </li>
            </ul>
          </div>
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
              {{-- goalie career regular season --}}
              @include('includes._goalie_header')
              <li>
                <p title="Season">Career</p>
                <p>Regular Season</p>
                <p>{{ $player['careerTotals']['regularSeason']['gamesPlayed'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['gamesStarted'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['wins'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['losses'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['shutouts'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['shotsAgainst'] }}</p>
                <p>
                  {{ $player['careerTotals']['regularSeason']['shotsAgainst'] - $player['careerTotals']['regularSeason']['goalsAgainst'] }}
                </p>
                <p>
                  {{ round((float) (($player['careerTotals']['regularSeason']['shotsAgainst'] - $player['careerTotals']['regularSeason']['goalsAgainst']) / $player['careerTotals']['regularSeason']['shotsAgainst']), 3) }}%
                </p>
                <p>{{ $player['careerTotals']['regularSeason']['goalsAgainst'] }}</p>
                <p>
                  {{ round((float) ($player['careerTotals']['regularSeason']['goalsAgainst'] / $player['careerTotals']['regularSeason']['gamesPlayed']) * 1, 2) }}%
                </p>
                <p>{{ $player['careerTotals']['regularSeason']['timeOnIce'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['goals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['assists'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['pim'] }}</p>
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
                {{-- goalie career playoffs --}}
                @include('includes._goalie_header')
                <li>
                  <p title="Season">Career</p>
                  <p>Playoffs</p>
                  <p>{{ $player['careerTotals']['playoffs']['gamesPlayed'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['gamesStarted'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['wins'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['losses'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['shutouts'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['shotsAgainst'] }}</p>
                  <p>
                    {{ $player['careerTotals']['playoffs']['shotsAgainst'] - $player['careerTotals']['playoffs']['goalsAgainst'] }}
                  </p>
                  <p>
                    {{ round((float) (($player['careerTotals']['playoffs']['shotsAgainst'] - $player['careerTotals']['playoffs']['goalsAgainst']) / $player['careerTotals']['playoffs']['shotsAgainst']), 3) }}%
                  </p>
                  <p>{{ $player['careerTotals']['playoffs']['goalsAgainst'] }}</p>
                  <p>
                    {{ round((float) ($player['careerTotals']['playoffs']['goalsAgainst'] / $player['careerTotals']['playoffs']['gamesPlayed']) * 1, 2) }}%
                  </p>
                  <p>{{ $player['careerTotals']['playoffs']['timeOnIce'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['goals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['assists'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['pim'] }}</p>
                </li>
              </ul>
            </div>
          @else
            <h2>No Playoffs Yet...</h2>
          @endif
        @else
          {{-- skater stuff --}}
          <div class="horizontal-scrolling-container">
            <ul class="player-summary">
              <li>
                <h3>Height</h3>
                <p>{{ $player['heightInInches'] }}"</p>
              </li>
              <li>
                <h3>Weight</h3>
                <p>{{ $player['weightInPounds'] }}lbs.</p>
              </li>
              <li>
                <h3>Number</h3>
                <p>{{ $player['sweaterNumber'] }}</p>
              </li>
              <li>
                <h3>Position</h3>
                <p>{{ $player['position'] }}</p>
              </li>
              <li>
                <h3>Shoots</h3>
                <p>{{ $player['shootsCatches'] }}</p>
              </li>
              <li>
                <h3>DOB</h3>
                <p>{{ $player['birthDate'] }}</p>
              </li>
              <li>
                <h3>Birthplace</h3>
                <p>{{ $player['birthCity']['default'] }}, {{ $player['birthCountry'] }}</p>
              </li>
            </ul>
          </div>
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
              @include('includes._player_header')
              <li>
                <p title="Season">Career</p>
                <p>Regular Season</p>
                <p>{{ $player['careerTotals']['regularSeason']['gamesPlayed'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['goals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['assists'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['points'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['plusMinus'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['pim'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['powerPlayGoals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['powerPlayPoints'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['shorthandedGoals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['gameWinningGoals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['otGoals'] }}</p>
                <p>{{ $player['careerTotals']['regularSeason']['shots'] }}</p>
                <p>
                  {{ round((float) $player['careerTotals']['regularSeason']['shootingPctg'] * 100, 2) }}%
                </p>
                <p>{{ $player['careerTotals']['regularSeason']['avgToi'] }}</p>
                <p>
                  {{ round((float) $player['careerTotals']['regularSeason']['faceoffWinningPctg'] * 100, 2) }}%
                </p>
              </li>
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
                @include('includes._player_header')
                <li>
                  <p title="Season">Career</p>
                  <p>Playoffs</p>
                  <p>{{ $player['careerTotals']['playoffs']['gamesPlayed'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['goals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['assists'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['points'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['plusMinus'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['pim'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['powerPlayGoals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['powerPlayPoints'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['shorthandedGoals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['gameWinningGoals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['otGoals'] }}</p>
                  <p>{{ $player['careerTotals']['playoffs']['shots'] }}</p>
                  <p>
                    {{ round((float) $player['careerTotals']['playoffs']['shootingPctg'] * 100, 2) }}%
                  </p>
                  <p>{{ $player['careerTotals']['playoffs']['avgToi'] }}</p>
                  <p>
                    {{ round((float) $player['careerTotals']['playoffs']['faceoffWinningPctg'] * 100, 2) }}%
                  </p>
                </li>
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
