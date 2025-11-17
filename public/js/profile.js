const initialWorkouts = [
  { id: 1, date: '2025-11-16', type: 'Run', duration: 42, calories: 420 },
  { id: 2, date: '2025-11-15', type: 'Strength', duration: 55, calories: 380 },
  { id: 3, date: '2025-11-14', type: 'Yoga', duration: 35, calories: 150 },
  { id: 4, date: '2025-11-12', type: 'HIIT', duration: 30, calories: 360 },
  { id: 5, date: '2025-11-10', type: 'Bike', duration: 60, calories: 520 },
];

// state
let workouts = [...initialWorkouts];
let chart = null;

function formatDateISO(d){
  const dt = new Date(d);
  return dt.toISOString().slice(0,10);
}

// compute totals
function computeTotals(list){
  const calories = list.reduce((s,w)=>s+(w.calories||0),0);
  const minutes = list.reduce((s,w)=>s+(w.duration||0),0);
  const sessions = list.length;
  return { calories, minutes, sessions };
}

// update left stats
function updateProfileStats(){
  const t = computeTotals(workouts);
  document.getElementById('stat-cal').textContent = t.calories;
  document.getElementById('stat-sessions').textContent = t.sessions;
  document.getElementById('stat-mins').textContent = t.minutes + 'm';

  // KPI
  document.getElementById('kpi-cal').textContent = t.calories;
  document.getElementById('kpi-sessions').textContent = t.sessions;
  document.getElementById('kpi-mins').textContent = t.minutes + 'm';
}

// render workouts list
function renderWorkouts(){
  const container = document.getElementById('workouts-list');
  container.innerHTML = '';
  workouts.slice(0,20).forEach(w=>{
    const el = document.createElement('div');
    el.className = 'workout';
    el.innerHTML = `
      <div class="w-left">
        <div class="type-badge">${(w.type || '?').slice(0,2).toUpperCase()}</div>
        <div class="w-meta">
          <div style="font-weight:700">${w.type} · ${w.duration}m</div>
          <div class="sub">${w.date} · ${w.calories} kcal</div>
        </div>
      </div>
      <div class="small muted">Details</div>
    `;
    container.appendChild(el);
  });
}

// build timeseries for last N days
function buildSeries(days = 10){
  // build map date->calories
  const map = {};
  workouts.forEach(w=>{
    const d = w.date;
    map[d] = (map[d] || 0) + (w.calories || 0);
  });

  const series = [];
  const now = new Date();
  for(let i=days-1;i>=0;i--){
    const d = new Date(now);
    d.setDate(now.getDate() - i);
    const iso = d.toISOString().slice(0,10);
    const label = d.toLocaleDateString('vi-VN', { month:'short', day:'numeric' });
    series.push({ label, date: iso, calories: map[iso] || 0 });
  }
  return series;
}

// init chart
function initChart(){
  const ctx = document.getElementById('calChart').getContext('2d');
  const series = buildSeries(10);
  chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: series.map(s=>s.label),
      datasets: [{
        label: 'Calories',
        data: series.map(s=>s.calories),
        fill: true,
        tension: 0.3,
        borderWidth: 2,
        pointRadius: 3,
        backgroundColor: 'rgba(99,102,241,0.12)',
        borderColor: 'rgba(99,102,241,1)'
      }]
    },
    options: {
      responsive:true,
      maintainAspectRatio:false,
      plugins:{
        legend:{display:false},
        tooltip:{mode:'index',intersect:false}
      },
      scales:{
        x:{grid:{display:false}},
        y:{beginAtZero:true}
      }
    }
  });
}

// update chart with range
function updateChart(days){
  let series;
  if(days === 'all'){
    // show all unique dates from earliest to today (bounded at 120 days for performance)
    const earliest = workouts.reduce((min,w)=> w.date < min ? w.date : min, (new Date()).toISOString().slice(0,10));
    const start = new Date(earliest);
    const diffDays = Math.min(120, Math.ceil((new Date() - start)/(1000*60*60*24)));
    series = buildSeries(diffDays || 10);
  } else {
    series = buildSeries(Number(days) || 10);
  }

  chart.data.labels = series.map(s=>s.label);
  chart.data.datasets[0].data = series.map(s=>s.calories);
  chart.update();
}

// add mock workout
function addMockWorkout(){
  const types = ['Run','Strength','Yoga','HIIT','Bike','Walk'];
  const type = types[Math.floor(Math.random()*types.length)];
  const duration = 20 + Math.floor(Math.random()*60);
  const calories = Math.max(80, Math.floor(duration * (6 + Math.random()*8))); // rough cal estimate
  const date = new Date();
  const iso = date.toISOString().slice(0,10);

  const newW = { id: Date.now(), date: iso, type, duration, calories };
  workouts.unshift(newW);
  // keep only recent 200 items
  workouts = workouts.slice(0,200);
  // refresh UI
  updateProfileStats();
  renderWorkouts();
  const sel = document.getElementById('range-select').value;
  updateChart(sel === 'all' ? 'all' : Number(sel));
}

// export CSV
function exportCSV(){
  const header = ['id','date','type','duration','calories'];
  const rows = workouts.map(w => [w.id, w.date, w.type, w.duration, w.calories].join(','));
  const csv = [header.join(','), ...rows].join('\n');
  const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'workouts.csv';
  document.body.appendChild(a);
  a.click();
  a.remove();
  URL.revokeObjectURL(url);
}

// wire up
document.addEventListener('DOMContentLoaded', ()=>{
  updateProfileStats();
  renderWorkouts();
  initChart();

  document.getElementById('add-workout-btn').addEventListener('click', addMockWorkout);
  document.getElementById('range-select').addEventListener('change', (e)=>{
    const val = e.target.value;
    updateChart(val === 'all' ? 'all' : Number(val));
  });
  document.getElementById('export-btn').addEventListener('click', exportCSV);

  // small accessibility: keyboard trigger for add button
  document.getElementById('add-workout-btn').addEventListener('keyup', (e)=>{
    if(e.key === 'Enter') addMockWorkout();
  });

});

