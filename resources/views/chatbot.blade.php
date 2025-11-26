<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Support</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; background-color: #f4f6f9; }
        .chat-container { background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden; }
        .chat-header { background: #3498db; color: white; padding: 15px; text-align: center; }
        #chat-box { padding: 20px; height: 400px; overflow-y: scroll; background: #f9f9f9; }
        .message { margin-bottom: 15px; clear: both; }
        .message-content { padding: 10px 15px; border-radius: 15px; display: inline-block; max-width: 80%; word-wrap: break-word; }
        .user .message-content { background: #3498db; color: white; float: right; border-bottom-right-radius: 2px; }
        .bot .message-content, .admin .message-content { background: #e0e0e0; color: #333; float: left; border-bottom-left-radius: 2px; }
        .admin .message-content { background: #2ecc71; color: white; } /* Admin messages in green */
        .input-area { padding: 15px; border-top: 1px solid #eee; display: flex; gap: 10px; background: white; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 20px; outline: none; }
        button { padding: 10px 20px; background: #3498db; color: white; border: none; border-radius: 20px; cursor: pointer; font-weight: bold; }
        button:hover { background: #2980b9; }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="chat-header">
            <h2 style="margin: 0;">Hỗ trợ trực tuyến</h2>
            <p style="margin: 5px 0 0; font-size: 14px; opacity: 0.9;">Chúng tôi luôn sẵn sàng giúp đỡ bạn</p>
        </div>
        <div id="chat-box">
            @foreach($messages as $msg)
                <div class="message {{ $msg->sender }}">
                    <div class="message-content">
                        @if($msg->sender == 'admin') <strong>Admin:</strong><br> @endif
                        {{ $msg->message }}
                    </div>
                </div>
            @endforeach
        </div>
        <div class="input-area">
            <input type="text" id="question" placeholder="Nhập câu hỏi của bạn..." onkeypress="handleKeyPress(event)">
            <button onclick="askQuestion()">Gửi</button>
        </div>
    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;

        function handleKeyPress(e) {
            if (e.key === 'Enter') {
                askQuestion();
            }
        }

        async function askQuestion() {
            const questionInput = document.getElementById('question');
            const question = questionInput.value;
            if (!question.trim()) return;

            addMessage(question, 'user');
            questionInput.value = '';

            try {
                const response = await fetch('{{ route("chatbot.ask") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ question: question })
                });
                const data = await response.json();
                
                if (data.answer) {
                    addMessage(data.answer, 'bot');
                }
            } catch (error) {
                console.error('Error:', error);
                addMessage('Có lỗi xảy ra, vui lòng thử lại sau.', 'bot');
            }
        }

        function addMessage(text, sender) {
            const div = document.createElement('div');
            div.classList.add('message', sender);
            
            let content = text;
            if (sender === 'admin') {
                content = '<strong>Admin:</strong><br>' + text;
            }

            div.innerHTML = `<div class="message-content">${content}</div>`;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        setInterval(async () => {
            try {
                const response = await fetch('{{ route("chatbot.messages") }}');
                const messages = await response.json();
                const currentCount = chatBox.querySelectorAll('.message').length;
                if (messages.length > currentCount) {
                    chatBox.innerHTML = ''; // Clear
                    messages.forEach(msg => {
                        addMessage(msg.message, msg.sender);
                    });
                }
            } catch (error) {
                console.error('Polling error:', error);
            }
        }, 5000);
    </script>
</body>
</html>
