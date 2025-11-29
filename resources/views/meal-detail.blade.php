@extends('base')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/meal-detail.css') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<style>
    /* ========== RESET ========== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* ========== MOBILE RESPONSIVE ========== */
@media (max-width: 768px) {
    .app-container {
        padding: 20px 15px;
    }

    .main-content {
        padding: 25px;
    }

    /* Content grid → stacked */
    .content-grid {
        display: block;
        gap: 0;
    }

    /* Recipe box full width */
    .recipe-box {
        width: 100%;
        margin-bottom: 25px;
    }

    /* Tags card full width */
    .tags-card {
        width: 100%;
        margin-top: 25px;
    }

    /* Quick stats → wrap rows */
    .quick-stats {
        flex-wrap: wrap;
        gap: 15px;
    }

    /* Buttons → stacked */
    .action-buttons {
        flex-direction: column;
        gap: 12px;
    }

    /* Nutrition grid → 2 columns */
    .nutrition-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .meal-title {
        font-size: 28px;
    }

    .meal-description {
        font-size: 15px;
    }

    .recipe-title {
        font-size: 24px;
    }

    .recipe-content {
        font-size: 18px;
    }
}


body {
    font-family: "Poppins", sans-serif;
    background: #f7f9fb;
    color: #333;
    line-height: 1.6;
}

/* ========== CONTAINER ========== */
.app-container {
    max-width: 1200px;
    margin: auto;
    padding: 30px 20px;
}

.main-content {
    background: white;
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0,0,0,0.08);
}

/* ========== BREADCRUMB ========== */
.breadcrumb {
    margin-bottom: 25px;
}

.breadcrumb .current {
    color: #6a5acd;
    font-weight: 600;
    font-size: 17px;
}

/* ========== MEAL HEADER ========== */
.meal-header-content {
    margin-bottom: 40px;
}

.meal-badge-container {
    display: flex;
    gap: 12px;
    margin-bottom: 15px;
}

.meal-category,
.meal-difficulty {
    padding: 6px 14px;
    font-size: 13px;
    border-radius: 20px;
    background: #f1f3ff;
    color: #4b39ef;
}

.meal-title {
    font-size: 34px;
    font-weight: 700;
    margin-bottom: 15px;
    color: #2c2c54;
}

.meal-description {
    font-size: 16px;
    color: #555;
    margin-bottom: 25px;
    max-width: 650px;
}

/* ========== STATS ========== */
.quick-stats {
    display: flex;
    gap: 25px;
    margin-bottom: 30px;
}

.stat-item {
    background: #f7f8fe;
    padding: 14px 22px;
    border-radius: 16px;
    display: flex;
    gap: 12px;
    align-items: center;
    box-shadow: 0 4px 12px rgba(100, 100, 255, 0.08);
}

.stat-item i {
    font-size: 20px;
    color: #4f46e5;
}

.stat-value {
    font-weight: 600;
    font-size: 16px;
}

.stat-label {
    color: #777;
    font-size: 13px;
}

/* ========== BUTTONS ========== */
.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 20px;
}

.btn-primary,
.btn-secondary {
    border: none;
    padding: 12px 22px;
    border-radius: 14px;
    font-size: 15px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    gap: 8px;
    align-items: center;
    transition: 0.2s;
}

.btn-primary {
    background: #4b39ef;
    color: white;
}

.btn-primary:hover {
    background: #3827d1;
}

.btn-secondary {
    background: #eef0fe;
    color: #4b39ef;
}

.btn-secondary:hover {
    background: #e1e3ff;
}

/* ========== NUTRITION SECTION ========== */
.section-title {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #2c2c54;
    display: flex;
    align-items: center;
    gap: 10px;
}

.nutrition-section {
    margin: 40px 0;
}

.nutrition-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.nutrition-card {
    background: white;
    padding: 20px;
    text-align: center;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.07);
}

.nutrition-icon {
    font-size: 26px;
    width: 54px;
    height: 54px;
    margin: 0 auto 14px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.protein { background: #ffe9e9; color: #e63946; }
.carbs   { background: #fff5d7; color: #f4a300; }
.fat     { background: #e8f3ff; color: #3381ff; }
.fiber   { background: #e9ffe7; color: #2b8a3e; }

.nutrition-value {
    font-size: 20px;
    font-weight: 700;
}

.nutrition-label {
    color: #777;
    font-size: 14px;
}

/* ========== CONTENT GRID (LEFT & RIGHT) ========== */
.content-grid {
    display: grid;
    grid-template-columns: 65% 35%;
    gap: 35px;
    margin-top: 45px;
}

.content-section {
    margin-bottom: 30px;
}

.left-column .portion-selector {
    font-size: 15px;
    color: #444;
    background: #f6f7ff;
    padding: 20px;
    border-radius: 14px;
}

/* ========== TIPS CARD ========== */
.tips-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.tips-card ul li {
    margin-bottom: 10px;
}

/* ========== VIDEO PLACEHOLDER ========== */
.video-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    margin-top: 20px;
}

.video-placeholder {
    background: #e7e9ff;
    padding: 40px 20px;
    border-radius: 16px;
    text-align: center;
    color: #4b39ef;
}

/* ========== TAGS ========== */
.tags-card {
    background: #fff;
    padding: 25px;
    border-radius: 18px;
    margin-top: 20px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.tags-list {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.tag {
    padding: 8px 14px;
    background: #f1f3ff;
    border-radius: 14px;
    font-size: 13px;
    color: #4b39ef;
    font-weight: 600;
}

/* ========== REVIEWS ========== */
.reviews-section {
    margin-top: 50px;
}

.review-summary {
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
}

.big-rating {
    font-size: 50px;
    color: #4b39ef;
    font-weight: 700;
}

.review-item {
    padding: 20px;
    background: #fafaff;
    margin-bottom: 18px;
    border-radius: 14px;
}

.review-avatar {
    width: 55px;
    height: 55px;
    border-radius: 50%;
}

.review-actions button {
    background: none;
    border: none;
    cursor: pointer;
    color: #4b39ef;
}

.btn-load-more {
    margin-top: 20px;
    padding: 14px 18px;
    background: #4b39ef;
    color: white;
    border-radius: 14px;
    border: none;
    cursor: pointer;
}
.recipe-box {
    background: #ffffff;
    padding: 32px;
    border-radius: 20px;
    box-shadow: 0 6px 22px rgba(0,0,0,0.12);
    border: 1px solid #e6e6e6;
    transition: 0.25s ease;
}

.recipe-box:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
}

.recipe-title {
    font-size: 26px;          /* TO HƠN */
    font-weight: 800;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 12px;
    color: #2c3e50;
}

.recipe-title i {
    font-size: 28px;          /* ICON TO */
}

.recipe-content {
    font-size: 20px;          /* CHỮ TO DỄ ĐỌC */
    line-height: 1.85;        /* GIÃN DÒNG ĐẸP */
    color: #333;
    background: #f7f7f7;
    padding: 24px;
    border-radius: 16px;
    border-left: 6px solid #4CAF50;  /* ĐƯỜNG NHẤN TO HƠN */
    white-space: pre-line;
}
.content-grid {
    width: 100%;
    display: block;     /* Không chia cột → box sẽ full width */
}

.recipe-box {
    width: 100%;
    background: #ffffff;
    padding: 32px;
    border-radius: 20px;
    margin: 0 auto;
    box-shadow: 0 8px 28px rgba(0,0,0,0.10);
    border: 1px solid #e6e6e6;
}

.recipe-title {
    font-size: 28px;
    font-weight: 800;
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.recipe-content {
    font-size: 20px;
    padding: 26px;
    background: #f7f7f7;
    border-radius: 14px;
    border-left: 6px solid #4CAF50;
    line-height: 1.85;
    width: 100%;
}
@media (max-width: 768px) {
    .content-grid {
        display: block;
        gap: 0;
    }

    .recipe-box,
    .tags-card {
        width: 100%;
        margin: 0 0 25px 0;
    }

    .quick-stats {
        flex-wrap: wrap;
        gap: 15px;
    }

    .action-buttons {
        flex-direction: column;
        gap: 12px;
    }

    .nutrition-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .meal-title {
        font-size: 28px;
    }

    .meal-description {
        font-size: 15px;
    }

    .recipe-title {
        font-size: 24px;
    }

    .recipe-content {
        font-size: 18px;
        padding: 20px;
    }
}
/* Review Section Styles */
.review-section {
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
}

.review-section h3 {
    font-size: 24px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.review-section h3 i {
    color: #ff6b6b;
}

/* Star Rating */
.star-rating {
    text-align: center;
    padding: 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    margin-bottom: 24px;
}

.star-rating h4 {
    color: white;
    font-size: 18px;
    margin-bottom: 16px;
    font-weight: 600;
}

.stars {
    display: flex;
    justify-content: center;
    gap: 8px;
    font-size: 36px;
    margin-bottom: 12px;
}

.stars span {
    cursor: pointer;
    color: rgba(255, 255, 255, 0.4);
    transition: all 0.2s ease;
    user-select: none;
}

.stars span:hover,
.stars span.active {
    color: #ffd700;
    transform: scale(1.1);
}

.rating-value {
    color: white;
    font-size: 20px;
    font-weight: 600;
    letter-spacing: 1px;
}

/* Review Input */
.review-input-container {
    margin-bottom: 32px;
}

#reviewInput {
    width: 100%;
    min-height: 120px;
    padding: 16px;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    font-size: 15px;
    font-family: inherit;
    resize: vertical;
    transition: all 0.3s ease;
    background: #fafafa;
}

#reviewInput:focus {
    outline: none;
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

#reviewInput::placeholder {
    color: #999;
}

#submitReview {
    width: 100%;
    padding: 14px 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

#submitReview:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
}

#submitReview:active {
    transform: translateY(0);
}

#submitReview i {
    font-size: 18px;
}

/* Reviews List */
#reviewsList {
    margin-top: 32px;
}

.review-item {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 16px;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
}

.review-item:hover {
    background: #f0f1f5;
    transform: translateX(4px);
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.review-author {
    display: flex;
    align-items: center;
    gap: 12px;
}

.author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 16px;
}

.author-info h5 {
    font-size: 15px;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.review-date {
    font-size: 13px;
    color: #666;
}

.review-stars {
    color: #ffd700;
    font-size: 16px;
    letter-spacing: 2px;
}

.review-text {
    font-size: 15px;
    line-height: 1.6;
    color: #444;
    margin-top: 8px;
}

/* Empty State */
.empty-reviews {
    text-align: center;
    padding: 48px 20px;
    color: #999;
}

.empty-reviews i {
    font-size: 64px;
    color: #ddd;
    margin-bottom: 16px;
}

.empty-reviews p {
    font-size: 16px;
    margin-top: 12px;
}

/* Responsive */
@media (max-width: 768px) {
    .review-section {
        padding: 20px;
        margin: 20px 16px;
    }

    .stars {
        font-size: 28px;
    }

    #reviewInput {
        min-height: 100px;
    }

    .review-item {
        padding: 16px;
    }

    .author-avatar {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.review-item {
    animation: fadeInUp 0.4s ease;
}

/* Review Section Wrapper - Outside main content */
.review-section-wrapper {
    background: #f8f9fa;
    padding: 60px 0;
    margin-top: 40px;
}

.review-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.review-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.review-header h2 {
    font-size: 28px;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 12px;
}

.review-stats {
    color: #7f8c8d;
    font-size: 14px;
}

/* Review Form Card */
.review-form-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    display: flex;
    gap: 16px;
}

.user-avatar {
    font-size: 48px;
    color: #3498db;
    flex-shrink: 0;
}

.review-form-content {
    flex: 1;
}

/* Star Rating Inline */
.star-rating-inline {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #ecf0f1;
}

.star-rating-inline > span:first-child {
    font-weight: 500;
    color: #2c3e50;
}

.stars {
    display: flex;
    gap: 4px;
}

.star {
    font-size: 24px;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s;
}

.star:hover,
.star.active {
    color: #f39c12;
    transform: scale(1.1);
}

.rating-value {
    font-weight: 600;
    color: #f39c12;
    font-size: 14px;
}

/* Review Textarea */
#reviewInput {
    width: 100%;
    min-height: 100px;
    padding: 12px;
    border: 2px solid #ecf0f1;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    transition: border-color 0.3s;
}

#reviewInput:focus {
    outline: none;
    border-color: #3498db;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    margin-top: 12px;
}

.btn-submit {
    background: linear-gradient(135deg, #3498db, #2980b9);
    color: white;
    border: none;
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

/* Login Required Card */
.login-required-card {
    background: white;
    border-radius: 12px;
    padding: 40px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.login-required-card i {
    font-size: 48px;
    color: #95a5a6;
    margin-bottom: 16px;
}

.login-required-card p {
    color: #7f8c8d;
    font-size: 16px;
}

.login-required-card a {
    color: #3498db;
    font-weight: 600;
    text-decoration: none;
}

.login-required-card a:hover {
    text-decoration: underline;
}

/* Reviews List */
.reviews-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.empty-reviews {
    background: white;
    border-radius: 12px;
    padding: 60px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.empty-reviews i {
    font-size: 64px;
    color: #bdc3c7;
    margin-bottom: 16px;
}

.empty-reviews p {
    color: #95a5a6;
    font-size: 16px;
}

/* Review Item */
.review-item {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s;
}

.review-item:hover {
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
}

.review-item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 12px;
}

.review-user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.review-user-avatar {
    font-size: 40px;
    color: #3498db;
}

.review-user-details h4 {
    font-size: 16px;
    color: #2c3e50;
    margin: 0 0 4px 0;
}

.review-date {
    font-size: 12px;
    color: #95a5a6;
}

.review-rating {
    display: flex;
    align-items: center;
    gap: 4px;
}

.review-rating .star {
    font-size: 16px;
    color: #f39c12;
}

.review-content {
    color: #34495e;
    line-height: 1.6;
    margin-bottom: 12px;
}

.review-actions {
    display: flex;
    gap: 12px;
    padding-top: 12px;
    border-top: 1px solid #ecf0f1;
}

.review-action-btn {
    background: none;
    border: none;
    color: #7f8c8d;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    padding: 6px 12px;
    border-radius: 6px;
    transition: all 0.2s;
}

.review-action-btn:hover {
    background: #ecf0f1;
    color: #2c3e50;
}

.review-action-btn.delete-btn:hover {
    background: #fee;
    color: #e74c3c;
}

/* Responsive */
@media (max-width: 768px) {
    .review-form-card {
        flex-direction: column;
    }
    
    .star-rating-inline {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .review-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }
}
/* ================= STAR RATING ================= */
.stars {
    display: flex;
    gap: 8px;
}

.stars .star {
    font-size: 28px;
    color: #ccc;           /* màu sao chưa chọn */
    cursor: pointer;
    transition: all 0.2s;
    padding: 4px;
    border: 2px solid #ccc; /* viền xung quanh sao */
    border-radius: 6px;     /* bo tròn viền */
}

.stars .star.active,
.stars .star:hover,
.stars .star:hover ~ .star {
    color: #f1c40f;         /* màu vàng khi chọn hoặc hover */
    border-color: #f1c40f;  /* viền vàng khi hover/active */
    transform: scale(1.2);  /* phóng to nhẹ khi hover */
}

.stars .star:hover {
    transform: scale(1.3);
}

/* Responsive trên mobile */
@media (max-width: 768px) {
    .stars .star {
        font-size: 24px;
        padding: 3px;
    }
}

</style>

<div class="app-container">
    <div class="main-content">

        @if(!$mealplan)
            <p>Chưa có dữ liệu</p>
        @else

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <span class="current">{{ $mealplan->meal_plan }}</span>
        </div>

        <!-- Meal Header -->
        <div class="meal-header">
            <div class="meal-header-content">

                <div class="meal-badge-container">
                    <span class="meal-category">{{ $mealplan->fitness_goal->goal_name }}</span>
                    <span class="meal-difficulty">Dễ làm</span>
                </div>

                <h1 class="meal-title">{{ $mealplan->meal_name }}</h1>

                <p class="meal-description">
                    Món salad ức gà giàu protein, ít calo, hoàn hảo cho bữa trưa lành mạnh.
                    Kết hợp rau xanh tươi mát với ức gà nướng thơm ngon, sốt chanh dây thanh nhẹ.
                </p>

                <!-- Quick Stats -->
                <div class="quick-stats">
                    <div class="stat-item">
                        <i class="fa-solid fa-clock"></i>
                        <div>
                            <span class="stat-value">15 phút</span>
                            <span class="stat-label">Thời gian</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-fire"></i>
                        <div>
                            <span class="stat-value">{{ $mealplan->calories }}</span>
                            <span class="stat-label">Năng lượng</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-users"></i>
                        <div>
                            <span class="stat-value">2 người</span>
                            <span class="stat-label">Khẩu phần</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <i class="fa-solid fa-star"></i>
                        <div>
                            <span class="stat-value">4.8/5</span>
                            <span class="stat-label">Đánh giá</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button class="btn-primary"><i class="fa-solid fa-bookmark"></i> Lưu công thức</button>
                    <button class="btn-secondary"><i class="fa-solid fa-share-nodes"></i> Chia sẻ</button>
                    <button class="btn-secondary"><i class="fa-solid fa-print"></i> In công thức</button>
                </div>
            </div>
        </div>

        <!-- Nutrition Facts -->
        <div class="nutrition-section">
            <h2 class="section-title">
                <i class="fa-solid fa-chart-pie"></i> Thông Tin Dinh Dưỡng
            </h2>

            <div class="nutrition-grid">
                <div class="nutrition-card">
                    <div class="nutrition-icon protein">
                        <i class="fa-solid fa-drumstick-bite"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->protein }}</span>
                        <span class="nutrition-label">Protein</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon carbs">
                        <i class="fa-solid fa-bread-slice"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->carbs }}</span>
                        <span class="nutrition-label">Carbs</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon fat">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->fat }}</span>
                        <span class="nutrition-label">Chất béo</span>
                    </div>
                </div>

                <div class="nutrition-card">
                    <div class="nutrition-icon fiber">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <div class="nutrition-info">
                        <span class="nutrition-value">{{ $mealplan->food_weight }}</span>
                        <span class="nutrition-label">Khối Lượng</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-grid">
            <div class="recipe-box">
                <h3 class="recipe-title">
                    <i class="fa-solid fa-utensils"></i> Cách Nấu món ăn {{ $mealplan->meal_name }}
                </h3>

                <div class="recipe-content">
                    {!! nl2br(e($mealplan->description)) !!}
                </div>
            </div>

            <div class="tags-card">
                <h3><i class="fa-solid fa-tags"></i> Phân Loại</h3>
                <div class="tags-list">
                    <span class="tag">Giảm cân</span>
                    <span class="tag">Ít calo</span>
                    <span class="tag">High protein</span>
                    <span class="tag">Healthy</span>
                    <span class="tag">Keto</span>
                    <span class="tag">Bữa trưa</span>
                </div>
            </div>
        </div>

        @endif
    </div>
</div>

<!-- Review Section - Moved Outside -->
<div class="review-section-wrapper">
    <div class="review-container">
        <div class="review-header">
            <h2>
                <i class="fa-solid fa-comments"></i>
                Đánh Giá & Nhận Xét
            </h2>
            <div class="review-stats">
                <span class="total-reviews">0 đánh giá</span>
            </div>
        </div>

        @auth
        <!-- Review Input Form -->
        <div class="review-form-card">
            <div class="user-avatar">
                <i class="fa-solid fa-user-circle"></i>
            </div>
            <div class="review-form-content">
                <!-- Star Rating -->
                <div class="star-rating-inline">
                    <span>Đánh giá của bạn:</span>
                    <div class="stars">
                        <span class="star" data-value="1">&#9733;</span>
                        <span class="star" data-value="2">&#9733;</span>
                        <span class="star" data-value="3">&#9733;</span>
                        <span class="star" data-value="4">&#9733;</span>
                        <span class="star" data-value="5">&#9733;</span>
                    </div>
                    <span class="rating-value">0/5</span>
                </div>

                <!-- Review Input -->
                <textarea id="reviewInput" placeholder="Chia sẻ trải nghiệm của bạn về món ăn này..."></textarea>
                
                <div class="form-actions">
                    <button id="submitReview" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Gửi đánh giá
                    </button>
                </div>
            </div>
        </div>
        @else
        <!-- Login Required -->
        <div class="login-required-card">
            <i class="fa-solid fa-lock"></i>
            <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để đánh giá món ăn này</p>
        </div>
        @endauth

        <!-- Reviews List -->
        <div class="reviews-list" id="reviewsList">
            <div class="empty-reviews">
                <i class="fa-solid fa-comment-slash"></i>
                <p>Chưa có đánh giá nào. Hãy là người đầu tiên!</p>
            </div>
        </div>
    </div>
</div>

<!-- Pass user data to JavaScript -->
@auth
<script>
    window.currentUser = {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}",
        id: "{{ Auth::user()->id }}"
    };
</script>
@endauth



<script src="{{ asset('js/meal-detail.js') }}"></script>
@endsection