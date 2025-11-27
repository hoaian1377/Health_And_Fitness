@extends('base')
@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/community.css') }}">
@endpush

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

@push('scripts')
    <script src="{{ asset('js/community.js') }}"></script>
@endpush
@endsection
