document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("menu");

  toggle.addEventListener("click", () => {
    menu.classList.toggle("show");
  });
});
// Safer slideshow script (wait DOM ready)
document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".slideshow-section .slide");
  let index = 0;

  function showSlide(i) {
    slides.forEach((slide, j) => slide.classList.toggle("active", i === j));
  }

  setInterval(() => {
    index = (index + 1) % slides.length;
    showSlide(index);
  }, 5000); // đổi ảnh mỗi 5 giây
});
