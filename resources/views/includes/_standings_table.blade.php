<li class="league-standings-row">
  <p><span>{{ $key + 1 }}.</span>{{ $team['teamName']['default'] }}</p>
  <p>{{ $team['gamesPlayed'] }}</p>
  <p class='table-column-focus'>{{ $team['wins'] }}</p>
  <p>{{ $team['losses'] }}</p>
  <p>{{ $team['regulationWins'] }}</p>
  <p>{{ $team['otLosses'] }}</p>
  <p>{{ $team['shootoutWins'] }}</p>
  <p>{{ $team['shootoutLosses'] }}</p>
  <p class='table-column-focus'>{{ $team['points'] }}</p>
  <p>{{ round((float) $team['pointPctg'] * 100, 1) }}%</p>
  <p>{{ $team['goalFor'] }}</p>
  <p>{{ $team['goalAgainst'] }}</p>
</li>
