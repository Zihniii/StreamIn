<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Package</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            max-width: 375px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-section {
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            padding-bottom: 20px;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 20px;
            font-size: 14px;
            font-weight: 600;
        }

        .status-icons {
            display: flex;
            gap: 6px;
            align-items: center;
            font-size: 12px;
        }

        .top-nav {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            gap: 12px;
        }

        .back-btn {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .back-arrow {
            width: 10px;
            height: 10px;
            border-left: 2px solid white;
            border-bottom: 2px solid white;
            transform: rotate(45deg);
        }

        .page-title {
            font-size: 17px;
            font-weight: 600;
            flex: 1;
            text-align: center;
            margin-right: 24px;
        }

        .package-card-container {
            padding: 0 20px 20px 20px;
        }

        .package-card {
            background-color: white;
            border-radius: 16px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .package-header {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .package-icon {
            width: 56px;
            height: 56px;
            background-color: #00a8e1;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            color: white;
            flex-shrink: 0;
        }

        .prime-text {
            font-size: 13px;
            font-weight: 700;
            line-height: 1;
        }

        .video-text {
            font-size: 10px;
            font-weight: 400;
            line-height: 1;
        }

        .package-info h2 {
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .package-duration {
            font-size: 13px;
            color: #666;
        }

        .package-expiry {
            font-size: 12px;
            color: #999;
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 4px;
        }

        .calendar-icon {
            width: 12px;
            height: 12px;
            background-color: #dc3545;
            border-radius: 2px;
            position: relative;
        }

        .calendar-icon::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            right: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 1px;
        }

        .time-remaining-section {
            background-color: #fff5f5;
            border-radius: 12px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .time-remaining-label {
            font-size: 13px;
            color: #666;
            flex: 1;
        }

        .clock-icon {
            width: 16px;
            height: 16px;
            border: 2px solid #666;
            border-radius: 50%;
            position: relative;
            flex-shrink: 0;
        }

        .clock-icon::before {
            content: '';
            position: absolute;
            width: 2px;
            height: 5px;
            background-color: #666;
            top: 1px;
            left: 50%;
            transform: translateX(-50%);
        }

        .clock-icon::after {
            content: '';
            position: absolute;
            width: 4px;
            height: 2px;
            background-color: #666;
            top: 5px;
            left: 5px;
        }

        .time-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 12px;
            color: #1a1a1a;
        }

        .info-box {
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
        }

        .info-item:not(:last-child) {
            border-bottom: 1px solid #f0f0f0;
        }

        .info-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #999;
        }

        .user-icon {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #e0e0e0;
            position: relative;
        }

        .user-icon::before {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #999;
            top: 2px;
            left: 5px;
        }

        .user-icon::after {
            content: '';
            position: absolute;
            width: 14px;
            height: 8px;
            border-radius: 50%;
            background-color: #999;
            bottom: 1px;
            left: 2px;
        }

        .key-icon {
            width: 6px;
            height: 12px;
            border: 2px solid #999;
            border-radius: 2px;
            position: relative;
        }

        .key-icon::after {
            content: '';
            position: absolute;
            width: 8px;
            height: 2px;
            background-color: #999;
            right: -8px;
            top: 3px;
        }

        .info-content {
            flex: 1;
        }

        .info-value {
            font-size: 14px;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .copy-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background-color: #f5f5f5;
            border-radius: 6px;
            border: none;
        }

        .copy-icon {
            width: 14px;
            height: 16px;
            border: 2px solid #666;
            border-radius: 2px;
            position: relative;
        }

        .copy-icon::before {
            content: '';
            position: absolute;
            width: 14px;
            height: 16px;
            border: 2px solid #666;
            border-radius: 2px;
            top: -4px;
            left: -4px;
            background-color: white;
        }

        .eye-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background-color: #f5f5f5;
            border-radius: 6px;
            border: none;
            margin-right: 8px;
        }

        .eye-icon {
            width: 18px;
            height: 12px;
            border: 2px solid #666;
            border-radius: 50%;
            position: relative;
        }

        .eye-icon::before {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            background-color: #666;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .rules-box {
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .rules-list {
            list-style: none;
            padding: 0;
        }

        .rules-list li {
            font-size: 13px;
            color: #666;
            padding: 6px 0;
            padding-left: 20px;
            position: relative;
        }

        .rules-list li::before {
            content: '•';
            position: absolute;
            left: 8px;
            color: #1a1a1a;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 20px;
        }

        .btn {
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: transform 0.2s;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-primary {
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
        }

        .btn-secondary {
            background-color: white;
            color: #c9184a;
            border: 2px solid #c9184a;
        }

        .alert-icon {
            width: 18px;
            height: 18px;
            border: 2px solid currentColor;
            border-radius: 50%;
            position: relative;
            flex-shrink: 0;
        }

        .alert-icon::before {
            content: '!';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-weight: 700;
            font-size: 12px;
        }

        .renew-icon {
            width: 16px;
            height: 16px;
            border: 2px solid currentColor;
            border-radius: 50%;
            border-top-color: transparent;
            position: relative;
            flex-shrink: 0;
        }

        .renew-icon::after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-bottom: 6px solid currentColor;
            top: -8px;
            right: -2px;
            transform: rotate(45deg);
        }
    </style>
</head>

<body>
        <div class="top-nav">
            <div class="back-btn" onclick="window.location.href='{{ route('dashboard') }}'">
                <div class="back-arrow"></div>
            </div>
            <div class="page-title">Active Package</div>
        </div>

    <div class="package-card-container">
        <div class="package-card">
            <div class="package-header">
                <div class="package-icon">
                    <span class="prime-text">prime</span>
                    <span class="video-text">video</span>
                </div>
                <div class="package-info">
                    <h2>Prime Video</h2>
                    <div class="package-duration">3 days package</div>
                    <div class="package-expiry">
                        <div class="calendar-icon"></div>
                        31 April 2025 15:20
                    </div>
                </div>
            </div>

            <div class="time-remaining-section">
                <div class="clock-icon"></div>
                <div class="time-remaining-label">Time Remaining</div>
                <div class="time-value">1d 22h 48m</div>
            </div>
        </div>
    </div>
    </div>

    <div class="content">
        <h3 class="section-title">Account</h3>
        <div class="info-box">
            <div class="info-item">
                <div class="info-icon">
                    <div class="user-icon"></div>
                </div>
                <div class="info-content">
                    <div class="info-value">prime3days@gmail.com</div>
                </div>
                <button class="copy-btn">
                    <div class="copy-icon"></div>
                </button>
            </div>
        </div>

        <h3 class="section-title">Password</h3>
        <div class="info-box">
            <div class="info-item">
                <div class="info-icon">
                    <div class="key-icon"></div>
                </div>
                <div class="info-content">
                    <div class="info-value">kindergarten28</div>
                </div>
                <button class="eye-btn">
                    <div class="eye-icon"></div>
                </button>
                <button class="copy-btn">
                    <div class="copy-icon"></div>
                </button>
            </div>
        </div>

        <h3 class="section-title">Rules</h3>
        <div class="rules-box">
            <ul class="rules-list">
                <li>User can't change password</li>
                <li>User can't share the account</li>
            </ul>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary">
                <div class="alert-icon"></div>
                Report Trouble
            </button>
            <button class="btn btn-secondary">
                <div class="renew-icon"></div>
                Renew Package
            </button>
        </div>
    </div>
</body>

</html>
