@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="league-container">
      <div class="league-heading-container">
        <div class="league-heading-logo-dropdown-container">
          <h2>NHL Games</h2>
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
        <div class="shield-logo">
          <img src={{ asset('img/nhl-shield.png') }} alt="NHL Logo" width="100" height="100">
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
          <ul class="league-regular-season owl-carousel owl-theme league-carousel transition-container">
            @foreach ($dailyGames as $key => $game)
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
                  {{ $key + 1 }} of {{ count($dailyGames) }}
                </span>
                {{-- used to auto open dropdowns --}}
                <div class="game-state" hidden>{{ $game['gameState'] }}</div>
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      <!-- container with league stats -->
      <div class="main-data-container">
        {{--         
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
              <button type="button" class="atlantic-button">Atlantic</button>
              <button type="button" class="central-button">Central</button>
              <button type="button" class="metro-button">Metro</button>
              <button type="button" class="pacific-button">Pacific</button>
            </div>
          </div>
        </div>
        <span class="current-season" hidden>{{ $season }}</span> --}}

        <!-- league stats -->
        <div class="league-data-container">

          <div class="league-standings-heading-container">
            <div>
              <h2>League Standings</h2>
              <p>{{ $formattedSeason }}</p>
            </div>
            <div>
              <img src={{ asset('img/nhl-logo.png') }} alt="NHL Logo" width="100" height="100">
            </div>
          </div>

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
                <button type="button" class="atlantic-button">Atlantic</button>
                <button type="button" class="central-button">Central</button>
                <button type="button" class="metro-button">Metro</button>
                <button type="button" class="pacific-button">Pacific</button>
              </div>
            </div>
          </div>
          <span class="current-season" hidden>{{ $season }}</span>

          <div class="horizontal-scrolling-container">
            <ul class="league-standings-table league-table">
              {{-- league standings header --}}
              @include('includes._standings_header')
              @foreach ($allTeams as $key => $team)
                {{-- league standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table east-table">
              {{-- east standings header --}}
              @include('includes._standings_header')
              @foreach ($east as $key => $team)
                {{-- east standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table west-table">
              {{-- west standings header --}}
              @include('includes._standings_header')
              @foreach ($west as $key => $team)
                {{-- west standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table atlantic-table">
              {{-- atlantic standings header --}}
              @include('includes._standings_header')
              @foreach ($atlantic as $key => $team)
                {{-- atlantic standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table central-table">
              {{-- central standings table --}}
              @include('includes._standings_header')
              @foreach ($central as $key => $team)
                {{-- central standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table metro-table">
              {{-- metro standings header --}}
              @include('includes._standings_header')
              @foreach ($metro as $key => $team)
                {{-- metro standings table --}}
                @include('includes._standings_table')
              @endforeach
            </ul>

            <ul class="league-standings-table pacific-table">
              {{-- pacific standings header --}}
              @include('includes._standings_header')
              @foreach ($pacific as $key => $team)
                {{-- pacific standings table --}}
                @include('includes._standings_table')
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
