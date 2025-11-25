@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Gói Tập Mới</h2>
        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên gói</label>
                    <input type="text" name="name" required placeholder="Ví dụ: Gói Cơ Bản">
                </div>
                <div class="form-group">
                    <label>Giá (VND)</label>
                    <input type="number" name="price" required>
                </div>
                <div class="form-group">
                    <label>Thời hạn (ngày)</label>
                    <input type="number" name="duration" required placeholder="30">
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Mô tả / Quyền lợi</label>
                    <textarea name="description" rows="3" placeholder="Mô tả các quyền lợi của gói..."></textarea>
                </div>
            </div>
            <button type="submit" class="btn-primary">Thêm Gói Tập</button>
        </form>
    </div>

    <div class="card">
        <h2>Danh Sách Gói Tập</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên gói</th>
                    <th>Giá</th>
                    <th>Thời hạn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->id }}</td>
                    <td>{{ $plan->name }}</td>
                    <td>{{ number_format($plan->price) }} VND</td>
                    <td>{{ $plan->duration }} ngày</td>
                    <td>
                        <a href="{{ route('admin.plans.edit', $plan->id) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger"><i class="fa-solid fa-trash"></i> Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
