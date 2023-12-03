@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="league-container">
      <div class="league-heading-container">
        <h2>NHL Games</h2>
        <div class="shield-logo">
          <img src={{ asset('img/nhl-shield.png') }} alt="NHL Logo" width="100" height="100">
        </div>
        <div class="league-game-dates-dropdown-container">
          <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
          <input type="button" class="league-game-dates-dropdown-button" value="Weekly Dates..." /><br />
          <ul class="league-game-dates-dropdown-list">
            @foreach ($weeklyGames as $weeklyGame)
              <li>
                <form action={{ route('league.index') }} method="get">
                  <input type="hidden" name="date" value="{{ $weeklyGame['date'] }}" />
                  <button type="submit">
                    <p>{{ $weeklyGame['dayAbbrev'] }}
                      {{ \Carbon\Carbon::parse($weeklyGame['date'])->toFormattedDateString() }}</p>
                    <p>Games : {{ $weeklyGame['numberOfGames'] }}</p>
                  </button>
                </form>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      @if (count($dailyGames) < 1)
        <div class="regular-season-container">
          <h2>Today's Games</h2>
          <ul class="league-regular-season owl-carousel owl-theme league-carousel">
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
          <h2>Games on {{ $currentDate }}</h2>
          <ul class="league-regular-season owl-carousel owl-theme league-carousel">
            @foreach ($dailyGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->format('D M j, Y');
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                {{-- dropdown menus --}}
                @include('includes._gameCardDropdown')
                {{-- game card --}}
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ $key + 1 }} of {{ count($dailyGames) }}
                </span>
                {{-- used to auto open dropdowns --}}
                <div class="game-state" hidden>{{ $game['gameState'] }}</div>
              </li>
            @endforeach
          </ul>
          {{-- <p>{{ count($weeklyGames['gameWeek']) }}</p> --}}
          {{-- @foreach ($weeklyGames as $weeklyGame)
                <h3>Date : {{ $weeklyGame['dayAbbrev'] }} {{ $weeklyGame['date'] }}</h3>
                @if (count($weeklyGame['games']) < 1)
                    <span>No games today...</span>
                @else
                    @foreach ($weeklyGame['games'] as $game)
                        <p>Venue :</p>
                        <span>{{ $game['venue']['default'] }}</span><br>
                    @endforeach
                @endif
            @endforeach --}}
        </div>
      @endif
      <!-- container with league stats -->
      <div class="main-data-container">
        <div class="league-standings-selection-container">
          <button type="button" class="league-button active-standings-selection">
            League
          </button>
          <div class="conference-button-container">
            <p>Conference</p>
            <div>
              <button type="button" class="east-button">Eastern</button>
              <button type="button" class="west-button">Western</button>
            </div>
          </div>
          <div class="division-button-container">
            <p>Division</p>
            <div>
              <button type="button" class="metro-button">Metro</button>
              <button type="button" class="atlantic-button">Atlantic</button>
              <button type="button" class="central-button">Central</button>
              <button type="button" class="pacific-button">Pacific</button>
            </div>
          </div>
        </div>

        <!-- league stats -->
        <div class="league-data-container">
          <div class="league-standings-heading-container">
            <h2>League Standings</h2>
          </div>
          <div class="horizontal-scrolling-container">
            <ul class="league-standings-table">
              <li class="league-standings-table-heading">
                <h3 title="Team">Team</h3>
                <h3 title="Games Played">GP</h3>
                <h3 title="Wins">W</h3>
                <h3 title="Losses">L</h3>
                <h3 title="Overtime Losses">OTL</h3>
                <h3 title="Regulation Wins">RW</h3>
                <h3 title="Shoot Out Wins">SOW</h3>
                <h3 title="Shoot Out Losses">SOL</h3>
                <h3 title="Points">PTS</h3>
                <h3 title="Point %">PT%</h3>
                <h3 title="Goals For">GF</h3>
                <h3 title="Goals Against">GA</h3>
              </li>
              @foreach ($allTeams as $key => $team)
                <li class="league-standings-row">
                  <p><span>{{ $key + 1 }}.</span>{{ $team['teamName']['default'] }}</p>
                  <p>{{ $team['gamesPlayed'] }}</p>
                  <p>{{ $team['wins'] }}</p>
                  <p>{{ $team['losses'] }}</p>
                  <p>{{ $team['otLosses'] }}</p>
                  <p>{{ $team['regulationWins'] }}</p>
                  <p>{{ $team['shootoutWins'] }}</p>
                  <p>{{ $team['shootoutLosses'] }}</p>
                  <p class='league-standings-points'>{{ $team['points'] }}</p>
                  <p>{{ $team['pointPctg'] }}</p>
                  <p>{{ $team['goalFor'] }}</p>
                  <p>{{ $team['goalAgainst'] }}</p>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>
</main>
<script src="{{ asset('js/leagueScript.js') }}"></script>
@include('includes._footer')
