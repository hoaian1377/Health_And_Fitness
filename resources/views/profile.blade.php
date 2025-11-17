@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard Fitness</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root{
  --bg:#f4f6f8; --card:#ffffff; --accent:#4f46e5; --muted:#6b7280; --radius:16px; --shadow:0 6px 18px rgba(15,23,42,0.08);
  font-family: Inter, sans-serif;
}
body{margin:0; background:#f3f5f9;}
.wrap{max-width:1200px;margin:28px auto;padding:22px;display:grid;grid-template-columns:420px 1fr;gap:22px;}
.left-col{display:flex;flex-direction:column;gap:22px;}
.card{background:var(--card);border-radius:var(--radius);box-shadow:var(--shadow);padding:18px;overflow:hidden;}
h2{margin:0 0 10px 0;font-size:18px;}
p.small{color:var(--muted);font-size:14px;margin:0 0 6px;}
.right-col{display:flex;flex-direction:column;gap:22px;}
.tall-card{display:flex;flex-direction:column;gap:18px;min-height:520px;}
.split{background:#fff;border-radius:16px;padding:16px;display:flex;flex-direction:column;gap:12px;box-shadow:0 6px 18px rgba(15,23,42,0.04);}
.exercise-top{display:flex;gap:18px;align-items:flex-start;flex-wrap:wrap;}
.exercise-form{flex:1 1 320px;min-width:240px;}
.exercise-form input{width:100%;padding:10px 12px;border-radius:10px;border:1px solid rgba(15,23,42,0.06);margin-bottom:10px;font-size:14px;}
.btn{display:inline-block;background:var(--accent);color:white;padding:10px 14px;border-radius:10px;cursor:pointer;border:none;font-weight:600;}
.btn.red{background:#ef4444;}
.list{margin-top:10px;display:flex;flex-direction:column;gap:8px;max-height:160px;overflow:auto;}
.item{display:flex;justify-content:space-between;align-items:center;padding:8px 12px;border-radius:10px;background:linear-gradient(90deg, rgba(99,102,241,0.04), rgba(99,102,241,0.01));font-size:14px;}
.chart-wrap{width:100%;height:260px;}
</style>
</head>
<body>
<div class="wrap">
  <!-- LEFT column -->
  <div class="left-col">
    <!-- 1. Thông tin cá nhân -->
    <div class="card">
      <h2>Thông tin cá nhân</h2>
      <p class="small">Thông tin cơ bản & BMI</p>
      <div style="display:flex;gap:14px;align-items:center;margin-top:12px;">
        <div style="width:84px;height:84px;border-radius:16px;background:linear-gradient(135deg,#eef2ff,#eef7ff);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--accent);font-size:26px;">
          {{ substr($account->full_name,0,1) }}
        </div>
        <div>
          <div style="font-weight:700;font-size:16px;">{{ $account->fullname }}</div>
          <div class="small">{{ $age }} tuổi · {{ $account->weight }} kg · {{ $account->height }} cm</div>
          <div style="margin-top:8px;">
            <div style="font-size:13px;color:var(--muted)">BMI</div>
            <div style="font-weight:700">{{ $account->bmi }}</div>
          </div>
        </div>
      </div>
    </div>

    <!-- 2. Tiến độ mục tiêu -->
    <div class="card">
      <h2>Tiến độ mục tiêu</h2>
      <p class="small">{{ $goal_type }} - Mục tiêu {{ $target_weight }} kg</p>
      <div style="margin-top:12px;">
        <div style="height:12px;background:#eef2ff;border-radius:999px;overflow:hidden;">
          <div id="goal-bar" style="height:100%;width:0%;background:linear-gradient(90deg,#6366f1,#06b6d4);transition:width .6s;"></div>
        </div>
        <p style="margin-top:6px;">Hiện tại: {{ $account->weight }} kg</p>
      </div>
    </div>
  </div>

  <!-- RIGHT column -->
  <div class="right-col">
    <div class="tall-card card">
      <!-- Nhập bài tập -->
      <div class="split">
        <h2>Bài tập hôm nay</h2>
        <div class="exercise-top">
          <div class="exercise-form">
            <select id="exercise-select">
              <option value="">-- Chọn bài tập --</option>
              @foreach($exercises as $ex)
                <option value="{{ $ex->calories_burned }}">{{ $ex->name_workout }} ({{ $ex->calories_burned }} kcal)</option>
              @endforeach
            </select>
            <div style="margin-top:10px;">
              <button class="btn" id="add-ex">Thêm</button>
              <button class="btn red" id="reset-ex">Xóa tất cả</button>
            </div>
            <div style="margin-top:12px;color:var(--muted);font-size:14px;">
              <div>Tổng calo hôm nay: <strong id="total-cal">0</strong> kcal</div>
              <div style="margin-top:6px">Mục tiêu calo: <strong id="goal-cal">{{ $goal_calories }}</strong> kcal</div>
            </div>
            <div class="list" id="exercise-list"></div>
          </div>
          <div class="chart-wrap" style="flex:0 0 300px;">
            <canvas id="pieChart"></canvas>
          </div>
        </div>
      </div>

      <!-- Biểu đồ tuần -->
      <div class="split" style="flex:1;">
        <h2>Calo tuần</h2>
        <div class="chart-wrap">
          <canvas id="weekChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
let totalCal = 0;
let exercisesToday = [];

const pieChart = new Chart(document.getElementById('pieChart').getContext('2d'), {
  type:'doughnut',
  data:{labels:[],datasets:[{data:[],backgroundColor:['#6366f1','#06b6d4','#f97316','#ef4444','#a78bfa','#60a5fa']}]},
  options:{cutout:'70%',plugins:{legend:{display:false}}}
});

const weekChart = new Chart(document.getElementById('weekChart').getContext('2d'),{
  type:'line',
  data:{labels:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],datasets:[{label:'Calo (kcal)',data:[0,0,0,0,0,0,0],borderColor:'#6366f1',fill:true,backgroundColor:'rgba(99,102,241,0.2)',tension:0.4} ] },
  options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}}}
});

function updateUI(){
  document.getElementById('total-cal').innerText = totalCal;
  document.getElementById('goal-bar').style.width = Math.min(100,(totalCal/{{ $goal_calories }})*100)+'%';

  // update pie
  pieChart.data.labels = exercisesToday.map(e=>e.name);
  pieChart.data.datasets[0].data = exercisesToday.map(e=>e.cal);
  pieChart.update();

  // update list
  const list = document.getElementById('exercise-list');
  list.innerHTML = '';
  exercisesToday.forEach(e=>{
    const div = document.createElement('div');
    div.className = 'item';
    div.innerHTML = `<div>${e.name}</div><div>${e.cal} kcal</div>`;
    list.appendChild(div);
  });
}

document.getElementById('add-ex').addEventListener('click',()=>{
  const select = document.getElementById('exercise-select');
  const name = select.options[select.selectedIndex].text;
  const cal = Number(select.value);
  if(!cal) return alert('Chọn bài tập hợp lệ');
  exercisesToday.push({name,cal});
  totalCal += cal;
  updateUI();
});

document.getElementById('reset-ex').addEventListener('click',()=>{
  if(!confirm('Xóa tất cả bài tập hôm nay?')) return;
  exercisesToday = [];
  totalCal = 0;
  updateUI();
});
</script>
</body>
</html>
@endsection
