function loadGameScript() {
  let checkGameState = document.querySelectorAll('.game-state');
  const periods = document.querySelectorAll('.game-matchup-periods');

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
}

window.addEventListener('load', () => {
  loadGameScript();
});
