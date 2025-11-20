@extends('base')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
<div class="container">
    <!-- Header Section -->
    <div class="profile-header">
        <div class="profile-avatar-section">
            <div class="profile-avatar">
                {{ substr($account->fullname, 0, 1) }}
            </div>
        </div>
        
        <div class="profile-basic-info">
            <div class="profile-name">{{ $account->fullname }}</div>
            <div class="profile-meta">
                <div class="meta-item">
                    <i class="fas fa-star"></i>
                    <strong>Nâng cao</strong>
                </div>
                <div class="meta-item">
                    <i class="fas fa-fire"></i>
                    <strong>14,750</strong> điểm
                </div>
            </div>
            <div class="profile-badges">
                <span class="badge">Thành viên nâng cao</span>
                <span class="badge secondary">Đã xác thực</span>
            </div>
        </div>
        
        <div class="profile-actions">
            <button class="action-btn" title="Cài đặt">
                <i class="fas fa-cog"></i>
            </button>
            <button class="action-btn" title="Tùy chọn khác">
                <i class="fas fa-ellipsis-v"></i>
            </button>
        </div>
    </div>

    <!-- Main Dashboard Container -->
    <div class="dashboard-container">
        <!-- Left Section - Progress -->
        <div class="dashboard-section section-left">
            <!-- Progress Card -->
            <div class="card card-progress">
                <div class="progress-header">
                    <div class="progress-info">
                        <div class="progress-label">Tiến độ</div>
                        <div class="progress-value">75%</div>
                        <div class="progress-note">Hoàn thành mục tiêu</div>
                    </div>
                    <div class="badge-filter">Tuần này</div>
                </div>
                <div class="circle-progress-container">
                    <div class="circle-progress">
                        <div class="circle-bg">
                            <div class="circle-inner">
                                <div class="circle-value"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="progress-details">
                    <div class="detail-item">
                        <span class="detail-label">Tập cardio</span>
                        <span class="detail-percent">85%</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tập sức mạnh</span>
                        <span class="detail-percent">75%</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tăng linh hoạt</span>
                        <span class="detail-percent">65%</span>
                    </div>
                </div>
            </div>

            <!-- Meal Card -->
            <div class="card card-meal">
                <div class="badge-primary">Bữa tối</div>
                <div class="meal-image">
                    <img src="{{ asset('images/meal1.avif') }}" alt="Lean & Green">
                </div>
                <div class="meal-content">
                    <h3 class="meal-title">Lean &amp; Green</h3>
                    <p class="meal-description">Cá hồi nướng cùng bông cải hấp và cơm gạo lứt</p>
                    <div class="meal-score">
                        <span class="score-label">Điểm sức khỏe:</span>
                        <span class="score-value">85/100</span>
                    </div>
                    <div class="nutrition-bars">
                        <div class="nutrition-bar" style="width: 100%;"></div>
                    </div>
                    <div class="meal-nutrition">
                        <span>450 Cal</span>
                        <span>40g Carbs</span>
                        <span>35g Protein</span>
                        <span>15g Fats</span>
                    </div>
                    <button class="btn btn-primary btn-add-meal">
                        <i class="fas fa-plus"></i> Thêm
                    </button>
                </div>
            </div>
        </aside>

        <!-- Middle Content -->
                    </div>

        <!-- Middle Section - Cards Container -->
        <div class="dashboard-section section-middle">
            <!-- Top Cards Row -->
            <div class="cards-grid-top">
                <!-- Heart Beat Card -->
                <div class="card card-compact card-gradient-green">
                    <div class="card-header-compact">
                        <i class="fas fa-heart card-icon-large"></i>
                        <h3 class="card-title-compact">Nhịp tim</h3>
                        <div class="card-menu">
                            <button class="btn-menu"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                    </div>
                    <div class="heartbeat-content">
                        <div class="bpm-value">110 <span class="bpm-unit">nhịp/phút</span></div>
                        <div class="bpm-status">Bình thường</div>
                        <div class="heartbeat-text">Cơ thể sẵn sàng cho buổi tập tiếp theo!</div>
                        <div class="heartbeat-animation">
                            <svg viewBox="0 0 100 30" class="heartbeat-line">
                                <polyline points="0,15 15,15 20,10 25,20 30,15 40,15 45,8 50,22 55,15 65,15" stroke="currentColor" stroke-width="2" fill="none"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Health Score Card -->
                <div class="card card-compact card-gradient-blue">
                    <div class="card-header-compact">
                        <i class="fas fa-heart-pulse card-icon-large"></i>
                        <h3 class="card-title-compact">Điểm sức khỏe</h3>
                        <div class="card-menu">
                            <button class="btn-menu"><i class="fas fa-ellipsis-h"></i></button>
                        </div>
                    </div>
                    <div class="health-score-content">
                        <div class="health-score-value">82%</div>
                        <div class="health-score-label">Rất khỏe mạnh</div>
                        <div class="health-score-bar">
                            <div class="score-fill" style="width: 82%;"></div>
                        </div>
                        <div class="health-score-text">Tiếp tục duy trì phong độ nhé!</div>
                    </div>
                </div>
            </div>

            <!-- Profile & Activity Cards Row -->
            <div class="cards-grid-middle">
                <!-- My Profile Card -->
                <div class="card card-profile">
                    <div class="card-header">
                        <h3 class="card-title">Hồ sơ của tôi</h3>
                        <button class="btn-menu"><i class="fas fa-ellipsis-h"></i></button>
                    </div>
                    <div class="profile-info-grid">
                        <div class="info-item">
                            <div class="avatar-large">{{ substr($account->fullname, 0, 1) }}</div>
                            <div class="info-content">
                                <h4 class="info-name">{{ $account->fullname }}</h4>
                                <div class="info-badges">
                                    <span class="badge-small"><i class="fas fa-shield-alt"></i> Nâng cao</span>
                                    <span class="badge-small points"><i class="fas fa-fire"></i> 14,750 điểm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <div class="stat-info-item">
                            <span class="stat-info-label">Cân nặng</span>
                            <span class="stat-info-value">{{ $account->weight }} kg</span>
                        </div>
                        <div class="stat-info-item">
                            <span class="stat-info-label">Chiều cao</span>
                            <span class="stat-info-value">{{ $account->height }} cm</span>
                        </div>
                        <div class="stat-info-item">
                            <span class="stat-info-label">Tuổi</span>
                            <span class="stat-info-value">{{ $age }}</span>
                        </div>
                    </div>
                </div>

                <!-- Today's Activity Card -->
                <div class="card card-activity-detail">
                    <div class="card-header">
                        <h3 class="card-title">Hoạt động hôm nay</h3>
                        <button class="btn-badge">Hôm nay</button>
                    </div>
                    <div class="activity-detail-card">
                        <div class="activity-map">
                            <div class="map-placeholder">
                                <i class="fas fa-map"></i>
                            </div>
                        </div>
                        <div class="activity-info-detail">
                            <h4 class="activity-route">Chạy vòng quanh công viên</h4>
                            <div class="activity-time">
                                <i class="fas fa-clock"></i> 6:30 - 7:20
                            </div>
                            <div class="activity-stats-grid">
                                <div class="activity-stat">
                                    <span class="stat-title">Quãng đường</span>
                                    <span class="stat-val">5 dặm (8 km)</span>
                                </div>
                                <div class="activity-stat">
                                    <span class="stat-title">Thời gian</span>
                                    <span class="stat-val">50 phút</span>
                                </div>
                                <div class="activity-stat">
                                    <span class="stat-title">Tổng bước chân</span>
                                    <span class="stat-val">10.500 bước</span>
                                </div>
                                <div class="activity-stat">
                                    <span class="stat-title">Tổng calo</span>
                                    <span class="stat-val">450 Cal</span>
                                </div>
                                <div class="activity-stat">
                                    <span class="stat-title">Tốc độ trung bình</span>
                                    <span class="stat-val">10 phút/dặm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Extended Dashboard Section - Bottom Row -->
    <div class="dashboard-extended">
        <!-- Workout Section (Left) -->
        <div class="card card-workout">
            <div class="card-title mb-20">Bài tập hôm nay</div>
            
            <div class="workout-content">
                <!-- Exercise Input Left -->
                <div class="workout-input-section">
                    <div class="form-group">
                        <label>Chọn bài tập</label>
                        <select id="exercise-select">
                            <option value="">-- Chọn bài tập --</option>
                            @foreach($exercises as $ex)
                                <option value="{{ $ex->calories_burned }}">{{ $ex->name_workout }} ({{ $ex->calories_burned }} kcal)</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="hstack">
                        <button class="btn btn-primary btn-flex" id="add-ex">
                            <i class="fas fa-plus"></i> Thêm
                        </button>
                        <button class="btn btn-danger" id="reset-ex">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <div class="summary-box">
                        <div class="mb-12">
                            <span class="text-secondary small">Tổng calo hôm nay</span>
                            <div class="big-primary">
                                <span id="total-cal">0</span> <span class="small">kcal</span>
                            </div>
                        </div>
                        <div class="top-divider">
                            <span class="text-secondary small">Mục tiêu calo</span>
                            <div class="goal-value">
                                <span id="goal-cal">{{ $goal_calories }}</span> kcal
                            </div>
                        </div>
                    </div>

                    <!-- Exercise List -->
                    <div style="margin-top: 20px;">
                        <div class="exercise-list-title">Danh sách bài tập</div>
                        <div id="exercise-list" class="exercise-list"></div>
                    </div>
                </div>

                <!-- Exercise Chart Right -->
                <div class="workout-chart-section">
                    <div class="chart-container">
                        <canvas id="pieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Weekly Stats Section (Right) -->
        <div class="card card-weekly-stats">
            <div class="card-title mb-20">Calo tuần này</div>
            <div class="chart-container">
                <canvas id="weekChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.profileData = {
            goalCalories: {{ $goal_calories }}
        };
    </script>
    <script src="{{ asset('js/profile.js') }}"></script>
@endpush

</body>
</html>
@endsection
