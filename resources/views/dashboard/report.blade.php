 <!--
    =============================================
    Coded by: Zihni Aryanto Putra Buana
    NRP: 5026231012
    =============================================
    -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Trouble - {{ config('app.name', 'Stream.in') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #fff;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            /* Batasi lebar konten di tengah jika di layar desktop */
            width: 100%;
        }

        header {
            background-color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            position: sticky;
            top: 0;
            z-index: 100;
            flex-shrink: 0; /* Pastikan header tidak menciut */
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #1a1a1a;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .back-btn:hover {
            opacity: 0.7;
        }

        .header-title {
            font-size: 17px;
            font-weight: 600;
            flex: 1;
            text-align: center;
            margin-right: 28px;
        }

        .content {
            /* Membuat konten mengisi semua ruang yang tersisa */
            flex-grow: 1;
            display: flex;
            flex-direction: column; /* Konten di dalam content juga diatur vertikal */
            padding: 20px;
            overflow-y: auto;
        }

        #reportForm {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 24px;
        }

        /* Memberikan margin-bottom yang besar ke form group terakhir untuk mendorong tombol submit ke bawah */
        #reportForm > .form-group:last-of-type {
            margin-bottom: auto;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            display: block;
        }

        .form-subtitle {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
        }

        .input-field,
        .textarea-field,
        .select-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background-color: white;
            transition: border-color 0.2s;
        }

        .input-field:focus,
        .textarea-field:focus,
        .select-field:focus {
            outline: none;
            border-color: #c9184a;
        }

        .textarea-field {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .select-field {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23666' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        .photo-upload {
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            background-color: #fafafa;
            cursor: pointer;
            transition: all 0.2s;
            display: block;
        }

        .photo-upload:hover {
            border-color: #c9184a;
            background-color: #fff5f7;
        }

        .photo-upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .photo-upload-text {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 4px;
        }

        .photo-upload-subtext {
            font-size: 12px;
            color: #999;
        }

        .photo-preview {
            display: none;
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            min-height: 120px;
        }

        .photo-preview img {
            width: 100%;
            height: auto;
            max-height: 300px;
            object-fit: cover;
            border-radius: 12px;
            display: block;
        }

        .photo-preview-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            z-index: 20;
        }

        .photo-preview-remove:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s;
            margin-top: 8px; /* Jarak atas tombol submit */
            flex-shrink: 0; /* Pastikan tombol submit tidak menciut */
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Modal/Popup (Dibiarkan sama) */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
            /* Pastikan modal muncul di tengah viewport penuh */
            max-width: none;
        }

        .modal.show {
            display: flex;
        }

        /* ... Modal Content dan lainnya CSSnya tetap ... */
        @keyframes modalSlideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-content {
            background-color: white;
            border-radius: 16px;
            padding: 32px 24px 24px;
            max-width: 340px;
            width: 100%;
            text-align: center;
            animation: modalSlideUp 0.3s ease-out;
        }

        .modal-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 16px;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #155724;
            font-size: 28px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .modal-message {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .modal-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .modal-btn:hover {
            opacity: 0.9;
        }

        .hidden {
            display: none;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .form-group.error .input-field,
        .form-group.error .textarea-field,
        .form-group.error .select-field {
            border-color: #dc3545;
        }
    </style>
</head>

<body>
    <header>
        <a href="{{ route('dashboard.packages.detail', $subscription->userSubscriptionID ?? '#') }}" class="back-btn">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h1 class="header-title">Report Trouble</h1>
    </header>

    <div class="content">
        <form id="reportForm" action="{{ route('report.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="userSubscriptionID" value="{{ $subscription->userSubscriptionID ?? '' }}">

            <div class="form-group">
                <label class="form-label">What's your problem?</label>
                <select name="issueCategory" id="issueCategory" class="select-field" required>
                    <option value="">Select a problem</option>
                    <option value="Login Issue">Can't Login</option>
                    <option value="Account">Account Suspended</option>
                    <option value="Playback">Playback Error</option>
                    <option value="Payment">Billing Issue</option>
                    <option value="Video Quality">Video Quality Issue</option>
                    <option value="Other">Other</option>
                </select>
                <span class="error-message" id="categoryError">Please select a problem category</span>
            </div>

            <div class="form-group">
                <label class="form-label">Describe your problem</label>
                <textarea name="issueDescription" id="issueDescription" class="textarea-field" placeholder="Tell us what happened..."
                    required></textarea>
                <span class="error-message" id="descriptionError">Please describe your problem</span>
            </div>

            <div class="form-group">
                <label class="form-label">Photo (if any)</label>

                <div class="photo-upload" id="photoUploadPlaceholder"
                    onclick="document.getElementById('photoInput').click()">
                    <div class="photo-upload-icon">
                        <i class="fas fa-camera"></i>
                    </div>
                    <p class="photo-upload-text">Take a photo or choose from gallery</p>
                    <p class="photo-upload-subtext">Max 5MB - JPG, PNG</p>
                </div>

                <input type="file" name="attachment" id="photoInput" accept="image/*" capture="environment"
                    class="hidden" onchange="previewPhoto(event)">

                <div class="photo-preview" id="photoPreview">
                    <img id="previewImage" src="" alt="Preview">
                    <button type="button" class="photo-preview-remove" onclick="removePhoto()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                Submit
            </button>
        </form>
    </div>

    <div class="modal" id="successModal">
        <div class="modal-content">
            <div class="modal-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="modal-title">Your Report Has Been Sent</h2>
            <p class="modal-message">
                We've received your report and will get back to you as soon as possible. Thank you for your patience!
            </p>
            <button class="modal-btn" onclick="closeModal()">
                Back to Dashboard
            </button>
        </div>
    </div>

    <script>
        let selectedFile = null;

        function previewPhoto(event) {
            const file = event.target.files[0];
            const photoPreview = document.getElementById('photoPreview');
            const photoPlaceholder = document.getElementById('photoUploadPlaceholder');

            if (!file) {
                // If file selection is cancelled and no file was previously selected
                if (!selectedFile) {
                    photoPlaceholder.style.display = 'block';
                    photoPreview.style.display = 'none';
                }
                return;
            }

            // Validate file size (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                event.target.value = '';
                return;
            }

            // Validate file type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file');
                event.target.value = '';
                return;
            }

            selectedFile = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImage').src = e.target.result;
                // HIDE placeholder, SHOW preview
                photoPlaceholder.style.display = 'none';
                photoPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function removePhoto() {
            document.getElementById('photoInput').value = '';
            document.getElementById('photoPreview').style.display = 'none';
            document.getElementById('previewImage').src = '';
            selectedFile = null;

            // SHOW placeholder
            document.getElementById('photoUploadPlaceholder').style.display = 'block';
        }

        function validateForm() {
            let isValid = true;

            // Validate category
            const category = document.getElementById('issueCategory');
            const categoryError = document.getElementById('categoryError');
            const categoryGroup = category.closest('.form-group');

            if (!category.value) {
                categoryGroup.classList.add('error');
                categoryError.classList.add('show');
                isValid = false;
            } else {
                categoryGroup.classList.remove('error');
                categoryError.classList.remove('show');
            }

            // Validate description
            const description = document.getElementById('issueDescription');
            const descriptionError = document.getElementById('descriptionError');
            const descriptionGroup = description.closest('.form-group');

            if (!description.value.trim()) {
                descriptionGroup.classList.add('error');
                descriptionError.classList.add('show');
                isValid = false;
            } else {
                descriptionGroup.classList.remove('error');
                descriptionError.classList.remove('show');
            }

            return isValid;
        }

        document.getElementById('reportForm').addEventListener('submit', function(e) {
            e.preventDefault();

            if (!validateForm()) {
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        // Note: Ensure your Laravel setup handles CSRF token correctly
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('successModal').classList.add('show');
                    } else {
                        alert(data.message || 'Failed to submit report. Please try again.');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit';
                });
        });

        function closeModal() {
            // Note: Blade syntax {{ route('dashboard') }} is kept as a placeholder
            window.location.href = '{{ route('dashboard') }}';
        }

        // Remove error styling on input
        document.getElementById('issueCategory').addEventListener('change', function() {
            this.closest('.form-group').classList.remove('error');
            document.getElementById('categoryError').classList.remove('show');
        });

        document.getElementById('issueDescription').addEventListener('input', function() {
            this.closest('.form-group').classList.remove('error');
            document.getElementById('descriptionError').classList.remove('show');
        });
    </script>
</body>

</html>
