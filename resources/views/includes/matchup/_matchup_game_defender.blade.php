<li>
  @php
    $formattedFaceoff = round((float) $defender['faceoffWinningPctg'] * 100);
  @endphp
  <p>
    <span>{{ $key + 1 }}.</span>
    <a href="{{ route('players.player', $defender['playerId']) }}" target="_blank">
      {{ $defender['name']['default'] }}
    </a>
  </p>
  <p>#{{ $defender['sweaterNumber'] }}</p>
  <p>{{ $defender['goals'] }}</p>
  <p>{{ $defender['assists'] }}</p>
  <p>{{ $defender['points'] }}</p>
  <p>{{ $defender['pim'] }}</p>
  <p>{{ $defender['hits'] }}</p>
  <p>{{ $defender['plusMinus'] }}</p>
  <p>{{ $defender['shots'] }}</p>
  <p>{{ $formattedFaceoff }}%</p>
  @if (array_key_exists('toi', $defender))
    <p>{{ $defender['toi'] }}</p>
  @else
    <p>No Data</p>
  @endif
</li>
