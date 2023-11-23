function loadCarousel() {
  const headerName = document.querySelector('.main-header-name');
  const homeTeamLogo = document.querySelectorAll('.home-team-logo');
  const $teamCarousel = $('.team-carousel');

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

  $teamCarousel.trigger('destroy.owl.carousel');
  $teamCarousel.html($teamCarousel.find('.owl-stage-outer').html()).removeClass('owl-loaded');
  $teamCarousel.owlCarousel(carouselOptions);
  let owl = $teamCarousel.data('owl.carousel');
  // console.log(owl);
  let owlDots = document.querySelectorAll('.owl-dot');
  for (let i = 0; i < owlDots.length; i++) {
    owlDots[i].setAttribute('aria-label', 'Carousel to next item.');
    owlDots[i].setAttribute('value', i + 1);
  }
  if (owl._items.length === 1) {
    owl.options.center = true;
    $teamCarousel.trigger('refresh.owl.carousel');
  }
  if (owl._items.length === 2) {
    owl.options.responsive[1400].items = 2;
    $teamCarousel.trigger('refresh.owl.carousel');
  }
  if (owl._items.length >= 3) {
    owl.options.responsive[1400].items = 3;
    $teamCarousel.trigger('refresh.owl.carousel');
  }
  console.log(headerName.innerText);
  homeTeamLogo.forEach((logo) => {
    console.log(logo.lastElementChild.getAttribute('alt'));
  })
}

window.addEventListener('load', () => {
  loadCarousel();
});