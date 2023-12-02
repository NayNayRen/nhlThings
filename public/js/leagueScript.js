function loadLeagueScript() {
  const leagueGameDatesDropdownContainer = document.querySelector('.league-game-dates-dropdown-container');
  const leagueGameDatesDropdownButton = document.querySelector('.league-game-dates-dropdown-button');
  const leagueGameDatesDropdownList = document.querySelector('.league-game-dates-dropdown-list');
  const $leagueCarousel = $('.league-carousel');
  let checkGameState = document.querySelectorAll('.game-state');

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
    if (gameState.innerText === 'OFF' || gameState.innerText === 'FINAL' || gameState.innerText === 'CRIT' || gameState.innerText === 'LIVE') {
      // console.log(gameState.parentElement.childNodes);
      gameState.parentElement.childNodes[3].classList.add('game-dropdown-toggle');
      gameState.parentElement.childNodes[1].childNodes[1].classList.add('rotate');
      // colors away team winner
      if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText > gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'OFF' || gameState.innerText === 'FINAL') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.backgroundColor = '#1e90ff';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].style.color = '#fff';
      }
      // colors home team winner
      if (gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[1].innerText < gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].innerText && gameState.innerText === 'OFF' || gameState.innerText === 'FINAL') {
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.backgroundColor = '#1e90ff';
        gameState.parentElement.childNodes[3].childNodes[1].childNodes[3].childNodes[1].childNodes[5].style.color = '#fff';
      }
    }
  });
  // each games dropdown button
  $(document).on('click', '.game-dropdown-button', function () {
    // console.log($(this)[0].parentElement.childNodes);
    $(this)[0].lastElementChild.classList.toggle('rotate');
    $(this)[0].parentElement.childNodes[3].classList.toggle('game-dropdown-toggle');
  });
}

window.addEventListener('load', () => {
  loadLeagueScript();
});