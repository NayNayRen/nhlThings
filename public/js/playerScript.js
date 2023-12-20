function loadPlayerScript() {
  let rsRows = document.querySelectorAll('.regular-season-row');
  let poRows = document.querySelectorAll('.playoff-season-row');
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