<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Health & Fitness</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
                <h2>Đăng nhập tài khoản</h2>
                <p>Chào mừng bạn quay lại 💪</p>
            </div>

            @if(session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="login-form">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" placeholder="📧 Nhập email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="🔒 Nhập mật khẩu" required>
                </div>

                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>

            <div class="register-link">
                <p>Chưa có tài khoản? <a href="{{ route('register.page') }}">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
</body>
</html>
