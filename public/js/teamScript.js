function loadTeamScript() {
  const $upcomingGames = $('.upcoming-games');
  const $finishedGames = $('.finished-games');
  let checkGameState = document.querySelectorAll('.game-state');
  const periods = document.querySelectorAll('.game-periods');
  const transitionContainer = document.querySelectorAll('.transition-container');

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
  // upcoming games
  $upcomingGames.trigger('destroy.owl.carousel');
  $upcomingGames.html($upcomingGames.find('.owl-stage-outer').html()).removeClass('owl-loaded');
  $upcomingGames.owlCarousel(carouselOptions);
  let upcomingGamesData = $upcomingGames.data('owl.carousel');
  // console.log(upcomingGamesData);
  if (upcomingGamesData._items.length === 1) {
    upcomingGamesData.options.center = true;
    $upcomingGames.trigger('refresh.owl.carousel');
  }
  if (upcomingGamesData._items.length === 2) {
    upcomingGamesData.options.responsive[1400].items = 2;
    $upcomingGames.trigger('refresh.owl.carousel');
  }
  if (upcomingGamesData._items.length >= 3) {
    upcomingGamesData.options.responsive[1400].items = 3;
    $upcomingGames.trigger('refresh.owl.carousel');
  }

  let owlDots = document.querySelectorAll('.owl-dot');
  for (let i = 0; i < owlDots.length; i++) {
    owlDots[i].setAttribute('aria-label', 'Carousel to next item.');
    owlDots[i].setAttribute('value', i + 1);
  }
  // finished games
  $finishedGames.trigger('destroy.owl.carousel');
  $finishedGames.html($finishedGames.find('.owl-stage-outer').html()).removeClass('owl-loaded');
  $finishedGames.owlCarousel(carouselOptions);
  let finishedGamesData = $finishedGames.data('owl.carousel');
  // console.log(finishedGamesData);
  if (finishedGamesData._items.length === 1) {
    finishedGamesData.options.center = true;
    $finishedGames.trigger('refresh.owl.carousel');
  }
  if (finishedGamesData._items.length === 2) {
    finishedGamesData.options.responsive[1400].items = 2;
    $finishedGames.trigger('refresh.owl.carousel');
  }
  if (finishedGamesData._items.length >= 3) {
    finishedGamesData.options.responsive[1400].items = 3;
    $finishedGames.trigger('refresh.owl.carousel');
  }

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
  transitionContainer.forEach((container) => {
    container.style.opacity = 1;
  });
}

window.addEventListener('load', () => {
  loadTeamScript();
});