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
    <!-- Thanh điều hướng -->
    <nav class="navbar">
        <!-- Logo -->
        <a href="#" class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Logo">
            <span>Health<span>Fit</span></span>
        </a>

        <!-- Nút mở menu trên mobile -->
        <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>

        <!-- Menu chính -->
        <div class="menu" id="menu">
            <a href="{{ route('home.page') }}">Trang Chủ</a>
            <a href="{{ route('health.page') }}">Sức Khỏe</a>
            <a href="{{ route('fitness.page') }}">Tập Luyện</a>
            <a href="{{ route('nutrition.page') }}">Dinh Dưỡng</a>
            <a href="{{ route('community.page') }}">Cộng Đồng</a>

            <!-- Auth buttons (có thể thay đổi tùy trạng thái đăng nhập) -->
            <div class="auth-buttons">
                <a href="#" class="btn-login">Đăng nhập</a>
                <a href="#" class="btn-register">Đăng ký</a>
            </div>

            
        </div>
    </nav>

    <div class="app-container">
        <!-- Main Content -->
        <div class="main-content">
            <!-- Hero Banner -->
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-title">Bắt đầu hành trình<br>tập luyện của bạn 💪</div>
                    <div class="hero-subtitle">Hơn 500+ bài tập chuyên nghiệp, phù hợp mọi cấp độ</div>
                    <button class="hero-btn">Tập luyện ngay</button>
                </div>
            </div>

            <!-- Workout Section -->
            <div class="section-header">
                <h2 class="section-title">Bài tập phổ biến</h2>
                <button class="view-all-btn">
                    Xem tất cả
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
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
                <div class="workout-card" data-category="muscle">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">MỚI</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Nâng cao & làm tròn mông</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 7 phút</span>
                            <span>🔥 65 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Người bắt đầu</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="muscle">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">PHỔ BIẾN</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Chuỗi xây dựng cơ tay</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 18 phút</span>
                            <span>🔥 180 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="fat-burn">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">THÁCH THỨC</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Tạo hình mông & nâng mông</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 24 phút</span>
                            <span>🔥 250 calo</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="fat-burn">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1518611012118-696072aa579a?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">GIẢM ĐAU</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Cổ & giảm căng vai</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 12 phút</span>
                            <span>🔥 45 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Người bắt đầu</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="maintain">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1599901860904-17e6ed7083a0?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">SÁNG</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Khởi động buổi sáng</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 15 phút</span>
                            <span>🔥 95 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Người bắt đầu</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="fat-burn">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1601422407692-ec4eeec1d9b3?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">HIIT</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Đốt cháy toàn thân</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 30 phút</span>
                            <span>🔥 350 calo</span>
                            <span>⭐ 5.0</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                    
                </div>
            </div>

                <div class="slider">
                    <div class="slides">
                        <!-- Slide 1 -->
                        <div class="slide">
                            <div class="workout-card">
                                <div class="workout-card-image">
                                    <img src="https://images.unsplash.com/photo-1571019613576-2b22c76fd955?w=800&h=400&fit=crop" alt="Abs Workout">
                                    <div class="workout-badge">ABS</div>
                                    <div class="difficulty-indicator">
                                        <div class="difficulty-dot"></div>
                                        <div class="difficulty-dot"></div>
                                        <div class="difficulty-dot" style="opacity: 0.3;"></div>
                                    </div>
                                </div>
                                <div class="workout-card-content">
                                    <h3 class="workout-card-title">6 Pack Abs Challenge</h3>
                                    <div class="workout-card-meta">
                                        <span>⏱ 20 phút</span>
                                        <span>🔥 200 calo</span>
                                        <span>⭐ 4.9</span>
                                    </div>
                                    <div class="workout-card-footer">
                                        <div class="workout-level intermediate">Trung bình</div>
                                        <button class="start-btn">Bắt đầu</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="slide">
                            <div class="workout-card">
                                <div class="workout-card-image">
                                    <img src="https://images.unsplash.com/photo-1538805060514-97d9cc17730c?w=800&h=400&fit=crop" alt="HIIT Workout">
                                    <div class="workout-badge">HIIT</div>
                                    <div class="difficulty-indicator">
                                        <div class="difficulty-dot"></div>
                                        <div class="difficulty-dot"></div>
                                        <div class="difficulty-dot"></div>
                                    </div>
                                </div>
                                <div class="workout-card-content">
                                    <h3 class="workout-card-title">Power Cardio Rush</h3>
                                    <div class="workout-card-meta">
                                        <span>⏱ 25 phút</span>
                                        <span>🔥 280 calo</span>
                                        <span>⭐ 4.8</span>
                                    </div>
                                    <div class="workout-card-footer">
                                        <div class="workout-level advanced">Nâng cao</div>
                                        <button class="start-btn">Bắt đầu</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="slide">
                            <div class="workout-card">
                                <div class="workout-card-image">
                                    <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&h=400&fit=crop" alt="Yoga Session">
                                    <div class="workout-badge">YOGA</div>
                                    <div class="difficulty-indicator">
                                        <div class="difficulty-dot"></div>
                                        <div class="difficulty-dot" style="opacity: 0.3;"></div>
                                        <div class="difficulty-dot" style="opacity: 0.3;"></div>
                                    </div>
                                </div>
                                <div class="workout-card-content">
                                    <h3 class="workout-card-title">Evening Zen Flow</h3>
                                    <div class="workout-card-meta">
                                        <span>⏱ 15 phút</span>
                                        <span>🔥 50 calo</span>
                                        <span>⭐ 5.0</span>
                                    </div>
                                    <div class="workout-card-footer">
                                        <div class="workout-level beginner">Người bắt đầu</div>
                                        <button class="start-btn">Bắt đầu</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Navigation arrows -->
                    <button class="slide-arrow prev-arrow">❮</button>
                    <button class="slide-arrow next-arrow">❯</button>
                    
                    <!-- Dots/circles -->
                    <div class="slide-dots">
                        <span class="dot active"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </div>
                </div>
            </div>

            <!-- New Workout Section -->
            <div class="section-header">
                <h2 class="section-title">Bài tập mới nhất</h2>
                <button class="view-all-btn">
                    Xem tất cả
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </div>

            <!-- Tabs -->
            <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="fat-burn">Cardio</button>
                <button class="tab" data-category="muscle">Strength</button>
                <button class="tab" data-category="flexibility">Flexibility</button>
                <button class="tab" data-category="recovery">Recovery</button>
            </div>

            <!-- Workout Grid -->
            <div class="workout-grid">
                <div class="workout-card" data-category="muscle">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1434682881908-b43d0467b798?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">HIIT</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">HIIT Intense Fat Burn</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 45 phút</span>
                            <span>🔥 450 calo</span>
                            <span>⭐ 4.9</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level advanced">Nâng cao</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card" data-category="flexibility">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1574680178050-55c6a6a96e0a?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">STRENGTH</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Full Body Strength</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 35 phút</span>
                            <span>🔥 320 calo</span>
                            <span>⭐ 4.8</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level intermediate">Trung bình</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>

                <div class="workout-card">
                    <div class="workout-card-image">
                        <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500&h=300&fit=crop" alt="Workout">
                        <div class="workout-badge">MOBILITY</div>
                        <div class="difficulty-indicator">
                            <div class="difficulty-dot"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                            <div class="difficulty-dot" style="opacity: 0.3;"></div>
                        </div>
                    </div>
                    <div class="workout-card-content">
                        <h3 class="workout-card-title">Dynamic Stretching</h3>
                        <div class="workout-card-meta">
                            <span>⏱ 20 phút</span>
                            <span>🔥 120 calo</span>
                            <span>⭐ 4.7</span>
                        </div>
                        <div class="workout-card-footer">
                            <div class="workout-level beginner">Người bắt đầu</div>
                            <button class="start-btn">Bắt đầu</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <!-- Footer -->
    <footer>
        <p>© 2025 Health & Fitness App — Giữ sức khỏe, sống hạnh phúc 🌿</p>
    </footer>

    <!-- Scripts -->
    <script defer src="{{ asset('js/fitness.js') }}"></script>

</body>