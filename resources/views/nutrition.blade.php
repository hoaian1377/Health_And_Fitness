@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dinh Dưỡng - Health & Fitness App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/nutrition.css') }}">
    <style>
        /* ================= RESET ================= */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Cấu hình cơ bản cho html và body */
html, body {
  height: auto;
  scroll-behavior: smooth;
  font-family: "Segoe UI", sans-serif;
  background: linear-gradient(135deg, #f0fdf4, #dcfce7);
  color: #222;
  overflow-x: hidden;
  overflow-y: auto;
  width: 100%;
}


/* ================= MAIN CONTENT ================= */
.app-container {
  width: 100%;
  max-width: 100%;
  margin: 0;
  padding: 0;
  background: transparent;
  min-height: calc(100vh - 70px);
  padding-top: 70px;
}

.main-content {
  padding: 30px;
  width: 100%;
  max-width: 1400px;
  margin: 0 auto;
}

/* ================= HERO BANNER ================= */
.hero-banner {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  border-radius: 24px;
  padding: 50px;
  margin-bottom: 40px;
  color: white;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  gap: 40px;
  box-shadow: 0 20px 60px rgba(16, 185, 129, 0.3);
}

.hero-banner::before {
  content: '';
  position: absolute;
  top: -100px;
  right: -100px;
  width: 400px;
  height: 400px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-20px); }
}

.hero-content {
  position: relative;
  z-index: 1;
  flex: 1 1 55%;
}

.hero-title {
  font-size: 40px;
  font-weight: 900;
  margin-bottom: 16px;
  line-height: 1.2;
  text-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.hero-subtitle {
  font-size: 18px;
  opacity: 0.95;
  margin-bottom: 28px;
  line-height: 1.6;
}

.hero-btn {
  background: white;
  color: #10b981;
  border: none;
  padding: 16px 40px;
  border-radius: 50px;
  font-weight: 700;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  margin-bottom: 24px;
}

.hero-btn:hover {
  transform: translateY(-3px) scale(1.02);
  box-shadow: 0 12px 30px rgba(0,0,0,0.25);
}

.hero-illustration {
  flex: 0 0 40%;
  text-align: right;
  position: relative;
  z-index: 1;
}

.hero-illustration img {
  max-width: 100%;
  height: auto;
  border-radius: 20px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

/* ================= SEARCH BAR (IMPROVED) ================= */
.search-bar {
  margin-top: 0;
  display: flex;
  gap: 12px;
  align-items: center;
  max-width: 600px;
  width: 100%;
  position: relative;
  background: white;
  border-radius: 50px;
  padding: 6px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
}

.search-bar:focus-within {
  box-shadow: 0 15px 40px rgba(16, 185, 129, 0.25);
  transform: translateY(-2px);
}

.search-bar .search-icon {
  position: absolute;
  left: 24px;
  top: 50%;
  transform: translateY(-50%);
  color: #10b981;
  font-size: 20px;
  pointer-events: none;
  z-index: 1;
}

#meal-search {
  flex: 1 1 auto;
  padding: 14px 24px 14px 56px;
  border-radius: 50px;
  border: none;
  font-size: 16px;
  outline: none;
  background: transparent;
  color: #222;
  font-weight: 500;
}

#meal-search::placeholder {
  color: #94a3b8;
  opacity: 1;
}

#search-clear {
  background: linear-gradient(135deg, #10b981, #059669);
  border: none;
  color: #fff;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  cursor: pointer;
  font-weight: 700;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

#search-clear i {
  font-size: 16px;
  color: #fff;
}

#search-clear:hover {
  transform: rotate(90deg) scale(1.1);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
}

/* ================= SECTION HEADER ================= */
.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}

.section-title {
  font-size: 28px;
  font-weight: 800;
  color: #1e293b;
  position: relative;
  padding-left: 20px;
}

.section-title::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 6px;
  height: 32px;
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 3px;
}

/* ================= TABS ================= */
.tabs-container {
  display: flex;
  gap: 12px;
  margin-bottom: 30px;
  overflow-x: auto;
  padding-bottom: 10px;
  scroll-behavior: smooth;
}

.tabs-container::-webkit-scrollbar {
  height: 6px;
}

.tabs-container::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 3px;
}

.tabs-container::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #10b981, #059669);
  border-radius: 3px;
}

.tab {
  padding: 14px 28px;
  border-radius: 50px;
  border: 2px solid #e2e8f0;
  background: white;
  font-size: 15px;
  font-weight: 700;
  color: #64748b;
  white-space: nowrap;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.tab:hover {
  border-color: #10b981;
  color: #10b981;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
}

.tab.active {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border-color: transparent;
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
  transform: translateY(-2px);
}

/* ================= WORKOUT GRID (MEAL GRID) ================= */
.workout-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
  margin-bottom: 50px;
}

.workout-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.4s ease;
  border: 2px solid transparent;
  box-shadow: 0 4px 20px rgba(0,0,0,0.08);
  animation: fadeIn 0.6s ease-out;
}

.workout-card.hidden {
  display: none;
}

.workout-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 50px rgba(16, 185, 129, 0.15);
  border-color: #10b981;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.workout-card-image {
  position: relative;
  width: 100%;
  height: 200px;
  overflow: hidden;
  background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}

.workout-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.workout-card:hover .workout-card-image img {
  transform: scale(1.15) rotate(2deg);
}

.workout-badge {
  position: absolute;
  top: 16px;
  right: 16px;
  background: linear-gradient(135deg, rgba(0,0,0,0.8), rgba(0,0,0,0.9));
  color: white;
  padding: 8px 16px;
  border-radius: 50px;
  font-size: 11px;
  font-weight: 700;
  backdrop-filter: blur(10px);
  text-transform: uppercase;
  letter-spacing: 0.5px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.difficulty-indicator {
  position: absolute;
  bottom: 16px;
  left: 16px;
  display: flex;
  gap: 6px;
  background: rgba(255,255,255,0.95);
  padding: 8px 12px;
  border-radius: 50px;
  backdrop-filter: blur(10px);
}

.difficulty-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: #10b981;
  box-shadow: 0 2px 6px rgba(16, 185, 129, 0.3);
}

.workout-card-content {
  padding: 24px;
}

.workout-card-title {
  font-size: 18px;
  font-weight: 800;
  color: #1e293b;
  margin-bottom: 12px;
  line-height: 1.4;
  min-height: 50px;
}

.workout-card-meta {
  display: flex;
  align-items: center;
  gap: 16px;
  font-size: 14px;
  color: #64748b;
  margin-bottom: 18px;
  font-weight: 600;
}

.workout-card-meta span {
  display: flex;
  align-items: center;
  gap: 4px;
}

.workout-card-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-top: 18px;
  border-top: 2px solid #f1f5f9;
}

.workout-level {
  font-size: 13px;
  font-weight: 700;
  padding: 8px 16px;
  border-radius: 50px;
}

.workout-level.beginner {
  background: linear-gradient(135deg, #d1fae5, #a7f3d0);
  color: #065f46;
}

.workout-level.intermediate {
  background: linear-gradient(135deg, #fef3c7, #fde68a);
  color: #92400e;
}

.workout-level.advanced {
  background: linear-gradient(135deg, #fee2e2, #fecaca);
  color: #991b1b;
}

.start-btn {
  background: linear-gradient(135deg, #10b981 0%, #059669 100%);
  color: white;
  border: none;
  padding: 10px 24px;
  border-radius: 50px;
  font-size: 14px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
  text-align: center;
  box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.start-btn:hover {
  transform: translateY(-2px) scale(1.05);
  box-shadow: 0 6px 20px rgba(16, 185, 129, 0.5);
  color: white;
}

.start-btn:active {
  transform: translateY(0) scale(1);
}

/* ================= NO RESULTS ================= */
.no-results-message {
  grid-column: 1 / -1;
  text-align: center;
  padding: 80px 20px;
  color: #64748b;
}

.no-results-message i {
  font-size: 64px;
  color: #cbd5e1;
  margin-bottom: 20px;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.5; }
}

.no-results-message h3 {
  font-size: 24px;
  color: #475569;
  margin-bottom: 10px;
  font-weight: 700;
}

.no-results-message p {
  font-size: 16px;
  color: #64748b;
}

/* ================= RESPONSIVE ================= */
@media (max-width: 992px) {
  .hero-banner {
    padding: 40px 30px;
    flex-direction: column;
    gap: 30px;
  }

  .hero-title {
    font-size: 32px;
  }

  .hero-subtitle {
    font-size: 16px;
  }

  .main-content {
    padding: 20px;
  }

  .workout-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }

  .section-title {
    font-size: 24px;
  }
}

@media (max-width: 768px) {
  .hero-banner {
    padding: 30px 20px;
  }

  .hero-title {
    font-size: 28px;
  }

  .search-bar {
    flex-direction: row;
    max-width: 100%;
  }

  #meal-search {
    font-size: 14px;
  }

  .workout-grid {
    grid-template-columns: 1fr;
  }

  .tabs-container {
    gap: 8px;
  }

  .tab {
    padding: 12px 20px;
    font-size: 14px;
  }
}

@media (max-width: 600px) {
  .hero-content .search-bar {
    padding: 4px;
  }

  #search-clear {
    width: 40px;
    height: 40px;
  }

  .workout-card-title {
    font-size: 16px;
    min-height: auto;
  }
}

/* ================= LOADING ANIMATION ================= */
.loading {
  opacity: 0.6;
  pointer-events: none;
}

.loading::after {
  content: '';
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 50px;
  height: 50px;
  border: 4px solid #f3f3f3;
  border-top: 4px solid #10b981;
  border-radius: 50%;
  animation: spin 1s linear infinite;
  z-index: 9999;
}

@keyframes spin {
  0% { transform: translate(-50%, -50%) rotate(0deg); }
  100% { transform: translate(-50%, -50%) rotate(360deg); }
}
.difficulty-indicator {
    display: none !important;
}
@media (max-width: 992px) {
  .navbar {
    padding: 12px 25px;
  }

  .menu {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 75px;
    right: 15px;
    width: 220px;
    background: #111;
    padding: 15px 0;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.3s ease;
  }

  .menu.show {
    display: flex;
    animation: slideIn 0.3s ease forwards;
  }

  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .menu a {
    padding: 10px 20px;
    width: 100%;
    text-align: left;
    border-radius: 12px;
    transition: background 0.25s;
    font-size: 15px;
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
    padding: 10px 20px;
    gap: 10px;
  }
}

    </style>
</head>
<body>
    <div class="app-container">
        <div class="main-content">
            <div class="hero-banner">
                <div class="hero-content">
                    <div class="hero-title">Khám phá chế độ dinh dưỡng<br>hoàn hảo cho bạn 🥗</div>
                    <div class="hero-subtitle">Hơn 300+ thực đơn khoa học, phù hợp mọi mục tiêu</div>
                    <button class="hero-btn">Xem thực đơn</button>
                    <div class="search-bar">
                        <i class="fa-solid fa-magnifying-glass search-icon" aria-hidden="true"></i>
                        <input id="meal-search" type="search" placeholder="Tìm món ăn..." aria-label="Tìm món ăn">
                        <button id="search-clear" type="button" title="Xóa tìm kiếm" style="display: none;">
                            <i class="fa-solid fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="hero-illustration">
                    <img src="{{ asset('images/meal19.webp') }}" alt="Nutrition illustration">
                </div>
            </div>

             <div class="section-header">
                <h2 class="section-title">Thực đơn phổ biến</h2>
                        </div>
             <div class="tabs-container">
                <button class="tab active" data-category="all">Tất cả</button>
                <button class="tab" data-category="giam-can">Giảm cân</button>
                <button class="tab" data-category="tang-co">Tăng cơ</button>
                <button class="tab" data-category="can-bang">Cân bằng</button>
                <button class="tab" data-category="giam-mo">Giảm mỡ</button>
            </div>

            <div class="workout-grid">
                @if($mealplan->isEmpty())
                    <p>Chưa có thông tin món ăn nào!!!</p>
                @else
                    @foreach($mealplan as $mp)
                        <div class="workout-card" data-category="{{ $mp->category ?? 'all' }}">
                            <div class="workout-card-image">
                                <img src="{{ $mp->urls }}" alt="{{ $mp->meal_name }}">
                                <div class="workout-badge">{{ strtoupper($mp->tag ?? 'MÓN MỚI') }}</div>
                                <div class="difficulty-indicator">
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot"></div>
                                    <div class="difficulty-dot" style="opacity: 0.3;"></div>
                                </div>
                            </div>
                            <div class="workout-card-content">
                                <h3 class="workout-card-title">{{ $mp->meal_name }}</h3>
                                <div class="workout-card-meta">
                                    <span>⏱ {{ $mp->time ?? 'N/A' }}</span>
                                    <span>🔥 {{ $mp->calories ?? '---' }} calo</span>
                                    <span>⭐ {{ $mp->rating ?? '4.5' }}</span>
                                </div>
                                <div class="workout-card-footer">
                                    <div class="workout-level beginner">{{ $mp->difficulty ?? 'Dễ làm' }}</div>
                                    <a href="{{ route('meal-detail', ['id'=>$mp->meal_planID]) }}" class="start-btn">Xem công thức</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    

    <script>
        /* Merged JS: animations, tab filter, slider, menu toggle
   This single file replaces separate slider.js and workout-filter.js
*/
(function(){
    'use strict';

    // ================= MOBILE MENU TOGGLE (CẢI TIẾN) =================
    function initMenuToggle() {
        console.log('🔄 Initializing menu toggle...');
        
        const navbar = document.querySelector('.navbar');
        if (!navbar) {
            console.warn('⚠️ Navbar not found');
            return;
        }

        // Tạo overlay nếu chưa có
        let overlay = document.querySelector('.menu-overlay');
        if (!overlay) {
            overlay = document.createElement('div');
            overlay.className = 'menu-overlay';
            document.body.appendChild(overlay);
            console.log('✅ Overlay created');
        }

        // Tạo hoặc lấy menu toggle button
        let menuToggle = document.querySelector('.menu-toggle');
        if (!menuToggle) {
            // Thử tìm theo ID (backward compatibility)
            menuToggle = document.getElementById('menu-toggle');
        }
        
        if (!menuToggle) {
            // Tạo mới nếu không có
            menuToggle = document.createElement('button');
            menuToggle.className = 'menu-toggle';
            menuToggle.setAttribute('aria-label', 'Menu');
            menuToggle.innerHTML = `
                <span></span>
                <span></span>
                <span></span>
            `;
            navbar.appendChild(menuToggle);
            console.log('✅ Menu toggle button created');
        }

        // Lấy menu
        let menu = document.querySelector('.menu');
        if (!menu) {
            menu = document.getElementById('menu');
        }
        
        if (!menu) {
            console.error('❌ Menu element not found!');
            return;
        }

        console.log('✅ Menu toggle initialized');

        // Toggle menu khi click
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isActive = menu.classList.contains('active') || menu.classList.contains('show');
            console.log(isActive ? '🔽 Closing menu...' : '🔼 Opening menu...');
            
            menuToggle.classList.toggle('active');
            menu.classList.toggle('active');
            menu.classList.toggle('show');
            overlay.classList.toggle('active');
        });

        // Click overlay để đóng
        overlay.addEventListener('click', function() {
            console.log('✖️ Menu closed (overlay)');
            closeMenu();
        });

        // Click link trong menu
        const menuLinks = menu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 992) {
                    setTimeout(() => {
                        console.log('✖️ Menu closed (link)');
                        closeMenu();
                    }, 150);
                }
            });
        });

        // Resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 992 && menu.classList.contains('active')) {
                console.log('✖️ Menu closed (resize)');
                closeMenu();
            }
        });

        // ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && menu.classList.contains('active')) {
                console.log('✖️ Menu closed (ESC)');
                closeMenu();
            }
        });

        function closeMenu() {
            menuToggle.classList.remove('active');
            menu.classList.remove('active');
            menu.classList.remove('show');
            overlay.classList.remove('active');
        }
    }

    // ================= INTERSECTION OBSERVER FOR CARDS =================
    function initCardObserver() {
        const cards = document.querySelectorAll('.workout-card');
        if (!cards.length) return;
        
        const observerOptions = { 
            threshold: 0.1, 
            rootMargin: '0px 0px -50px 0px' 
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        cards.forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });
    }

    // ================= WORKOUT FILTER (TABS) =================
    function initWorkoutFilter() {
        const containers = document.querySelectorAll('.tabs-container');
        if (!containers.length) return;

        containers.forEach(container => {
            const tabs = Array.from(container.querySelectorAll('.tab[data-category]'));

            // Find the nearest .workout-grid after this container
            let grid = container.nextElementSibling;
            while (grid && !grid.classList.contains('workout-grid')) {
                grid = grid.nextElementSibling;
            }
            if (!grid) return;

            const cards = Array.from(grid.querySelectorAll('.workout-card'));

            function showCategory(category) {
                cards.forEach(card => {
                    const cat = card.dataset.category || 'all';
                    if (category === 'all' || category === cat) {
                        card.style.display = '';
                        requestAnimationFrame(() => {
                            card.style.opacity = '0';
                            requestAnimationFrame(() => card.style.opacity = '1');
                        });
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    showCategory(this.dataset.category || 'all');
                });
            });

            // Initialize
            const active = container.querySelector('.tab.active[data-category]');
            showCategory(active ? active.dataset.category : 'all');
        });
    }

    // ================= SLIDER =================
    function initSlider() {
        const slidesWrap = document.querySelector('.slides');
        const slides = document.querySelectorAll('.slide');
        const prev = document.querySelector('.prev-arrow');
        const next = document.querySelector('.next-arrow');
        const dots = document.querySelectorAll('.dot');
        if (!slidesWrap || slides.length === 0) return;

        let index = 0;
        const total = slides.length;

        function goTo(i) {
            index = (i + total) % total;
            const offset = -index * 100;
            slidesWrap.style.transform = `translateX(${offset}%)`;
            dots && dots.forEach(d => d.classList.remove('active'));
            if (dots && dots[index]) dots[index].classList.add('active');
        }

        if (prev) prev.addEventListener('click', () => goTo(index-1));
        if (next) next.addEventListener('click', () => goTo(index+1));
        if (dots) dots.forEach((d,i) => d.addEventListener('click', () => goTo(i)));

        slidesWrap.style.width = (100 * total) + '%';
        slides.forEach(slide => slide.style.width = (100/total) + '%');

        let timer = setInterval(() => goTo(index+1), 5000);
        const slider = document.querySelector('.slider');
        if (slider) {
            slider.addEventListener('mouseenter', () => clearInterval(timer));
            slider.addEventListener('mouseleave', () => timer = setInterval(() => goTo(index+1), 5000));
        }

        goTo(0);
    }

    // ================= SEARCH FUNCTION =================
    function initSearch() {
        const input = document.getElementById('exercise-search') || document.getElementById('meal-search');
        const clearBtn = document.getElementById('search-clear');
        if (!input) return;

        const allCards = Array.from(document.querySelectorAll('.workout-card'));

        function normalize(s) {
            return (s || '').toLowerCase().trim();
        }

        function isNew(card) {
            const badge = card.querySelector('.workout-badge');
            return badge && /mới|moi|new/i.test(badge.textContent);
        }

        function applyFilter() {
            const q = normalize(input.value);

            // Show/hide clear button
            if (clearBtn) {
                clearBtn.style.display = q ? 'flex' : 'none';
            }

            let matched = allCards.filter(card => {
                if (!q) return true;
                const title = normalize(card.querySelector('.workout-card-title')?.textContent);
                const badge = normalize(card.querySelector('.workout-badge')?.textContent);
                const meta = normalize(card.querySelector('.workout-card-meta')?.textContent);
                return title.includes(q) || badge.includes(q) || meta.includes(q);
            });

            // Sort: New items first
            matched.sort((a, b) => {
                const na = isNew(a) ? 0 : 1;
                const nb = isNew(b) ? 0 : 1;
                return na - nb;
            });

            // Hide all, then show matched
            allCards.forEach(card => card.style.display = 'none');
            matched.forEach(card => card.style.display = '');

            // Show no results message if needed
            if (matched.length === 0) {
                showNoResults();
            } else {
                hideNoResults();
            }
        }

        function showNoResults() {
            let noResultsMsg = document.querySelector('.no-results-message');
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.className = 'no-results-message';
                noResultsMsg.style.gridColumn = '1 / -1';
                noResultsMsg.style.textAlign = 'center';
                noResultsMsg.style.padding = '60px 20px';
                noResultsMsg.style.color = '#6c757d';
                noResultsMsg.innerHTML = `
                    <i class="fa-solid fa-search" style="font-size: 48px; color: #dee2e6; margin-bottom: 15px;"></i>
                    <h3 style="font-size: 20px; color: #495057; margin-bottom: 8px;">Không tìm thấy kết quả</h3>
                    <p style="font-size: 14px;">Thử tìm kiếm với từ khóa khác</p>
                `;
                const grid = document.querySelector('.workout-grid');
                if (grid) grid.appendChild(noResultsMsg);
            }
            noResultsMsg.style.display = 'block';
        }

        function hideNoResults() {
            const noResultsMsg = document.querySelector('.no-results-message');
            if (noResultsMsg) {
                noResultsMsg.style.display = 'none';
            }
        }

        input.addEventListener('input', applyFilter);
        
        if (clearBtn) {
            clearBtn.addEventListener('click', function() {
                input.value = '';
                input.dispatchEvent(new Event('input'));
                input.focus();
            });
        }
    }

    // ================= HERO BUTTON SCROLL =================
    function initHeroButton() {
        const heroBtn = document.querySelector('.hero-btn');
        if (heroBtn) {
            heroBtn.addEventListener('click', function() {
                const grid = document.querySelector('.workout-grid');
                if (grid) {
                    const offset = grid.getBoundingClientRect().top + window.pageYOffset - 80;
                    window.scrollTo({
                        top: offset,
                        behavior: 'smooth'
                    });
                }
            });
        }
    }

    // ================= SMOOTH SCROLL =================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#' || href === '#!') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    const offset = target.getBoundingClientRect().top + window.pageYOffset - 80;
                    window.scrollTo({
                        top: offset,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // ================= INITIALIZE ALL =================
    function initAll() {
        console.log('🚀 Initializing all features...');
        initMenuToggle();
        initCardObserver();
        initWorkoutFilter();
        initSearch();
        initSlider();
        initHeroButton();
        initSmoothScroll();
        console.log('✅ All features initialized!');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }
// Khi click ra ngoài menu thì đóng lại (hoạt động với .active / .show)
document.addEventListener('click', function (e) {
  const menu = document.querySelector('.menu');
  const menuToggle = document.querySelector('.menu-toggle') || document.getElementById('menu-toggle');
  const overlay = document.querySelector('.menu-overlay');

  // Nếu chưa có menu thì bỏ qua
  if (!menu || !menuToggle) return;

  const isMenuOpen = menu.classList.contains('active') || menu.classList.contains('show');

  // Nếu click ra ngoài cả menu và nút toggle
  if (isMenuOpen && !menu.contains(e.target) && !menuToggle.contains(e.target)) {
    menu.classList.remove('active', 'show');
    menuToggle.classList.remove('active');
    if (overlay) overlay.classList.remove('active');
    console.log('✖️ Menu closed (click outside)');
  }
});

})();


    </script>
</body>
</html>
@endsection
