const dropdowns = document.querySelectorAll('.dropdown:not(.is-hoverable)');
if (dropdowns.length > 0) {
  // For each dropdown, add event handler to open on click.
  for (const el of dropdowns) {
    el.addEventListener('click', function (e) {
      e.stopPropagation();
      el.classList.toggle('is-active');
    });
  }

  // If user clicks outside dropdown, close it.
  document.addEventListener('click', function (e) {
    closeDropdowns();
  });
}

/*
 * Close dropdowns by removing `is-active` class.
 */
function closeDropdowns() {
  for (const el of dropdowns) {
    el.classList.remove('is-active');
  }
}

// Close dropdowns if ESC pressed
document.addEventListener('keydown', function (event) {
  const e = event || window.event;
  if (e.key === 'Esc' || e.key === 'Escape') {
    closeDropdowns();
  }
});
