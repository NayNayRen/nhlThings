@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="schedule-container">
      <div class="schedule-heading-container">
        <h2 id="home-team-name">{{ $soloTeam['teamName']['default'] }}</h2>
        <div class="schedule-heading-logo">
          <img src={{ $soloTeam['teamLogo'] }} alt="{{ $soloTeam['teamName']['default'] }} Logo" width="100"
            height="100">
        </div>
      </div>
      @if (count($regularSeason) < 1)
        <div class="regular-season-container">
          <h2>Regular Season Games</h2>
          <ul class="league-regular-season owl-carousel owl-theme team-carousel">
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
          <h2>Regular Season Games</h2>
          <ul class="league-regular-season owl-carousel owl-theme team-carousel">
            @foreach ($regularSeason as $key => $game)
              @php
                $gameDateTime = Carbon\Carbon::create($game['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                @include('includes._gameCard')
                <span class='game-number'>
                  {{ $key + 1 }} of {{ count($regularSeason) }}
                </span>
              </li>
            @endforeach
          </ul>
        </div>
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
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    </div>
  </div>
</main>
<script src="{{ asset('js/teamCarousel.js') }}"></script>
@include('includes._footer')
