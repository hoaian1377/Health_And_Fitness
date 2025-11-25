@extends('admin.layout')

@section('content')
    <div class="card">
        <h1>Chào mừng trở lại, Admin!</h1>
        <p>Chọn một mục từ menu bên trái để quản lý nội dung.</p>
    </div>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div class="card" style="flex: 1; text-align: center;">
            <i class="fa-solid fa-dumbbell" style="font-size: 40px; color: #3498db; margin-bottom: 10px;"></i>
            <h3>Quản lý Bài tập</h3>
            <p>Thêm, xóa, sửa các bài tập luyện.</p>
            <a href="{{ route('admin.exercises') }}" class="btn-primary" style="display: inline-block; margin-top: 10px;">Truy cập</a>
        </div>
        <div class="card" style="flex: 1; text-align: center;">
            <i class="fa-solid fa-utensils" style="font-size: 40px; color: #2ecc71; margin-bottom: 10px;"></i>
            <h3>Quản lý Dinh dưỡng</h3>
            <p>Thêm, xóa, sửa thực đơn và món ăn.</p>
            <a href="{{ route('admin.nutrition') }}" class="btn-primary" style="display: inline-block; margin-top: 10px;">Truy cập</a>
        </div>
        <div class="card" style="flex: 1; text-align: center;">
            <i class="fa-solid fa-tags" style="font-size: 40px; color: #e67e22; margin-bottom: 10px;"></i>
            <h3>Quản lý Gói tập</h3>
            <p>Cập nhật các gói đăng ký thành viên.</p>
            <a href="{{ route('admin.plans') }}" class="btn-primary" style="display: inline-block; margin-top: 10px;">Truy cập</a>
        </div>
    </div>
@endsection
