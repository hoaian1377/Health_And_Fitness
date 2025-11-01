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

})();

