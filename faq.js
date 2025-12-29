document.querySelectorAll('.faq-question').forEach((button) => {
    button.addEventListener('click', () => {
      const answer = button.nextElementSibling;
  
      // Toggle the visibility of the answer
      answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
  
      // Optionally toggle the button's active state
      button.classList.toggle('active');
    });
  });
  