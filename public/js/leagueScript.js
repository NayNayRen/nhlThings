function loadLeagueScript() {
  const leagueGameDatesDropdownContainer = document.querySelector('.league-game-dates-dropdown-container');
  const leagueGameDatesDropdownButton = document.querySelector('.league-game-dates-dropdown-button');
  const leagueGameDatesDropdownList = document.querySelector('.league-game-dates-dropdown-list');
  const transitionContainer = document.querySelector('.transition-container');
  // gets and formats the season
  const season = document.querySelector('.current-season').innerText;
  const firstHalfSeason = season.slice(0, 4);
  const secondHalfSeason = season.slice(4);
  const periods = document.querySelectorAll('.game-periods');
  // const main = document.querySelector('.main');
  // const mainContainer = document.querySelector('.main-container');
  // standings selection buttons
  const leagueButton = document.querySelector('.league-button');
  const eastButton = document.querySelector('.east-button');
  const westButton = document.querySelector('.west-button');
  const metroButton = document.querySelector('.metro-button');
  const atlanticButton = document.querySelector('.atlantic-button');
  const centralButton = document.querySelector('.central-button');
  const pacificButton = document.querySelector('.pacific-button');
  // standings tables
  const leagueTable = document.querySelector('.league-table');
  const eastTable = document.querySelector('.east-table');
  const westTable = document.querySelector('.west-table');
  const atlanticTable = document.querySelector('.atlantic-table');
  const centralTable = document.querySelector('.central-table');
  const metroTable = document.querySelector('.metro-table');
  const pacificTable = document.querySelector('.pacific-table');
  // used to clear the active standings selection
  const leagueSelectionButtons = document.querySelectorAll('div.league-standings-selection-container button');
  // standings heading container
  const leagueStandingsHeadingContainer = document.querySelector('.league-standings-heading-container');
  // used to control the dropdowns
  let checkGameState = document.querySelectorAll('.game-state');
  const $leagueCarousel = $('.league-carousel');

  const carouselOptions = {
    loop: false,
    rewind: false,
    nav: true,
    autoplay: false,
    autoplayTimeout: 3000,
    smartSpeed: 500,
    autoplayHoverPause: false,
    dots: false,
    touchDrag: true,
    mouseDrag: true,
    navText: [
      "<div class='arrow arrow-left' aria-label='Previous Arrow'><i class='fa fa-arrow-left' aria-hidden='false'></i></div>",
      "<div class='arrow arrow-right' aria-label='Next Arrow'><i class='fa fa-arrow-right' aria-hidden='false'></i></div>",
    ],
    responsive: {
      0: {
        // < 700
        items: 1,
        slideBy: 1,
      },
      700: {
        // 700 - 1000
        items: 2,
        slideBy: 2,
      },
      1000: {
        // > 1000 - 1400
        items: 2,
        slideBy: 2,
      },
      1400: {
        // > 1400
        items: 3,
        slideBy: 3,
      },
    },
  };

  const limitedCarouselOptions = {
    center: false,
    loop: false,
    autoplay: false,
    autoplayTimeout: 3000,
    smartSpeed: 500,
    autoplayHoverPause: false,
    dots: true,
    touchDrag: false,
    mouseDrag: false,
    responsive: {
      0: {
        // < 700
        items: 1,
      },
      700: {
        // 700 - 1000
        items: 2,
      },
      1000: {
        // > 1000 - 1300
        items: 2,
      },
      1300: {
        // > 1300
        items: 3,
      },
    },
  };

  $leagueCarousel.trigger('destroy.owl.carousel');
  $leagueCarousel.html($leagueCarousel.find('.owl-stage-outer').html()).removeClass('owl-loaded');
  $leagueCarousel.owlCarousel(limitedCarouselOptions);
  let owl = $leagueCarousel.data('owl.carousel');
  let owlDots = document.querySelectorAll('.owl-dot');
  for (let i = 0; i < owlDots.length; i++) {
    owlDots[i].setAttribute('aria-label', 'Carousel to next item.');
    owlDots[i].setAttribute('value', i + 1);
  }
  if (owl._items.length === 1) {
    owl.options.center = true;
    $leagueCarousel.trigger('refresh.owl.carousel');
  }
  if (owl._items.length === 2) {
    owl.options.responsive[1300].items = 2;
    $leagueCarousel.trigger('refresh.owl.carousel');
  }
  if (owl._items.length >= 3) {
    owl.options.responsive[1300].items = 3;
    $leagueCarousel.trigger('refresh.owl.carousel');
  }
  // GAME UPCOMING DATES DROPDOWN
  leagueGameDatesDropdownButton.addEventListener('click', () => {
    leagueGameDatesDropdownContainer.children[0].classList.toggle('rotate');
    leagueGameDatesDropdownList.classList.toggle('league-team-dropdown-list-toggle');
  });
  // gameState.parentElement is the entire game card
  checkGameState.forEach((gameState) => {
    // console.log(gameState.parentElement.childNodes);
    if (gameState.innerText === 'OFF' || gameState.innerText === 'FINAL' || gameState.innerText === 'CRIT' || gameState.innerText === 'LIVE' || gameState.innerText === 'PRE') {
      gameState.parentElement.childNodes[3].classList.add('game-dropdown-toggle');
      gameState.parentElement.childNodes[1].childNodes[1].classList.add('rotate');
      // colors away team winner
      if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText > gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'OFF') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.backgroundColor = '#b22222';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.color = '#fff';
      }
      // final games are not flipped like off is, this is backwards from above
      else if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText < gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'FINAL') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.backgroundColor = '#b22222';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.color = '#fff';
      }
      // colors home team winner
      else if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText < gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'OFF') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.backgroundColor = '#b22222';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.color = '#fff';
      }
      // final games are not flipped like off is, this is backwards from above
      else if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText > gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'FINAL') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.backgroundColor = '#b22222';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.color = '#fff';
      }
    }
  });
  // standings buttons and heading change
  leagueSelectionButtons.forEach((button) => {
    leagueButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
      <div>
        <h2>League Standings</h2>
        <p>${firstHalfSeason}/${secondHalfSeason}</p>
      </div>
      <div>
        <img src='../img/nhl-logo.webp' alt="NHL Logo" width="100" height="100">
      </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      leagueButton.classList.add('active-standings-selection');
      leagueTable.style.display = 'flex';
      eastTable.style.display = 'none';
      westTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      centralTable.style.display = 'none';
      metroTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    eastButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Eastern Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/eastern-logo.webp' alt="Eastern Conf. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      eastButton.classList.add('active-standings-selection');
      eastTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      westTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      centralTable.style.display = 'none';
      metroTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    westButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Western Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/western-logo.webp' alt="Western Conf. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      westButton.classList.add('active-standings-selection');
      westTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      eastTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      centralTable.style.display = 'none';
      metroTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    atlanticButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Atlantic Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/atlantic-logo.webp' alt="Atlantic Dev. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      atlanticButton.classList.add('active-standings-selection');
      atlanticTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      eastTable.style.display = 'none';
      westTable.style.display = 'none';
      centralTable.style.display = 'none';
      metroTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    centralButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Central Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/central-logo.webp' alt="Central Dev. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      centralButton.classList.add('active-standings-selection');
      centralTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      eastTable.style.display = 'none';
      westTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      metroTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    metroButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Metro Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/metro-logo.webp' alt="Metro Dev. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      metroButton.classList.add('active-standings-selection');
      metroTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      eastTable.style.display = 'none';
      westTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      centralTable.style.display = 'none';
      pacificTable.style.display = 'none';
    });
    pacificButton.addEventListener('click', () => {
      leagueStandingsHeadingContainer.innerHTML = `
        <div>
          <h2>Pacific Standings</h2>
          <p>${firstHalfSeason}/${secondHalfSeason}</p>
        </div>
        <div>
          <img src='../img/pacific-logo.webp' alt="Pacific Dev. Logo" width="100" height="100">
        </div>
      `;
      if (button.classList.contains('active-standings-selection')) {
        button.classList.remove('active-standings-selection');
      }
      pacificButton.classList.add('active-standings-selection');
      pacificTable.style.display = 'flex';
      leagueTable.style.display = 'none';
      eastTable.style.display = 'none';
      westTable.style.display = 'none';
      atlanticTable.style.display = 'none';
      centralTable.style.display = 'none';
      metroTable.style.display = 'none';
    });
  });
  leagueStandingsHeadingContainer.innerHTML = `
    <div>
      <h2>League Standings</h2>
      <p>${firstHalfSeason}/${secondHalfSeason}</p>
    </div>
    <div>
      <img src='../img/nhl-logo.webp' alt="NHL Logo" width="100" height="100">
    </div>
  `;
  // shows periods for each game
  periods.forEach((period) => {
    // console.log(period.childNodes);
    if (period.childNodes.length === 13) {
      period.childNodes[1].style.display = 'none';
      period.childNodes[3].style.display = 'none';
      period.childNodes[5].style.display = 'none';
      period.childNodes[7].style.display = 'none';
    }
    else if (period.childNodes.length === 11) {
      period.childNodes[1].style.display = 'none';
      period.childNodes[3].style.display = 'none';
      period.childNodes[5].style.display = 'none';
    }
    else if (period.childNodes.length === 9) {
      period.childNodes[1].style.display = 'none';
      period.childNodes[3].style.display = 'none';
    }
    else if (period.childNodes.length === 7) {
      period.childNodes[1].style.display = 'none';
    }
  });
  // each games dropdown button
  $(document).on('click', '.game-dropdown-button', function () {
    // console.log($(this)[0].parentElement.childNodes);
    $(this)[0].lastElementChild.classList.toggle('rotate');
    $(this)[0].parentElement.childNodes[3].classList.toggle('game-dropdown-toggle');
  });

  transitionContainer.style.opacity = 1;

  // main.style.backgroundImage = `
  // -webkit-gradient(
  //   linear,
  //   left top,
  //   right top,
  //   from(rgba(0, 0, 0, 0.9)),
  //   to(rgba(0, 0, 0, 0.5))
  // ),
  // url("../img/nhl-logo.webp")`;
  // main.style.backgroundImage = `
  // linear-gradient(
  //   90deg,
  //   rgba(0, 0, 0, 0.9),
  //   rgba(0, 0, 0, 0.5)
  // ),
  // url("../img/nhl-logo.webp")`;

  // mainContainer.style.backgroundImage = `
  // -webkit-gradient(
  //   linear,
  //   left top,
  //   right top,
  //   from(rgba(245, 245, 245, 1)),
  //   to(rgba(245, 245, 245, 0.75))
  // ),
  // url("../img/nhl-logo.webp")`;
  // mainContainer.style.backgroundImage = `
  // linear-gradient(
  //   90deg,
  //   rgba(245, 245, 245, 1),
  //   rgba(245, 245, 245, 0.75)
  // ),
  // url("../img/nhl-logo.webp")`;
}

window.addEventListener('load', () => {
  loadLeagueScript();
});