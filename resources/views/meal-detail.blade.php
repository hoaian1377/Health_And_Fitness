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



<script>
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


</script>
@endsection