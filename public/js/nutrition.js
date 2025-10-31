// ================= TAB FILTERING =================
const tabs = document.querySelectorAll('.tab');
const workoutCards = document.querySelectorAll('.workout-card');

tabs.forEach(tab => {
    tab.addEventListener('click', function() {
        const category = this.getAttribute('data-category');
        const tabsContainer = this.closest('.tabs-container');
        const section = tabsContainer.nextElementSibling;
        
        // Remove active class from all tabs in this section
        tabsContainer.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        
        // Filter cards in this section only
        const cards = section.querySelectorAll('.workout-card');
        cards.forEach(card => {
            if (category === 'all' || card.getAttribute('data-category') === category) {
                card.classList.remove('hidden');
                card.style.display = 'block';
            } else {
                card.classList.add('hidden');
                card.style.display = 'none';
            }
        });
    });
});

// ================= SEARCH FUNCTIONALITY =================
const searchInput = document.getElementById('meal-search');
const searchClearBtn = document.getElementById('search-clear');

if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        // Show/hide clear button
        if (searchTerm.length > 0) {
            searchClearBtn.style.display = 'block';
        } else {
            searchClearBtn.style.display = 'none';
        }
        
        // Filter cards
        workoutCards.forEach(card => {
            const title = card.querySelector('.workout-card-title').textContent.toLowerCase();
            const badge = card.querySelector('.workout-badge').textContent.toLowerCase();
            
            if (title.includes(searchTerm) || badge.includes(searchTerm)) {
                card.style.display = 'block';
                card.classList.remove('hidden');
            } else {
                card.style.display = 'none';
                card.classList.add('hidden');
            }
        });
        
        // Check if no results
        const visibleCards = Array.from(workoutCards).filter(card => 
            card.style.display !== 'none'
        );
        
        if (visibleCards.length === 0) {
            showNoResults();
        } else {
            hideNoResults();
        }
    });
}

// Clear search
if (searchClearBtn) {
    searchClearBtn.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        
        // Show all cards
        workoutCards.forEach(card => {
            card.style.display = 'block';
            card.classList.remove('hidden');
        });
        
        hideNoResults();
        searchInput.focus();
    });
}

// ================= NO RESULTS MESSAGE =================
function showNoResults() {
    let noResultsMsg = document.querySelector('.no-results-message');
    if (!noResultsMsg) {
        noResultsMsg = document.createElement('div');
        noResultsMsg.className = 'no-results-message';
        noResultsMsg.innerHTML = `
            <i class="fa-solid fa-search"></i>
            <h3>Không tìm thấy món ăn phù hợp</h3>
            <p>Thử tìm kiếm với từ khóa khác hoặc xem tất cả thực đơn</p>
        `;
        
        // Add styles
        noResultsMsg.style.cssText = `
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        `;
        
        const workoutGrid = document.querySelector('.workout-grid');
        workoutGrid.appendChild(noResultsMsg);
    }
    noResultsMsg.style.display = 'block';
}

function hideNoResults() {
    const noResultsMsg = document.querySelector('.no-results-message');
    if (noResultsMsg) {
        noResultsMsg.style.display = 'none';
    }
}

// ================= MEAL CARD CLICK HANDLER =================
const startButtons = document.querySelectorAll('.start-btn');

startButtons.forEach((btn, index) => {
    btn.addEventListener('click', function(e) {
        // Nếu không phải là link <a>, thì xử lý click
        if (btn.tagName !== 'A') {
            e.preventDefault();
            
            // Lấy thông tin món ăn
            const card = this.closest('.workout-card');
            const mealTitle = card.querySelector('.workout-card-title').textContent;
            const mealCategory = card.getAttribute('data-category');
            
            // Tạo ID từ index (trong thực tế bạn sẽ có ID từ database)
            const mealId = index + 1;
            
            // Chuyển hướng đến trang chi tiết
            window.location.href = `/meal/${mealId}`;
            
            // Hoặc nếu dùng Laravel route:
            // window.location.href = `{{ route('meal.detail', ['id' => '${mealId}']) }}`;
        }
    });
});

// ================= HERO BUTTON =================
const heroBtn = document.querySelector('.hero-btn');
if (heroBtn) {
    heroBtn.addEventListener('click', function() {
        // Scroll to meal grid
        const mealGrid = document.querySelector('.workout-grid');
        if (mealGrid) {
            mealGrid.scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
}

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

// ================= ANIMATION ON SCROLL =================
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

// Observe all workout cards
workoutCards.forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
    observer.observe(card);
});

// ================= HOVER EFFECTS =================
workoutCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});

// ================= BOOKMARK FUNCTIONALITY (OPTIONAL) =================
const bookmarkIcons = document.querySelectorAll('.bookmark-icon');

bookmarkIcons.forEach(icon => {
    icon.addEventListener('click', function(e) {
        e.stopPropagation();
        this.classList.toggle('bookmarked');
        
        if (this.classList.contains('bookmarked')) {
            this.classList.remove('fa-regular');
            this.classList.add('fa-solid');
            showNotification('Đã lưu món ăn vào danh sách yêu thích!');
        } else {
            this.classList.remove('fa-solid');
            this.classList.add('fa-regular');
            showNotification('Đã bỏ lưu món ăn!');
        }
    });
});

// ================= NOTIFICATION =================
function showNotification(message) {
    // Remove old notification if exists
    const oldNotification = document.querySelector('.notification');
    if (oldNotification) {
        oldNotification.remove();
    }
    
    // Create new notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
        <i class="fa-solid fa-check-circle"></i>
        <span>${message}</span>
    `;
    
    // Add styles
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
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.4s ease';
        setTimeout(() => notification.remove(), 400);
    }, 3000);
}

// ================= ADD ANIMATIONS CSS =================
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
    
    .no-results-message i {
        font-size: 48px;
        color: #dee2e6;
        margin-bottom: 15px;
    }
    
    .no-results-message h3 {
        font-size: 20px;
        color: #495057;
        margin-bottom: 8px;
    }
    
    .no-results-message p {
        font-size: 14px;
        color: #6c757d;
    }
`;
document.head.appendChild(style);

// ================= LOADING STATE =================
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});

// ================= PREVENT DOUBLE CLICK =================
let isNavigating = false;
startButtons.forEach(btn => {
    btn.addEventListener('click', function(e) {
        if (isNavigating) {
            e.preventDefault();
            return;
        }
        isNavigating = true;
        
        // Show loading
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Đang tải...';
        this.style.pointerEvents = 'none';
        
        // Reset after 2 seconds (in case navigation fails)
        setTimeout(() => {
            this.innerHTML = originalText;
            this.style.pointerEvents = 'auto';
            isNavigating = false;
        }, 2000);
    });
});

console.log(' Nutrition Page Loaded Successfully!');