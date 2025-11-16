/* ============================================
   CALENDAR AND SCHEDULE JAVASCRIPT
   ============================================ */

let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

document.addEventListener('DOMContentLoaded', function() {
    initializeCalendar();
    setupCalendarNavigation();
});

/**
 * Initialize calendar
 */
function initializeCalendar() {
    renderCalendar(currentMonth, currentYear);
}

/**
 * Setup calendar navigation
 */
function setupCalendarNavigation() {
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    if (prevBtn) {
        prevBtn.addEventListener('click', function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });
    }
}

/**
 * Render calendar
 */
function renderCalendar(month, year) {
    const calendarDays = document.getElementById('calendarDays');
    const currentMonthSpan = document.getElementById('currentMonth');

    if (!calendarDays || !currentMonthSpan) return;

    // Update month display
    const monthNames = [
        'tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6',
        'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'
    ];
    currentMonthSpan.textContent = monthNames[month] + ' ' + year;

    // Get first day of month and number of days
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const daysInPrevMonth = new Date(year, month, 0).getDate();

    // Days with workouts (sample data)
    const workoutDays = [4, 6, 8, 13, 16, 20, 25, 27];

    // Clear calendar
    calendarDays.innerHTML = '';

    // Add previous month's days
    for (let i = firstDay - 1; i >= 0; i--) {
        const day = daysInPrevMonth - i;
        const dayEl = createDayElement(day, 'other-month');
        calendarDays.appendChild(dayEl);
    }

    // Add current month's days
    const today = new Date();
    for (let i = 1; i <= daysInMonth; i++) {
        const dayEl = createDayElement(i);

        // Check if today
        if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
            dayEl.classList.add('today');
        }

        // Check if has workout
        if (workoutDays.includes(i)) {
            dayEl.classList.add('has-workout');
        }

        // Mark current day (16)
        if (i === 16) {
            dayEl.classList.add('current-day');
        }

        dayEl.addEventListener('click', function() {
            handleDayClick(i, month, year);
        });

        calendarDays.appendChild(dayEl);
    }

    // Add next month's days
    const totalCells = calendarDays.children.length;
    const remainingCells = 42 - totalCells;
    for (let i = 1; i <= remainingCells; i++) {
        const dayEl = createDayElement(i, 'other-month');
        calendarDays.appendChild(dayEl);
    }
}

/**
 * Create day element
 */
function createDayElement(day, className = '') {
    const dayEl = document.createElement('div');
    dayEl.className = 'calendar-day ' + className;
    dayEl.textContent = day;
    if (className === 'other-month') {
        dayEl.classList.add('empty');
    }
    return dayEl;
}

/**
 * Handle day click
 */
function handleDayClick(day, month, year) {
    const dateStr = `${day}/${month + 1}/${year}`;
    console.log('Selected date:', dateStr);

    // Remove previous current-day selection
    document.querySelectorAll('.calendar-day.current-day').forEach(el => {
        el.classList.remove('current-day');
    });

    // Add to clicked day
    event.target.classList.add('current-day');
}

/**
 * Setup schedule filter
 */
document.addEventListener('DOMContentLoaded', function() {
    const scheduleFilter = document.getElementById('scheduleMonthFilter');
    if (scheduleFilter) {
        scheduleFilter.addEventListener('change', function() {
            updateSchedule(this.value);
        });
    }
});

/**
 * Update schedule based on filter
 */
function updateSchedule(semester) {
    const scheduleData = {
        current: [
            {
                name: 'Thể dục cơ hình nâng cao - Fitness 2',
                detail: 'Thứ được tính năng cao - Fitness 2',
                credits: 2
            },
            {
                name: 'English B2.5',
                detail: 'Khóa học ngoại ngữ - English',
                credits: 0
            },
            {
                name: 'Yoga cơ bản cho người mới bắt đầu',
                detail: 'Khóa học yoga - Beginner',
                credits: 3
            }
        ],
        fall: [
            {
                name: 'Bơi lội nâng cao',
                detail: 'Khóa học bơi - Advanced',
                credits: 2
            },
            {
                name: 'Pilates toàn thân',
                detail: 'Khóa học pilates - Full Body',
                credits: 2
            },
            {
                name: 'Zumba vui vẻ',
                detail: 'Khóa học nhảy - Zumba',
                credits: 2
            }
        ],
        spring: [
            {
                name: 'Chạy bộ nâng cao',
                detail: 'Khóa học chạy - Advanced',
                credits: 2
            },
            {
                name: 'Boxing cơ bản',
                detail: 'Khóa học boxing - Beginner',
                credits: 3
            },
            {
                name: 'Gym toàn thân',
                detail: 'Khóa học tập luyện - Full Body',
                credits: 4
            }
        ]
    };

    const data = scheduleData[semester] || scheduleData.current;
    const scheduleList = document.querySelector('.schedule-list');

    if (scheduleList) {
        scheduleList.innerHTML = '';

        data.forEach(course => {
            const itemEl = document.createElement('div');
            itemEl.className = 'schedule-item';
            itemEl.innerHTML = `
                <div class="schedule-course-info">
                    <h5 class="course-name">${course.name}</h5>
                    <div class="course-details">
                        <span class="detail-label">${course.detail}</span>
                    </div>
                </div>
                <div class="schedule-credits">
                    <span class="credits-label">Tín chỉ</span>
                    <span class="credits-value">${course.credits}</span>
                </div>
            `;
            scheduleList.appendChild(itemEl);
        });
    }
}
