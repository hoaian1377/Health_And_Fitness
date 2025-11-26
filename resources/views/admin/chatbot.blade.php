@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Thêm Câu Hỏi Chatbot</h2>
        <form action="{{ route('admin.chatbot.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Câu hỏi (Keywords)</label>
                <input type="text" name="question" required placeholder="Ví dụ: giảm cân, tăng cơ, giá gói tập...">
                <small style="color: #666;">Chatbot sẽ tìm kiếm các từ khóa này trong câu hỏi của người dùng.</small>
            </div>
            <div class="form-group" style="margin-top: 15px;">
                <label>Câu trả lời</label>
                <textarea name="answer" rows="5" required placeholder="Nhập câu trả lời của chatbot..."></textarea>
            </div>
            <button type="submit" class="btn-primary" style="margin-top: 15px;">Thêm Câu Hỏi</button>
        </form>
    </div>

    <div class="card">
        <h2>Danh Sách Câu Hỏi & Trả Lời</h2>
        <table>
            <thead>
                <tr>
                    <th style="width: 30%;">Câu hỏi / Từ khóa</th>
                    <th style="width: 50%;">Câu trả lời</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $q)
                <tr>
                    <td>{{ $q->question }}</td>
                    <td>{{ Str::limit($q->answer, 100) }}</td>
                    <td>
                        <a href="{{ route('admin.chatbot.edit', $q->chatbotid) }}" class="btn-primary" style="text-decoration: none; padding: 5px 10px; font-size: 14px; margin-right: 5px;"><i class="fa-solid fa-pen"></i> Sửa</a>
                        <form action="{{ route('admin.chatbot.destroy', $q->chatbotid) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');" style="display: inline-block;">
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
