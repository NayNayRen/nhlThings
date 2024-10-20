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
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">FINAL</h3>
            @if ($gameBoxscores['gameOutcome']['lastPeriodType'] === 'SO')
              <p class="game-matchup-heading-clock">SO</p>
            @elseif ($gameBoxscores['gameOutcome']['lastPeriodType'] === 'OT')
              <p class="game-matchup-heading-clock">OT</p>
            @elseif ($gameBoxscores['gameOutcome']['lastPeriodType'] === 'REG')
              <p class="game-matchup-heading-clock">REG</p>
            @endif
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="team-lineup-away-button-container">
            <button type="button" class="team-lineup-away-button">
              <span>A</span>
              <span>w</span>
              <span>a</span>
              <span>y</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-away-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Away Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            {{-- <h4>
              Away HC :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['awayTeam']['headCoach']['default'] }}
              </span>
            </h4> --}}
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['awayTeam']['forwards'] as $key => $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['awayTeam']['defense'] as $key => $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves / Shots">Sv/S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['awayTeam']['goalies'] as $key => $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

          <div class="team-lineup-home-button-container">
            <button type="button" class="team-lineup-home-button">
              <span>H</span>
              <span>o</span>
              <span>m</span>
              <span>e</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-home-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Home Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            {{-- <h4>
              Home HC :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['homeTeam']['headCoach']['default'] }}
              </span>
            </h4> --}}
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['homeTeam']['forwards'] as $key => $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['homeTeam']['defense'] as $key => $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves / Shots">Sv/S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['playerByGameStats']['homeTeam']['goalies'] as $key => $goalie)
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
              @if (count($gameMatchup['summary']['threeStars']) > 0)
                <span>
                  {{ $gameMatchup['summary']['threeStars'][0]['name'] }}
                  {{ '(' . $gameMatchup['summary']['threeStars'][0]['teamAbbrev'] . ')' }}
                </span>
              @else
                <span>Soon...</span>
              @endif
            </p>
            <p>
              <span aria-label="Game Second Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              @if (count($gameMatchup['summary']['threeStars']) > 0)
                <span>
                  {{ $gameMatchup['summary']['threeStars'][1]['name'] }}
                  {{ '(' . $gameMatchup['summary']['threeStars'][1]['teamAbbrev'] . ')' }}
                </span>
              @else
                <span>Soon...</span>
              @endif
            </p>
            <p>
              <span aria-label="Game Third Star">
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
                <i class="fa-solid fa-star" aria-hidden="true"></i>
              </span>
              @if (count($gameMatchup['summary']['threeStars']) > 0)
                <span>
                  {{ $gameMatchup['summary']['threeStars'][2]['name'] }}
                  {{ '(' . $gameMatchup['summary']['threeStars'][2]['teamAbbrev'] . ')' }}
                </span>
              @else
                <span>Soon...</span>
              @endif
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
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
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
                  @if ($period['periodDescriptor']['number'] >= 5)
                    <h3 class="game-matchup-heading-live-period">SO</h3>
                  @elseif ($period['periodDescriptor']['number'] === 4)
                    <h3 class="game-matchup-heading-live-period">OT</h3>
                  @elseif ($period['periodDescriptor']['number'] === 3)
                    <h3 class="game-matchup-heading-live-period">3rd</h3>
                  @elseif ($period['periodDescriptor']['number'] === 2)
                    <h3 class="game-matchup-heading-live-period">2nd</h3>
                  @elseif ($period['periodDescriptor']['number'] === 1)
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
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <div class="team-lineup-away-button-container">
            <button type="button" class="team-lineup-away-button">
              <span>A</span>
              <span>w</span>
              <span>a</span>
              <span>y</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-away-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Away Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            <h4>
              Away HC :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['awayTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['forwards'] as $key => $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>

              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['defense'] as $key => $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves / Shots">Sv/S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['awayTeam']['goalies'] as $key => $goalie)
                  @include('includes.matchup._matchup_game_goalie')
                @endforeach
              </ul>
            </div>
          </div>

          <div class="team-lineup-home-button-container">
            <button type="button" class="team-lineup-home-button">
              <span>H</span>
              <span>o</span>
              <span>m</span>
              <span>e</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-home-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Home Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            <h4>
              Home HC :
              <span>
                {{ $gameBoxscores['boxscore']['gameInfo']['homeTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              {{-- forwards --}}
              <ul class="team-lineup-forwards">
                <li>
                  <h3 title="Forwards">Forwards</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['forwards'] as $key => $forward)
                  @include('includes.matchup._matchup_game_forward')
                @endforeach
              </ul>
              {{-- defense --}}
              <ul class="team-lineup-defense">
                <li>
                  <h3 title="Defense">Defense</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals">G</h3>
                  <h3 title="Assists">A</h3>
                  <h3 title="Points">P</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Hits">H</h3>
                  <h3 title="Plus Minus">+/-</h3>
                  <h3 title="Shots">S</h3>
                  <h3 title="Faceoff %">FO %</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['defense'] as $key => $defender)
                  @include('includes.matchup._matchup_game_defender')
                @endforeach
              </ul>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Goals Allowed">GA</h3>
                  <h3 title="Even Strength Shots">ESS</h3>
                  <h3 title="Power Play Shots">PPS</h3>
                  <h3 title="Short Handedy Shots">SHS</h3>
                  <h3 title="Saves / Shots">Sv/S</h3>
                  <h3 title="Even Strength Goals">ESG</h3>
                  <h3 title="Power Play Goals">PPG</h3>
                  <h3 title="Short Handedy Goals">SHG</h3>
                  <h3 title="Penalty Minutes">PIM</h3>
                  <h3 title="Time on Ice">TOI</h3>
                </li>
                @foreach ($gameBoxscores['boxscore']['playerByGameStats']['homeTeam']['goalies'] as $key => $goalie)
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
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">{{ $formattedGameTime }} EST</h3>
            <p class="game-matchup-heading-clock">Head to Head</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-right">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <span
                  class="game-matchup-team-record">{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['ties'] }}</span>
              @endif
            @endforeach
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          {{-- away team dropdown --}}
          <div class="team-lineup-away-button-container">
            <button type="button" class="team-lineup-away-button">
              <span>A</span>
              <span>w</span>
              <span>a</span>
              <span>y</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-away-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Away Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            <h4>
              Away HC :
              <span>
                {{ $gameMatchup['matchup']['gameInfo']['awayTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              <h4>Goalie Comparison</h4>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Games Played">GP</h3>
                  <h3 title="Record">Rec</h3>
                  <h3 title="Goals Against Average">GAA</h3>
                  <h3 title="Save %">Sv%</h3>
                  <h3 title="Shutouts">SO</h3>
                </li>
                @foreach ($gameMatchup['matchup']['goalieComparison']['awayTeam'] as $key => $goalie)
                  @if (array_key_exists('gamesPlayed', $goalie))
                    <li>
                      <p>
                        <span>{{ $key + 1 }}.</span>
                        <a href="{{ route('players.player', $goalie['playerId']) }}" target="_blank">
                          {{ $goalie['name']['default'] }}
                        </a>
                      </p>
                      <p>#{{ $goalie['sweaterNumber'] }}</p>
                      <p>{{ $goalie['gamesPlayed'] }}</p>
                      <p>{{ $goalie['record'] }}</p>
                      <p>{{ $goalie['gaa'] }}</p>
                      <p>{{ $goalie['savePctg'] }}%</p>
                      <p>{{ $goalie['shutouts'] }}</p>
                    </li>
                  @endif
                @endforeach
              </ul>
              <h4>Scratches</h4>
              <ul>
                @if (count($gameMatchup['matchup']['gameInfo']['awayTeam']['scratches']) > 0)
                  @foreach ($gameMatchup['matchup']['gameInfo']['awayTeam']['scratches'] as $scratchedPlayer)
                    <li>
                      <p>
                        <a href="{{ route('players.player', $scratchedPlayer['id']) }}" target="_blank">
                          {{ $scratchedPlayer['firstName']['default'] }} {{ $scratchedPlayer['lastName']['default'] }}
                        </a>
                      </p>
                    </li>
                  @endforeach
                  <li>
                    <p>
                      Full lineup not announced yet...
                    </p>
                  </li>
                @else
                  <li>
                    <p>
                      No scratches...
                    </p>
                  </li>
                  <li>
                    <p>
                      Full lineup not announced yet...
                    </p>
                  </li>
                @endif
              </ul>
            </div>
          </div>
          {{-- home team dropdown --}}
          <div class="team-lineup-home-button-container">
            <button type="button" class="team-lineup-home-button">
              <span>H</span>
              <span>o</span>
              <span>m</span>
              <span>e</span>
              <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            </button>
          </div>
          <div class="team-lineup-home-container">
            @foreach ($allTeams as $team)
              @if ($gameMatchup['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
                <h4>
                  Home Team :
                  <span>
                    {{ $team['teamName']['default'] }}
                  </span>
                </h4>
              @endif
            @endforeach
            <h4>
              Home HC :
              <span>
                {{ $gameMatchup['matchup']['gameInfo']['homeTeam']['headCoach']['default'] }}
              </span>
            </h4>
            <div class="team-lineup-scrolling-container">
              <h4>Goalie Comparison</h4>
              {{-- goalies --}}
              <ul class="team-lineup-goalies">
                <li>
                  <h3 title="Goalies">Goalies</h3>
                  <h3 title="Sweater Number">Num</h3>
                  <h3 title="Games Played">GP</h3>
                  <h3 title="Record">Rec</h3>
                  <h3 title="Goals Against Average">GAA</h3>
                  <h3 title="Save %">Sv%</h3>
                  <h3 title="Shutouts">SO</h3>
                </li>
                @foreach ($gameMatchup['matchup']['goalieComparison']['homeTeam'] as $key => $goalie)
                  @if (array_key_exists('gamesPlayed', $goalie))
                    <li>
                      <p>
                        <span>{{ $key + 1 }}.</span>
                        <a href="{{ route('players.player', $goalie['playerId']) }}" target="_blank">
                          {{ $goalie['name']['default'] }}
                        </a>
                      </p>
                      <p>#{{ $goalie['sweaterNumber'] }}</p>
                      <p>{{ $goalie['gamesPlayed'] }}</p>
                      <p>{{ $goalie['record'] }}</p>
                      <p>{{ $goalie['gaa'] }}</p>
                      <p>{{ $goalie['savePctg'] }}%</p>
                      <p>{{ $goalie['shutouts'] }}</p>
                    </li>
                  @endif
                @endforeach
              </ul>
              <h4>Scratches</h4>
              <ul>
                @if (count($gameMatchup['matchup']['gameInfo']['homeTeam']['scratches']) > 0)
                  @foreach ($gameMatchup['matchup']['gameInfo']['homeTeam']['scratches'] as $scratchedPlayer)
                    <li>
                      <p>
                        <a href="{{ route('players.player', $scratchedPlayer['id']) }}" target="_blank">
                          {{ $scratchedPlayer['firstName']['default'] }} {{ $scratchedPlayer['lastName']['default'] }}
                        </a>
                      </p>
                    </li>
                  @endforeach
                  <li>
                    <p>
                      Full lineup not announced yet...
                    </p>
                  </li>
                @else
                  <li>
                    <p>
                      No scratches...
                    </p>
                  </li>
                  <li>
                    <p>
                      Full lineup not announced yet...
                    </p>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Last 5 Games</h3>
          <ul class="game-matchup-main-container-team-leaders">
            <li>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][0]['awayLeader']['value'] }}</p>
                <p>Points</p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][0]['homeLeader']['value'] }}</p>
              </div>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][0]['awayLeader']['name']['default'] }}</p>
                <p></p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][0]['homeLeader']['name']['default'] }}</p>
              </div>
            </li>
            <li>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][1]['awayLeader']['value'] }}</p>
                <p>Goals</p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][1]['homeLeader']['value'] }}</p>
              </div>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][1]['awayLeader']['name']['default'] }}</p>
                <p></p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][1]['homeLeader']['name']['default'] }}</p>
              </div>
            </li>
            <li>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][2]['awayLeader']['value'] }}</p>
                <p>Assists</p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][2]['homeLeader']['value'] }}</p>
              </div>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][2]['awayLeader']['name']['default'] }}</p>
                <p></p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][2]['homeLeader']['name']['default'] }}</p>
              </div>
            </li>
            <li>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][3]['awayLeader']['value'] }}</p>
                <p>+ / -</p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][3]['homeLeader']['value'] }}</p>
              </div>
              <div>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][3]['awayLeader']['name']['default'] }}</p>
                <p></p>
                <p>{{ $gameMatchup['matchup']['teamLeadersL5'][3]['homeLeader']['name']['default'] }}</p>
              </div>
            </li>
          </ul>
          <h3>Last 10 Games</h3>
          <div class="game-matchup-main-last-ten-games">
            <div class="game-matchup-away-last-ten">
              <ul class="team-last-ten-record">
                <li>
                  <p>
                    Record : {{ $gameMatchup['matchup']['last10Record']['awayTeam']['record'] }}
                  </p>
                  <p>
                    Streak : {{ $gameMatchup['matchup']['last10Record']['awayTeam']['streakType'] }} -
                    {{ $gameMatchup['matchup']['last10Record']['awayTeam']['streak'] }}
                  </p>
                </li>
              </ul>
              <ul class="team-last-ten-results">
                <li>
                  <h3 title="Team">Team</h3>
                  <h3 title="Results">Results</h3>
                </li>
                {{--  --}}
                @foreach ($gameMatchup['matchup']['last10Record']['awayTeam']['pastGameResults'] as $key => $results)
                  <li>
                    <p>
                      <span>{{ $key + 1 }}.</span>
                      {{ $results['opponentAbbrev'] }}
                    </p>
                    <p>{{ $results['gameResult'] }}</p>
                  </li>
                @endforeach
                {{--  --}}
              </ul>
            </div>
            <div class="game-matchup-home-last-ten">
              <ul class="team-last-ten-record">
                <li>
                  <p>
                    Record : {{ $gameMatchup['matchup']['last10Record']['homeTeam']['record'] }}
                  </p>
                  <p>
                    Streak : {{ $gameMatchup['matchup']['last10Record']['homeTeam']['streakType'] }} -
                    {{ $gameMatchup['matchup']['last10Record']['homeTeam']['streak'] }}
                  </p>
                </li>
              </ul>
              <ul class="team-last-ten-results">
                <li>
                  <h3 title="Team">Team</h3>
                  <h3 title="Results">Results</h3>
                </li>
                {{--  --}}
                @foreach ($gameMatchup['matchup']['last10Record']['homeTeam']['pastGameResults'] as $key => $results)
                  <li>
                    <p>
                      <span>{{ $key + 1 }}.</span>
                      {{ $results['opponentAbbrev'] }}
                    </p>
                    <p>{{ $results['gameResult'] }}</p>
                  </li>
                @endforeach
                {{--  --}}
              </ul>
            </div>
          </div>

          <h3>Officials</h3>
          <div class="horizontal-scrolling-container">
            <ul class="officials-container">
              @foreach ($gameMatchup['matchup']['gameInfo']['referees'] as $referee)
                <li>
                  <h3>Referee</h3>
                  <p>{{ $referee['default'] }}</p>
                </li>
              @endforeach
              @foreach ($gameMatchup['matchup']['gameInfo']['linesmen'] as $linesman)
                <li>
                  <h3>Linesman</h3>
                  <p>{{ $linesman['default'] }}</p>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
      {{-- used to highlight game winner --}}
      <div class="game-state" hidden>{{ $gameMatchup['gameState'] }}</div>
    </div>
  </div>
</main>
<script src="{{ asset('js/gameScript.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
  integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@include('includes._footer')
