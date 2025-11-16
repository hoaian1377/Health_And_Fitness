document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("userMenuToggle");
    const dropdown = document.getElementById("userDropdown");
    const wrapper = document.querySelector(".user-dropdown");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            wrapper.classList.toggle("open");
        });
    }

    // Bấm ra ngoài để đóng
    document.addEventListener("click", (e) => {
        if (!wrapper.contains(e.target)) {
            wrapper.classList.remove("open");
        }
    });
});
