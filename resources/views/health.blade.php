@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sức Khỏe - Health & Fitness App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/health.css') }}">
</head>
<body>
    <div class="container">
    <header>
        <h1><i class="fa-solid fa-heart-pulse"></i> SỨC KHỎE CỦA BẠN</h1>
    </header>

    <main>
        <!-- Chỉ số sức khỏe động -->
        <section class="health-metrics">
            <div class="metric">
                <i class="fa-solid fa-heart"></i>
                <h3>Nhịp Tim</h3>
                <p id="heart-rate">-- bpm</p>
            </div>
            <div class="metric">
                <i class="fa-solid fa-shoe-prints"></i>
                <h3>Bước Chân</h3>
                <p id="steps">-- bước</p>
            </div>
            <div class="metric">
                <i class="fa-solid fa-bed"></i>
                <h3>Giờ Ngủ</h3>
                <p id="sleep-hours">-- giờ</p>
            </div>
        </section>

        <!-- Nhập chỉ số cơ thể -->
        <section class="body-metrics">
            <h2><i class="fa-solid fa-scale-balanced"></i> Nhập Chỉ Số Cơ Thể</h2>
            <form id="bodyMetricsForm">
                <div class="form-group">
                    <label for="height">Chiều cao (cm)</label>
                    <input type="number" id="height" placeholder="Nhập chiều cao" required>
                </div>
                <div class="form-group">
                    <label for="weight">Cân nặng (kg)</label>
                    <input type="number" id="weight" placeholder="Nhập cân nặng" required>
                </div>
                <div class="form-group">
                    <label for="goal">Mục tiêu</label>
                    <select id="goal">
                        <option value="weight_loss">Giảm Cân</option>
                        <option value="muscle_gain">Tăng Cơ</option>
                        <option value="fat_loss">Giảm Béo</option>
                    </select>
                </div>
                <button type="submit">Tính BMI</button>
            </form>

            <section class="bmi-display">
  <h2>Kết Quả</h2>
  <p id="bmi-result">--</p>
  <div id="recommendation-content"></div>

  <div id="exercise-button" style="display:none; margin-top:15px;">
    <a href="{{ route('fitness.page') }}" class="btn-primary">Xem Bài Tập</a>
  </div>
</section>
        </section>
    </main>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/health.js') }}"></script>
@endsection