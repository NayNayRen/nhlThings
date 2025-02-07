{{-- finished games dropdown menu --}}
@if ($game["gameState"] === "OFF" || $game["gameState"] === "FINAL")
    <div class="game-dropdown-button">
        <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
    </div>
    <div class="game-dropdown-container">
        <ul class="game-dropdown-details">
            <li class='game-dropdown-header'>
                <div class='game-finished-date'>
                    <p>{{ $formattedGameDate }}</p>
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["awayTeam"]["logo"] }} alt='{{ $game["awayTeam"]["placeName"]["default"] }} Logo'
                        width="75" height="75">
                </div>
                <div>
                    <h3>FINAL</h3>
                    @if ($game["gameOutcome"]["lastPeriodType"] === "SO")
                        <span>SO</span>
                    @elseif ($game["gameOutcome"]["lastPeriodType"] === "OT")
                        <span>OT</span>
                    @elseif ($game["gameOutcome"]["lastPeriodType"] === "REG")
                        <span>REG</span>
                    @endif
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["homeTeam"]["logo"] }} alt='{{ $game["homeTeam"]["placeName"]["default"] }} Logo'
                        width="75" height="75">
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>{{ $game["awayTeam"]["score"] }}</p>
                    <h3>
                        <span>Goals</span>
                    </h3>
                    <p>{{ $game["homeTeam"]["score"] }}</p>
                </div>
            </li>
            <li class="game-winning-player">
                <h3>Winning Goalie</h3>
                @if (array_key_exists("winningGoalie", $game))
                    <p>{{ $game["winningGoalie"]["firstInitial"]["default"] }}
                        {{ $game["winningGoalie"]["lastName"]["default"] }}
                    </p>
                @else
                    <p>No Data</p>
                @endif
            </li>
            <li class="game-winning-player">
                <h3>Winning Goal Scorer</h3>
                @if (array_key_exists("winningGoalScorer", $game))
                    <p>{{ $game["winningGoalScorer"]["firstInitial"]["default"] }}
                        {{ $game["winningGoalScorer"]["lastName"]["default"] }}
                    </p>
                @else
                    <p>No Data</p>
                @endif
            </li>
            <a href="{{ route("games.game", $game["id"]) }}" class="game-stats-button" target="_blank">
                Final Stats <i class='fa fa-arrow-right' aria-hidden='true'></i>
            </a>
        </ul>
    </div>
@endif
{{-- critical and live time games dropdown menu --}}
@if ($game["gameState"] === "CRIT" || $game["gameState"] === "LIVE")
    @php
        $gameClock = App\Http\Controllers\ApiController::getBoxscores($game["id"]);
        $gameData = App\Http\Controllers\ApiController::getGameMatchup($game["id"]);
    @endphp
    <div class="game-dropdown-button">
        <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
    </div>
    <div class="game-dropdown-container">
        <ul class="game-dropdown-details">
            <li class='game-dropdown-header'>
                <div class='game-finished-date'>
                    <p>{{ $formattedGameDate }}</p>
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["awayTeam"]["logo"] }}
                        alt='{{ $game["awayTeam"]["placeName"]["default"] }} Logo' width="75" height="75">
                </div>
                <div class="game-periods">
                    @if ($gameClock["clock"]["inIntermission"] === true)
                        <h3 class="game-period">INT</h3>
                        <span>{{ $gameClock["clock"]["timeRemaining"] }}</span>
                    @else
                        @if ($gameData["periodDescriptor"]["number"] >= 5)
                            <h3 class="game-period">SO</h3>
                        @elseif ($gameData["periodDescriptor"]["number"] === 4)
                            <h3 class="game-period">OT</h3>
                        @elseif ($gameData["periodDescriptor"]["number"] === 3)
                            <h3 class="game-period">3rd</h3>
                        @elseif ($gameData["periodDescriptor"]["number"] === 2)
                            <h3 class="game-period">2nd</h3>
                        @elseif ($gameData["periodDescriptor"]["number"] === 1)
                            <h3 class="game-period">1st</h3>
                        @endif
                        <span>{{ $gameClock["clock"]["timeRemaining"] }}</span>
                    @endif
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["homeTeam"]["logo"] }}
                        alt='{{ $game["homeTeam"]["placeName"]["default"] }} Logo' width="75" height="75">
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>{{ $game["awayTeam"]["score"] }}</p>
                    <h3>
                        <span>Goals</span>
                    </h3>
                    <p>{{ $game["homeTeam"]["score"] }}</p>
                </div>
                <div>
                    @if (array_key_exists("goals", $gameData["periodDescriptor"]))
                        <p>{{ $gameData["periodDescriptor"]["goals"][count($goals["goals"] - 1)]["awayScore"] }}</p>
                    @else
                        <p>0</p>
                    @endif
                    @if ($gameData["periodDescriptor"]["number"] === 1)
                        <span>1st</span>
                    @endif
                    @if ($gameData["periodDescriptor"]["number"] === 2)
                        <span>2nd</span>
                    @endif
                    @if ($gameData["periodDescriptor"]["number"] === 3)
                        <span>3rd</span>
                    @endif
                    @if ($gameData["periodDescriptor"]["number"] === 4)
                        <span>OT</span>
                    @endif
                    @if ($gameData["periodDescriptor"]["number"] >= 5)
                        <span>SO</span>
                    @endif
                    @if (array_key_exists("goals", $gameData["periodDescriptor"]))
                        <p>{{ $gameData["periodDescriptor"]["goals"][count($goals["goals"] - 1)]["homeScore"] }}</p>
                    @else
                        <p>0</p>
                    @endif
                </div>
            </li>
            @if (array_key_exists("sog", $gameData["awayTeam"]))

                <li class='game-dropdown-shots'>
                    <div>
                        <p>{{ $gameData["awayTeam"]["sog"] }}</p>
                        <h3>
                            <span>Shots</span>
                        </h3>
                        <p>{{ $gameData["homeTeam"]["sog"] }}</p>
                    </div>
                    <div>
                        @if ($gameData["periodDescriptor"]["number"] === 1)
                            <p>{{ $gameData["awayTeam"]["sog"] }}</p>
                            <span>1st</span>
                            <p>{{ $gameData["homeTeam"]["sog"] }}</p>
                        @endif
                        @if ($gameData["periodDescriptor"]["number"] === 2)
                            <p>{{ $gameData["awayTeam"]["sog"] }}</p>
                            <span>2nd</span>
                            <p>{{ $gameData["homeTeam"]["sog"] }}</p>
                        @endif
                        @if ($gameData["periodDescriptor"]["number"] === 3)
                            <p>{{ $gameData["awayTeam"]["sog"] }}</p>
                            <span>3rd</span>
                            <p>{{ $gameData["homeTeam"]["sog"] }}</p>
                        @endif
                        @if ($gameData["periodDescriptor"]["number"] === 4)
                            <p>{{ $gameData["awayTeam"]["sog"] }}</p>
                            <span>OT</span>
                            <p>{{ $gameData["homeTeam"]["sog"] }}</p>
                        @endif
                        @if ($gameData["periodDescriptor"]["number"] >= 5)
                            <p></p>
                        @endif
                    </div>
                </li>
            @endif
            <a href="{{ route("games.game", $game["id"]) }}" class="game-stats-button" target="_blank">
                Box Score <i class='fa fa-arrow-right' aria-hidden='true'></i>
            </a>
        </ul>
    </div>
@endif
{{-- pregame dropdown menu --}}
@if ($game["gameState"] === "PRE")
    @php
        $gameData = App\Http\Controllers\ApiController::getGameMatchup($game["id"]);
        $teamLeaders = App\Http\Controllers\ApiController::getGameStory($game["id"]);
    @endphp
    <div class="game-dropdown-button">
        <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
    </div>
    <div class="game-dropdown-container">
        <ul class="game-dropdown-details">
            <li class='game-dropdown-header'>
                <div class='game-finished-date'>
                    <p>{{ $formattedGameDate }}</p>
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["awayTeam"]["logo"] }}
                        alt='{{ $game["awayTeam"]["placeName"]["default"] }} Logo' width="75" height="75">
                </div>
                <div>
                    <h3>{{ $formattedGameTime }} EST</h3>
                    <span>Stats Leaders</span>
                </div>
                <div class="game-dropdown-team-logo">
                    <img src={{ $game["homeTeam"]["logo"] }}
                        alt='{{ $game["homeTeam"]["placeName"]["default"] }} Logo' width="75" height="75">
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][0]["awayLeader"]["name"]["default"] }}
                    </p>
                    <h3>
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][0]["awayLeader"]["value"] }}
                        </span>
                        Points
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][0]["homeLeader"]["value"] }}
                        </span>
                    </h3>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][0]["homeLeader"]["name"]["default"] }}
                    </p>
                </div>
                <div>
                    <p></p>
                    <span></span>
                    <p></p>
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][1]["awayLeader"]["name"]["default"] }}
                    </p>
                    <h3>
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][1]["awayLeader"]["value"] }}
                        </span>
                        Goals
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][1]["homeLeader"]["value"] }}
                        </span>
                    </h3>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][1]["homeLeader"]["name"]["default"] }}
                    </p>
                </div>
                <div>
                    <p></p>
                    <span></span>
                    <p></p>
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][2]["awayLeader"]["name"]["default"] }}
                    </p>
                    <h3>
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][2]["awayLeader"]["value"] }}
                        </span>
                        Assists
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][2]["homeLeader"]["value"] }}
                        </span>
                    </h3>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][2]["homeLeader"]["name"]["default"] }}
                    </p>
                </div>
                <div>
                    <p></p>
                    <span></span>
                    <p></p>
                </div>
            </li>
            <li class='game-dropdown-goals'>
                <div>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][3]["awayLeader"]["name"]["default"] }}
                    </p>
                    <h3>
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][3]["awayLeader"]["value"] }}
                        </span>
                        <span>+ / -</span>
                        <span>
                            {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][3]["homeLeader"]["value"] }}
                        </span>
                    </h3>
                    <p>
                        {{ $teamLeaders["preGameMatchup"]["skatingLeaders"]["leaders"][3]["homeLeader"]["name"]["default"] }}
                    </p>
                </div>
                <div>
                    <p></p>
                    <span></span>
                    <p></p>
                </div>
            </li>
            @if (array_key_exists("goalieComparison", $teamLeaders["preGameMatchup"]))
                <li class='game-dropdown-goals'>
                    <div>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]["name"]["default"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][1]["name"]["default"] }}
                            @endif
                        </p>
                        <h3>
                            <span>Goalies</span>
                        </h3>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]["name"]["default"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][1]["name"]["default"] }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p></p>
                        <span></span>
                        <p></p>
                    </div>
                </li>
                <li class='game-dropdown-goals'>
                    <div>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]["record"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][1]["record"] }}
                            @endif
                        </p>
                        <h3>
                            <span>Record</span>
                        </h3>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]["record"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][1]["record"] }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p></p>
                        <span></span>
                        <p></p>
                    </div>
                </li>
                <li class='game-dropdown-goals'>
                    <div>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]["gaa"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][1]["gaa"] }}
                            @endif

                        </p>
                        <h3>
                            <span>GA</span>
                        </h3>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]["gaa"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][1]["gaa"] }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p></p>
                        <span></span>
                        <p></p>
                    </div>
                </li>
                <li class='game-dropdown-goals'>
                    <div>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]["savePctg"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][1]["savePctg"] }}
                            @endif

                        </p>
                        <h3>
                            <span>SV %</span>
                        </h3>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]["savePctg"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][1]["savePctg"] }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p></p>
                        <span></span>
                        <p></p>
                    </div>
                </li>
                <li class='game-dropdown-goals'>
                    <div>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][0]["shutouts"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["awayTeam"][1]["shutouts"] }}
                            @endif
                        </p>
                        <h3>
                            <span>SO</span>
                        </h3>
                        <p>
                            @if (count($teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]) > 7)
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][0]["shutouts"] }}
                            @else
                                {{ $teamLeaders["preGameMatchup"]["goalieComparison"]["homeTeam"][1]["shutouts"] }}
                            @endif
                        </p>
                    </div>
                    <div>
                        <p></p>
                        <span></span>
                        <p></p>
                    </div>
                </li>
            @else
                <li class='game-dropdown-goals'>
                    <div>
                        <p>No Data</p>
                        <h3>
                            <span>Goalies</span>
                        </h3>
                        <p>No Data</p>
                    </div>
                    <div>
                        <p>No Data</p>
                        <h3>
                            <span></span>
                        </h3>
                        <p>No Data</p>
                    </div>
                </li>
            @endif

            <a href="{{ route("games.game", $game["id"]) }}" class="game-stats-button" target="_blank">
                Match Up <i class='fa fa-arrow-right' aria-hidden='true'></i>
            </a>
        </ul>
    </div>
@endif
