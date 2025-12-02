<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful - {{ $subscription->serviceName }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 480px;
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        /* Success Icon */
        .success-header {
            padding: 48px 24px 24px;
            text-align: center;
            background: linear-gradient(135deg, #c1184a 0%, #e91e63 100%);
        }

        .success-icon {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: scaleIn 0.5s ease;
        }

        @keyframes scaleIn {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .success-icon .material-icons {
            font-size: 64px;
            color: #4caf50;
        }

        .success-title {
            font-size: 24px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
        }

        .success-subtitle {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
        }

        /* Content */
        .content {
            padding: 24px;
        }

        .info-card {
            background: #f8f8f8;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .info-title {
            font-size: 14px;
            font-weight: 600;
            color: #666;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .info-label {
            font-size: 14px;
            color: #666;
        }

        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            text-align: right;
        }

        /* Account Details */
        .account-card {
            background: linear-gradient(135deg, #c1184a 0%, #e91e63 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
        }

        .account-card-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 16px;
            opacity: 0.9;
        }

        .credential-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 8px;
        }

        .credential-row:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            font-size: 13px;
            opacity: 0.9;
        }

        .credential-value {
            font-size: 14px;
            font-weight: 600;
            font-family: 'Courier New', monospace;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .copy-icon {
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.3s ease;
            font-size: 18px;
        }

        .copy-icon:hover {
            opacity: 1;
        }

        /* Important Note */
        .note-card {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .note-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #856404;
            margin-bottom: 8px;
        }

        .note-text {
            font-size: 13px;
            color: #856404;
            line-height: 1.6;
        }

        /* Buttons */
        .button-group {
            display: flex;
            gap: 12px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background: #c1184a;
            color: white;
        }

        .btn-primary:hover {
            background: #a01340;
            box-shadow: 0 4px 12px rgba(193, 24, 74, 0.3);
        }

        .btn-secondary {
            background: white;
            color: #c1184a;
            border: 2px solid #c1184a;
        }

        .btn-secondary:hover {
            background: #fff5f8;
        }

        /* Mobile Responsive */
        @media (max-width: 767px) {
            .success-header {
                padding: 32px 20px 20px;
            }

            .success-icon {
                width: 100px;
                height: 100px;
            }

            .success-icon .material-icons {
                font-size: 52px;
            }

            .success-title {
                font-size: 20px;
            }

            .content {
                padding: 20px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Success Header -->
        <div class="success-header">
            <div class="success-icon">
                <span class="material-icons">check_circle</span>
            </div>
            <h1 class="success-title">Payment Successful</h1>
            <p class="success-subtitle">Your package is ready!</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Transaction Info -->
            <div class="info-card">
                <h3 class="info-title">Transaction Details</h3>
                <div class="info-row">
                    <span class="info-label">Service</span>
                    <span class="info-value">{{ $subscription->serviceName }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Package</span>
                    <span class="info-value">{{ $subscription->descriptionDurasi }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Valid Until</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($subscription->endDate)->format('d M Y, H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value" style="color: #4caf50;">Active</span>
                </div>
            </div>

            <!-- Account Credentials -->
            <div class="account-card">
                <h3 class="account-card-title">Your Account Credentials</h3>
                <div class="credential-row">
                    <span class="credential-label">Username</span>
                    <div class="credential-value">
                        <span id="username">{{ $subscription->usernamePackage }}</span>
                        <span class="material-icons copy-icon" onclick="copyText('username')">content_copy</span>
                    </div>
                </div>
                <div class="credential-row">
                    <span class="credential-label">Password</span>
                    <div class="credential-value">
                        <span id="password">{{ $subscription->passwordPackage }}</span>
                        <span class="material-icons copy-icon" onclick="copyText('password')">content_copy</span>
                    </div>
                </div>
            </div>

            <!-- Important Note -->
            <div class="note-card">
                <div class="note-title">
                    <span class="material-icons" style="font-size: 18px;">info</span>
                    Important Note
                </div>
                <p class="note-text">
                    Please save your credentials. You can access your account details anytime from your dashboard. Do not share your account with others.
                </p>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                    <span class="material-icons" style="font-size: 20px;">dashboard</span>
                    Go to Dashboard
                </a>
            </div>
        </div>
    </div>

    <script>
        // Copy text function
        function copyText(fieldId) {
            const text = document.getElementById(fieldId).textContent;
            navigator.clipboard.writeText(text).then(() => {
                const icon = event.target;
                const originalIcon = icon.textContent;
                icon.textContent = 'check';
                icon.style.color = '#4caf50';
                
                setTimeout(() => {
                    icon.textContent = originalIcon;
                    icon.style.color = '';
                }, 2000);
            });
        }

        // Confetti animation (optional)
        window.addEventListener('load', () => {
            // Add celebration effect if needed
            console.log('Payment successful!');
        });
    </script>
</body>
</html>