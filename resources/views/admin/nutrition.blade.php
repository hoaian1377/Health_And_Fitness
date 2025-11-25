@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Món Ăn Mới</h2>
        <form action="{{ route('admin.nutrition.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên món ăn</label>
                    <input type="text" name="meal_name" required>
                </div>
                
                <div class="form-group">
                    <label>Mục tiêu Fitness</label>
                    <select name="fitness_goalID">
                        <option value="">-- Chọn mục tiêu (Tùy chọn) --</option>
                        @foreach($goals as $goal)
                            <option value="{{ $goal->fitness_goalID }}">{{ $goal->goal_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Khối lượng (g)</label>
                    <input type="number" name="food_weight" required>
                </div>
                <div class="form-group">
                    <label>Calories</label>
                    <input type="number" name="calories" required>
                </div>
                <div class="form-group">
                    <label>Protein (g)</label>
                    <input type="number" step="0.1" name="protein" required>
                </div>
                <div class="form-group">
                    <label>Carbs (g)</label>
                    <input type="number" step="0.1" name="carbs" required>
                </div>
                <div class="form-group">
                    <label>Fat (g)</label>
                    <input type="number" step="0.1" name="fat" required>
                </div>
                <div class="form-group" style="grid-column: span 3;">
                    <label>URL Hình ảnh</label>
                    <input type="text" name="urls">
                </div>
                <div class="form-group" style="grid-column: span 3;">
                    <label>Mô tả / Cách chế biến</label>
                    <textarea name="description" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn-primary">Thêm Món Ăn</button>
        </form>
    </div>

    <div class="card">
        <h2>Danh Sách Món Ăn</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Loại</th>
                    <th>Calories</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meals as $meal)
                <tr>
                    <td>{{ $meal->meal_planID }}</td>
                    <td>{{ $meal->meal_name }}</td>
                    <td>{{ $meal->meal_type }}</td>
                    <td>{{ $meal->calories }}</td>
                    <td>
                        <a href="{{ route('admin.nutrition.edit', $meal->meal_planID) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.nutrition.destroy', $meal->meal_planID) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
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
