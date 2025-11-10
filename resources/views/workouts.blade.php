@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tập Luyện - Health & Fitness App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/fitness.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">



</head>
<body>
 

    <div class="app-container">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Hero Banner -->
            <div class="hero-banner">
                
                <div class="hero-content">
                    <div class="hero-title">Bắt đầu hành trình<br>tập luyện của bạn 💪</div>
                    <div class="hero-subtitle">Hơn 500+ bài tập chuyên nghiệp, phù hợp mọi cấp độ</div>
                    <button class="hero-btn">Tập luyện ngay</button>
                    <!-- Search bar: người dùng có thể tìm bài tập theo từ khóa -->
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass search-icon" aria-hidden="true"></i>
                        <input id="exercise-search" type="search" placeholder="Tìm bài tập..." aria-label="Tìm bài tập">
                        <button id="search-clear" type="button" title="Xóa tìm kiếm"><i class="fa-solid fa-times" aria-hidden="true"></i></button>
                    </div>
                </div>
                <!-- Illustration on the right to make hero visually balanced -->
                <div class="hero-illustration">
                    <img src="{{ asset('images/anh21.jpg') }}" alt="Fitness illustration">
                </div>
            </div>

            <!-- Workout Section -->
            <div class="section-header">
                <h2 class="section-title">Bài tập phổ biến</h2>
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="muscle">Xây dựng cơ bắp</button>
                <button class="tab" data-category="fat-burn">Đốt cháy mỡ</button>
                <button class="tab" data-category="maintain">Giữ dáng</button>
                <button class="tab" data-category="yoga">Yoga & Giãn cơ</button>
            </div>

            <!-- Workout Grid -->
            <div class="workout-grid">
                @if($exercises->isEmpty())
                    <p>Chưa có bài tập nào trong cơ sở dữ liệu.</p>
                @else
                    @foreach($exercises as $ex)
                    <div class="workout-card" data-category="{{ \Illuminate\Support\Str::slug($ex->muscle_group ?: 'other') }}">
                        <div class="workout-card-image">
                        <img src="{{ $ex->urls }}" alt="{{ $ex->name_workout }}">
                        <div class="workout-badge">{{ $ex->practice_round ? $ex->practice_round.' vòng' : 'Bài' }}</div>
                        </div>

                        <div class="workout-card-content">
                        <h3 class="workout-card-title">{{ $ex->name_workout }}</h3>

                        <div class="workout-card-meta">
                            {{-- duration trong DB có dạng 00:00:25 — hiển thị dễ nhìn --}}
                            <span>⏱ {{ \Carbon\Carbon::createFromFormat('H:i:s', $ex->duration ?? '00:00:00')->format('H:mm:ss') }}</span>
                            <span>🔥 {{ $ex->calories_burned ?? 0 }} calo</span>
                            <span>💪 {{ $ex->muscle_group }}</span>
                        </div>

                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Cấp độ</div>
                            <a href="{{ route('workouts.detail', ['id' => $ex->workout_exerciseID]) }}" class="start-btn">Xem chi tiết</a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

    <!-- Scripts -->
    <script defer src="{{ asset('js/fitness.js') }}"></script>

</body>
</html>
@endsection