<li>
  @php
    $formattedFaceoff = round((float) $forward['faceoffWinningPctg'] * 100);
  @endphp
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
  <p>{{ $forward['plusMinus'] }}</p>
  <p>{{ $forward['sog'] }}</p>
  <p>{{ $formattedFaceoff }}%</p>
  @if (array_key_exists('toi', $forward))
    <p>{{ $forward['toi'] }}</p>
  @else
    <p>No Data</p>
  @endif
</li>
