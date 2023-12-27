<h3>Officials</h3>
<div class="horizontal-scrolling-container">
  <ul class="officials-container">
    @foreach ($gameBoxscores['boxscore']['gameInfo']['referees'] as $referee)
      <li>
        <h3>Referee</h3>
        <p>{{ $referee['default'] }}</p>
      </li>
    @endforeach
    @foreach ($gameBoxscores['boxscore']['gameInfo']['linesmen'] as $linesman)
      <li>
        <h3>Linesman</h3>
        <p>{{ $linesman['default'] }}</p>
      </li>
    @endforeach
  </ul>
</div>
