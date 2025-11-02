document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".login-form");
    const emailInput = document.querySelector("input[name='email']");
    const passInput = document.querySelector("input[name='password']");
    const btnLogin = document.querySelector(".btn-login");

    /* ---------------------- Hiệu ứng Welcome Fade-in ---------------------- */
    document.querySelector(".login-card").style.opacity = "0";
    setTimeout(() => {
        document.querySelector(".login-card").style.transition = "0.6s";
        document.querySelector(".login-card").style.opacity = "1";
        document.querySelector(".login-card").style.transform = "scale(1)";
    }, 150);

    /* ---------------------- Icon hiện/ẩn mật khẩu ---------------------- */
    const toggleBtn = document.createElement("span");
    toggleBtn.innerHTML = "👁️";
    toggleBtn.classList.add("toggle-pass");
    passInput.parentElement.style.position = "relative";
    passInput.parentElement.appendChild(toggleBtn);

    toggleBtn.addEventListener("click", () => {
        const type = passInput.getAttribute("type") === "password" ? "text" : "password";
        passInput.setAttribute("type", type);
        toggleBtn.innerHTML = type === "password" ? "👁️" : "🙈";
        toggleBtn.classList.add("tap");

        setTimeout(() => toggleBtn.classList.remove("tap"), 200);
    });

    /* ---------------------- Placeholder Auto Typing ---------------------- */
    const placeholders = ["📧 Nhập email", "example@gmail.com", "youremail@domain.com"];
    let i = 0;
    setInterval(() => {
        emailInput.setAttribute("placeholder", placeholders[i]);
        i = (i + 1) % placeholders.length;
    }, 2500);

    /* ---------------------- Validate input ---------------------- */
    function isValidEmail(email) {
        return /^\S+@\S+\.\S+$/.test(email);
    }

    form.addEventListener("submit", function (e) {
        let errorMsg = "";

        if (!isValidEmail(emailInput.value.trim())) {
            errorMsg = "⚠️ Email không hợp lệ!";
            emailInput.classList.add("input-error");
        } else if (passInput.value.trim().length < 6) {
            errorMsg = "🔑 Mật khẩu phải ít nhất 6 ký tự!";
            passInput.classList.add("input-error");
        }

        if (errorMsg !== "") {
            e.preventDefault();
            showError(errorMsg);
            setTimeout(() => {
                emailInput.classList.remove("input-error");
                passInput.classList.remove("input-error");
            }, 900);
            return;
        }

        createEnergyPulse(btnLogin);
        btnLogin.disabled = true;
        btnLogin.innerText = "Đang xử lý...";
    });

    /* ---------------------- Hiển thị lỗi ---------------------- */
    function showError(msg) {
        let alert = document.querySelector(".alert-js");
        if (!alert) {
            alert = document.createElement("div");
            alert.className = "error-message alert-js";
            form.parentElement.insertBefore(alert, form);
        }
        alert.innerHTML = msg;
        alert.style.display = "block";

        setTimeout(() => {
            alert.style.display = "none";
        }, 3500);
    }

    /* ---------------------- ENERGY PULSE BUTTON EFFECT ---------------------- */
    function createEnergyPulse(button) {
        button.classList.add("pulse-effect");
        setTimeout(() => button.classList.remove("pulse-effect"), 500);
    }


    /* ====================================================== */
    /* ✅ BUBBLE FOLLOW MOUSE – Bong bóng chạy theo con chuột */
    /* ====================================================== */
    const bubble = document.createElement("div");
    bubble.classList.add("bubble-cursor");
    document.body.appendChild(bubble);

    document.addEventListener("mousemove", (e) => {
        bubble.style.left = e.clientX + "px";
        bubble.style.top = e.clientY + "px";
    });


    /* ===================================================================== */
    /* 🎮 MINI GAME: NÚT LOGIN CHẠY TRỐN NẾU NGƯỜI DÙNG CHƯA NHẬP ĐỦ THÔNG TIN */
    /* ===================================================================== */
    let moveCount = 0;

    btnLogin.addEventListener("mouseover", function () {
        const emailValid = isValidEmail(emailInput.value.trim());
        const passValid = passInput.value.trim().length >= 6;

        if (emailValid && passValid) return; // ✅ Đúng đủ thì không chạy
        
        moveCount++;
        const card = document.querySelector(".login-card");

        const randomX = Math.random() * 200 - 100; 
        const randomY = Math.random() * 120 - 60;

        btnLogin.style.transform = `translate(${randomX}px, ${randomY}px)`;
        btnLogin.style.transition = "0.25s";

        if (moveCount === 3) showError("😆 Bắt được nút rồi, điền thông tin đi!");
    });
});