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
