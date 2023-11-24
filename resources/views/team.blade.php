@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="league-schedule-container">
      <div class="league-schedule-heading-container">
        <h2 class="main-header-name">{{ $team['teamName']['default'] }}</h2>
        <div class="main-header-logo">
          <img src={{ $team['teamLogo'] }} alt="{{ $team['teamName']['default'] }} Logo" width="100" height="100">
        </div>
      </div>
      @if (count($teamSchedule) < 1)
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
            @for ($i = 0; $i < count($teamSchedule); $i++)
              @php
                $gameDateTime = Carbon\Carbon::create($teamSchedule[$i]['startTimeUTC'])->tz('America/New_York');
                $formattedGameDate = $gameDateTime->toFormattedDateString();
                $formattedGameTime = $gameDateTime->format('h:i A');
              @endphp
              {{-- GAME CARDS --}}
              <li class="league-game-card">
                <div class="game-date-location">
                  <p class='game-date'> {{ $formattedGameDate }}
                  </p>
                  <p class='game-time'>{{ $formattedGameTime }} EST</p>
                  <p class="game-location">{{ $teamSchedule[$i]['venue']['default'] }}</p>
                </div>
                {{-- AWAY TEAM --}}
                <div class="game-team-container">
                  <p>Away :</p>
                  <p class='game-team-name'>
                    {{ $teamSchedule[$i]['awayTeam']['placeName']['default'] }}
                    <span class="game-team-logo">
                      <img src={{ $teamSchedule[$i]['awayTeam']['logo'] }}
                        alt={{ $teamSchedule[$i]['awayTeam']['placeName']['default'] }} width="100" height="100">
                    </span>
                  </p>
                  @foreach ($allTeams as $team)
                    @if ($teamSchedule[$i]['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
                      </p>
                    @endif
                  @endforeach
                </div>
                {{-- HOME TEAM --}}
                <div class="game-team-container">
                  <p>Home :</p>
                  <p class='game-team-name'>
                    {{ $teamSchedule[$i]['homeTeam']['placeName']['default'] }}
                    <span class="game-team-logo home-team-logo">
                      <img src={{ $teamSchedule[$i]['homeTeam']['logo'] }}
                        alt={{ $teamSchedule[$i]['homeTeam']['placeName']['default'] }} width="100" height="100">
                    </span>
                  </p>
                  @foreach ($allTeams as $team)
                    @if ($teamSchedule[$i]['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
                      </p>
                    @endif
                  @endforeach
                </div>
                {{-- GAME BROADCASTS --}}
                <p class="game-broadcast">
                  @if (count($teamSchedule[$i]['tvBroadcasts']) < 1)
                    <span>Watch :</span>
                    <span>Check Listings</span>
                  @else
                    <span>Watch :</span>
                    @foreach ($teamSchedule[$i]['tvBroadcasts'] as $tvBroadcast)
                      <span>{{ $tvBroadcast['network'] }}</span>
                    @endforeach
                  @endif
                </p>
                <span class='game-number'>{{ $i + 1 }} of
                  {{ count($teamSchedule) }}</span>
                <span class="game-home-team-indicator"></span>
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
