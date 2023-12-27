@include('includes._header')
<main class="main"
  style="background-image: -webkit-gradient(
  linear,
  left top,
  right top,
  from(rgba(0, 0, 0, 0.9)),
  to(rgba(0, 0, 0, 0.5))
),
url('{{ asset('img/nhl-logo.webp') }}');
background-image: linear-gradient(
  90deg,
  rgba(0, 0, 0, 0.9),
  rgba(0, 0, 0, 0.5)
),
url('{{ asset('img/nhl-logo.webp') }}'); background-size: contain; background-position: center;">
  <div class="main-container"
    style="background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(245, 245, 245, 1)),
    to(rgba(245, 245, 245, 0.75))
),
url('{{ asset('img/nhl-logo.webp') }}');
background-image: linear-gradient(
    90deg,
    rgba(245, 245, 245, 1),
    rgba(245, 245, 245, 0.75)
),
url('{{ asset('img/nhl-logo.webp') }}'); background-size: contain; background-position: center;">
    <div class="game-matchup-container game-matchup-scroll-point">
      {{-- FINISHED GAME --}}
      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">FINAL</h3>
            <p class="game-matchup-heading-clock">00:00</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <div class="team-lineup-away-button-container">
            <button type="button" class="team-lineup-away-button">
              <span>L</span>
              <span>i</span>
              <span>n</span>
              <span>e</span>
              <span>u</span>
              <span>p</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-away-container">
            <h4>Head Coach :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['awayTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['forwards'] as $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['defense'] as $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves - Shots">Sv-S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['goalies'] as $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

          <div class="team-lineup-home-button-container">
            <button type="button" class="team-lineup-home-button">
              <span>L</span>
              <span>i</span>
              <span>n</span>
              <span>e</span>
              <span>u</span>
              <span>p</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-home-container">
            <h4>Head Coach :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['homeTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['forwards'] as $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['defense'] as $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves - Shots">Sv-S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['goalies'] as $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          {{-- three stars --}}
          <h3>Three Stars</h3>
          <div class="game-matchup-main-container-three-stars">
            <p>
              <span aria-label="Game First Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][0]['name'] }}
                {{ '(' . $gameMatchup['summary']['threeStars'][0]['teamAbbrev'] . ')' }}
              </span>
            </p>
            <p>
              <span aria-label="Game Second Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][1]['name'] }}
                {{ '(' . $gameMatchup['summary']['threeStars'][1]['teamAbbrev'] . ')' }}
              </span>
            </p>
            <p>
              <span aria-label="Game Third Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              <span>
                {{ $gameMatchup['summary']['threeStars'][2]['name'] }}
                {{ '(' . $gameMatchup['summary']['threeStars'][2]['teamAbbrev'] . ')' }}
              </span>
            </p>
          </div>
          <h3>Final Numbers</h3>

          {{-- scoring summary --}}
          @include('includes.matchup._matchup_game_scoring')

          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              @include('includes.matchup._matchup_game_shots')
            @endforeach
          </ul>

          {{-- matchup stats --}}
          @include('includes.matchup._matchup_game_stats')

          {{-- penalties --}}
          @include('includes.matchup._matchup_game_penalties')

          {{-- officials --}}
          @include('includes.matchup._matchup_game_officials')

        </div>
      @endif
      {{-- LIVE GAME --}}
      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <div class="game-matchup-periods">
              @if ($gameMatchup['clock']['inIntermission'] === true)
                <h3 class="game-matchup-heading-live-period">INT</h3>
                <p class="game-matchup-heading-clock">{{ $gameMatchup['clock']['timeRemaining'] }}</p>
              @else
                @foreach ($gameMatchup['summary']['linescore']['byPeriod'] as $period)
                  @if ($period['period'] >= 5)
                    <h3 class="game-matchup-heading-live-period">SO</h3>
                  @elseif ($period['period'] === 4)
                    <h3 class="game-matchup-heading-live-period">OT</h3>
                  @elseif ($period['period'] === 3)
                    <h3 class="game-matchup-heading-live-period">3rd</h3>
                  @elseif ($period['period'] === 2)
                    <h3 class="game-matchup-heading-live-period">2nd</h3>
                  @elseif ($period['period'] === 1)
                    <h3 class="game-matchup-heading-live-period">1st</h3>
                  @endif
                @endforeach
                <p class="game-matchup-heading-clock">{{ $gameMatchup['clock']['timeRemaining'] }}</p>
              @endif
            </div>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <div class="team-lineup-away-button-container">
            <button type="button" class="team-lineup-away-button">
              <span>L</span>
              <span>i</span>
              <span>n</span>
              <span>e</span>
              <span>u</span>
              <span>p</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-away-container">
            <h4>Head Coach :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['awayTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['forwards'] as $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>

              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['defense'] as $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves - Shots">Sv-S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['goalies'] as $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

          <div class="team-lineup-home-button-container">
            <button type="button" class="team-lineup-home-button">
              <span>L</span>
              <span>i</span>
              <span>n</span>
              <span>e</span>
              <span>u</span>
              <span>p</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-home-container">
            <h4>Head Coach :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['homeTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['forwards'] as $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Blocked Shots">B Shots</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoffs">FO</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['defense'] as $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves - Shots">Sv-S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['goalies'] as $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Live Stats</h3>

          {{-- scoring Summary --}}
          @include('includes.matchup._matchup_game_scoring')

          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              @include('includes.matchup._matchup_game_shots')
            @endforeach
          </ul>

          {{-- matchup stats --}}
          @include('includes.matchup._matchup_game_stats')

          {{-- penalties --}}
          @include('includes.matchup._matchup_game_penalties')

          {{-- officials --}}
          @include('includes.matchup._matchup_game_officials')

        </div>
      @endif
      {{-- PREGAME HEAD TO HEAD --}}
      @if ($gameMatchup['gameState'] === 'PRE')
        <div class="game-matchup-heading-container sticky-heading">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <span class="game-matchup-team-indicator">Away</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">{{ $formattedGameTime }} EST</h3>
            <p class="game-matchup-heading-clock">Stats Leaders</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-right">
            <span class="game-matchup-team-indicator">Home</span>
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
          </div>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Head to Head</h3>
        </div>
      @endif
      {{-- used to highlight game winner --}}
      <div class="game-state" hidden>{{ $gameMatchup['gameState'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/gameScript.js') }}"></script>
@include('includes._footer')
