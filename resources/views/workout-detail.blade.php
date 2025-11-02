@extends('base')
@section('content')
<div class="workout-detail-page">
  <link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- Header -->
  <div class="workout-header text-center">
    <h1>💪 BÀI TẬP TOÀN THÂN CƯỜNG ĐỘ CAO</h1>
    <p class="workout-meta">
      <span>⏱️ 45 phút</span>
      <span>💥 Mức độ: Trung bình</span>
    </p>
  </div>

  <!-- Video kiểu YouTube -->
  <div class="video-container">
    <div class="video-frame">
      <video controls poster="{{ asset('images/thumbnail.jpg') }}">
        <source src="{{ asset('videos/workout1.mp4') }}" type="video/mp4">
        Trình duyệt của bạn không hỗ trợ phát video.
      </video>
    </div>
  </div>

  <!-- Chi tiết bài tập -->
  <section class="workout-info">
    <h2>🏋️ Chi tiết bài tập</h2>
    <ul>
      <li><strong>1. Khởi động</strong> — 5 phút (xoay khớp, chạy tại chỗ)</li>
      <li><strong>2. Burpees</strong> — 3 hiệp × 12 lần · Nghỉ 60s giữa hiệp</li>
      <li><strong>3. Mountain Climbers</strong> — 3 hiệp × 40 giây</li>
      <li><strong>4. Jump Squats</strong> — 3 hiệp × 15 lần</li>
      <li><strong>5. Push-ups</strong> — 3 hiệp × 10–15 lần</li>
      <li><strong>6. Plank</strong> — 3 hiệp × 45–60 giây</li>
      <li><strong>7. Thư giãn</strong> — 5 phút (kéo giãn nhẹ nhàng)</li>
    </ul>
    <p class="note">💡 Gợi ý: điều chỉnh số lần / thời gian theo thể lực cá nhân.</p>
  </section>

  <!-- Gợi ý món ăn -->
  <section class="meal-section">
    <h2>🥗 Món ăn gợi ý sau buổi tập</h2>

    <div class="meal-grid">
      <div class="meal-card">
        <div class="meal-card-image">
          <img src="{{ asset('images/meal1.avif') }}" alt="Salad Ức Gà">
        </div>
        <div class="meal-card-content">
          <div class="meal-card-title">Salad Ức Gà</div>
          <div class="meal-card-meta">🔥 250 calo · ⏱️ 15 phút</div>
          <div class="meal-card-footer">
            <button onclick="openModal('Salad Ức Gà', 'Ức gà nướng, rau xanh và dầu ô liu — cung cấp đạm và chất xơ.')">
              Xem công thức
            </button>
          </div>
        </div>
      </div>

      <!-- Meal card 2 -->
      <div class="meal-card">
        <div class="meal-card-image">
          <img src="{{ asset('images/meal2.avif') }}" alt="Cơm Cá Hồi">
        </div>
        <div class="meal-card-content">
          <div class="meal-card-title">Cơm Gạo Lứt & Cá Hồi</div>
          <div class="meal-card-meta">🔥 480 calo · ⏱️ 25 phút</div>
          <div class="meal-card-footer">
            <button onclick="openModal('Cơm Gạo Lứt & Cá Hồi', 'Kết hợp gạo lứt và cá hồi để bổ sung protein và carb tốt.')">
              Xem công thức
            </button>
          </div>
        </div>
      </div>

      <!-- Meal card 3 -->
      <div class="meal-card">
        <div class="meal-card-image">
          <img src="{{ asset('images/meal3.webp') }}" alt="Sinh tố Chuối Yến Mạch">
        </div>
        <div class="meal-card-content">
          <div class="meal-card-title">Sinh Tố Chuối & Yến Mạch</div>
          <div class="meal-card-meta">🔥 320 calo · ⏱️ 5 phút</div>
          <div class="meal-card-footer">
            <button onclick="openModal('Sinh tố Chuối & Yến Mạch', 'Cung cấp năng lượng nhanh với yến mạch, sữa và chuối.')">
              Xem công thức
            </button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div id="mealModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3 id="mealTitle"></h3>
      <p id="mealDesc"></p>
    </div>
  </div>

</div>

<script src="{{ asset('js/workout.js') }}"></script>
@endsection
