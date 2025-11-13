@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Món Ăn - Health & Fitness App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/meal-detail.css') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="app-container">
        <div class="main-content">
            <!-- Breadcrumb -->
            @if(!$mealplan)
                <p>Chưa có dữ liệu</p>
            @else
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
                            <button class="btn-primary">
                                <i class="fa-solid fa-bookmark"></i> Lưu công thức
                            </button>
                            <button class="btn-secondary">
                                <i class="fa-solid fa-share-nodes"></i> Chia sẻ
                            </button>
                            <button class="btn-secondary">
                                <i class="fa-solid fa-print"></i> In công thức
                            </button>
                        </div>
                    </div>

                    <div class="meal-header-image">
                        <img src="{{ asset('images/meal1.jpg') }}" alt="Salad Ức Gà">
                        <div class="image-overlay">
                            <button class="view-gallery-btn">
                                <i class="fa-solid fa-images"></i> Xem thêm 5 ảnh
                            </button>
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
                                <span class="nutrition-value">{{ $mealplan->food_weight}}</span>
                                <span class="nutrition-label">Khối Lượng</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="content-grid">
                    <!-- Left Column -->
                    <div class="left-column">
                        <!-- Ingredients -->
                        <div class="content-section">
                            <h2 class="section-title">
                                <i class="fa-solid fa-list-check"></i> Nguyên Liệu
                            </h2>
                            <div class="portion-selector">
                                <label>Số khẩu phần:</label>
                                <div class="portion-controls">
                                    <button class="portion-btn" id="decrease">-</button>
                                    <span class="portion-value" id="portion">2</span>
                                    <button class="portion-btn" id="increase">+</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column -->
                <div class="right-column">
                    <!-- Tips -->
                    <div class="tips-card">
                        <h3><i class="fa-solid fa-lightbulb"></i> Mẹo Hay</h3>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Có thể thay thế ức gà bằng cá hồi hoặc tôm</li>
                            <li><i class="fa-solid fa-check"></i> Thêm hạt dinh dưỡng để tăng độ giòn</li>
                            <li><i class="fa-solid fa-check"></i> Làm sẵn ức gà để dùng trong 2-3 ngày</li>
                            <li><i class="fa-solid fa-check"></i> Sốt nên cho vào ngay trước khi ăn</li>
                        </ul>
                    </div>

                    <!-- Video -->
                    <div class="video-card">
                        <h3><i class="fa-solid fa-video"></i> Video Hướng Dẫn</h3>
                        <div class="video-placeholder">
                            <i class="fa-solid fa-play-circle"></i>
                            <p>Xem video chi tiết<br>cách làm món này</p>
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="tags-card">
                        <h3><i class="fa-solid fa-tags"></i> Phân Loại</h3>
                        <div class="tags-list">
                            <span class="tag">Giảm cân</span>
                            <span class="tag">Ít calo</span>
                            <span class="tag">High protein</span>
                            <span class="tag">Healthy</span>
                            <span class="tag">Keto-friendly</span>
                            <span class="tag">Bữa trưa</span>
                        </div>
                    </div>

                    <!-- Storage Info -->
                    <div class="storage-card">
                        <h3><i class="fa-solid fa-box"></i> Bảo Quản</h3>
                        <div class="storage-info">
                            <div class="storage-item">
                                <i class="fa-solid fa-temperature-low"></i>
                                <div>
                                    <strong>Tủ lạnh</strong>
                                    <p>1-2 ngày (không trộn sốt)</p>
                                </div>
                            </div>
                            <div class="storage-item">
                                <i class="fa-solid fa-snowflake"></i>
                                <div>
                                    <strong>Tủ đông</strong>
                                    <p>Không nên đông</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Meals -->
            <div class="related-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-heart"></i> Món Ăn Tương Tự
                </h2>
                <div class="related-grid">
                    <div class="related-card">
                        <img src="{{ asset('images/meal2.jpg') }}" alt="Related meal">
                        <div class="related-content">
                            <h4>Bữa Ăn Protein Cao</h4>
                            <div class="related-meta">
                                <span>⏱ 30 phút</span>
                                <span>🔥 550 calo</span>
                            </div>
                        </div>
                    </div>
                    <div class="related-card">
                        <img src="{{ asset('images/meal3.jpg') }}" alt="Related meal">
                        <div class="related-content">
                            <h4>Sinh Tố Xanh Detox</h4>
                            <div class="related-meta">
                                <span>⏱ 10 phút</span>
                                <span>🔥 180 calo</span>
                            </div>
                        </div>
                    </div>
                    <div class="related-card">
                        <img src="{{ asset('images/meal4.jpg') }}" alt="Related meal">
                        <div class="related-content">
                            <h4>Cơm Gạo Lứt Dinh Dưỡng</h4>
                            <div class="related-meta">
                                <span>⏱ 25 phút</span>
                                <span>🔥 400 calo</span>
                            </div>
                        </div>
                    </div>
                    <div class="related-card">
                        <img src="{{ asset('images/meal5.jpg') }}" alt="Related meal">
                        <div class="related-content">
                            <h4>Buddha Bowl Chay</h4>
                            <div class="related-meta">
                                <span>⏱ 20 phút</span>
                                <span>🔥 350 calo</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="reviews-section">
                <h2 class="section-title">
                    <i class="fa-solid fa-comments"></i> Đánh Giá (247)
                </h2>
                
                <div class="review-summary">
                    <div class="rating-overview">
                        <div class="big-rating">4.8</div>
                        <div class="stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p>247 đánh giá</p>
                    </div>
                    <button class="btn-write-review">
                        <i class="fa-solid fa-pen"></i> Viết đánh giá
                    </button>
                </div>

                <div class="reviews-list">
                    <div class="review-item">
                        <div class="review-header">
                            <img src="{{ asset('images/user1.jpg') }}" alt="User" class="review-avatar">
                            <div class="review-info">
                                <strong>Minh Anh</strong>
                                <div class="review-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span class="review-date">2 ngày trước</span>
                            </div>
                        </div>
                        <p class="review-text">
                            Món này quá tuyệt vời! Vừa ngon vừa lành mạnh. Tôi đã làm theo công thức và cả nhà đều thích. 
                            Sẽ làm lại nhiều lần nữa. Cảm ơn đã chia sẻ!
                        </p>
                        <div class="review-actions">
                            <button><i class="fa-solid fa-thumbs-up"></i> Hữu ích (24)</button>
                            <button><i class="fa-solid fa-reply"></i> Trả lời</button>
                        </div>
                    </div>

                    <div class="review-item">
                        <div class="review-header">
                            <img src="{{ asset('images/user2.jpg') }}" alt="User" class="review-avatar">
                            <div class="review-info">
                                <strong>Tuấn Kiệt</strong>
                                <div class="review-stars">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-regular fa-star"></i>
                                </div>
                                <span class="review-date">1 tuần trước</span>
                            </div>
                        </div>
                        <p class="review-text">
                            Rất dễ làm và nhanh gọn. Phù hợp cho người bận rộn như mình. Tuy nhiên tôi thấy cần thêm chút 
                            gia vị cho đậm đà hơn.
                        </p>
                        <div class="review-actions">
                            <button><i class="fa-solid fa-thumbs-up"></i> Hữu ích (12)</button>
                            <button><i class="fa-solid fa-reply"></i> Trả lời</button>
                        </div>
                    </div>
                </div>

                <button class="btn-load-more">Xem thêm đánh giá</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/meal-detail.js') }}"></script>
</body>
</html>
@endsection