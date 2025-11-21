@extends('base')

@section('content')
<link> rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/fitness.css') }}">
<div class="app-container">


    <div class="main-content">
        <!-- Hero Banner -->
        <div class="hero-banner">
            <div class="hero-content">
                <div class="hero-title">Bắt đầu hành trình<br>tập luyện của bạn 💪</div>
                <div class="hero-subtitle">Hơn 500+ bài tập chuyên nghiệp, phù hợp mọi cấp độ</div>
                <button class="hero-btn">Tập luyện ngay</button>

                <!-- Search Bar -->
                <div class="search-bar">
                    <i class="fa-solid fa-magnifying-glass search-icon" aria-hidden="true"></i>
                    <input id="exercise-search" type="search" placeholder="Tìm bài tập..." aria-label="Tìm bài tập">
                    <button id="search-clear" type="button" title="Xóa tìm kiếm">
                        <i class="fa-solid fa-times" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="hero-illustration">
                <img src="{{ asset('images/anh21.jpg') }}" alt="Fitness illustration">
            </div>
        </div>

        <!-- Workout Section Header -->

                    <div class="section-header">
                        <h2 class="section-title">Bài tập phổ biến</h2>
                    </div>

                    <!-- Tabs -->
                    <div class="tabs">
                        <a href="?filter=" class="tab {{ !request('filter') ? 'active' : '' }}">Tất cả</a>
                        <a href="?filter=Mông" class="tab {{ request('filter')=='Mông' ? 'active' : '' }}">Xây dựng cơ bắp</a>
                        <a href="?filter=Cardio" class="tab {{ request('filter')=='Cardio' ? 'active' : '' }}">Đốt cháy mỡ</a>
                        <a href="?filter=Dẻo dai" class="tab {{ request('filter')=='Dẻo dai' ? 'active' : '' }}">Yoga & Giãn cơ</a>
                    </div>



        <!-- Workout Grid -->
        <div class="workout-grid">
            @if($exercises->isEmpty())
                <p>Chưa có bài tập nào trong cơ sở dữ liệu.</p>
            @else
                @foreach($exercises as $ex)
                <div class="workout-card" data-category="{{ \Illuminate\Support\Str::slug($ex->fitness_goal->name ?? 'other') }}">

                    
                    <div class="workout-card-image">
                        <img src="{{ $ex->urls }}" alt="{{ $ex->name_workout }}">
                        <div class="workout-badge">
                            {{ $ex->practice_round ? $ex->practice_round.' vòng' : 'Bài' }}
                        </div>
                        {{-- Nếu muốn hiển thị difficulty dot --}}
                        <div class="difficulty-indicator">
                            <span class="difficulty-dot"></span>
                            <span class="difficulty-dot"></span>
                            <span class="difficulty-dot"></span>
                        </div>
                    </div>

                    <div class="workout-card-content">
                        <h3 class="workout-card-title">{{ $ex->name_workout }}</h3>

                        <div class="workout-card-meta">
                            @php
                                $duration = $ex->duration ?? '00:00:00';
                                try {
                                    // đảm bảo định dạng H:i:s
                                    $durationParts = explode(':', $duration);
                                    if(count($durationParts) !== 3){
                                        $durationFormatted = '00:00:00';
                                    } else {
                                        $durationFormatted = sprintf('%02d:%02d:%02d', $durationParts[0], $durationParts[1], $durationParts[2]);
                                    }
                                } catch (\Exception $e) {
                                    $durationFormatted = '00:00:00';
                                }
                            @endphp
                            <span>⏱ {{ $durationFormatted }}</span>
                            <span>🔥 {{ $ex->calories_burned ?? 0 }} calo</span>
                            <span>💪 {{ $ex->muscle_group }}</span>
                        </div>

                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Cấp độ</div>
                            <a href="{{ route('workouts-detail', ['id'=>$ex->workout_exerciseID]) }}" class="start-btn">Xem chi tiết</a>
                        </div>
                    </div>

                </div>
                @endforeach
            @endif
        </div>
    </div>

</div>

<script defer src="{{ asset('js/fitness.js') }}"></script>

@endsection
