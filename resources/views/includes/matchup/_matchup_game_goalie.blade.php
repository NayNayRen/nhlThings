<li>
  <p>
    <span>{{ $key + 1 }}.</span>
    <a href="{{ route('players.player', $goalie['playerId']) }}" target="_blank">
      {{ $goalie['name']['default'] }}
    </a>
  </p>
  <p>#{{ $goalie['sweaterNumber'] }}</p>
  <p>{{ $goalie['goalsAgainst'] }}</p>
  <p>{{ $goalie['evenStrengthShotsAgainst'] }}</p>
  <p>{{ $goalie['powerPlayShotsAgainst'] }}</p>
  <p>{{ $goalie['shorthandedShotsAgainst'] }}</p>
  <p>{{ $goalie['saveShotsAgainst'] }}</p>
  <p>{{ $goalie['evenStrengthGoalsAgainst'] }}</p>
  <p>{{ $goalie['powerPlayGoalsAgainst'] }}</p>
  <p>{{ $goalie['shorthandedGoalsAgainst'] }}</p>
  @if (array_key_exists('pim', $goalie))
    <p>{{ $goalie['pim'] }}</p>
  @else
    <p>No Data</p>
  @endif
  @if (array_key_exists('toi', $goalie))
    <p>{{ $goalie['toi'] }}</p>
  @else
    <p>No Data</p>
  @endif
</li>
