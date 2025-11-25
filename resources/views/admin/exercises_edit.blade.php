@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Chỉnh Sửa Bài Tập</h2>
        <form action="{{ route('admin.exercises.update', $exercise->workout_exerciseID) }}" method="POST">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label>Tên bài tập</label>
                    <input type="text" name="name_workout" value="{{ $exercise->name_workout }}" required>
                </div>
                <div class="form-group">
                    <label>Nhóm cơ</label>
                    <input type="text" name="muscle_group" value="{{ $exercise->muscle_group }}" required>
                </div>
                <div class="form-group">
                    <label>Mục tiêu Fitness</label>
                    <select name="fitness_goalID">
                        <option value="">-- Chọn mục tiêu (Tùy chọn) --</option>
                        @foreach($goals as $goal)
                            <option value="{{ $goal->fitness_goalID }}" {{ $exercise->fitness_goalID == $goal->fitness_goalID ? 'selected' : '' }}>{{ $goal->goal_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Thời gian (phút/giây)</label>
                    <input type="text" name="duration" value="{{ $exercise->duration }}" required>
                </div>
                <div class="form-group">
                    <label>Số hiệp/Lần lặp</label>
                    <input type="text" name="practice_round" value="{{ $exercise->practice_round }}" required>
                </div>
                <div class="form-group">
                    <label>Calories tiêu thụ</label>
                    <input type="number" name="calories_burned" value="{{ $exercise->calories_burned }}" required>
                </div>
                <div class="form-group">
                    <label>URL Hình ảnh</label>
                    <input type="text" name="urls" value="{{ $exercise->urls }}">
                </div>
                <div class="form-group" style="grid-column: span 2;">
                    <label>URL Video</label>
                    <input type="text" name="video_urls" value="{{ $exercise->video_urls }}">
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.exercises') }}" class="btn-danger" style="text-decoration: none; background: #95a5a6;">Hủy</a>
            </div>
        </form>
    </div>
@endsection
