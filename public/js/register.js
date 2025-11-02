document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const nameInput = document.querySelector("input[name='name']");
    const emailInput = document.querySelector("input[name='email']");
    const passInput = document.querySelector("input[name='password']");
    const confirmInput = document.querySelector("input[name='password_confirmation']");
    const btnRegister = document.querySelector("button[type='submit']");

    /* ---------------------- Fade-in Form ---------------------- */
    const card = document.querySelector(".register-container");
    card.style.opacity = "0";
    setTimeout(() => {
        card.style.transition = "0.6s";
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
    }, 120);

    /* ---------------------- Show/Hide Password ---------------------- */
    function addToggleIcon(input) {
        const icon = document.createElement("span");
        icon.innerHTML = "👁️";
        icon.classList.add("toggle-pass");
        input.parentElement.style.position = "relative";
        input.parentElement.appendChild(icon);

        icon.addEventListener("click", () => {
            const type = input.getAttribute("type") === "password" ? "text" : "password";
            input.setAttribute("type", type);
            icon.innerHTML = type === "password" ? "👁️" : "🙈";
            icon.classList.add("tap");
            setTimeout(() => icon.classList.remove("tap"), 180);
        });
    }
    addToggleIcon(passInput);
    addToggleIcon(confirmInput);

    /* ---------------------- Placeholder Auto Typing ---------------------- */
    const placeholders = ["📧 Email của bạn", "example@gmail.com", "name@domain.com"];
    let i = 0;
    setInterval(() => {
        emailInput.setAttribute("placeholder", placeholders[i]);
        i = (i + 1) % placeholders.length;
    }, 2500);

    /* ---------------------- Validate ---------------------- */
    const isValidEmail = (email) => /^\S+@\S+\.\S+$/.test(email);

    form.addEventListener("submit", function (e) {
        let msg = "";

        if (nameInput.value.trim().length < 2) {
            msg = "⚠️ Họ tên phải ít nhất 2 ký tự!";
            nameInput.classList.add("input-error");
        } else if (!isValidEmail(emailInput.value.trim())) {
            msg = "📮 Email không hợp lệ!";
            emailInput.classList.add("input-error");
        } else if (passInput.value.trim().length < 6) {
            msg = "🔑 Mật khẩu phải ≥ 6 ký tự!";
            passInput.classList.add("input-error");
        } else if (passInput.value !== confirmInput.value) {
            msg = "❌ Mật khẩu nhập lại không khớp!";
            confirmInput.classList.add("input-error");
        }

        if (msg !== "") {
            e.preventDefault();
            showError(msg);
            setTimeout(() => {
                nameInput.classList.remove("input-error");
                emailInput.classList.remove("input-error");
                passInput.classList.remove("input-error");
                confirmInput.classList.remove("input-error");
            }, 800);
            return;
        }

        // Efffect khi đăng ký
        createEnergyPulse(btnRegister);
        btnRegister.disabled = true;
        btnRegister.innerText = "⏳ Đang tạo tài khoản...";
    });

    function showError(msg) {
        let box = document.querySelector(".alert-js");
        if (!box) {
            box = document.createElement("div");
            box.className = "error-box alert-js";
            form.parentElement.insertBefore(box, form);
        }
        box.innerHTML = msg;
        box.style.display = "block";
        setTimeout(() => (box.style.display = "none"), 3500);
    }

    /* ---------------------- Energy Pulse Effect ---------------------- */
    function createEnergyPulse(btn) {
        btn.classList.add("pulse-effect");
        setTimeout(() => btn.classList.remove("pulse-effect"), 500);
    }

    /* ---------------------- Mini Game: Nút chạy trốn ---------------------- */
    let moveCount = 0;
    btnRegister.addEventListener("mouseenter", () => {
        if (
            nameInput.value.trim().length < 2 ||
            !isValidEmail(emailInput.value.trim()) ||
            passInput.value.trim().length < 6 ||
            passInput.value !== confirmInput.value
        ) {
            moveCount++;
            let x = Math.random() * 120 - 60;
            let y = Math.random() * 60 - 30;
            btnRegister.style.transform = `translate(${x}px, ${y}px)`;

            if (moveCount === 5) {
                btnRegister.innerText = "😵 Tha tui đi mà!";
            }
        }
    });

    /* ---------------------- Bubbles Follow Mouse ---------------------- */
    document.addEventListener("mousemove", (e) => {
        const bubble = document.createElement("span");
        bubble.className = "bubble";
        bubble.style.left = e.pageX + "px";
        bubble.style.top = e.pageY + "px";
        document.body.appendChild(bubble);
        setTimeout(() => bubble.remove(), 900);
    });
});
