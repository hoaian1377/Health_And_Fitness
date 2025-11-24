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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 480px;
            overflow: hidden;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            padding: 24px 28px;
            text-align: center;
            position: relative;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        .modal-body {
            padding: 32px 28px;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .required {
            color: #ef4444;
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 12px 44px 12px 16px;
            font-size: 15px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
            background: #f9fafb;
        }

        .form-control:focus {
            border-color: #17a2b8;
            background: white;
            box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.1);
        }

        .form-control.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 6px;
            transition: color 0.2s ease;
        }

        .toggle-password:hover {
            color: #17a2b8;
        }

        .error-message {
            color: #ef4444;
            font-size: 13px;
            margin-top: 6px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
            text-transform: uppercase;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(23, 162, 184, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit:disabled {
            background: #9ca3af;
            cursor: not-allowed;
            transform: none;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #6b7280;
            text-decoration: none;
            font-size: 14px;
            margin-top: 20px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #17a2b8;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 16px 24px;
            border-radius: 10px;
            color: white;
            font-weight: 500;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            animation: slideInRight 0.4s ease;
            max-width: 400px;
        }

        .notification.success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .notification.error {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }

        .strength-meter {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .strength-meter-fill {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak {
            background: #ef4444;
            width: 33%;
        }

        .strength-medium {
            background: #f59e0b;
            width: 66%;
        }

        .strength-strong {
            background: #10b981;
            width: 100%;
        }

        .strength-text {
            font-size: 12px;
            margin-top: 4px;
            color: #6b7280;
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
                
                <div class="form-group">
                    <label for="old-password">
                        Mật khẩu cũ <span class="required">(*)</span>
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="old-password" 
                            name="old_password" 
                            class="form-control" 
                            placeholder="Nhập mật khẩu hiện tại"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="old-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="old-password-error"></div>
                </div>

                <div class="form-group">
                    <label for="new-password">
                        Mật khẩu mới <span class="required">(*)</span>
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="new-password" 
                            name="new_password" 
                            class="form-control" 
                            placeholder="Nhập mật khẩu mới"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="new-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="strength-meter">
                        <div class="strength-meter-fill" id="strength-meter"></div>
                    </div>
                    <div class="strength-text" id="strength-text"></div>
                    <div class="error-message" id="new-password-error"></div>
                </div>

                <div class="form-group">
                    <label for="confirm-password">
                        Xác nhận mật khẩu <span class="required">(*)</span>
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="confirm-password" 
                            name="confirm_password" 
                            class="form-control" 
                            placeholder="Nhập lại mật khẩu mới"
                            required
                        >
                        <button type="button" class="toggle-password" data-target="confirm-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="confirm-password-error"></div>
                </div>

                <button type="submit" class="btn-submit">
                    Đổi mật khẩu
                </button>

                <div style="text-align: center;">
                    <a href="{{ route('profile') }}" class="back-link">
                        <i class="fas fa-arrow-left"></i>
                        Quay lại trang cá nhân
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password strength meter
        const newPasswordInput = document.getElementById('new-password');
        const strengthMeter = document.getElementById('strength-meter');
        const strengthText = document.getElementById('strength-text');

        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            
            strengthMeter.className = 'strength-meter-fill';
            
            if (password.length === 0) {
                strengthMeter.style.width = '0';
                strengthText.textContent = '';
            } else if (strength < 3) {
                strengthMeter.classList.add('strength-weak');
                strengthText.textContent = 'Mật khẩu yếu';
                strengthText.style.color = '#ef4444';
            } else if (strength < 5) {
                strengthMeter.classList.add('strength-medium');
                strengthText.textContent = 'Mật khẩu trung bình';
                strengthText.style.color = '#f59e0b';
            } else {
                strengthMeter.classList.add('strength-strong');
                strengthText.textContent = 'Mật khẩu mạnh';
                strengthText.style.color = '#10b981';
            }
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            if (/\d/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            return strength;
        }

        // Form validation and submission
        const form = document.getElementById('change-password-form');
        const oldPasswordInput = document.getElementById('old-password');
        const confirmPasswordInput = document.getElementById('confirm-password');

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous errors
            document.querySelectorAll('.error-message').forEach(el => {
                el.classList.remove('show');
                el.textContent = '';
            });
            document.querySelectorAll('.form-control').forEach(el => {
                el.classList.remove('error');
            });

            // Validate
            let isValid = true;

            if (oldPasswordInput.value.trim() === '') {
                showError('old-password', 'Vui lòng nhập mật khẩu cũ');
                isValid = false;
            }

            if (newPasswordInput.value.trim() === '') {
                showError('new-password', 'Vui lòng nhập mật khẩu mới');
                isValid = false;
            } else if (newPasswordInput.value.length < 6) {
                showError('new-password', 'Mật khẩu mới phải có ít nhất 6 ký tự');
                isValid = false;
            } else if (newPasswordInput.value === oldPasswordInput.value) {
                showError('new-password', 'Mật khẩu mới phải khác mật khẩu cũ');
                isValid = false;
            }

            if (confirmPasswordInput.value.trim() === '') {
                showError('confirm-password', 'Vui lòng xác nhận mật khẩu mới');
                isValid = false;
            } else if (confirmPasswordInput.value !== newPasswordInput.value) {
                showError('confirm-password', 'Mật khẩu xác nhận không khớp');
                isValid = false;
            }

            if (!isValid) return;

            // Submit form
            const submitBtn = form.querySelector('.btn-submit');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Đang xử lý...';

            const formData = {
                old_password: oldPasswordInput.value,
                new_password: newPasswordInput.value,
                confirm_password: confirmPasswordInput.value
            };

            fetch('/profile/change-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData),
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;

                if (data.success) {
                    showNotification('Đổi mật khẩu thành công!', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("profile") }}';
                    }, 1500);
                } else {
                    showNotification(data.message || 'Có lỗi xảy ra!', 'error');
                    if (data.field) {
                        showError(data.field, data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
                showNotification('Có lỗi xảy ra khi đổi mật khẩu!', 'error');
            });
        });

        function showError(fieldId, message) {
            const input = document.getElementById(fieldId);
            const errorEl = document.getElementById(fieldId + '-error');
            
            input.classList.add('error');
            errorEl.textContent = message;
            errorEl.classList.add('show');
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOutRight 0.4s ease';
                setTimeout(() => notification.remove(), 400);
            }, 3000);
        }
    </script>
</body>
</html>
