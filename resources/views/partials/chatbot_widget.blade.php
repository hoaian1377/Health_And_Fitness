<div id="chatbot-widget">
    <!-- Chat Button -->
    <button id="chatbot-toggle" class="chatbot-btn">
        <i class="fa-solid fa-comments"></i>
    </button>

    <!-- Chat Window -->
    <div id="chatbot-window" class="chatbot-window hidden">
        <div class="chatbot-header">
            <div class="chatbot-title">
                <i class="fa-solid fa-robot"></i> HealthFit
            </div>
            <button id="chatbot-close" class="chatbot-close-btn">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="message bot">
                <div class="message-content">
                    Xin chào! Tôi có thể giúp gì cho bạn hôm nay?
                </div>
            </div>
        </div>
        <div class="chatbot-input-area">
            <input type="text" id="chatbot-input" placeholder="Nhập câu hỏi..." autocomplete="off">
            <button id="chatbot-send">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<style>
    /* Widget Container */
    #chatbot-widget {
        position: fixed;
        bottom: 100px;
        right: 20px;
        z-index: 1000;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Toggle Button */
    .chatbot-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        font-size: 24px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chatbot-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    /* Chat Window */
    .chatbot-window {
        position: absolute;
        bottom: 130px;
        right: 0;
        width: 350px;
        height: 450px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform-origin: bottom right;
    }

    .chatbot-window.hidden {
        transform: scale(0);
        opacity: 0;
        pointer-events: none;
    }

    /* Header */
    .chatbot-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .chatbot-title {
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .chatbot-close-btn {
        background: none;
        border: none;
        color: white;
        cursor: pointer;
        font-size: 18px;
        opacity: 0.8;
        transition: opacity 0.2s;
    }

    .chatbot-close-btn:hover {
        opacity: 1;
    }

    /* Messages Area */
    .chatbot-messages {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #f9f9f9;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .message {
        display: flex;
        flex-direction: column;
        max-width: 80%;
    }

    .message.user {
        align-self: flex-end;
        align-items: flex-end;
    }

    .message.bot {
        align-self: flex-start;
        align-items: flex-start;
    }

    .message-content {
        padding: 10px 15px;
        border-radius: 15px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
    }

    .message.user .message-content {
        background: #667eea;
        color: white;
        border-bottom-right-radius: 2px;
    }

    .message.bot .message-content {
        background: #e0e0e0;
        color: #333;
        border-bottom-left-radius: 2px;
    }

    /* Input Area */
    .chatbot-input-area {
        padding: 15px;
        border-top: 1px solid #eee;
        display: flex;
        gap: 10px;
        background: white;
    }

    #chatbot-input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 20px;
        outline: none;
        transition: border-color 0.3s;
    }

    #chatbot-input:focus {
        border-color: #667eea;
    }

    #chatbot-send {
        background: #667eea;
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #chatbot-send:hover {
        background: #764ba2;
    }

    /* Scrollbar */
    .chatbot-messages::-webkit-scrollbar {
        width: 6px;
    }
    .chatbot-messages::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .chatbot-messages::-webkit-scrollbar-thumb {
        background: #ccc;
        border-radius: 3px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('chatbot-toggle');
        const closeBtn = document.getElementById('chatbot-close');
        const window = document.getElementById('chatbot-window');
        const input = document.getElementById('chatbot-input');
        const sendBtn = document.getElementById('chatbot-send');
        const messagesContainer = document.getElementById('chatbot-messages');

        // Toggle Window
        function toggleChat() {
            window.classList.toggle('hidden');
            if (!window.classList.contains('hidden')) {
                input.focus();
            }
        }

        toggleBtn.addEventListener('click', toggleChat);
        closeBtn.addEventListener('click', toggleChat);

        // Send Message
        async function sendMessage() {
            const text = input.value.trim();
            if (!text) return;

            // Add User Message
            addMessage(text, 'user');
            input.value = '';

            // Loading state (optional)
            // ...

            try {
                const response = await fetch('/chatbot/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ question: text })
                });

                const data = await response.json();
                addMessage(data.answer, 'bot');

            } catch (error) {
                console.error('Error:', error);
                addMessage('Xin lỗi, có lỗi xảy ra. Vui lòng thử lại sau.', 'bot');
            }
        }

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        function addMessage(text, sender) {
            const div = document.createElement('div');
            div.classList.add('message', sender);
            
            const content = document.createElement('div');
            content.classList.add('message-content');
            content.textContent = text;
            
            div.appendChild(content);
            messagesContainer.appendChild(div);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    });
</script>
