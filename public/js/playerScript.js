function loadPlayerScript() {
  let rsRows = document.querySelectorAll('.regular-season-row');
  let poRows = document.querySelectorAll('.playoff-season-row');
  const main = document.querySelector('.main');
  const mainContainer = document.querySelector('.main-container');
  const playerHeroImage = document.querySelector('.player-hero-image').innerText;

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

  // each player awards dropdown button
  $(document).on('click', '.player-award-dropdown-button', function () {
    // console.log($(this)[0].parentElement.childNodes);
    $(this)[0].parentElement.childNodes[1].classList.toggle('rotate');
    $(this)[0].parentElement.childNodes[6].classList.toggle('player-award-toggle');
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
}
window.addEventListener('load', () => {
  loadPlayerScript();
});