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
              <li>
                <span>Year : {{ $player['draftDetails']['year'] }}</span>
                <span>By : {{ $player['draftDetails']['teamAbbrev'] }}</span>
              </li>
              <li>
                <span>Round : {{ $player['draftDetails']['round'] }}</span>
                <span>Picked : {{ $player['draftDetails']['pickInRound'] }}</span>
                <span>Overall : {{ $player['draftDetails']['overallPick'] }}</span>
              </li>
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
            {{-- goalie summary --}}
            @include('includes._player_summary')
            @if (array_key_exists('awards', $player))
              <ul class="player-awards">
                @foreach ($player['awards'] as $award)
                  <li>
                    <h3>{{ $award['trophy']['default'] }}</h3>
                    @foreach ($award['seasons'] as $awardSeasonStat)
                      @php
                        $firstHalfSeason = [];
                        $secondHalfSeason = [];
                        $season = (string) $awardSeasonStat['seasonId'];
                        $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
                        $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
                      @endphp
                      <p>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}</p>
                      <p>Games : {{ $awardSeasonStat['gamesPlayed'] }}</p>
                      <p>Wins : {{ $awardSeasonStat['wins'] }}</p>
                      <p>Losses : {{ $awardSeasonStat['losses'] }}</p>
                      <p>Save % : {{ round((float) $awardSeasonStat['savePctg'], 3) }}%</p>
                      <p>Goals AA : {{ round((float) $awardSeasonStat['gaa'] * 1, 2) }}%</p>
                    @endforeach
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
          <h2>
            Regular Season
            <p>
              Playoffs Below :
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
            {{-- skater summary --}}
            @include('includes._player_summary')
            @if (array_key_exists('awards', $player))
              <ul class="player-awards">
                @foreach ($player['awards'] as $award)
                  <li>
                    <h3>{{ $award['trophy']['default'] }}</h3>
                    @foreach ($award['seasons'] as $awardSeasonStat)
                      @php
                        $firstHalfSeason = [];
                        $secondHalfSeason = [];
                        $season = (string) $awardSeasonStat['seasonId'];
                        $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
                        $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
                      @endphp
                      <p>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}</p>
                      <p>Games : {{ $awardSeasonStat['gamesPlayed'] }}</p>
                      <p>Goals : {{ $awardSeasonStat['goals'] }}</p>
                      <p>Assists : {{ $awardSeasonStat['assists'] }}</p>
                      <p>Points : {{ $awardSeasonStat['points'] }}</p>
                      <p>+/- : {{ $awardSeasonStat['plusMinus'] }}</p>
                      <p>Hits : {{ $awardSeasonStat['hits'] }}</p>
                      <p>B Shots : {{ $awardSeasonStat['blockedShots'] }}</p>
                      <p>PIM : {{ $awardSeasonStat['pim'] }}</p>
                    @endforeach
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
          <h2>
            Regular Season
            <p>
              Playoffs Below :
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

                @if (array_key_exists('faceoffWinningPctg', $player['careerTotals']['regularSeason']))
                  <p>
                    {{ round((float) $player['careerTotals']['regularSeason']['faceoffWinningPctg'] * 100, 2) }}%
                  </p>
                @endif

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

                  @if (array_key_exists('faceoffWinningPctg', $player['careerTotals']['regularSeason']))
                    <p>
                      {{ round((float) $player['careerTotals']['regularSeason']['faceoffWinningPctg'] * 100, 2) }}%
                    </p>
                  @endif

                </li>
              </ul>
            </div>
          @else
            <h2>No Playoffs Yet...</h2>
          @endif

        @endif
      </div>
      <div class="player-hero-image" hidden>{{ $player['heroImage'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/playerScript.js') }}"></script>
@include('includes._footer')
