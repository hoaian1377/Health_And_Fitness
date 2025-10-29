@extends('base')
@section('content')
<!DOCTYPE html>
<html lang="vi">
<head>
    <!-- Phần khai báo meta và liên kết tài nguyên -->
    <meta charset="UTF-8"> <!-- Định dạng ký tự UTF-8 để hỗ trợ tiếng Việt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Thiết lập viewport cho thiết bị di động -->
    <title>Cộng Đồng - Health & Fitness App</title> <!-- Tiêu đề trang web -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> <!-- Liên kết thư viện Font Awesome cho icon -->
    <link rel="stylesheet" href="{{ asset('css/community.css') }}"> <!-- Liên kết file CSS tùy chỉnh cho trang cộng đồng -->
</head>
<body>
    <!-- Container chính bao bọc toàn bộ nội dung trang cộng đồng -->
    <div class="community-container">
        <!-- Phần Hero Section: Phần giới thiệu nổi bật ở đầu trang -->
        <section class="community-hero">
            <div class="hero-content"> <!-- Nội dung chính của hero -->
                <h1 class="hero-title">Cộng Đồng Health<span>Fit</span></h1> <!-- Tiêu đề chính với phần span để tùy chỉnh style -->
                <p class="hero-subtitle">Kết nối, chia sẻ và cùng nhau đạt mục tiêu sức khỏe!</p> <!-- Phụ đề mô tả sứ mệnh cộng đồng -->
                <div class="hero-stats"> <!-- Hiển thị thống kê nổi bật -->
                    <div class="stat-item"> <!-- Mỗi item thống kê -->
                        <div class="stat-number">12.5K+</div> <!-- Số lượng thành viên -->
                        <div class="stat-label">Thành viên</div> <!-- Nhãn cho số liệu -->
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">5.2K+</div> <!-- Số lượng bài viết -->
                        <div class="stat-label">Bài viết</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">18.7K+</div> <!-- Số lượng tương tác -->
                        <div class="stat-label">Tương tác</div>
                    </div>
                </div>
                <!-- Nút tạo bài viết, chỉ hiển thị nếu người dùng đã đăng nhập -->
                @auth
                <button class="create-post-btn" id="createPostBtn">
                    <i class="fas fa-plus"></i> Tạo bài viết mới <!-- Icon plus và text nút -->
                </button>
                @else
                <a href="{{ route('login.page') }}" class="create-post-btn"> <!-- Liên kết đến trang đăng nhập nếu chưa auth -->
                    <i class="fas fa-sign-in-alt"></i> Đăng nhập để tham gia
                </a>
                @endauth
            </div>
            <div class="hero-illustration"> <!-- Phần minh họa với các card nổi -->
                <div class="floating-card card-1"> <!-- Card 1: Động viên -->
                    <i class="fas fa-heart"></i> <!-- Icon tim -->
                    <span>Động viên</span>
                </div>
                <div class="floating-card card-2"> <!-- Card 2: Thành tích -->
                    <i class="fas fa-trophy"></i> <!-- Icon cúp -->
                    <span>Thành tích</span>
                </div>
                <div class="floating-card card-3"> <!-- Card 3: Cộng đồng -->
                    <i class="fas fa-users"></i> <!-- Icon nhóm người -->
                    <span>Cộng đồng</span>
                </div>
            </div>
        </section>

        <!-- Nội dung chính của trang cộng đồng -->
        <div class="community-main">
            <!-- Sidebar: Thanh bên trái chứa các widget hỗ trợ -->
            <aside class="community-sidebar">
                <!-- Widget tìm kiếm -->
                <div class="sidebar-widget search-widget">
                    <h3 class="widget-title"> <!-- Tiêu đề widget -->
                        <i class="fas fa-search"></i> Tìm kiếm <!-- Icon tìm kiếm -->
                    </h3>
                    <div class="search-input-wrapper"> <!-- Wrapper cho input tìm kiếm -->
                        <input type="text" id="searchInput" placeholder="Tìm bài viết, người dùng..."> <!-- Ô input tìm kiếm -->
                        <i class="fas fa-search search-icon"></i> <!-- Icon bên trong input -->
                    </div>
                </div>

                <!-- Widget danh mục -->
                <div class="sidebar-widget categories-widget">
                    <h3 class="widget-title">
                        <i class="fas fa-tags"></i> Danh mục <!-- Icon tag -->
                    </h3>
                    <div class="categories-list"> <!-- Danh sách các nút danh mục -->
                        <button class="category-btn active" data-category="all"> <!-- Nút tất cả, đang active -->
                            <i class="fas fa-fire"></i> Tất cả <!-- Icon lửa -->
                            <span class="category-count">124</span> <!-- Số lượng bài viết -->
                        </button>
                        <button class="category-btn" data-category="workout"> <!-- Nút tập luyện -->
                            <i class="fas fa-dumbbell"></i> Tập luyện
                            <span class="category-count">45</span>
                        </button>
                        <button class="category-btn" data-category="nutrition"> <!-- Nút dinh dưỡng -->
                            <i class="fas fa-apple-alt"></i> Dinh dưỡng
                            <span class="category-count">32</span>
                        </button>
                        <button class="category-btn" data-category="motivation"> <!-- Nút động viên -->
                            <i class="fas fa-bullhorn"></i> Động viên
                            <span class="category-count">28</span>
                        </button>
                        <button class="category-btn" data-category="results"> <!-- Nút thành tích -->
                            <i class="fas fa-chart-line"></i> Thành tích
                            <span class="category-count">19</span>
                        </button>
                        <button class="category-btn" data-category="tips"> <!-- Nút mẹo hay -->
                            <i class="fas fa-lightbulb"></i> Mẹo hay
                            <span class="category-count">15</span>
                        </button>
                    </div>
                </div>

                <!-- Widget chủ đề thịnh hành -->
                <div class="sidebar-widget trending-widget">
                    <h3 class="widget-title">
                        <i class="fas fa-trending-up"></i> Đang thịnh hành <!-- Icon xu hướng -->
                    </h3>
                    <div class="trending-list"> <!-- Danh sách chủ đề -->
                        <div class="trending-item"> <!-- Item 1 -->
                            <span class="trend-number">#1</span> <!-- Xếp hạng -->
                            <span class="trend-text">HIIT Training</span> <!-- Tên chủ đề -->
                            <span class="trend-count">2.3K</span> <!-- Số lượng tương tác -->
                        </div>
                        <div class="trending-item"> <!-- Item 2 -->
                            <span class="trend-number">#2</span>
                            <span class="trend-text">Meal Prep Ideas</span>
                            <span class="trend-count">1.8K</span>
                        </div>
                        <div class="trending-item"> <!-- Item 3 -->
                            <span class="trend-number">#3</span>
                            <span class="trend-text">30 Day Challenge</span>
                            <span class="trend-count">1.5K</span>
                        </div>
                        <div class="trending-item"> <!-- Item 4 -->
                            <span class="trend-number">#4</span>
                            <span class="trend-text">Weight Loss Journey</span>
                            <span class="trend-count">1.2K</span>
                        </div>
                        <div class="trending-item"> <!-- Item 5 -->
                            <span class="trend-number">#5</span>
                            <span class="trend-text">Yoga Morning</span>
                            <span class="trend-count">980</span>
                        </div>
                    </div>
                </div>

                <!-- Widget top đóng góp viên -->
                <div class="sidebar-widget contributors-widget">
                    <h3 class="widget-title">
                        <i class="fas fa-star"></i> Top đóng góp <!-- Icon sao -->
                    </h3>
                    <div class="contributors-list"> <!-- Danh sách người dùng -->
                        <div class="contributor-item"> <!-- Item 1 -->
                            <img src="https://i.pravatar.cc/150?img=1" alt="User" class="contributor-avatar"> <!-- Ảnh đại diện -->
                            <div class="contributor-info"> <!-- Thông tin người dùng -->
                                <div class="contributor-name">Nguyễn Văn A</div> <!-- Tên -->
                                <div class="contributor-points">12.5K điểm</div> <!-- Điểm số -->
                            </div>
                            <div class="contributor-badge"> <!-- Huy hiệu -->
                                <i class="fas fa-medal"></i>
                            </div>
                        </div>
                        <div class="contributor-item"> <!-- Item 2 -->
                            <img src="https://i.pravatar.cc/150?img=2" alt="User" class="contributor-avatar">
                            <div class="contributor-info">
                                <div class="contributor-name">Trần Thị B</div>
                                <div class="contributor-points">9.8K điểm</div>
                            </div>
                            <div class="contributor-badge">
                                <i class="fas fa-medal"></i>
                            </div>
                        </div>
                        <div class="contributor-item"> <!-- Item 3 -->
                            <img src="https://i.pravatar.cc/150?img=3" alt="User" class="contributor-avatar">
                            <div class="contributor-info">
                                <div class="contributor-name">Lê Văn C</div>
                                <div class="contributor-points">8.2K điểm</div>
                            </div>
                            <div class="contributor-badge">
                                <i class="fas fa-medal"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Phần feed bài viết chính -->
            <div class="posts-feed">
                <!-- Tab lọc bài viết -->
                <div class="feed-tabs"> <!-- Các nút tab lọc -->
                    <button class="feed-tab active" data-filter="all"> <!-- Tab tất cả, đang active -->
                        <i class="fas fa-stream"></i> Tất cả
                    </button>
                    <button class="feed-tab" data-filter="following"> <!-- Tab đang theo dõi -->
                        <i class="fas fa-user-check"></i> Đang theo dõi
                    </button>
                    <button class="feed-tab" data-filter="popular"> <!-- Tab phổ biến -->
                        <i class="fas fa-fire"></i> Phổ biến
                    </button>
                    <button class="feed-tab" data-filter="recent"> <!-- Tab mới nhất -->
                        <i class="fas fa-clock"></i> Mới nhất
                    </button>
                </div>

                <!-- Danh sách bài viết -->
                <div class="posts-list" id="postsList"> <!-- Container cho các bài viết -->
                    <!-- Bài viết 1: Bài nổi bật, danh mục tập luyện -->
                    <article class="post-card featured" data-category="workout">
                        <div class="post-header"> <!-- Phần đầu bài viết -->
                            <div class="post-author"> <!-- Thông tin tác giả -->
                                <img src="https://i.pravatar.cc/150?img=12" alt="Author" class="author-avatar"> <!-- Ảnh tác giả -->
                                <div class="author-info"> <!-- Chi tiết tác giả -->
                                    <div class="author-name">Fitness Guru</div> <!-- Tên -->
                                    <div class="post-time">2 giờ trước</div> <!-- Thời gian đăng -->
                                </div>
                            </div>
                            <div class="post-category-badge workout"> <!-- Badge danh mục -->
                                <i class="fas fa-dumbbell"></i> Tập luyện
                            </div>
                        </div>
                        <div class="post-content"> <!-- Nội dung bài viết -->
                            <h3 class="post-title">💪 Lộ trình tập HIIT hiệu quả trong 30 ngày!</h3> <!-- Tiêu đề -->
                            <p class="post-text"> <!-- Đoạn văn mô tả -->
                                Sau 3 tháng nghiên cứu và thực hành, mình đã tổng hợp được một lộ trình HIIT 
                                khoa học giúp đốt cháy mỡ hiệu quả. Các bài tập này phù hợp cho mọi cấp độ, 
                                từ người mới bắt đầu đến nâng cao...
                            </p>
                            <div class="post-images"> <!-- Hình ảnh bài viết -->
                                <img src="{{ asset('images/anh1.jpg') }}" alt="Workout"> <!-- Hình 1 -->
                                <img src="{{ asset('images/anh2.jpg') }}" alt="Workout"> <!-- Hình 2 -->
                            </div>
                        </div>
                        <div class="post-stats"> <!-- Thống kê tương tác -->
                            <div class="stat-item">
                                <i class="fas fa-heart"></i>
                                <span>342</span> <!-- Số like -->
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>89</span> <!-- Số comment -->
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-share"></i>
                                <span>23</span> <!-- Số share -->
                            </div>
                        </div>
                        <div class="post-actions"> <!-- Các nút hành động -->
                            <button class="action-btn like-btn" data-liked="false"> <!-- Nút like -->
                                <i class="far fa-heart"></i> Thích
                            </button>
                            <button class="action-btn comment-btn"> <!-- Nút comment -->
                                <i class="far fa-comment"></i> Bình luận
                            </button>
                            <button class="action-btn share-btn"> <!-- Nút share -->
                                <i class="fas fa-share"></i> Chia sẻ
                            </button>
                        </div>
                        <div class="post-comments"> <!-- Phần bình luận -->
                            <div class="comment-form"> <!-- Form nhập comment -->
                                <img src="https://i.pravatar.cc/150?img=5" alt="User" class="comment-avatar"> <!-- Ảnh user -->
                                <input type="text" placeholder="Viết bình luận..." class="comment-input"> <!-- Input text -->
                                <button class="comment-submit"> <!-- Nút gửi -->
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Bài viết 2: Danh mục dinh dưỡng -->
                    <article class="post-card" data-category="nutrition">
                        <div class="post-header">
                            <div class="post-author">
                                <img src="https://i.pravatar.cc/150?img=8" alt="Author" class="author-avatar">
                                <div class="author-info">
                                    <div class="author-name">Nutrition Expert</div>
                                    <div class="post-time">5 giờ trước</div>
                                </div>
                            </div>
                            <div class="post-category-badge nutrition">
                                <i class="fas fa-apple-alt"></i> Dinh dưỡng
                            </div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">🥗 Meal Prep đơn giản cho tuần mới</h3>
                            <p class="post-text">
                                Chia sẻ với mọi người cách mình chuẩn bị bữa ăn cho cả tuần chỉ trong 2 giờ. 
                                Vừa tiết kiệm thời gian, vừa đảm bảo dinh dưỡng đầy đủ!
                            </p>
                            <div class="post-images single"> <!-- Hình ảnh đơn -->
                                <img src="{{ asset('images/nutrition_plan.jpg') }}" alt="Meal Prep">
                            </div>
                        </div>
                        <div class="post-stats">
                            <div class="stat-item">
                                <i class="fas fa-heart"></i>
                                <span>218</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>56</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-share"></i>
                                <span>34</span>
                            </div>
                        </div>
                        <div class="post-actions">
                            <button class="action-btn like-btn" data-liked="false">
                                <i class="far fa-heart"></i> Thích
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="far fa-comment"></i> Bình luận
                            </button>
                            <button class="action-btn share-btn">
                                <i class="fas fa-share"></i> Chia sẻ
                            </button>
                        </div>
                    </article>

                    <!-- Bài viết 3: Danh mục thành tích -->
                    <article class="post-card" data-category="results">
                        <div class="post-header">
                            <div class="post-author">
                                <img src="https://i.pravatar.cc/150?img=15" alt="Author" class="author-avatar">
                                <div class="author-info">
                                    <div class="author-name">Success Story</div>
                                    <div class="post-time">1 ngày trước</div>
                                </div>
                            </div>
                            <div class="post-category-badge results">
                                <i class="fas fa-chart-line"></i> Thành tích
                            </div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">🎉 Chia sẻ hành trình giảm 15kg trong 6 tháng!</h3>
                            <p class="post-text">
                                Đây là câu chuyện của mình - từ 85kg xuống 70kg. Không phải là hành trình dễ dàng, 
                                nhưng với sự kiên trì và động viên từ cộng đồng, mình đã làm được! 
                                Cảm ơn tất cả mọi người đã ủng hộ mình suốt quá trình này ❤️
                            </p>
                            <div class="post-images">
                                <img src="{{ asset('images/anh12.jpeg') }}" alt="Before After"> <!-- Hình trước sau 1 -->
                                <img src="{{ asset('images/anh13.jpeg') }}" alt="Before After"> <!-- Hình trước sau 2 -->
                            </div>
                        </div>
                        <div class="post-stats">
                            <div class="stat-item">
                                <i class="fas fa-heart"></i>
                                <span>1.2K</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>245</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-share"></i>
                                <span>167</span>
                            </div>
                        </div>
                        <div class="post-actions">
                            <button class="action-btn like-btn" data-liked="false">
                                <i class="far fa-heart"></i> Thích
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="far fa-comment"></i> Bình luận
                            </button>
                            <button class="action-btn share-btn">
                                <i class="fas fa-share"></i> Chia sẻ
                            </button>
                        </div>
                    </article>

                    <!-- Bài viết 4: Danh mục mẹo hay -->
                    <article class="post-card" data-category="tips">
                        <div class="post-header">
                            <div class="post-author">
                                <img src="https://i.pravatar.cc/150?img=10" alt="Author" class="author-avatar">
                                <div class="author-info">
                                    <div class="author-name">Fitness Tips</div>
                                    <div class="post-time">2 ngày trước</div>
                                </div>
                            </div>
                            <div class="post-category-badge tips">
                                <i class="fas fa-lightbulb"></i> Mẹo hay
                            </div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">💡 10 mẹo giữ động lực tập luyện</h3>
                            <p class="post-text"> <!-- Nội dung dạng list với <br> để xuống dòng -->
                                1. Đặt mục tiêu cụ thể và có thể đo lường được<br>
                                2. Tìm đối tác tập luyện<br>
                                3. Ghi lại tiến trình mỗi ngày<br>
                                4. Thay đổi bài tập để tránh nhàm chán<br>
                                5. Tự thưởng cho bản thân khi đạt mốc...
                            </p>
                        </div>
                        <div class="post-stats">
                            <div class="stat-item">
                                <i class="fas fa-heart"></i>
                                <span>456</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>123</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-share"></i>
                                <span>78</span>
                            </div>
                        </div>
                        <div class="post-actions">
                            <button class="action-btn like-btn" data-liked="false">
                                <i class="far fa-heart"></i> Thích
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="far fa-comment"></i> Bình luận
                            </button>
                            <button class="action-btn share-btn">
                                <i class="fas fa-share"></i> Chia sẻ
                            </button>
                        </div>
                    </article>

                    <!-- Bài viết 5: Danh mục động viên -->
                    <article class="post-card" data-category="motivation">
                        <div class="post-header">
                            <div class="post-author">
                                <img src="https://i.pravatar.cc/150?img=6" alt="Author" class="author-avatar">
                                <div class="author-info">
                                    <div class="author-name">Motivational Coach</div>
                                    <div class="post-time">3 ngày trước</div>
                                </div>
                            </div>
                            <div class="post-category-badge motivation">
                                <i class="fas fa-bullhorn"></i> Động viên
                            </div>
                        </div>
                        <div class="post-content">
                            <h3 class="post-title">🔥 Bạn không cần hoàn hảo, chỉ cần bắt đầu!</h3>
                            <p class="post-text">
                                Hôm nay có thể là ngày bạn thay đổi cuộc đời mình. Đừng chờ đợi thời điểm "hoàn hảo" 
                                vì nó sẽ không bao giờ đến. Hãy bắt đầu từ những bước nhỏ nhất, ngay hôm nay, 
                                ngay bây giờ! Hành trình vạn dặm bắt đầu từ một bước chân 🚶‍♂️💪
                            </p>
                            <div class="post-images single">
                                <img src="{{ asset('images/fitness.jpg') }}" alt="Motivation"> <!-- Hình đơn -->
                            </div>
                        </div>
                        <div class="post-stats">
                            <div class="stat-item">
                                <i class="fas fa-heart"></i>
                                <span>892</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-comment"></i>
                                <span>178</span>
                            </div>
                            <div class="stat-item">
                                <i class="fas fa-share"></i>
                                <span>234</span>
                            </div>
                        </div>
                        <div class="post-actions">
                            <button class="action-btn like-btn" data-liked="false">
                                <i class="far fa-heart"></i> Thích
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="far fa-comment"></i> Bình luận
                            </button>
                            <button class="action-btn share-btn">
                                <i class="fas fa-share"></i> Chia sẻ
                            </button>
                        </div>
                    </article>
                </div>

                <!-- Nút tải thêm bài viết -->
                <div class="load-more-container">
                    <button class="load-more-btn" id="loadMoreBtn"> <!-- Nút load more -->
                        <i class="fas fa-chevron-down"></i> Tải thêm bài viết
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal tạo bài viết mới -->
    <div class="modal-overlay" id="createPostModal"> <!-- Overlay che màn hình -->
        <div class="modal-content"> <!-- Nội dung modal -->
            <div class="modal-header"> <!-- Phần đầu modal -->
                <h2>Tạo bài viết mới</h2> <!-- Tiêu đề -->
                <button class="modal-close" id="closeModal"> <!-- Nút đóng -->
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body"> <!-- Phần thân modal -->
                <div class="post-form"> <!-- Form tạo bài viết -->
                    <div class="form-group"> <!-- Nhóm trường form: Danh mục -->
                        <label>Danh mục</label>
                        <select class="form-select"> <!-- Dropdown chọn danh mục -->
                            <option>Chọn danh mục</option>
                            <option>Tập luyện</option>
                            <option>Dinh dưỡng</option>
                            <option>Thành tích</option>
                            <option>Động viên</option>
                            <option>Mẹo hay</option>
                        </select>
                    </div>
                    <div class="form-group"> <!-- Nhóm trường: Tiêu đề -->
                        <label>Tiêu đề</label>
                        <input type="text" class="form-input" placeholder="Nhập tiêu đề bài viết..."> <!-- Input text -->
                    </div>
                    <div class="form-group"> <!-- Nhóm trường: Nội dung -->
                        <label>Nội dung</label>
                        <textarea class="form-textarea" rows="6" placeholder="Chia sẻ suy nghĩ của bạn..."></textarea> <!-- Textarea -->
                    </div>
                    <div class="form-group"> <!-- Nhóm trường: Hình ảnh -->
                        <label>Hình ảnh</label>
                        <div class="image-upload"> <!-- Wrapper upload -->
                            <input type="file" id="imageUpload" accept="image/*" multiple style="display: none;"> <!-- Input file ẩn -->
                            <button class="upload-btn" onclick="document.getElementById('imageUpload').click()"> <!-- Nút kích hoạt upload -->
                                <i class="fas fa-image"></i> Chọn hình ảnh
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer"> <!-- Phần chân modal -->
                <button class="btn-cancel" id="cancelPost">Hủy</button> <!-- Nút hủy -->
                <button class="btn-submit">Đăng bài</button> <!-- Nút submit -->
            </div>
        </div>
    </div>

    <!-- Script JavaScript cho trang cộng đồng -->
    <script src="{{ asset('js/community.js') }}"></script> <!-- Liên kết file JS tùy chỉnh -->
</body>
</html>
@endsection