@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="game-matchup-container">
      {{-- FINISHED GAME --}}
      @if ($gameMatchup['gameState'] === 'OFF' || $gameMatchup['gameState'] === 'FINAL')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
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
            <p class="game-matchup-heading-clock">00:00</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
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
          {{-- goals --}}
          <ul class="game-matchup-main-container-goals">
            <li>
              <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
              <p>Goals</p>
              <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['linescore']['byPeriod'] as $goals)
              <li>
                <p>{{ $goals['away'] }}</p>
                @if ($goals['period'] === 1)
                  <p>{{ $goals['period'] }}st Period</p>
                @endif
                @if ($goals['period'] === 2)
                  <p>{{ $goals['period'] }}nd Period</p>
                @endif
                @if ($goals['period'] === 3)
                  <p>{{ $goals['period'] }}rd Period</p>
                @endif
                @if ($goals['period'] === 4)
                  <p>OT</p>
                @endif
                @if ($goals['period'] >= 5)
                  <p>SO</p>
                @endif
                <p>{{ $goals['home'] }}</p>
              </li>
            @endforeach
          </ul>
          @if ($gameMatchup['awayTeam']['score'] > 0 || $gameMatchup['homeTeam']['score'] > 0)
            <h3>Scoring Summary</h3>
            {{-- goals scored by --}}
            <ul class="game-matchup-main-container-scored-by-outer">
              <li class="game-matchup-main-container-scored-by">
                @foreach ($gameMatchup['summary']['scoring'] as $scoredBy)
                  @foreach ($scoredBy['goals'] as $tally)
                    <div class="game-matchup-main-container-scored-by-info">
                      <p>
                        <span>
                          {{ $tally['name'] }}
                          {{ '(' . $tally['awayScore'] }} - {{ $tally['homeScore'] . ')' }}
                        </span>
                        <span>
                          {{ $tally['timeInPeriod'] }} in period {{ $scoredBy['period'] }}
                        </span>
                      </p>
                      <div>
                        <img src={{ $tally['headshot'] }} alt="{{ $tally['name'] }}">
                      </div>
                    </div>
                  @endforeach
                @endforeach
              </li>
            </ul>
          @endif
          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              <li>
                @if ($shots['period'] === 1)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}st Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 2)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}nd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 3)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}rd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 4)
                  <p>{{ $shots['away'] }}</p>
                  <p>OT</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] >= 5)
                  <p></p>
                @endif
              </li>
            @endforeach
          </ul>
          {{-- faceoff % --}}
          @if (count($gameMatchup['summary']['teamGameStats'][1]) > 0)
            <ul class="game-matchup-main-container-faceoff">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][1]['awayValue'] }}%</p>
                <p>Faceoff</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][1]['homeValue'] }}%</p>
              </li>
            </ul>
          @endif
          {{-- power play --}}
          @if (count($gameMatchup['summary']['teamGameStats'][2]) > 0)
            <ul class="game-matchup-main-container-pp">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][2]['awayValue'] }}</p>
                <p>P P</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][2]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- penalty in minutes --}}
          @if (count($gameMatchup['summary']['teamGameStats'][3]) > 0)
            <ul class="game-matchup-main-container-pim">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][3]['awayValue'] }}</p>
                <p>P i M</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][3]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- hits --}}
          @if (count($gameMatchup['summary']['teamGameStats'][4]) > 0)
            <ul class="game-matchup-main-container-hits">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][4]['awayValue'] }}</p>
                <p>Hits</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][4]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- blocked shots --}}
          @if (count($gameMatchup['summary']['teamGameStats'][5]) > 0)
            <ul class="game-matchup-main-container-bshots">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][5]['awayValue'] }}</p>
                <p>B Shots</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][5]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- giveaways --}}
          @if (count($gameMatchup['summary']['teamGameStats'][6]) > 0)
            <ul class="game-matchup-main-container-gaways">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][6]['awayValue'] }}</p>
                <p>G Aways</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][6]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- takeaways --}}
          @if (count($gameMatchup['summary']['teamGameStats'][7]) > 0)
            <ul class="game-matchup-main-container-taways">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][7]['awayValue'] }}</p>
                <p>T Aways</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][7]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- penalties --}}
          <ul class="game-matchup-main-container-penalties">
            @if (count($gameMatchup['summary']['penalties']) > 0)
              <h3>Penalties</h3>
              @foreach ($gameMatchup['summary']['penalties'] as $penalty)
                @if ($penalty['period'] === 1)
                  <li>
                    <p>{{ $penalty['period'] }}st Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 2)
                  <li>
                    <p>{{ $penalty['period'] }}nd Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 3)
                  <li>
                    <p>{{ $penalty['period'] }}rd Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 4)
                  <li>
                    <p>OT</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($shots['period'] >= 5)
                  <p></p>
                @endif
              @endforeach
            @endif
          </ul>
        </div>
      @endif
      {{-- LIVE GAME --}}
      @if ($gameMatchup['gameState'] === 'CRIT' || $gameMatchup['gameState'] === 'LIVE')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
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
            </div>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-goals">
            <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
          </div>
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
        </div>
        {{-- matchup stats --}}
        <div class="game-matchup-main-container">
          <p class="game-matchup-main-container-venue">{{ $gameMatchup['venue']['default'] }}</p>
          <h3>Live Stats</h3>
          {{-- goals --}}
          <ul class="game-matchup-main-container-goals">
            <li>
              <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
              <p>Goals</p>
              <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['linescore']['byPeriod'] as $goals)
              <li>
                <p>{{ $goals['away'] }}</p>
                @if ($goals['period'] === 1)
                  <p>{{ $goals['period'] }}st Period</p>
                @endif
                @if ($goals['period'] === 2)
                  <p>{{ $goals['period'] }}nd Period</p>
                @endif
                @if ($goals['period'] === 3)
                  <p>{{ $goals['period'] }}rd Period</p>
                @endif
                @if ($goals['period'] === 4)
                  <p>OT</p>
                @endif
                @if ($goals['period'] >= 5)
                  <p>SO</p>
                @endif
                <p>{{ $goals['home'] }}</p>
              </li>
            @endforeach
          </ul>

          @if ($gameMatchup['awayTeam']['score'] > 0 || $gameMatchup['homeTeam']['score'] > 0)
            <h3>Scoring Summary</h3>
            {{-- goals scored by --}}
            <ul class="game-matchup-main-container-scored-by-outer">
              <li class="game-matchup-main-container-scored-by">
                @foreach ($gameMatchup['summary']['scoring'] as $scoredBy)
                  @foreach ($scoredBy['goals'] as $tally)
                    <div class="game-matchup-main-container-scored-by-info">
                      <p>
                        <span>
                          {{ $tally['name'] }}
                          {{ '(' . $tally['awayScore'] }} - {{ $tally['homeScore'] . ')' }}
                        </span>
                        <span>
                          {{ $tally['timeInPeriod'] }} in period {{ $scoredBy['period'] }}
                        </span>
                      </p>
                      <div>
                        <img src={{ $tally['headshot'] }} alt="{{ $tally['name'] }}">
                      </div>
                    </div>
                  @endforeach
                @endforeach
              </li>
            </ul>
          @endif
          {{-- shots --}}
          <ul class="game-matchup-main-container-shots">
            <li>
              <p>{{ $gameMatchup['awayTeam']['sog'] }}</p>
              <p>Shots</p>
              <p>{{ $gameMatchup['homeTeam']['sog'] }}</p>
            </li>
            @foreach ($gameMatchup['summary']['shotsByPeriod'] as $shots)
              <li>
                @if ($shots['period'] === 1)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}st Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 2)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}nd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 3)
                  <p>{{ $shots['away'] }}</p>
                  <p>{{ $shots['period'] }}rd Period</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] === 4)
                  <p>{{ $shots['away'] }}</p>
                  <p>OT</p>
                  <p>{{ $shots['home'] }}</p>
                @endif
                @if ($shots['period'] >= 5)
                  <p></p>
                @endif
              </li>
            @endforeach
          </ul>
          {{-- faceoff % --}}
          @if (count($gameMatchup['summary']['teamGameStats'][1]) > 0)
            <ul class="game-matchup-main-container-faceoff">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][1]['awayValue'] }}%</p>
                <p>Faceoff</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][1]['homeValue'] }}%</p>
              </li>
            </ul>
          @endif
          {{-- power play --}}
          @if (count($gameMatchup['summary']['teamGameStats'][2]) > 0)
            <ul class="game-matchup-main-container-pp">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][2]['awayValue'] }}</p>
                <p>P P</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][2]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- penalty in minutes --}}
          @if (count($gameMatchup['summary']['teamGameStats'][3]) > 0)
            <ul class="game-matchup-main-container-pim">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][3]['awayValue'] }}</p>
                <p>P i M</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][3]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- hits --}}
          @if (count($gameMatchup['summary']['teamGameStats'][4]) > 0)
            <ul class="game-matchup-main-container-hits">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][4]['awayValue'] }}</p>
                <p>Hits</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][4]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- blocked shots --}}
          @if (count($gameMatchup['summary']['teamGameStats'][5]) > 0)
            <ul class="game-matchup-main-container-bshots">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][5]['awayValue'] }}</p>
                <p>B Shots</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][5]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- giveaways --}}
          @if (count($gameMatchup['summary']['teamGameStats'][6]) > 0)
            <ul class="game-matchup-main-container-gaways">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][6]['awayValue'] }}</p>
                <p>G Aways</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][6]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- takeaways --}}
          @if (count($gameMatchup['summary']['teamGameStats'][7]) > 0)
            <ul class="game-matchup-main-container-taways">
              <li>
                <p>{{ $gameMatchup['summary']['teamGameStats'][7]['awayValue'] }}</p>
                <p>T Aways</p>
                <p>{{ $gameMatchup['summary']['teamGameStats'][7]['homeValue'] }}</p>
              </li>
            </ul>
          @endif
          {{-- penalties --}}
          <ul class="game-matchup-main-container-penalties">
            @if (count($gameMatchup['summary']['penalties']) > 0)
              <h3>Penalties</h3>
              @foreach ($gameMatchup['summary']['penalties'] as $penalty)
                @if ($penalty['period'] === 1)
                  <li>
                    <p>{{ $penalty['period'] }}st Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 2)
                  <li>
                    <p>{{ $penalty['period'] }}nd Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 3)
                  <li>
                    <p>{{ $penalty['period'] }}rd Period</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($penalty['period'] === 4)
                  <li>
                    <p>OT</p>
                  </li>
                  <li>
                    @foreach ($penalty['penalties'] as $infraction)
                      @php
                        $formattedInfraction = explode('-', $infraction['descKey']);
                      @endphp
                      @if (count($formattedInfraction) >= 2)
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }} -
                            {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @else
                        @if (array_key_exists('committedByPlayer', $infraction))
                          <p class="game-matchup-penalty">
                            {{ $infraction['committedByPlayer'] }} -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @else
                          <p class="game-matchup-penalty">
                            Bench Minor -
                            {{ ucwords($formattedInfraction[0]) }} - {{ $infraction['timeInPeriod'] }}
                          </p>
                        @endif
                      @endif
                    @endforeach
                  </li>
                @endif

                @if ($shots['period'] >= 5)
                  <p></p>
                @endif
              @endforeach
            @endif
          </ul>
        </div>
      @endif
      {{-- PREGAME HEAD TO HEAD --}}
      @if ($gameMatchup['gameState'] === 'PRE')
        <div class="game-matchup-heading-container">
          {{-- away team --}}
          <div class="game-matchup-heading-left">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['awayTeam']['logo'] }}
                alt="{{ $gameMatchup['awayTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <p class="game-matchup-heading-date">{{ $formattedGameDate }}</p>
          <div class="game-matchup-heading-center">
            <h3 class="game-matchup-heading-period">{{ $formattedGameTime }} EST</h3>
            <p class="game-matchup-heading-clock">Stats Leaders</p>
          </div>
          {{-- home team --}}
          <div class="game-matchup-heading-right">
            <div class="game-matchup-heading-logo">
              <img src={{ $gameMatchup['homeTeam']['logo'] }}
                alt="{{ $gameMatchup['homeTeam']['name']['default'] }} Logo">
            </div>
          </div>
          <span class="game-matchup-away-team-indicator">Away</span>
          <span class="game-matchup-home-team-indicator">Home</span>
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
