@include('includes._header')
<main class="main"
  style="background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(0, 0, 0, 0.9)),
    to(rgba(0, 0, 0, 0.5))
),
url('{{ $soloTeam['teamLogo'] }}');
background-image: linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.9),
    rgba(0, 0, 0, 0.5)
),
url('{{ $soloTeam['teamLogo'] }}'); background-size: contain; background-position: center;">
  <div class="main-container"
    style="background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(245, 245, 245, 1)),
    to(rgba(245, 245, 245, 0.75))
),
url('{{ $soloTeam['teamLogo'] }}');
background-image: linear-gradient(
    90deg,
    rgba(245, 245, 245, 1),
    rgba(245, 245, 245, 0.75)
),
url('{{ $soloTeam['teamLogo'] }}'); background-size: contain; background-position: center;">
    <div class="team-container">
      <div class="team-heading-container">
        <div class="team-heading-left">
          <h2>{{ $soloTeam['teamName']['default'] }}</h2>
          <div>
            <a href="#team-upcoming" class="team-stats-button">Upcoming</a>
            <a href="#team-finished" class="team-stats-button">Finished</a>
          </div>

        </div>
        <div class="team-heading-logo">
          <img src={{ $soloTeam['teamLogo'] }} alt="{{ $soloTeam['teamName']['default'] }} Logo" width="100"
            height="100">
        </div>
      </div>
      {{-- team summary --}}
      <div class="horizontal-scrolling-container">
        <ul class="team-summary">
          <li>
            <h3>Conference</h3>
            <p>{{ $soloTeam['conferenceName'] }}</p>
          </li>
          <li>
            <h3>Division</h3>
            <p>{{ $soloTeam['divisionName'] }}</p>
          </li>
          <li>
            <h3>Streak {{ '(' . $soloTeam['streakCode'] . ')' }}</h3>
            <p>{{ $soloTeam['streakCount'] }}</p>
          </li>
          <li>
            <h3>Common Name</h3>
            <p>{{ $soloTeam['teamCommonName']['default'] }}</p>
          </li>
          <li>
            <h3>Abbrev</h3>
            <p>{{ $soloTeam['teamAbbrev']['default'] }}</p>
          </li>
        </ul>
      </div>
      {{-- season stats --}}
      <div class="team-stats-container">
        <h2>Regular Season
          <p class="team-heading-record">
            {{ $soloTeam['wins'] }} -
            {{ $soloTeam['losses'] }} -
            {{ $soloTeam['ties'] }}
          </p>
        </h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Seaon">Season</h3>
              <h3 title="Games Played">GP</h3>
              <h3 title="Wins">W</h3>
              <h3 title="Losses">L</h3>
              <h3 title="Regulation Wins">RW</h3>
              <h3 title="OT Wins">OTW</h3>
              <h3 title="OT Losses">OTL</h3>
              <h3 title="Shootout Wins">SOW</h3>
              <h3 title="Shootout Losses">SOL</h3>
              <h3 title="Points">PTS</h3>
              <h3 title="Point %">PT%</h3>
              <h3 title="Goals For">GF</h3>
              <h3 title="Goals Against">GA</h3>
              <h3 title="Goals For %">GF%</h3>
              <h3 title="Goal Differential">GD</h3>
            </li>
            <li>
              <p>{{ $formattedSeason }}</p>
              <p>{{ $soloTeam['gamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['wins'] }}</p>
              <p>{{ $soloTeam['losses'] }}</p>
              <p>{{ $soloTeam['regulationWins'] }}</p>
              <p>{{ $soloTeam['regulationPlusOtWins'] - $soloTeam['regulationWins'] }}</p>
              <p>{{ $soloTeam['otLosses'] }}</p>
              <p>{{ $soloTeam['shootoutWins'] }}</p>
              <p>{{ $soloTeam['shootoutLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['points'] }}</p>
              <p>{{ round((float) $soloTeam['pointPctg'] * 100, 1) }}%</p>
              <p>{{ $soloTeam['goalFor'] }}</p>
              <p>{{ $soloTeam['goalAgainst'] }}</p>
              <p>{{ round((float) $soloTeam['goalsForPctg'] * 1, 2) }}%</p>
              <p>{{ $soloTeam['goalDifferential'] }}</p>
            </li>
          </ul>
        </div>

        <h2>Statistic Types</h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Record Type">Record Type</h3>
              <h3 title="Games Played">GP</h3>
              <h3 title="Wins">W</h3>
              <h3 title="Losses">L</h3>
              <h3 title="Regulation Wins">RW</h3>
              <h3 title="OT Wins">OTW</h3>
              <h3 title="OT Losses">OTL</h3>
              <h3 title="Points">PTS</h3>
              <h3 title="Goals For">GF</h3>
              <h3 title="Goals Against">GA</h3>
              <h3 title="Goal Differential">GD</h3>
            </li>
            <li>
              <p>Home</p>
              <p>{{ $soloTeam['homeGamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['homeWins'] }}</p>
              <p>{{ $soloTeam['homeLosses'] }}</p>
              <p>{{ $soloTeam['homeRegulationWins'] }}</p>
              <p>{{ $soloTeam['homeRegulationPlusOtWins'] - $soloTeam['homeRegulationWins'] }}</p>
              <p>{{ $soloTeam['homeOtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['homePoints'] }}</p>
              <p>{{ $soloTeam['homeGoalsFor'] }}</p>
              <p>{{ $soloTeam['homeGoalsAgainst'] }}</p>
              <p>{{ $soloTeam['homeGoalDifferential'] }}</p>
            </li>
            <li>
              <p>Road</p>
              <p>{{ $soloTeam['roadGamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['roadWins'] }}</p>
              <p>{{ $soloTeam['roadLosses'] }}</p>
              <p>{{ $soloTeam['roadRegulationWins'] }}</p>
              <p>{{ $soloTeam['roadRegulationPlusOtWins'] - $soloTeam['roadRegulationWins'] }}</p>
              <p>{{ $soloTeam['roadOtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['roadPoints'] }}</p>
              <p>{{ $soloTeam['roadGoalsFor'] }}</p>
              <p>{{ $soloTeam['roadGoalsAgainst'] }}</p>
              <p>{{ $soloTeam['roadGoalDifferential'] }}</p>
            </li>
            <li>
              <p>Last 10</p>
              <p>{{ $soloTeam['l10GamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['l10Wins'] }}</p>
              <p>{{ $soloTeam['l10Losses'] }}</p>
              <p>{{ $soloTeam['l10RegulationWins'] }}</p>
              <p>{{ $soloTeam['l10RegulationPlusOtWins'] - $soloTeam['l10RegulationWins'] }}</p>
              <p>{{ $soloTeam['l10OtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['l10Points'] }}</p>
              <p>{{ $soloTeam['l10GoalsFor'] }}</p>
              <p>{{ $soloTeam['l10GoalsAgainst'] }}</p>
              <p>{{ $soloTeam['l10GoalDifferential'] }}</p>
            </li>
          </ul>
        </div>
      </div>

      {{-- UPCOMING GAMES --}}
      @if (count($upcomingGames) < 1)
        <div class="regular-season-container">
          <div id="team-upcoming"></div>
          <h2>Upcoming Games</h2>
          <ul class="league-regular-season owl-carousel upcoming owl-theme upcoming-games">
            <li class="league-game-card">
              <div class="game-date-location">
                {{ $currentDate }}
              </div>
              <div class="game-team-container">
                <p>No games today...</p>
              </div>
            </li>
          </ul>
        </div>
      @else
        <div class="regular-season-container">
          <div id="team-upcoming"></div>
          <h2>Upcoming Games
            <p>Home Game :
              <span></span>
            </p>
          </h2>
          <ul class="league-regular-season owl-carousel owl-theme upcoming-games transition-container">
            @foreach ($upcomingGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->format('D M j, Y');
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                {{-- dropdown menus --}}
                @include('includes._game_card_dropdown')
                {{-- game card --}}
                @include('includes._game_card')
                <span class='game-number'>
                  {{ count($finishedGames) + 1 + $key }} of {{ count($upcomingGames) + count($finishedGames) }}
                </span>
                @if ($game['homeTeam']['abbrev'] === $soloTeam['teamAbbrev']['default'])
                  <span class="home-game-indicator"></span>
                @endif
                {{-- used to auto open dropdowns --}}
                <div class="game-state" hidden>{{ $game['gameState'] }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      {{-- FINISHED GAMES --}}
      @if (count($finishedGames) < 1)
        <div class="regular-season-container">
          <div id="team-finished"></div>
          <h2>Finished Games</h2>
          <ul class="league-regular-season owl-carousel owl-theme finished-games">
            <li class="league-game-card">
              <div class="game-date-location">
                {{ $currentDate }}
              </div>
              <div class="game-team-container">
                <p>No games today...</p>
              </div>
            </li>
          </ul>
        </div>
      @else
        <div class="regular-season-container">
          <div id="team-finished"></div>
          <h2>Finished Games
            <p>Home Game :
              <span></span>
            </p>
          </h2>
          <ul class="league-regular-season owl-carousel owl-theme finished-games transition-container">
            @foreach ($finishedGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->format('D M j, Y');
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                {{-- dropdown menu --}}
                @include('includes._game_card_dropdown')
                {{-- game card --}}
                @include('includes._game_card')
                <span class='game-number'>
                  {{ count($finishedGames) - $key }} of {{ count($upcomingGames) + count($finishedGames) }}
                </span>
                @if ($game['homeTeam']['abbrev'] === $soloTeam['teamAbbrev']['default'])
                  <span class="home-game-indicator"></span>
                @endif
                {{-- used to auto open dropdowns --}}
                <div class="game-state" hidden>{{ $game['gameState'] }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- PRESEASON GAMES --}}
      {{-- @if (count($preseason) < 1)
          <div class="horizontal-scrolling-container preseason-scrolling-container">
            <div class="team-preseason-container">
              <h2>Preseason Games</h2>
              <ul class="team-preseason">
                <li class="team-preseason">
                  <div class="game-date-location">
                    {{ $currentDate }}
                  </div>
                  <div class="game-team-container">
                    <p>No games today...</p>
                  </div>
                </li>
              </ul>
            </div>
          @else
            <div class="horizontal-scrolling-container preseason-scrolling-container">
              <div class="team-preseason-container">
                <h2>Preseason Games</h2>
                <ul class="team-preseason">
                  @foreach ($preseason as $key => $game)
                    @php
                      $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                      $formattedGameDate = $gameDateTime->format('D M j, Y');
                      $formattedGameTime = $gameDateTime->format('h:i A');
                    @endphp
                    <li class="team-preseason-card">
                      @include('includes._game_card')
                      <span class='game-number'>
                        {{ $key + 1 }} of {{ count($preseason) }}
                      </span>
                      @if ($game['homeTeam']['abbrev'] === $soloTeam['teamAbbrev']['default'])
                        <span class="home-game-indicator"></span>
                      @endif
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif --}}


    </div>
</main>
<script src="{{ asset('js/teamScript.js') }}"></script>
@include('includes._footer')
