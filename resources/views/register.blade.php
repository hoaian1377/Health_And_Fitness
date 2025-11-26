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
  <script src="{{ asset('js/register.js') }}"></script>
</body>
</html>
