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