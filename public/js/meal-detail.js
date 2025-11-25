// ================= PORTION CALCULATOR =================
let currentPortion = 2;
const baseAmounts = {};

// Lưu số lượng nguyên liệu gốc
document.addEventListener('DOMContentLoaded', function() {
    const ingredientAmounts = document.querySelectorAll('.ingredient-amount');
    ingredientAmounts.forEach((el, index) => {
        baseAmounts[index] = el.textContent;
    });
});

// Tăng khẩu phần
document.getElementById('increase')?.addEventListener('click', function() {
    currentPortion++;
    updatePortion();
});

// Giảm khẩu phần
document.getElementById('decrease')?.addEventListener('click', function() {
    if (currentPortion > 1) {
        currentPortion--;
        updatePortion();
    }
});

// Cập nhật số lượng nguyên liệu theo khẩu phần
function updatePortion() {
    document.getElementById('portion').textContent = currentPortion;
    
    const ingredientAmounts = document.querySelectorAll('.ingredient-amount');
    ingredientAmounts.forEach((el, index) => {
        const baseAmount = baseAmounts[index];
        const newAmount = calculateNewAmount(baseAmount, currentPortion);
        el.textContent = newAmount;
    });
}

// Tính toán số lượng mới
function calculateNewAmount(baseAmount, portion) {
    const ratio = portion / 2; // 2 là khẩu phần gốc
    
    // Kiểm tra nếu có số
    const numberMatch = baseAmount.match(/(\d+\.?\d*)/);
    if (numberMatch) {
        const number = parseFloat(numberMatch[1]);
        const newNumber = (number * ratio).toFixed(1);
        return baseAmount.replace(numberMatch[1], newNumber);
    }
    
    return baseAmount;
}

// ================= INGREDIENT CHECKBOX =================
const ingredientCheckboxes = document.querySelectorAll('.ingredients-list input[type="checkbox"]');

ingredientCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const label = this.nextElementSibling;
        if (this.checked) {
            label.style.opacity = '0.5';
            label.style.textDecoration = 'line-through';
        } else {
            label.style.opacity = '1';
            label.style.textDecoration = 'none';
        }
    });
});

// ================= SMOOTH SCROLL =================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ================= SAVE RECIPE =================
const saveBtn = document.querySelector('.btn-primary');
if (saveBtn) {
    saveBtn.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('fa-bookmark')) {
            icon.classList.remove('fa-bookmark');
            icon.classList.add('fa-solid', 'fa-check');
            this.innerHTML = '<i class="fa-solid fa-check"></i> Đã lưu';
            this.style.background = 'linear-gradient(135deg, #059669, #047857)';
            
            // Hiển thị thông báo
            showNotification('Đã lưu công thức vào danh sách yêu thích!');
        } else {
            icon.classList.remove('fa-check');
            icon.classList.add('fa-bookmark');
            this.innerHTML = '<i class="fa-solid fa-bookmark"></i> Lưu công thức';
            this.style.background = 'linear-gradient(135deg, #10b981, #059669)';
            
            showNotification('Đã bỏ lưu công thức!');
        }
    });
}

// ================= SHARE RECIPE =================
const shareBtn = document.querySelectorAll('.btn-secondary')[0];
if (shareBtn) {
    shareBtn.addEventListener('click', function() {
        if (navigator.share) {
            navigator.share({
                title: 'Salad Ức Gà Giảm Cân',
                text: 'Món salad ức gà giàu protein, ít calo, hoàn hảo cho bữa trưa lành mạnh.',
                url: window.location.href
            }).catch(err => console.log('Error sharing:', err));
        } else {
            // Fallback: Copy link
            navigator.clipboard.writeText(window.location.href);
            showNotification('Đã copy link công thức!');
        }
    });
}

// ================= PRINT RECIPE =================
const printBtn = document.querySelectorAll('.btn-secondary')[1];
if (printBtn) {
    printBtn.addEventListener('click', function() {
        window.print();
    });
}

// ================= VIEW GALLERY =================
const viewGalleryBtn = document.querySelector('.view-gallery-btn');
if (viewGalleryBtn) {
    viewGalleryBtn.addEventListener('click', function() {
        showNotification('Chức năng xem thư viện ảnh đang được phát triển!');
    });
}

// ================= VIDEO PLACEHOLDER =================
const videoPlaceholder = document.querySelector('.video-placeholder');
if (videoPlaceholder) {
    videoPlaceholder.addEventListener('click', function() {
        showNotification('Video hướng dẫn đang được cập nhật!');
    });
}

// ================= WRITE REVIEW =================
const writeReviewBtn = document.querySelector('.btn-write-review');
if (writeReviewBtn) {
    writeReviewBtn.addEventListener('click', function() {
        showNotification('Chức năng viết đánh giá đang được phát triển!');
    });
}

// ================= REVIEW ACTIONS =================
const reviewActionBtns = document.querySelectorAll('.review-actions button');
reviewActionBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const action = this.innerHTML.includes('Hữu ích') ? 'like' : 'reply';
        if (action === 'like') {
            const currentCount = parseInt(this.textContent.match(/\d+/)[0]);
            this.innerHTML = `<i class="fa-solid fa-thumbs-up"></i> Hữu ích (${currentCount + 1})`;
            this.style.color = '#10b981';
            showNotification('Cảm ơn bạn đã đánh giá hữu ích!');
        } else {
            showNotification('Chức năng trả lời đang được phát triển!');
        }
    });
});

// ================= LOAD MORE REVIEWS =================
const loadMoreBtn = document.querySelector('.btn-load-more');
if (loadMoreBtn) {
    loadMoreBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang tải...';
        
        // Giả lập tải thêm
        setTimeout(() => {
            this.innerHTML = 'Xem thêm đánh giá';
            showNotification('Đã tải thêm đánh giá!');
        }, 1000);
    });
}

// ================= RELATED MEAL CLICK =================
const relatedCards = document.querySelectorAll('.related-card');
relatedCards.forEach(card => {
    card.addEventListener('click', function() {
        // Giả lập chuyển trang
        const mealName = this.querySelector('h4').textContent;
        showNotification(`Đang chuyển đến: ${mealName}`);
        
        // Trong thực tế, bạn sẽ redirect đến trang chi tiết món ăn khác
        // window.location.href = `/meal/${mealId}`;
    });
});

// ================= NOTIFICATION =================
function showNotification(message) {
    // Xóa notification cũ nếu có
    const oldNotification = document.querySelector('.notification');
    if (oldNotification) {
        oldNotification.remove();
    }
    
    // Tạo notification mới
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
        <i class="fa-solid fa-check-circle"></i>
        <span>${message}</span>
    `;
    
    // Thêm CSS cho notification
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 30px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 9999;
        animation: slideInRight 0.4s ease;
        font-weight: 600;
    `;
    
    document.body.appendChild(notification);
    
    // Tự động ẩn sau 3 giây
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.4s ease';
        setTimeout(() => notification.remove(), 400);
    }, 3000);
}

// Thêm animation CSS
const style = document.createElement('style');
style.innerHTML = `
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(400px);
            opacity: 0;
        }
    }
    
    .notification i {
        font-size: 20px;
    }
`;
document.head.appendChild(style);

// ================= STICKY HEADER ON SCROLL =================
let lastScroll = 0;
window.addEventListener('scroll', function() {
    const currentScroll = window.pageYOffset;
    
    // Thêm shadow cho meal header khi scroll
    const mealHeader = document.querySelector('.meal-header');
    if (currentScroll > 100) {
        mealHeader?.classList.add('scrolled');
    } else {
        mealHeader?.classList.remove('scrolled');
    }
    
    lastScroll = currentScroll;
});

// ================= LAZY LOAD IMAGES =================
const images = document.querySelectorAll('img[data-src]');
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.removeAttribute('data-src');
            observer.unobserve(img);
        }
    });
});

images.forEach(img => imageObserver.observe(img));

// ================= PRINT STYLES =================
window.addEventListener('beforeprint', function() {
    document.body.classList.add('printing');
});

window.addEventListener('afterprint', function() {
    document.body.classList.remove('printing');
});

console.log('✅ Meal Detail Page Loaded Successfully!');

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
// Meal Detail JavaScript with Review System and Delete Functionality

let selectedRating = 0;
let reviews = [];

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeStarRating();
    initializeReviewSubmit();
    loadReviews();
});

// Star Rating System
function initializeStarRating() {
    const stars = document.querySelectorAll('.star');
    const ratingValue = document.querySelector('.rating-value');
    
    if (!stars.length) return;
    
    stars.forEach((star, index) => {
        // Hover effect
        star.addEventListener('mouseenter', function() {
            highlightStars(index + 1);
        });
        
        // Click to select
        star.addEventListener('click', function() {
            selectedRating = index + 1;
            ratingValue.textContent = `${selectedRating}/5`;
            highlightStars(selectedRating);
        });
    });
    
    // Reset on mouse leave
    const starsContainer = document.querySelector('.stars');
    if (starsContainer) {
        starsContainer.addEventListener('mouseleave', function() {
            highlightStars(selectedRating);
        });
    }
}

// Highlight stars up to a certain number
function highlightStars(count) {
    const stars = document.querySelectorAll('.star');
    stars.forEach((star, index) => {
        if (index < count) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}

// Initialize Review Submit
function initializeReviewSubmit() {
    const submitBtn = document.getElementById('submitReview');
    const reviewInput = document.getElementById('reviewInput');
    
    if (!submitBtn || !reviewInput) return;
    
    submitBtn.addEventListener('click', function() {
        const reviewText = reviewInput.value.trim();
        
        // Validation
        if (selectedRating === 0) {
            showNotification('Vui lòng chọn số sao đánh giá!', 'warning');
            return;
        }
        
        if (reviewText === '') {
            showNotification('Vui lòng nhập nội dung đánh giá!', 'warning');
            return;
        }
        
        if (reviewText.length <1) {
            showNotification('Đánh giá phải có ít nhất 10 ký tự!', 'warning');
            return;
        }
        
        // Submit review
        submitReview(reviewText, selectedRating);
    });
}

// Submit Review Function
function submitReview(text, rating) {
    // Check if user is logged in
    if (!window.currentUser) {
        showNotification('Vui lòng đăng nhập để đánh giá!', 'error');
        return;
    }
    
    // Create new review object
    const newReview = {
        id: Date.now(), // Unique ID
        userId: window.currentUser.id,
        userName: window.currentUser.name,
        userEmail: window.currentUser.email,
        rating: rating,
        text: text,
        date: new Date().toISOString(),
        likes: 0
    };
    
    // Add to reviews array
    reviews.unshift(newReview);
    
    // Save to localStorage (or send to server via AJAX)
    saveReviews();
    
    // Clear form
    document.getElementById('reviewInput').value = '';
    selectedRating = 0;
    highlightStars(0);
    document.querySelector('.rating-value').textContent = '0/5';
    
    // Reload reviews display
    displayReviews();
    
    // Show success message
    showNotification('Đánh giá của bạn đã được gửi thành công!', 'success');
}

// Load Reviews from localStorage or server
function loadReviews() {
    // Try to load from localStorage first
    const savedReviews = localStorage.getItem('mealReviews');
    if (savedReviews) {
        reviews = JSON.parse(savedReviews);
    }
    
    // Display reviews
    displayReviews();
}

// Save Reviews to localStorage
function saveReviews() {
    localStorage.setItem('mealReviews', JSON.stringify(reviews));
    updateReviewStats();
}

// Display Reviews
function displayReviews() {
    const reviewsList = document.getElementById('reviewsList');
    
    if (!reviewsList) return;
    
    // Clear existing content
    reviewsList.innerHTML = '';
    
    // If no reviews
    if (reviews.length === 0) {
        reviewsList.innerHTML = `
            <div class="empty-reviews">
                <i class="fa-solid fa-comment-slash"></i>
                <p>Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
            </div>
        `;
        return;
    }
    
    // Display each review
    reviews.forEach(review => {
        const reviewElement = createReviewElement(review);
        reviewsList.appendChild(reviewElement);
    });
    
    updateReviewStats();
}

// Create Review Element
function createReviewElement(review) {
    const reviewDiv = document.createElement('div');
    reviewDiv.className = 'review-item';
    reviewDiv.dataset.reviewId = review.id;
    
    const formattedDate = formatDate(review.date);
    const stars = generateStars(review.rating);
    
    // Check if current user is the author
    const isAuthor = window.currentUser && window.currentUser.id === review.userId;
    
    reviewDiv.innerHTML = `
        <div class="review-item-header">
            <div class="review-user-info">
                <div class="review-user-avatar">
                    <i class="fa-solid fa-user-circle"></i>
                </div>
                <div class="review-user-details">
                    <h4>${escapeHtml(review.userName)}</h4>
                    <span class="review-date">${formattedDate}</span>
                </div>
            </div>
            <div class="review-rating">
                ${stars}
            </div>
        </div>
        <div class="review-content">
            ${escapeHtml(review.text)}
        </div>
        <div class="review-actions">
            <button class="review-action-btn like-btn" onclick="likeReview(${review.id})">
                <i class="fa-solid fa-thumbs-up"></i>
                <span>${review.likes || 0}</span>
            </button>
            ${isAuthor ? `
                <button class="review-action-btn delete-btn" onclick="deleteReview(${review.id})">
                    <i class="fa-solid fa-trash"></i>
                    Xóa
                </button>
            ` : ''}
        </div>
    `;
    
    return reviewDiv;
}

// Delete Review Function
function deleteReview(reviewId) {
    // Confirm deletion
    if (!confirm('Bạn có chắc chắn muốn xóa đánh giá này?')) {
        return;
    }
    
    // Find review index
    const reviewIndex = reviews.findIndex(r => r.id === reviewId);
    
    if (reviewIndex === -1) {
        showNotification('Không tìm thấy đánh giá!', 'error');
        return;
    }
    
    // Check if user is the author
    const review = reviews[reviewIndex];
    if (window.currentUser && window.currentUser.id !== review.userId) {
        showNotification('Bạn không có quyền xóa đánh giá này!', 'error');
        return;
    }
    
    // Remove from array
    reviews.splice(reviewIndex, 1);
    
    // Save changes
    saveReviews();
    
    // Reload display
    displayReviews();
    
    // Show success message
    showNotification('Đánh giá đã được xóa thành công!', 'success');
}

// Like Review Function
function likeReview(reviewId) {
    const review = reviews.find(r => r.id === reviewId);
    
    if (!review) return;
    
    // Toggle like
    review.likes = (review.likes || 0) + 1;
    
    // Save changes
    saveReviews();
    
    // Update display
    displayReviews();
}

// Generate Stars HTML
function generateStars(rating) {
    let starsHtml = '';
    for (let i = 1; i <= 5; i++) {
        starsHtml += `<span class="star ${i <= rating ? 'active' : ''}">&#9733;</span>`;
    }
    return starsHtml;
}

// Format Date
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 0) {
        return 'Hôm nay';
    } else if (diffDays === 1) {
        return 'Hôm qua';
    } else if (diffDays < 7) {
        return `${diffDays} ngày trước`;
    } else if (diffDays < 30) {
        const weeks = Math.floor(diffDays / 7);
        return `${weeks} tuần trước`;
    } else if (diffDays < 365) {
        const months = Math.floor(diffDays / 30);
        return `${months} tháng trước`;
    } else {
        return date.toLocaleDateString('vi-VN');
    }
}

// Update Review Stats
function updateReviewStats() {
    const totalReviews = document.querySelector('.total-reviews');
    if (totalReviews) {
        totalReviews.textContent = `${reviews.length} đánh giá`;
    }
}

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, m => map[m]);
}

// Show Notification
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotif = document.querySelector('.notification');
    if (existingNotif) {
        existingNotif.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fa-solid ${getNotificationIcon(type)}"></i>
        <span>${message}</span>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Auto hide after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Get Notification Icon
function getNotificationIcon(type) {
    const icons = {
        'success': 'fa-check-circle',
        'error': 'fa-times-circle',
        'warning': 'fa-exclamation-circle',
        'info': 'fa-info-circle'
    };
    return icons[type] || icons.info;
}

// CSS for Notifications
const notificationStyles = document.createElement('style');
notificationStyles.textContent = `
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    padding: 16px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 10000;
    transform: translateX(400px);
    transition: transform 0.3s ease;
}

.notification.show {
    transform: translateX(0);
}

.notification i {
    font-size: 20px;
}

.notification-success {
    border-left: 4px solid #27ae60;
}

.notification-success i {
    color: #27ae60;
}

.notification-error {
    border-left: 4px solid #e74c3c;
}

.notification-error i {
    color: #e74c3c;
}

.notification-warning {
    border-left: 4px solid #f39c12;
}

.notification-warning i {
    color: #f39c12;
}

.notification-info {
    border-left: 4px solid #3498db;
}

.notification-info i {
    color: #3498db;
}
`;
document.head.appendChild(notificationStyles);

