<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
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
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/page-reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="shortcut icon" href="{{ asset('img/nhl-shield.webp') }}" type="image/x-icon">
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
      <div class="header-container">
        <!-- BURGER BUTTON -->
        <div class="burger-menu">
          <div id="burger-bars-1" class="burger-bars"></div>
          <div id="burger-bars-2" class="burger-bars"></div>
          <div id="burger-bars-3" class="burger-bars"></div>
        </div>
        <div class="header-nav">
          <div class="teams-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="teams-dropdown-button" value="Teams..." /><br />
            <ul class="teams-dropdown-list">
              @foreach ($sortedTeamsByName as $team)
                <li>
                  <a href="{{ route('teams.team', $team['teamAbbrev']['default']) }}" target="_blank">
                    <span class='teams-dropdown-name'>
                      {{ $team['teamName']['default'] }}
                    </span>
                    <div class="teams-dropdown-logo">
                      <img src={{ $team['teamLogo'] }} alt={{ $team['teamName']['default'] }} width="100"
                        height="100">
                    </div>
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="roster-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="roster-dropdown-button" value="Team Roster..." /><br />
            <ul class="roster-dropdown-list">
              <li>
                <span class="roster-dropdown-name">Select a team first...</span>
              </li>
              <!-- added dynamically -->
            </ul>
          </div>
          <div class="team-summary-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="team-summary-dropdown-button" value="Team Summary..." /><br />
            <div class="team-summary-dropdown-list">
              <!-- added dynamically -->
              <p class="roster-dropdown-name">Select a team first...</p>
            </div>
          </div>

          <div class="how-to-dropdown-container">
            <i class="fa-solid fa-caret-up" aria-hidden="true"></i>
            <input type="button" class="how-to-dropdown-button" value="How To..." /><br />
            <div class="how-to-dropdown-list">
              <p>
                <span>Games :</span>
                - Daily games are available at the top of the app. The dropdowns
                of dates are of upcoming and previous current regular season
                games. Just below the Daily section you can view League,
                Conference, and Division stats too.
              </p>
              <p>
                <span>Teams :</span>
                - Select a team from above and you're then able to see that
                team's regular and preseason schedules. The dropdown of dates
                for that team has season stats dating back to their first year
                of play. The Roster and Summary dropdowns above are then
                available for use.
              </p>
              <p>
                <span>Players :</span>
                - You can now choose a current rostered player, and optionally
                take a peak at their playing history. If you happen to close a
                player's information, you can use the roster menu and select
                them again, or another player.
              </p>
              <p>
                <span>Cards :</span>
                - Each game's card has a dropdown that contains period,
                intermission and power play times, along with shots and goals
                for each period and their totals. The Box Score buttons hide
                extra game stats, the game's officials, and a dropdown of each
                team's game lineup.
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
                Lightning & Rangers. It's built using HTML, CSS, JavaScript,
                some jQuery, and Owl Carousel for the game displays.
              </p>
              <p>
                <span>NHL API :</span>
                - The app is basically what the heading says :
                <strong>a collection of NHL teams, their schedules and rosters, team
                  and player stats, and daily games with upcoming and previous
                  dates</strong>. There's also endpoints for awards, draft picks and more, but
                I didn't get into those just yet.
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
                  <a href="https://gitlab.com/dword4/nhlapi/-/blob/master/new-api.md" target="_blank"
                    title="NHL API Link" aria-label="NHL API Link">nhlapi/new-api.md
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="false"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </header>