@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Chỉnh Sửa Câu Hỏi Chatbot</h2>
        <form action="{{ route('admin.chatbot.update', $question->chatbotid) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Câu hỏi (Keywords)</label>
                <input type="text" name="question" value="{{ $question->question }}" required>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Câu trả lời</label>
                <textarea name="answer" rows="5" required>{{ $question->answer }}</textarea>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn-primary">Cập Nhật</button>
                <a href="{{ route('admin.chatbot') }}" class="btn-danger" style="text-decoration: none; background: #95a5a6;">Hủy</a>
            </div>
        </form>
    </div>
@endsection
