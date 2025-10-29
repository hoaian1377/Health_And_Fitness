
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

    // Tabs / workout filter
    function initWorkoutFilter() {
        const tabs = document.querySelectorAll('.tabs-container .tab[data-category]');
        const grids = document.querySelectorAll('.workout-grid');
        if (!tabs.length || !grids.length) return;

        const allCards = [];
        grids.forEach(grid => grid.querySelectorAll('.workout-card').forEach(c => allCards.push(c)));

        function showCategory(category) {
            allCards.forEach(card => {
                const cat = card.dataset.category || 'all';
                if (category === 'all' || category === cat) {
                    card.style.display = '';
                    // fade in
                    requestAnimationFrame(() => { card.style.opacity = '0';
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

        // Init to active or all
        const active = document.querySelector('.tabs-container .tab.active[data-category]');
        showCategory(active ? active.dataset.category : 'all');
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

    // Initialize all
    function initAll() {
        initMenuToggle();
        initCardObserver();
        initWorkoutFilter();
        initSlider();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAll);
    } else {
        initAll();
    }

})();
(function(){
    // Safe init
    function initWorkoutFilter() {
        const tabs = document.querySelectorAll('.tabs-container .tab[data-category]');
        const grids = document.querySelectorAll('.workout-grid');

        if (!tabs.length || !grids.length) return;

        // Gather all cards from all grids
        const allCards = [];
        grids.forEach(grid => {
            grid.querySelectorAll('.workout-card').forEach(card => allCards.push(card));
        });

        function showCategory(category) {
            allCards.forEach(card => {
                // default category value
                const cat = card.dataset.category || 'all';
                if (category === 'all' || category === cat) {
                    card.style.display = '';
                    // small transition
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
                // remove active from all
                tabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const cat = this.dataset.category || 'all';
                showCategory(cat);
            });
        });

        // Initialize (show all)
        const active = document.querySelector('.tabs-container .tab.active[data-category]');
        if (active) {
            showCategory(active.dataset.category || 'all');
        } else {
            showCategory('all');
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initWorkoutFilter);
    } else {
        initWorkoutFilter();
    }
})();