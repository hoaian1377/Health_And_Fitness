@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">

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
