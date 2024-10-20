<ul class="game-matchup-main-container-goals">
  <li>
    <p>{{ $gameMatchup['awayTeam']['score'] }}</p>
    <p>Goals</p>
    <p>{{ $gameMatchup['homeTeam']['score'] }}</p>
  </li>
  @foreach ($gameMatchup['summary']['scoring'] as $goals)
    <li>
      @if (count($goals["goals"]) > 0)
        @foreach ($goals["goals"] as $away)
        <p>{{ $away['awayScore'] }}</p>
        @endforeach
      @else
        <p>0</p>
      @endif
      @if ($goals['periodDescriptor']['number'] === 1)
        <p>1st Period</p>
      @endif
      @if ($goals['periodDescriptor']['number'] === 2)
        <p>2nd Period</p>
      @endif
      @if ($goals['periodDescriptor']['number'] === 3)
        <p>3rd Period</p>
      @endif
      @if ($goals['periodDescriptor']['number'] === 4)
        <p>OT</p>
      @endif
      @if ($goals['periodDescriptor']['number'] >= 5)
        <p>SO</p>
      @endif
      @if (count($goals["goals"]) > 0)
        @foreach ($goals["goals"] as $home)
        <p>{{ $home['homeScore'] }}</p>
        @endforeach
      @else
        <p>0</p>
      @endif
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
                <span>
                  {{ $tally['name']['default'] }}
                </span>
                {{ '(' . $tally['awayScore'] }} - {{ $tally['homeScore'] . ')' }}
              </span>
              <span>
                @if ($scoredBy['periodDescriptor']['number'] === 4)
                  {{ $tally['timeInPeriod'] }} of OT
                @elseif($scoredBy['periodDescriptor']['number'] >= 5)
                  SO winner
                @else
                  {{ $tally['timeInPeriod'] }} of period {{ $scoredBy['periodDescriptor']['number'] }}
                @endif
              </span>
            </p>
            <div>
              <img src={{ $tally['headshot'] }} alt="{{ $tally['name']['default'] }}">
            </div>
          </div>
        @endforeach
      @endforeach
    </li>
  </ul>
@endif
