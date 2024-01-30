function loadErrorScript() {
  const upArrow = document.querySelector(".up-arrow");
  const currentDate = document.querySelector('.current-date');
  const currentTime = document.querySelector('.current-time');

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
  loadErrorScript();
});