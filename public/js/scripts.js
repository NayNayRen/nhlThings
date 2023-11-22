function loadScript() {
  const burgerMenu = document.querySelector(".burger-menu");
  const upArrow = document.querySelector(".up-arrow");
  const nhlCopyright = document.querySelector('.nhl-copyright');
  const currentDate = document.querySelector('.current-date');
  const currentTime = document.querySelector('.current-time');

  // team dropdown containers
  const teamsDropdownContainer = document.querySelector('.teams-dropdown-container');
  const teamsDropdownButton = document.querySelector('.teams-dropdown-button');
  const teamsDropdownList = document.querySelector('.teams-dropdown-list');

  // roster dropdown containers
  const rosterDropdownContainer = document.querySelector('.roster-dropdown-container');
  const rosterDropdownButton = document.querySelector('.roster-dropdown-button');
  const rosterDropdownList = document.querySelector('.roster-dropdown-list');

  // team summary dropdown containers
  const teamSummaryDropdownContainer = document.querySelector('.team-summary-dropdown-container');
  const teamSummaryDropdownButton = document.querySelector('.team-summary-dropdown-button');
  const teamSummaryDropdownList = document.querySelector('.team-summary-dropdown-list');

  // about dropdown containers
  const aboutDropdownContainer = document.querySelector('.about-dropdown-container');
  const aboutDropdownButton = document.querySelector('.about-dropdown-button');
  const aboutDropdownList = document.querySelector('.about-dropdown-list');

  // how to dropdown containers
  const howToDropdownContainer = document.querySelector('.how-to-dropdown-container');
  const howToDropdownButton = document.querySelector('.how-to-dropdown-button');
  const howToDropdownList = document.querySelector('.how-to-dropdown-list');

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

  // show and hide up arrow
  function activateUpArrow() {
    if (document.documentElement.scrollTop > 0) {
      upArrow.style.right = "10px";
    } else {
      upArrow.style.right = "-60px";
    }
  }

  function getCurrentDate(container) {
    const currentDate = new Date;
    const formattedDate = currentDate.toDateString();
    container.innerText = formattedDate;
  }

  function getCurrentTime(container) {
    const currentTime = new Date();
    const formattedTime = currentTime.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true });
    container.innerText = `${formattedTime} EST`;
  }

  // burger menu actions
  burgerMenu.addEventListener("click", () => {
    document
      .querySelector("#burger-overlay")
      .classList.toggle("burger-overlay-dim");
    document
      .querySelector(".header-nav")
      .classList.toggle("navigation-links-toggle");
    document
      .querySelector("#burger-bars-1")
      .classList.toggle("burger-bars-remove");
    document
      .querySelector("#burger-bars-2")
      .classList.toggle("burger-bars-rotate-clockwise");
    document
      .querySelector("#burger-bars-3")
      .classList.toggle("burger-bars-rotate-counter-clockwise");
  });

  // SIDE NAVIGATION DROPDOWNS
  teamsDropdownButton.addEventListener('click', () => {
    teamsDropdownContainer.children[0].classList.toggle('rotate');
    teamsDropdownList.classList.toggle('dropdown-list-toggle');
  });
  rosterDropdownButton.addEventListener('click', () => {
    rosterDropdownContainer.children[0].classList.toggle('rotate');
    rosterDropdownList.classList.toggle('dropdown-list-toggle');
  });
  teamSummaryDropdownButton.addEventListener('click', () => {
    teamSummaryDropdownContainer.children[0].classList.toggle('rotate');
    teamSummaryDropdownList.classList.toggle('dropdown-list-toggle');
  });
  howToDropdownButton.addEventListener('click', () => {
    howToDropdownContainer.children[0].classList.toggle('rotate');
    howToDropdownList.classList.toggle('dropdown-list-toggle');
  });
  aboutDropdownButton.addEventListener('click', () => {
    aboutDropdownContainer.children[0].classList.toggle('rotate');
    aboutDropdownList.classList.toggle('dropdown-list-toggle');
  });

  // scroll
  window.addEventListener("scroll", () => {
    activateUpArrow();
  });
  // resize
  window.addEventListener("resize", () => {
    activateUpArrow();
  });
  activateUpArrow();
  getCurrentDate(currentDate);
  getCurrentTime(currentTime);
  setInterval(() => {
    getCurrentTime(currentTime);
  }, 1000);
}

window.addEventListener('load', () => {
  loadScript();
});