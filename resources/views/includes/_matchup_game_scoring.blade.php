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
