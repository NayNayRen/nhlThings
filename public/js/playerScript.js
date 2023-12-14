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
  // console.log(playerHeroImage);
  main.style.backgroundPosition = 'top';
  main.style.backgroundSize = 'cover';
  main.style.backgroundImage = `
  linear-gradient(
    90deg,
    rgba(0, 0, 0, 0.85),
    rgba(0, 0, 0, 0.5)
),
  url(${playerHeroImage})`;
  mainContainer.style.backgroundPosition = 'top';
  mainContainer.style.backgroundSize = 'cover';
  mainContainer.style.backgroundImage = `
  linear-gradient(
      90deg,
      rgba(245, 245, 245, 1),
      rgba(245, 245, 245, 0.75)
  ),
  url(${playerHeroImage})`;
}
window.addEventListener('load', () => {
  loadPlayerScript();
});