@include('includes._header')
<main class="main"
  style="background-image: -webkit-gradient(
  linear,
  left top,
  right top,
  from(rgba(0, 0, 0, 0.9)),
  to(rgba(0, 0, 0, 0.5))
),
url('{{ $player['heroImage'] }}');
background-image: linear-gradient(
  90deg,
  rgba(0, 0, 0, 0.9),
  rgba(0, 0, 0, 0.5)
),
url('{{ $player['heroImage'] }}'); background-size: cover; background-position: top;">
  <div class="main-container"
    style="background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(245, 245, 245, 1)),
    to(rgba(245, 245, 245, 0.75))
),
url('{{ $player['heroImage'] }}');
background-image: linear-gradient(
    90deg,
    rgba(245, 245, 245, 1),
    rgba(245, 245, 245, 0.75)
),
url('{{ $player['heroImage'] }}'); background-size: cover; background-position: top;">
    <div class="player-container">
      <div class="player-heading-container">
        <div class="player-heading-left">
          <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
          <p class="player-team">
            {{ $player['fullTeamName']['default'] }}
            <span>
              <img src={{ $player['teamLogo'] }} alt="{{ $player['currentTeamAbbrev'] }} Logo">
            </span>
          </p>
          <div class="player-button-container">
            <button type="button" class="player-award-dropdown-button">
              Award(s)
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
            <button type="button" class="player-draft-dropdown-button">
              Draft
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
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
        {{-- goalie stuff --}}
        @if ($player['position'] === 'G')
          {{-- goalie awards --}}
          <div class="player-awards-container">
            @if (array_key_exists('awards', $player))
              <div class="transition-height-container awards">
                <div class="player-award-dropdown-container">
                  @foreach ($player['awards'] as $award)
                    <h3 class="player-award-tile">{{ $award['trophy']['default'] }}</h3>
                    <ul class="player-award-dropdown-list">
                      <li>
                        <h3 title="Season">Season</h3>
                        <h3 title="Goals">Goals</h3>
                        <h3 title="Wins">Wins</h3>
                        <h3 title="Losses">Losses</h3>
                        <h3 title="Save %">SV%</h3>
                        <h3 title="Goals Against Average %">GAA%</h3>
                      </li>
                      @foreach ($award['seasons'] as $awardSeasonStat)
                        @php
                          $firstHalfSeason = [];
                          $secondHalfSeason = [];
                          $season = (string) $awardSeasonStat['seasonId'];
                          $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
                          $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
                        @endphp
                        <li>
                          <p>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}</p>
                          <p>{{ $awardSeasonStat['gamesPlayed'] }}</p>
                          <p>{{ $awardSeasonStat['wins'] }}</p>
                          <p>{{ $awardSeasonStat['losses'] }}</p>
                          <p>{{ round((float) $awardSeasonStat['savePctg'], 3) }}%</p>
                          <p>{{ round((float) $awardSeasonStat['gaa'] * 1, 2) }}%</p>
                        </li>
                      @endforeach
                    </ul>
                  @endforeach
                </div>
              </div>
            @else
              <div class="transition-height-container awards">
                <div class="player-award-dropdown-container">
                  <h3 class="player-award-tile">{{ $player['firstName']['default'] }}
                    {{ $player['lastName']['default'] }} hasn't won any awards yet...</h3>
                </div>
              </div>
            @endif
          </div>
          {{-- goalie draft --}}
          <div class="player-draft-container">
            @if (array_key_exists('draftDetails', $player))
              <div class="transition-height-container draft">
                <div class="player-draft-dropdown-container">
                  <h3 class="player-draft-tile">Draft Details</h3>
                  <ul class="player-draft-dropdown-list">
                    <li>
                      <h3>Year</h3>
                      <h3>By</h3>
                      <h3>Round</h3>
                      <h3>Picked</h3>
                      <h3>Overall</h3>
                    </li>
                    <li>
                      <p>{{ $player['draftDetails']['year'] }}</p>
                      <p>{{ $player['draftDetails']['teamAbbrev'] }}</p>
                      <p>{{ $player['draftDetails']['round'] }}</p>
                      <p>{{ $player['draftDetails']['pickInRound'] }}</p>
                      <p>{{ $player['draftDetails']['overallPick'] }}</p>
                    </li>
                  </ul>
                </div>
              </div>
            @else
              <div class="transition-height-container draft">
                <div class="player-draft-dropdown-container">
                  <h3 class="player-draft-tile">{{ $player['firstName']['default'] }}
                    {{ $player['lastName']['default'] }} went undrafted...</h3>
                </div>
              </div>
            @endif
          </div>
          <div class="horizontal-scrolling-container">
            {{-- goalie summary --}}
            @include('includes._player_summary')
          </div>
          {{-- goalie last 5 --}}
          <h2>
            Last 5 Games
            <p>
              Home Game :
              <span></span>
            </p>
          </h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-last-five">
              <li>
                <h3 title="Date">Date</h3>
                <h3 title="Against">Against</h3>
                <h3 title="Games Started">GS</h3>
                <h3 title="Decision">Decision</h3>
                <h3 title="Shots Against">SA</h3>
                <h3 title="Goals Against">GA</h3>
                <h3 title="Save %">SV%</h3>
                <h3 title="Penalty Minutes">PIM</h3>
                <h3 title="Time On Ice">TOI</h3>
              </li>
              @foreach ($player['last5Games'] as $key => $game)
                <li>
                  <p>
                    <span>{{ $key + 1 }}.</span>
                    {{ $game['gameDate'] }}
                    @if ($game['homeRoadFlag'] === 'H')
                      <span class="playoff-season-marker"></span>
                    @endif
                  </p>
                  <p>{{ $game['opponentAbbrev'] }}</p>
                  <p>{{ $game['gamesStarted'] }}</p>
                  @if (array_key_exists('decision', $game))
                    <p class='table-column-focus'>{{ $game['decision'] }}</p>
                  @else
                    <p class='table-column-focus'>--</p>
                  @endif
                  <p>{{ $game['shotsAgainst'] }}</p>
                  <p>{{ $game['goalsAgainst'] }}</p>
                  <p>{{ round((float) $game['savePctg'], 3) }}%</p>
                  <p>{{ $game['penaltyMins'] }}</p>
                  <p>{{ $game['toi'] }}</p>
                </li>
              @endforeach
            </ul>
          </div>
          <h2>
            Regular Season
            <p>
              Playoffs :
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
                <p title="Season">Regular</p>
                <p>Career</p>
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
            <h2>Post Season</h2>
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
                  <p title="Season">Post</p>
                  <p>Career</p>
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
            {{-- @else
            <h2>No Playoff Stats Yet...</h2> --}}
          @endif
          {{-- skater stuff --}}
        @else
          {{-- skater awards --}}
          <div class="player-awards-container">
            @if (array_key_exists('awards', $player))
              <div class="transition-height-container awards">
                <div class="player-award-dropdown-container">
                  @foreach ($player['awards'] as $award)
                    <h3 class="player-award-tile">{{ $award['trophy']['default'] }}</h3>
                    <ul class="player-award-dropdown-list">
                      <li>
                        <h3 title="Season">Season</h3>
                        <h3 title="Goals">Goals</h3>
                        <h3 title="Assists">Assists</h3>
                        <h3 title="Points">Points</h3>
                        <h3 title="Plus Minus">+/-</h3>
                        <h3 title="Hits">Hits</h3>
                        <h3 title="Blocked Shots">B Shots</h3>
                        <h3 title="Penalty Minutes">PIM</h3>
                      </li>
                      @foreach ($award['seasons'] as $awardSeasonStat)
                        @php
                          $firstHalfSeason = [];
                          $secondHalfSeason = [];
                          $season = (string) $awardSeasonStat['seasonId'];
                          $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
                          $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
                        @endphp
                        <li>
                          <p>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}</p>
                          <p>{{ $awardSeasonStat['goals'] }}</p>
                          <p>{{ $awardSeasonStat['assists'] }}</p>
                          <p>{{ $awardSeasonStat['points'] }}</p>
                          <p>{{ $awardSeasonStat['plusMinus'] }}</p>
                          <p>{{ $awardSeasonStat['hits'] }}</p>
                          <p>{{ $awardSeasonStat['blockedShots'] }}</p>
                          <p>{{ $awardSeasonStat['pim'] }}</p>
                        </li>
                      @endforeach
                    </ul>
                  @endforeach
                </div>
              </div>
            @else
              <div class="transition-height-container awards">
                <div class="player-award-dropdown-container">
                  <h3 class="player-award-tile">{{ $player['firstName']['default'] }}
                    {{ $player['lastName']['default'] }} hasn't won any awards yet...</h3>
                </div>
              </div>
            @endif
          </div>
          {{-- skater draft details --}}
          <div class="player-draft-container">
            @if (array_key_exists('draftDetails', $player))
              <div class="transition-height-container draft">
                <div class="player-draft-dropdown-container">
                  <h3 class="player-draft-tile">Draft Details</h3>
                  <ul class="player-draft-dropdown-list">
                    <li>
                      <h3>Year</h3>
                      <h3>By</h3>
                      <h3>Round</h3>
                      <h3>Picked</h3>
                      <h3>Overall</h3>
                    </li>
                    <li>
                      <p>{{ $player['draftDetails']['year'] }}</p>
                      <p>{{ $player['draftDetails']['teamAbbrev'] }}</p>
                      <p>{{ $player['draftDetails']['round'] }}</p>
                      <p>{{ $player['draftDetails']['pickInRound'] }}</p>
                      <p>{{ $player['draftDetails']['overallPick'] }}</p>
                    </li>
                  </ul>
                </div>
              </div>
            @else
              <div class="transition-height-container draft">
                <div class="player-draft-dropdown-container">
                  <h3 class="player-draft-tile">{{ $player['firstName']['default'] }}
                    {{ $player['lastName']['default'] }} went undrafted...</h3>
                </div>
              </div>
            @endif
          </div>
          <div class="horizontal-scrolling-container">
            {{-- skater summary --}}
            @include('includes._player_summary')
          </div>
          {{-- skater last 5 --}}
          <h2>
            Last 5 Games
            <p>
              Home Game :
              <span></span>
            </p>
          </h2>
          <div class="horizontal-scrolling-container">
            <ul class="player-last-five">
              <li>
                <h3 title="Date">Date</h3>
                <h3 title="Against">Against</h3>
                <h3 title="Goals">Goals</h3>
                <h3 title="Assists">Assists</h3>
                <h3 title="Points">Points</h3>
                <h3 title="Plus Minus">+/-</h3>
                <h3 title="Power Play Goals">PPG</h3>
                <h3 title="Shots">Shots</h3>
                <h3 title="Shifts">Shifts</h3>
                <h3 title="Short Handed Goals">SHG</h3>
                <h3 title="Penalty Minutes">PIM</h3>
                <h3 title="Time On Ice">TOI</h3>
              </li>
              @foreach ($player['last5Games'] as $key => $game)
                <li>
                  <p>
                    <span>{{ $key + 1 }}.</span>
                    {{ $game['gameDate'] }}
                    @if ($game['homeRoadFlag'] === 'H')
                      <span class="playoff-season-marker"></span>
                    @endif
                  </p>
                  <p>{{ $game['opponentAbbrev'] }}</p>
                  <p>{{ $game['goals'] }}</p>
                  <p>{{ $game['assists'] }}</p>
                  <p class='table-column-focus'>{{ $game['points'] }}</p>
                  <p>{{ $game['plusMinus'] }}</p>
                  <p>{{ $game['powerPlayGoals'] }}</p>
                  <p>{{ $game['shots'] }}</p>
                  <p>{{ $game['shifts'] }}</p>
                  <p>{{ $game['shorthandedGoals'] }}</p>
                  <p>{{ $game['pim'] }}</p>
                  <p>{{ $game['toi'] }}</p>
                </li>
              @endforeach
            </ul>
          </div>
          <h2>
            Regular Season
            <p>
              Playoffs :
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
                <p title="Season">Regular</p>
                <p>Career</p>
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
            <h2>Post Season</h2>
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
                  <p title="Season">Post</p>
                  <p>Career</p>
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
            {{-- @else
            <h2>No Playoff Stats Yet...</h2> --}}
          @endif

        @endif
      </div>
      <div class="player-hero-image" hidden>{{ $player['heroImage'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/playerScript.js') }}"></script>
@include('includes._footer')
