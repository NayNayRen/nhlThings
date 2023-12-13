@php
  $firstHalfSeason = [];
  $secondHalfSeason = [];
  $season = (string) $stat['season'];
  $firstHalfSeason[] = $season[0] . $season[1] . $season[2] . $season[3];
  $secondHalfSeason[] = $season[4] . $season[5] . $season[6] . $season[7];
@endphp
<li>
  <p title="Season">
    <span>{{ $key + 1 }}.</span>{{ $firstHalfSeason[0] }}/{{ $secondHalfSeason[0] }}
  </p>
  <p>{{ $stat['teamName']['default'] }}</p>
  <p>{{ $stat['gamesPlayed'] }}</p>
  <p>{{ $stat['goals'] }}</p>
  <p>{{ $stat['assists'] }}</p>
  <p>{{ $stat['points'] }}</p>
  <p>{{ $stat['plusMinus'] }}</p>
  <p>{{ $stat['pim'] }}</p>
  <p>{{ $stat['powerPlayGoals'] }}</p>
  <p>{{ $stat['powerPlayPoints'] }}</p>
  <p>{{ $stat['shorthandedGoals'] }}</p>
  <p>{{ $stat['gameWinningGoals'] }}</p>
  <p>{{ $stat['otGoals'] }}</p>
  <p>{{ $stat['shots'] }}</p>
  <p>
    {{ round((float) $stat['shootingPctg'] * 100, 2) }}%
  </p>
  <p>{{ $stat['avgToi'] }}</p>
  <p>
    {{ round((float) $stat['faceoffWinningPctg'] * 100, 2) }}%
  </p>
</li>
