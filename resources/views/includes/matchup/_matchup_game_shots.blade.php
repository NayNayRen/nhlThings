<li>
  @if ($shots['periodDescriptor']['number'] === 1)
    <p>{{ $shots['away'] }}</p>
    <p>1st Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['periodDescriptor']['number'] === 2)
    <p>{{ $shots['away'] }}</p>
    <p>2nd Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['periodDescriptor']['number'] === 3)
    <p>{{ $shots['away'] }}</p>
    <p>3rd Period</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['periodDescriptor']['number'] === 4)
    <p>{{ $shots['away'] }}</p>
    <p>OT</p>
    <p>{{ $shots['home'] }}</p>
  @endif
  @if ($shots['periodDescriptor']['number'] >= 5)
    <p></p>
  @endif
</li>
