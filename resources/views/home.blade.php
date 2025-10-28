<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Health & Fitness App</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script defer src="{{ asset('js/home.js') }}"></script>
</head>
<body>
  <!-- Thanh điều hướng -->
 <nav class="navbar">
  <!-- Logo -->
  <a href="{{ route('home.page') }}" class="logo">
    <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Logo">
    <span>Health<span>Fit</span></span>
  </a>

<!-- Nút mở menu trên mobile -->
  <div class="menu-toggle" id="menu-toggle">
    <i class="fa-solid fa-bars"></i>
  </div>

  <!-- Menu chính -->
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


  <!-- 🖼 WOW SLIDE SECTION -->
<section class="slideshow-section">
  <div class="slideshow-inner">

    <div class="slide active">
      <img src="{{ asset('images/suckheo.webp') }}" alt="Rèn luyện sức khỏe">
      <div class="slide-text">
        <h1>Rèn luyện mỗi ngày 💪</h1>
        <p>Hành trình sức khỏe bắt đầu từ hôm nay!</p>
      </div>
    </div>

    <div class="slide">
      <img src="{{ asset('images/gym.webp') }}" alt="Tập luyện cùng HealthFit">
      <div class="slide-text">
        <h1>Tập luyện cùng HealthFit 🏋️‍♂️</h1>
        <p>Cải thiện thể lực và tinh thần mỗi ngày.</p>
      </div>
    </div>

    <div class="slide">
      <img src="{{ asset('images/dinhduong.webp') }}" alt="Dinh dưỡng lành mạnh">
      <div class="slide-text">
        <h1>Dinh dưỡng lành mạnh 🍎</h1>
        <p>Ăn uống khoa học để có cơ thể khỏe mạnh.</p>
      </div>
    </div>

  </div>
</section>


<!-- ===== ABOUT SECTION ===== -->
<section class="about-section">
  <div class="about-container">

    <!-- Giới thiệu chung -->
    <div class="about-block">
      <div class="about-text">
        <h2>Giới thiệu về <span>Health & Fitness App</span></h2>
        <p>
          Health & Fitness App giúp bạn quản lý sức khỏe, theo dõi chế độ dinh dưỡng, 
          lập kế hoạch tập luyện và kết nối với cộng đồng cùng mục tiêu sống khỏe mạnh.
        </p>
        <p>
          Với giao diện trực quan và các tính năng thông minh, bạn có thể dễ dàng duy trì 
          thói quen tốt và đạt được mục tiêu sức khỏe của mình mỗi ngày.
        </p>
        <a href="{{ route('fitness.page') }}" class="btn-primary">Khám phá ngay</a>
      </div>

      <div class="about-image">
        <img src="{{ asset('images/fitness.jpg') }}" alt="Health & Fitness" />
      </div>
    </div>

    <!-- Sức khỏe -->
    <div class="about-block reverse">
      <div class="about-text">
        <h2>Tập trung vào <span>Sức khỏe toàn diện</span></h2>
        <p>
          Ứng dụng cung cấp công cụ theo dõi nhịp tim, cân nặng, giấc ngủ và mức độ hoạt động 
          mỗi ngày, giúp bạn hiểu rõ hơn về cơ thể và xây dựng lối sống lành mạnh.
        </p>
        <p>
          Dữ liệu được lưu trữ an toàn và hiển thị bằng biểu đồ trực quan để bạn theo dõi tiến trình sức khỏe.
        </p>
        <a href="{{ route('health.page') }}" class="btn-primary">Khám phá ngay</a>
      </div>

      <div class="about-image">
        <img src="{{ asset('images/health_tracking.jpg') }}" alt="Theo dõi sức khỏe" />
      </div>
    </div>

    <!-- Dinh dưỡng -->
    <div class="about-block">
      <div class="about-text">
        <h2>Chế độ <span>Dinh dưỡng thông minh</span></h2>
        <p>
          Gợi ý thực đơn cân bằng, theo dõi lượng calo và dưỡng chất nạp vào mỗi ngày, 
          giúp bạn duy trì vóc dáng và tăng cường sức khỏe một cách khoa học.
        </p>
        <p>
          Hệ thống AI gợi ý bữa ăn dựa trên mục tiêu cá nhân của bạn – giảm cân, tăng cơ hoặc duy trì thể trạng.
        </p>
        <a href="{{ route('nutrition.page') }}" class="btn-primary">Khám phá ngay</a>
      </div>

      <div class="about-image">
        <img src="{{ asset('images/nutrition_plan.jpg') }}" alt="Dinh dưỡng" />
      </div>
    </div>

  </div>
</section>
  <!-- Footer -->
  <footer>
    <p>© 2025 Health & Fitness App — Giữ sức khỏe, sống hạnh phúc 🌿</p>
  </footer>
</body>
</html>