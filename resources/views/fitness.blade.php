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
                <div class="workout-card" data-category="muscle">
                    <div class="workout-card-image">
                        <img src="{{ asset('images/anh1.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh2.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh3.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh4.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh5.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh6.jpg') }}" alt="Workout">
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
                                    <!-- Bài tập 1 -->
                    <div class="workout-card" data-category="muscle">
                        <div class="workout-card-image">
                            <img src="{{ asset('images/anh10.jpg') }}" alt="Workout">
                            <div class="workout-badge">Strength</div>
                            <div class="difficulty-indicator">
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                            </div>
                        </div>
                        <div class="workout-card-content">
                            <h3 class="workout-card-title">Tăng cơ tay và vai</h3>
                            <div class="workout-card-meta">
                                <span>⏱ 25 phút</span>
                                <span>🔥 280 calo</span>
                                <span>⭐ 4.8</span>
                            </div>
                            <div class="workout-card-footer">
                                <div class="workout-level intermediate">Trung bình</div>
                                <button class="start-btn">Bắt đầu</button>
                            </div>
                        </div>
                    </div>

                    <!-- Bài tập 2 -->
                    <div class="workout-card" data-category="muscle">
                        <div class="workout-card-image">
                            <img src="{{ asset('images/anh11.jpg') }}" alt="Workout">
                            <div class="workout-badge">Power</div>
                            <div class="difficulty-indicator">
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                            </div>
                        </div>
                        <div class="workout-card-content">
                            <h3 class="workout-card-title">Tập chân và mông săn chắc</h3>
                            <div class="workout-card-meta">
                                <span>⏱ 40 phút</span>
                                <span>🔥 400 calo</span>
                                <span>⭐ 4.9</span>
                            </div>
                            <div class="workout-card-footer">
                                <div class="workout-level advanced">Nâng cao</div>
                                <button class="start-btn">Bắt đầu</button>
                            </div>
                        </div>
                    </div>

                        <!-- Bài tập 3 -->
                        <div class="workout-card" data-category="muscle">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh12.webp') }}" alt="Workout">
                                <div class="workout-badge">Core</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Cơ bụng 6 múi</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 20 phút</span>
                                    <span>🔥 250 calo</span>
                                    <span>⭐ 4.7</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">Cơ bản</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>

                                        <!-- Bài tập 1 -->
                    <div class="workout-card" data-category="fat-burn">
                        <div class="workout-card-image">
                            <img src="{{ asset('images/anh12.jpeg') }}" alt="Workout">
                            <div class="workout-badge">Cardio</div>
                            <div class="difficulty-indicator">
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                            </div>
                        </div>
                        <div class="workout-card-content">
                            <h3 class="workout-card-title">Cardio Toàn Thân</h3>
                            <div class="workout-card-meta">
                                <span>⏱ 25 phút</span>
                                <span>🔥 300 calo</span>
                                <span>⭐ 4.8</span>
                            </div>
                            <div class="workout-card-footer">
                                <div class="workout-level intermediate">Trung bình</div>
                                <button class="start-btn">Bắt đầu</button>
                            </div>
                        </div>
                    </div>

                    <!-- Bài tập 2 -->
                    <div class="workout-card" data-category="fat-burn">
                        <div class="workout-card-image">
                            <img src="{{ asset('images/anh13.jpeg') }}" alt="Workout">
                            <div class="workout-badge">HIIT</div>
                            <div class="difficulty-indicator">
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                            </div>
                        </div>
                        <div class="workout-card-content">
                            <h3 class="workout-card-title">HIIT Cường Độ Cao</h3>
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

                    <!-- Bài tập 3 -->
                    <div class="workout-card" data-category="fat-burn">
                        <div class="workout-card-image">
                            <img src="{{ asset('images/anh14.jpeg') }}" alt="Workout">
                            <div class="workout-badge">Tabata</div>
                            <div class="difficulty-indicator">
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                                <div class="difficulty-dot"></div>
                            </div>
                        </div>
                        <div class="workout-card-content">
                            <h3 class="workout-card-title">Tabata Toàn Thân</h3>
                            <div class="workout-card-meta">
                                <span>⏱ 20 phút</span>
                                <span>🔥 280 calo</span>
                                <span>⭐ 4.9</span>
                            </div>
                            <div class="workout-card-footer">
                                <div class="workout-level advanced">Nâng cao</div>
                                <button class="start-btn">Bắt đầu</button>
                            </div>
                        </div>
                    </div>
                                            <!-- Bài tập 1 -->
                        <div class="workout-card" data-category="maintain">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh15.jpg') }}" alt="Workout">
                                <div class="workout-badge">Yoga</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Yoga Buổi Sáng</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 20 phút</span>
                                    <span>🔥 180 calo</span>
                                    <span>⭐ 4.9</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">Cơ bản</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>

                        <!-- Bài tập 2 -->
                        <div class="workout-card" data-category="maintain">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh16.jpg') }}" alt="Workout">
                                <div class="workout-badge">Pilates</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Pilates Săn Chắc Cơ</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 25 phút</span>
                                    <span>🔥 220 calo</span>
                                    <span>⭐ 4.8</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level intermediate">Trung bình</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>

                        <!-- Bài tập 3 -->
                        <div class="workout-card" data-category="maintain">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh17.jpeg') }}" alt="Workout">
                                <div class="workout-badge">Dance</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Zumba Năng Động</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 35 phút</span>
                                    <span>🔥 300 calo</span>
                                    <span>⭐ 5.0</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level advanced">Nâng cao</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>
                                                <!-- Bài tập 1 -->
                        <div class="workout-card" data-category="yoga">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh18.jpg') }}" alt="Yoga Giãn Cơ">
                                <div class="workout-badge">Yoga</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Yoga Giãn Cơ Toàn Thân</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 25 phút</span>
                                    <span>🔥 180 calo</span>
                                    <span>⭐ 4.9</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">Cơ bản</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>

                        <!-- Bài tập 2 -->
                        <div class="workout-card" data-category="yoga">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh19.jpg') }}" alt="Yoga Giãn Cơ">
                                <div class="workout-badge">Stretch</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Yoga Buổi Tối Thư Giãn</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 20 phút</span>
                                    <span>🔥 160 calo</span>
                                    <span>⭐ 4.8</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">Cơ bản</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>

                        <!-- Bài tập 3 -->
                        <div class="workout-card" data-category="yoga">
                            <div class="workout-card-image">
                                <img src="{{ asset('images/anh20.jpg') }}" alt="Yoga Giãn Cơ">
                                <div class="workout-badge">Yin Yoga</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">Yoga Phục Hồi</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ 30 phút</span>
                                    <span>🔥 200 calo</span>
                                    <span>⭐ 5.0</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level intermediate">Trung bình</div>
                                    <button class="start-btn">Bắt đầu</button>
                                </div>
                            </div>
                        </div>




                     </div>


               
            <!-- New Workout Section -->
            <div class="section-header">
                <h2 class="section-title">Bài tập mới nhất</h2>
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
                        <img src="{{ asset('images/anh7.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh8.jpg') }}" alt="Workout">
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
                        <img src="{{ asset('images/anh9.jpg') }}" alt="Workout">
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

    <!-- Scripts -->
    <script defer src="{{ asset('js/fitness.js') }}"></script>

</body>
</html>
@endsection