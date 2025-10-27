<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ứng dụng chăm sóc sức khỏe & thể hình</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Thanh điều hướng -->
    <div class="nav_hero">
        <a href="{{ route('home.page') }}">Trang Chủ</a>
        <a href="{{ route('health.page') }}">Sức Khỏe</a>
        <a href="{{ route('fitness.page') }}">Tập Luyện</a>
        <a href="{{ route('nutrition.page') }}">Dinh Dưỡng</a>
        <a href="{{ route('community.page') }}">Cộng Đồng</a>

        <div class="nav_user">
            @auth
                <span>👋 Xin chào, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Đăng xuất</button>
                </form>
            @else
                <a href="{{ route('login.page') }}">Đăng nhập</a>
                <a href="{{ route('register.page') }}">Đăng ký</a>
            @endauth
        </div>
    </div>

    <!-- Nội dung chính -->
    <section class="hero">
        <div class="hero-content">
            <h1>Chào mừng bạn đến với <span>Health & Fitness App</span></h1>
            <p>Hành trình sống khỏe mạnh hơn bắt đầu từ hôm nay 💪</p>
            <a href="{{ route('fitness.page') }}" class="btn-primary">Bắt đầu tập luyện</a>
        </div>
    </section>

    <!-- Tính năng nổi bật -->
    <section class="features">
        <h2>Tính năng nổi bật</h2>
        <div class="feature-list">
            <div class="feature-item">
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Fitness">
                <h3>Bài tập cá nhân</h3>
                <p>Tùy chỉnh kế hoạch tập luyện theo thể trạng và mục tiêu của bạn.</p>
            </div>
            <div class="feature-item">
                <img src="https://cdn-icons-png.flaticon.com/512/2944/2944053.png" alt="Nutrition">
                <h3>Chế độ dinh dưỡng</h3>
                <p>Gợi ý thực đơn lành mạnh giúp bạn đạt được cơ thể mong muốn.</p>
            </div>
            <div class="feature-item">
                <img src="https://cdn-icons-png.flaticon.com/512/706/706164.png" alt="Health Tracker">
                <h3>Theo dõi sức khỏe</h3>
                <p>Ghi nhận cân nặng, chỉ số BMI và tiến trình tập luyện mỗi ngày.</p>
            </div>
            <div class="feature-item">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077012.png" alt="Community">
                <h3>Cộng đồng năng động</h3>
                <p>Kết nối, chia sẻ và truyền cảm hứng cùng những người có cùng đam mê.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>© 2025 Health & Fitness App — Giữ sức khỏe, sống hạnh phúc 🌿</p>
    </footer>
</body>
</html>
