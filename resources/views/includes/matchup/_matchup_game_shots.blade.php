<li>
  @if ($shots['period'] === 1)
    <p>{{ $shots['away'] }}</p>
    <p>{{ $shots['period'] }}st Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['period'] === 2)
    <p>{{ $shots['away'] }}</p>
    <p>{{ $shots['period'] }}nd Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['period'] === 3)
    <p>{{ $shots['away'] }}</p>
    <p>{{ $shots['period'] }}rd Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['period'] === 4)
    <p>{{ $shots['away'] }}</p>
    <p>OT</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['period'] >= 5)
    <p></p>
  @endif
</li>
