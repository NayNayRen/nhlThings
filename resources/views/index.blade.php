@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="league-schedule-container">
      <div class="league-schedule-heading-container">
        <h2>Game Dates</h2>
      </div>
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
                $formattedGameDate = Carbon\Carbon::create($dailyGames[$i]['startTimeUTC'])
                    ->subDay()
                    ->toFormattedDateString();
                $formattedGameTime = $dailyGames[$i]['easternUTCOffset'];
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
                  <p class='game-team-name'>
                    {{ $dailyGames[$i]['awayTeam']['placeName']['default'] }}
                    <span class="game-team-logo">
                      <img src={{ $dailyGames[$i]['awayTeam']['logo'] }}
                        alt={{ $dailyGames[$i]['awayTeam']['placeName']['default'] }} width="100" height="100">
                    </span>
                  </p>
                  {{-- <p class='game-team-record'>{{ $linescores[$i]['awayTeam']['record'] }}</p> --}}
                </div>
                {{-- HOME TEAM --}}
                <div class="game-team-container">
                  <p>Home :</p>
                  <p class='game-team-name'>
                    {{ $dailyGames[$i]['homeTeam']['placeName']['default'] }}
                    <span class="game-team-logo">
                      <img src={{ $dailyGames[$i]['homeTeam']['logo'] }}
                        alt={{ $dailyGames[$i]['homeTeam']['placeName']['default'] }} width="100" height="100">
                    </span>
                  </p>
                  {{-- <p class='game-team-record'>{{ $linescores[$i]['homeTeam']['record'] }}</p> --}}
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
        </div>
      @endif
    </div>

  </div>
</main>
<script src="{{ asset('js/leagueCarousel.js') }}"></script>
@include('includes._footer')
