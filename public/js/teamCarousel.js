function loadCarousel() {
  const $upcomingGames = $('.upcoming-games');
  const $finishedGames = $('.finished-games');

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
}

window.addEventListener('load', () => {
  loadCarousel();
});