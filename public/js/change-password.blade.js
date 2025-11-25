// Nút đổi chế độ nền
const btn = document.getElementById("toggleBtn");

btn.addEventListener("click", () => {
    document.body.classList.toggle("dark");
});
