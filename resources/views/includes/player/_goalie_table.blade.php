@php
  $firstHalfSeason = [];
  $secondHalfSeason = [];
  $season = (string) $stat['season'];
  $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
  $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
@endphp
<p title="Season">
  <span>{{ $key + 1 }}.</span>
  <span>
    {{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}
  </span>
</p>
<p>{{ $stat['teamName']['default'] }}</p>
<p>{{ $stat['gamesPlayed'] }}</p>
<p>{{ $stat['gamesStarted'] }}</p>
<p class='table-column-focus'>{{ $stat['wins'] }}</p>
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
