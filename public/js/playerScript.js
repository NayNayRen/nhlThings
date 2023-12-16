function loadPlayerScript() {
  let rsRows = document.querySelectorAll('.regular-season-row');
  let poRows = document.querySelectorAll('.playoff-season-row');
  const main = document.querySelector('.main');
  const mainContainer = document.querySelector('.main-container');
  const playerHeroImage = document.querySelector('.player-hero-image').innerText;
  const awardsButton = document.querySelector('.player-award-dropdown-button');
  const awardsDropdownContainer = document.querySelector('.awards');
  const draftButton = document.querySelector('.player-draft-dropdown-button');
  const draftDropdownContainer = document.querySelector('.draft');


  rsRows.forEach((rsRow) => {
    // console.log(rsRow);
    poRows.forEach((poRow) => {
      // console.log(poRow);
      let poMarker = document.createElement('span');
      if (rsRow.childNodes[1].childNodes[3].innerText === poRow.childNodes[1].childNodes[3].innerText) {
        poMarker.classList.add('playoff-season-marker');
        rsRow.childNodes[1].appendChild(poMarker);
      }
    });
  });

  main.style.backgroundPosition = 'top';
  main.style.backgroundSize = 'cover';
  main.style.backgroundImage = `
  -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(0, 0, 0, 0.9)),
    to(rgba(0, 0, 0, 0.5))
),
url(${playerHeroImage})`;
  main.style.backgroundImage = `
  linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.9),
    rgba(0, 0, 0, 0.5)
),
  url(${playerHeroImage})`;

  mainContainer.style.backgroundPosition = 'top';
  mainContainer.style.backgroundSize = 'cover';
  mainContainer.style.backgroundImage = `
  -webkit-gradient(
    linear,
    left top,
    right top,
    from(rgba(245, 245, 245, 1)),
    to(rgba(245, 245, 245, 0.65))
),
url(${playerHeroImage})`;
  mainContainer.style.backgroundImage = `
  linear-gradient(
      90deg,
      rgba(245, 245, 245, 1),
      rgba(245, 245, 245, 0.65)
  ),
  url(${playerHeroImage})`;

  // each player awards dropdown button
  awardsButton.addEventListener('click', () => {
    awardsButton.childNodes[1].classList.toggle('rotate');
    awardsDropdownContainer.classList.toggle('transition-container-toggle');
    // console.log(awardsDropdownContainer);
  });
  // each player draft dropdown button
  draftButton.addEventListener('click', () => {
    draftButton.childNodes[1].classList.toggle('rotate');
    draftDropdownContainer.classList.toggle('transition-container-toggle');
    // console.log(awardsDropdownContainer);
  });
}
window.addEventListener('load', () => {
  loadPlayerScript();
});