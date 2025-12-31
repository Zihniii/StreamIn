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
    <title>Issue Detail - {{ config('app.name', 'Stream.in') }}</title>
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
            padding-bottom: 100px;
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

        .header-title {
            font-size: 17px;
            font-weight: 600;
            flex: 1;
            text-align: center;
            margin-right: 28px;
        }

        .content {
            padding: 20px;
        }

        .package-card {
            background-color: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .package-header {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .package-icon {
            width: 64px;
            height: 64px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        .package-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .package-info h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .package-duration {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .package-date {
            font-size: 12px;
            color: #dc3545;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-section {
            background-color: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .section-label {
            font-size: 12px;
            font-weight: 600;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .section-content {
            font-size: 15px;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .photo-section img {
            width: 100%;
            border-radius: 12px;
            margin-top: 12px;
        }

        .response-section {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            border: 1px solid #bae6fd;
        }

        .response-section .section-label {
            color: #0369a1;
        }

        .response-greeting {
            font-size: 15px;
            margin-bottom: 12px;
        }

        .updated-date {
            font-size: 13px;
            color: #666;
            margin-top: 16px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .action-buttons {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: 0 auto;
            background: white;
            padding: 16px 20px;
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.2s;
            text-decoration: none;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-outline {
            background-color: white;
            color: #28a745;
            border: 2px solid #28a745;
        }

        .btn-primary {
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: flex-end;
            justify-content: center;
            padding: 0;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background-color: white;
            border-radius: 24px 24px 0 0;
            padding: 24px 20px 32px;
            width: 100%;
            max-width: 480px;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .modal-handle {
            width: 40px;
            height: 4px;
            background-color: #ddd;
            border-radius: 2px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .radio-group {
            margin-bottom: 20px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-option:hover {
            border-color: #c9184a;
            background-color: #fff5f7;
        }

        .radio-option input[type="radio"] {
            width: 20px;
            height: 20px;
            margin-right: 12px;
            accent-color: #c9184a;
        }

        .radio-option label {
            font-size: 14px;
            cursor: pointer;
            flex: 1;
        }

        .modal-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .success-modal .modal-content {
            text-align: center;
            border-radius: 24px;
            margin: 20px;
            padding: 40px 24px;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #155724;
            font-size: 36px;
        }

        .success-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .success-message {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        /* New Issue Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            display: block;
        }

        .textarea-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            background-color: white;
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }

        .textarea-field:focus {
            outline: none;
            border-color: #c9184a;
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

        .hidden {
            display: none;
        }

        /* Mark as Solved Modal */
        .solved-modal .modal-content {
            text-align: center;
            border-radius: 24px;
            margin: 20px;
            padding: 40px 24px;
        }

        .solved-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #155724;
            font-size: 36px;
        }

        .solved-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .solved-message {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 24px;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .modal-btn-secondary {
            flex: 1;
            padding: 12px;
            background-color: white;
            color: #666;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .modal-btn-primary {
            flex: 1;
            padding: 12px;
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <a href="{{ route('report.list') }}" class="back-btn">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h1 class="header-title">Issue Detail</h1>
    </header>

    <div class="content">
        <!-- Package Card -->
        <div class="package-card">
            <div class="package-header">
                <div class="package-icon">
                    @if ($report->subscription && $report->subscription->package)
                        <img src="{{ asset('img/' . $report->subscription->package->logoSubscription) }}"
                            alt="{{ $report->subscription->package->serviceName }}"
                            onerror="this.src='{{ asset('img/default-platform.png') }}'">
                    @else
                        <i class="fas fa-box" style="font-size: 32px; color: #999;"></i>
                    @endif
                </div>
                <div class="package-info">
                    <h2>{{ $report->subscription->package->serviceName ?? 'Package' }}</h2>
                    <div class="package-duration">
                        @if ($report->subscription && $report->subscription->package)
                            {{ $report->subscription->package->descriptionDurasi ?? $report->subscription->package->durasiPackage . ' days package' }}
                        @else
                            Package details unavailable
                        @endif
                    </div>
                    <div class="package-date">
                        <i class="fas fa-calendar" style="font-size: 10px;"></i>
                        <span>{{ \Carbon\Carbon::parse($report->createdAt)->format('d F Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Issue Category -->
        <div class="info-section">
            <div class="section-label">Issue</div>
            <div class="section-content">{{ $report->issueCategory }}</div>
        </div>

        <!-- User's Report Description -->
        <div class="info-section">
            <div class="section-label">Your Reports</div>
            <div class="section-content">{{ $report->issueDescription }}</div>
        </div>

        <!-- Photo Attachment -->
        @if ($report->attachment)
            <div class="info-section photo-section">
                <div class="section-label">Photo</div>
                <img src="{{ asset('storage/' . $report->attachment) }}" alt="Report attachment"
                    onerror="this.style.display='none'">
            </div>
        @endif

        <!-- Admin Response -->
        @if ($report->status === 'resolved' || $report->status === 'in_progress')
            <div class="response-section">
                <div class="section-label">Response</div>
                <div class="response-greeting">Hi there! 👋</div>
                <div class="section-content">
                    @if ($report->status === 'in_progress')
                        We're currently working on resolving your issue. Our team is investigating and will get back to
                        you as soon as possible.
                    @elseif($report->status === 'resolved')
                        Your issue has been resolved! We've updated your account and everything should be working now.
                        Please check your dashboard and try logging in again.

                        If you're still having trouble—like not accessing your subscription or seeing the same error—let
                        us know by replying to this message. We're here to help!
                    @endif
                </div>

                @if ($report->updatedAt)
                    <div class="updated-date">
                        <i class="fas fa-clock" style="font-size: 11px;"></i>
                        Updated on {{ \Carbon\Carbon::parse($report->updatedAt)->format('F j, Y') }}
                    </div>
                @endif
            </div>
        @else
            <div class="info-section">
                <div class="section-label">Status</div>
                <div class="section-content">
                    @if ($report->status === 'pending')
                        ⏳ Your report is being reviewed. We'll get back to you soon!
                    @endif
                </div>
            </div>
        @endif
    </div>

    <!-- Action Buttons - Only show if status is resolved -->
    @if ($report->status === 'resolved')
        <div class="action-buttons">
            <button class="btn btn-outline" onclick="openSolvedModal()">
                <i class="fas fa-check-circle"></i>
                Mark as Solved
            </button>
            <button class="btn btn-primary" onclick="openFeedbackModal()">
                <i class="fas fa-exclamation-triangle"></i>
                Still Trouble
            </button>
        </div>
    @endif

    <!-- Mark as Solved Modal -->
    <div class="modal solved-modal" id="solvedModal">
        <div class="modal-content">
            <div class="solved-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="solved-title">Mark Issue as Solved?</h2>
            <p class="solved-message">
                Are you sure this issue has been resolved? This will close the report.
            </p>
            <div class="modal-buttons">
                <button class="modal-btn-secondary" onclick="closeSolvedModal()">
                    Cancel
                </button>
                <button class="modal-btn-primary" onclick="confirmSolved()">
                    Yes, Mark as Solved
                </button>
            </div>
        </div>
    </div>

    <!-- Feedback Modal - Same Issue or Different -->
    <div class="modal" id="feedbackModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-handle"></div>
            </div>
            <h2 class="modal-title">Do you have the same issue?</h2>
            <form id="feedbackForm">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->reportID }}">
                <div class="radio-group">
                    <div class="radio-option">
                        <input type="radio" id="same" name="feedback" value="same" required>
                        <label for="same">Yes, I have the same issue</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="different" name="feedback" value="different" required>
                        <label for="different">No, I have a different issue</label>
                    </div>
                </div>
                <button type="submit" class="modal-btn">Continue</button>
            </form>
        </div>
    </div>

    <!-- New Issue Form Modal (for different issue) -->
    <div class="modal" id="newIssueModal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-handle"></div>
            </div>
            <h2 class="modal-title">Report New Issue</h2>
            <form id="newIssueForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->reportID }}">
                <input type="hidden" name="userSubscriptionID"
                    value="{{ $report->subscription->userSubscriptionID ?? '' }}">
                <input type="hidden" name="issueCategory" value="{{ $report->issueCategory }}">

                <div class="form-group">
                    <label class="form-label">Describe your new issue</label>
                    <textarea name="issueDescription" id="newIssueDescription" class="textarea-field"
                        placeholder="Describe what's happening now..." required></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Photo (if any)</label>
                    <div class="photo-upload" id="newPhotoUpload"
                        onclick="document.getElementById('newPhotoInput').click()">
                        <div class="photo-upload-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <p class="photo-upload-text">Take a photo or choose from gallery</p>
                        <p class="photo-upload-subtext">Max 5MB - JPG, PNG</p>
                    </div>
                    <input type="file" name="attachment" id="newPhotoInput" accept="image/*" class="hidden">
                    <div class="photo-preview" id="newPhotoPreview">
                        <img id="newPreviewImage" src="" alt="Preview">
                        <button type="button" class="photo-preview-remove" onclick="removeNewPhoto()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="modal-btn" id="submitNewIssueBtn">Submit Report</button>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal success-modal" id="successModal">
        <div class="modal-content">
            <div class="success-icon">
                <i class="fas fa-paper-plane"></i>
            </div>
            <h2 class="success-title">Your Report Has Been Sent</h2>
            <p class="success-message">
                Wait until your problem is reviewed. You can see the solution on dashboard
            </p>
            <button class="modal-btn" onclick="window.location.href='{{ route('report.list') }}'">
                Continue
            </button>
        </div>
    </div>

    <script>
        let selectedFile = null;
        let newSelectedFile = null;

        // Mark as Solved Modal
        function openSolvedModal() {
            document.getElementById('solvedModal').classList.add('show');
        }

        function closeSolvedModal() {
            document.getElementById('solvedModal').classList.remove('show');
        }

        function confirmSolved() {
            // Send AJAX request to mark as solved
            fetch('{{ route('report.mark.solved', $report->reportID) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Thank you for confirming! Your report has been marked as solved.');
                        window.location.href = '{{ route('report.list') }}';
                    } else {
                        alert('Failed to mark as solved. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                })
                .finally(() => {
                    closeSolvedModal();
                });
        }

        // Feedback Modal
        function openFeedbackModal() {
            document.getElementById('feedbackModal').classList.add('show');
        }

        function closeFeedbackModal() {
            document.getElementById('feedbackModal').classList.remove('show');
        }

        // Handle feedback form submission
        document.getElementById('feedbackForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const feedback = document.querySelector('input[name="feedback"]:checked').value;

            if (feedback === 'same') {
                // Same issue - change status to in_progress
                fetch('{{ route('report.update.status', $report->reportID) }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            status: 'in_progress'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeFeedbackModal();
                            document.getElementById('successModal').classList.add('show');
                        } else {
                            alert('Failed to update status. Please try again.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    });
            } else {
                // Different issue - show new issue form
                closeFeedbackModal();
                document.getElementById('newIssueModal').classList.add('show');
            }
        });

        // New Issue Form
        function previewNewPhoto(event) {
            const file = event.target.files[0];
            const photoPreview = document.getElementById('newPhotoPreview');
            const photoPlaceholder = document.getElementById('newPhotoUpload');

            if (!file) {
                if (!newSelectedFile) {
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

            newSelectedFile = file;

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('newPreviewImage').src = e.target.result;
                photoPlaceholder.style.display = 'none';
                photoPreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function removeNewPhoto() {
            document.getElementById('newPhotoInput').value = '';
            document.getElementById('newPhotoPreview').style.display = 'none';
            document.getElementById('newPreviewImage').src = '';
            newSelectedFile = null;
            document.getElementById('newPhotoUpload').style.display = 'block';
        }

        // Handle new issue form submission
        document.getElementById('newIssueForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const submitBtn = document.getElementById('submitNewIssueBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            const formData = new FormData(this);

            fetch('{{ route('report.submit.new') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('newIssueModal').classList.remove('show');
                        document.getElementById('successModal').classList.add('show');
                    } else {
                        alert(data.message || 'Failed to submit report. Please try again.');
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Submit Report';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Submit Report';
                });
        });

        // Initialize photo upload handlers
        document.getElementById('newPhotoInput').addEventListener('change', previewNewPhoto);

        // Close modals when clicking outside
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
