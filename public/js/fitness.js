
/* Merged JS: animations, tab filter, slider, menu toggle
   This single file replaces separate slider.js and workout-filter.js
*/
(function(){
    'use strict';

    // Menu toggle (if present)
    function initMenuToggle() {
        const menuToggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');
        if (!menuToggle || !menu) return;
        menuToggle.addEventListener('click', function() {
            menu.classList.toggle('active');
            menuToggle.classList.toggle('active');
        });
    }

    // IntersectionObserver for workout-card reveal
    function initCardObserver() {
        const cards = document.querySelectorAll('.workout-card');
        if (!cards.length) return;
        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
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

    // Tabs / workout filter (scoped per tabs-container -> its adjacent .workout-grid)
    function initWorkoutFilter() {
        const containers = document.querySelectorAll('.tabs-container');
        if (!containers.length) return;

        containers.forEach(container => {
            const tabs = Array.from(container.querySelectorAll('.tab[data-category]'));

            // find the nearest .workout-grid after this container
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
                    // only remove active within this container
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    showCategory(this.dataset.category || 'all');
                });
            });

            // initialize this container (use its active tab or show all)
            const active = container.querySelector('.tab.active[data-category]');
            showCategory(active ? active.dataset.category : 'all');
        });
    }

    // Slider
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

    // Search: lọc các workout-card theo tiêu đề và ưu tiên các badge 'MỚI' lên đầu
    function initSearch() {
        const input = document.getElementById('exercise-search');
        const clearBtn = document.getElementById('search-clear');
        if (!input) return;

        // lấy tất cả các card trên trang
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

            // filter
            let matched = allCards.filter(card => {
                if (!q) return true; // khi rỗng thì hiện tất cả
                const title = normalize(card.querySelector('.workout-card-title')?.textContent);
                const meta = normalize(card.querySelector('.workout-card-meta')?.textContent);
                return title.includes(q) || meta.includes(q);
            });

            // sắp xếp: các thẻ mới (isNew) lên trước
            matched.sort((a, b) => {
                const na = isNew(a) ? 0 : 1;
                const nb = isNew(b) ? 0 : 1;
                return na - nb;
            });

            // hide all, then append matched in order (trick: set display)
            allCards.forEach(card => card.style.display = 'none');
            matched.forEach(card => card.style.display = '');
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

    // Initialize all
    function initAll() {
        initMenuToggle();
        initCardObserver();
        initWorkoutFilter();
        initSearch();
        initSlider();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

})();