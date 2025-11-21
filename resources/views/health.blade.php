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
