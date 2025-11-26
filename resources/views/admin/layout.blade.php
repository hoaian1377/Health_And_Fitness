<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HealthFit</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 20px;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ecf0f1;
        }
        .sidebar a {
            display: block;
            padding: 15px;
            color: #bdc3c7;
            text-decoration: none;
            transition: 0.3s;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #34495e;
            color: white;
            border-left: 4px solid #3498db;
        }
        .main-content {
            flex: 1;
            padding: 30px;
            background: #f4f6f9;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .btn-primary {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa-solid fa-gauge"></i> Dashboard
        </a>
        <a href="{{ route('admin.exercises') }}" class="{{ request()->routeIs('admin.exercises') ? 'active' : '' }}">
            <i class="fa-solid fa-dumbbell"></i> Bài tập
        </a>
        <a href="{{ route('admin.nutrition') }}" class="{{ request()->routeIs('admin.nutrition') ? 'active' : '' }}">
            <i class="fa-solid fa-utensils"></i> Dinh dưỡng
        </a>
        <a href="{{ route('admin.plans') }}" class="{{ request()->routeIs('admin.plans') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i> Gói tập
        </a>
        <a href="{{ route('admin.vouchers') }}" class="{{ request()->routeIs('admin.vouchers') ? 'active' : '' }}">
            <i class="fa-solid fa-ticket"></i> Mã giảm giá
        </a>
        <a href="{{ route('admin.chatbot') }}" class="{{ request()->routeIs('admin.chatbot') ? 'active' : '' }}">
            <i class="fa-solid fa-robot"></i> Chatbot
        </a>
        <a href="{{ route('home.page') }}">
            <i class="fa-solid fa-arrow-left"></i> Về trang chủ
        </a>
    </div>

    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
