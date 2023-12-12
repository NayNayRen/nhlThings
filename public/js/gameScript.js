function loadGameScript() {
  const checkGameState = document.querySelector('.game-state');
  const periods = document.querySelectorAll('.game-matchup-periods');

  periods.forEach((period) => {
    // console.log(period);
    if (period.childNodes.length === 13) {
      // shows SO
      // period.childNodes[1].style.display = 'none';
      // period.childNodes[3].style.display = 'none';
      // period.childNodes[5].style.display = 'none';
      // period.childNodes[7].style.display = 'none';
      period.childNodes[9].style.display = 'block';
    }
    // shows OT
    else if (period.childNodes.length === 11) {
      // period.childNodes[1].style.display = 'none';
      // period.childNodes[3].style.display = 'none';
      // period.childNodes[5].style.display = 'none';
      period.childNodes[7].style.display = 'block';
    }
    // shows 3rd period
    else if (period.childNodes.length === 9) {
      // period.childNodes[1].style.display = 'none';
      // period.childNodes[3].style.display = 'none';
      period.childNodes[5].style.display = 'block';
    }
    // shows 2nd period
    else if (period.childNodes.length === 7) {
      // period.childNodes[1].style.display = 'none';
      period.childNodes[3].style.display = 'block';
    }
    // shows 1st period
    else if (period.childNodes.length === 5) {
      period.childNodes[1].style.display = 'block';
    }
  });
  // highlights game winner
  if (checkGameState.innerText === 'OFF' || checkGameState.innerText === 'FINAL') {
    if (checkGameState.parentElement.childNodes[1].childNodes[3].innerText > checkGameState.parentElement.childNodes[1].childNodes[9].innerText) {
      checkGameState.parentElement.childNodes[1].childNodes[3].classList.add('game-matchup-winner');
    }
    else if (checkGameState.parentElement.childNodes[1].childNodes[3].innerText < checkGameState.parentElement.childNodes[1].childNodes[9].innerText) {
      checkGameState.parentElement.childNodes[1].childNodes[9].classList.add('game-matchup-winner');
    }
  }
  // console.log(checkGameState.parentElement.childNodes);
}

window.addEventListener('load', () => {
  loadGameScript();
});
