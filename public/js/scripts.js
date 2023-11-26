function loadScript() {
  const burgerMenu = document.querySelector(".burger-menu");
  const upArrow = document.querySelector(".up-arrow");
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
  // const teamSummaryDropdownContainer = document.querySelector('.team-summary-dropdown-container');
  // const teamSummaryDropdownButton = document.querySelector('.team-summary-dropdown-button');
  // const teamSummaryDropdownList = document.querySelector('.team-summary-dropdown-list');

  // about dropdown containers
  const aboutDropdownContainer = document.querySelector('.about-dropdown-container');
  const aboutDropdownButton = document.querySelector('.about-dropdown-button');
  const aboutDropdownList = document.querySelector('.about-dropdown-list');

  // how to dropdown containers
  const howToDropdownContainer = document.querySelector('.how-to-dropdown-container');
  const howToDropdownButton = document.querySelector('.how-to-dropdown-button');
  const howToDropdownList = document.querySelector('.how-to-dropdown-list');

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
  // teamSummaryDropdownButton.addEventListener('click', () => {
  //   teamSummaryDropdownContainer.children[0].classList.toggle('rotate');
  //   teamSummaryDropdownList.classList.toggle('dropdown-list-toggle');
  // });
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
  // loadCarousel();
});