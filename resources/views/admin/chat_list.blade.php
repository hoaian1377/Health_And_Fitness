@extends('admin.layout')

@section('content')
    <div class="card">
        <h2>Hỗ trợ trực tuyến</h2>
        <p>Danh sách người dùng cần hỗ trợ.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Người dùng</th>
                    <th>Tin nhắn cuối</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $lastMessage = $user->chatMessages->first();
                        $unreadCount = $user->chatMessages->where('sender', 'user')->where('is_read', false)->count();
                    @endphp
                    <tr style="{{ $unreadCount > 0 ? 'background-color: #e8f8f5;' : '' }}">
                        <td>
                            <strong>{{ $user->name }}</strong><br>
                            <small>{{ $user->email }}</small>
                        </td>
                        <td>
                            {{ Str::limit($lastMessage->message, 50) }}
                            @if($lastMessage->sender == 'admin')
                                <small style="color: #888;">(Bạn: {{ Str::limit($lastMessage->message, 20) }})</small>
                            @endif
                        </td>
                        <td>{{ $lastMessage->created_at->diffForHumans() }}</td>
                        <td>
                            @if($unreadCount > 0)
                                <span style="background: #e74c3c; color: white; padding: 2px 6px; border-radius: 10px; font-size: 12px;">{{ $unreadCount }} mới</span>
                            @else
                                <span style="color: #2ecc71;">Đã xem</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.chat.detail', $user->id) }}" class="btn-primary" style="text-decoration: none;">Xem tin nhắn</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
