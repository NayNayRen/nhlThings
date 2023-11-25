<div class="game-date-location">
  <p class='game-date'> {{ $formattedGameDate }}
  </p>
  <p class='game-time'>{{ $formattedGameTime }} EST</p>
  <p class="game-location">{{ $game['venue']['default'] }}</p>
</div>
{{-- AWAY TEAM --}}
<div class="game-team-container">
  <p>Away :</p>
  @foreach ($allTeams as $team)
    @if ($game['awayTeam']['abbrev'] === $team['teamAbbrev']['default'])
      <p class='game-team-name'>
        {{ $team['teamName']['default'] }}
        <span class="game-team-logo">
          <img src={{ $game['awayTeam']['logo'] }} alt='{{ $team['teamName']['default'] }}' width="100" height="100">
        </span>
      </p>
      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
      </p>
    @endif
  @endforeach
</div>
{{-- HOME TEAM --}}
<div class="game-team-container">
  <p>Home :</p>
  @foreach ($allTeams as $team)
    @if ($game['homeTeam']['abbrev'] === $team['teamAbbrev']['default'])
      <p class='game-team-name'>
        {{ $team['teamName']['default'] }}
        <span class="game-team-logo">
          <img src={{ $game['homeTeam']['logo'] }} alt='{{ $team['teamName']['default'] }}' width="100"
            height="100">
        </span>
      </p>
      <p class='game-team-record'>{{ $team['wins'] }}-{{ $team['losses'] }}-{{ $team['otLosses'] }}
      </p>
    @endif
  @endforeach
</div>
{{-- GAME BROADCASTS --}}
<p class="game-broadcast">
  @if (count($game['tvBroadcasts']) < 1)
    <span>Watch :</span>
    <span>Check Listings</span>
  @else
    <span>Watch :</span>
    @foreach ($game['tvBroadcasts'] as $tvBroadcast)
      <span>{{ $tvBroadcast['network'] }}</span>
    @endforeach
  @endif
</p>
