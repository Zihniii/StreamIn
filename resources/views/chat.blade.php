<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .mobile-container {
            max-width: 375px;
            margin: 20px auto;
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            height: 667px;
            display: flex;
            flex-direction: column;
        }

        .status-bar {
            padding: 8px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
        }

        .status-icons {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .header {
            background: white;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #e5e5e5;
        }

        .back-button {
            background: none;
            border: none;
            font-size: 20px;
            padding: 0;
            cursor: pointer;
        }

        .header-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 16px;
        }

        .chat-container {
            flex: 1;
            overflow-y: auto;
            padding: 20px 16px;
            background: #f9f9f9;
        }

        .message {
            margin-bottom: 12px;
            max-width: 80%;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-user {
            margin-left: auto;
            text-align: right;
        }

        .message-bubble {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
        }

        .message-user .message-bubble {
            background: #fff5f0;
            color: #a64625;
            border: 1px solid #f0ddd5;
        }

        .message-bot .message-bubble {
            background: #e8e8e8;
            color: #333;
        }

        .input-container {
            background: white;
            padding: 12px 16px;
            border-top: 1px solid #e5e5e5;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .input-wrapper {
            flex: 1;
            position: relative;
        }

        .message-input {
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 24px;
            padding: 10px 40px 10px 16px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .message-input:focus {
            border-color: #999;
        }

        .attach-button {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            font-size: 18px;
        }

        .file-input {
            display: none;
        }

        .attached-file {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f0f0f0;
            padding: 8px 12px;
            border-radius: 12px;
            margin: 8px 0;
            font-size: 13px;
        }

        .attached-file .remove-file {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 16px;
            padding: 0;
            line-height: 1;
        }

        .file-preview {
            max-width: 200px;
            border-radius: 12px;
            margin: 8px 0;
        }

        .message-file {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: #f0f0f0;
            border-radius: 12px;
            margin-top: 8px;
            font-size: 13px;
        }

        .send-button {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a64d79 0%, #8b3d5f 100%);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .send-button:hover {
            transform: scale(1.05);
        }

        .send-button:active {
            transform: scale(0.95);
        }

        .suggested-response {
            display: inline-block;
            background: #f0f0f0;
            color: #333;
            padding: 10px 16px;
            border-radius: 18px;
            font-size: 13px;
            margin: 8px 0;
            cursor: pointer;
            transition: background 0.2s;
        }

        .suggested-response:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <!-- Status Bar -->
        <div class="status-bar">
            <div>9:41</div>
            <div class="status-icons">
                <i class="bi bi-reception-4"></i>
                <i class="bi bi-wifi"></i>
                <i class="bi bi-battery-full"></i>
            </div>
        </div>

        <!-- Header -->
        <div class="header">
            <button class="back-button">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div class="header-title">
                <i class="bi bi-headset"></i>
                Customer Service
            </div>
        </div>

        <!-- Chat Container -->
        <div class="chat-container" id="chatContainer">
            <div class="message message-user">
                <div class="message-bubble">How can I Help?</div>
            </div>
            <div class="message message-bot">
                <div class="message-bubble">Account Not Working</div>
            </div>
            <div class="message message-user">
                <div class="message-bubble">Got it. Let me help you with that. Could you tell me what's not working with your account?</div>
            </div>
            <div class="message message-bot">
                <div class="message-bubble">Account suspended or banned</div>
            </div>
            <div class="message message-user">
                <div class="message-bubble">Understood. We take this seriously. May I know the reason or message you received regarding the suspension?</div>
            </div>
        </div>

        <!-- Input Container -->
        <div class="input-container">
            <div class="input-wrapper">
                <input type="text" class="message-input" placeholder="Write your issue here..." id="messageInput">
                <button class="attach-button" id="attachButton">
                    <i class="bi bi-paperclip"></i>
                </button>
                <input type="file" class="file-input" id="fileInput" multiple accept="image/*,.pdf,.doc,.docx,.txt">
            </div>
            <button class="send-button" id="sendButton">
                <i class="bi bi-send-fill"></i>
            </button>
        </div>
        <div id="attachedFiles" style="padding: 0 16px;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const messageInput = document.getElementById('messageInput');
        const sendButton = document.getElementById('sendButton');
        const chatContainer = document.getElementById('chatContainer');
        const attachButton = document.getElementById('attachButton');
        const fileInput = document.getElementById('fileInput');
        const attachedFilesContainer = document.getElementById('attachedFiles');

        let selectedFiles = [];

        function addMessage(text, isUser, files = []) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${isUser ? 'message-bot' : 'message-user'}`;

            const bubbleDiv = document.createElement('div');
            bubbleDiv.className = 'message-bubble';

            if (text) {
                bubbleDiv.textContent = text;
            }

            messageDiv.appendChild(bubbleDiv);

            // Add files to message
            if (files.length > 0) {
                files.forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const img = document.createElement('img');
                        img.src = file.url;
                        img.className = 'file-preview';
                        img.alt = file.name;
                        messageDiv.appendChild(img);
                    } else {
                        const fileDiv = document.createElement('div');
                        fileDiv.className = 'message-file';
                        fileDiv.innerHTML = `
                            <i class="bi bi-file-earmark"></i>
                            <span>${file.name}</span>
                        `;
                        messageDiv.appendChild(fileDiv);
                    }
                });
            }

            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function displayAttachedFiles() {
            attachedFilesContainer.innerHTML = '';

            if (selectedFiles.length > 0) {
                selectedFiles.forEach((file, index) => {
                    const fileDiv = document.createElement('div');
                    fileDiv.className = 'attached-file';
                    fileDiv.innerHTML = `
                        <i class="bi bi-${file.type.startsWith('image/') ? 'image' : 'file-earmark'}"></i>
                        <span>${file.name}</span>
                        <button class="remove-file" onclick="removeFile(${index})">
                            <i class="bi bi-x"></i>
                        </button>
                    `;
                    attachedFilesContainer.appendChild(fileDiv);
                });
            }
        }

        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            displayAttachedFiles();
        }

        attachButton.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);

            files.forEach(file => {
                const fileData = {
                    name: file.name,
                    type: file.type,
                    size: file.size
                };

                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        fileData.url = e.target.result;
                        selectedFiles.push(fileData);
                        displayAttachedFiles();
                    };
                    reader.readAsDataURL(file);
                } else {
                    selectedFiles.push(fileData);
                    displayAttachedFiles();
                }
            });

            fileInput.value = '';
        });

        function sendMessage() {
            const text = messageInput.value.trim();

            if (text || selectedFiles.length > 0) {
                addMessage(text, false, selectedFiles);
                messageInput.value = '';
                selectedFiles = [];
                displayAttachedFiles();

                // Simulate bot response
                setTimeout(() => {
                    addMessage("Thank you for that information. Let me look into this for you.", true);
                }, 1000);
            }
        }

        sendButton.addEventListener('click', sendMessage);

        messageInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
</body>
</html>
