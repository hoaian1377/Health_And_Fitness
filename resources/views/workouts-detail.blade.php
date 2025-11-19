@extends('base')

@section('content')
<link rel="stylesheet" href="{{ asset('css/workout-detail.css') }}">



<div class="workout-detail-page">

 
   
        <!-- Video Section -->
        <div class="video-section">
            <div class="video-container">
                <div class="video-frame">
                    <video 
                        id="workoutVideo"
                        controls 
                        poster="{{ $exercise->thumbnail ?? asset('images/thumbnail.jpg') }}"
                        preload="metadata">
                        <source src="{{ $exercise->video_urls ?? asset('videos/workout1.mp4') }}" type="video/mp4">
                        Trình duyệt của bạn không hỗ trợ phát video.
                    </video>
                </div>
            </div>

            <!-- Video Controls -->
            <div class="video-stats">
                <div class="stat-item">
                    <i class="icon">👁️</i>
                    <span>{{ number_format($exercise->views ?? 12458) }} lượt xem</span>
                </div>
                <div class="stat-item">
                    <i class="icon">👍</i>
                    <span>{{ number_format($exercise->likes ?? 1254) }} lượt thích</span>
                </div>
                <div class="stat-item">
                    <i class="icon">📅</i>
                    <span>{{ $exercise->created_at ? $exercise->created_at->diffForHumans() : 'Hôm qua' }}</span>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <button class="tab-btn active" data-tab="details">Chi tiết</button>
            <button class="tab-btn" data-tab="nutrition">Dinh dưỡng</button>
            <button class="tab-btn" data-tab="equipment">Dụng cụ</button>
            <button class="tab-btn" data-tab="reviews">Đánh giá</button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
            <!-- Details Tab -->
            <div class="tab-panel active" id="details-panel">
                <section class="workout-info">
                    <h2>🏋️ Chi tiết bài tập</h2>
                    
                    @if($exercise->description)
                    <div class="workout-description">
                        <p>{{ $exercise->description }}</p>
                    </div>
                    @endif

                    <h3>📋 Các bước thực hiện</h3>
                    <ul class="workout-steps">
                        <li>
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <strong>Khởi động</strong>
                                <p>5 phút (xoay khớp, chạy tại chỗ, jumping jacks)</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <strong>Burpees</strong>
                                <p>3 hiệp × 12 lần · Nghỉ 60s giữa các hiệp</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <strong>Mountain Climbers</strong>
                                <p>3 hiệp × 40 giây · Tập trung vào tốc độ</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <strong>Jump Squats</strong>
                                <p>3 hiệp × 15 lần · Bật cao nhất có thể</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">5</div>
                            <div class="step-content">
                                <strong>Push-ups</strong>
                                <p>3 hiệp × 10–15 lần · Giữ lưng thẳng</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">6</div>
                            <div class="step-content">
                                <strong>Plank</strong>
                                <p>3 hiệp × 45–60 giây · Thắt chặt cơ bụng</p>
                            </div>
                        </li>
                        <li>
                            <div class="step-number">7</div>
                            <div class="step-content">
                                <strong>Thư giãn & giãn cơ</strong>
                                <p>5 phút (kéo giãn nhẹ nhàng toàn thân)</p>
                            </div>
                        </li>
                    </ul>

                    <div class="workout-tips">
                        <h3>💡 Lưu ý quan trọng</h3>
                        <ul>
                            <li>Khởi động kỹ trước khi tập để tránh chấn thương</li>
                            <li>Uống nước đều đặn trong suốt quá trình tập</li>
                            <li>Điều chỉnh số lần/thời gian phù hợp với thể lực</li>
                            <li>Dừng lại nếu cảm thấy đau hoặc khó chịu</li>
                            <li>Kết hợp với chế độ ăn uống khoa học để đạt hiệu quả tốt nhất</li>
                        </ul>
                    </div>
                </section>
            </div>

   

            <!-- Equipment Tab -->
            <div class="tab-panel" id="equipment-panel">
                <section class="equipment-section">
                    <h2>🏋️ Dụng cụ cần thiết</h2>
                     <div class="equipment-grid">
                        <div class="equipment-item">
                            <div class="equipment-icon">🧘</div>
                            <h4>Thảm tập Yoga</h4>
                            <p>Bảo vệ khớp và tạo độ ma sát</p>
                            <span class="equipment-badge">Bắt buộc</span>
                        </div>
                        <div class="equipment-item">
                            <div class="equipment-icon">👟</div>
                            <h4>Giày thể thao</h4>
                            <p>Hỗ trợ chuyển động</p>
                            <span class="equipment-badge">Bắt buộc</span>
                        </div>
                        <div class="equipment-item">
                            <div class="equipment-icon">🏋️</div>
                            <h4>Tạ tay (tùy chọn)</h4>
                            <p>Tăng cường độ bài tập</p>
                            <span class="equipment-badge optional">Tùy chọn</span>
                        </div>
                        <div class="equipment-item">
                            <div class="equipment-icon">💧</div>
                            <h4>Bình nước</h4>
                            <p>Bổ sung nước trong khi tập</p>
                            <span class="equipment-badge">Khuyến nghị</span>
                        </div>
                        <div class="equipment-item">
                            <div class="equipment-icon">🎧</div>
                            <h4>Tai nghe</h4>
                            <p>Nghe nhạc tạo động lực</p>
                            <span class="equipment-badge optional">Tùy chọn</span>
                        </div>
                        <div class="equipment-item">
                            <div class="equipment-icon">🧤</div>
                            <h4>Găng tay tập gym</h4>
                            <p>Bảo vệ bàn tay khi tập</p>
                            <span class="equipment-badge optional">Tùy chọn</span>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Reviews Tab -->
            <div class="tab-panel" id="reviews-panel">
                <section class="reviews-section">
                    <h2>⭐ Đánh giá từ học viên</h2>
                    
                    <div class="rating-summary">
                        <div class="rating-score">
                            <span class="score-number">4.8</span>
                            <div class="stars">⭐⭐⭐⭐⭐</div>
                            <p>128 đánh giá</p>
                        </div>
                        
                        <div class="rating-bars">
                            <div class="rating-bar-item">
                                <span>5 ⭐</span>
                                <div class="bar"><div class="fill" style="width: 75%"></div></div>
                                <span>96</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>4 ⭐</span>
                                <div class="bar"><div class="fill" style="width: 15%"></div></div>
                                <span>19</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>3 ⭐</span>
                                <div class="bar"><div class="fill" style="width: 7%"></div></div>
                                <span>9</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>2 ⭐</span>
                                <div class="bar"><div class="fill" style="width: 2%"></div></div>
                                <span>3</span>
                            </div>
                            <div class="rating-bar-item">
                                <span>1 ⭐</span>
                                <div class="bar"><div class="fill" style="width: 1%"></div></div>
                                <span>1</span>
                            </div>
                        </div>
                    </div>

                    <div class="reviews-list">
                        <div class="review-item">
                            <div class="review-header">
                                <img src="{{ asset('images/avatar1.jpg') }}" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <strong>Nguyễn Văn A</strong>
                                    <div class="review-stars">⭐⭐⭐⭐⭐</div>
                                    <span class="review-date">2 ngày trước</span>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>Bài tập rất hiệu quả! Tôi đã tập được 2 tuần và cảm thấy cơ thể săn chắc hơn nhiều. Huấn luyện viên hướng dẫn rất chi tiết và dễ hiểu. Rất recommend! 💪</p>
                            </div>
                            <div class="review-actions">
                                <button class="btn-like">👍 Hữu ích (12)</button>
                            </div>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <img src="{{ asset('images/avatar2.jpg') }}" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <strong>Trần Thị B</strong>
                                    <div class="review-stars">⭐⭐⭐⭐⭐</div>
                                    <span class="review-date">1 tuần trước</span>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>Mình là người mới tập nên ban đầu hơi khó khăn, nhưng sau vài buổi đã quen và thấy hiệu quả rõ rệt. Video hướng dẫn rất chất lượng!</p>
                            </div>
                            <div class="review-actions">
                                <button class="btn-like">👍 Hữu ích (8)</button>
                            </div>
                        </div>

                        <div class="review-item">
                            <div class="review-header">
                                <img src="{{ asset('images/avatar3.jpg') }}" alt="User" class="review-avatar">
                                <div class="review-info">
                                    <strong>Lê Minh C</strong>
                                    <div class="review-stars">⭐⭐⭐⭐</div>
                                    <span class="review-date">2 tuần trước</span>
                                </div>
                            </div>
                            <div class="review-content">
                                <p>Bài tập tốt nhưng hơi nặng đối với người mới. Mình phải điều chỉnh lại một chút cho phù hợp. Nhìn chung vẫn ok! 👌</p>
                            </div>
                            <div class="review-actions">
                                <button class="btn-like">👍 Hữu ích (5)</button>
                            </div>
                        </div>
                    </div>

                    <button class="btn-load-more">Xem thêm đánh giá</button>
                </section>
            </div>
        </div>

   

    <!-- Modal -->
    <div id="mealModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="mealTitle"></h3>
            <p id="mealDesc"></p>
        </div>
    </div>
</div>

<script src="{{ asset('js/workout.js') }}"></script>
@endsection