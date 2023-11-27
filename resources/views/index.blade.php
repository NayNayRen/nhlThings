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
          <input type="button" class="league-game-dates-dropdown-button" value="Current Dates..." /><br />
          <ul class="league-game-dates-dropdown-list">
            @foreach ($weeklyGames as $weeklyGame)
              <li>
                <p>{{ $weeklyGame['dayAbbrev'] }}
                  {{ \Carbon\Carbon::parse($weeklyGame['date'])->toFormattedDateString() }}</p>
                <p>Games : {{ $weeklyGame['numberOfGames'] }}</p>
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
          <h2>Today's Games</h2>
          <ul class="league-regular-season owl-carousel owl-theme league-carousel">
            @foreach ($dailyGames as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ $key + 1 }} of {{ count($dailyGames) }}
                </span>
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
