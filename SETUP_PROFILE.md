# 🚀 Hướng Dẫn Cài Đặt Profile Page

## ⚡ Quick Start

### 1️⃣ Chạy Migration để thêm cột vào database

```bash
php artisan migrate
```

Nếu gặp lỗi, bạn có thể tạo migration mới:

```bash
php artisan make:migration add_profile_fields_to_users_table
```

Và copy nội dung từ file:
```
database/migrations/2024_11_16_000000_add_profile_fields_to_users_table.php
```

### 2️⃣ Cấu hình Filesystem Storage

Thêm vào `.env`:
```
FILESYSTEM_DISK=public
```

Tạo symlink để upload được file:
```bash
php artisan storage:link
```

### 3️⃣ Kiểm tra Route

Chạy lệnh này để xem tất cả routes:
```bash
php artisan route:list | grep profile
```

Bạn sẽ thấy:
```
profile.page          GET|HEAD  /profile
profile.update        PUT       /profile/update
POST                  /api/profile/update
POST                  /api/profile/avatar
DELETE                /api/profile
```

### 4️⃣ Truy cập Profile

Đăng nhập vào ứng dụng và truy cập:
```
http://localhost/profile
```

## 📋 File Được Tạo/Cập Nhật

### Views
- ✅ `resources/views/profile.blade.php` - Giao diện chính

### Styles
- ✅ `public/css/profile.css` - CSS chi tiết với dark mode

### JavaScript
- ✅ `public/js/profile.js` - Tất cả tính năng tương tác

### Controllers
- ✅ `app/Http/Controllers/ProfileController.php` - API endpoints

### Routes
- ✅ `routes/web.php` - Thêm profile routes

### Migrations
- ✅ `database/migrations/2024_11_16_000000_add_profile_fields_to_users_table.php`

### Base Layout
- ✅ `resources/views/base.blade.php` - Thêm CSRF token

### Documentation
- ✅ `PROFILE_README.md` - Hướng dẫn chi tiết

## 🎨 Các Section Chính

### 1. **Thông Tin Cá Nhân** 👤
- Họ và tên
- Email
- Số điện thoại
- Ngày sinh
- Giới tính
- Địa chỉ

### 2. **Dữ Liệu Sức Khỏe** 💪
- Chiều cao
- Cân nặng
- BMI (tính tự động)
- Nhóm máu
- Mức độ hoạt động

### 3. **Mục Tiêu** 🎯
- Tập luyện
- Giảm cân
- Uống nước
(Có thể thêm mục tiêu mới)

### 4. **Tùy Chỉnh** ⚙️
- Thông báo
- Ngôn ngữ
- Giao diện

### 5. **Bảo Mật** 🔒
- Đổi mật khẩu
- Xóa tài khoản

## ✨ Tính Năng

### Frontend
- ✅ Menu điều hướng giữa các section
- ✅ Chế độ edit/view cho từng form
- ✅ Tải lên avatar mới
- ✅ Tính toán BMI tự động
- ✅ Modal xác nhận xóa tài khoản
- ✅ Notification toasts
- ✅ Responsive design (Mobile, Tablet, Desktop)
- ✅ Dark mode theme

### Backend
- ✅ API cập nhật thông tin cá nhân
- ✅ API cập nhật dữ liệu sức khỏe
- ✅ API upload avatar
- ✅ API xóa tài khoản
- ✅ Validation dữ liệu
- ✅ Error handling

## 🔍 Troubleshooting

### Lỗi: "CSRF token mismatch"
**Giải pháp**: Đảm bảo `meta name="csrf-token"` có trong `base.blade.php` ✅ (đã thêm)

### Lỗi: "File not found" khi upload avatar
**Giải pháp**: Chạy `php artisan storage:link`

### CSS không load
**Giải pháo**: 
```bash
php artisan cache:clear
php artisan config:cache
```

### JavaScript không hoạt động
**Giải pháp**: 
- Kiểm tra DevTools (F12)
- Check Console tab cho errors
- Đảm bảo @push('scripts') có trong blade

### API endpoints không work
**Giải pháp**:
- Kiểm tra Authentication middleware
- Test route: `php artisan route:list`
- Check Laravel logs: `storage/logs/laravel.log`

## 📱 Responsive Breakpoints

| Device | Width | Layout |
|--------|-------|--------|
| Desktop | > 1024px | 2 cột (Sidebar + Main) |
| Tablet | 768-1024px | 1 cột stack |
| Mobile | < 768px | 1 cột full width |
| Small | < 600px | Adjusted padding |

## 🎨 Customization

### Thay đổi màu chính

Sửa trong `public/css/profile.css`:

```css
:root {
    --primary-color: #00d4aa;      /* Xanh lá */
    --primary-dark: #00a87f;       /* Xanh lá đậm */
    --accent-color: #ff6b6b;       /* Đỏ */
    --secondary-bg: #1a1f36;       /* Nền tối */
    --tertiary-bg: #252d47;        /* Nền sáng hơn */
    --text-primary: #ffffff;       /* Text chính */
    --text-secondary: #b8c1d6;     /* Text phụ */
}
```

### Thêm Section Mới

1. Thêm menu item trong sidebar:
```html
<a href="#new-section" class="menu-item" data-section="new-section">
    <i class="fa-solid fa-icon"></i>
    <span>Tên Section</span>
</a>
```

2. Thêm section HTML:
```html
<section id="new-section" class="profile-section">
    <!-- Content -->
</section>
```

3. CSS tự động áp dụng (không cần sửa)

4. JavaScript tự động handle (menu navigation)

## 🔒 Security Notes

- ✅ CSRF Token validation
- ✅ Authentication middleware
- ✅ Input validation trên server
- ✅ File upload validation
- ✅ Safe storage paths

## 📞 Support

Nếu có vấn đề:

1. Kiểm tra console (F12)
2. Kiểm tra Laravel logs
3. Chạy `php artisan migrate`
4. Chạy `php artisan storage:link`

## 🎓 Learning Resources

- Blade Template: https://laravel.com/docs/blade
- CSS Variables: https://developer.mozilla.org/en-US/docs/Web/CSS/--*
- Fetch API: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API
- File Upload: https://laravel.com/docs/requests#files

---

**Status**: ✅ Ready to Use  
**Last Updated**: November 2025  
**Version**: 1.0.0
