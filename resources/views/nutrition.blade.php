@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinh Dưỡng - Health & Fitness App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/nutrition.css') }}">
</head>
<body>
    <div class="app-container">
        <div class="main-content">
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-title">Khám phá chế độ dinh dưỡng<br>hoàn hảo cho bạn 🥗</div>
                    <div class="hero-subtitle">Hơn 300+ thực đơn khoa học, phù hợp mọi mục tiêu</div>
                    <button class="hero-btn">Xem thực đơn</button>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass search-icon" aria-hidden="true"></i>
                        <input id="meal-search" type="search" placeholder="Tìm món ăn..." aria-label="Tìm món ăn">
                        <button id="search-clear" type="button" title="Xóa tìm kiếm" style="display: none;">
                            <i class="fa-solid fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="hero-illustration">
                    <img src="{{ asset('images/meal19.webp') }}" alt="Nutrition illustration">
                </div>
            </div>

            <div class="section-header">
                <h2 class="section-title">Thực đơn phổ biến</h2>
                        </div>
             <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="giam-can">Giảm cân</button>
                <button class="tab" data-category="tang-co">Tăng cơ</button>
                <button class="tab" data-category="can-bang">Cân bằng</button>
                <button class="tab" data-category="suc-khoe">Sức khỏe</button>
            </div>

            <div class="workout-grid">
                @if($mealplan->isEmpty())
                    <p>Chưa có thông tin món ăn nào!!!</p>
                @else
                    @foreach($mealplan as $mp)
                        <div class="workout-card" data-category="{{ $mp->category ?? 'all' }}">
                            <div class="workout-card-image">
                                <img src="{{ $mp->urls }}" alt="{{ $mp->meal_name }}">
                                <div class="workout-badge">{{ strtoupper($mp->tag ?? 'MÓN MỚI') }}</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot" style="opacity: 0.3;"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">{{ $mp->meal_name }}</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ {{ $mp->time ?? 'N/A' }}</span>
                                    <span>🔥 {{ $mp->calories ?? '---' }} calo</span>
                                    <span>⭐ {{ $mp->rating ?? '4.5' }}</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">{{ $mp->difficulty ?? 'Dễ làm' }}</div>
                                    <a href="{{ route('meal-detail', ['id'=>$mp->meal_planID]) }}" class="start-btn">Xem công thức</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script defer src="{{ asset('js/nutrition.js') }}"></script>
</body>
</html>
@endsection
