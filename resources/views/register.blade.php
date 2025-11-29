<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký tài khoản</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  <style>
    /* ==================== TOÀN TRANG ==================== */
body {
  font-family: "Segoe UI", sans-serif;
  background: linear-gradient(135deg, #5b3ff6, #00b4ff);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  margin: 0;
  color: #222;
}

/* ==================== KHUNG FORM ==================== */
.register-container {
  position: relative; /* ✅ để đặt nút Thoát trong khung */
  width: 400px;
  background-color: #ffffff;
  border-radius: 16px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  padding: 45px 30px 40px;
  text-align: center;
  animation: fadeIn 0.6s ease;
  overflow: hidden;
}

/* ==================== NÚT X THOÁT ==================== */
.btn-exit {
  position: absolute;
  top: 15px;
  right: 20px;
  width: 34px;
  height: 34px;
  background: #f2f3ff;
  border: 1.5px solid #d0d0ff;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #555;
  font-size: 18px;
  font-weight: bold;
  text-decoration: none;
  transition: all 0.3s ease;
  z-index: 2;
}

.btn-exit::before {
  content: "✕";
}

.btn-exit:hover {
  background: #e1e3ff;
  color: #2a2ae6;
  transform: rotate(90deg);
}

/* ==================== TIÊU ĐỀ ==================== */
.register-container h2 {
  color: #2a2ae6;
  font-weight: 700;
  margin-bottom: 25px;
  font-size: 1.8rem;
}

/* ==================== NHÓM Ô NHẬP ==================== */
.input-group {
  position: relative;
  margin: 12px 0;
}

.input-group .icon {
  position: absolute;
  left: 14px;
  top: 50%;
  transform: translateY(-50%);
  font-size: 18px;
  color: #6b6fb1;
}

.input-group input {
  width: 100%;
  padding: 12px 14px 12px 42px; /* chừa chỗ cho icon */
  border: 1.5px solid #cdd2ff;
  border-radius: 8px;
  font-size: 15px;
  outline: none;
  transition: all 0.3s ease;
  background: #f9faff;
  box-sizing: border-box;
}

.input-group input:focus {
  border-color: #3b4bff;
  box-shadow: 0 0 6px rgba(59, 75, 255, 0.3);
  background: #fff;
}

/* ==================== NÚT ĐĂNG KÝ ==================== */
button {
  width: 100%;
  padding: 12px;
  background: linear-gradient(135deg, #3b4bff, #2a2ae6);
  color: #fff;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  cursor: pointer;
  margin-top: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(59, 75, 255, 0.25);
}

button:hover {
  background: linear-gradient(135deg, #2a2ae6, #1b1bbf);
  transform: translateY(-2px);
  box-shadow: 0 6px 14px rgba(59, 75, 255, 0.35);
}

/* ==================== LIÊN KẾT (ĐĂNG NHẬP) ==================== */
p {
  margin-top: 18px;
  color: #666;
  font-size: 14px;
}

a {
  color: #2a2ae6;
  font-weight: 600;
  text-decoration: none;
  transition: 0.3s;
}

a:hover {
  text-decoration: underline;
  color: #1b1bbf;
}

/* ==================== HỘP BÁO LỖI ==================== */
.error-box {
  background: #ffe5e5;
  color: #c0392b;
  padding: 10px 12px;
  border-radius: 8px;
  font-size: 14px;
  margin-bottom: 15px;
  text-align: left;
  border-left: 4px solid #c0392b;
  animation: shake 0.4s ease;
}

/* ==================== HIỆU ỨNG ==================== */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20%, 60% { transform: translateX(-5px); }
  40%, 80% { transform: translateX(5px); }
}

/* ==================== RESPONSIVE CHO ĐIỆN THOẠI ==================== */
@media (max-width: 480px) {
  .register-container {
    width: 90%;
    padding: 30px 20px 25px;
  }

  .register-container h2 {
    font-size: 1.5rem;
  }

  input, button {
    font-size: 15px;
  }

  .input-group .icon {
    font-size: 16px;
    left: 12px;
  }

  .btn-exit {
    top: 10px;
    right: 12px;
    width: 30px;
    height: 30px;
  }
}
/* Bubble */
.bubble-cursor {
  position: fixed;
  width: 18px;
  height: 18px;
  background: rgba(91, 63, 246, 0.35);
  border-radius: 50%;
  pointer-events: none;
  transform: translate(-50%, -50%);
  transition: 0.07s linear;
  z-index: 9999;
}

.toggle-pass {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 17px;
  opacity: 0.7;
  transition: 0.2s;
}

.toggle-pass:hover {
  opacity: 1;
  transform: translateY(-50%) scale(1.15);
}

.toggle-pass.tap {
  transform: translateY(-50%) scale(0.8);
}

/* input shake lỗi */
.input-error {
  animation: shake 0.25s ease;
  border-color: red !important;
}

  </style>
</head>
<body>
  <div class="register-container">
    <a href="{{ url('/') }}" class="btn-exit" title="Thoát"></a>
    <h2>✨ Tạo tài khoản mới</h2>

    @if ($errors->any())
      <div class="error-box">
        @foreach ($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
      </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
      @csrf
      <div class="input-group">
        <span class="icon">👤</span>
        <input type="text" name="name" placeholder="Tên Đăng Nhập" required>
      </div>

      <div class="input-group">
        <span class="icon">📧</span>
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <span class="icon">🔒</span>
        <input type="password" name="password" placeholder="Mật khẩu" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}" title="Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.">
      </div>
      <small style="display: block; margin-bottom: 15px; color: #666; font-size: 12px; padding-left: 10px;">
        * Mật khẩu tối thiểu 8 ký tự, 1 chữ in hoa, 1 ký tự đặc biệt.
      </small>

      <div class="input-group">
        <span class="icon">🔁</span>
        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
      </div>

      <button type="submit">Đăng ký ngay</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login.show') }}">Đăng nhập</a></p>
  </div>
  <script>
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

  </script>
</body>
</html>
