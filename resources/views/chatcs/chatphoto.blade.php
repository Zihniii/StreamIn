<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo - Customer Service</title>
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
            background-color: #f8f9fa;
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
            text-decoration: none;
        }

        .header-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0;
        }

        .upload-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: calc(100vh - 120px);
            padding: 20px;
        }

        .upload-area {
            width: 100%;
            max-width: 400px;
            background: #fff;
            border: 2px dashed #ccc;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .upload-area:hover {
            border-color: #a94064;
            background-color: #f8f9fa;
        }

        .upload-area.dragover {
            border-color: #a94064;
            background-color: #f0e6dc;
        }

        .upload-icon {
            font-size: 64px;
            color: #a94064;
            margin-bottom: 20px;
        }

        .upload-text {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .upload-subtext {
            font-size: 14px;
            color: #666;
        }

        #fileInput {
            display: none;
        }

        .preview-container {
            display: none;
            width: 100%;
            max-width: 400px;
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }

        .preview-container.show {
            display: block;
        }

        .preview-image {
            max-width: 100%;
            max-height: 400px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-custom {
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-send {
            background-color: #a94064;
            color: white;
        }

        .btn-send:hover {
            background-color: #8f3555;
        }

        .btn-cancel {
            background-color: #e8e8e8;
            color: #333;
        }

        .btn-cancel:hover {
            background-color: #d0d0d0;
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
        <a href="{{ url('/chat') }}" class="back-btn">
            <i class="bi bi-chevron-left"></i>
        </a>
        <div class="header-content">
            <h1 class="header-title">Upload Photo</h1>
        </div>
    </div>

    <!-- Upload Container -->
    <div class="upload-container">
        <!-- Upload Area -->
        <div class="upload-area" id="uploadArea">
            <div class="upload-icon">
                <i class="bi bi-cloud-arrow-up"></i>
            </div>
            <div class="upload-text">Click to upload or drag and drop</div>
            <div class="upload-subtext">PNG, JPG, JPEG up to 10MB</div>
            <input type="file" id="fileInput" accept="image/*">
        </div>

        <!-- Preview Container -->
        <div class="preview-container" id="previewContainer">
            <img id="previewImage" class="preview-image" src="" alt="Preview">
            <div class="button-group">
                <button class="btn-custom btn-cancel" id="cancelBtn">Cancel</button>
                <button class="btn-custom btn-send" id="sendPhotoBtn">Send Photo</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fileInput');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const cancelBtn = document.getElementById('cancelBtn');
        const sendPhotoBtn = document.getElementById('sendPhotoBtn');

        let selectedImageData = null;

        // Click to upload
        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            handleFile(e.target.files[0]);
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            handleFile(file);
        });

        // Handle file
        function handleFile(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    selectedImageData = e.target.result;
                    previewImage.src = selectedImageData;
                    uploadArea.style.display = 'none';
                    previewContainer.classList.add('show');
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select a valid image file');
            }
        }

        // Cancel button
        cancelBtn.addEventListener('click', () => {
            selectedImageData = null;
            previewImage.src = '';
            fileInput.value = '';
            uploadArea.style.display = 'block';
            previewContainer.classList.remove('show');
        });

        // Send photo button
        sendPhotoBtn.addEventListener('click', () => {
            if (selectedImageData) {
                // Save image to localStorage
                localStorage.setItem('uploadedPhoto', selectedImageData);
                // Redirect back to chat page
                window.location.href = '{{ url("/chat") }}';
            }
        });
    </script>
</body>
</html>
