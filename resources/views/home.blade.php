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