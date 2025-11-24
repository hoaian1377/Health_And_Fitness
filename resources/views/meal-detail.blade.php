@extends('base')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/meal-detail.css') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

<div class="app-container">
    <div class="main-content">

        @if(!$mealplan)
            <p>Chưa có dữ liệu</p>
        @else

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <span class="current">{{ $mealplan->meal_plan }}</span>
        </div>

        <!-- Meal Header -->
        <div class="meal-header">
            <div class="meal-header-content">

                <div class="meal-badge-container">
                    <span class="meal-category">{{ $mealplan->fitness_goal->goal_name }}</span>
                    <span class="meal-difficulty">Dễ làm</span>
                </div>

                <h1 class="meal-title">{{ $mealplan->meal_name }}</h1>

                <p class="meal-description">
                    Món salad ức gà giàu protein, ít calo, hoàn hảo cho bữa trưa lành mạnh.
                    Kết hợp rau xanh tươi mát với ức gà nướng thơm ngon, sốt chanh dây thanh nhẹ.
                </p>

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="stat-item">
                        <i class="fa-solid fa-clock"></i>
                        <div>
                            <span class="stat-value">15 phút</span>
                            <span class="stat-label">Thời gian</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-fire"></i>
                        <div>
                            <span class="stat-value">{{ $mealplan->calories }}</span>
                            <span class="stat-label">Năng lượng</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-users"></i>
                        <div>
                            <span class="stat-value">2 người</span>
                            <span class="stat-label">Khẩu phần</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-star"></i>
                        <div>
                            <span class="stat-value">4.8/5</span>
                            <span class="stat-label">Đánh giá</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-primary"><i class="fa-solid fa-bookmark"></i> Lưu công thức</button>
                    <button class="btn-secondary"><i class="fa-solid fa-share-nodes"></i> Chia sẻ</button>
                    <button class="btn-secondary"><i class="fa-solid fa-print"></i> In công thức</button>
                </div>
            </div>
        </div>

        <!-- Nutrition Facts -->
        <div class="nutrition-section">
            <h2 class="section-title">
                <i class="fa-solid fa-chart-pie"></i> Thông Tin Dinh Dưỡng
            </h2>

            <div class="nutrition-grid">
                <div class="nutrition-card">
                    <div class="nutrition-icon protein">
                        <i class="fa-solid fa-drumstick-bite"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->protein }}</span>
                        <span class="nutrition-label">Protein</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon carbs">
                        <i class="fa-solid fa-bread-slice"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->carbs }}</span>
                        <span class="nutrition-label">Carbs</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon fat">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->fat }}</span>
                        <span class="nutrition-label">Chất béo</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon fiber">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->food_weight }}</span>
                        <span class="nutrition-label">Khối Lượng</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-grid">
            <div class="recipe-box">
                <h3 class="recipe-title">
                    <i class="fa-solid fa-utensils"></i> Cách Nấu món ăn {{ $mealplan->meal_name }}
                </h3>

                <div class="recipe-content">
                    {!! nl2br(e($mealplan->description)) !!}
                </div>
            </div>

            <div class="tags-card">
                <h3><i class="fa-solid fa-tags"></i> Phân Loại</h3>
                <div class="tags-list">
                    <span class="tag">Giảm cân</span>
                    <span class="tag">Ít calo</span>
                    <span class="tag">High protein</span>
                    <span class="tag">Healthy</span>
                    <span class="tag">Keto</span>
                    <span class="tag">Bữa trưa</span>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>

<!-- Review Section - Moved Outside -->
<div class="review-section-wrapper">
    <div class="review-container">
        <div class="review-header">
            <h2>
                <i class="fa-solid fa-comments"></i>
                Đánh Giá & Nhận Xét
            </h2>
            <div class="review-stats">
                <span class="total-reviews">0 đánh giá</span>
            </div>
        </div>

        @auth
        <!-- Review Input Form -->
        <div class="review-form-card">
            <div class="user-avatar">
                <i class="fa-solid fa-user-circle"></i>
            </div>
            <div class="review-form-content">
                <!-- Star Rating -->
                <div class="star-rating-inline">
                    <span>Đánh giá của bạn:</span>
                    <div class="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <span class="rating-value">0/5</span>
                </div>

                <!-- Review Input -->
                <textarea id="reviewInput" placeholder="Chia sẻ trải nghiệm của bạn về món ăn này..."></textarea>
                
                <div class="form-actions">
                    <button id="submitReview" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Gửi đánh giá
                    </button>
                </div>
            </div>
        </div>
        @else
        <!-- Login Required -->
        <div class="login-required-card">
            <i class="fa-solid fa-lock"></i>
            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá món ăn này</p>
        </div>
        @endauth

        <!-- Reviews List -->
        <div class="reviews-list" id="reviewsList">
            <div class="empty-reviews">
                <i class="fa-solid fa-comment-slash"></i>
                <p>Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
            </div>
        </div>
    </div>
</div>

<!-- Pass user data to JavaScript -->
@auth
<script>
    window.currentUser = {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}",
        id: "{{ Auth::user()->id }}"
    };
</script>
@endauth



<script src="{{ asset('js/meal-detail.js') }}"></script>
@endsection