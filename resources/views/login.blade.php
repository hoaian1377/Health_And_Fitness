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
    <script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
