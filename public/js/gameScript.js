
function stickHeading() {
  const scrollPoint = document.querySelector('.game-matchup-scroll-point');
  const stickyHeading = document.querySelector('.sticky-heading');
  if (document.documentElement.scrollTop > 85 && window.innerWidth > 1000) {
    stickyHeading.style.position = "fixed";
    stickyHeading.style.width = "calc(85% - 34px)";
    stickyHeading.style.top = "95px";
    scrollPoint.style.paddingTop = "145px";
  }
  else if (document.documentElement.scrollTop > 55 && window.innerWidth < 1000 &&
    window.innerWidth > 700) {
    stickyHeading.style.position = "fixed";
    stickyHeading.style.width = "calc(100% - 40px)";
    stickyHeading.style.top = "95px";
    scrollPoint.style.paddingTop = "145px";
  }
  else if (document.documentElement.scrollTop > 0 && window.innerWidth < 700 && window.innerWidth > 400) {
    stickyHeading.style.position = "fixed";
    stickyHeading.style.width = "100%";
    stickyHeading.style.top = "85px";
    scrollPoint.style.paddingTop = "125px";
  }
  else if (document.documentElement.scrollTop > 0 && window.innerWidth < 400) {
    stickyHeading.style.position = "fixed";
    stickyHeading.style.width = "100%";
    stickyHeading.style.top = "110px";
    scrollPoint.style.paddingTop = "125px";
  }
  else {
    stickyHeading.style.position = "relative";
    stickyHeading.style.width = "100%";
    stickyHeading.style.top = "0";
    scrollPoint.style.paddingTop = "0";
  }
}

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
      checkGameState.parentElement.childNodes[1].childNodes[3].style.color = '#fff';
      checkGameState.parentElement.childNodes[1].childNodes[3].style.backgroundColor = '#b22222';
    }
    else if (checkGameState.parentElement.childNodes[1].childNodes[3].innerText < checkGameState.parentElement.childNodes[1].childNodes[9].innerText) {
      checkGameState.parentElement.childNodes[1].childNodes[9].style.color = '#fff';
      checkGameState.parentElement.childNodes[1].childNodes[9].style.backgroundColor = '#b22222';
    }
  }

  // console.log(checkGameState.parentElement.childNodes);

}
window.addEventListener('resize', () => {
  stickHeading();
});

window.addEventListener('scroll', () => {
  stickHeading();
});

window.addEventListener('load', () => {
  loadGameScript();
  stickHeading();
});
