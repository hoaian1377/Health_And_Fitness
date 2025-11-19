@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">

<div class="workout-detail-page">

    <!-- Tên bài tập -->
    <h1>{{ $exercise->name_workout }}</h1>

    <!-- Video Placeholder -->
    <div class="video-container">
        @if($exercise->video_url)
            <video class="video-frame" controls>
                <source src="{{ $exercise->video_url }}" type="video/mp4">
                Trình duyệt không hỗ trợ video.
            </video>
        @else
            <div class="video-frame" style="background: #e2e8f0; height: 200px; display:flex; align-items:center; justify-content:center; border-radius:15px;">
                Video bài tập chưa có
            </div>
        @endif
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
        <button class="tab-btn" data-tab="goals">Mục tiêu</button>
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

        <!-- Mục tiêu tập luyện -->
        <div class="tab-panel" id="goals">
            <div class="workout-info">
                <div class="info-card">
                    <h3>Mục tiêu tập luyện</h3>
                    @php
                        $goals = $exercise->fitness_goals ?? (isset($exercise->fitness_goal) ? collect([$exercise->fitness_goal]) : null);
                    @endphp

                    @if($goals && $goals->count()>0)
                        <ul class="workout-steps">
                            @foreach($goals as $index => $goal)
                                <li>
                                    <div class="step-number">{{ $index + 1 }}</div>
                                    <div class="step-content">
                                        <strong>{{ $goal->goal_name }}</strong>
                                        <p>{{ $goal->description ?? 'Bài tập này giúp bạn đạt được mục tiêu.' }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="workout-tips">
                            <h3>🎯 Để đạt hiệu quả tốt nhất</h3>
                            <ul>
                                <li>Thực hiện đúng kỹ thuật động tác</li>
                                <li>Tập luyện đều đặn 3-4 lần/tuần</li>
                                <li>Kết hợp chế độ dinh dưỡng phù hợp</li>
                                <li>Theo dõi tiến độ và điều chỉnh cường độ tập</li>
                                <li>Tham khảo huấn luyện viên nếu cần</li>
                            </ul>
                        </div>
                    @else
                        <p style="text-align:center;">ℹ️ Bài tập chưa có mục tiêu cụ thể.</p>
                    @endif
                </div>
            </div>
        </div>

    </div>

</div>

<script defer src="{{ asset('js/workout.js') }}"></script>
@endsection
