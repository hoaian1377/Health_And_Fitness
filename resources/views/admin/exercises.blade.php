@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Bài Tập Mới</h2>
        <form action="{{ route('admin.exercises.store') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên bài tập</label>
                    <input type="text" name="name_workout" required>
                </div>
                <div class="form-group">
                    <label>Nhóm cơ</label>
                    <input type="text" name="muscle_group" required placeholder="Ví dụ: Ngực, Chân, Cardio...">
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
                    <label>Thời gian (phút/giây)</label>
                    <input type="text" name="duration" required>
                </div>
                <div class="form-group">
                    <label>Số hiệp/Lần lặp</label>
                    <input type="text" name="practice_round" required>
                </div>
                <div class="form-group">
                    <label>Calories tiêu thụ</label>
                    <input type="number" name="calories_burned" required>
                </div>
                <div class="form-group">
                    <label>URL Hình ảnh</label>
                    <input type="text" name="urls">
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>URL Video</label>
                    <input type="text" name="video_urls">
                </div>
            </div>
            <button type="submit" class="btn-primary">Thêm Bài Tập</button>
        </form>
    </div>

    <div class="card">
        <h2>Danh Sách Bài Tập</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Nhóm cơ</th>
                    <th>Calories</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exercises as $exercise)
                <tr>
                    <td>{{ $exercise->workout_exerciseID }}</td>
                    <td>{{ $exercise->name_workout }}</td>
                    <td>{{ $exercise->muscle_group }}</td>
                    <td>{{ $exercise->calories_burned }}</td>
                    <td>
                        <a href="{{ route('admin.exercises.edit', $exercise->workout_exerciseID) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.exercises.destroy', $exercise->workout_exerciseID) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
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
