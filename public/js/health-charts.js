/* ============================================
   HEALTH CHARTS JAVASCRIPT
   ============================================ */

let trainingChart = null;
let progressChart = null;

document.addEventListener('DOMContentLoaded', function() {
    initializeHealthCharts();
    setupChartFilters();
});

/**
 * Initialize health charts
 */
function initializeHealthCharts() {
    // Sample data - In production, this would come from the backend
    const trainingData = {
        current: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            sessions: [3, 5, 8, 6],
            hours: [3, 5, 8, 6],
            calories: [450, 750, 1200, 900]
        },
        last3: {
            labels: ['Tháng trước', 'Tháng này - 1', 'Tháng này'],
            sessions: [15, 18, 20],
            hours: [15, 18, 20],
            calories: [2250, 2700, 3000]
        },
        last6: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
            sessions: [15, 18, 20, 22, 19, 23],
            hours: [15, 18, 20, 22, 19, 23],
            calories: [2250, 2700, 3000, 3300, 2850, 3450]
        },
        year: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            sessions: [18, 20, 22, 25, 28, 30, 28, 32, 30, 35, 32, 28],
            hours: [18, 20, 22, 25, 28, 30, 28, 32, 30, 35, 32, 28],
            calories: [2700, 3000, 3300, 3750, 4200, 4500, 4200, 4800, 4500, 5250, 4800, 4200]
        }
    };

    // Initialize training chart
    const trainingCtx = document.getElementById('trainingChart');
    if (trainingCtx) {
        const data = trainingData.current;
        trainingChart = new Chart(trainingCtx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Giảm tổng kết môn học',
                    data: data.sessions,
                    backgroundColor: '#ff6b6b',
                    borderColor: '#ff5252',
                    borderRadius: 6,
                    borderWidth: 0,
                    barThickness: 'flex',
                    maxBarThickness: 60
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#ddd',
                            font: {
                                size: 12
                            },
                            usePointStyle: true,
                            boxWidth: 6
                        }
                    },
                    tooltip: {
                        backgroundColor: '#222',
                        titleColor: '#fff',
                        bodyColor: '#ddd',
                        borderColor: '#333',
                        borderWidth: 1,
                        padding: 10,
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 10,
                        ticks: {
                            color: '#999',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: '#222',
                            drawBorder: false
                        }
                    },
                    x: {
                        ticks: {
                            color: '#999',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                }
            }
        });

        // Update stats
        updateTrainingStats(data);
    }

    // Initialize progress chart
    const progressCtx = document.getElementById('progressChart');
    if (progressCtx) {
        const data = trainingData.current;
        const totalSessions = data.sessions.reduce((a, b) => a + b, 0);
        const completed = Math.round(totalSessions * 0.6);

        progressChart = new Chart(progressCtx, {
            type: 'doughnut',
            data: {
                labels: ['Đã đạt', 'Còn lại'],
                datasets: [{
                    data: [completed, 20 - completed],
                    backgroundColor: ['#4ecdc4', '#5a7c8f'],
                    borderColor: '#111',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#222',
                        titleColor: '#fff',
                        bodyColor: '#ddd',
                        borderColor: '#333',
                        borderWidth: 1,
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' buổi';
                            }
                        }
                    }
                }
            },
            plugins: [{
                id: 'textCenter',
                beforeDatasetsDraw(chart) {
                    const { width, height, ctx } = chart;
                    ctx.restore();

                    const fontSize = (height / 200).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.textBaseline = "middle";
                    ctx.fillStyle = '#ffea00';

                    const text = completed + "/20";
                    const textX = Math.round((width - ctx.measureText(text).width) / 2);
                    const textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }]
        });

        // Update progress stats
        updateProgressStats(totalSessions, completed);
    }
}

/**
 * Update training statistics
 */
function updateTrainingStats(data) {
    const totalSessions = data.sessions.reduce((a, b) => a + b, 0);
    const totalHours = data.hours.reduce((a, b) => a + b, 0);
    const totalCalories = data.calories.reduce((a, b) => a + b, 0);

    document.getElementById('totalSessions').textContent = totalSessions;
    document.getElementById('totalHours').textContent = totalHours + 'h';
    document.getElementById('totalCalories').textContent = totalCalories.toLocaleString() + ' kcal';
}

/**
 * Update progress statistics
 */
function updateProgressStats(total, completed) {
    const weightLoss = (completed * 0.5).toFixed(1);

    document.getElementById('monthlyGoal').textContent = '20 buổi';
    document.getElementById('completedSessions').textContent = completed + ' buổi';
    document.getElementById('weightLoss').textContent = weightLoss + ' kg';
}

/**
 * Setup chart filters
 */
function setupChartFilters() {
    const filter = document.getElementById('trainingMonthFilter');
    if (filter) {
        filter.addEventListener('change', function() {
            updateCharts(this.value);
        });
    }
}

/**
 * Update charts based on filter
 */
function updateCharts(period) {
    // Sample data - In production, this would come from the backend
    const trainingData = {
        current: {
            labels: ['Tuần 1', 'Tuần 2', 'Tuần 3', 'Tuần 4'],
            sessions: [3, 5, 8, 6],
            hours: [3, 5, 8, 6],
            calories: [450, 750, 1200, 900]
        },
        last3: {
            labels: ['Tháng trước', 'Tháng này - 1', 'Tháng này'],
            sessions: [15, 18, 20],
            hours: [15, 18, 20],
            calories: [2250, 2700, 3000]
        },
        last6: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6'],
            sessions: [15, 18, 20, 22, 19, 23],
            hours: [15, 18, 20, 22, 19, 23],
            calories: [2250, 2700, 3000, 3300, 2850, 3450]
        },
        year: {
            labels: ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'],
            sessions: [18, 20, 22, 25, 28, 30, 28, 32, 30, 35, 32, 28],
            hours: [18, 20, 22, 25, 28, 30, 28, 32, 30, 35, 32, 28],
            calories: [2700, 3000, 3300, 3750, 4200, 4500, 4200, 4800, 4500, 5250, 4800, 4200]
        }
    };

    // Map filter value to data key
    const dataKey = period === 'current' ? 'current' : 
                    period === 'last3' ? 'last3' : 
                    period === 'last6' ? 'last6' : 'year';

    const data = trainingData[dataKey];

    if (trainingChart) {
        trainingChart.data.labels = data.labels;
        trainingChart.data.datasets[0].data = data.sessions;
        trainingChart.update();
        updateTrainingStats(data);
    }

    if (progressChart) {
        const totalSessions = data.sessions.reduce((a, b) => a + b, 0);
        const completed = Math.round(totalSessions * 0.6);
        progressChart.data.datasets[0].data = [completed, 20 - completed];
        progressChart.update();
        updateProgressStats(totalSessions, completed);
    }
}
