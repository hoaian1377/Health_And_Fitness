@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">
<style>/* Reset và Base Styles */
/* Body có gradient toàn màn hình */

body {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
}

/* Container nội dung */
.workout-detail-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    background: transparent;
    /* bỏ gradient */
}

.workout-detail-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: 100vh;
}

/* Header Title */
.workout-detail-page h1 {
    color: #ffffff;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
}

/* Video Container */
.video-container {
    background: #ffffff;
    border-radius: 20px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    margin-bottom: 2rem;
}

.video-frame {
    width: 100%;
    border-radius: 15px;
    max-height: 500px;
    object-fit: cover;
}

/* Stats Grid */
.video-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-item {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.stat-item .icon {
    font-size: 2rem;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.8rem;
    border-radius: 12px;
}

.stat-item span:last-child {
    color: #ffffff;
    font-weight: 600;
    font-size: 1.1rem;
}

/* Tab Navigation */
.tab-navigation {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.5rem;
    border-radius: 15px;
    backdrop-filter: blur(10px);
}

.tab-btn {
    flex: 1;
    padding: 1rem 2rem;
    border: none;
    background: transparent;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.tab-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.tab-btn.active {
    background: #ffffff;
    color: #667eea;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Tab Content */
.tab-content {
    background: transparent;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Info Cards */
.workout-info {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.info-card {
    background: #ffffff;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.info-card h3 {
    color: #667eea;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    border-bottom: 3px solid #667eea;
    padding-bottom: 0.5rem;
}

.info-card p {
    color: #4a5568;
    line-height: 1.8;
    font-size: 1.05rem;
}

.info-card strong {
    color: #764ba2;
    font-weight: 600;
}

/* Workout Steps */
.workout-steps {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.workout-steps li {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    background: linear-gradient(135deg, #f6f8fb 0%, #e9ecf3 100%);
    padding: 1.5rem;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.workout-steps li:hover {
    transform: translateX(10px);
    box-shadow: 0 5px 20px rgba(102, 126, 234, 0.2);
}

.step-number {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
}

.step-content {
    flex: 1;
}

.step-content strong {
    display: block;
    color: #667eea;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
}

.step-content p {
    color: #4a5568;
    line-height: 1.6;
    margin: 0;
}

/* Workout Tips */
.workout-tips {
    background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
    border-left: 5px solid #e17055;
}

.workout-tips h3 {
    color: #d63031;
    border-bottom-color: #d63031;
}

.workout-tips ul {
    list-style: none;
    padding: 0;
}

.workout-tips ul li {
    padding: 0.8rem 0;
    padding-left: 2rem;
    color: #2d3436;
    font-weight: 500;
    position: relative;
    line-height: 1.6;
}

.workout-tips ul li:before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #00b894;
    font-weight: 700;
    font-size: 1.3rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .workout-detail-page {
        padding: 1rem;
    }

    .workout-detail-page h1 {
        font-size: 1.8rem;
    }

    .video-stats {
        grid-template-columns: repeat(2, 1fr);
    }

    .tab-btn {
        padding: 0.8rem 1rem;
        font-size: 1rem;
    }

    .info-card {
        padding: 1.5rem;
    }

    .workout-steps li {
        flex-direction: column;
        gap: 1rem;
    }

    .step-number {
        width: 40px;
        height: 40px;
    }
}

@media (max-width: 480px) {
    .video-stats {
        grid-template-columns: 1fr;
    }

    .tab-navigation {
        flex-direction: column;
        gap: 0.5rem;
    }
}

/* ================= LOADING ANIMATION ================= */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 50px;
    height: 50px;
    border: 4px solid #f3f3f3;
    border-top: 4px solid #10b981;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 9999;
}

@keyframes spin {
    0% {
        transform: translate(-50%, -50%) rotate(0deg);
    }

    100% {
        transform: translate(-50%, -50%) rotate(360deg);
    }
}

.difficulty-indicator {
    display: none !important;
}


/* ===== VIDEO CONTAINER (Updated) ===== */
.video-container {
    width: 100%;
    max-width: 800px;
    margin: 30px auto;
    padding: 12px;
    /* Tạo viền khung */
    border-radius: 24px;
    /* Gradient nền tối sang trọng */
    background: linear-gradient(145deg, #1e293b, #0f172a);
    box-shadow:
        0 20px 40px rgba(0, 0, 0, 0.3),
        inset 0 1px 1px rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

/* Hiệu ứng ánh sáng nền */
.video-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 60%);
    pointer-events: none;
}

.video-frame {
    width: 100%;
    height: auto;
    max-height: 500px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    object-fit: contain;
    background: #000;
    position: relative;
    z-index: 1;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .video-container {
        padding: 8px;
        margin: 15px auto;
        border-radius: 16px;
        max-width: 100%;
    }

    .video-frame {
        max-height: 300px;
        border-radius: 12px;
    }

    .workout-detail-page {
        padding: 1rem;
    }
}

@media (max-width: 992px) {

    .navbar {
        padding: 12px 15px;
        /* thu padding để menu không bị đẩy lệch */
    }

    .menu {
        display: none;
        flex-direction: column;

        position: absolute;
        top: 75px;

        /* căn SÁT LỀ TRÁI để không bị tràn bên phải */
        right: 10px;

        /* Giảm chiều rộng menu trên điện thoại */
        width: 180px;

        background: #111;
        padding: 12px 0;
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.45);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .menu.show {
        display: flex;
        animation: slideIn 0.28s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-15px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .menu a {
        padding: 10px 18px;
        width: 100%;
        text-align: left;
        border-radius: 10px;
        font-size: 14px;
        transition: background 0.25s;
    }

    .menu a:hover {
        background: #222;
    }

    .menu-toggle {
        display: block;
    }

    .user-menu,
    .auth-buttons {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 18px;
        gap: 10px;
    }
}

.menu a {
    padding: 8px 14px;
    /* thu nhỏ vùng chạm */
    width: auto;
    /* không chiếm 100% chiều rộng */
    display: inline-block;
    /* chỉ chiếm đúng nội dung */
    text-align: left;
    border-radius: 10px;
    transition: background 0.2s;
    font-size: 14px;
}

button {
    padding: 8px 14px;
    /* vùng chạm */
    width: auto;
    /* không chiếm toàn bộ chiều rộng */
    display: inline-block;
    /* chỉ chiếm đúng nội dung */
    text-align: left;
    /* chữ lệch trái */
    border-radius: 10px;
    transition: background 0.2s;
    font-size: 14px;
    /* tùy chọn giảm padding bên trái nếu vẫn lệch */
    padding-left: 6px;
    /* giảm khoảng cách trái */
}</style>

<div class="workout-detail-page">

    <!-- Tên bài tập -->
    <h1>{{ $exercise->name_workout }}</h1>

<!--video bai tap -->
<div class="video-container">
    @if($exercise->video_urls)
        <video class="video-frame" controls poster="{{ asset($exercise->urls) }}">
            <source src="{{ asset($exercise->video_urls) }}" type="video/mp4">
            Trình duyệt không hỗ trợ video.
        </video>
    @elseif($exercise->urls)
        <img class="video-frame" src="{{ asset($exercise->urls) }}" alt="{{ $exercise->name_workout }}">
    @else
        <div class="video-frame no-media">
            Video / ảnh chưa có
        </div>
    @endif
</div>
 </div>
<!-- Stats -->
    <div class="video-stats">
        <div class="stat-item">
            <span class="icon">⏱</span>
            <span>
                @php
                    $duration = $exercise->duration ?? '00:00:00';
                    $parts = explode(':', $duration);
                    $h = (int)$parts[0]; $m = (int)$parts[1]; $s = (int)$parts[2];
                    if($h>0) echo "{$h} giờ {$m} phút";
                    elseif($m>0) echo "{$m} phút";
                    else echo "{$s} giây";
                @endphp
            </span>
        </div>
        <div class="stat-item">
            <span class="icon">🔥</span>
            <span>{{ $exercise->calories_burned ?? 0 }} kcal</span>
        </div>
        <div class="stat-item">
            <span class="icon">🔄</span>
            <span>{{ $exercise->practice_round ?? 0 }} vòng</span>
        </div>
        <div class="stat-item">
            <span class="icon">💪</span>
            <span>{{ $exercise->muscle_group ?? 'Full body' }}</span>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <button class="tab-btn active" data-tab="info">Thông tin</button>
    </div>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Thông tin chi tiết -->
        <div class="tab-panel active" id="info">
            <div class="workout-info">

                <!-- Tổng quan -->
                <div class="info-card">
                    <h3>Tổng quan</h3>
                    <p>
                        Bài tập <strong>{{ $exercise->name_workout }}</strong> tập trung vào nhóm cơ 
                        <strong>{{ $exercise->muscle_group ?? 'toàn thân' }}</strong>, đốt cháy 
                        <strong>{{ $exercise->calories_burned ?? 0 }} calories</strong> trong 
                        <strong>
                        @php
                            if($h>0) echo "{$h} giờ {$m} phút";
                            else echo "{$m} phút";
                        @endphp
                        </strong> với <strong>{{ $exercise->practice_round ?? 0 }} vòng</strong>.
                    </p>
                </div>

                <!-- Thông số chi tiết -->
                <div class="info-card">
                    <h3>Chi tiết thông số</h3>
                    <ul class="workout-steps">
                        <li>
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Nhóm cơ</strong>
                                <p>{{ $exercise->muscle_group ?? 'Chưa phân loại' }}</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Thời lượng</strong>
                                <p>{{ $h }} giờ {{ $m }} phút {{ $s }} giây</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Số vòng tập</strong>
                                <p>{{ $exercise->practice_round ?? 0 }} vòng</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <strong>Calorie tiêu thụ</strong>
                                <p>{{ $exercise->calories_burned ?? 0 }} kcal</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Tips -->
                <div class="info-card workout-tips">
                    <h3>💡 Lưu ý quan trọng</h3>
                    <ul>
                        <li>Khởi động kỹ trước khi tập để tránh chấn thương</li>
                        <li>Giữ nhịp thở đều đặn trong quá trình tập luyện</li>
                        <li>Nghỉ ngơi hợp lý giữa các vòng tập</li>
                        <li>Uống đủ nước trước, trong và sau khi tập</li>
                        <li>Dừng ngay nếu cảm thấy đau hoặc khó chịu bất thường</li>
                    </ul>
                </div>

            </div>
        </div>


    </div>
</div>

  

</div>

<script>
    (function () {
    function initMenuToggle() {
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        if (menuToggle && menu && !menuToggle.dataset.bound) {
            menuToggle.addEventListener('click', () => {
                menu.classList.toggle('show');
            });
            menuToggle.dataset.bound = 'true';
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMenuToggle);
    } else {
        initMenuToggle();
    }

    let totalCal = window.profileData.caloriesBurnedToday || 0;
    let exercisesToday = [];

    // Initialize Pie Chart
    const pieCtx = document.getElementById('pieChart');
    let pieChart = null;
    if (pieCtx && typeof Chart !== 'undefined') {
        pieChart = new Chart(pieCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: ['#9FCD3B', '#0EA5E9', '#F59E0B', '#EF4444', '#10B981', '#8B5CF6'],
                    borderColor: '#1A1F2E',
                    borderWidth: 2,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            color: '#A0AEC0',
                            font: { size: 12, weight: '600' },
                            padding: 15,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
    }

    // Initialize Week Chart with data from database
    const weekCtx = document.getElementById('weekChart');
    if (weekCtx && typeof Chart !== 'undefined') {
        // Get data from window.profileData if available
        let labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        let calories = [350, 420, 380, 450, 390, 410, 0];

        if (window.profileData && window.profileData.weeklyCalories && window.profileData.weeklyCalories.length > 0) {
            const weeklyData = window.profileData.weeklyCalories;
            labels = weeklyData.map(d => {
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                const date = new Date(d.date);
                return days[date.getDay()];
            });
            calories = weeklyData.map(d => d.calories);
        }

        new Chart(weekCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Calo (kcal)',
                    data: calories,
                    borderColor: '#9FCD3B',
                    backgroundColor: 'rgba(159, 205, 59, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#9FCD3B',
                    pointBorderColor: '#1A1F2E',
                    pointBorderWidth: 2,
                    pointHoverRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#A0AEC0',
                            font: { size: 12, weight: '600' }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(159, 205, 59, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            color: '#718096',
                            font: { size: 12 }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: '#718096',
                            font: { size: 12 }
                        }
                    }
                }
            }
        });
    }

    // Load existing workouts from database
    async function loadWorkouts() {
        try {
            const response = await fetch('/api/workout/today', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                credentials: 'same-origin'
            });
            const data = await response.json();

            if (data.success) {
                exercisesToday = data.workouts.map(w => ({
                    id: w.id,
                    name: w.exercise_name,
                    cal: w.calories
                }));
                totalCal = data.total_calories || 0;
                updateUI();
            }
        } catch (error) {
            console.error('Error loading workouts:', error);
        }
    }

    function updateUI() {
        const totalCalEl = document.getElementById('total-cal');
        if (totalCalEl) totalCalEl.innerText = totalCal;

        // Update progress bar
        const goal = window.profileData && window.profileData.goalCalories ? window.profileData.goalCalories : 1;
        const progress = Math.min(100, (totalCal / goal) * 100);
        const progressBar = document.getElementById('progress-bar');
        if (progressBar) progressBar.style.width = progress + '%';
        const progressPercent = document.getElementById('progress-percent');
        if (progressPercent) progressPercent.innerText = Math.round(progress) + '%';

        // Update pie chart
        if (pieChart) {
            pieChart.data.labels = exercisesToday.map(e => e.name);
            pieChart.data.datasets[0].data = exercisesToday.map(e => e.cal);
            pieChart.update();
        }

        // Update exercise list
        const list = document.getElementById('exercise-list');
        if (!list) return;
        list.innerHTML = '';

        if (exercisesToday.length === 0) {
            const empty = document.createElement('div');
            empty.className = 'exercise-list-empty';
            empty.innerText = 'Chưa có bài tập nào';
            list.appendChild(empty);
            return;
        }

        exercisesToday.forEach((e, index) => {
            const card = document.createElement('div');
            card.className = 'exercise-list-item';
            card.innerHTML = `
                <span class="exercise-name">${e.name}</span>
                <div class="exercise-meta">
                    <span class="exercise-cal">${e.cal} kcal</span>
                    <button class="exercise-remove" data-id="${e.id}" data-index="${index}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
            list.appendChild(card);
        });

        // attach remove handlers
        list.querySelectorAll('.exercise-remove').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                removeExercise(id);
            });
        });
    }

    async function removeExercise(id) {
        try {
            const response = await fetch(`/api/workout/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                credentials: 'same-origin'
            });

            const data = await response.json();
            if (data.success) {
                // Reload workouts from server
                await loadWorkouts();
            }
        } catch (error) {
            console.error('Error removing workout:', error);
        }
    }

    async function addExerciseFromSelect() {
        const select = document.getElementById('exercise-select');
        if (!select) return;
        const name = select.options[select.selectedIndex].text;
        const cal = Number(select.value);
        if (!cal) {
            alert('Vui lòng chọn một bài tập hợp lệ');
            return;
        }

        try {
            const response = await fetch('/api/workout/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    exercise_name: name,
                    calories: cal
                }),
                credentials: 'same-origin'
            });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Server error');
            }

            const data = await response.json();
            if (data.success) {
                select.value = '';
                // Reload workouts from server
                await loadWorkouts();
                alert('Đã thêm bài tập thành công!');
            } else {
                alert(data.message || 'Có lỗi xảy ra');
            }
        } catch (error) {
            console.error('Error adding workout:', error);
            alert('Lỗi: ' + error.message);
        }
    }

    async function resetExercises() {
        if (!confirm('Bạn có chắc chắn muốn xóa tất cả bài tập hôm nay?')) return;

        try {
            const response = await fetch('/api/workout/reset', {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                credentials: 'same-origin'
            });

            const data = await response.json();
            if (data.success) {
                // Reload workouts from server
                await loadWorkouts();
            }
        } catch (error) {
            console.error('Error resetting workouts:', error);
        }
    }

    window.addEventListener('load', () => {
        const addBtn = document.getElementById('add-ex');
        const resetBtn = document.getElementById('reset-ex');
        if (addBtn) addBtn.addEventListener('click', addExerciseFromSelect);
        if (resetBtn) resetBtn.addEventListener('click', resetExercises);

        // Load existing workouts on page load
        loadWorkouts();

        // Meal Button Handler
        const mealBtns = document.querySelectorAll('#add-meal-btn, #add-meal-btn-default');
        const foodModal = document.getElementById('food-list-modal');
        const closeFoodModalBtn = document.getElementById('close-food-modal');
        const foodListContainer = document.getElementById('food-list-container');
        const saveSelectedFoodBtn = document.getElementById('save-selected-food-btn');
        const selectedTotalCalEl = document.getElementById('selected-total-cal');
        const totalConsumedDisplay = document.getElementById('total-consumed-display');
        let foodListLoaded = false;

        // Initialize total consumed from server data if available (need to pass this from controller)
        // For now, we'll default to 0 or try to read from a data attribute if we add one later.
        // Ideally, window.profileData should include caloriesConsumedToday.
        if (window.profileData && window.profileData.caloriesConsumedToday) {
            if (totalConsumedDisplay) totalConsumedDisplay.innerText = window.profileData.caloriesConsumedToday;
        }

        function closeFoodModal() {
            if (foodModal) foodModal.classList.remove('show');
            // Reset selection
            if (foodListContainer) {
                foodListContainer.querySelectorAll('.food-checkbox').forEach(cb => cb.checked = false);
            }
            if (selectedTotalCalEl) selectedTotalCalEl.innerText = '0';
        }

        if (closeFoodModalBtn) closeFoodModalBtn.addEventListener('click', closeFoodModal);
        if (foodModal) {
            foodModal.querySelector('.modal-overlay').addEventListener('click', closeFoodModal);
        }

        async function loadFoodList() {
            try {
                const response = await fetch('/api/meal/list', {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    credentials: 'same-origin'
                });
                const data = await response.json();

                if (data.success) {
                    renderFoodList(data.foods);
                    foodListLoaded = true;
                } else {
                    foodListContainer.innerHTML = '<div class="text-center text-danger">Không tải được danh sách món ăn</div>';
                }
            } catch (error) {
                console.error('Error loading food list:', error);
                foodListContainer.innerHTML = '<div class="text-center text-danger">Lỗi kết nối</div>';
            }
        }

        function updateTotalSelected() {
            if (!selectedTotalCalEl) return;
            const checkboxes = foodListContainer.querySelectorAll('.food-checkbox:checked');
            let total = 0;
            checkboxes.forEach(cb => {
                total += Number(cb.dataset.cal);
            });
            selectedTotalCalEl.innerText = total;
        }

        // LocalStorage Key
        const storageKey = `meal_selection_${window.profileData.userId}_${window.profileData.date}`;

        function getStoredSelection() {
            const stored = localStorage.getItem(storageKey);
            return stored ? JSON.parse(stored) : [];
        }

        function saveSelection(ids) {
            localStorage.setItem(storageKey, JSON.stringify(ids));
        }

        function renderFoodList(foods) {
            foodListContainer.innerHTML = '';
            if (!foods || foods.length === 0) {
                foodListContainer.innerHTML = '<div class="text-center">Chưa có món ăn nào</div>';
                return;
            }

            const selectedIds = getStoredSelection();

            foods.forEach(food => {
                const row = document.createElement('tr');
                const isChecked = selectedIds.includes(String(food.meal_planID));

                row.innerHTML = `
                    <td>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input food-checkbox" id="food-${food.meal_planID}" data-calories="${food.calories}" data-name="${food.meal_name}" value="${food.meal_planID}" ${isChecked ? 'checked' : ''}>
                            <label class="custom-control-label" for="food-${food.meal_planID}"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="${food.urls || 'images/meal1.avif'}" class="rounded-circle mr-2" width="40" height="40" alt="${food.meal_name}" onerror="this.src='images/meal1.avif'">
                            <div>
                                <div class="font-weight-bold">${food.meal_name}</div>
                                <div class="text-muted small">${food.calories} kcal</div>
                            </div>
                        </div>
                    </td>
                    <td class="text-right">
                        <button class="btn btn-sm btn-outline-danger delete-food-btn" data-id="${food.meal_planID}" title="Xóa món ăn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                `;

                // Toggle checkbox on row click (except when clicking delete button)
                row.addEventListener('click', (e) => {
                    if (e.target.closest('.delete-food-btn')) return;

                    const checkbox = row.querySelector('.food-checkbox');
                    if (e.target !== checkbox && e.target !== checkbox.nextElementSibling) {
                        checkbox.checked = !checkbox.checked;
                        updateTotalSelected();
                    }
                });

                // Delete button handler
                const deleteBtn = row.querySelector('.delete-food-btn');
                deleteBtn.addEventListener('click', async (e) => {
                    e.stopPropagation(); // Prevent row click
                    if (!confirm(`Bạn có chắc chắn muốn xóa món "${food.meal_name}" khỏi danh sách không?`)) return;

                    try {
                        const response = await fetch(`/api/meal/delete/${food.meal_planID}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                            },
                            credentials: 'same-origin'
                        });

                        const data = await response.json();
                        if (data.success) {
                            alert('Đã xóa món ăn thành công!');

                            // Remove from storage if deleted
                            let currentSelection = getStoredSelection();
                            currentSelection = currentSelection.filter(id => id !== String(food.meal_planID));
                            saveSelection(currentSelection);

                            loadFoodList(); // Reload list
                        } else {
                            alert(data.message || 'Có lỗi xảy ra');
                        }
                    } catch (error) {
                        console.error('Error deleting food:', error);
                        alert('Lỗi: ' + error.message);
                    }
                });

                foodListContainer.appendChild(row);
            });

            // Add event listeners to new checkboxes
            document.querySelectorAll('.food-checkbox').forEach(cb => {
                cb.addEventListener('change', updateTotalSelected);
            });

            // Initial update of total
            updateTotalSelected();
        }

        function updateTotalSelected() {
            let total = 0;
            const checkboxes = document.querySelectorAll('.food-checkbox:checked');
            checkboxes.forEach(cb => {
                total += parseInt(cb.dataset.calories || 0);
            });
            selectedTotalCalEl.innerText = total;
        }

        if (saveSelectedFoodBtn) {
            saveSelectedFoodBtn.addEventListener('click', async () => {
                const checkboxes = document.querySelectorAll('.food-checkbox:checked');
                let totalCalories = 0;
                const selectedIds = [];

                checkboxes.forEach(cb => {
                    totalCalories += parseInt(cb.dataset.calories || 0);
                    selectedIds.push(cb.value); // Collect IDs
                });

                try {
                    // 1. Reset Daily Calories first
                    await fetch('/api/meal/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        credentials: 'same-origin'
                    });

                    // 2. Add the new Total
                    if (totalCalories > 0) {
                        await addMealLog('Selected Meals', totalCalories);
                    } else {
                        // If 0, just update UI manually since addMealLog might not be called or needed for 0
                        const displays = document.querySelectorAll('#total-consumed-display');
                        displays.forEach(el => el.innerText = 0);
                        const progressBar = document.getElementById('calorie-progress-bar');
                        if (progressBar) progressBar.style.width = '0%';
                    }

                    // 3. Save Selection to LocalStorage
                    saveSelection(selectedIds);

                    foodModal.classList.remove('show'); // Assuming foodModal is the correct element for the modal

                } catch (error) {
                    console.error('Error syncing meals:', error);
                    alert('Lỗi khi lưu bữa ăn: ' + error.message);
                }
            });
        }

        async function addMealLog(name, cal) {
            try {
                const response = await fetch('/api/meal/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        calories: cal
                    }),
                    credentials: 'same-origin'
                });

                const data = await response.json();
                if (data.success) {
                    alert(`Đã thêm thành công! Tổng calo nạp vào: ${data.total_consumed} kcal`);

                    // Update Text
                    const displays = document.querySelectorAll('#total-consumed-display');
                    displays.forEach(el => el.innerText = data.total_consumed);

                    // Update Progress Bar
                    const progressBar = document.getElementById('calorie-progress-bar');
                    if (progressBar && window.profileData && window.profileData.goalCalories) {
                        const percentage = Math.min(100, (data.total_consumed / window.profileData.goalCalories) * 100);
                        progressBar.style.width = `${percentage}%`;
                    }
                } else {
                    alert(data.message || 'Có lỗi xảy ra');
                }
            } catch (error) {
                console.error('Error adding meal:', error);
                alert('Lỗi: ' + error.message);
            }
        }

        // Reset Calories Handler
        const resetBtns = document.querySelectorAll('#reset-calories-btn, #reset-calories-btn-default');
        resetBtns.forEach(btn => {
            btn.addEventListener('click', async () => {
                if (!confirm('Bạn có chắc chắn muốn đặt lại số calo hôm nay về 0 không?')) return;

                try {
                    const response = await fetch('/api/meal/reset', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        credentials: 'same-origin'
                    });

                    const data = await response.json();
                    if (data.success) {
                        alert('Đã đặt lại calo thành công!');

                        // Update UI
                        const displays = document.querySelectorAll('#total-consumed-display');
                        displays.forEach(el => el.innerText = 0);

                        const progressBar = document.getElementById('calorie-progress-bar');
                        if (progressBar) {
                            progressBar.style.width = '0%';
                        }
                    } else {
                        alert(data.message || 'Có lỗi xảy ra');
                    }
                } catch (error) {
                    console.error('Error resetting calories:', error);
                    alert('Lỗi: ' + error.message);
                }
            });
        });

        mealBtns.forEach(btn => {
            btn.addEventListener('click', async (e) => {
                e.preventDefault(); // Prevent default action
                if (foodModal) {
                    foodModal.classList.add('show');
                    if (!foodListLoaded) {
                        await loadFoodList();
                    }
                }
            });
        });
    });

})();

</script>
@endsection
