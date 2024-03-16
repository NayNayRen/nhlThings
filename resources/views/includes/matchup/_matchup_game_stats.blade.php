{{-- faceoff % --}}
@if (count($gameMatchup['summary']['teamGameStats'][1]) > 0)
  <ul class="game-matchup-main-container-faceoff">
    <li>
      @php
        $formattedAwayFaceoff = round((float) $gameMatchup['summary']['teamGameStats'][1]['awayValue'] * 100);
        $formattedHomeFaceoff = round((float) $gameMatchup['summary']['teamGameStats'][1]['homeValue'] * 100);
      @endphp
      <p>{{ $formattedAwayFaceoff }}%</p>
      <p>Faceoff</p>
      <p>{{ $formattedHomeFaceoff }}%</p>
    </li>
  </ul>
@endif
{{-- power play --}}
@if (count($gameMatchup['summary']['teamGameStats'][2]) > 0)
  <ul class="game-matchup-main-container-pp">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][2]['awayValue'] }}</p>
      <p>P P</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][2]['homeValue'] }}</p>
    </li>
  </ul>
@endif
{{-- penalty in minutes --}}
@if (count($gameMatchup['summary']['teamGameStats'][3]) > 0)
  <ul class="game-matchup-main-container-pim">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][3]['awayValue'] }}</p>
      <p>P i M</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][3]['homeValue'] }}</p>
    </li>
  </ul>
@endif
{{-- hits --}}
@if (count($gameMatchup['summary']['teamGameStats'][4]) > 0)
  <ul class="game-matchup-main-container-hits">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][4]['awayValue'] }}</p>
      <p>Hits</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][4]['homeValue'] }}</p>
    </li>
  </ul>
@endif
{{-- blocked shots --}}
@if (count($gameMatchup['summary']['teamGameStats'][5]) > 0)
  <ul class="game-matchup-main-container-bshots">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][5]['awayValue'] }}</p>
      <p>B Shots</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][5]['homeValue'] }}</p>
    </li>
  </ul>
@endif
{{-- giveaways --}}
@if (count($gameMatchup['summary']['teamGameStats'][6]) > 0)
  <ul class="game-matchup-main-container-gaways">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][6]['awayValue'] }}</p>
      <p>G Aways</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][6]['homeValue'] }}</p>
    </li>
  </ul>
@endif
{{-- takeaways --}}
@if (count($gameMatchup['summary']['teamGameStats'][7]) > 0)
  <ul class="game-matchup-main-container-taways">
    <li>
      <p>{{ $gameMatchup['summary']['teamGameStats'][7]['awayValue'] }}</p>
      <p>T Aways</p>
      <p>{{ $gameMatchup['summary']['teamGameStats'][7]['homeValue'] }}</p>
    </li>
  </ul>
@endif
