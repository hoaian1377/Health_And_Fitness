# Hướng Dẫn Profile Page - Health & Fitness

## 📋 Mô Tả

Trang profile đã được thiết kế và xây dựng với các tính năng sau:

### ✨ Tính Năng Chính

1. **Thông Tin Cá Nhân**
   - Chỉnh sửa tên, email, số điện thoại
   - Ngày sinh, giới tính, địa chỉ
   - Tải lên hình đại diện mới

2. **Dữ Liệu Sức Khỏe**
   - Quản lý chiều cao, cân nặng
   - Tính toán BMI tự động
   - Nhóm máu, mức độ hoạt động

3. **Mục Tiêu Cá Nhân**
   - Hiển thị các mục tiêu sức khỏe
   - Thanh tiến độ trực quan
   - Quản lý mục tiêu (Tập luyện, Giảm cân, Uống nước)

4. **Tùy Chỉnh**
   - Nhận thông báo
   - Chọn ngôn ngữ
   - Chọn giao diện (Sáng/Tối/Tự động)

5. **Bảo Mật**
   - Đổi mật khẩu
   - Xóa tài khoản (với xác nhận)

## 🎨 Thiết Kế

### Màu Sắc (Dark Mode)
- **Primary**: `#00d4aa` (Xanh lá)
- **Primary Dark**: `#00a87f` (Xanh lá đậm)
- **Background**: `#1a1f36` (Xám đen)
- **Surface**: `#252d47` (Xám đen sáng)
- **Accent**: `#ff6b6b` (Đỏ)

### Responsive Design
- Desktop: 2 cột (Sidebar + Main)
- Tablet: Full width
- Mobile: 1 cột stack

## 📁 Cấu Trúc File

```
resources/views/profile.blade.php       # View chính
public/css/profile.css                  # Styles
public/js/profile.js                    # JavaScript
```

## 🚀 Cách Sử Dụng

### 1. Route Setup
Thêm vào `routes/web.php`:

```php
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.page');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar']);
    Route::delete('/profile', [ProfileController::class, 'delete']);
});
```

### 2. Controller Setup
Tạo file `app/Http/Controllers/ProfileController.php`:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'type' => 'required|string',
            'data' => 'required|array'
        ]);

        // Xử lý cập nhật dữ liệu
        // $user->update($data['data']);
        
        return response()->json(['success' => true]);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|max:2048'
        ]);

        // Lưu avatar
        // $path = $request->file('avatar')->store('avatars', 'public');
        
        return response()->json([
            'success' => true,
            'avatar_url' => '/path/to/avatar'
        ]);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        // $user->delete();
        
        return response()->json(['success' => true]);
    }
}
```

### 3. Database Migration
Nếu cần thêm cột vào bảng `users`:

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('phone')->nullable();
    $table->date('dob')->nullable();
    $table->enum('gender', ['male', 'female', 'other'])->nullable();
    $table->string('address')->nullable();
    $table->decimal('height', 5, 2)->nullable(); // cm
    $table->decimal('weight', 5, 2)->nullable(); // kg
    $table->decimal('bmi', 5, 2)->nullable();
    $table->string('blood_type')->nullable();
    $table->enum('activity_level', ['sedentary', 'light', 'moderate', 'active', 'very_active'])->nullable();
    $table->enum('subscription_plan', ['free', 'premium'])->default('free');
});
```

## 🎯 Tính Năng JavaScript

### Menu Navigation
- Chuyển đổi giữa các section khi click menu
- Highlight menu item hiện tại
- Smooth scroll trên mobile

### Form Editing
- Bật/tắt chế độ edit
- Validate dữ liệu cơ bản
- Hiển thị/ẩn nút Save/Cancel

### Avatar Upload
- Click vào icon camera để chọn ảnh
- Preview trước khi upload
- Update avatar ngay sau khi upload thành công

### Notification System
- Thông báo cho các hành động
- Tự động ẩn sau 3 giây
- Support: info, success, error, warning

### BMI Calculator
- Tính toán tự động khi chiều cao hoặc cân nặng thay đổi

## 🔒 Security

- CSRF Token được thêm vào base.blade.php
- Token được sử dụng trong tất cả API requests
- Validate dữ liệu cơ bản trên client-side
- Validate lại trên server-side

## 📱 Responsive Breakpoints

- **Desktop**: > 1024px
- **Tablet**: 768px - 1024px
- **Mobile**: < 768px
- **Small Mobile**: < 600px

## 🌙 Dark Mode Support

Toàn bộ giao diện sử dụng CSS variables để dễ dàng chuyển đổi giữa light/dark mode.

## 📝 Customization

### Thay đổi màu sắc

Sửa CSS variables trong `profile.css`:

```css
:root {
    --primary-color: #00d4aa;
    --primary-dark: #00a87f;
    /* ... các màu khác ... */
}
```

### Thêm mục tiêu mới

Sửa phần goals HTML trong `profile.blade.php`:

```html
<div class="goal-card">
    <!-- Copy từ card hiện có và chỉnh sửa -->
</div>
```

## ⚠️ Lưu Ý

1. Nhớ update Database schema nếu dùng cột mới
2. Tạo Controller nếu chưa có
3. Setup Route nếu chưa có
4. Test trên các thiết bị khác nhau
5. Xóa code mock trong JavaScript khi API thực sự sẵn sàng

## 🐛 Troubleshooting

### Styles không load
- Kiểm tra đường dẫn CSS trong @push('styles')
- Clear cache: `php artisan cache:clear`

### JavaScript không hoạt động
- Kiểm tra CSRF token meta tag
- Mở DevTools để xem console errors
- Đảm bảo script được load: `@push('scripts')`

### Form không save
- Setup Controller và Route trước
- Check API endpoint
- Mở Network tab để xem request

## 📞 Support

Nếu có vấn đề, kiểm tra:
1. Browser console (F12)
2. Network tab
3. Laravel logs (storage/logs/)

---

**Version**: 1.0.0  
**Last Updated**: November 2025
