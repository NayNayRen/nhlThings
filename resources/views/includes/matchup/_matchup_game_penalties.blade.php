<ul class="game-matchup-main-container-penalties">
  @if (count($gameMatchup['summary']['penalties']) > 0)
    <h3>Penalties</h3>
    @foreach ($gameMatchup['summary']['penalties'] as $penalty)
      @if ($penalty['periodDescriptor']['number'] === 1)
        <li>
          <p>1st Period</p>
        </li>
        <li>
          @foreach ($penalty['penalties'] as $infraction)
            @php
              $formattedInfraction = explode('-', $infraction['descKey']);
            @endphp
            @if (count($formattedInfraction) >= 2)
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @else
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @endif
          @endforeach
        </li>
      @endif

      @if ($penalty['periodDescriptor']['number'] === 2)
        <li>
          <p>2nd Period</p>
        </li>
        <li>
          @foreach ($penalty['penalties'] as $infraction)
            @php
              $formattedInfraction = explode('-', $infraction['descKey']);
            @endphp
            @if (count($formattedInfraction) >= 2)
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @else
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @endif
          @endforeach
        </li>
      @endif

      @if ($penalty['periodDescriptor']['number'] === 3)
        <li>
          <p>3rd Period</p>
        </li>
        <li>
          @foreach ($penalty['penalties'] as $infraction)
            @php
              $formattedInfraction = explode('-', $infraction['descKey']);
            @endphp
            @if (count($formattedInfraction) >= 2)
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @else
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @endif
          @endforeach
        </li>
      @endif

      @if ($penalty['periodDescriptor']['number'] === 4)
        <li>
          <p>OT</p>
        </li>
        <li>
          @foreach ($penalty['penalties'] as $infraction)
            @php
              $formattedInfraction = explode('-', $infraction['descKey']);
            @endphp
            @if (count($formattedInfraction) >= 2)
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }} {{ ucwords($formattedInfraction[1]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @else
              @if (array_key_exists('committedByPlayer', $infraction))
                <p class="game-matchup-penalty">
                  {{ $infraction['committedByPlayer'] }}
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @else
                <p class="game-matchup-penalty">
                  Bench Minor
                  -
                  <span>
                    {{ ucwords($formattedInfraction[0]) }}
                  </span>
                  -
                  {{ $infraction['timeInPeriod'] }}
                </p>
              @endif
            @endif
          @endforeach
        </li>
      @endif

      @if ($penalty['periodDescriptor']['number'] >= 5)
        <p></p>
      @endif
    @endforeach
  @endif
</ul>
