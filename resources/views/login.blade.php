<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Health & Fitness</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <style>
        /* ==================== RESET ==================== */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* ==================== TOÀN TRANG ==================== */
body {
  font-family: "Segoe UI", sans-serif;
  background: linear-gradient(135deg, #6a5bff, #00b4ff);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  color: #222;
  animation: bgMove 8s infinite alternate ease-in-out;
}

/* Hiệu ứng chuyển màu nền */
@keyframes bgMove {
  0% { background: linear-gradient(135deg, #6a5bff, #00b4ff); }
  100% { background: linear-gradient(135deg, #764bff, #00c8ff); }
}

/* ==================== KHUNG CHÍNH ==================== */
.login-wrapper {
  width: 100%;
  padding: 20px;
}

.login-card {
  position: relative;
  background: #fff;
  border-radius: 22px;
  box-shadow: 0 10px 28px rgba(0, 0, 0, 0.18);
  max-width: 420px;
  margin: 0 auto;
  padding: 50px 35px 40px;
  text-align: center;
  animation: fadeIn 0.8s ease;
  transition: 0.3s ease-in-out;
}

/* 🔥 Hiệu ứng khi di chuột vào khung */
.login-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 16px 34px rgba(0, 0, 0, 0.22);
}

/* ==================== NÚT THOÁT (X) ==================== */
.btn-exit {
  position: absolute;
  top: 15px;
  right: 20px;
  width: 36px;
  height: 36px;
  background: #f2f3ff;
  border: 1.5px solid #d0d0ff;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #666;
  font-size: 18px;
  font-weight: bold;
  text-decoration: none;
  transition: 0.3s ease;
}

.btn-exit::before { content: "✕"; }

/* Hover X */
.btn-exit:hover {
  background: #e5e6ff;
  color: #2a2ae6;
  transform: rotate(90deg);
}

/* ==================== HEADER ==================== */
.login-header .logo {
  width: 80px;
  margin-bottom: 14px;
}

.login-header h2 {
  color: #5b3ff6;
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 6px;
}

.login-header p {
  color: #666;
  font-size: 1rem;
}

/* ==================== FORM ==================== */
.login-form {
  margin-top: 12px;
}

.form-group {
  margin-top: 18px;
  position: relative;
}

/* Input */
input {
  width: 100%;
  padding: 13px 15px;
  border: 1.5px solid #ddd;
  border-radius: 9px;
  font-size: 15px;
  outline: none;
  transition: 0.3s ease;
}

/* Hiệu ứng hover input */
input:hover {
  border-color: #8c76ff;
}

/* Hiệu ứng focus input */
input:focus {
  border-color: #5b3ff6;
  box-shadow: 0 0 8px rgba(91, 63, 246, 0.4);
  transform: scale(1.02);
}

/* Icon hiển thị mật khẩu */
.toggle-pass {
  position: absolute;
  top: 50%;
  right: 12px;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 18px;
  opacity: 0.6;
  transition: 0.25s;
}

.toggle-pass:hover {
  opacity: 1;
  transform: translateY(-50%) scale(1.2);
}

/* ==================== NÚT ĐĂNG NHẬP ==================== */
.btn-login {
  width: 100%;
  margin-top: 24px;
  background: linear-gradient(135deg, #6a5bff, #00b4ff);
  border: none;
  color: #fff;
  padding: 13px;
  border-radius: 9px;
  font-size: 1.05rem;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s ease;
  box-shadow: 0 4px 12px rgba(91, 63, 246, 0.35);
}

/* Hover button hiệu ứng nổi */
.btn-login:hover {
  background: linear-gradient(135deg, #5835ff, #009be0);
  transform: translateY(-3px);
  box-shadow: 0 8px 18px rgba(91, 63, 246, 0.45);
}

/* ==================== THÔNG BÁO LỖI ==================== */
.error-message {
  background-color: rgba(255, 0, 0, 0.12);
  color: #d8000c;
  border-left: 4px solid #d8000c;
  padding: 10px 12px;
  border-radius: 6px;
  margin: 18px 0;
  text-align: left;
  font-size: 0.9rem;
  animation: shake 0.4s ease;
}

/* ==================== LINK ĐĂNG KÝ ==================== */
.register-link {
  margin-top: 22px;
  font-size: 0.95rem;
  color: #555;
}

.register-link a {
  color: #5b3ff6;
  font-weight: 600;
  text-decoration: none;
  transition: 0.25s;
}

/* Hover link đăng ký */
.register-link a:hover {
  text-decoration: underline;
  color: #2a2ae6;
}

/* ==================== HIỆU ỨNG ==================== */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(25px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  20%, 60% { transform: translateX(-5px); }
  40%, 80% { transform: translateX(5px); }
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 480px) {
  .login-card {
    padding: 35px 25px 30px;
    max-width: 90%;
  }

  .login-header h2 { font-size: 1.7rem; }

  input, .btn-login { font-size: 0.95rem; }

  .btn-exit {
    top: 10px;
    right: 12px;
    width: 30px;
    height: 30px;
  }
}
/* Hiệu ứng input sai */
.input-error {
  border-color: red !important;
  animation: shake 0.3s ease;
}

/* Icon show pass click effect */
.toggle-pass.tap {
  transform: translateY(-50%) scale(1.3);
}

/* ENERGY PULSE BUTTON */
.pulse-effect {
  animation: pulseEnergy 0.45s ease-out;
}

@keyframes pulseEnergy {
  0% { transform: scale(1); box-shadow: 0 0 0 rgba(91, 63, 246, 0.3); }
  50% { transform: scale(1.06); box-shadow: 0 0 18px rgba(91, 63, 246, 0.6); }
  100% { transform: scale(1); box-shadow: 0 0 0 rgba(91, 63, 246, 0); }
}
/* 🔵 Bubble cursor */
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

/* 😵 Input lỗi lắc lư */
.input-error {
  animation: shake 0.25s ease;
  border-color: red !important;
}

/* 🔥 Nút nhảy tránh bắt */
.btn-login {
  position: relative;
}

    </style>
</head>
<body>
    
    <div class="login-wrapper">
        <div class="login-card">
            <a href="{{ url('/') }}" class="btn-exit" title="Thoát"></a>
            <div class="login-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <h2>Đăng nhập tài khoản</h2>
                <p>Chào mừng bạn quay lại 💪</p>
            </div>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <input type="username" name="name" placeholder="Nhập Tên Đăng Nhập" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="🔒 Nhập mật khẩu" required>
                </div>

                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>

            <div class="register-link">
                <p>Chưa có tài khoản? <a href="{{ route('register.show') }}">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
    <script>
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
    </script>
</body>
</html>
