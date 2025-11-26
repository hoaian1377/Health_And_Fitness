@extends('admin.layout')

@section('content')
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2>Chat với: {{ $user->name }}</h2>
            <a href="{{ route('admin.chat.list') }}" class="btn-primary" style="text-decoration: none; background: #95a5a6;">Quay lại</a>
        </div>

        <div id="chat-box" style="border: 1px solid #ddd; padding: 20px; height: 400px; overflow-y: scroll; background: #f9f9f9; border-radius: 8px; margin-bottom: 20px;">
            @foreach($messages as $msg)
                <div style="margin-bottom: 15px; text-align: {{ $msg->sender == 'admin' ? 'right' : 'left' }};">
                    <div style="display: inline-block; max-width: 70%; padding: 10px 15px; border-radius: 15px; background: {{ $msg->sender == 'admin' ? '#3498db' : '#ecf0f1' }}; color: {{ $msg->sender == 'admin' ? 'white' : 'black' }};">
                        {{ $msg->message }}
                    </div>
                    <div style="font-size: 11px; color: #999; margin-top: 5px;">
                        {{ $msg->created_at->format('H:i d/m') }}
                    </div>
                </div>
            @endforeach
        </div>

        <form action="{{ route('admin.chat.reply', $user->id) }}" method="POST">
            @csrf
            <div style="display: flex; gap: 10px;">
                <input type="text" name="message" required placeholder="Nhập tin nhắn trả lời..." style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" class="btn-primary">Gửi</button>
            </div>
        </form>
    </div>

    <script>
        // Auto scroll to bottom
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    </script>
@endsection
