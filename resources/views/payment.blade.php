<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment - {{ $package->serviceName }}</title>
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
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: #f5f5f5;
            min-height: 100vh;
        }

        .card-wrapper {
            max-width: 480px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
        }

        /* Progress Steps */
        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 24px 20px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
            gap: 12px;
        }

        .step {
            display: flex;
            align-items: center;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
        }

        .step.active .step-circle {
            background: #c1184a;
            color: white;
        }

        .step.completed .step-circle {
            background: #c1184a;
            color: white;
        }

        .step.inactive .step-circle {
            background: #e0e0e0;
            color: #999;
        }

        .step-line {
            width: 60px;
            height: 2px;
            background: #c1184a;
        }

        .step-line.inactive {
            background: #e0e0e0;
        }

        /* Header */
        .header {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }

        .back-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            color: #333;
            border-radius: 50%;
        }

        .back-btn:hover {
            background: #f5f5f5;
        }

        .back-btn .material-icons {
            font-size: 24px;
        }

        .header-title {
            flex: 1;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            padding-right: 40px;
        }

        /* Content */
        .content {
            padding: 24px;
            padding-bottom: 100px;
        }

        /* Payment Summary */
        .payment-summary {
            background: #f8f8f8;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            font-weight: 600;
            color: #333;
        }

        .summary-value.discount {
            color: #c1184a;
        }

        .summary-divider {
            height: 1px;
            background: #e0e0e0;
            margin: 12px 0;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 8px;
        }

        .total-label {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .total-value {
            font-size: 18px;
            font-weight: 700;
            color: #c1184a;
        }

        /* Payment Method Card */
        .payment-method-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-bottom: 24px;
        }

        .payment-method-logo {
            width: 120px;
            height: 80px;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-method-logo img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .payment-method-name {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        /* Timer */
        .timer-section {
            text-align: center;
            margin-bottom: 24px;
        }

        .timer-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 8px;
        }

        .timer-display {
            font-size: 28px;
            font-weight: 700;
            color: #c1184a;
            font-family: 'Courier New', monospace;
        }

        /* QR Code / Account Number */
        .payment-detail-card {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            margin-bottom: 24px;
        }

        .qr-code {
            width: 240px;
            height: 240px;
            margin: 0 auto 16px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qr-code img {
            max-width: 100%;
            max-height: 100%;
        }

        .account-number {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }

        .copy-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #f8f8f8;
            border: 1px solid #e0e0e0;
            padding: 8px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            color: #666;
        }

        .copy-btn:hover {
            background: #c1184a;
            color: white;
            border-color: #c1184a;
        }

        .download-qr-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: white;
            border: 1px solid #c1184a;
            color: #c1184a;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            margin-top: 12px;
        }

        .download-qr-btn:hover {
            background: #fff5f8;
        }

        /* Bottom Fixed */
        .bottom-fixed {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 480px;
            background: white;
            border-top: 1px solid #e0e0e0;
            padding: 16px 20px;
            z-index: 100;
            display: flex;
            gap: 12px;
        }

        .change-method-btn {
            flex: 1;
            background: white;
            color: #c1184a;
            border: 2px solid #c1184a;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .change-method-btn:hover {
            background: #fff5f8;
        }

        .confirm-btn {
            flex: 2;
            background: #c1184a;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .confirm-btn:hover {
            background: #a01340;
            box-shadow: 0 4px 12px rgba(193, 24, 74, 0.3);
        }

        /* Desktop Responsive */
        @media (min-width: 768px) {
            .card-wrapper {
                margin-top: 40px;
                border-radius: 16px;
                box-shadow: 0 4px 24px rgba(0, 0, 0, 0.1);
            }

            .header {
                border-radius: 16px 16px 0 0;
            }
        }

        /* Mobile Responsive */
        @media (max-width: 767px) {
            .card-wrapper {
                max-width: 100%;
            }

            .content {
                padding: 16px;
                padding-bottom: 100px;
            }

            .bottom-fixed {
                max-width: 100%;
                padding: 12px 16px;
            }

            .qr-code {
                width: 200px;
                height: 200px;
            }

            .account-number {
                font-size: 20px;
            }

            .timer-display {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step completed">
                    <div class="step-circle">
                        <span class="material-icons" style="font-size: 20px;">check</span>
                    </div>
                </div>
                <div class="step-line"></div>
                <div class="step active">
                    <div class="step-circle">
                        <span class="material-icons" style="font-size: 20px;">credit_card</span>
                    </div>
                </div>
                <div class="step-line inactive"></div>
                <div class="step inactive">
                    <div class="step-circle">
                        <span class="material-icons" style="font-size: 20px;">receipt</span>
                    </div>
                </div>
            </div>

            <!-- Header -->
            <div class="header">
                <button class="back-btn" onclick="history.back()">
                    <span class="material-icons">chevron_left</span>
                </button>
                <h1 class="header-title">Payment Details</h1>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Payment Summary -->
                <div class="payment-summary">
                    <div class="summary-row">
                        <span class="summary-label">{{ $package->serviceName }} ({{ $package->descriptionDurasi }})</span>
                        <span class="summary-value">Rp{{ number_format($originalPrice, 0, ',', '.') }}</span>
                    </div>
                    @if($discountAmount > 0)
                    <div class="summary-row">
                        <span class="summary-label">Discount Voucher</span>
                        <span class="summary-value discount">-Rp{{ number_format($discountAmount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="summary-divider"></div>
                    <div class="total-row">
                        <span class="total-label">Total Price</span>
                        <span class="total-value">Rp{{ number_format($finalPrice, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="payment-method-card">
                    <div class="payment-method-logo">
                        <img src="{{ asset('img/' . $paymentMethod->icon) }}" alt="{{ $paymentMethod->methodName }}">
                    </div>
                    <div class="payment-method-name">
                        @if($paymentMethod->methodName == 'QRIS')
                            QRIS
                        @elseif($paymentMethod->methodName == 'BCA')
                            BCA Virtual Account
                        @elseif($paymentMethod->methodName == 'BNI')
                            BNI Virtual Account
                        @elseif($paymentMethod->methodName == 'Mandiri')
                            Mandiri Virtual Account
                        @else
                            {{ $paymentMethod->methodName }}
                        @endif
                    </div>
                </div>

                <!-- Timer -->
                <div class="timer-section">
                    <div class="timer-label">Time remaining</div>
                    <div class="timer-display" id="timerDisplay">10:00</div>
                </div>

                <!-- QR Code or Account Number -->
                <div class="payment-detail-card">
                    @if($paymentMethod->methodName == 'QRIS')
                        <div class="qr-code">
                            <img src="{{ asset('img/' . $paymentMethod->detail) }}" alt="QR Code">
                        </div>
                        <a href="{{ asset('img/' . $paymentMethod->detail) }}" download class="download-qr-btn">
                            <span class="material-icons" style="font-size: 18px;">download</span>
                            Download QR Code
                        </a>
                    @else
                        <div class="account-number">{{ explode(' ', $paymentMethod->detail)[0] }}</div>
                        <button class="copy-btn" onclick="copyAccountNumber()">
                            <span class="material-icons" style="font-size: 18px;">content_copy</span>
                            Copy Account Number
                        </button>
                        <p style="margin-top: 12px; font-size: 13px; color: #666;">{{ $paymentMethod->detail }}</p>
                    @endif
                </div>
            </div>

            <!-- Bottom Fixed -->
            <div class="bottom-fixed">
                <button class="change-method-btn" onclick="history.back()">
                    Change Method
                </button>
                <button class="confirm-btn" onclick="confirmPayment()">
                    Confirm Payment
                </button>
            </div>
        </div>
    </div>

    <script>
        // Timer countdown (10 minutes)
        let timeRemaining = 10 * 60; // 10 minutes in seconds

        function updateTimer() {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;
            document.getElementById('timerDisplay').textContent =
                `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            if (timeRemaining <= 0) {
                alert('Payment time expired. Redirecting back...');
                window.location.href = '{{ route("payment.details", ["package" => $package->packageID]) }}';
            }

            timeRemaining--;
        }

        // Start timer
        setInterval(updateTimer, 1000);

        // Copy account number
        function copyAccountNumber() {
            const accountNumber = '{{ explode(" ", $paymentMethod->detail)[0] }}';
            navigator.clipboard.writeText(accountNumber).then(() => {
                const btn = event.target.closest('.copy-btn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '<span class="material-icons" style="font-size: 18px;">check</span> Copied!';
                btn.style.background = '#4caf50';
                btn.style.color = 'white';
                btn.style.borderColor = '#4caf50';

                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                    btn.style.color = '';
                    btn.style.borderColor = '';
                }, 2000);
            });
        }

        // Confirm payment
        function confirmPayment() {
            if (confirm('Have you completed the payment?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("payment.confirm") }}';

                const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        // Check timeout via AJAX periodically
        setInterval(() => {
            fetch('{{ route("payment.check.timeout") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.expired) {
                        alert('Payment session expired. Redirecting back...');
                        window.location.href = '{{ route("payment.details", ["package" => $package->packageID]) }}';
                    }
                });
        }, 30000); // Check every 30 seconds
    </script>
</body>
</html>
