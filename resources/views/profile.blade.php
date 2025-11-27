@extends('base')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
<div class="container">
   

    <!-- Main Dashboard Container -->
    <div class="dashboard-container">
        <!-- Middle Section - Profile Table and Cards Below -->
        <div class="dashboard-section section-middle">
            <!-- My Profile Card with Unified Table -->
            <div class="card card-profile">
                <div class="card-header">
                    <h3 class="card-title">Hồ sơ của tôi</h3>
                    <div class="header-menu-container">
                        <button class="btn-menu" id="profile-menu-btn"><i class="fas fa-ellipsis-h"></i></button>
                        <div class="profile-menu-dropdown" id="profile-menu-dropdown">
                            <button class="menu-item" id="change-avatar-btn">
                                <i class="fas fa-camera"></i>
                                <span>Thay đổi ảnh đại diện</span>
                            </button>
                            <button class="menu-item" id="edit-profile-btn">
                                <i class="fas fa-edit"></i>
                                <span>Chỉnh sửa hồ sơ</span>
                            </button>
                            <a href="{{ route('password.change') }}" class="menu-item" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                                <i class="fas fa-key"></i>
                                <span>Đổi mật khẩu</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="profile-header-section">
                    <div class="profile-avatar-wrapper">
                        <div class="avatar-upload-container">
                            <div class="avatar-large" id="avatar-display">
                                @if(isset($account->avatar) && $account->avatar)
                                    <img src="{{ asset('storage/' . $account->avatar) }}" alt="Avatar" id="avatar-img" style="display: block;">
                                    <span id="avatar-initial" style="display: none;">{{ substr($account->fullname, 0, 1) }}</span>
                                @else
                                    <img src="" alt="Avatar" id="avatar-img" style="display: none;">
                                    <span id="avatar-initial">{{ substr($account->fullname, 0, 1) }}</span>
                                @endif
                            </div>
                            <input type="file" id="avatar-input" accept="image/*" style="display: none;">
                        </div>
                        <div class="profile-name-wrapper">
                            <h4 class="profile-name-in-card" id="profile-name-display">{{ $account->fullname }}</h4>
                            <div class="info-badges">
                                <span class="badge-small"><i class="fas fa-shield-alt"></i> {{ $userPlan ?? $account->plan ?? 'Chưa đăng ký' }}</span>
                                <span class="badge-small points"><i class="fas fa-fire"></i> 14,750 điểm</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="profile-table-container">
                    <table class="profile-table">
                        <tbody>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-user"></i>
                                    <span>Họ và tên</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="fullname-display">{{ $account->fullname }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-weight"></i>
                                    <span>Cân nặng</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="weight-display">{{ $account->weight ?? '0' }} kg</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-ruler-vertical"></i>
                                    <span>Chiều cao</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="height-display">{{ $account->height ?? '0' }} cm</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-label">
                                    <i class="fas fa-birthday-cake"></i>
                                    <span>Tuổi</span>
                                </td>
                                <td class="table-value">
                                    <span class="value-display" id="age-display">{{ $age }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Profile Modal -->
            <div class="edit-profile-modal" id="edit-profile-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Chỉnh sửa hồ sơ</h3>
                        <button class="modal-close" id="close-edit-modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form id="edit-profile-form" class="edit-profile-form">
                        <div class="form-group">
                            <label for="edit-fullname">
                                <i class="fas fa-user"></i>
                                Họ và tên
                            </label>
                            <input type="text" id="edit-fullname" name="fullname" value="{{ $account->fullname }}" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-weight">
                                <i class="fas fa-weight"></i>
                                Cân nặng (kg)
                            </label>
                            <input type="number" id="edit-weight" name="weight" value="{{ $account->weight ?? '' }}" step="0.01" min="10" max="500" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-height">
                                <i class="fas fa-ruler-vertical"></i>
                                Chiều cao (cm)
                            </label>
                            <input type="number" id="edit-height" name="height" value="{{ $account->height ?? '' }}" step="0.01" min="50" max="250" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-birthday">
                                <i class="fas fa-birthday-cake"></i>
                                Ngày sinh
                            </label>
                            <input type="date" id="edit-birthday" name="birthday" value="{{ $account->birthday ? date('Y-m-d', strtotime($account->birthday)) : '' }}" required>
                        </div>
                        <div class="modal-actions">
                            <button type="button" class="btn btn-cancel" id="cancel-edit-btn">Hủy</button>
                            <button type="submit" class="btn btn-save">
                                <i class="fas fa-save"></i>
                                Lưu thay đổi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Food List Modal -->
            <div class="edit-profile-modal" id="food-list-modal">
                <div class="modal-overlay"></div>
                <div class="modal-content" style="max-width: 600px;">
                    <div class="modal-header">
                        <h3 class="modal-title">Chọn món ăn</h3>
                        <button class="modal-close" id="close-food-modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="padding: 20px; max-height: 400px; overflow-y: auto;">
                        <div id="food-list-container" class="food-list-grid">
                            <!-- Items will be loaded here -->
                            <div class="text-center">
                                <i class="fas fa-spinner fa-spin"></i> Đang tải...
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding: 15px 20px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-weight: 600; color: #2d3748;">
                            Tổng đã chọn: <span id="selected-total-cal" style="color: #e53e3e;">0</span> kcal
                        </div>
                        <button class="btn btn-primary" id="save-selected-food-btn">
                            <i class="fas fa-save"></i> Lưu đã chọn
                        </button>
                    </div>
                </div>
            </div>

            <!-- Cards Below Profile -->
            <div class="cards-below-profile">
                <!-- Progress Card -->
                <div class="card card-progress">
                    <div class="progress-header">
                        <div class="progress-info">
                            <div class="progress-label">Tiến độ</div>
                            <div class="progress-value" id="progress-percentage">{{ $progressPercentage ?? 0 }}%</div>
                            <div class="progress-note">Hoàn thành mục tiêu</div>
                        </div>
                        <div class="badge-filter">Tuần này</div>
                    </div>
                    <div class="circle-progress-container">
                        <div class="circle-progress">
                            <div class="circle-bg" id="circle-progress-bg" style="background: conic-gradient(
                                var(--primary) 0deg,
                                var(--primary) {{ ($progressPercentage ?? 0) * 3.6 }}deg,
                                rgba(159, 205, 59, 0.1) {{ ($progressPercentage ?? 0) * 3.6 }}deg,
                                rgba(159, 205, 59, 0.1) 360deg
                            );">
                                <div class="circle-inner">
                                    <div class="circle-value" id="circle-progress-value">{{ $progressPercentage ?? 0 }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="progress-details">
                        <div class="detail-item">
                            <span class="detail-label">Tập cardio</span>
                            <span class="detail-percent">{{ $cardioProgress ?? 0 }}%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tập sức mạnh</span>
                            <span class="detail-percent">{{ $strengthProgress ?? 0 }}%</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Tăng linh hoạt</span>
                            <span class="detail-percent">{{ $flexibilityProgress ?? 0 }}%</span>
                        </div>
                    </div>
                </div>

                <!-- Meal Card -->
                <div class="card card-meal" style="position: relative;">
                    @if($mealPlan)
                        <div class="badge-primary">Bữa ăn</div>
                        <div class="meal-image">
                            @if($mealPlan->urls)
                                <img src="{{ asset($mealPlan->urls) }}" alt="{{ $mealPlan->meal_name }}" onerror="this.src='{{ asset('images/meal1.avif') }}'">
                            @else
                                <img src="{{ asset('images/meal1.avif') }}" alt="{{ $mealPlan->meal_name }}">
                            @endif
                        </div>
                        <div class="meal-content">
                            <h3 class="meal-title">{{ $mealPlan->meal_name }}</h3>
                            <p class="meal-description">{{ $mealPlan->description ?? 'Bữa ăn dinh dưỡng và lành mạnh' }}</p>
                            
                            <!-- Calorie Progress Section -->
                            <div class="meal-score" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="score-label">Tiến độ calo:</span>
                                <span class="score-value" style="color: #e53e3e;">
                                    <span id="total-consumed-display">{{ $caloriesConsumedToday ?? 0 }}</span>/{{ $goal_calories }} kcal
                                </span>
                            </div>
                            <div class="nutrition-bars" style="background: #edf2f7; border-radius: 10px; height: 8px; overflow: hidden; margin-bottom: 15px;">
                                <div id="calorie-progress-bar" class="nutrition-bar" style="width: {{ min(100, round((($caloriesConsumedToday ?? 0) / $goal_calories) * 100)) }}%; background: linear-gradient(90deg, #FF9966, #FF5E62); height: 100%; border-radius: 10px; transition: width 0.5s ease;"></div>
                            </div>

                            <div class="meal-nutrition">
                                <span>{{ $mealPlan->calories ?? 450 }} Cal</span>
                                <span>{{ $mealPlan->carbs ?? 40 }}g Carbs</span>
                                <span>{{ $mealPlan->protein ?? 35 }}g Protein</span>
                                <span>{{ $mealPlan->fat ?? 15 }}g Fats</span>
                            </div>
                            <button class="btn btn-primary btn-sm mt-3" id="add-meal-btn" data-calories="{{ $mealPlan->calories ?? 450 }}" data-name="{{ $mealPlan->meal_name }}">
                                <i class="fas fa-plus"></i> Thêm bữa ăn
                            </button>
                        </div>
                    @else
                        <div class="badge-primary">Bữa ăn</div>
                        <div class="meal-image">
                            <img src="{{ asset('images/meal1.avif') }}" alt="Lean & Green">
                        </div>
                        <div class="meal-content">
                            <h3 class="meal-title">Lean &amp; Green</h3>
                            <p class="meal-description">Cá hồi nướng cùng bông cải hấp và cơm gạo lứt</p>
                            
                            <!-- Calorie Progress Section -->
                            <div class="meal-score" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span class="score-label">Tiến độ calo:</span>
                                <span class="score-value" style="color: #e53e3e;">
                                    <span id="total-consumed-display">{{ $caloriesConsumedToday ?? 0 }}</span>/{{ $goal_calories }} kcal
                                </span>
                            </div>
                            <div class="nutrition-bars" style="background: #edf2f7; border-radius: 10px; height: 8px; overflow: hidden; margin-bottom: 15px;">
                                <div id="calorie-progress-bar" class="nutrition-bar" style="width: {{ min(100, round((($caloriesConsumedToday ?? 0) / $goal_calories) * 100)) }}%; background: linear-gradient(90deg, #FF9966, #FF5E62); height: 100%; border-radius: 10px; transition: width 0.5s ease;"></div>
                            </div>

                            <div class="meal-nutrition">
                                <span>450 Cal</span>
                                <span>40g Carbs</span>
                                <span>35g Protein</span>
                                <span>15g Fats</span>
                            </div>
                            <button class="btn btn-primary btn-sm mt-3" id="add-meal-btn-default" data-calories="450" data-name="Lean & Green">
                                <i class="fas fa-plus"></i> Thêm bữa ăn
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Section - Top Right Cards -->
        <div class="dashboard-section section-right">
            <!-- Workout Section -->
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

            <!-- Weekly Stats Section -->
            <div class="card card-weekly-stats">
                <div class="card-title mb-20">Calo tuần này</div>
                <div class="chart-container">
                    <canvas id="weekChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        window.profileData = {
            goalCalories: {{ $goal_calories }},
            caloriesBurnedToday: {{ $caloriesBurnedToday ?? 0 }},
            caloriesConsumedToday: {{ $caloriesConsumedToday ?? 0 }},
            userId: {{ Auth::id() }},
            date: '{{ \Carbon\Carbon::today()->format("Y-m-d") }}',
            weeklyCalories: @json($weeklyCalories ?? [])
        };
    </script>
    <script src="{{ asset('js/profile.js') }}"></script>
    <script>
        // Profile Edit Functionality
        (function() {
            // Avatar Upload
            const avatarInput = document.getElementById('avatar-input');
            const avatarDisplay = document.getElementById('avatar-display');
            const avatarImg = document.getElementById('avatar-img');
            const avatarInitial = document.getElementById('avatar-initial');
            const avatarOverlay = avatarDisplay.querySelector('.avatar-overlay');

            const changeAvatarBtn = document.getElementById('change-avatar-btn');

            if (changeAvatarBtn && avatarInput) {
                changeAvatarBtn.addEventListener('click', () => {
                    avatarInput.click();
                    // Close dropdown
                    if (menuDropdown) menuDropdown.classList.remove('show');
                });

                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (!file) return;

                    // Validate file
                    if (!file.type.match('image.*')) {
                        alert('Vui lòng chọn file ảnh hợp lệ!');
                        return;
                    }

                    if (file.size > 2048 * 1024) {
                        alert('Kích thước ảnh không được vượt quá 2MB!');
                        return;
                    }

                    // Preview image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (avatarImg) {
                            avatarImg.src = e.target.result;
                            avatarImg.style.display = 'block';
                            if (avatarInitial) avatarInitial.style.display = 'none';
                        } else {
                            const img = document.createElement('img');
                            img.id = 'avatar-img';
                            img.src = e.target.result;
                            img.alt = 'Avatar';
                            avatarDisplay.appendChild(img);
                            if (avatarInitial) avatarInitial.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);

                    // Upload to server
                    const formData = new FormData();
                    formData.append('avatar', file);

                    fetch('/profile/avatar', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: formData,
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (avatarImg) {
                                avatarImg.src = data.avatar_url;
                                avatarImg.style.display = 'block';
                                if (avatarInitial) avatarInitial.style.display = 'none';
                            } else {
                                const img = document.createElement('img');
                                img.id = 'avatar-img';
                                img.src = data.avatar_url;
                                img.alt = 'Avatar';
                                img.style.display = 'block';
                                avatarDisplay.appendChild(img);
                                if (avatarInitial) avatarInitial.style.display = 'none';
                            }
                            showNotification('Cập nhật avatar thành công!', 'success');
                            
                            // Update navbar avatar immediately
                            const navAvatar = document.querySelector('.user-trigger .user-avatar');
                            if (navAvatar) {
                                navAvatar.src = data.avatar_url;
                            }
                        } else {
                            showNotification(data.message || 'Có lỗi xảy ra!', 'error');
                            // Revert preview on error
                            if (avatarImg) {
                                avatarImg.style.display = 'none';
                                if (avatarInitial) avatarInitial.style.display = '';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('Có lỗi xảy ra khi upload ảnh!', 'error');
                    });
                });
            }

            // Profile Menu Dropdown
            const menuBtn = document.getElementById('profile-menu-btn');
            const menuDropdown = document.getElementById('profile-menu-dropdown');
            const editProfileBtn = document.getElementById('edit-profile-btn');
            const editModal = document.getElementById('edit-profile-modal');
            const closeModalBtn = document.getElementById('close-edit-modal');
            const cancelEditBtn = document.getElementById('cancel-edit-btn');
            const editForm = document.getElementById('edit-profile-form');

            // Toggle dropdown menu
            if (menuBtn && menuDropdown) {
                menuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menuDropdown.classList.toggle('show');
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!menuBtn.contains(e.target) && !menuDropdown.contains(e.target)) {
                        menuDropdown.classList.remove('show');
                    }
                });
            }

            // Open edit modal
            if (editProfileBtn && editModal) {
                editProfileBtn.addEventListener('click', function() {
                    menuDropdown.classList.remove('show');
                    editModal.classList.add('show');
                });
            }

            // Close modal
            function closeModal() {
                if (editModal) {
                    editModal.classList.remove('show');
                }
            }

            if (closeModalBtn) {
                closeModalBtn.addEventListener('click', closeModal);
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', closeModal);
            }

            // Close modal when clicking overlay
            const modalOverlay = document.querySelector('.modal-overlay');
            if (modalOverlay) {
                modalOverlay.addEventListener('click', closeModal);
            }

            // Handle form submit
            if (editForm) {
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const formData = {
                        fullname: document.getElementById('edit-fullname').value.trim(),
                        weight: parseFloat(document.getElementById('edit-weight').value),
                        height: parseFloat(document.getElementById('edit-height').value),
                        birthday: document.getElementById('edit-birthday').value
                    };

                    // Validation
                    if (!formData.fullname) {
                        showNotification('Vui lòng nhập họ và tên!', 'error');
                        return;
                    }

                    if (formData.weight < 10 || formData.weight > 500) {
                        showNotification('Cân nặng phải từ 10 đến 500 kg!', 'error');
                        return;
                    }

                    if (formData.height < 50 || formData.height > 250) {
                        showNotification('Chiều cao phải từ 50 đến 250 cm!', 'error');
                        return;
                    }

                    if (!formData.birthday) {
                        showNotification('Vui lòng chọn ngày sinh!', 'error');
                        return;
                    }

                    // Disable submit button
                    const submitBtn = editForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang lưu...';

                    // Send request
                    fetch('/profile/update', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify(formData),
                        credentials: 'same-origin'
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(err => {
                                throw new Error(err.message || 'Server error');
                            });
                        }
                        return response.json();
                    })
                    .then(result => {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;

                        if (result.success) {
                            // Update display values
                            document.getElementById('profile-name-display').textContent = formData.fullname;
                            document.getElementById('fullname-display').textContent = formData.fullname;
                            document.getElementById('weight-display').textContent = formData.weight + ' kg';
                            document.getElementById('height-display').textContent = formData.height + ' cm';
                            
                            // Calculate and update age
                            const age = calculateAge(formData.birthday);
                            document.getElementById('age-display').textContent = age;

                            // Update avatar initial if needed
                            const avatarInitial = document.getElementById('avatar-initial');
                            const avatarImg = document.getElementById('avatar-img');
                            if (avatarInitial && (!avatarImg || avatarImg.style.display === 'none')) {
                                avatarInitial.textContent = formData.fullname.charAt(0).toUpperCase();
                            }

                            showNotification('Cập nhật hồ sơ thành công!', 'success');
                            
                            // Update navbar name immediately
                            const navName = document.querySelector('.user-trigger span');
                            if (navName) {
                                navName.textContent = formData.fullname;
                            }
                            closeModal();
                            
                            // Reload page after 1 second to ensure all data is synced
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            const errorMsg = result.message || (result.errors ? Object.values(result.errors).flat().join(', ') : 'Có lỗi xảy ra!');
                            showNotification(errorMsg, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalText;
                        showNotification(error.message || 'Có lỗi xảy ra khi cập nhật!', 'error');
                    });
                });
            }

            function calculateAge(birthday) {
                const today = new Date();
                const birthDate = new Date(birthday);
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                return age;
            }

            function showNotification(message, type) {
                // Simple notification - you can enhance this
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.textContent = message;
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 16px 24px;
                    background: ${type === 'success' ? '#10B981' : '#EF4444'};
                    color: white;
                    border-radius: 8px;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                    z-index: 10000;
                    animation: slideIn 0.3s ease;
                `;
                document.body.appendChild(notification);
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => notification.remove(), 300);
                }, 3000);
            }
        })();
    </script>
@endpush

</body>
</html>
@endsection
