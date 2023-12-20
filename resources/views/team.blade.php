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
          <p class="team-heading-record">
            {{ $soloTeam['wins'] }} -
            {{ $soloTeam['losses'] }} -
            {{ $soloTeam['ties'] }}
          </p>
          <div class="home-game-indicator-message">
            <p>Home Game :</p>
            <span></span>
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
      {{-- UPCOMING GAMES --}}
      @if (count($upcomingGames) < 1)
        <div class="regular-season-container">
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
          <h2>Upcoming Games</h2>
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
          <h2>Finished Games</h2>
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
      <div class="regular-season-container">
        <h2>Regular Season</h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Seaon">Season</h3>
              <h3 title="Games Played">GP</h3>
              <h3 title="Wins">W</h3>
              <h3 title="Losses">L</h3>
              <h3 title="Regulation Wins">RW</h3>
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

        <h2>Home Record</h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Seaon">Season</h3>
              <h3 title="Games Played">H GP</h3>
              <h3 title="Wins">H W</h3>
              <h3 title="Losses">H L</h3>
              <h3 title="Regulation Wins">H RW</h3>
              <h3 title="OT Losses">H OTL</h3>
              <h3 title="Points">H PTS</h3>
              <h3 title="Goals For">H GF</h3>
              <h3 title="Goals Against">H GA</h3>
              <h3 title="Goal Differential">H GD</h3>
            </li>
            <li>
              <p>{{ $formattedSeason }}</p>
              <p>{{ $soloTeam['homeGamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['homeWins'] }}</p>
              <p>{{ $soloTeam['homeLosses'] }}</p>
              <p>{{ $soloTeam['homeRegulationWins'] }}</p>
              <p>{{ $soloTeam['homeOtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['homePoints'] }}</p>
              <p>{{ $soloTeam['homeGoalsFor'] }}</p>
              <p>{{ $soloTeam['homeGoalsAgainst'] }}</p>
              <p>{{ $soloTeam['homeGoalDifferential'] }}</p>
            </li>
          </ul>
        </div>

        <h2>Road Record</h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Seaon">Season</h3>
              <h3 title="Games Played">R GP</h3>
              <h3 title="Wins">R W</h3>
              <h3 title="Losses">R L</h3>
              <h3 title="Regulation Wins">R RW</h3>
              <h3 title="OT Losses">R OTL</h3>
              <h3 title="Points">R PTS</h3>
              <h3 title="Goals For">R GF</h3>
              <h3 title="Goals Against">R GA</h3>
              <h3 title="Goal Differential">R GD</h3>
            </li>
            <li>
              <p>{{ $formattedSeason }}</p>
              <p>{{ $soloTeam['roadGamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['roadWins'] }}</p>
              <p>{{ $soloTeam['roadLosses'] }}</p>
              <p>{{ $soloTeam['roadRegulationWins'] }}</p>
              <p>{{ $soloTeam['roadOtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['roadPoints'] }}</p>
              <p>{{ $soloTeam['roadGoalsFor'] }}</p>
              <p>{{ $soloTeam['roadGoalsAgainst'] }}</p>
              <p>{{ $soloTeam['roadGoalDifferential'] }}</p>
            </li>
          </ul>
        </div>

        <h2>Last 10 Games</h2>
        <div class="horizontal-scrolling-container">
          <ul class="team-stats">
            <li>
              <h3 title="Season">Season</h3>
              <h3 title="Games Played">L10 GP</h3>
              <h3 title="Wins">L10 W</h3>
              <h3 title="Losses">L10 L</h3>
              <h3 title="Regulation Wins">L10 RW</h3>
              <h3 title="OT Losses">L10 OTL</h3>
              <h3 title="Points">L10 PTS</h3>
              <h3 title="Goals For">L10 GF</h3>
              <h3 title="Goals Against">L10 GA</h3>
              <h3 title="Goal Differential">L10 GD</h3>
            </li>
            <li>
              <p>{{ $formattedSeason }}</p>
              <p>{{ $soloTeam['l10GamesPlayed'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['l10Wins'] }}</p>
              <p>{{ $soloTeam['l10Losses'] }}</p>
              <p>{{ $soloTeam['l10RegulationWins'] }}</p>
              <p>{{ $soloTeam['l10OtLosses'] }}</p>
              <p class='table-column-focus'>{{ $soloTeam['l10Points'] }}</p>
              <p>{{ $soloTeam['l10GoalsFor'] }}</p>
              <p>{{ $soloTeam['l10GoalsAgainst'] }}</p>
              <p>{{ $soloTeam['l10GoalDifferential'] }}</p>
            </li>
          </ul>
        </div>
      </div>
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
      <div class="team-logo-image" hidden>{{ $soloTeam['teamLogo'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/teamScript.js') }}"></script>
@include('includes._footer')
