<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="register-container">
        <h2>Tạo tài khoản mới</h2>

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Họ và tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>

            <button type="submit">Đăng ký</button>
        </form>

        <p>Đã có tài khoản? <a href="{{ route('login.page') }}">Đăng nhập</a></p>
    </div>
</body>
</html>