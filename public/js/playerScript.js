function loadPlayerScript() {
  let rsRows = document.querySelectorAll('.regular-season-row');
  let poRows = document.querySelectorAll('.playoff-season-row');

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
}
window.addEventListener('load', () => {
  loadPlayerScript();
});