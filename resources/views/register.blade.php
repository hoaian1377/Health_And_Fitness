<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký tài khoản</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
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

    <form action="{{ route('register.register') }}" method="POST">
      @csrf

      <div class="input-group">
        <span class="icon">👤</span>
        <input type="text" name="username" placeholder="Tên Đăng Nhập" required>
      </div>

      <div class="input-group">
        <span class="icon">📧</span>
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="input-group">
        <span class="icon">🔒</span>
        <input type="password" name="passwords" placeholder="Mật khẩu" required>
      </div>

      <div class="input-group">
        <span class="icon">🔁</span>
        <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required>
      </div>

      <button type="submit">Đăng ký ngay</button>
    </form>

    <p>Đã có tài khoản? <a href="{{ route('login.LoginFrom') }}">Đăng nhập</a></p>
  </div>
  <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
