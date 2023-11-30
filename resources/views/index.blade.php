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
                $gameData = App\Http\Controllers\ApiController::getGameMatchup($game['id']);
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->format('D M j, Y');
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-dropdown-button">
                  <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
                </div>
                {{-- dropdown menu --}}
                @if ($game['gameState'] === 'OFF' || $game['gameState'] === 'FINAL')
                  <div class="game-dropdown-container">
                    <ul class="game-dropdown-details">
                      <li class='game-dropdown-header'>
                        <div class='game-finished-date'>
                          <p>{{ $formattedGameDate }}</p>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['awayTeam']['logo'] }}
                            alt='{{ $game['awayTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                        <div>
                          <h3>FINAL</h3>
                          <span>{{ $gameData['clock']['timeRemaining'] }}</span>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['homeTeam']['logo'] }}
                            alt='{{ $game['homeTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                      </li>
                      <li class='game-dropdown-goals'>
                        <div>
                          <p>{{ $gameData['awayTeam']['score'] }}</p>
                          <h3>Goals</h3>
                          <p>{{ $gameData['homeTeam']['score'] }}</p>
                        </div>
                        @foreach ($gameData['summary']['linescore']['byPeriod'] as $goals)
                          <div>
                            <p>{{ $goals['away'] }}</p>
                            <span>{{ $goals['period'] }}</span>
                            <p>{{ $goals['home'] }}</p>
                          </div>
                        @endforeach
                      </li>
                      <li class='game-dropdown-shots'>
                        <div>
                          <p>{{ $gameData['awayTeam']['sog'] }}</p>
                          <h3>Shots</h3>
                          <p>{{ $gameData['homeTeam']['sog'] }}</p>
                        </div>
                        @foreach ($gameData['summary']['shotsByPeriod'] as $shots)
                          <div>
                            <p>{{ $shots['away'] }}</p>
                            <span>{{ $shots['period'] }}</span>
                            <p>{{ $shots['home'] }}</p>
                          </div>
                        @endforeach
                      </li>
                      <button type='button' class='game-slideout-show-button'>
                        Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
                      </button>
                    </ul>
                  </div>
                @endif
                @if ($game['gameState'] === 'LIVE')
                  <div class="game-dropdown-container">
                    <ul class="game-dropdown-details">
                      <li class='game-dropdown-header'>
                        <div class='game-finished-date'>
                          <p>{{ $formattedGameDate }}</p>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['awayTeam']['logo'] }}
                            alt='{{ $game['awayTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                        <div>
                          <h3>{{ $game['periodDescriptor']['number'] }}</h3>
                          <span>{{ $gameData['clock']['timeRemaining'] }}</span>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['homeTeam']['logo'] }}
                            alt='{{ $game['homeTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                      </li>
                      <li class='game-dropdown-goals'>
                        <div>
                          <p>{{ $gameData['awayTeam']['score'] }}</p>
                          <h3>Goals</h3>
                          <p>{{ $gameData['homeTeam']['score'] }}</p>
                        </div>
                        @foreach ($gameData['summary']['linescore']['byPeriod'] as $goals)
                          <div>
                            <p>{{ $goals['away'] }}</p>
                            <span>{{ $goals['period'] }}</span>
                            <p>{{ $goals['home'] }}</p>
                          </div>
                        @endforeach
                      </li>
                      <li class='game-dropdown-shots'>
                        <div>
                          <p>{{ $gameData['awayTeam']['sog'] }}</p>
                          <h3>Shots</h3>
                          <p>{{ $gameData['homeTeam']['sog'] }}</p>
                        </div>
                        @foreach ($gameData['summary']['shotsByPeriod'] as $shots)
                          <div>
                            <p>{{ $shots['away'] }}</p>
                            <span>{{ $shots['period'] }}</span>
                            <p>{{ $shots['home'] }}</p>
                          </div>
                        @endforeach
                      </li>
                      <button type='button' class='game-slideout-show-button'>
                        Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
                      </button>
                    </ul>
                  </div>
                @endif
                @if ($game['gameState'] === 'PRE')
                  <div class="game-dropdown-container">
                    <ul class="game-dropdown-details">
                      <li class='game-dropdown-header'>
                        <div class='game-finished-date'>
                          <p>{{ $formattedGameDate }}</p>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['awayTeam']['logo'] }}
                            alt='{{ $game['awayTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                        <div>
                          <h3>PREGAME</h3>
                          <span>{{ $gameData['clock']['timeRemaining'] }}</span>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['homeTeam']['logo'] }}
                            alt='{{ $game['homeTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                      </li>
                      <li class='game-dropdown-goals'>
                        <div>
                          <p>Coming...</p>
                          {{-- <p>{{ $game['awayTeam']['score'] }}</p> --}}
                          <h3>Goals</h3>
                          <p>Coming...</p>
                          {{-- <p>{{ $game['homeTeam']['score'] }}</p> --}}
                        </div>
                      </li>
                    </ul>
                  </div>
                @endif
                @if ($game['gameState'] === 'FUT')
                  <div class="game-dropdown-container">
                    <ul class="game-dropdown-details">
                      <li class='game-dropdown-header'>
                        <div class='game-finished-date'>
                          <p>{{ $formattedGameDate }}</p>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['awayTeam']['logo'] }}
                            alt='{{ $game['awayTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                        <div>
                          <h3>UPCOMING</h3>
                          <span>00:00</span>
                        </div>
                        <div class="game-dropdown-team-logo">
                          <img src={{ $game['homeTeam']['logo'] }}
                            alt='{{ $game['homeTeam']['placeName']['default'] }} Logo' width="75" height="75">
                        </div>
                      </li>
                      <li class='game-dropdown-goals'>
                        <div>
                          <p>Coming...</p>
                          {{-- <p>{{ $game['awayTeam']['score'] }}</p> --}}
                          <h3>Goals</h3>
                          <p>Coming...</p>
                          {{-- <p>{{ $game['homeTeam']['score'] }}</p> --}}
                        </div>
                      </li>
                    </ul>
                  </div>
                @endif
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ $key + 1 }} of {{ count($dailyGames) }}
                </span>
                {{-- to auto open finished games --}}
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
    </div>

  </div>
</main>
<script src="{{ asset('js/leagueScript.js') }}"></script>
@include('includes._footer')
