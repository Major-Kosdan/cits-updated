const courseInfo = document.querySelector('.course-info');
const whoWeAreSection = document.querySelector('.who-we-are');

// Listen to scroll event
window.addEventListener('scroll', function() {
  const whoWeAreRect = whoWeAreSection.getBoundingClientRect();

  // If user scrolls past the top of the .who-we-are section
  if (whoWeAreRect.top <= 0 && whoWeAreRect.bottom > 0) {
    // Make course-info fixed on the screen
    courseInfo.classList.add('fixed');
    courseInfo.classList.remove('hidden');
  } 
  // When user scrolls past the entire .who-we-are section
  else if (whoWeAreRect.bottom <= 0) {
    courseInfo.classList.add('hidden'); // Hide it after passing the entire section
  } 
  else {
    // If still inside the .who-we-are section, keep it in the original position
    courseInfo.classList.remove('fixed');
    courseInfo.classList.remove('hidden');
  }
});
