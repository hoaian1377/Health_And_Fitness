<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>Home</title>
</head>
<body>
    <div class="nav_hero">
        <a href="{{ route('home.page') }}">Trang Chủ</a>
        <a href="{{ route('health.page') }}">Sức Khỏe</a>
        <a href="{{ route('fitness.page') }}">Fitness</a>
        <a href="{{ route('profile.page') }}">Người Dùng</a>
    </div>
</body>
</html>