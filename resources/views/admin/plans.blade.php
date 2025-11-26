@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Gói Tập Mới</h2>
        <form action="{{ route('admin.plans.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên gói</label>
                    <input type="text" name="name_package" required placeholder="Ví dụ: Gói Cơ Bản">
                </div>
                <div class="form-group">
                    <label>Giá (VND)</label>
                    <input type="number" name="price" required>
                </div>
                <div class="form-group">
                    <label>Thời hạn</label>
                    <input type="text" name="duration" required placeholder="tháng, năm, trọn đời...">
                </div>
                <div class="form-group">
                    <label>Mục tiêu (Fitness Goal)</label>
                    <select name="fitness_goalID">
                        <option value="">-- Chọn mục tiêu --</option>
                        @foreach($goals as $goal)
                            <option value="{{ $goal->fitness_goalID }}">{{ $goal->goal_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>Mô tả / Quyền lợi (mỗi dòng một ý)</label>
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
                    <th>Mục tiêu</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plans as $plan)
                <tr>
                    <td>{{ $plan->packageID }}</td>
                    <td>{{ $plan->name_package }}</td>
                    <td>{{ number_format($plan->price) }} VND</td>
                    <td>{{ $plan->duration }}</td>
                    <td>{{ $plan->fitnessGoal->goal_name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.plans.edit', $plan->packageID) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.plans.destroy', $plan->packageID) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
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
