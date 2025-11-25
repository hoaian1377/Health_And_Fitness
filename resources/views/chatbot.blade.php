<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
        body { font-family: sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; }
        #chat-box { border: 1px solid #ccc; padding: 10px; height: 300px; overflow-y: scroll; margin-bottom: 10px; }
        .message { margin-bottom: 5px; }
        .user { color: blue; text-align: right; }
        .bot { color: green; }
        input[type="text"] { width: 70%; padding: 5px; }
        button { padding: 5px 10px; }
    </style>
</head>
<body>
    <h1>Chatbot Support</h1>
    <div id="chat-box"></div>
    <input type="text" id="question" placeholder="Ask something...">
    <button onclick="askQuestion()">Send</button>

    <script>
        async function askQuestion() {
            const questionInput = document.getElementById('question');
            const question = questionInput.value;
            if (!question) return;

            addMessage(question, 'user');
            questionInput.value = '';

            try {
                const response = await fetch('/chatbot/ask', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                    },
                    body: JSON.stringify({ question: question })
                });
                const data = await response.json();
                addMessage(data.answer, 'bot');
            } catch (error) {
                console.error('Error:', error);
                addMessage('Sorry, something went wrong.', 'bot');
            }
        }

        function addMessage(text, sender) {
            const chatBox = document.getElementById('chat-box');
            const div = document.createElement('div');
            div.classList.add('message', sender);
            div.textContent = (sender === 'user' ? 'You: ' : 'Bot: ') + text;
            chatBox.appendChild(div);
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>
</body>
</html>
