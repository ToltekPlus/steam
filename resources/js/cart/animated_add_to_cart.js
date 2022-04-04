const animateButton = function (e) {
  e.preventDefault();
  e.target.classList.remove('animate');

  e.target.classList.add('animate');
  setTimeout(function () {
    e.target.classList.remove('animate');
  }, 700);
};

const bubblyButtons = document.querySelectorAll('.buy');
for (const bubblyButton of bubblyButtons) {
  bubblyButton.addEventListener('click', animateButton, false);
}
