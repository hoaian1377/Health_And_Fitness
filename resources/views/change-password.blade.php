<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #6a5bff, #00b4ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Card Form */
        .modal-container {
            width: 100%;
            max-width: 480px;
            border-radius: 20px;
            padding: 0;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.2);
            animation: fadeUp 0.55s ease-out;
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-header {
            background: linear-gradient(135deg, #4a6cf7 0%, #6a11cb 100%);
            padding: 28px;
            text-align: center;
            color: #fff;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
        }

        .modal-body {
            padding: 32px;
        }

        .form-group { 
            margin-bottom: 24px; 
        }

        label {
            font-size: 14px;
            font-weight: 600;
            color: #444;
        }

        .required {
            color: #ef4444;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 48px 12px 16px;
            margin-top: 8px;
            border-radius: 12px;
            border: 1.8px solid #d1d5db;
            background: #f8fafc;
            font-size: 15px;
            outline: none;
            transition: 0.25s;
        }

        .form-control:focus {
            border-color: #6a11cb;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(106, 17, 203, 0.15);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 63%;
            transform: translateY(-50%);
            cursor: pointer;
            background: none;
            border: none;
            color: #999;
            font-size: 16px;
            transition: 0.25s;
        }

        .toggle-password:hover {
            color: #6a11cb;
        }

        .error-message {
            font-size: 13px;
            margin-top: 6px;
            color: #ef4444;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        /* Strength bar */
        .strength-meter {
            height: 5px;
            background: #e5e7eb;
            margin-top: 8px;
            border-radius: 3px;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0%;
            border-radius: 3px;
            transition: 0.3s ease;
        }

        .strength-weak { background: #ef4444; width: 33%; }
        .strength-medium { background: #f59e0b; width: 66%; }
        .strength-strong { background: #10b981; width: 100%; }

        .strength-text {
            font-size: 12px;
            margin-top: 6px;
            color: #555;
        }

        .btn-submit {
            width: 100%;
            margin-top: 8px;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.25s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(106, 17, 203, 0.4);
        }

        .btn-submit:disabled {
            background: #a3a3a3;
            box-shadow: none;
            cursor: not-allowed;
        }

        .back-link {
            margin-top: 24px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
            color: #555;
            transition: 0.25s;
        }

        .back-link:hover { 
            color: #6a11cb;
        }

        /* Notification */
        .notification {
            position: fixed;
            right: 20px;
            top: 20px;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            animation: slideIn 0.45s ease;
            color: #fff;
            z-index: 50;
        }

        .notification.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .notification.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>

<body>

    <div class="modal-container">
        <div class="modal-header">
            <h2 class="modal-title">Đổi mật khẩu</h2>
        </div>

        <div class="modal-body">

            <form id="change-password-form">
                @csrf

                <!-- Mật khẩu cũ -->
                <div class="form-group">
                    <label>Mật khẩu cũ <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" id="old-password" class="form-control" placeholder="Nhập mật khẩu hiện tại">
                        <button type="button" class="toggle-password" data-target="old-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div id="old-password-error" class="error-message"></div>
                </div>

                <!-- Mật khẩu mới -->
                <div class="form-group">
                    <label>Mật khẩu mới <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" id="new-password" class="form-control" placeholder="Nhập mật khẩu mới">
                        <button type="button" class="toggle-password" data-target="new-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>

                    <div class="strength-meter">
                        <div id="strength-meter" class="strength-meter-fill"></div>
                    </div>
                    <div id="strength-text" class="strength-text"></div>

                    <div id="new-password-error" class="error-message"></div>
                </div>

                <!-- Xác nhận -->
                <div class="form-group">
                    <label>Xác nhận mật khẩu <span class="required">*</span></label>
                    <div class="input-wrapper">
                        <input type="password" id="confirm-password" class="form-control" placeholder="Nhập lại mật khẩu mới">
                        <button type="button" class="toggle-password" data-target="confirm-password">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    <div id="confirm-password-error" class="error-message"></div>
                </div>

                <button class="btn-submit" type="submit">Đổi mật khẩu</button>

                <div style="text-align:center;">
                    <a href="{{ route('profile.page') }}" class="back-link">
                        <i class="fa fa-arrow-left"></i> Quay lại trang cá nhân
                    </a>
                </div>
            </form>

        </div>
    </div>

    <!-- JS giữ nguyên logic -->
    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = document.getElementById(btn.dataset.target);
                const icon = btn.querySelector("i");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                }
            });
        });

        // Password strength meter
        const newPasswordInput = document.getElementById("new-password");
        const strengthMeter = document.getElementById("strength-meter");
        const strengthText = document.getElementById("strength-text");

        newPasswordInput.addEventListener("input", () => {
            const val = newPasswordInput.value;
            const strength = calculateStrength(val);

            strengthMeter.className = "strength-meter-fill";

            if (!val.length) {
                strengthMeter.style.width = "0";
                strengthText.textContent = "";
            } else if (strength < 3) {
                strengthMeter.classList.add("strength-weak");
                strengthText.textContent = "Mật khẩu yếu";
            } else if (strength < 5) {
                strengthMeter.classList.add("strength-medium");
                strengthText.textContent = "Mật khẩu trung bình";
            } else {
                strengthMeter.classList.add("strength-strong");
                strengthText.textContent = "Mật khẩu mạnh";
            }
        });

        function calculateStrength(pw) {
            let s = 0;
            if (pw.length >= 8) s++;
            if (pw.length >= 12) s++;
            if (/[a-z]/.test(pw) && /[A-Z]/.test(pw)) s++;
            if (/\d/.test(pw)) s++;
            if (/[^a-zA-Z0-9]/.test(pw)) s++;
            return s;
        }
    </script>
</body>
</html>
