<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    @stack('styles')

    <title>HealthFit</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <!-- Logo -->
        <a href="{{ route('home.page') }}" class="logo">
            <img src="https://cdn-icons-png.flaticon.com/512/2966/2966486.png" alt="Logo">
            <span>Health<span>Fit</span></span>
            <span class="plan-badge" id="planBadge"></span>
        </a>

        <!-- Mobile Toggle -->
        <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>

        <!-- Menu -->
        <div class="menu" id="menu">
            <a href="{{ route('home.page') }}">Trang Chủ</a>
            <a href="{{ route('health.page') }}">Sức Khỏe</a>
            <a href="{{ route('workouts.page') }}">Tập Luyện</a>
            <a href="{{ route('nutrition.page') }}">Dinh Dưỡng</a>
            <a href="{{ route('community.page') }}">Cộng Đồng</a>

            <a href="#" class="btn-pay" id="openPaymentBtn">
                <i class="fa-solid fa-bolt"></i> Mua gói
            </a>

            @auth
            <div class="user-dropdown">
                <div class="user-trigger" id="userMenuToggle">
                    @if(Auth::user()->account && Auth::user()->account->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->account->avatar) }}" class="user-avatar">
                    @else
                        <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="user-avatar">
                    @endif

                    <span>{{ Auth::user()->account->fullname ?? Auth::user()->name }}</span>
                    <i class="fa-solid fa-chevron-down arrow"></i>
                </div>

                <div class="dropdown-menu" id="userDropdown">
                    <a href="{{ route('profile.page') }}">
                        <i class="fa-solid fa-user"></i> Thông tin cá nhân
                    </a>

                    <a href="{{ route('password.change') }}">
                        <i class="fa-solid fa-lock"></i> Đổi mật khẩu
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
            @else
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="btn-auth">Đăng nhập</a>
                <a href="{{ route('register') }}" class="btn-auth">Đăng ký</a>
            </div>
            @endauth
        </div>
    </nav>

    <!-- CONTENT -->
    <main class="container mt-4">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <p>© 2025 Health & Fitness App — Giữ sức khỏe, sống hạnh phúc 🌿</p>
    </footer>

    <!-- Payment Modal -->
    @include('payment')

    <!-- Scroll to top button -->
    <button id="scrollTopBtn" class="scroll-top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- Scripts -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script defer src="{{ asset('js/bootstrap.js') }}"></script>
    @stack('scripts')

    <!-- Scroll top Script -->
    <script>
        const scrollBtn = document.getElementById("scrollTopBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                scrollBtn.classList.add("show");
            } else {
                scrollBtn.classList.remove("show");
            }
        });

        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>

</body>
</html>
