@include('includes._header')
<main class="main">
  <div class="main-container">
    <div class="player-container">
      <div class="player-heading-container">
        <div class="player-heading-left">
          <h2>{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}</h2>
          <div class="player-number-position-container">
            <p class="player-number">{{ $player['sweaterNumber'] }}</p>
            <p class="player-position">{{ $player['position'] }}</p>
          </div>
        </div>
        <div class="player-heading-logo">
          <img src={{ $player['headshot'] }}
            alt="{{ $player['firstName']['default'] }} {{ $player['lastName']['default'] }}" width="100"
            height="100">
        </div>
      </div>
      {{-- player data --}}
      <div class="horizontal-scrolling-container">
        <ul class="player-stats">
          @if ($player['position'] === 'G')
            {{-- goalie stuff --}}
            <li>
              <h3 title="Season">Season</h3>
              <h3 title="Team Rostered">Team</h3>
              <h3 title="Games Played">GP</h3>
              <h3 title="Games Started">GS</h3>
              <h3 title="Wins">W</h3>
              <h3 title="Losses">L</h3>
              <h3 title="Shut Outs">SO</h3>
              <h3 title="Shots Against">SA</h3>
              <h3 title="Saves">SV</h3>
              <h3 title="Save %">SV%</h3>
              <h3 title="Goals Against">GA</h3>
              <h3 title="Goals Against Average %">GAA%</h3>
              <h3 title="Total TOI">TTOI</h3>
              <h3 title="Goals">G</h3>
              <h3 title="Assists">A</h3>
              <h3 title="Penalty Minutes">PIM</h3>
            </li>
            {{-- stats --}}
            @foreach ($proCareer as $key => $stat)
              @php
                $firstHalfSeason = [];
                $secondHalfSeason = [];
                $season = (string) $stat['season'];
                $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
                $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
              @endphp
              <li>
                <p title="Current Season">
                  <span>{{ $key + 1 }}.</span>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}
                </p>
                <p>{{ $stat['teamName']['default'] }}</p>
                <p>{{ $stat['gamesPlayed'] }}</p>
                <p>{{ $stat['gamesStarted'] }}</p>
                <p>{{ $stat['wins'] }}</p>
                <p>{{ $stat['losses'] }}</p>
                <p>{{ $stat['shutouts'] }}</p>
                <p>{{ $stat['shotsAgainst'] }}</p>
                <p>
                  {{ $stat['shotsAgainst'] - $stat['goalsAgainst'] }}
                </p>
                <p>{{ round((float) $stat['savePctg'], 3) }}%
                </p>
                <p>{{ $stat['goalsAgainst'] }}</p>
                <p>
                  {{ round((float) $stat['goalsAgainstAvg'] * 1, 2) }}%
                </p>
                <p>{{ $stat['timeOnIce'] }}</p>
                <p>{{ $stat['goals'] }}</p>
                <p>{{ $stat['assists'] }}</p>
                <p>{{ $stat['pim'] }}</p>
              </li>
            @endforeach
          @else
            {{-- skater stuff --}}
            <li>
              <h3 title="Season">Season</h3>
              <h3 title="Games Played">GP</h3>
              <h3 title="Goals">G</h3>
              <h3 title="Assists">A</h3>
              <h3 title="Points">P</h3>
              <h3 title="Plus Minus">+/-</h3>
              <h3 title="Penalty Minutes">PIM</h3>
              <h3 title="Power Play Goals">PPG</h3>
              <h3 title="Power Play Points">PPP</h3>
              <h3 title="Short Handed Goals">SHG</h3>
              <h3 title="Game Winning Goals">GWG</h3>
              <h3 title="Over Time Goals">OTG</h3>
              <h3 title="Shots">Shots</h3>
              <h3 title="Shot %">Shot%</h3>
              <h3 title="Avg Time on Ice">TOI</h3>
              <h3 title="Faceoff %">FO%</h3>
            </li>
            {{-- stats --}}
            <li>
              <p title="Regular Season">{{ $formattedSeason }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['gamesPlayed'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['goals'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['assists'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['points'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['plusMinus'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['pim'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['powerPlayGoals'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['powerPlayPoints'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['shorthandedGoals'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['gameWinningGoals'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['otGoals'] }}</p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['shots'] }}</p>
              <p>
                {{ round((float) $player['seasonTotals'][count($player['seasonTotals']) - 1]['shootingPctg'] * 100, 2) }}%
              </p>
              <p>{{ $player['seasonTotals'][count($player['seasonTotals']) - 1]['avgToi'] }}</p>
              <p>
                {{ round((float) $player['seasonTotals'][count($player['seasonTotals']) - 1]['faceoffWinningPctg'] * 100, 2) }}%
              </p>
            </li>
          @endif

        </ul>
      </div>
    </div>
  </div>
</main>
@include('includes._footer')
