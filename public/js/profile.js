(function(){
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

    let totalCal = 0;
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

    // Initialize Week Chart
    const weekCtx = document.getElementById('weekChart');
    if (weekCtx && typeof Chart !== 'undefined') {
        new Chart(weekCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Calo (kcal)',
                    data: [350, 420, 380, 450, 390, 410, 0],
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
                    },
                    grid: {
                        color: 'rgba(159, 205, 59, 0.1)',
                        drawBorder: false
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
                    <button class="exercise-remove" data-index="${index}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            `;
            list.appendChild(card);
        });

        // attach remove handlers
        list.querySelectorAll('.exercise-remove').forEach(btn => {
            btn.addEventListener('click', () => {
                const idx = Number(btn.getAttribute('data-index'));
                removeExercise(idx);
            });
        });
    }

    function removeExercise(index) {
        if (exercisesToday[index]) {
            totalCal -= exercisesToday[index].cal;
            exercisesToday.splice(index, 1);
            updateUI();
        }
    }

    function addExerciseFromSelect() {
        const select = document.getElementById('exercise-select');
        if (!select) return;
        const name = select.options[select.selectedIndex].text;
        const cal = Number(select.value);
        if (!cal) {
            alert('Vui lòng chọn một bài tập hợp lệ');
            return;
        }
        exercisesToday.push({ name, cal });
        totalCal += cal;
        select.value = '';
        updateUI();
    }

    function resetExercises() {
        if (!confirm('Bạn có chắc chắn muốn xóa tất cả bài tập hôm nay?')) return;
        exercisesToday = [];
        totalCal = 0;
        updateUI();
    }

    window.addEventListener('load', () => {
        const addBtn = document.getElementById('add-ex');
        const resetBtn = document.getElementById('reset-ex');
        if (addBtn) addBtn.addEventListener('click', addExerciseFromSelect);
        if (resetBtn) resetBtn.addEventListener('click', resetExercises);
        updateUI();
    });

})();
