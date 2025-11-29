@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">
<style>/* Reset và Base Styles */
/* Body có gradient toàn màn hình */

body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

/* Container nội dung */
.workout-detail-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: transparent;
    /* bỏ gradient */
}

.workout-detail-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
}

/* Header Title */
.workout-detail-page h1 {
    color: #ffffff;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Video Container */
.video-container {
    background: #ffffff;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    margin-bottom: 2rem;
}

.video-frame {
    width: 100%;
    border-radius: 15px;
    max-height: 500px;
    object-fit: cover;
}

/* Stats Grid */
.video-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-item {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.stat-item .icon {
    font-size: 2rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.8rem;
    border-radius: 12px;
}

.stat-item span:last-child {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
}

/* Tab Navigation */
.tab-navigation {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.5rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.tab-btn {
    flex: 1;
    padding: 1rem 2rem;
    border: none;
    background: transparent;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.tab-btn.active {
    background: #ffffff;
    color: #667eea;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Tab Content */
.tab-content {
    background: transparent;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Info Cards */
.workout-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: #ffffff;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.info-card h3 {
    color: #667eea;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    border-bottom: 3px solid #667eea;
    padding-bottom: 0.5rem;
}

.info-card p {
    color: #4a5568;
    line-height: 1.8;
    font-size: 1.05rem;
}

.info-card strong {
    color: #764ba2;
    font-weight: 600;
}

/* Workout Steps */
.workout-steps {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.workout-steps li {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    background: linear-gradient(135deg, #f6f8fb 0%, #e9ecf3 100%);
    padding: 1.5rem;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.workout-steps li:hover {
    transform: translateX(10px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.2);
}

.step-number {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
}

.step-content {
    flex: 1;
}

.step-content strong {
    display: block;
    color: #667eea;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.step-content p {
    color: #4a5568;
    line-height: 1.6;
    margin: 0;
}

/* Workout Tips */
.workout-tips {
    background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
    border-left: 5px solid #e17055;
}

.workout-tips h3 {
    color: #d63031;
    border-bottom-color: #d63031;
}

.workout-tips ul {
    list-style: none;
    padding: 0;
}

.workout-tips ul li {
    padding: 0.8rem 0;
    padding-left: 2rem;
    color: #2d3436;
    font-weight: 500;
    position: relative;
    line-height: 1.6;
}

.workout-tips ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #00b894;
    font-weight: 700;
    font-size: 1.3rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .workout-detail-page {
        padding: 1rem;
    }

    .workout-detail-page h1 {
        font-size: 1.8rem;
    }

    .video-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .tab-btn {
        padding: 0.8rem 1rem;
        font-size: 1rem;
    }

    .info-card {
        padding: 1.5rem;
    }

    .workout-steps li {
        flex-direction: column;
        gap: 1rem;
    }

    .step-number {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 480px) {
    .video-stats {
        grid-template-columns: 1fr;
    }

    .tab-navigation {
        flex-direction: column;
        gap: 0.5rem;
    }
}

/* ================= LOADING ANIMATION ================= */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #10b981;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 9999;
}

@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }

    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.difficulty-indicator {
    display: none !important;
}


/* ===== VIDEO CONTAINER (Updated) ===== */
.video-container {
    width: 100%;
    max-width: 800px;
    margin: 30px auto;
    padding: 12px;
    /* Tạo viền khung */
    border-radius: 24px;
    /* Gradient nền tối sang trọng */
    background: linear-gradient(145deg, #1e293b, #0f172a);
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.3),
        inset 0 1px 1px rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Hiệu ứng ánh sáng nền */
.video-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 60%);
    pointer-events: none;
}

.video-frame {
    width: 100%;
    height: auto;
    max-height: 500px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    object-fit: contain;
    background: #000;
    position: relative;
    z-index: 1;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .video-container {
        padding: 8px;
        margin: 15px auto;
        border-radius: 16px;
        max-width: 100%;
    }

    .video-frame {
        max-height: 300px;
        border-radius: 12px;
    }

    .workout-detail-page {
        padding: 1rem;
    }
}

@media (max-width: 992px) {

    .navbar {
        padding: 12px 15px;
        /* thu padding để menu không bị đẩy lệch */
    }

    .menu {
        display: none;
        flex-direction: column;

        position: absolute;
        top: 75px;

        /* căn SÁT LỀ TRÁI để không bị tràn bên phải */
        right: 10px;

        /* Giảm chiều rộng menu trên điện thoại */
        width: 180px;

        background: #111;
        padding: 12px 0;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.45);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .menu.show {
        display: flex;
        animation: slideIn 0.28s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .menu a {
        padding: 10px 18px;
        width: 100%;
        text-align: left;
        border-radius: 10px;
        font-size: 14px;
        transition: background 0.25s;
    }

    .menu a:hover {
        background: #222;
    }

    .menu-toggle {
        display: block;
    }

    .user-menu,
    .auth-buttons {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 18px;
        gap: 10px;
    }
}

.menu a {
    padding: 8px 14px;
    /* thu nhỏ vùng chạm */
    width: auto;
    /* không chiếm 100% chiều rộng */
    display: inline-block;
    /* chỉ chiếm đúng nội dung */
    text-align: left;
    border-radius: 10px;
    transition: background 0.2s;
    font-size: 14px;
}

button {
    padding: 8px 14px;
    /* vùng chạm */
    width: auto;
    /* không chiếm toàn bộ chiều rộng */
    display: inline-block;
    /* chỉ chiếm đúng nội dung */
    text-align: left;
    /* chữ lệch trái */
    border-radius: 10px;
    transition: background 0.2s;
    font-size: 14px;
    /* tùy chọn giảm padding bên trái nếu vẫn lệch */
    padding-left: 6px;
    /* giảm khoảng cách trái */
}</style>

<div class="workout-detail-page">

    <!-- Tên bài tập -->
    <h1>{{ $exercise->name_workout }}</h1>

<!--video bai tap -->
<div class="video-container">
    @if($exercise->video_urls)
        <video class="video-frame" controls poster="{{ asset($exercise->urls) }}">
            <source src="{{ asset($exercise->video_urls) }}" type="video/mp4">
            Trình duyệt không hỗ trợ video.
        </video>
    @elseif($exercise->urls)
        <img class="video-frame" src="{{ asset($exercise->urls) }}" alt="{{ $exercise->name_workout }}">
    @else
        <div class="video-frame no-media">
            Video / ảnh chưa có
        </div>
    @endif
</div>
 </div>
<!-- Stats -->
    <div class="video-stats">
        <div class="stat-item">
            <span class="icon">⏱</span>
            <span>
                @php
                    $duration = $exercise->duration ?? '00:00:00';
                    $parts = explode(':', $duration);
                    $h = (int)$parts[0]; $m = (int)$parts[1]; $s = (int)$parts[2];
                    if($h>0) echo "{$h} giờ {$m} phút";
                    elseif($m>0) echo "{$m} phút";
                    else echo "{$s} giây";
                @endphp
            </span>
        </div>
        <div class="stat-item">
            <span class="icon">🔥</span>
            <span>{{ $exercise->calories_burned ?? 0 }} kcal</span>
        </div>
        <div class="stat-item">
            <span class="icon">🔄</span>
            <span>{{ $exercise->practice_round ?? 0 }} vòng</span>
        </div>
        <div class="stat-item">
            <span class="icon">💪</span>
            <span>{{ $exercise->muscle_group ?? 'Full body' }}</span>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <button class="tab-btn active" data-tab="info">Thông tin</button>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Thông tin chi tiết -->
        <div class="tab-panel active" id="info">
            <div class="workout-info">

                <!-- Tổng quan -->
                <div class="info-card">
                    <h3>Tổng quan</h3>
                    <p>
                        Bài tập <strong>{{ $exercise->name_workout }}</strong> tập trung vào nhóm cơ 
                        <strong>{{ $exercise->muscle_group ?? 'toàn thân' }}</strong>, đốt cháy 
                        <strong>{{ $exercise->calories_burned ?? 0 }} calories</strong> trong 
                        <strong>
                        @php
                            if($h>0) echo "{$h} giờ {$m} phút";
                            else echo "{$m} phút";
                        @endphp
                        </strong> với <strong>{{ $exercise->practice_round ?? 0 }} vòng</strong>.
                    </p>
                </div>

                <!-- Thông số chi tiết -->
                <div class="info-card">
                    <h3>Chi tiết thông số</h3>
                    <ul class="workout-steps">
                        <li>
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Nhóm cơ</strong>
                                <p>{{ $exercise->muscle_group ?? 'Chưa phân loại' }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Thời lượng</strong>
                                <p>{{ $h }} giờ {{ $m }} phút {{ $s }} giây</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Số vòng tập</strong>
                                <p>{{ $exercise->practice_round ?? 0 }} vòng</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <strong>Calorie tiêu thụ</strong>
                                <p>{{ $exercise->calories_burned ?? 0 }} kcal</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Tips -->
                <div class="info-card workout-tips">
                    <h3>💡 Lưu ý quan trọng</h3>
                    <ul>
                        <li>Khởi động kỹ trước khi tập để tránh chấn thương</li>
                        <li>Giữ nhịp thở đều đặn trong quá trình tập luyện</li>
                        <li>Nghỉ ngơi hợp lý giữa các vòng tập</li>
                        <li>Uống đủ nước trước, trong và sau khi tập</li>
                        <li>Dừng ngay nếu cảm thấy đau hoặc khó chịu bất thường</li>
                    </ul>
                </div>

            </div>
        </div>


    </div>
</div>

  

</div>

<script defer src="{{ asset('js/workout.js') }}"></script>
@endsection
