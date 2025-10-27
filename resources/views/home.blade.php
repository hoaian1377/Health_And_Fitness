<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health & Fitness App</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script defer src="{{ asset('js/home.js') }}"></script>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav class="navbar">
    <div class="logo">
        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Logo">
        <span>Health<span>Fit</span></span>
    </div>

    <div class="menu-toggle" id="menu-toggle">☰</div>

    <div class="menu" id="menu">
        <a href="{{ route('home.page') }}">Trang Chủ</a>
        <a href="{{ route('health.page') }}">Sức Khỏe</a>
        <a href="{{ route('fitness.page') }}">Tập Luyện</a>
        <a href="{{ route('nutrition.page') }}">Dinh Dưỡng</a>
        <a href="{{ route('community.page') }}">Cộng Đồng</a>

        @auth
        <div class="user-menu">
            <div class="user-info">
                <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="User" class="user-icon">
                <span>{{ Auth::user()->name }}</span>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">Đăng xuất</button>
            </form>
        </div>
        @else
        <div class="auth-buttons">
            <a href="{{ route('login.page') }}" class="btn-login">Đăng nhập</a>
            <a href="{{ route('register.page') }}" class="btn-register">Đăng ký</a>
        </div>
        @endauth
    </div>
</nav>


    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Chào mừng bạn đến với <span>Health & Fitness App</span></h1>
            <p>Hành trình sống khỏe mạnh hơn bắt đầu từ hôm nay 💪</p>
            <a href="{{ route('fitness.page') }}" class="btn-primary">Bắt đầu tập luyện</a>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>© 2025 Health & Fitness App — Giữ sức khỏe, sống hạnh phúc 🌿</p>
    </footer>
</body>
</html>
