@extends('base')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush

@section('content')
<div class="profile-container">
    <!-- Sidebar với thông tin người dùng -->
    <div class="profile-sidebar">
        <!-- Avatar và thông tin cơ bản -->
        <div class="profile-header">
            <div class="profile-avatar-wrapper">
                <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" alt="Avatar" class="profile-avatar">
                <div class="avatar-edit-btn" id="editAvatarBtn">
                    <i class="fa-solid fa-camera"></i>
                </div>
            </div>
            
            <div class="profile-basic-info">
                <h2 class="profile-name">{{ Auth::user()->name }}</h2>
                <p class="profile-email">{{ Auth::user()->email }}</p>
                <p class="profile-role">
                    @if(Auth::user()->subscription_plan == 'premium')
                        <span class="badge badge-premium">
                            <i class="fa-solid fa-crown"></i> Premium
                        </span>
                    @else
                        <span class="badge badge-free">Premium</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Thống kê nhanh -->
        <div class="profile-stats">
            <div class="stat-item">
                <span class="stat-label">Nhật ký</span>
                <span class="stat-value">0</span>
                <span class="stat-desc">Xem chi tiết</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Hỗ trợ</span>
                <span class="stat-value">-</span>
                <span class="stat-desc">Xem chi tiết</span>
            </div>
        </div>

        <!-- Menu điều hướng -->
        <nav class="profile-menu">
            <a href="#personal-info" class="menu-item active" data-section="personal-info">
                <i class="fa-solid fa-user"></i>
                <span>Thông tin cá nhân</span>
            </a>
            <a href="#health-data" class="menu-item" data-section="health-data">
                <i class="fa-solid fa-heart"></i>
                <span>Dữ liệu sức khỏe</span>
            </a>
            <a href="#goals" class="menu-item" data-section="goals">
                <i class="fa-solid fa-bullseye"></i>
                <span>Mục tiêu</span>
            </a>
            <a href="#preferences" class="menu-item" data-section="preferences">
                <i class="fa-solid fa-sliders"></i>
                <span>Tùy chỉnh</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="profile-main">
        <!-- 1. Thông tin cá nhân -->
        <section id="personal-info" class="profile-section active">
            <div class="section-header">
                <h3><i class="fa-solid fa-user-circle"></i> Thông tin cá nhân</h3>
                <button class="btn-edit-section" id="editPersonalBtn">
                    <i class="fa-solid fa-edit"></i> Chỉnh sửa
                </button>
            </div>

            <form id="personalForm" class="profile-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fullName">Họ và tên</label>
                        <input type="text" id="fullName" name="fullName" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="dob">Ngày sinh</label>
                        <input type="date" id="dob" name="dob" value="{{ Auth::user()->dob ?? '' }}" disabled>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select id="gender" name="gender" disabled>
                            <option value="">Chọn giới tính</option>
                            <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Nam</option>
                            <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Nữ</option>
                            <option value="other" @if(Auth::user()->gender == 'other') selected @endif>Khác</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="{{ Auth::user()->address ?? '' }}" disabled>
                    </div>
                </div>

                <div class="form-actions" style="display: none;" id="formActions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Lưu thay đổi
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelEditBtn">
                        <i class="fa-solid fa-times"></i> Hủy
                    </button>
                </div>
            </form>
        </section>

        <!-- 2. Dữ liệu sức khỏe -->
        <section id="health-data" class="profile-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-heart"></i> Dữ liệu sức khỏe</h3>
            </div>

            <!-- Charts Section -->
            <div class="health-charts-container">
                <!-- Left Chart: Training Results -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h4>Kết quả tập luyện</h4>
                        <select class="chart-filter" id="trainingMonthFilter">
                            <option value="current">Tháng này</option>
                            <option value="last3">3 tháng gần đây</option>
                            <option value="last6">6 tháng gần đây</option>
                            <option value="year">Cả năm</option>
                        </select>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="trainingChart" height="80"></canvas>
                    </div>
                    <div class="chart-stats">
                        <div class="stat-row">
                            <span class="stat-label">Tổng buổi tập:</span>
                            <span class="stat-value" id="totalSessions">0</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Tổng giờ tập:</span>
                            <span class="stat-value" id="totalHours">0h</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Calo đã đốt:</span>
                            <span class="stat-value" id="totalCalories">0 kcal</span>
                        </div>
                    </div>
                </div>

                <!-- Right Chart: Progress -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h4>Tiến độ tập luyện</h4>
                    </div>
                    <div class="chart-wrapper">
                        <canvas id="progressChart" height="80"></canvas>
                    </div>
                    <div class="chart-stats">
                        <div class="stat-row">
                            <span class="stat-label">Mục tiêu tháng:</span>
                            <span class="stat-value" id="monthlyGoal">0 buổi</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Đã hoàn thành:</span>
                            <span class="stat-value" id="completedSessions">0 buổi</span>
                        </div>
                        <div class="stat-row">
                            <span class="stat-label">Giảm cân:</span>
                            <span class="stat-value" id="weightLoss">0 kg</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="section-divider"></div>

            <!-- Detailed Health Information -->
            <div class="health-info-section">
                <h4 style="margin-bottom: 20px; font-size: 16px; color: var(--text-primary);">Thông tin sức khỏe chi tiết</h4>
                <div class="health-info-grid">
                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-ruler"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Chiều cao</span>
                            <span class="info-value" id="heightDisplay">{{ Auth::user()->height ?? '-' }} cm</span>
                        </div>
                    </div>

                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-weight-scale"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Cân nặng</span>
                            <span class="info-value" id="weightDisplay">{{ Auth::user()->weight ?? '-' }} kg</span>
                        </div>
                    </div>

                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">BMI</span>
                            <span class="info-value" id="bmiDisplay">{{ Auth::user()->bmi ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-droplet"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Nhóm máu</span>
                            <span class="info-value" id="bloodTypeDisplay">{{ Auth::user()->blood_type ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-fire"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Calo hàng ngày</span>
                            <span class="info-value" id="dailyCaloriesDisplay">2000 kcal</span>
                        </div>
                    </div>

                    <div class="health-info-card">
                        <div class="info-icon">
                            <i class="fa-solid fa-person-walking"></i>
                        </div>
                        <div class="info-content">
                            <span class="info-label">Mức hoạt động</span>
                            <span class="info-value" id="activityDisplay">Vừa phải</span>
                        </div>
                    </div>
                </div>
            </div>

            <form id="healthForm" class="profile-form" style="display: none;">
                <div class="form-row">
                    <div class="form-group">
                        <label for="height">Chiều cao (cm)</label>
                        <input type="number" id="height" name="height" value="{{ Auth::user()->height ?? '' }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="weight">Cân nặng (kg)</label>
                        <input type="number" id="weight" name="weight" value="{{ Auth::user()->weight ?? '' }}" disabled step="0.1">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bmi">BMI</label>
                        <input type="text" id="bmi" value="{{ Auth::user()->bmi ?? 'Chưa cập nhật' }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="blood_type">Nhóm máu</label>
                        <select id="blood_type" name="blood_type" disabled>
                            <option value="">Chọn nhóm máu</option>
                            <option value="O+" @if(Auth::user()->blood_type == 'O+') selected @endif>O+</option>
                            <option value="O-" @if(Auth::user()->blood_type == 'O-') selected @endif>O-</option>
                            <option value="A+" @if(Auth::user()->blood_type == 'A+') selected @endif>A+</option>
                            <option value="A-" @if(Auth::user()->blood_type == 'A-') selected @endif>A-</option>
                            <option value="B+" @if(Auth::user()->blood_type == 'B+') selected @endif>B+</option>
                            <option value="B-" @if(Auth::user()->blood_type == 'B-') selected @endif>B-</option>
                            <option value="AB+" @if(Auth::user()->blood_type == 'AB+') selected @endif>AB+</option>
                            <option value="AB-" @if(Auth::user()->blood_type == 'AB-') selected @endif>AB-</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="activity_level">Mức độ hoạt động</label>
                        <select id="activity_level" name="activity_level" disabled>
                            <option value="">Chọn mức độ hoạt động</option>
                            <option value="sedentary" @if(Auth::user()->activity_level == 'sedentary') selected @endif>Ít vận động</option>
                            <option value="light" @if(Auth::user()->activity_level == 'light') selected @endif>Nhẹ</option>
                            <option value="moderate" @if(Auth::user()->activity_level == 'moderate') selected @endif>Vừa phải</option>
                            <option value="active" @if(Auth::user()->activity_level == 'active') selected @endif>Tích cực</option>
                            <option value="very_active" @if(Auth::user()->activity_level == 'very_active') selected @endif>Rất tích cực</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions" style="display: none;" id="healthFormActions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Lưu thay đổi
                    </button>
                    <button type="button" class="btn btn-secondary" id="cancelHealthEditBtn">
                        <i class="fa-solid fa-times"></i> Hủy
                    </button>
                </div>
            </form>
        </section>

        <!-- 3. Mục tiêu -->
        <section id="goals" class="profile-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-bullseye"></i> Mục tiêu cá nhân</h3>
            </div>

            <!-- Goals Cards -->
            <div class="goals-container">
                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fa-solid fa-dumbbell"></i>
                    </div>
                    <div class="goal-content">
                        <h4>Tập luyện</h4>
                        <p>Tập luyện 5 ngày/tuần</p>
                        <div class="goal-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 60%"></div>
                            </div>
                            <span class="progress-text">3/5 ngày</span>
                        </div>
                    </div>
                </div>

                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <div class="goal-content">
                        <h4>Giảm cân</h4>
                        <p>Giảm 5 kg trong 3 tháng</p>
                        <div class="goal-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 40%"></div>
                            </div>
                            <span class="progress-text">2/5 kg</span>
                        </div>
                    </div>
                </div>

                <div class="goal-card">
                    <div class="goal-icon">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <div class="goal-content">
                        <h4>Uống nước</h4>
                        <p>Uống 2 lít nước mỗi ngày</p>
                        <div class="goal-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%"></div>
                            </div>
                            <span class="progress-text">1.5/2 L</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="section-divider"></div>

            <!-- Calendar and Schedule Section -->
            <div class="goals-schedule-container">
                <!-- Calendar -->
                <div class="calendar-card">
                    <div class="calendar-header">
                        <h4>Lịch theo tháng</h4>
                        <div class="calendar-nav">
                            <button class="calendar-prev" id="prevMonth">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <span class="calendar-month" id="currentMonth">tháng 11 2025</span>
                            <button class="calendar-next" id="nextMonth">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="calendar-weekdays">
                        <div class="weekday">CN</div>
                        <div class="weekday">T2</div>
                        <div class="weekday">T3</div>
                        <div class="weekday">T4</div>
                        <div class="weekday">T5</div>
                        <div class="weekday">T6</div>
                        <div class="weekday">T7</div>
                    </div>

                    <div class="calendar-days" id="calendarDays">
                        <!-- Days will be generated by JavaScript -->
                    </div>
                </div>

                <!-- Training Schedule -->
                <div class="schedule-card">
                    <div class="schedule-header">
                        <h4>Lớp tập luyện</h4>
                        <select class="schedule-filter" id="scheduleMonthFilter">
                            <option value="current">Học kỳ hè năm học 2024-2025</option>
                            <option value="fall">Học kỳ thu năm học 2024-2025</option>
                            <option value="spring">Học kỳ xuân năm học 2024-2025</option>
                        </select>
                    </div>

                    <div class="schedule-list">
                        <div class="schedule-item">
                            <div class="schedule-course-info">
                                <h5 class="course-name">Thể dục cơ hình nâng cao - Fitness 2</h5>
                                <div class="course-details">
                                    <span class="detail-label">Thứ được tính năng cao -</span>
                                    <span class="detail-value">Fitness 2</span>
                                </div>
                            </div>
                            <div class="schedule-credits">
                                <span class="credits-label">Tiết học</span>
                                <span class="credits-value">2</span>
                            </div>
                        </div>

                        <div class="schedule-item">
                            <div class="schedule-course-info">
                                <h5 class="course-name">Nâng tạ</h5>
                                <div class="course-details">
                                    <span class="detail-label">Khóa học cơ -</span>
                                    <span class="detail-value">hard</span>
                                </div>
                            </div>
                            <div class="schedule-credits">
                                <span class="credits-label">Tiết học</span>
                                <span class="credits-value">0</span>
                            </div>
                        </div>

                        <div class="schedule-item">
                            <div class="schedule-course-info">
                                <h5 class="course-name">Yoga cơ bản cho người mới bắt đầu</h5>
                                <div class="course-details">
                                    <span class="detail-label">Khóa học yoga -</span>
                                    <span class="detail-value">Beginner</span>
                                </div>
                            </div>
                            <div class="schedule-credits">
                                <span class="credits-label">Tiết học</span>
                                <span class="credits-value">3</span>
                            </div>
                        </div>

                        <div class="schedule-item">
                            <div class="schedule-course-info">
                                <h5 class="course-name">Bơi lội nâng cao</h5>
                                <div class="course-details">
                                    <span class="detail-label">Khóa học bơi -</span>
                                    <span class="detail-value">Advanced</span>
                                </div>
                            </div>
                            <div class="schedule-credits">
                                <span class="credits-label">Tiết học</span>
                                <span class="credits-value">2</span>
                            </div>
                        </div>

                        <div class="schedule-item">
                            <div class="schedule-course-info">
                                <h5 class="course-name">Pilates toàn thân</h5>
                                <div class="course-details">
                                    <span class="detail-label">Khóa học pilates -</span>
                                    <span class="detail-value">Full Body</span>
                                </div>
                            </div>
                            <div class="schedule-credits">
                                <span class="credits-label">Tiết học</span>
                                <span class="credits-value">2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Next Workout Session -->
            <div class="next-session-card">
                <div class="session-header">
                    <h4>Buổi tập luyện tiếp theo</h4>
                </div>
                <div class="session-content">
                    <div class="session-date-time">
                        <div class="session-date">
                            <span class="date-day">16</span>
                            <span class="date-month">Tháng 11</span>
                        </div>
                        <div class="session-details">
                            <h5>Tập luyện Fitness</h5>
                            <p class="session-time">
                                <i class="fa-solid fa-clock"></i>
                                14:00 - 15:30
                            </p>
                            <p class="session-location">
                                <i class="fa-solid fa-map-marker-alt"></i>
                                Phòng tập Fitness - Tầng 3
                            </p>
                        </div>
                    </div>
                    <button class="btn btn-primary" style="align-self: flex-end;">
                        <i class="fa-solid fa-check"></i> Xác nhận tham gia
                    </button>
                </div>
            </div>
        </section>

        <!-- 4. Tùy chỉnh -->
        <section id="preferences" class="profile-section">
            <div class="section-header">
                <h3><i class="fa-solid fa-sliders"></i> Tùy chỉnh</h3>
            </div>

            <form id="preferencesForm" class="profile-form">
                <div class="form-group">
                    <label>
                        <input type="checkbox" checked>
                        <span>Nhận thông báo về bài tập</span>
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" checked>
                        <span>Nhận thông báo về dinh dưỡng</span>
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox">
                        <span>Chia sẻ dữ liệu với cộng đồng</span>
                    </label>
                </div>

                <div class="form-group">
                    <label for="language">Ngôn ngữ</label>
                    <select id="language" name="language">
                        <option selected>Tiếng Việt</option>
                        <option>English</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-save"></i> Lưu tùy chỉnh
                    </button>
                </div>
            </form>
        </section>

        <!-- 5. Bảo mật -->
        
@endsection

@push('scripts')
<script src="{{ asset('js/calendar-schedule.js') }}"></script>
<script src="{{ asset('js/health-charts.js') }}"></script>
<script src="{{ asset('js/profile.js') }}"></script>
@endpush
