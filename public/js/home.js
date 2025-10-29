document.addEventListener("DOMContentLoaded", () => {
  // ===== Menu Toggle =====
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu");
  if (toggle) {
    toggle.addEventListener("click", () => {
      menu.classList.toggle("show");
    });
  }

  // ===== Slideshow =====
  const slides = document.querySelectorAll(".slideshow-section .slide");
  let index = 0;
  const showSlide = (i) => {
    slides.forEach((s, j) => s.classList.toggle("active", i === j));
  };
  setInterval(() => {
    index = (index + 1) % slides.length;
    showSlide(index);
  }, 5000);

  // ===== Scroll Reveal =====
  const reveal = () => {
    const items = document.querySelectorAll(".reveal");
    const windowHeight = window.innerHeight;
    items.forEach((el) => {
      const top = el.getBoundingClientRect().top;
      if (top < windowHeight - 100) el.classList.add("active");
    });
  };
  window.addEventListener("scroll", reveal);
  reveal();
});