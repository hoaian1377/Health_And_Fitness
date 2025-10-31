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