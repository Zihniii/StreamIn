<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* semua CSS kamu tetap */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen;
            overflow: hidden;
            height: 100vh;
        }
        .status-bar{display:flex;justify-content:space-between;align-items:center;padding:12px 24px 8px;background:#fff}
        .time{font-weight:600;font-size:17px}
        .status-icons{display:flex;gap:5px;align-items:center}
        .status-icons i{font-size:16px}
        .header{display:flex;align-items:center;padding:12px 16px;background:#fff;border-bottom:1px solid #e5e5e5}
        .back-btn{background:none;border:none;font-size:24px;margin-right:12px;color:#000;cursor:pointer}
        .header-content{flex:1;display:flex;align-items:center;justify-content:center}
        .header-icon{width:32px;height:32px;background:#000;border-radius:50%;display:flex;align-items:center;justify-content:center;margin-right:8px}
        .header-icon i{color:#fff;font-size:18px}
        .header-title{font-size:18px;font-weight:600;margin:0}
        .chat-area{padding:20px;background:#f8f9fa;height:calc(100vh - 140px);overflow-y:auto}
        .message{display:inline-block;padding:12px 16px;border-radius:18px;margin-bottom:10px;max-width:75%;font-size:15px}
        .message-bot{background:#f0e6dc;color:#8b4513;border-bottom-left-radius:4px}
        .message-user{background:#e8e8e8;color:#333;border-bottom-right-radius:4px}
        .message-container-left{text-align:left;margin-bottom:10px}
        .message-container-right{text-align:right;margin-bottom:10px}
        .input-area{position:fixed;bottom:0;left:0;right:0;padding:16px;background:#fff;border-top:1px solid #e5e5e5}
        .input-group-custom{display:flex;gap:12px;align-items:center}
        .message-input{flex:1;border:none;background:#f0f0f0;border-radius:24px;padding:12px 20px;font-size:15px}
        .message-input:focus{outline:none;background:#e8e8e8}
        .attachment-btn{background:none;border:none;color:#666;font-size:22px;padding:8px;cursor:pointer}
        .send-btn{background:#a94064;border:none;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;cursor:pointer}
        .send-btn i{color:#fff;font-size:20px}
        .message-image{max-width:200px;border-radius:12px;margin-top:5px}
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <button class="back-btn" onclick="window.location.href='{{ route('homepage') }}'">

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

        <!-- Greeting pertama -->
        <div class="message-container-left">
            <div class="message message-bot">How can I help?</div>
        </div>

        <!-- Pesan dari database -->
        @foreach($messages as $msg)
            @if($msg->sender === 'user')
                <div class="message-container-right">
                    <div class="message message-user">

                        {{ $msg->messageText }}

                        @if($msg->attachment)
                            <br>
                            <img src="{{ asset('uploads/'.$msg->attachment) }}" class="message-image">
                        @endif

                    </div>
                </div>
            @else
                <div class="message-container-left">
                    <div class="message message-bot">

                        {{ $msg->messageText }}

                        @if($msg->attachment)
                            <br>
                            <img src="{{ asset('uploads/'.$msg->attachment) }}" class="message-image">
                        @endif

                    </div>
                </div>
            @endif
        @endforeach

    </div>

    <!-- Input Area -->
    <div class="input-area">

        <!-- Form Foto (hidden) -->
        <form id="photoForm" action="{{ route('chat.send.photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="userID" value="{{ $userID }}">
            <input type="file" id="attachmentInput" name="attachment" accept="image/*" style="display:none;">
        </form>

        <!-- Form Text -->
        <form action="{{ route('chat.send') }}" method="POST">
            @csrf
            <input type="hidden" name="userID" value="{{ $userID }}">

            <div class="input-group-custom">

                <!-- Tombol Attach Foto -->
                <label for="attachmentInput" class="attachment-btn">
                    <i class="bi bi-paperclip"></i>
                </label>

                <!-- Input pesan -->
                <input type="text" name="message" class="message-input" placeholder="Write your issue here..." required>

                <button type="submit" class="send-btn">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
        </form>
    </div>

    <!-- Auto-submit foto -->
    <script>
        document.getElementById('attachmentInput').addEventListener('change', function() {
            if (this.files.length > 0) {
                document.getElementById('photoForm').submit();
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let chat = document.getElementById("chatArea");
            chat.scrollTop = chat.scrollHeight;
        });
    </script>

</body>
</html>
