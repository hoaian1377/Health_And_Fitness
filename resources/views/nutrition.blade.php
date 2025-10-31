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
        <!-- Main Content -->
        <div class="main-content">
            <!-- Hero Banner -->
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-title">Khám phá chế độ dinh dưỡng<br>hoàn hảo cho bạn 🥗</div>
                    <div class="hero-subtitle">Hơn 300+ thực đơn khoa học, phù hợp mọi mục tiêu</div>
                    <button class="hero-btn">Xem thực đơn</button>
                    <!-- Search bar: người dùng có thể tìm món ăn theo từ khóa -->
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass search-icon" aria-hidden="true"></i>
                        <input id="meal-search" type="search" placeholder="Tìm món ăn..." aria-label="Tìm món ăn">
                        <button id="search-clear" type="button" title="Xóa tìm kiếm" style="display: none;"><i class="fa-solid fa-times" aria-hidden="true"></i></button>
                    </div>
                </div>
                <!-- Illustration on the right to make hero visually balanced -->
                <div class="hero-illustration">
                    <img src="{{ asset('images/nutrition-hero.jpg') }}" alt="Nutrition illustration">
                </div>
            </div>

            <!-- Nutrition Section -->
            <div class="section-header">
                <h2 class="section-title">Thực đơn phổ biến</h2>
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="weight-loss">Giảm cân</button>
                <button class="tab" data-category="muscle-gain">Tăng cơ</button>
                <button class="tab" data-category="balanced">Cân bằng</button>
                <button class="tab" data-category="vegetarian">Chay</button>
            </div>

            <!-- Meal Grid -->
            <div class="workout-grid">
                <!-- Món 1 -->
                <div class="workout-card" data-category="weight-loss">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal1.jpg') }}" alt="Meal">
                        <div class="workout-badge">MỚI</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Salad Ức Gà Giảm Cân</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 15 phút</span>
                            <span>🔥 250 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 2 -->
                <div class="workout-card" data-category="muscle-gain">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal2.jpg') }}" alt="Meal">
                        <div class="workout-badge">PHỔ BIẾN</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Bữa Ăn Protein Cao</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 30 phút</span>
                            <span>🔥 550 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <a href="resources/views/meal-detail" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 3 -->
                <div class="workout-card" data-category="weight-loss">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal3.jpg') }}" alt="Meal">
                        <div class="workout-badge">DETOX</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Sinh Tố Xanh Detox</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 10 phút</span>
                            <span>🔥 180 calo</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 4 -->
                <div class="workout-card" data-category="balanced">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal4.jpg') }}" alt="Meal">
                        <div class="workout-badge">CÂN BẰNG</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Cơm Gạo Lứt Dinh Dưỡng</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 25 phút</span>
                            <span>🔥 400 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 5 -->
                <div class="workout-card" data-category="vegetarian">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal5.jpg') }}" alt="Meal">
                        <div class="workout-badge">CHAY</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Buddha Bowl Chay</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 20 phút</span>
                            <span>🔥 350 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 6 -->
                <div class="workout-card" data-category="muscle-gain">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal6.jpg') }}" alt="Meal">
                        <div class="workout-badge">PROTEIN</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Bò Áp Chảo Protein</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 35 phút</span>
                            <span>🔥 600 calo</span>
                            <span>⭐ 5.0</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 7 -->
                <div class="workout-card" data-category="weight-loss">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal7.jpg') }}" alt="Meal">
                        <div class="workout-badge">LOW CARB</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Cá Hồi Nướng Chanh</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 25 phút</span>
                            <span>🔥 320 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 8 -->
                <div class="workout-card" data-category="muscle-gain">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal8.jpg') }}" alt="Meal">
                        <div class="workout-badge">POWER</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Thịt Bò Bít Tết</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 40 phút</span>
                            <span>🔥 650 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 9 -->
                <div class="workout-card" data-category="balanced">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal9.jpg') }}" alt="Meal">
                        <div class="workout-badge">HEALTHY</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Súp Rau Củ Quả</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 20 phút</span>
                            <span>🔥 200 calo</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <!-- Món 10-18 tương tự -->
                <div class="workout-card" data-category="weight-loss">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal10.jpg') }}" alt="Meal">
                        <div class="workout-badge">KETO</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Trứng Cuộn Rau Củ</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 15 phút</span>
                            <span>🔥 280 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="vegetarian">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal11.jpg') }}" alt="Meal">
                        <div class="workout-badge">VEGAN</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Bún Chay Nấm</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 30 phút</span>
                            <span>🔥 380 calo</span>
                            <span>⭐ 5.0</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="muscle-gain">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal12.jpg') }}" alt="Meal">
                        <div class="workout-badge">HIGH PROTEIN</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Gà Nướng Bơ Tỏi</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 45 phút</span>
                            <span>🔥 520 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="balanced">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal13.jpg') }}" alt="Meal">
                        <div class="workout-badge">BALANCED</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Cơm Trộn Hàn Quốc</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 20 phút</span>
                            <span>🔥 420 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="vegetarian">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal14.jpg') }}" alt="Meal">
                        <div class="workout-badge">PLANT-BASED</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Đậu Hũ Sốt Cà</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 25 phút</span>
                            <span>🔥 300 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="weight-loss">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal15.jpg') }}" alt="Meal">
                        <div class="workout-badge">LIGHT</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Phở Gà Không Dầu</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 35 phút</span>
                            <span>🔥 340 calo</span>
                            <span>⭐ 5.0</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Meal Section -->
            <div class="section-header">
                <h2 class="section-title">Món ăn mới nhất</h2>
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="breakfast">Bữa sáng</button>
                <button class="tab" data-category="lunch">Bữa trưa</button>
                <button class="tab" data-category="dinner">Bữa tối</button>
                <button class="tab" data-category="snack">Ăn vặt</button>
            </div>

            <!-- Meal Grid -->
            <div class="workout-grid">
                <div class="workout-card" data-category="breakfast">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal16.jpg') }}" alt="Meal">
                        <div class="workout-badge">BREAKFAST</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Yến Mạch Trái Cây</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 10 phút</span>
                            <span>🔥 280 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="lunch">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal17.jpg') }}" alt="Meal">
                        <div class="workout-badge">LUNCH</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Bò Xào Rau Củ</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 30 phút</span>
                            <span>🔥 450 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="snack">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/meal18.jpg') }}" alt="Meal">
                        <div class="workout-badge">SNACK</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Hạnh Nhân Rang</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 5 phút</span>
                            <span>🔥 150 calo</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Dễ làm</div>
                            <a href="{{ route('meal.detail.page') }}" class="start-btn">Xem công thức</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script defer src="{{ asset('js/nutrition.js') }}"></script>

</body>
</html>
@endsection