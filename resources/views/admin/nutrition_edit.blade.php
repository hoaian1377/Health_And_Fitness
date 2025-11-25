@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Chỉnh Sửa Món Ăn</h2>
        <form action="{{ route('admin.nutrition.update', $meal->meal_planID) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên món ăn</label>
                    <input type="text" name="meal_name" value="{{ $meal->meal_name }}" required>
                </div>
                <div class="form-group">
                    <label>Loại bữa</label>
                    <select name="meal_type" required>
                        <option value="Bữa sáng" {{ $meal->meal_type == 'Bữa sáng' ? 'selected' : '' }}>Bữa sáng</option>
                        <option value="Bữa trưa" {{ $meal->meal_type == 'Bữa trưa' ? 'selected' : '' }}>Bữa trưa</option>
                        <option value="Bữa tối" {{ $meal->meal_type == 'Bữa tối' ? 'selected' : '' }}>Bữa tối</option>
                        <option value="Bữa phụ" {{ $meal->meal_type == 'Bữa phụ' ? 'selected' : '' }}>Bữa phụ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mục tiêu Fitness</label>
                    <select name="fitness_goalID">
                        <option value="">-- Chọn mục tiêu (Tùy chọn) --</option>
                        @foreach($goals as $goal)
                            <option value="{{ $goal->fitness_goalID }}" {{ $meal->fitness_goalID == $goal->fitness_goalID ? 'selected' : '' }}>{{ $goal->goal_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Khối lượng (g)</label>
                    <input type="number" name="food_weight" value="{{ $meal->food_weight }}" required>
                </div>
                <div class="form-group">
                    <label>Calories</label>
                    <input type="number" name="calories" value="{{ $meal->calories }}" required>
                </div>
                <div class="form-group">
                    <label>Protein (g)</label>
                    <input type="number" step="0.1" name="protein" value="{{ $meal->protein }}" required>
                </div>
                <div class="form-group">
                    <label>Carbs (g)</label>
                    <input type="number" step="0.1" name="carbs" value="{{ $meal->carbs }}" required>
                </div>
                <div class="form-group">
                    <label>Fat (g)</label>
                    <input type="number" step="0.1" name="fat" value="{{ $meal->fat }}" required>
                </div>
                <div class="form-group" style="grid-column: span 3;">
                    <label>URL Hình ảnh</label>
                    <input type="text" name="urls" value="{{ $meal->urls }}">
                </div>
                <div class="form-group" style="grid-column: span 3;">
                    <label>Mô tả / Cách chế biến</label>
                    <textarea name="description" rows="3">{{ $meal->description }}</textarea>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.nutrition') }}" class="btn-danger" style="text-decoration: none; background: #95a5a6;">Hủy</a>
            </div>
        </form>
    </div>
@endsection
