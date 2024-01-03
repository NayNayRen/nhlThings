<ul class="player-summary">
  <li>
    <h3>Height</h3>
    <p>{{ $player['heightInInches'] }}"</p>
  </li>
  <li>
    <h3>Weight</h3>
    <p>{{ $player['weightInPounds'] }}lbs.</p>
  </li>
  <li>
    <h3>Number</h3>
    <p>#{{ $player['sweaterNumber'] }}</p>
  </li>
  <li>
    <h3>Position</h3>
    <p>{{ $player['position'] }}</p>
  </li>
  <li>
    <h3>Shoots</h3>
    <p>{{ $player['shootsCatches'] }}</p>
  </li>
  <li>
    <h3>DOB</h3>
    <p>{{ $player['birthDate'] }}</p>
  </li>
  <li>
    <h3>Birthplace</h3>
    <p>{{ $player['birthCity']['default'] }}, {{ $player['birthCountry'] }}</p>
  </li>
</ul>
