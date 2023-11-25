@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="schedule-container">
      <div class="schedule-heading-container">
        <h2>Game Dates</h2>
        <div class="shield-logo">
          <img src={{ asset('img/nhl-shield.png') }} alt="NHL Logo" width="100" height="100">
        </div>
      </div>
      @if (count($dailyGames) < 1)
        <div class="league-regular-season-container">
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
        <div class="league-regular-season-container">
          <ul class="league-regular-season owl-carousel owl-theme league-carousel">
            @for ($i = 0; $i < count($dailyGames); $i++)
              @php
                $gameDateTime = Carbon\Carbon::create($dailyGames[$i]['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-date-location">
                  <p class='game-date'> {{ $formattedGameDate }}
                  </p>
                  <p class='game-time'>{{ $formattedGameTime }} EST</p>
                  <p class="game-location">{{ $dailyGames[$i]['venue']['default'] }}</p>
                </div>
                {{-- AWAY TEAM --}}
                <div class="game-team-container">
                  <p>Away :</p>
                  @foreach ($allTeams as $team)
                    @if ($dailyGames[$i]['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-name'>
                        {{ $team['teamName']['default'] }}
                        <span class="game-team-logo">
                          <img src={{ $dailyGames[$i]['awayTeam']['logo'] }} alt='{{ $team['teamName']['default'] }}'
                            width="100" height="100">
                        </span>
                      </p>
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}</p>
                    @endif
                  @endforeach
                </div>
                {{-- HOME TEAM --}}
                <div class="game-team-container">
                  <p>Home :</p>
                  @foreach ($allTeams as $team)
                    @if ($dailyGames[$i]['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-name'>
                        {{ $team['teamName']['default'] }}
                        <span class="game-team-logo">
                          <img src={{ $dailyGames[$i]['homeTeam']['logo'] }} alt='{{ $team['teamName']['default'] }}'
                            width="100" height="100">
                        </span>
                      </p>
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
                      </p>
                    @endif
                  @endforeach
                </div>
                {{-- GAME BROADCASTS --}}
                <p class="game-broadcast">
                  @if (count($dailyGames[$i]['tvBroadcasts']) < 1)
                    <span>Watch :</span>
                    <span>Check Listings</span>
                  @else
                    <span>Watch :</span>
                    @foreach ($dailyGames[$i]['tvBroadcasts'] as $tvBroadcast)
                      <span>{{ $tvBroadcast['network'] }}</span>
                    @endforeach
                  @endif
                </p>
                <span class='game-number'>{{ $i + 1 }} of
                  {{ count($dailyGames) }}</span>
              </li>
            @endfor
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
<script src="{{ asset('js/leagueCarousel.js') }}"></script>
@include('includes._footer')
