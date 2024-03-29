<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
      content="My name is Nate Moscato, I am a fan of the NHL and the game of hockey. I have two teams that are equally my number ones: the Tampa Bay Lightning, and the New York Rangers. When they play each other, I see it as no matter what, the team I like is going to win. JavaScript, HTML, CSS and jQuery were used to build this application. Owl Carousel is used for the slider actions, and the NHL API is used for data and a separate API is used for player profile pics." />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/owl-carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/page-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="shortcut icon" href={{ $favIcon }} type="image/x-icon" sizes="any">
    <title>{{ $title }}</title>
  </head>

  <body>
    <!-- TOP BUTTON ANCHOR -->
    <a id="top"></a>
    <!-- BURGER MENU SCREEN TINT -->
    <div id="burger-overlay" class="burger-overlay"></div>
    <header>
      <h1>NHL Teams, Stats & Things</h1>
      <div class="current-date-time-container">
        <p class="current-date"></p>
        <p class="current-time"></p>
      </div>
      <a href="{{ route('league.index') }}" class="home-link" title="Home" aria-label="Home Link">
        <i class="fa-solid fa-house" aria-hidden="false"></i>
      </a>
      <div class="header-container">
        <!-- BURGER BUTTON -->
        <div class="burger-menu">
          <div id="burger-bars-1" class="burger-bars"></div>
          <div id="burger-bars-2" class="burger-bars"></div>
          <div id="burger-bars-3" class="burger-bars"></div>
        </div>
        <div class="header-nav">
          {{-- TEAMS --}}
          <div class="teams-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="teams-dropdown-button" value="Teams..." /><br />
            <ul class="teams-dropdown-list">
              @foreach ($sortedTeamsByName as $team)
                <li>
                  <a href="{{ route('teams.team', $team['teamAbbrev']['default']) }}">
                    <p class='teams-dropdown-name'>
                      {{ $team['teamName']['default'] }}
                    </p>
                    <div class="teams-dropdown-logo">
                      <img src={{ $team['teamLogo'] }} alt={{ $team['teamName']['default'] }} width="75"
                        height="75">
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          {{-- ROSTER --}}
          <div class="roster-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="roster-dropdown-button" value="Team Roster..." /><br />
            <ul class="roster-dropdown-list">
              @if (count($teamRoster) === 0 || $teamRoster === null)
                <li>
                  <p class="roster-dropdown-name">Select a team first...</p>
                </li>
              @else
                {{-- GOALIES --}}
                <ul class="roster-dropdown-player-type">
                  <li>
                    <p>Goalies</p>
                  </li>
                </ul>
                @foreach (collect($teamRoster['goalies'])->sortBy('sweaterNumber') as $goalie)
                  {{-- @foreach ($teamRoster['goalies'] as $goalie) --}}
                  <li>
                    <a href="{{ route('players.player', $goalie['id']) }}" target="_blank">
                      <p class="roster-dropdown-name">{{ $goalie['firstName']['default'] }}
                        {{ $goalie['lastName']['default'] }}</p>
                      @if (array_key_exists('sweaterNumber', $goalie))
                        <span class='roster-dropdown-position'>#{{ $goalie['sweaterNumber'] }}</span>
                      @else
                        <span class='roster-dropdown-position'>0</span>
                      @endif
                      <div class="roster-dropdown-photo-container">
                        <img src={{ $goalie['headshot'] }}
                          alt="{{ $goalie['firstName']['default'] }} {{ $goalie['lastName']['default'] }}"
                          width="75" height="75">
                      </div>
                    </a>
                  </li>
                @endforeach
                {{-- FORWARDS --}}
                <ul class="roster-dropdown-player-type">
                  <li>
                    <p>Forwards</p>
                  </li>
                </ul>
                @foreach (collect($teamRoster['forwards'])->sortBy('sweaterNumber') as $forward)
                  {{-- @foreach ($teamRoster['forwards'] as $forward) --}}
                  <li>
                    <a href="{{ route('players.player', $forward['id']) }}" target="_blank">
                      <p class="roster-dropdown-name">{{ $forward['firstName']['default'] }}
                        {{ $forward['lastName']['default'] }}</p>
                      @if (array_key_exists('sweaterNumber', $forward))
                        <span class='roster-dropdown-position'>#{{ $forward['sweaterNumber'] }}</span>
                      @else
                        <span class='roster-dropdown-position'>0</span>
                      @endif
                      <div class="roster-dropdown-photo-container">
                        <img src={{ $forward['headshot'] }}
                          alt="{{ $forward['firstName']['default'] }} {{ $forward['lastName']['default'] }}"
                          width="75" height="75">
                      </div>
                    </a>
                  </li>
                @endforeach
                {{-- DEFENSE --}}
                <ul class="roster-dropdown-player-type">
                  <li>
                    <p>Defense</p>
                  </li>
                </ul>
                @foreach (collect($teamRoster['defensemen'])->sortBy('sweaterNumber') as $defender)
                  {{-- @foreach ($teamRoster['defensemen'] as $defender) --}}
                  <li>
                    <a href="{{ route('players.player', $defender['id']) }}" target="_blank">
                      <p class="roster-dropdown-name">{{ $defender['firstName']['default'] }}
                        {{ $defender['lastName']['default'] }}</p>
                      @if (array_key_exists('sweaterNumber', $defender))
                        <span class='roster-dropdown-position'>#{{ $defender['sweaterNumber'] }}</span>
                      @else
                        <span class='roster-dropdown-position'>0</span>
                      @endif
                      <div class="roster-dropdown-photo-container">
                        <img src={{ $defender['headshot'] }}
                          alt="{{ $defender['firstName']['default'] }} {{ $defender['lastName']['default'] }}"
                          width="75" height="75">
                      </div>
                    </a>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>

          <div class="how-to-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="how-to-dropdown-button" value="How To..." /><br />
            <div class="how-to-dropdown-list">
              <p>
                <span>Games :</span>
                - Daily games load by default. The dropdown
                of dates is a weekly schedule provided via the NHL API. The dates are auto-updated by the NHL, so the
                dropdown updates from that. I slimmed it down to weekly games to limit the amount of data requested.
                Just
                below the game section you can view League,
                Conference, and Division standings.
              </p>
              <p>
                <span>Cards :</span>
                - The cards for 'day of' games will have a button display from PREGAME time which is 30 minutes before
                game time and on. This
                button controls a dropdown of data that will update as the games go on. Each dropdown has a button to
                lead to more in depth stats for PREGAME, LIVE and FINAL
                games.
              </p>
              <p>
                <span>Teams :</span>
                - Select a team from above and you'll be redirected to see that
                team's regular season schedule. Day of and upcoming games are on top. Finished games are below, and soon
                to be team stats below that. You'll be able to see finished game stats from their dropdown buttons.
              </p>
              <p>
                <span>Players :</span>
                - Once a team is chosen, a current rostered player is available. Select a player and be redirected to
                their personal summary, last five games, awards if any, draft details if any, and season and career
                stats too.
              </p>
            </div>
          </div>

          <div class="about-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="about-dropdown-button" value="About This App..." /><br />
            <div class="about-dropdown-list">
              <p>
                <span>Built By :</span>
                - My name is Nate, I'm a Junior Web Developer of a little more
                than two years. I thought I would build this app out as a means
                of api and coding practice. I'm also a fan of hockey, namely the
                Lightning & Rangers. It's built using Laravel, HTML, CSS, JavaScript,
                some jQuery, and Owl Carousel for the game displays.
              </p>
              <p>
                <span>NHL API :</span>
                - The NHL surprised us all and built a new API and endpoints of data. All the content, information,
                logos and headshots are provided by the API and owned by the NHL. I, as a fan, simply put it on display.
              </p>
              <ul>
                <span>Creators :</span>
                <li>
                  My Portfolio<br />
                  <a href="https://naynayren.github.io/" target="_blank" title="My Portfolio"
                    aria-label="My Portfolio Link">Nate M.
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="false"></i></a>
                </li>
                <li>
                  API Maintained By<br />
                  <a href="https://gitlab.com/dword4" target="_blank" title="API Maintainer"
                    aria-label="API Maintainer Link">Drew Hynes
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="false"></i></a>
                </li>
                <li>
                  NHL API Docs<br />
                  <a href="https://gitlab.com/dword4/nhlapi/-/blob/master/new-api.md" target="_blank" title="NHL API"
                    aria-label="NHL API Link">nhlapi/new-api.md
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="false"></i></a>
                </li>
                <li>
                  In Depth Endpoints<br />
                  <a href="https://github.com/Zmalski/NHL-API-Reference" target="_blank" title="In Depth Endpoints"
                    aria-label="In Depth Endpoints Link">NHL-API-Reference
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="false"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>
