// JavaScript to toggle accordion items
const headers = document.querySelectorAll('.accordion-header');

headers.forEach(header => {
  header.addEventListener('click', () => {
    const currentlyActive = document.querySelector('.accordion-header.active');
    if (currentlyActive && currentlyActive !== header) {
      currentlyActive.classList.remove('active');
      currentlyActive.nextElementSibling.style.display = 'none';
    }

    header.classList.toggle('active');
    const content = header.nextElementSibling;
    content.style.display = header.classList.contains('active') ? 'block' : 'none';
  });
});
