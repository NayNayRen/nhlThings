<li class="league-standings-row">
  <p><span>{{ $key + 1 }}.</span>{{ $team['teamName']['default'] }}</p>
  <p>{{ $team['gamesPlayed'] }}</p>
  <p>{{ $team['wins'] }}</p>
  <p>{{ $team['losses'] }}</p>
  <p>{{ $team['otLosses'] }}</p>
  <p>{{ $team['regulationWins'] }}</p>
  <p>{{ $team['shootoutWins'] }}</p>
  <p>{{ $team['shootoutLosses'] }}</p>
  <p class='league-standings-points'>{{ $team['points'] }}</p>
  <p>{{ round((float) $team['pointPctg'] * 100, 1) }}%</p>
  <p>{{ $team['goalFor'] }}</p>
  <p>{{ $team['goalAgainst'] }}</p>
</li>
