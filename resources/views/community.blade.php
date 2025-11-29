@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* ================= RESET ================= */
/* Đặt lại margin, padding và box-sizing cho tất cả phần tử */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Cấu hình cơ bản cho html và body */
html,
body {
    height: auto;
    scroll-behavior: smooth;
    /* cuộn mượt */
    font-family: "Segoe UI", sans-serif;
    background: linear-gradient(135deg, #f7f9ff, #e4edff);
    color: #222;
    overflow-x: hidden;
    overflow-y: auto;
    /* bật lại cuộn dọc */
}




/* ================= AUTH BUTTONS ================= */
.auth-buttons {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-login,
.btn-register {
    border-radius: 25px;
    padding: 8px 18px;
    font-weight: 600;
    transition: 0.3s;
}

.btn-login {
    background: #ffea00;
    color: #222;
}

.btn-login:hover {
    background: #fff;
    color: #000;
}

.btn-register {
    border: 2px solid #fff;
    color: #fff;
}

.btn-register:hover {
    background: #fff;
    color: #000;
}


/* ================= COMMUNITY CONTAINER ================= */
/* Container chính cho trang cộng đồng */
.community-container {
    max-width: 1400px;
    /* Chiều rộng tối đa */
    margin: 0 auto;
    /* Căn giữa */
    padding: 20px;
    /* Khoảng đệm ngoài */
}

/* ================= HERO SECTION ================= */
/* Phần hero: Giới thiệu nổi bật ở đầu trang */
.community-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient tím-xanh */
    border-radius: 24px;
    /* Bo góc lớn */
    padding: 60px 50px;
    /* Khoảng đệm lớn */
    margin-bottom: 40px;
    /* Khoảng cách dưới */
    color: white;
    /* Màu chữ trắng */
    position: relative;
    /* Vị trí tương đối cho pseudo-elements */
    overflow: hidden;
    /* Ẩn tràn */
    display: flex;
    /* Hiển thị flexbox */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: space-between;
    /* Căn đều hai bên */
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
    /* Bóng đổ xanh */
}

.community-hero::before {
    content: '';
    /* Nội dung rỗng cho pseudo-element */
    position: absolute;
    /* Vị trí tuyệt đối */
    top: -50%;
    /* Cách đỉnh âm */
    right: -10%;
    /* Cách phải âm */
    width: 500px;
    /* Chiều rộng hình tròn */
    height: 500px;
    /* Chiều cao hình tròn */
    background: rgba(255, 255, 255, 0.1);
    /* Nền trắng mờ */
    border-radius: 50%;
    /* Hình tròn */
    animation: float 6s ease-in-out infinite;
    /* Hiệu ứng float */
}

.community-hero::after {
    content: '';
    /* Nội dung rỗng */
    position: absolute;
    bottom: -30%;
    /* Cách đáy âm */
    left: -5%;
    /* Cách trái âm */
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.08);
    /* Nền trắng mờ hơn */
    border-radius: 50%;
    animation: float 8s ease-in-out infinite reverse;
    /* Hiệu ứng float ngược */
}

@keyframes float {

    0%,
    100% {
        transform: translateY(0) rotate(0deg);
        /* Vị trí ban đầu */
    }

    50% {
        transform: translateY(-20px) rotate(5deg);
        /* Di chuyển lên và xoay */
    }
}

.hero-content {
    position: relative;
    /* Vị trí tương đối */
    z-index: 2;
    /* Lớp trên pseudo-elements */
    flex: 1;
    /* Chiếm không gian còn lại */
}

.hero-title {
    font-size: 48px;
    /* Kích thước chữ lớn */
    font-weight: 800;
    /* Độ đậm rất cao */
    margin-bottom: 15px;
    /* Khoảng cách dưới */
    line-height: 1.2;
    /* Chiều cao dòng */
}

.hero-title span {
    color: #ffea00;
    /* Màu vàng cho phần span */
}

.hero-subtitle {
    font-size: 20px;
    /* Kích thước chữ trung bình */
    opacity: 0.95;
    /* Độ mờ */
    margin-bottom: 30px;
    /* Khoảng cách dưới */
    font-weight: 300;
    /* Độ đậm nhẹ */
}

.hero-stats {
    display: flex;
    /* Flexbox cho thống kê */
    gap: 40px;
    /* Khoảng cách giữa item */
    margin-bottom: 30px;
    /* Khoảng cách dưới */
}

.stat-item {
    text-align: center;
    /* Căn giữa chữ */
}

.stat-number {
    font-size: 32px;
    /* Kích thước số lớn */
    font-weight: 800;
    /* Độ đậm cao */
    margin-bottom: 5px;
    /* Khoảng cách dưới */
}

.stat-label {
    font-size: 14px;
    /* Kích thước nhỏ */
    opacity: 0.9;
    /* Độ mờ */
    text-transform: uppercase;
    /* Chữ in hoa */
    letter-spacing: 1px;
    /* Khoảng cách chữ */
}

.create-post-btn {
    background: white;
    /* Nền trắng */
    color: #667eea;
    /* Màu chữ xanh */
    border: none;
    /* Bỏ viền */
    padding: 14px 32px;
    /* Khoảng đệm */
    border-radius: 30px;
    /* Bo góc lớn */
    font-weight: 700;
    /* Độ đậm cao */
    font-size: 16px;
    /* Kích thước chữ */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng chuyển mượt */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    /* Bóng đổ */
    display: inline-flex;
    /* Flexbox inline */
    align-items: center;
    /* Căn giữa dọc */
    gap: 8px;
    /* Khoảng cách icon và text */
    text-decoration: none;
    /* Bỏ gạch chân cho link */
}

.create-post-btn:hover {
    transform: translateY(-2px);
    /* Nâng lên khi hover */
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    /* Bóng đổ mạnh hơn */
}

.hero-illustration {
    position: relative;
    /* Vị trí tương đối */
    z-index: 2;
    /* Lớp trên */
    width: 300px;
    /* Chiều rộng */
    height: 300px;
    /* Chiều cao */
}

.floating-card {
    position: absolute;
    /* Vị trí tuyệt đối */
    background: rgba(255, 255, 255, 0.2);
    /* Nền trắng mờ */
    backdrop-filter: blur(10px);
    /* Lọc nền mờ */
    border-radius: 20px;
    /* Bo góc */
    padding: 20px;
    /* Khoảng đệm */
    display: flex;
    /* Flexbox */
    flex-direction: column;
    /* Hướng cột */
    align-items: center;
    /* Căn giữa ngang */
    gap: 10px;
    /* Khoảng cách */
    color: white;
    /* Màu chữ trắng */
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    /* Bóng đổ */
    animation: float 3s ease-in-out infinite;
    /* Hiệu ứng float */
}

.floating-card i {
    font-size: 32px;
    /* Kích thước icon lớn */
    margin-bottom: 5px;
    /* Khoảng cách dưới */
}

.floating-card span {
    font-size: 14px;
    /* Kích thước chữ nhỏ */
    font-weight: 600;
    /* Độ đậm trung bình */
}

.card-1 {
    top: 0;
    /* Vị trí trên cùng */
    left: 0;
    /* Trái cùng */
    animation-delay: 0s;
    /* Không delay */
}

.card-2 {
    top: 50%;
    /* Giữa dọc */
    right: 0;
    /* Phải cùng */
    transform: translateY(-50%);
    /* Căn giữa dọc */
    animation-delay: 1s;
    /* Delay 1 giây */
}

.card-3 {
    bottom: 0;
    /* Dưới cùng */
    left: 20%;
    /* Cách trái 20% */
    animation-delay: 2s;
    /* Delay 2 giây */
}

/* ================= MAIN CONTENT ================= */
/* Nội dung chính của trang */
.community-main {
    display: block;
    /* Hiển thị khối để full width */
}

/* ================= SIDEBAR ================= */
/* Thanh bên sidebar */
.community-sidebar {
    display: none;
    /* Ẩn sidebar hoàn toàn */
}

.sidebar-widget {
    background: white;
    /* Nền trắng */
    border-radius: 16px;
    /* Bo góc */
    padding: 24px;
    /* Khoảng đệm */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    /* Bóng đổ nhẹ */
}

.widget-title {
    font-size: 18px;
    /* Kích thước chữ */
    font-weight: 700;
    /* Độ đậm cao */
    color: #222;
    /* Màu chữ đen */
    margin-bottom: 20px;
    /* Khoảng cách dưới */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    gap: 10px;
    /* Khoảng cách icon và text */
}

.widget-title i {
    color: #667eea;
    /* Màu icon xanh */
}

/* Search Widget: Widget tìm kiếm */
.search-input-wrapper {
    position: relative;
    /* Vị trí tương đối cho icon */
}

.search-input-wrapper input {
    width: 100%;
    /* Đầy đủ chiều rộng */
    padding: 12px 16px 12px 42px;
    /* Khoảng đệm, thụt trái cho icon */
    border: 2px solid #e9ecef;
    /* Viền xám nhạt */
    border-radius: 12px;
    /* Bo góc */
    font-size: 14px;
    /* Kích thước chữ */
    transition: all 0.3s;
    /* Hiệu ứng mượt */
    outline: none;
    /* Bỏ viền focus mặc định */
}

.search-input-wrapper input:focus {
    border-color: #667eea;
    /* Viền xanh khi focus */
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    /* Bóng xanh mờ */
}

.search-icon {
    position: absolute;
    /* Vị trí tuyệt đối */
    left: 14px;
    /* Cách trái */
    top: 50%;
    /* Giữa dọc */
    transform: translateY(-50%);
    /* Căn giữa dọc */
    color: #6c757d;
    /* Màu xám */
    pointer-events: none;
    /* Không tương tác */
}

/* Categories Widget: Widget danh mục */
.categories-list {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 10px;
    /* Khoảng cách */
}

.category-btn {
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: space-between;
    /* Căn đều hai bên */
    padding: 12px 16px;
    /* Khoảng đệm */
    border: none;
    /* Bỏ viền */
    background: #f8f9fa;
    /* Nền xám nhạt */
    border-radius: 12px;
    /* Bo góc */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    font-size: 14px;
    /* Kích thước chữ */
    font-weight: 500;
    /* Độ đậm trung bình */
    color: #495057;
    /* Màu chữ xám */
    text-align: left;
    /* Căn trái */
    width: 100%;
    /* Đầy đủ chiều rộng */
}

.category-btn i {
    margin-right: 10px;
    /* Khoảng cách phải icon */
    color: #667eea;
    /* Màu icon xanh */
}

.category-btn:hover {
    background: #e9ecef;
    /* Nền xám khi hover */
    transform: translateX(5px);
    /* Dịch sang phải */
}

.category-btn.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient active */
    color: white;
    /* Màu chữ trắng */
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    /* Bóng xanh */
}

.category-btn.active i {
    color: white;
    /* Icon trắng khi active */
}

.category-count {
    background: rgba(255, 255, 255, 0.2);
    /* Nền trắng mờ */
    padding: 4px 10px;
    /* Khoảng đệm */
    border-radius: 12px;
    /* Bo góc */
    font-size: 12px;
    /* Kích thước nhỏ */
    font-weight: 600;
    /* Độ đậm */
}

.category-btn.active .category-count {
    background: rgba(255, 255, 255, 0.3);
    /* Nền trắng mờ hơn khi active */
}

/* Trending Widget: Widget chủ đề thịnh hành */
.trending-list {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 12px;
    /* Khoảng cách */
}

.trending-item {
    display: flex;
    /* Flexbox ngang */
    align-items: center;
    /* Căn giữa dọc */
    gap: 12px;
    /* Khoảng cách */
    padding: 10px;
    /* Khoảng đệm */
    border-radius: 10px;
    /* Bo góc */
    transition: all 0.3s;
    /* Hiệu ứng */
    cursor: pointer;
    /* Con trỏ tay */
}

.trending-item:hover {
    background: #f8f9fa;
    /* Nền xám khi hover */
}

.trend-number {
    font-weight: 800;
    /* Độ đậm cao */
    color: #667eea;
    /* Màu xanh */
    font-size: 16px;
    /* Kích thước */
    min-width: 30px;
    /* Chiều rộng tối thiểu */
}

.trend-text {
    flex: 1;
    /* Chiếm không gian còn lại */
    font-weight: 500;
    /* Độ đậm trung bình */
    color: #495057;
    /* Màu xám */
}

.trend-count {
    font-size: 12px;
    /* Kích thước nhỏ */
    color: #6c757d;
    /* Màu xám nhạt */
    font-weight: 600;
    /* Độ đậm */
}

/* Contributors Widget: Widget top đóng góp */
.contributors-list {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 15px;
    /* Khoảng cách */
}

.contributor-item {
    display: flex;
    /* Flexbox ngang */
    align-items: center;
    /* Căn giữa dọc */
    gap: 12px;
    /* Khoảng cách */
    padding: 12px;
    /* Khoảng đệm */
    border-radius: 12px;
    /* Bo góc */
    transition: all 0.3s;
    /* Hiệu ứng */
}

.contributor-item:hover {
    background: #f8f9fa;
    /* Nền xám khi hover */
}

.contributor-avatar {
    width: 50px;
    /* Chiều rộng ảnh */
    height: 50px;
    /* Chiều cao ảnh */
    border-radius: 50%;
    /* Hình tròn */
    object-fit: cover;
    /* Giữ tỷ lệ */
    border: 3px solid #667eea;
    /* Viền xanh */
}

.contributor-info {
    flex: 1;
    /* Chiếm không gian còn lại */
}

.contributor-name {
    font-weight: 600;
    /* Độ đậm */
    color: #222;
    /* Màu đen */
    font-size: 14px;
    /* Kích thước */
    margin-bottom: 4px;
    /* Khoảng cách dưới */
}

.contributor-points {
    font-size: 12px;
    /* Kích thước nhỏ */
    color: #6c757d;
    /* Màu xám */
}

.contributor-badge {
    color: #ffea00;
    /* Màu vàng */
    font-size: 20px;
    /* Kích thước icon */
}

/* ================= POSTS FEED ================= */
/* Phần feed bài viết */
.posts-feed {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 20px;
    /* Khoảng cách */
}

/* Feed Tabs: Tab lọc feed */
.feed-tabs {
    display: flex;
    /* Flexbox ngang */
    gap: 12px;
    /* Khoảng cách */
    background: white;
    /* Nền trắng */
    padding: 16px;
    /* Khoảng đệm */
    border-radius: 16px;
    /* Bo góc */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    /* Bóng đổ */
    overflow-x: auto;
    /* Cuộn ngang nếu tràn */
}

.feed-tab {
    padding: 10px 20px;
    /* Khoảng đệm */
    border: none;
    /* Bỏ viền */
    background: #f8f9fa;
    /* Nền xám nhạt */
    border-radius: 20px;
    /* Bo góc lớn */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    font-size: 14px;
    /* Kích thước chữ */
    font-weight: 600;
    /* Độ đậm */
    color: #6c757d;
    /* Màu xám */
    white-space: nowrap;
    /* Không xuống dòng */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    gap: 8px;
    /* Khoảng cách icon text */
}

.feed-tab:hover {
    background: #e9ecef;
    /* Nền xám khi hover */
    color: #667eea;
    /* Màu xanh */
}

.feed-tab.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient active */
    color: white;
    /* Màu trắng */
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    /* Bóng xanh */
}

/* Posts List: Danh sách bài viết */
.posts-list {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 20px;
    /* Khoảng cách */
}

.post-card {
    background: white;
    /* Nền trắng */
    border-radius: 20px;
    /* Bo góc lớn */
    padding: 24px;
    /* Khoảng đệm */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    /* Bóng đổ nhẹ */
    transition: all 0.3s;
    /* Hiệu ứng */
    border: 1px solid transparent;
    /* Viền trong suốt */
}

.post-card:hover {
    transform: translateY(-5px);
    /* Nâng lên khi hover */
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    /* Bóng mạnh hơn */
    border-color: #e9ecef;
    /* Viền xám */
}

.post-card.featured {
    border: 2px solid #667eea;
    /* Viền xanh cho bài nổi bật */
    background: linear-gradient(135deg, #ffffff 0%, #f7f9ff 100%);
    /* Nền gradient nhạt */
}

/* Post Header: Phần đầu bài viết */
.post-header {
    display: flex;
    /* Flexbox */
    justify-content: space-between;
    /* Căn đều hai bên */
    align-items: flex-start;
    /* Căn đầu dọc */
    margin-bottom: 20px;
    /* Khoảng cách dưới */
}

.post-author {
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    gap: 12px;
    /* Khoảng cách */
}

.author-avatar {
    width: 50px;
    /* Chiều rộng ảnh */
    height: 50px;
    /* Chiều cao ảnh */
    border-radius: 50%;
    /* Hình tròn */
    object-fit: cover;
    /* Giữ tỷ lệ */
    border: 2px solid #667eea;
    /* Viền xanh */
}

.author-info {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
}

.author-name {
    font-weight: 700;
    /* Độ đậm cao */
    color: #222;
    /* Màu đen */
    font-size: 15px;
    /* Kích thước */
}

.post-time {
    font-size: 13px;
    /* Kích thước nhỏ */
    color: #6c757d;
    /* Màu xám */
}

.post-category-badge {
    padding: 8px 16px;
    /* Khoảng đệm */
    border-radius: 20px;
    /* Bo góc lớn */
    font-size: 12px;
    /* Kích thước nhỏ */
    font-weight: 600;
    /* Độ đậm */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    gap: 6px;
    /* Khoảng cách */
}

.post-category-badge.workout {
    background: #fee2e2;
    /* Nền đỏ nhạt cho tập luyện */
    color: #991b1b;
    /* Màu đỏ */
}

.post-category-badge.nutrition {
    background: #d1fae5;
    /* Nền xanh lá nhạt cho dinh dưỡng */
    color: #065f46;
    /* Màu xanh lá */
}

.post-category-badge.results {
    background: #dbeafe;
    /* Nền xanh dương nhạt cho thành tích */
    color: #1e40af;
    /* Màu xanh dương */
}

.post-category-badge.motivation {
    background: #fef3c7;
    /* Nền vàng nhạt cho động viên */
    color: #92400e;
    /* Màu nâu */
}

.post-category-badge.tips {
    background: #e0e7ff;
    /* Nền tím nhạt cho mẹo hay */
    color: #3730a3;
    /* Màu tím */
}

/* Post Content: Nội dung bài viết */
.post-content {
    margin-bottom: 20px;
    /* Khoảng cách dưới */
}

.post-title {
    font-size: 22px;
    /* Kích thước tiêu đề */
    font-weight: 700;
    /* Độ đậm cao */
    color: #222;
    /* Màu đen */
    margin-bottom: 12px;
    /* Khoảng cách dưới */
    line-height: 1.4;
    /* Chiều cao dòng */
}

.post-text {
    font-size: 15px;
    /* Kích thước chữ */
    color: #495057;
    /* Màu xám */
    line-height: 1.7;
    /* Chiều cao dòng lớn */
    margin-bottom: 16px;
    /* Khoảng cách dưới */
}

.post-images {
    display: grid;
    /* Lưới cho hình ảnh */
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    /* Cột tự động, tối thiểu 200px */
    gap: 12px;
    /* Khoảng cách */
    margin-top: 16px;
    /* Khoảng cách trên */
}

.post-images.single {
    grid-template-columns: 1fr;
    /* Một cột cho hình đơn */
}

.post-images img {
    width: 100%;
    /* Đầy đủ chiều rộng */
    border-radius: 12px;
    /* Bo góc */
    object-fit: cover;
    /* Giữ tỷ lệ */
    height: 250px;
    /* Chiều cao cố định */
    cursor: pointer;
    /* Con trỏ tay */
    transition: transform 0.3s;
    /* Hiệu ứng scale */
}

.post-images img:hover {
    transform: scale(1.05);
    /* Phóng to nhẹ khi hover */
}

/* Post Stats: Thống kê bài viết */
.post-stats {
    display: flex;
    /* Flexbox ngang */
    gap: 24px;
    /* Khoảng cách */
    padding: 16px 0;
    /* Khoảng đệm trên dưới */
    border-top: 1px solid #e9ecef;
    /* Viền trên xám */
    border-bottom: 1px solid #e9ecef;
    /* Viền dưới xám */
    margin-bottom: 16px;
    /* Khoảng cách dưới */
}

.stat-item {
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    gap: 8px;
    /* Khoảng cách */
    color: #6c757d;
    /* Màu xám */
    font-size: 14px;
    /* Kích thước */
    font-weight: 600;
    /* Độ đậm */
}

.stat-item i {
    color: #667eea;
    /* Màu icon xanh */
}

/* Post Actions: Các nút hành động bài viết */
.post-actions {
    display: flex;
    /* Flexbox ngang */
    gap: 12px;
    /* Khoảng cách */
    margin-bottom: 16px;
    /* Khoảng cách dưới */
}

.action-btn {
    flex: 1;
    /* Chiếm đều không gian */
    padding: 12px;
    /* Khoảng đệm */
    border: 2px solid #e9ecef;
    /* Viền xám */
    background: white;
    /* Nền trắng */
    border-radius: 12px;
    /* Bo góc */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    font-size: 14px;
    /* Kích thước chữ */
    font-weight: 600;
    /* Độ đậm */
    color: #495057;
    /* Màu xám */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: center;
    /* Căn giữa ngang */
    gap: 8px;
    /* Khoảng cách icon text */
}

.action-btn:hover {
    border-color: #667eea;
    /* Viền xanh khi hover */
    color: #667eea;
    /* Màu xanh */
    background: #f7f9ff;
    /* Nền xanh nhạt */
}

.action-btn.like-btn.liked {
    background: #fee2e2;
    /* Nền đỏ nhạt khi liked */
    border-color: #fca5a5;
    /* Viền đỏ */
    color: #dc2626;
    /* Màu đỏ */
}

.action-btn.like-btn.liked i {
    color: #dc2626;
    /* Icon đỏ khi liked */
}

/* Post Comments: Phần bình luận bài viết */
.post-comments {
    margin-top: 16px;
    /* Khoảng cách trên */
    padding-top: 16px;
    /* Khoảng đệm trên */
    border-top: 1px solid #e9ecef;
    /* Viền trên xám */
}

.comment-form {
    display: flex;
    /* Flexbox ngang */
    align-items: center;
    /* Căn giữa dọc */
    gap: 12px;
    /* Khoảng cách */
}

.comment-avatar {
    width: 40px;
    /* Chiều rộng ảnh */
    height: 40px;
    /* Chiều cao ảnh */
    border-radius: 50%;
    /* Hình tròn */
    object-fit: cover;
    /* Giữ tỷ lệ */
    border: 2px solid #667eea;
    /* Viền xanh */
}

.comment-input {
    flex: 1;
    /* Chiếm không gian còn lại */
    padding: 12px 16px;
    /* Khoảng đệm */
    border: 2px solid #e9ecef;
    /* Viền xám */
    border-radius: 24px;
    /* Bo góc lớn */
    font-size: 14px;
    /* Kích thước chữ */
    outline: none;
    /* Bỏ viền focus mặc định */
    transition: all 0.3s;
    /* Hiệu ứng */
}

.comment-input:focus {
    border-color: #667eea;
    /* Viền xanh khi focus */
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    /* Bóng xanh */
}

.comment-submit {
    width: 44px;
    /* Chiều rộng nút */
    height: 44px;
    /* Chiều cao nút */
    border: none;
    /* Bỏ viền */
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient */
    color: white;
    /* Màu trắng */
    border-radius: 50%;
    /* Hình tròn */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: center;
    /* Căn giữa ngang */
}

.comment-submit:hover {
    transform: scale(1.1);
    /* Phóng to khi hover */
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    /* Bóng xanh */
}

/* Load More: Nút tải thêm */
.load-more-container {
    text-align: center;
    /* Căn giữa */
    padding: 30px 0;
    /* Khoảng đệm trên dưới */
}

.load-more-btn {
    padding: 14px 32px;
    /* Khoảng đệm */
    border: 2px solid #667eea;
    /* Viền xanh */
    background: white;
    /* Nền trắng */
    color: #667eea;
    /* Màu xanh */
    border-radius: 30px;
    /* Bo góc lớn */
    font-weight: 700;
    /* Độ đậm cao */
    font-size: 15px;
    /* Kích thước chữ */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    display: inline-flex;
    /* Flexbox inline */
    align-items: center;
    /* Căn giữa dọc */
    gap: 8px;
    /* Khoảng cách */
}

.load-more-btn:hover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient khi hover */
    color: white;
    /* Màu trắng */
    transform: translateY(-2px);
    /* Nâng lên */
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.3);
    /* Bóng xanh */
}

/* ================= MODAL ================= */
/* Phần modal: Cửa sổ popup */
.modal-overlay {
    display: none;
    /* Ẩn mặc định */
    position: fixed;
    /* Vị trí cố định */
    top: 0;
    /* Đỉnh màn hình */
    left: 0;
    /* Trái màn hình */
    right: 0;
    /* Phải màn hình */
    bottom: 0;
    /* Đáy màn hình */
    background: rgba(0, 0, 0, 0.6);
    /* Nền đen mờ */
    backdrop-filter: blur(5px);
    /* Lọc mờ nền */
    z-index: 1000;
    /* Lớp cao nhất */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: center;
    /* Căn giữa ngang */
    padding: 20px;
    /* Khoảng đệm */
}

.modal-overlay.active {
    display: flex;
    /* Hiển thị khi active */
}

.modal-content {
    background: white;
    /* Nền trắng */
    border-radius: 24px;
    /* Bo góc lớn */
    width: 100%;
    /* Đầy đủ chiều rộng */
    max-width: 600px;
    /* Chiều rộng tối đa */
    max-height: 90vh;
    /* Chiều cao tối đa 90% viewport */
    overflow-y: auto;
    /* Cuộn dọc nếu tràn */
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    /* Bóng đổ mạnh */
    animation: modalSlideIn 0.3s ease;
    /* Hiệu ứng slide in */
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        /* Mờ ban đầu */
        transform: translateY(-50px);
        /* Dịch lên trên */
    }

    to {
        opacity: 1;
        /* Rõ ràng */
        transform: translateY(0);
        /* Vị trí gốc */
    }
}

.modal-header {
    display: flex;
    /* Flexbox */
    justify-content: space-between;
    /* Căn đều hai bên */
    align-items: center;
    /* Căn giữa dọc */
    padding: 24px;
    /* Khoảng đệm */
    border-bottom: 1px solid #e9ecef;
    /* Viền dưới xám */
}

.modal-header h2 {
    font-size: 24px;
    /* Kích thước tiêu đề */
    font-weight: 700;
    /* Độ đậm cao */
    color: #222;
    /* Màu đen */
}

.modal-close {
    width: 40px;
    /* Chiều rộng nút */
    height: 40px;
    /* Chiều cao nút */
    border: none;
    /* Bỏ viền */
    background: #f8f9fa;
    /* Nền xám nhạt */
    border-radius: 50%;
    /* Hình tròn */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    display: flex;
    /* Flexbox */
    align-items: center;
    /* Căn giữa dọc */
    justify-content: center;
    /* Căn giữa ngang */
    color: #6c757d;
    /* Màu xám */
}

.modal-close:hover {
    background: #e9ecef;
    /* Nền xám khi hover */
    color: #222;
    /* Màu đen */
}

.modal-body {
    padding: 24px;
    /* Khoảng đệm */
}

.modal-footer {
    display: flex;
    /* Flexbox ngang */
    gap: 12px;
    /* Khoảng cách */
    justify-content: flex-end;
    /* Căn phải */
    padding: 24px;
    /* Khoảng đệm */
    border-top: 1px solid #e9ecef;
    /* Viền trên xám */
}

/* Form Elements: Các phần tử form trong modal */
.post-form {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 20px;
    /* Khoảng cách */
}

.form-group {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 8px;
    /* Khoảng cách */
}

.form-group label {
    font-weight: 600;
    /* Độ đậm */
    color: #222;
    /* Màu đen */
    font-size: 14px;
    /* Kích thước */
}

.form-select,
.form-input,
.form-textarea {
    padding: 12px 16px;
    /* Khoảng đệm */
    border: 2px solid #e9ecef;
    /* Viền xám */
    border-radius: 12px;
    /* Bo góc */
    font-size: 15px;
    /* Kích thước chữ */
    font-family: inherit;
    /* Kế thừa font */
    outline: none;
    /* Bỏ viền focus mặc định */
    transition: all 0.3s;
    /* Hiệu ứng */
}

.form-select:focus,
.form-input:focus,
.form-textarea:focus {
    border-color: #667eea;
    /* Viền xanh khi focus */
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    /* Bóng xanh */
}

.form-textarea {
    resize: vertical;
    /* Chỉ resize dọc */
    min-height: 120px;
    /* Chiều cao tối thiểu */
}

.image-upload {
    display: flex;
    /* Flexbox dọc */
    flex-direction: column;
    /* Hướng cột */
    gap: 12px;
    /* Khoảng cách */
}

.upload-btn {
    padding: 12px 20px;
    /* Khoảng đệm */
    border: 2px dashed #667eea;
    /* Viền đứt nét xanh */
    background: #f7f9ff;
    /* Nền xanh nhạt */
    border-radius: 12px;
    /* Bo góc */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
    font-size: 14px;
    /* Kích thước chữ */
    font-weight: 600;
    /* Độ đậm */
    color: #667eea;
    /* Màu xanh */
    display: inline-flex;
    /* Flexbox inline */
    align-items: center;
    /* Căn giữa dọc */
    gap: 8px;
    /* Khoảng cách */
    width: fit-content;
    /* Chiều rộng tự động */
}

.upload-btn:hover {
    background: #e4edff;
    /* Nền xanh đậm hơn khi hover */
    border-color: #764ba2;
    /* Viền tím */
}

.btn-cancel,
.btn-submit {
    padding: 12px 24px;
    /* Khoảng đệm */
    border: none;
    /* Bỏ viền */
    border-radius: 12px;
    /* Bo góc */
    font-weight: 600;
    /* Độ đậm */
    font-size: 15px;
    /* Kích thước chữ */
    cursor: pointer;
    /* Con trỏ tay */
    transition: all 0.3s;
    /* Hiệu ứng */
}

.btn-cancel {
    background: #f8f9fa;
    /* Nền xám nhạt cho hủy */
    color: #6c757d;
    /* Màu xám */
}

.btn-cancel:hover {
    background: #e9ecef;
    /* Nền xám khi hover */
}

.btn-submit {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    /* Nền gradient cho submit */
    color: white;
    /* Màu trắng */
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    /* Bóng xanh */
}

.btn-submit:hover {
    transform: translateY(-2px);
    /* Nâng lên khi hover */
    box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
    /* Bóng mạnh hơn */
}

/* ================= RESPONSIVE ================= */
/* Phần responsive: Thiết kế thích ứng với các kích thước màn hình khác nhau */
@media (max-width: 1200px) {
    .community-main {
        grid-template-columns: 280px 1fr;
        /* Giảm chiều rộng sidebar trên màn hình lớn */
    }
}

@media (max-width: 992px) {
    .community-main {
        display: flex;
        /* Chuyển sang flex để điều khiển thứ tự */
        flex-direction: column;
        /* Một cột trên tablet/mobile */
    }

    .community-sidebar {
        position: relative;
        /* Bỏ sticky */
        top: 0;
        /* Vị trí gốc */
        order: 1;
        /* Sidebar lên trước feed */
    }

    .posts-feed {
        order: 2;
        /* Feed sau sidebar */
    }

    .hero-stats {
        gap: 20px;
        /* Giảm khoảng cách thống kê */
    }

    .hero-illustration {
        display: none;
        /* Ẩn minh họa trên tablet */
    }
}

@media (max-width: 768px) {
    .community-container {
        /* Giữ khoảng trống trên cùng bằng chiều cao navbar để nội dung không bị che */
        padding: 86px 15px 15px;
        /* top right/left bottom */
    }

    .community-hero {
        padding: 80px 24px 40px;
        /* Tăng top để không bị navbar che */
        flex-direction: column;
        /* Chuyển sang cột */
        text-align: center;
        /* Căn giữa chữ */
    }

    .hero-title {
        font-size: 32px;
        /* Giảm kích thước tiêu đề */
        line-height: 1.25;
        overflow-wrap: anywhere;
        /* Xuống dòng linh hoạt */
        word-break: break-word;
        /* Phòng từ quá dài */
    }

    .hero-subtitle {
        font-size: 16px;
        /* Giảm kích thước phụ đề */
        line-height: 1.5;
        margin-bottom: 18px;
        /* Tạo khoảng cách rõ ràng với stats */
    }

    /* Ẩn thống kê trên mobile để tránh che chữ */
    .hero-stats {
        display: none !important;
    }

    .hero-stats {
        justify-content: center;
        /* Căn giữa thống kê */
        gap: 30px;
        /* Khoảng cách */
    }

    .feed-tabs {
        flex-wrap: wrap;
        /* Cho phép xuống dòng tab */
    }

    .post-actions {
        flex-direction: column;
        /* Chuyển nút hành động sang cột */
    }

    .post-images {
        grid-template-columns: 1fr;
        /* Một cột hình ảnh */
    }

    .categories-list {
        display: grid;
        /* Lưới cho danh mục */
        grid-template-columns: repeat(2, 1fr);
        /* Hai cột */
    }

    .trending-list,
    .contributors-list {
        display: grid;
        /* Lưới cho trending và contributors */
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        /* Tự động cột */
    }

    /* Giữ hero đứng yên trên mobile: tắt animation và phần tử nổi */
    .community-hero::before,
    .community-hero::after {
        animation: none !important;
        display: none !important;
        /* Ẩn các hình tròn động để không gây xê dịch */
    }

    .floating-card {
        animation: none !important;
        /* Tắt hiệu ứng nổi */
        transform: none !important;
        /* Tránh dịch chuyển */
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 28px;
        /* Giảm thêm tiêu đề trên mobile nhỏ */
    }

    .hero-stats {
        gap: 15px;
        /* Giảm khoảng cách thống kê */
    }

    .stat-number {
        font-size: 24px;
        /* Giảm kích thước số */
    }

    .post-card {
        padding: 18px;
        /* Giảm padding bài viết */
    }

    .post-title {
        font-size: 18px;
        /* Giảm tiêu đề bài viết */
    }

    .modal-content {
        margin: 10px;
        /* Thêm lề modal */
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 18px;
        /* Giảm padding modal */
    }
}
    </style>
</head>
<body>


    <!-- Container chính bao bọc toàn bộ nội dung trang cộng đồng -->
    <div class="community-container">
        <!-- Phần Hero Section: Phần giới thiệu nổi bật ở đầu trang -->
        <section class="community-hero">
            <div class="hero-content">
                <h1 class="hero-title">Cộng Đồng Health<span>Fit</span></h1>
                <p class="hero-subtitle">Kết nối, chia sẻ và cùng nhau đạt mục tiêu sức khỏe!</p>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-number">12.5K+</div>
                        <div class="stat-label">Thành viên</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5.2K+</div>
                        <div class="stat-label">Bài viết</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">18.7K+</div>
                        <div class="stat-label">Tương tác</div>
                    </div>
                </div>

                <!-- Nút tạo bài viết -->
                @auth
                    <button class="create-post-btn" id="createPostBtn">
                        <i class="fas fa-plus"></i> Tạo bài viết mới
                    </button>
                @else
                    <a href="{{ route('login') }}" class="create-post-btn">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập để tham gia
                    </a>
                @endif
            </div>

            <div class="hero-illustration">
                <div class="floating-card card-1">
                    <i class="fas fa-heart"></i>
                    <span>Động viên</span>
                </div>
                <div class="floating-card card-2">
                    <i class="fas fa-trophy"></i>
                    <span>Thành tích</span>
                </div>
                <div class="floating-card card-3">
                    <i class="fas fa-users"></i>
                    <span>Cộng đồng</span>
                </div>
            </div>
        </section>

        <!-- Nội dung chính -->
        <div class="community-main">
            <aside class="community-sidebar">
                <!-- Sidebar widgets removed as per request -->
            </aside>

            <!-- Phần bài viết -->
            <div class="posts-feed">
                <div class="feed-tabs">
                    <button class="feed-tab active" data-filter="all"><i class="fas fa-stream"></i> Tất cả</button>
                    <button class="feed-tab" data-filter="following"><i class="fas fa-user-check"></i> Đang theo dõi</button>
                    <button class="feed-tab" data-filter="popular"><i class="fas fa-fire"></i> Phổ biến</button>
                    <button class="feed-tab" data-filter="recent"><i class="fas fa-clock"></i> Mới nhất</button>
                </div>

                <div class="posts-list" id="postsList">
                    @foreach ($posts as $post)
                    <article class="post-card" data-category="all">
                        <div class="post-header">
                            <div class="post-author">
                                @php
                                    $avatar = $post->account->avatar ?? null;
                                    $avatarUrl = $avatar 
                                        ? (Str::startsWith($avatar, 'http') ? $avatar : asset('storage/' . $avatar)) 
                                        : 'https://i.pravatar.cc/150?u=' . ($post->accountID ?? '0');
                                    $authorName = $post->account->fullname ?? 'Người dùng #' . ($post->accountID ?? 'Unknown');
                                @endphp
                                <img src="{{ $avatarUrl }}" alt="Author" class="author-avatar">
                                <div class="author-info">
                                    <div class="author-name">{{ $authorName }}</div>
                                    <div class="post-time">{{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="post-content">
                            <h3 class="post-title">{{ $post->title ?? 'Bài viết không tiêu đề' }}</h3>
                            <p class="post-text">{{ $post->content }}</p>
                            @if ($post->img)
                                <div class="post-images">
                                    <img src="{{ asset('storage/' . $post->img) }}" alt="Ảnh bài viết">
                                </div>
                            @endif
                        </div>

                        <!-- Interaction and comments removed as per request -->
                    </article>
                    @endforeach

                    @if ($posts->isEmpty())
                        <p style="text-align:center; margin-top:20px;">Chưa có bài viết nào!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tạo bài viết mới -->
    <div class="modal-overlay" id="createPostModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tạo bài viết mới</h2>
                <button class="modal-close" id="closeModal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form action="{{ route('community.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="post-form">

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input type="text" class="form-input" name="title" placeholder="Nhập tiêu đề bài viết..." required>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-textarea" name="content" rows="6" placeholder="Chia sẻ suy nghĩ của bạn..." required></textarea>
                        </div>

                        <div class="form-group">
                        <label>Hình ảnh</label>
                        <div class="image-upload">
                            <input type="file" name="img" id="imageUpload" accept="image/*" style="display: none;">
                            <button type="button" class="upload-btn" onclick="document.getElementById('imageUpload').click()">
                                <i class="fas fa-image"></i> Chọn hình ảnh
                            </button>
                        </div>
                        <img id="previewImage" src="" alt="Xem trước ảnh" style="display:none; margin-top:10px; max-width:200px;">
                    </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-cancel" id="cancelPost">Hủy</button>
                    <button type="submit" class="btn-submit">Đăng bài</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ================= CHỨC NĂNG MODAL =================
// Phần xử lý modal tạo bài viết mới
const createPostBtn = document.getElementById('createPostBtn'); // Lấy nút tạo bài viết
const createPostModal = document.getElementById('createPostModal'); // Lấy modal tạo bài viết
const closeModal = document.getElementById('closeModal'); // Lấy nút đóng modal
const cancelPost = document.getElementById('cancelPost'); // Lấy nút hủy bài viết

if (createPostBtn) { // Kiểm tra nút tồn tại
    createPostBtn.addEventListener('click', () => { // Thêm sự kiện click cho nút tạo bài
        createPostModal.classList.add('active'); // Hiển thị modal bằng cách thêm class active
        document.body.style.overflow = 'hidden'; // Ẩn thanh cuộn body để tránh cuộn khi modal mở
    });
}

if (closeModal) { // Kiểm tra nút đóng tồn tại
    closeModal.addEventListener('click', () => { // Thêm sự kiện click cho nút đóng
        createPostModal.classList.remove('active'); // Ẩn modal bằng cách xóa class active
        document.body.style.overflow = ''; // Khôi phục thanh cuộn body
    });
}

if (cancelPost) { // Kiểm tra nút hủy tồn tại
    cancelPost.addEventListener('click', () => { // Thêm sự kiện click cho nút hủy
        createPostModal.classList.remove('active'); // Ẩn modal
        document.body.style.overflow = ''; // Khôi phục thanh cuộn
    });
}

// Đóng modal khi click bên ngoài
if (createPostModal) { // Kiểm tra modal tồn tại
    createPostModal.addEventListener('click', (e) => { // Thêm sự kiện click cho modal
        if (e.target === createPostModal) { // Kiểm tra click vào overlay (không phải nội dung)
            createPostModal.classList.remove('active'); // Ẩn modal
            document.body.style.overflow = ''; // Khôi phục thanh cuộn
        }
    });
}

// ================= LỌC DANH MỤC =================
// Phần lọc bài viết theo danh mục
const categoryButtons = document.querySelectorAll('.category-btn'); // Lấy tất cả nút danh mục
const postCards = document.querySelectorAll('.post-card'); // Lấy tất cả bài viết

categoryButtons.forEach(button => { // Duyệt qua từng nút danh mục
    button.addEventListener('click', () => { // Thêm sự kiện click cho nút
        // Xóa class active từ tất cả nút
        categoryButtons.forEach(btn => btn.classList.remove('active'));
        // Thêm class active cho nút được click
        button.classList.add('active');
        
        const category = button.getAttribute('data-category'); // Lấy thuộc tính data-category của nút
        
        // Lọc bài viết
        postCards.forEach(card => { // Duyệt qua từng bài viết
            if (category === 'all') { // Nếu là danh mục tất cả
                card.style.display = 'block'; // Hiển thị bài viết
                card.style.animation = 'fadeIn 0.5s ease-out'; // Áp dụng hiệu ứng fade in
            } else { // Nếu không phải tất cả
                const cardCategory = card.getAttribute('data-category'); // Lấy danh mục của bài viết
                if (cardCategory === category) { // Nếu khớp danh mục
                    card.style.display = 'block'; // Hiển thị
                    card.style.animation = 'fadeIn 0.5s ease-out'; // Hiệu ứng fade in
                } else { // Không khớp
                    card.style.display = 'none'; // Ẩn bài viết
                }
            }
        });
        
        // Cập nhật số lượng bài viết hiển thị
        updateVisiblePostsCount();
    });
});

// ================= LỌC TAB FEED =================
// Phần lọc và sắp xếp feed theo tab
const feedTabs = document.querySelectorAll('.feed-tab'); // Lấy tất cả tab feed

feedTabs.forEach(tab => { // Duyệt qua từng tab
    tab.addEventListener('click', () => { // Thêm sự kiện click cho tab
        // Xóa class active từ tất cả tab
        feedTabs.forEach(t => t.classList.remove('active'));
        // Thêm class active cho tab được click
        tab.classList.add('active');
        
        const filter = tab.getAttribute('data-filter'); // Lấy thuộc tính data-filter của tab
        
        // Sắp xếp và lọc bài viết dựa trên filter
        let sortedPosts = Array.from(postCards); // Chuyển postCards thành mảng để sắp xếp
        
        switch(filter) { // Sử dụng switch để xử lý các loại filter
            case 'popular': // Nếu là phổ biến
                // Sắp xếp theo like (lấy từ dữ liệu thực tế)
                sortedPosts.sort((a, b) => { // Sắp xếp giảm dần theo like
                    const likesA = parseInt(a.querySelector('.stat-item span')?.textContent || '0'); // Lấy số like bài A
                    const likesB = parseInt(b.querySelector('.stat-item span')?.textContent || '0'); // Lấy số like bài B
                    return likesB - likesA; // Trả về giá trị để sắp xếp
                });
                break;
            case 'recent': // Nếu là mới nhất
                // Sắp xếp theo thời gian (mới nhất trước) - cần dữ liệu timestamp thực tế
                sortedPosts.reverse(); // Đảo ngược mảng (demo)
                break;
            case 'following': // Nếu là đang theo dõi
                // Lọc bài theo dõi (cần dữ liệu theo dõi thực tế)
                // Demo: hiển thị tất cả
                break;
            default: // Mặc định
                // Hiển thị tất cả theo thứ tự mặc định
                break;
        }
        
        // Sắp xếp lại bài viết trong DOM
        const postsList = document.getElementById('postsList'); // Lấy container danh sách bài viết
        sortedPosts.forEach(post => { // Duyệt qua mảng đã sắp xếp
            postsList.appendChild(post); // Thêm bài viết vào cuối container
            post.style.animation = 'fadeIn 0.5s ease-out'; // Áp dụng hiệu ứng fade in
        });
        
        // Hiển thị tất cả bài viết
        postCards.forEach(card => {
            card.style.display = 'block'; // Hiển thị
        });
    });
});

// ================= CHỨC NĂNG THÍCH =================
// Phần xử lý nút thích bài viết
const likeButtons = document.querySelectorAll('.like-btn'); // Lấy tất cả nút thích

likeButtons.forEach(button => { // Duyệt qua từng nút thích
    button.addEventListener('click', (e) => { // Thêm sự kiện click
        e.stopPropagation(); // Ngăn sự kiện lan tỏa
        const isLiked = button.getAttribute('data-liked') === 'true'; // Kiểm tra đã thích chưa
        const heartIcon = button.querySelector('i'); // Lấy icon tim
        const postCard = button.closest('.post-card'); // Lấy post card
        const statItem = postCard.querySelector('.post-stats .stat-item'); // Lấy item thống kê like từ post card
        const likeCount = statItem.querySelector('span'); // Lấy span số like
        let count = parseInt(likeCount.textContent); // Chuyển số like thành số nguyên
        
        if (isLiked) { // Nếu đã thích
            // Bỏ thích
            button.setAttribute('data-liked', 'false'); // Cập nhật thuộc tính
            button.classList.remove('liked'); // Xóa class liked
            heartIcon.classList.remove('fas'); // Đổi icon thành rỗng
            heartIcon.classList.add('far');
            count--; // Giảm số like
            button.innerHTML = '<i class="far fa-heart"></i> Thích'; // Cập nhật text nút
        } else { // Nếu chưa thích
            // Thích
            button.setAttribute('data-liked', 'true'); // Cập nhật thuộc tính
            button.classList.add('liked'); // Thêm class liked
            heartIcon.classList.remove('far'); // Đổi icon thành đầy
            heartIcon.classList.add('fas');
            count++; // Tăng số like
            button.innerHTML = '<i class="fas fa-heart"></i> Đã thích'; // Cập nhật text nút
        }
        
        // Cập nhật số lượng với hiệu ứng
        likeCount.textContent = count; // Cập nhật số
        likeCount.style.transform = 'scale(1.2)'; // Phóng to hiệu ứng
        setTimeout(() => { // Sau 200ms
            likeCount.style.transform = 'scale(1)'; // Thu nhỏ về bình thường
        }, 200);
    });
});

// ================= CHỨC NĂNG BÌNH LUẬN =================
// Phần xử lý nút bình luận
const commentButtons = document.querySelectorAll('.comment-btn'); // Lấy tất cả nút bình luận
const commentForms = document.querySelectorAll('.post-comments'); // Lấy tất cả form bình luận

commentButtons.forEach((button, index) => { // Duyệt qua từng nút bình luận
    button.addEventListener('click', () => { // Thêm sự kiện click
        const commentSection = button.closest('.post-card').querySelector('.post-comments'); // Lấy phần bình luận của bài viết
        const commentInput = commentSection.querySelector('.comment-input'); // Lấy input bình luận
        
        if (commentSection.style.display === 'none' || !commentSection.style.display) { // Nếu phần bình luận ẩn
            commentSection.style.display = 'block'; // Hiển thị
            commentInput.focus(); // Focus vào input
            commentSection.style.animation = 'fadeIn 0.3s ease-out'; // Hiệu ứng fade in
        } else { // Nếu hiển thị
            commentSection.style.display = 'none'; // Ẩn
        }
    });
});

// Gửi bình luận
document.querySelectorAll('.comment-submit').forEach(button => { // Duyệt qua từng nút gửi bình luận
    button.addEventListener('click', (e) => { // Thêm sự kiện click
        e.preventDefault(); // Ngăn hành vi mặc định
        const input = button.previousElementSibling; // Lấy input trước nút
        const commentText = input.value.trim(); // Lấy text bình luận, loại bỏ khoảng trắng
        
        if (commentText) { // Nếu có text
            // Ở đây sẽ gửi bình luận lên server
            // Demo: hiển thị alert
            alert('Bình luận đã được gửi: ' + commentText);
            input.value = ''; // Xóa input
            
            // Trong app thực tế, sẽ thêm bình luận vào DOM
        }
    });
});

// Phím Enter để gửi bình luận
document.querySelectorAll('.comment-input').forEach(input => { // Duyệt qua từng input bình luận
    input.addEventListener('keypress', (e) => { // Thêm sự kiện nhấn phím
        if (e.key === 'Enter') { // Nếu là phím Enter
            const submitBtn = input.nextElementSibling; // Lấy nút gửi sau input
            submitBtn.click(); // Kích hoạt click nút gửi
        }
    });
});

// ================= CHỨC NĂNG CHIA SẺ =================
// Phần xử lý nút chia sẻ
const shareButtons = document.querySelectorAll('.share-btn'); // Lấy tất cả nút chia sẻ

shareButtons.forEach(button => { // Duyệt qua từng nút chia sẻ
    button.addEventListener('click', () => { // Thêm sự kiện click
        // Kiểm tra Web Share API có sẵn không
        if (navigator.share) { // Nếu hỗ trợ chia sẻ native
            const postCard = button.closest('.post-card'); // Lấy bài viết chứa nút
            const postTitle = postCard.querySelector('.post-title').textContent; // Lấy tiêu đề bài viết
            
            navigator.share({ // Gọi API chia sẻ
                title: postTitle, // Tiêu đề
                text: postCard.querySelector('.post-text').textContent.substring(0, 100) + '...', // Text rút gọn
                url: window.location.href // URL hiện tại
            }).catch(err => { // Xử lý lỗi
                console.log('Error sharing:', err);
            });
        } else { // Nếu không hỗ trợ
            // Fallback: Sao chép vào clipboard
            const postUrl = window.location.href; // URL bài viết
            navigator.clipboard.writeText(postUrl).then(() => { // Sao chép URL
                // Hiển thị phản hồi tạm thời
                const originalText = button.innerHTML; // Lưu text gốc
                button.innerHTML = '<i class="fas fa-check"></i> Đã sao chép'; // Thay đổi text
                button.style.background = '#d1fae5'; // Đổi nền xanh lá
                button.style.color = '#065f46'; // Đổi màu chữ xanh lá
                
                setTimeout(() => { // Sau 2 giây
                    button.innerHTML = originalText; // Khôi phục text gốc
                    button.style.background = ''; // Khôi phục nền
                    button.style.color = ''; // Khôi phục màu chữ
                }, 2000);
            });
        }
    });
});

// ================= CHỨC NĂNG TÌM KIẾM =================
// Phần xử lý ô tìm kiếm
const searchInput = document.getElementById('searchInput'); // Lấy input tìm kiếm

if (searchInput) { // Kiểm tra input tồn tại
    let searchTimeout; // Biến timeout cho debounce
    
    searchInput.addEventListener('input', (e) => { // Thêm sự kiện input
        clearTimeout(searchTimeout); // Xóa timeout cũ
        const query = e.target.value.toLowerCase().trim(); // Lấy query, chuyển thường và loại bỏ khoảng trắng
        
        searchTimeout = setTimeout(() => { // Đợi 300ms sau khi ngừng gõ
            if (query === '') { // Nếu query rỗng
                // Hiển thị tất cả bài viết
                postCards.forEach(card => { // Duyệt qua từng bài viết
                    card.style.display = 'block'; // Hiển thị
                    card.style.animation = 'fadeIn 0.5s ease-out'; // Hiệu ứng fade in
                });
            } else { // Nếu có query
                // Lọc bài viết
                postCards.forEach(card => { // Duyệt qua từng bài viết
                    const title = card.querySelector('.post-title').textContent.toLowerCase(); // Tiêu đề thường
                    const text = card.querySelector('.post-text').textContent.toLowerCase(); // Nội dung thường
                    const author = card.querySelector('.author-name').textContent.toLowerCase(); // Tác giả thường
                    
                    if (title.includes(query) || text.includes(query) || author.includes(query)) { // Nếu khớp query
                        card.style.display = 'block'; // Hiển thị
                        card.style.animation = 'fadeIn 0.5s ease-out'; // Hiệu ứng
                    } else { // Không khớp
                        card.style.display = 'none'; // Ẩn
                    }
                });
            }
            
            updateVisiblePostsCount(); // Cập nhật số lượng bài hiển thị
        }, 300);
    });
}

// ================= CHỨC NĂNG TẢI THÊM =================
// Phần xử lý nút tải thêm bài viết
const loadMoreBtn = document.getElementById('loadMoreBtn'); // Lấy nút tải thêm

if (loadMoreBtn) { // Kiểm tra nút tồn tại
    let postsLoaded = postCards.length; // Số bài đã tải
    const postsPerLoad = 3; // Số bài tải mỗi lần
    
    loadMoreBtn.addEventListener('click', () => { // Thêm sự kiện click
        // Mô phỏng tải thêm bài viết
        // Trong app thực tế, sẽ fetch từ server
        loadMoreBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang tải...'; // Thay đổi text thành đang tải
        loadMoreBtn.disabled = true; // Vô hiệu hóa nút
        
        setTimeout(() => { // Sau 1 giây
            // Demo: hiển thị alert
            alert('Đã tải thêm bài viết! (Tính năng demo)');
            loadMoreBtn.innerHTML = '<i class="fas fa-chevron-down"></i> Tải thêm bài viết'; // Khôi phục text
            loadMoreBtn.disabled = false; // Kích hoạt lại nút
            
            // Trong app thực tế, sẽ thêm bài viết mới vào đây
        }, 1000);
    });
}

// ================= CLICK VÀO CHỦ ĐỀ THỊNH HÀNH =================
// Phần xử lý click vào item thịnh hành
const trendingItems = document.querySelectorAll('.trending-item'); // Lấy tất cả item thịnh hành

trendingItems.forEach(item => { // Duyệt qua từng item
    item.addEventListener('click', () => { // Thêm sự kiện click
        const trendText = item.querySelector('.trend-text').textContent; // Lấy text chủ đề
        if (searchInput) { // Nếu có input tìm kiếm
            searchInput.value = trendText; // Đặt query vào input
            searchInput.dispatchEvent(new Event('input')); // Kích hoạt sự kiện input để tìm kiếm
        }
    });
});

// ================= HÀM HỖ TRỢ =================
// Các hàm tiện ích
function updateVisiblePostsCount() { // Hàm cập nhật số lượng bài viết hiển thị
    const visiblePosts = Array.from(postCards).filter(card => { // Lọc bài viết hiển thị
        return card.style.display !== 'none'; // Không bị ẩn
    }).length; // Đếm số lượng
    
    // Có thể cập nhật element đếm ở đây nếu cần
    console.log(`Showing ${visiblePosts} posts`); // In ra console (demo)
}

// ================= XEM TRƯỚC HÌNH ẢNH (CẢI TIẾN TƯƠNG LAI) =================
// Phần xử lý click vào hình ảnh bài viết
const postImages = document.querySelectorAll('.post-images img'); // Lấy tất cả hình ảnh bài viết

postImages.forEach(img => { // Duyệt qua từng hình ảnh
    img.addEventListener('click', () => { // Thêm sự kiện click
        // Có thể triển khai lightbox/xem ảnh ở đây
        // Hiện tại: chỉ in URL ảnh
        console.log('Image clicked:', img.src); // In ra console
    });
});

// ================= HIỆU ỨNG CUỘN =================
// Phần hiệu ứng khi cuộn đến phần tử
const observerOptions = { // Cấu hình Intersection Observer
    threshold: 0.1, // Kích hoạt khi 10% phần tử vào viewport
    rootMargin: '0px 0px -50px 0px' // Lề gốc
};

const observer = new IntersectionObserver((entries) => { // Tạo observer
    entries.forEach(entry => { // Duyệt qua từng entry
        if (entry.isIntersecting) { // Nếu phần tử vào viewport
            entry.target.style.opacity = '1'; // Hiển thị
            entry.target.style.transform = 'translateY(0)'; // Di chuyển về vị trí gốc
        }
    });
}, observerOptions); // Truyền options

// Quan sát các bài viết
postCards.forEach(card => { // Duyệt qua từng bài viết
    card.style.opacity = '0'; // Ẩn ban đầu
    card.style.transform = 'translateY(20px)'; // Dịch xuống dưới
    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease'; // Hiệu ứng chuyển tiếp
    observer.observe(card); // Bắt đầu quan sát
});

// ================= PHÍM TẮT BÀN PHÍM =================
// Phần xử lý phím tắt
document.addEventListener('keydown', (e) => { // Thêm sự kiện nhấn phím toàn cục
    // Nhấn 'K' + Ctrl/Meta để focus tìm kiếm
    if (e.key === 'k' && (e.ctrlKey || e.metaKey)) { // Kiểm tra phím K với Ctrl hoặc Cmd
        e.preventDefault(); // Ngăn hành vi mặc định
        if (searchInput) { // Nếu có input tìm kiếm
            searchInput.focus(); // Focus vào input
        }
    }
    
    // Nhấn 'Esc' để đóng modal
    if (e.key === 'Escape' && createPostModal && createPostModal.classList.contains('active')) { // Kiểm tra phím Esc và modal đang mở
        createPostModal.classList.remove('active'); // Ẩn modal
        document.body.style.overflow = ''; // Khôi phục thanh cuộn
    }
});

// ================= CHUYỂN ĐỔI MENU =================
// Hàm khởi tạo chuyển đổi menu
function initMenuToggle() { // Hàm khởi tạo menu toggle
    const menuToggle = document.getElementById('menu-toggle'); // Lấy nút toggle menu
    const menu = document.getElementById('menu'); // Lấy menu
    if (menuToggle && menu) { // Kiểm tra tồn tại
        menuToggle.addEventListener('click', () => { // Thêm sự kiện click
            menu.classList.toggle('show'); // Chuyển đổi class show
        });
        
        // Đóng menu khi click bên ngoài
        document.addEventListener('click', (e) => { // Sự kiện click toàn cục
            if (!menu.contains(e.target) && !menuToggle.contains(e.target)) { // Nếu click không vào menu hoặc nút
                menu.classList.remove('show'); // Ẩn menu
            }
        });
    }
}

// ================= KHỞI TẠO =================
// Phần khởi tạo khi DOM tải xong
document.addEventListener('DOMContentLoaded', () => { // Sự kiện DOM sẵn sàng
    // Khởi tạo chuyển đổi menu
    initMenuToggle(); // Gọi hàm khởi tạo menu
    
    // Ẩn tất cả phần bình luận ban đầu
    commentForms.forEach(form => { // Duyệt qua từng form bình luận
        form.style.display = 'none'; // Ẩn
    });
    
    // Thiết lập xem trước upload ảnh (nếu cần)
    const imageUpload = document.getElementById('imageUpload');
    if (imageUpload) {
        const preview = document.getElementById('previewImage');
        imageUpload.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
                preview.src = '';
            }
        });
    }

    
    console.log('Community page initialized!'); // In thông báo khởi tạo xong
});

// ================= THÊM HIỆU ỨNG FADE IN =================
// Phần thêm CSS animation fade in
const style = document.createElement('style'); // Tạo element style mới
style.textContent = ` // Nội dung CSS
    @keyframes fadeIn { // Định nghĩa keyframes fadeIn
        from {
            opacity: 0; // Bắt đầu mờ
            transform: translateY(20px); // Dịch xuống dưới
        }
        to {
            opacity: 1; // Kết thúc rõ
            transform: translateY(0); // Vị trí gốc
        }
    }
`; // Kết thúc CSS
document.head.appendChild(style); // Thêm style vào head
    </script>

@endsection

</body>
</html>