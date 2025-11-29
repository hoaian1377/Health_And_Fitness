@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sức Khỏe | Health & Fitness</title>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/health.css') }}">
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
/* ===========================
   🌿 Health Page Styles
=========================== */

body {
  font-family: "Poppins", sans-serif;
  background: linear-gradient(135deg, #eef2ff, #e0e7ff, #c7d2fe);
  color: #222;
  margin: 0;
  padding: 0;
}

/* Container */
.health-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 90vh;
  padding: 20px;
}

/* BMI Card */
.bmi-card {
  background: rgba(255, 255, 255, 0.9);
  backdrop-filter: blur(10px);
  padding: 40px;
  border-radius: 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  max-width: 430px;
  width: 100%;
  text-align: center;
  animation: fadeIn 0.5s ease;
}

.bmi-card h2 {
  color: #4b2bd4;
  margin-bottom: 10px;
}

.bmi-subtext {
  color: #555;
  margin-bottom: 20px;
  font-size: 15px;
}

/* Form */
.bmi-form {
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.form-group {
  text-align: left;
}

.form-group label {
  font-weight: 600;
  margin-bottom: 5px;
  display: block;
}

.form-group input,
.form-group select {
  width: 100%;
  padding: 10px 12px;
  border-radius: 10px;
  border: 1px solid #ccc;
  font-size: 15px;
  transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus {
  border-color: #6f4ff3;
  outline: none;
}

/* Button */
.bmi-btn {
  background: linear-gradient(90deg, #6f4ff3, #a36bff);
  color: #fff;
  border: none;
  padding: 12px 0;
  border-radius: 12px;
  font-weight: 600;
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
}

.bmi-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(111, 79, 243, 0.3);
}

/* Result Box */
.bmi-result {
  margin-top: 25px;
  background: #f9fafb;
  border-radius: 14px;
  padding: 20px;
  animation: fadeIn 0.5s ease;
}

.bmi-result.hidden {
  display: none;
}

.bmi-result h3 {
  color: #333;
}

.goal-buttons {
  display: flex;
  justify-content: space-between;
  margin-top: 15px;
  gap: 10px;
}

.goal-btn {
  flex: 1;
  background: #fff;
  border: 2px solid #6f4ff3;
  color: #6f4ff3;
  padding: 10px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
  transition: 0.3s;
}

.goal-btn:hover {
  background: #6f4ff3;
  color: #fff;
}

.goal-note {
  margin-top: 10px;
  color: #555;
  font-size: 14px;
}

/* Animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
/* ===========================
   🌟 Section Hành Trình
=========================== */
.journey-section {
  margin-top: 80px;
  padding: 40px 20px;
  text-align: center;
}

.journey-header h2 {
  color: #4b2bd4;
  margin-bottom: 10px;
}

.journey-header p {
  color: #555;
  font-size: 15px;
  max-width: 600px;
  margin: 0 auto 30px;
}

.journey-cards {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
}

.journey-card {
  background: #fff;
  border-radius: 14px;
  padding: 25px;
  width: 300px;
  box-shadow: 0 8px 18px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.journey-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 10px 28px rgba(111,79,243,0.25);
}

.journey-card .icon {
  font-size: 40px;
  color: #6f4ff3;
  margin-bottom: 12px;
}

.journey-card h3 {
  color: #333;
  margin-bottom: 8px;
}

.journey-card p {
  color: #666;
  font-size: 14px;
  line-height: 1.4;
  margin-bottom: 15px;
}

.journey-btn {
  display: inline-block;
  padding: 10px 16px;
  border-radius: 10px;
  background: linear-gradient(90deg, #6f4ff3, #a36bff);
  color: #fff;
  font-weight: 600;
  text-decoration: none;
  transition: background 0.3s;
}

.journey-btn:hover {
  background: linear-gradient(90deg, #5b3ff6, #8a52ff);
}

/* Responsive */
@media (max-width: 768px) {
  .journey-cards {
    flex-direction: column;
    align-items: center;
  }
}
.hidden {
  display: none;
}


  </style>
  <!-- JS -->
  <script defer src="{{ asset('js/health.js') }}"></script>
</head>
<body>
  <div class="health-container">
    <!-- ========== PHẦN 1: TÍNH BMI ========== -->
    <section class="bmi-section">
      <div class="bmi-card">
        <h2>🔹 Tính Chỉ Số BMI Của Bạn</h2>
        <p class="bmi-subtext">Kiểm tra sức khỏe và nhận gợi ý tập luyện phù hợp 💪</p>

        <form id="bmiForm" class="bmi-form">
          <div class="form-group">
            <label for="height">Chiều cao (cm)</label>
            <input type="number" id="height" required placeholder="Nhập chiều cao...">
          </div>

          <div class="form-group">
            <label for="weight">Cân nặng (kg)</label>
            <input type="number" id="weight" required placeholder="Nhập cân nặng...">
          </div>

          <div class="form-group">
            <label for="gender">Giới tính</label>
            <select id="gender" required>
              <option value="">-- Chọn giới tính --</option>
              <option value="male">Nam</option>
              <option value="female">Nữ</option>
            </select>
          </div>

          <button type="submit" class="bmi-btn">Tính BMI</button>
        </form>

        <div id="bmiResult" class="bmi-result hidden">
          <h3>Kết quả BMI của bạn: <span id="bmiValue"></span></h3>
          <p id="bmiStatus"></p>

          <div class="goal-buttons">
            <button class="goal-btn" data-goal="gain">Tăng cân</button>
            <button class="goal-btn" data-goal="muscle">Tăng cơ</button>
            <button class="goal-btn" data-goal="lose">Giảm cân</button>
          </div>

          <p class="goal-note">Chọn mục tiêu để đến trang bài tập phù hợp</p>
        </div>
      </div>
    </section>

    <!-- ========== PHẦN 2: HÀNH TRÌNH SỨC KHỎE ========== -->
    <section id="journeySection" class="journey-section hidden">
      <div class="journey-header">
        <h2>🏋️ Khám Phá Hành Trình Sức Khỏe Của Bạn</h2>
        <p>Bạn có thể bắt đầu với những mục tiêu nhỏ và đạt kết quả lớn. Chúng tôi gợi ý cho bạn 3 hướng đi phù hợp!</p>
      </div>

      <div class="journey-cards">
        <div class="journey-card">
          <i class="fa-solid fa-bowl-rice icon"></i>
          <h3>Tăng Cân</h3>
          <p>Chế độ ăn giàu dinh dưỡng và bài tập giúp tăng cân lành mạnh.</p>
          <a href="{{ route('nutrition.page') }}" class="journey-btn">Khám phá ngay</a>
        </div>

        <div class="journey-card">
          <i class="fa-solid fa-dumbbell icon"></i>
          <h3>Tăng Cơ</h3>
          <p>Các bài tập sức mạnh kết hợp protein giúp cơ thể săn chắc.</p>
          <a href="{{ route('workouts.page') }}" class="journey-btn">Xem Bài Tập</a>
        </div>

        <div class="journey-card">
          <i class="fa-solid fa-fire-flame-curved icon"></i>
          <h3>Giảm Cân</h3>
          <p>Các bài học được chia sẻ của các chuyên gia.</p>
          <a href="{{ route('community.page') }}" class="journey-btn">Xem Bài Viết</a>
        </div>
      </div>
    </section>
    
  </div>
</body>
</html>
<script>
    const goalRoutes = {
        nutrition: "{{ route('nutrition.page') }}",
        workouts: "{{ route('workouts.page') }}",
        community: "{{ route('community.page') }}"
    };
</script>
<script src="/js/goalRedirect.js"></script>
@endsection
