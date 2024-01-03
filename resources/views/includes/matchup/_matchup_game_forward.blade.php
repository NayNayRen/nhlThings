<li>
  <p>
    <span>{{ $key + 1 }}.</span>
    <a href="{{ route('players.player', $forward['playerId']) }}" target="_blank">
      {{ $forward['name']['default'] }}
    </a>
  </p>
  <p>#{{ $forward['sweaterNumber'] }}</p>
  <p>{{ $forward['goals'] }}</p>
  <p>{{ $forward['assists'] }}</p>
  <p>{{ $forward['points'] }}</p>
  <p>{{ $forward['pim'] }}</p>
  <p>{{ $forward['hits'] }}</p>
  <p>{{ $forward['blockedShots'] }}</p>
  <p>{{ $forward['shots'] }}</p>
  <p>{{ $forward['faceoffs'] }}</p>
  @if (array_key_exists('toi', $forward))
    <p>{{ $forward['toi'] }}</p>
  @else
    <p>No Data</p>
  @endif
</li>
