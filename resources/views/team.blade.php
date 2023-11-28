@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="team-container">
      <div class="team-heading-container">
        <h2>{{ $soloTeam['teamName']['default'] }}</h2>
        <div class="team-heading-logo">
          <img src={{ $soloTeam['teamLogo'] }} alt="{{ $soloTeam['teamName']['default'] }} Logo" width="100"
            height="100">
        </div>
        <div class="home-game-indicator-message">
          <p>Home Game :</p>
          <span></span>
        </div>
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
          <ul class="league-regular-season owl-carousel owl-theme upcoming-games">
            @foreach ($upcomingGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-dropdown-button">
                  <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
                </div>
                {{-- dropdown menu --}}
                <div class="game-dropdown-container">
                  <p>hello</p>
                </div>
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ count($finishedGames) + 1 + $key }} of {{ count($upcomingGames) + count($finishedGames) }}
                </span>
                @if ($game['homeTeam']['abbrev'] === $soloTeam['teamAbbrev']['default'])
                  <span class="home-game-indicator"></span>
                @endif
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
          <ul class="league-regular-season owl-carousel owl-theme finished-games">
            @foreach ($finishedGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-dropdown-button">
                  <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
                </div>
                {{-- dropdown menu --}}
                <div class="game-dropdown-container">
                  <p>hello</p>
                </div>
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ count($finishedGames) - $key }} of {{ count($upcomingGames) + count($finishedGames) }}
                </span>
                @if ($game['homeTeam']['abbrev'] === $soloTeam['teamAbbrev']['default'])
                  <span class="home-game-indicator"></span>
                @endif
              </li>
            @endforeach
          </ul>
        </div>
      @endif
      {{-- PRESEASON GAMES --}}
      @if (count($preseason) < 1)
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
                    $formattedGameDate = $gameDateTime->toFormattedDateString();
                    $formattedGameTime = $gameDateTime->format('h:i A');
                  @endphp
                  {{-- GAME CARDS --}}
                  <li class="team-preseason-card">
                    @include('includes._gameCard')
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
      @endif
    </div>
  </div>
</main>
<script src="{{ asset('js/teamCarousel.js') }}"></script>
@include('includes._footer')
