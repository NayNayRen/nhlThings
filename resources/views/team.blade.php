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
        <div class="league-regular-season-container">
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
        <div class="league-regular-season-container">
          <ul class="league-regular-season owl-carousel owl-theme team-carousel">
            @for ($i = 0; $i < count($regularSeason); $i++)
              @php
                $gameDateTime = Carbon\Carbon::create($regularSeason[$i]['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-date-location">
                  <p class='game-date'> {{ $formattedGameDate }}
                  </p>
                  <p class='game-time'>{{ $formattedGameTime }} EST</p>
                  <p class="game-location">{{ $regularSeason[$i]['venue']['default'] }}</p>
                </div>
                {{-- AWAY TEAM --}}
                <div class="game-team-container">
                  <p>Away :</p>
                  @foreach ($allTeams as $team)
                    @if ($regularSeason[$i]['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-name'>
                        {{ $team['teamName']['default'] }}
                        <span class="game-team-logo">
                          <img src={{ $regularSeason[$i]['awayTeam']['logo'] }} alt='{{ $team['teamName']['default'] }}'
                            width="100" height="100">
                        </span>
                      </p>
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
                      </p>
                    @endif
                  @endforeach
                </div>
                {{-- HOME TEAM --}}
                <div class="game-team-container">
                  <p>Home :</p>
                  @foreach ($allTeams as $team)
                    @if ($regularSeason[$i]['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-name'>
                        {{ $team['teamName']['default'] }}
                        <span class="game-team-logo home-team-logo">
                          <img src={{ $regularSeason[$i]['homeTeam']['logo'] }}
                            alt='{{ $team['teamName']['default'] }}' width="100" height="100">
                        </span>
                      </p>
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
                      </p>
                    @endif
                  @endforeach
                </div>
                {{-- GAME BROADCASTS --}}
                <p class="game-broadcast">
                  @if (count($regularSeason[$i]['tvBroadcasts']) < 1)
                    <span>Watch :</span>
                    <span>Check Listings</span>
                  @else
                    <span>Watch :</span>
                    @foreach ($regularSeason[$i]['tvBroadcasts'] as $tvBroadcast)
                      <span>{{ $tvBroadcast['network'] }}</span>
                    @endforeach
                  @endif
                </p>
                <span class='game-number'>{{ $i + 1 }} of
                  {{ count($regularSeason) }}</span>
              </li>
            @endfor
          </ul>
        </div>
      @endif
    </div>
  </div>
</main>
<script src="{{ asset('js/teamCarousel.js') }}"></script>
@include('includes._footer')