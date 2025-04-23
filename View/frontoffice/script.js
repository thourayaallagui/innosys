// Script pour interactions futures (dropdown, animation, etc.)
document.addEventListener('DOMContentLoaded', () => {
    console.log("Template loaded!");
  });
  document.addEventListener('DOMContentLoaded', () => {
    // Scroll smooth vers la section About
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({
            behavior: 'smooth'
          });
        }
      });
    });
  });
  