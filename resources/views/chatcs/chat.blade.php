<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            overflow: hidden;
            height: 100vh;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 24px 8px;
            background-color: #fff;
        }

        .time {
            font-weight: 600;
            font-size: 17px;
        }

        .status-icons {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .status-icons i {
            font-size: 16px;
        }

        .header {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            background-color: #fff;
            border-bottom: 1px solid #e5e5e5;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 24px;
            padding: 0;
            margin-right: 12px;
            color: #000;
            cursor: pointer;
        }

        .header-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-icon {
            width: 32px;
            height: 32px;
            background-color: #000;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
        }

        .header-icon i {
            color: #fff;
            font-size: 18px;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .chat-area {
            padding: 20px;
            background-color: #f8f9fa;
            height: calc(100vh - 140px);
            overflow-y: auto;
        }

        .message {
            display: inline-block;
            padding: 12px 16px;
            border-radius: 18px;
            margin-bottom: 10px;
            max-width: 75%;
            font-size: 15px;
        }

        .message-bot {
            background-color: #f0e6dc;
            color: #8b4513;
            border-bottom-left-radius: 4px;
        }

        .message-user {
            background-color: #e8e8e8;
            color: #333;
            border-bottom-right-radius: 4px;
        }

        .message-container-left {
            text-align: left;
            margin-bottom: 10px;
        }

        .message-container-right {
            text-align: right;
            margin-bottom: 10px;
        }

        .input-area {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 16px;
            background-color: #fff;
            border-top: 1px solid #e5e5e5;
        }

        .input-group-custom {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .message-input {
            flex: 1;
            border: none;
            background-color: #f0f0f0;
            border-radius: 24px;
            padding: 12px 20px;
            font-size: 15px;
        }

        .message-input:focus {
            outline: none;
            background-color: #e8e8e8;
        }

        .attachment-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 22px;
            padding: 8px;
            cursor: pointer;
        }

        .send-btn {
            background-color: #a94064;
            border: none;
            border-radius: 50%;
            width: 52px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .send-btn:hover {
            background-color: #8f3555;
        }

        .send-btn i {
            color: #fff;
            font-size: 20px;
        }

        .battery-icon::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 11px;
            border: 2px solid #000;
            border-radius: 2px;
            position: relative;
            margin-right: 2px;
        }

        .battery-icon::after {
            content: '';
            position: absolute;
            width: 18px;
            height: 7px;
            background-color: #000;
            right: 28px;
            margin-top: 2px;
            border-radius: 1px;
        }

        .message-image {
            display: block;
            max-width: 200px;
            border-radius: 12px;
            margin-top: 5px;
        }

        /* Responsive untuk desktop */
        @media (min-width: 768px) {
            .status-bar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Status Bar -->
    <div class="status-bar">
        <div class="time">9:41</div>
        <div class="status-icons">
            <i class="bi bi-reception-4"></i>
            <i class="bi bi-wifi"></i>
            <span class="battery-icon"></span>
        </div>
    </div>

    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.location.href='{{ url('/chat') }}'">
            <i class="bi bi-chevron-left"></i>
        </button>
        <div class="header-content">
            <div class="header-icon">
                <i class="bi bi-person-fill"></i>
            </div>
            <h1 class="header-title">Customer Service</h1>
        </div>
    </div>

    <!-- Chat Area -->
    <div class="chat-area" id="chatArea">
        <!-- Greeting message will be added by JavaScript -->
    </div>

    <!-- Input Area -->
    <div class="input-area">
        <div class="input-group-custom">
            <input type="text" class="message-input" id="messageInput" placeholder="Write your issue here...">
            <a href="{{ url('/chatphoto') }}" class="attachment-btn">
                <i class="bi bi-paperclip"></i>
            </a>
            <button class="send-btn" id="sendBtn">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sendBtn = document.getElementById('sendBtn');
        const messageInput = document.getElementById('messageInput');
        const chatArea = document.getElementById('chatArea');

        // Load chat history from localStorage
        window.addEventListener('DOMContentLoaded', function() {
            // Always add greeting message at the top
            addGreetingMessage();

            // Load previous chat history
            loadChatHistory();

            // Check if there's uploaded photo from chatphoto page
            const uploadedPhoto = localStorage.getItem('uploadedPhoto');
            if (uploadedPhoto) {
                // Add photo message
                const imageMessageDiv = document.createElement('div');
                imageMessageDiv.className = 'message-container-right';
                imageMessageDiv.innerHTML = `
                    <div class="message message-user">
                        <img src="${uploadedPhoto}" class="message-image" alt="uploaded image">
                    </div>
                `;
                chatArea.appendChild(imageMessageDiv);

                // Bot response to image
                setTimeout(() => {
                    const botMessageDiv = document.createElement('div');
                    botMessageDiv.className = 'message-container-left';
                    botMessageDiv.innerHTML = `<div class="message message-bot">Thank you for the image. I'll review this and get back to you shortly.</div>`;
                    chatArea.appendChild(botMessageDiv);
                    saveChatHistory();
                    chatArea.scrollTop = chatArea.scrollHeight;
                }, 1000);

                // Clear uploaded photo from localStorage
                localStorage.removeItem('uploadedPhoto');
                saveChatHistory();
            }

            chatArea.scrollTop = chatArea.scrollHeight;
        });

        function addGreetingMessage() {
            const greetingDiv = document.createElement('div');
            greetingDiv.className = 'message-container-left';
            greetingDiv.innerHTML = `<div class="message message-bot">How can I Help?</div>`;
            chatArea.appendChild(greetingDiv);
        }

        // Predefined bot responses
        const botResponses = {
            'account not working': 'I understand. Could you please provide detail information about your problems?',
            'account suspended or banned': 'Understood. We take this seriously. May I know the reason or message you received regarding the suspension?',
            'default': 'Got it. Let me help you with that. Could you tell me what\'s not working with your account?'
        };

        sendBtn.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });

        function sendMessage() {
            const message = messageInput.value.trim();
            if (message) {
                // Add user message
                const userMessageDiv = document.createElement('div');
                userMessageDiv.className = 'message-container-right';
                userMessageDiv.innerHTML = `<div class="message message-user">${message}</div>`;
                chatArea.appendChild(userMessageDiv);

                messageInput.value = '';
                saveChatHistory();
                chatArea.scrollTop = chatArea.scrollHeight;

                // Simulate bot response after delay
                setTimeout(() => {
                    const botMessageDiv = document.createElement('div');
                    botMessageDiv.className = 'message-container-left';

                    const messageLower = message.toLowerCase();
                    let botReply = botResponses.default;

                    if (messageLower.includes('account not working') || messageLower.includes('not working')) {
                        botReply = botResponses['account not working'];
                    } else if (messageLower.includes('suspended') || messageLower.includes('banned')) {
                        botReply = botResponses['account suspended or banned'];
                    }

                    botMessageDiv.innerHTML = `<div class="message message-bot">${botReply}</div>`;
                    chatArea.appendChild(botMessageDiv);
                    saveChatHistory();
                    chatArea.scrollTop = chatArea.scrollHeight;
                }, 1000);
            }
        }

        function saveChatHistory() {
            localStorage.setItem('chatHistory', chatArea.innerHTML);
        }

        function loadChatHistory() {
            const savedChat = localStorage.getItem('chatHistory');
            if (savedChat) {
                // Create a temporary div to hold the saved chat
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = savedChat;

                // Append all saved messages (skip the greeting since we already added it)
                Array.from(tempDiv.children).forEach(child => {
                    chatArea.appendChild(child);
                });
            }
        }
    </script>
</body>
</html>
