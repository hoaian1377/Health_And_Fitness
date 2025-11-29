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
    <style>
        /* ================= NAVBAR ================= */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: #000;
  color: #fff;
  padding: 12px 40px;
  position: sticky;
  top: 0;
  z-index: 100;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.25);
}

/* ================= LOGO ================= */
.logo {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 22px;
  font-weight: 700;
  color: #fff;
  text-decoration: none;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.logo span span {
  color: #ffea00;
}

.logo img {
  width: 40px;
  height: 40px;
  object-fit: contain;
  transition: transform 0.3s ease;
}

.logo:hover {
  opacity: 0.9;
  transform: scale(1.03);
}

/* Plan Badge */
.plan-badge {
  display: none;
  background: #ffea00;
  color: #111;
  padding: 4px 8px;
  border-radius: 8px;
  font-weight: 800;
  font-size: 12px;
  line-height: 1;
}
.logo .plan-badge { margin-left: 10px; }
.plan-badge.show { display: inline-block; }

/* ================= MENU ================= */
.menu {
  display: flex;
  align-items: center;
  gap: 28px;
}

.menu a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
  padding: 6px 0;
}

.menu a:hover {
  color: #ffea00;
}

/* ================= MENU TOGGLE ================= */
.menu-toggle {
  display: none;
  font-size: 30px;
  color: #fff;
  cursor: pointer;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
  .navbar {
    padding: 12px 25px;
  }

  .menu {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 70px;
    right: 0;
    width: 230px;
    background: #111;
    padding: 20px 0;
    border-radius: 10px 0 0 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.4);
  }

  .menu.show {
    display: flex;
    animation: slideIn 0.3s ease forwards;
  }

  @keyframes slideIn {
    from { opacity: 0; transform: translateX(40px); }
    to   { opacity: 1; transform: translateX(0); }
  }

  .menu a {
    padding: 12px 25px;
    width: 100%;
    text-align: left;
  }

  .menu a:hover {
    background: #222;
  }

  .menu-toggle {
    display: block;
  }

  .user-menu,
  .auth-buttons {
    flex-direction: column;
    align-items: flex-start;
    padding: 10px 25px;
    gap: 12px;
  }
}

/* ================= FOOTER ================= */
footer {
  text-align: center;
  background: #000;
  color: #fff;
  padding: 25px 10px;
  font-size: 0.95rem;
}

/* ================= RESPONSIVE CONTENT ================= */
@media (max-width: 992px) {
  .slide-text h1 { font-size: 2.2rem; }
  .slide-text p { font-size: 1rem; }

  .about-block, .about-block.reverse {
    flex-direction: column;
    text-align: center;
  }

  .about-text h2 {
    font-size: 1.6rem;
  }

  .about-image img {
    max-width: 320px;
  }
}

@media (max-width: 600px) {
  .slideshow-section { height: 60vh; }
  .slide-text h1 { font-size: 1.8rem; }
  .about-section { padding: 60px 5%; }
}

/* ================= USER DROPDOWN ================= */
.user-dropdown {
    position: relative;
}

.user-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    padding: 6px 12px;
    border-radius: 8px;
    transition: background 0.2s ease;
}

.user-trigger:hover {
    background: #222;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.user-trigger .arrow {
    transition: transform 0.2s ease;
}

.user-dropdown.open .arrow {
    transform: rotate(-180deg);
}

.dropdown-menu {
    position: absolute;
    top: 110%;
    right: 0;
    background: #111;
    padding: 12px 0;
    border-radius: 10px;
    width: 200px;
    display: none;
    box-shadow: 0 6px 20px rgba(0,0,0,0.35);
    z-index: 999;
}

.user-dropdown.open .dropdown-menu {
    display: block;
}

.dropdown-menu a,
.dropdown-menu button {
    width: 100%;
    display: block;
    padding: 10px 18px;
    color: #fff;
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 15px;
}

.dropdown-menu a:hover,
.dropdown-menu button:hover {
    background: #222;
}

.dropdown-menu i {
    margin-right: 10px;
}

/* ================= BUTTON: MUA GÓI ================= */
.btn-pay {
    background: #ff3b30;
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: 700;
    color: #000000 !important;
    transition: 0.3s ease;
}

.btn-pay:hover {
    background: #d63027;
    transform: translateY(-2px);
}

/* ================= AUTH BUTTONS ================= */
.btn-auth,
.auth-buttons a {
    background: #f1d30d;
    color: #000000 !important;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    display: inline-block;
    text-align: center;
    transition: 0.3s ease;
    border: 1px solid #444;
}

.btn-auth:hover,
.auth-buttons a:hover {
    background: #d63027;
    transform: translateY(-2px);
}

/* Nút đăng xuất trong dropdown */
.dropdown-menu button.btn-auth {
    width: 100%;
    background: none;
    border-radius: 0;
    border: none;
    padding: 10px 18px;
    text-align: left;
}

.dropdown-menu button.btn-auth:hover {
    background: #222;
    transform: none;
}
/* ================= SCROLL TO TOP ================= */
.scroll-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 48px;
    height: 48px;
    background: #f1d30d;
    color: #fff;
    border: none;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease;
    z-index: 1000;
}

.scroll-top.show {
    opacity: 1;
    visibility: visible;
}

.scroll-top:hover {
    background: #e2cf06;
    transform: translateY(-3px);
}
/* ==========================
     MODAL ĐỔI MẬT KHẨU
========================== */

.modal-pass {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.6);
    justify-content: center;
    align-items: center;
}

.modal-pass-content {
    width: 420px;
    background: #fff;
    padding: 25px;
    border-radius: 12px;
    animation: fadeIn 0.25s ease;
    box-shadow: 0 0 20px rgba(0,0,0,0.3);
}

.modal-pass-content h2 {
    margin-bottom: 15px;
    text-align: center;
}

.modal-pass input {
    width: 100%;
    padding: 10px;
    margin: 8px 0 14px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}

.btn-change-pass {
    width: 100%;
    padding: 12px;
    background: #2ecc71;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.btn-change-pass:hover {
    background: #27ae60;
}

.close-pass {
    float: right;
    font-size: 26px;
    cursor: pointer;
    font-weight: bold;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9);}
    to { opacity: 1; transform: scale(1);}
}

    </style>
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
                    @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-gauge"></i> Trang quản trị
                    </a>
                    @endif
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

    <!-- Chatbot Widget -->
    @include('partials.chatbot_widget')

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
