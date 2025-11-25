@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Chỉnh Sửa Gói Tập</h2>
        <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên gói</label>
                    <input type="text" name="name" value="{{ $plan->name }}" required>
                </div>
                <div class="form-group">
                    <label>Giá (VND)</label>
                    <input type="number" name="price" value="{{ $plan->price }}" required>
                </div>
                <div class="form-group">
                    <label>Thời hạn (ngày)</label>
                    <input type="number" name="duration" value="{{ $plan->duration }}" required>
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Mô tả / Quyền lợi</label>
                    <textarea name="description" rows="3">{{ $plan->description }}</textarea>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.plans') }}" class="btn-danger" style="text-decoration: none; background: #95a5a6;">Hủy</a>
            </div>
        </form>
    </div>
@endsection
