<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subscription->package->serviceName ?? 'Package Details' }} - {{ config('app.name', 'Stream.in') }}
    </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header-section {
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            padding-bottom: 20px;
        }

        .top-nav {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            gap: 12px;
        }

        .back-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .back-btn:hover {
            opacity: 0.8;
        }

        .page-title {
            font-size: 17px;
            font-weight: 600;
            flex: 1;
            text-align: center;
            margin-right: 28px;
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
            width: 80px;
            height: 80px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            background-color: #f0f0f0;
        }

        .package-icon img {
            width: 80%;
            height: 80%;
            object-fit: contain;
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

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 8px;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-expired {
            background-color: #f8d7da;
            color: #721c24;
        }

        .time-remaining-section {
            background-color: #fff5f5;
            border-radius: 12px;
            padding: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .time-remaining-section.expired {
            background-color: #ffe0e0;
        }

        .time-remaining-label {
            font-size: 13px;
            color: #666;
            flex: 1;
        }

        .time-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .time-value.expired {
            color: #dc3545;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background-color: #fff;
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
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);

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
            font-size: 16px;
        }

        .info-content {
            flex: 1;
        }

        .info-value {
            font-size: 14px;
            color: #1a1a1a;
            margin-bottom: 2px;
        }

        .info-value.masked {
            letter-spacing: 2px;
        }

        .copy-btn,
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
            font-size: 14px;
            color: #666;
            transition: background-color 0.2s;
        }

        .copy-btn:hover,
        .eye-btn:hover {
            background-color: #e0e0e0;
        }

        .copy-btn:active,
        .eye-btn:active {
            transform: scale(0.95);
        }

        .eye-btn {
            margin-right: 8px;
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
            color: #2b2b2b;
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
            text-decoration: none;
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

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .empty-account {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        /* Ganti style toast lama dengan yang baru (Toast Berbasis Card) */
        .toast {
            position: fixed;
            top: 30px;
            /* Posisikan lebih ke atas, di bawah header */
            left: 50%;
            transform: translateX(-50%) scale(0.9);
            /* Skala lebih kecil secara default */

            /* Desain seperti Attachment */
            background-color: white;
            color: #1a1a1a;
            padding: 16px 24px;
            border-radius: 12px;
            /* Bulat seperti kartu */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            /* Shadow lebih menonjol */

            font-size: 15px;
            font-weight: 600;
            opacity: 0;
            visibility: hidden;
            /* Sembunyikan sepenuhnya */

            /* Tambahkan transisi untuk animasi smooth */
            transition: opacity 0.3s ease-out, transform 0.3s ease-out, visibility 0.3s;

            z-index: 1000;
            display: flex;
            /* Untuk menyejajarkan ikon dan teks */
            align-items: center;
            gap: 12px;
            max-width: 90%;
        }

        .toast.show {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) scale(1);
            /* Tampilkan dengan skala normal */
        }

        /* Style untuk ikon checklist hijau */
        .toast-icon {
            font-size: 20px;
            color: #28a745;
            /* Warna hijau sukses */
        }
    </style>
</head>

<body>
    <div class="header-section">
        <div class="top-nav">
            <a href="{{ route('dashboard') }}" class="back-btn">
                <i class="fas fa-chevron-left"></i>
            </a>
            <div class="page-title">
                {{ $isActive ? 'Active Package' : 'Package Details' }}
            </div>
        </div>

        <div class="package-card-container">
            <div class="package-card">
                <div class="package-header">
                    <div class="package-icon">
                        <img src="{{ asset('img/' . $subscription->package->logoSubscription) }}"
                            alt="{{ $subscription->package->serviceName }}"
                            onerror="this.src='{{ asset('img/default-platform.png') }}'">
                    </div>
                    <div class="package-info">
                        <h2>{{ $subscription->package->serviceName }}</h2>
                        <div class="package-duration">
                            {{ $subscription->package->descriptionDurasi ?? $subscription->package->durasiPackage . ' days package' }}
                        </div>
                        <div class="package-expiry">
                            <i class="fas fa-calendar" style="color: #dc3545; font-size: 12px;"></i>
                            <span>{{ $endDate->format('d F Y H:i') }}</span>
                        </div>

                        <span class="status-badge {{ $isActive ? 'status-active' : 'status-expired' }}">
                            {{ $isActive ? 'Active' : 'Expired' }}
                        </span>
                    </div>
                </div>

                {{-- All calculations done in controller, just display here --}}
                <div class="time-remaining-section {{ $isExpired ? 'expired' : '' }}">
                    <i class="fas fa-clock" style="font-size: 16px; color: #666;"></i>
                    <div class="time-remaining-label">
                        {{ $isExpired ? 'Expired' : 'Time Remaining' }}
                    </div>
                    <div class="time-value {{ $isExpired ? 'expired' : '' }}">
                        @if ($isExpired)
                            {{ abs($daysRemaining) }}d ago
                        @else
                            {{ $diff->d }}d {{ $diff->h }}h {{ $diff->i }}m
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        @if ($subscription->accountPackage)
            <h3 class="section-title">Account</h3>
            <div class="info-box">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-value">{{ $subscription->accountPackage->usernamePackage }}</div>
                    </div>
                    <button class="copy-btn"
                        onclick="copyToClipboard('{{ $subscription->accountPackage->usernamePackage }}', 'Username')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>

            <h3 class="section-title">Password</h3>
            <div class="info-box">
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <div class="info-content">
                        <div class="info-value masked" id="password-field">••••••••••••</div>
                    </div>
                    <button class="eye-btn" id="toggle-password" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eye-icon"></i>
                    </button>
                    <button class="copy-btn"
                        onclick="copyToClipboard('{{ $subscription->accountPackage->passwordPackage }}', 'Password')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>
        @else
            <div class="empty-account">
                <i class="fas fa-exclamation-circle" style="font-size: 48px; margin-bottom: 12px;"></i>
                <p>No account information available</p>
            </div>
        @endif

        <h3 class="section-title">Rules</h3>
        <div class="rules-box">
            <ul class="rules-list">
                @if ($subscription->package->rulesPackage)
                    @foreach (explode("\n", $subscription->package->rulesPackage) as $rule)
                        @if (trim($rule))
                            <li>{{ trim($rule) }}</li>
                        @endif
                    @endforeach
                @else
                    <li>User can't change password</li>
                    <li>User can't share the account</li>
                    <li>Follow the terms and conditions</li>
                @endif
            </ul>
        </div>

        <div class="action-buttons">
            <button class="btn btn-primary" onclick="reportTrouble()">
                <i class="fas fa-exclamation-triangle"></i>
                Report Trouble
            </button>

            {{-- @if ($isActive)
                <a href="{{ route('packages.renew', $subscription->packageID) }}" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i>
                    Renew Package
                </a>
            @else
                <a href="{{ route('packages.buy', $subscription->packageID) }}" class="btn btn-secondary">
                    <i class="fas fa-shopping-cart"></i>
                    Buy Again
                </a>
            @endif --}}
        </div>
    </div>

    <div id="toast" class="toast">
        <i class="fas fa-check-circle toast-icon"></i>
        <span id="toast-message"></span>
    </div>

    <script>
        let passwordVisible = false;
        const actualPassword = '{{ $subscription->accountPackage->passwordPackage ?? '' }}';

        function togglePassword() {
            const passwordField = document.getElementById('password-field');
            const eyeIcon = document.getElementById('eye-icon');

            passwordVisible = !passwordVisible;

            if (passwordVisible) {
                passwordField.textContent = actualPassword;
                passwordField.classList.remove('masked');
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.textContent = '••••••••••••';
                passwordField.classList.add('masked');
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

        function copyToClipboard(text, label) {
            navigator.clipboard.writeText(text).then(function() {
                showToast(label + ' copied to clipboard!');
            }, function(err) {
                showToast('Failed to copy');
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            const toastMessage = document.getElementById('toast-message');

            toastMessage.textContent = message;
            toast.classList.add('show');

            setTimeout(function() {
                toast.classList.remove('show');
            }, 2000);
        }

        function reportTrouble() {
            window.location.href = '{{ route('report.show', $subscription->userSubscriptionID) }}';
        }
    </script>
</body>

</html>
