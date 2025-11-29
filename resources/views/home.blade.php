@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Health & Fitness App</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
  /* ================= RESET ================= */
/* Đặt lại margin, padding và box-sizing cho tất cả phần tử */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Cấu hình cơ bản cho html và body */
html, body {
  height: auto;
  scroll-behavior: smooth; /* cuộn mượt */
  font-family: "Segoe UI", sans-serif;
  background: linear-gradient(135deg, #f7f9ff, #e4edff);
  color: #222;
  overflow-x: hidden;
  overflow-y: auto; /* bật lại cuộn dọc */
}


/* ================= USER & AUTH ================= */
/* Menu người dùng và nút đăng nhập/đăng ký */
.user-menu,
.auth-buttons {
  display: flex;
  align-items: center;
  gap: 15px;
}

.user-menu {
  margin-left: 20px;
}

/* Avatar người dùng */
.user-icon {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #ffea00;
}

/* Nút đăng xuất */
.logout-btn {
  background: #ffea00;
  border: none;
  padding: 6px 14px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s;
  color: #000;
}

.logout-btn:hover {
  background: #ffd700;
  transform: translateY(-1px);
}


/* ================= AUTH BUTTONS ================= */
.auth-buttons {
  display: flex;
  align-items: center;
  gap: 12px;
}

.btn-login, .btn-register {
  border-radius: 25px;
  padding: 8px 18px;
  font-weight: 600;
  transition: 0.3s;
}

.btn-login {
  background: #ffea00;
  color: #222;
}

.btn-login:hover {
  background: #fff;
  color: #000;
}

.btn-register {
  border: 2px solid #fff;
  color: #fff;
}

.btn-register:hover {
  background: #fff;
  color: #000;
}

/* ================= SLIDESHOW ================= */
.slideshow-section {
  position: relative;
  width: 100%;
  height: 70vh; /* chiều cao banner */
  overflow: hidden;
  background: #000;
}

.slideshow-inner {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
}

/* Slide mặc định */
.slide {
  position: absolute;
  inset: 0;
  opacity: 0;
  z-index: 1;
  transition: opacity 1.2s ease-in-out, transform 1.2s ease-in-out;
}

/* Slide đang hiển thị */
.slide.active {
  opacity: 1;
  z-index: 2;
}

/* Ảnh slide */
.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.85);
}

/* Văn bản trên slide */
.slide-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #f6ff00;
  text-align: center;
  text-shadow: 0 6px 25px rgba(0, 0, 0, 0.7);
}

.slide-text h1 {
  font-size: 5rem;
  font-weight: 800;
  background: linear-gradient(90deg,  #f6ff00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  
}

.slide-text p {
  font-size: 3rem;
  opacity: 0.95;
  margin-top: 8px;
  background: linear-gradient(90deg,  #f6ff00);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* ================= ABOUT SECTION ================= */
.about-section {
  background: #fff;
  padding: 80px 8%;
}

.about-container {
  display: flex;
  flex-direction: column;
  gap: 80px;
}

.about-block {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 50px;
}

.about-block.reverse {
  flex-direction: row-reverse;
}

.about-text {
  flex: 1 1 50%;
}

.about-text h2 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 20px;
  color: #000;
}

.about-text h2 span {
  color: #ffea00;
}

.about-text p {
  font-size: 1.05rem;
  line-height: 1.6;
  margin-bottom: 18px;
  color: #444;
}

/* Nút trong about */
.about-text .btn-primary {
  background: #ffea00;
  color: #000;
  padding: 12px 30px;
  border-radius: 30px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
  transition: 0.3s;
}

.about-text .btn-primary:hover {
  background: #fff;
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
}

/* Ảnh about */
.about-image {
  flex: 1 1 45%;
  text-align: center;
}

.about-image img {
  width: 100%;
  max-width: 420px;
  border-radius: 18px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.2);
  transition: transform 0.5s ease;
}

.about-image img:hover {
  transform: scale(1.05);
}

/* ================= MOBILE: FIXED NAVBAR ON HOME ================= */
@media (max-width: 992px) {
  /* Keep navbar fixed on mobile for the home page only */
  .home-page .navbar {
    position: fixed !important; /* force fixed on mobile */
    top: 0;
    left: 0;
    right: 0;
    z-index: 1200; /* above other UI elements */
    width: 100%;
  }

  /* Make sure the dropdown mobile menu still appears below the fixed navbar */
  .home-page .menu {
    top: 70px; /* adjust if your navbar height differs */
  }

  /* Add top padding to the main content so it's not hidden underneath the fixed navbar */
  .home-page main,
  .home-page .container,
  .home-page .slideshow-section {
    padding-top: 64px; /* adjust this value to match the actual navbar height on mobile */
  }
}

</style>
  <!-- JS -->
  <script defer src="{{ asset('js/home.js') }}"></script>
</head>
<body>



  <!-- 🖼 SLIDESHOW -->
  <section class="slideshow-section" id="home">
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
        <img src="{{ asset('images/nutrition_plan.jpg') }}" alt="Dinh dưỡng lành mạnh">
        <div class="slide-text">
          <h1>Dinh dưỡng lành mạnh 🍎</h1>
          <p>Ăn uống khoa học để có cơ thể khỏe mạnh.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- 🔥 ABOUT SECTION -->
  <section class="about-section" id="about">
    <div class="about-container">

      <!-- Block 1 -->
      <div class="about-block reveal">
        <div class="about-text">
          <h2>Giới thiệu về <span>Health & Fitness App</span></h2>
          <p>
            Health & Fitness App giúp bạn quản lý sức khỏe, theo dõi chế độ dinh dưỡng, 
            lập kế hoạch tập luyện và kết nối cộng đồng cùng mục tiêu sống khỏe mạnh.
          </p>
          <p>
            Với giao diện trực quan và tính năng thông minh, bạn có thể dễ dàng duy trì 
            thói quen tốt và đạt được mục tiêu mỗi ngày.
          </p>
          <a href="{{ route('workouts.page') }}" class="btn-primary">Khám phá ngay</a>
        </div>
        <div class="about-image">
          <img src="{{ asset('images/fitness.jpg') }}" alt="Health & Fitness">
        </div>
      </div>

      <!-- Block 2 -->
      <div class="about-block reverse reveal" id="health">
        <div class="about-text">
          <h2>Tập trung vào <span>Sức khỏe toàn diện</span></h2>
          <p>
            Theo dõi nhịp tim, cân nặng, giấc ngủ và mức độ hoạt động mỗi ngày giúp bạn hiểu rõ hơn về cơ thể.
          </p>
          <p>Dữ liệu hiển thị bằng biểu đồ trực quan để bạn dễ theo dõi tiến trình.</p>
          <a href="{{ route('health.page') }}" class="btn-primary">Khám phá ngay</a>
        </div>
        <div class="about-image">
          <img src="{{ asset('images/health_tracking.jpg') }}" alt="Theo dõi sức khỏe">
        </div>
      </div>

      <!-- Block 3 -->
      <div class="about-block reveal" id="nutrition">
        <div class="about-text">
          <h2>Chế độ <span>Dinh dưỡng thông minh</span></h2>
          <p>
            Gợi ý thực đơn cân bằng, theo dõi lượng calo và dưỡng chất nạp vào mỗi ngày, 
            giúp bạn duy trì vóc dáng và tăng cường sức khỏe khoa học.
          </p>
          <p>
            Hệ thống AI gợi ý bữa ăn dựa trên mục tiêu cá nhân – giảm cân, tăng cơ hoặc duy trì thể trạng.
          </p>
          <a href="{{ route('nutrition.page') }}" class="btn-primary">Khám phá ngay</a>
        </div>
        <div class="about-image">
          <img src="{{ asset('images/nutrition.jpg') }}" alt="Dinh dưỡng">
        </div>
      </div>

    </div>
  </section>

</body>
</html>
@endsection