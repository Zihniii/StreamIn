<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History Details - {{ config('app.name', 'Stream.in') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container-wrapper {
            width: 100%;
            margin: 0;
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .header {
            background-color: #fff;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            width: 100%;
        }

        @media (min-width: 768px) {
            .header {
                padding: 20px 40px;
            }
        }

        @media (min-width: 1024px) {
            .header {
                padding: 20px 60px;
            }
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            text-align: center;
            margin: 0;
        }

        .back-button {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #333;
            text-decoration: none;
            font-size: 20px;
        }

        .service-card-wrapper {
            width: 100%;
        }

        .service-card {
            background: linear-gradient(135deg, #c41e3a 0%, #e50914 100%);
            border-radius: 12px;
            padding: 20px;
            margin: 15px;
            color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            width: calc(100% - 30px);
        }

        @media (min-width: 768px) {
            .service-card {
                margin: 20px 40px;
                padding: 30px;
                width: calc(100% - 80px);
            }
        }

        @media (min-width: 1024px) {
            .service-card {
                margin: 25px 60px;
                padding: 30px;
                width: calc(100% - 120px);
            }
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .service-logo {
            display: flex;
            align-items: center;
            gap: 15px;
            position: relative;
            z-index: 1;
        }

        .service-logo-box {
            width: 60px;
            height: 60px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .service-logo-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .service-title {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }

        .package-info {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .section {
            background-color: white;
            margin: 15px;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            width: calc(100% - 30px);
        }

        @media (min-width: 768px) {
            .section {
                margin: 20px 40px;
                padding: 30px;
                width: calc(100% - 80px);
            }
        }

        @media (min-width: 1024px) {
            .section {
                margin: 25px 60px;
                width: calc(100% - 120px);
            }
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: #666;
            font-size: 14px;
        }

        .detail-value {
            color: #333;
            font-size: 14px;
            font-weight: 500;
            text-align: right;
        }

        .status-badge {
            background-color: #e8f5e9;
            color: #2e7d32;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #4caf50;
            display: inline-block;
        }

        .status-badge.expired {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ef5350;
        }

        .account-access {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .account-info {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .account-label {
            font-size: 14px;
            color: #666;
        }

        .account-email {
            font-size: 14px;
            color: #333;
            font-weight: 500;
        }

        .chevron {
            color: #ccc;
            font-size: 18px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .price-label {
            color: #666;
            font-size: 14px;
        }

        .price-value {
            color: #e50914;
            font-size: 14px;
            font-weight: 600;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            border-top: 2px solid #f0f0f0;
            margin-top: 10px;
        }

        .total-label {
            color: #333;
            font-size: 16px;
            font-weight: 600;
        }

        .total-value {
            color: #333;
            font-size: 18px;
            font-weight: 700;
        }

        .buy-again-btn {
            background-color: white;
            color: #e50914;
            border: 2px solid #e50914;
            padding: 15px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            width: calc(100% - 30px);
            margin: 20px 15px;
            transition: all 0.3s;
            cursor: pointer;
        }

        @media (min-width: 768px) {
            .buy-again-btn {
                width: calc(100% - 80px);
                margin: 30px 40px;
                padding: 18px;
                font-size: 18px;
            }
        }

        @media (min-width: 1024px) {
            .buy-again-btn {
                width: calc(100% - 120px);
                margin: 40px 60px;
            }
        }

        .buy-again-btn:hover {
            background-color: #e50914;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(228, 9, 20, 0.3);
        }

        .bottom-indicator {
            width: 40%;
            height: 5px;
            background-color: #e0e0e0;
            border-radius: 10px;
            margin: 20px auto 30px;
        }

        @media (min-width: 768px) {
            .bottom-indicator {
                width: 30%;
            }
        }

        @media (min-width: 1024px) {
            .bottom-indicator {
                width: 20%;
            }
        }

        @media (min-width: 1200px) {
            /* Wrapper untuk service card agar konsisten dengan grid */
            .service-card-wrapper {
                padding: 0 60px;
            }

            .service-card {
                margin: 25px 0;
                width: 100%;
            }

            .content-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 25px;
                padding: 0 60px;
                margin-top: 25px;
            }

            .content-grid .section {
                margin: 0;
                width: 100%;
            }

            .section.full-width {
                grid-column: 1 / -1;
            }
        }
    </style>
</head>

<body>
    <div class="container-wrapper">
        <!-- Header -->
        <div class="header">
            <a href="{{ route('dashboard.orders') }}" class="back-button">
                <i class="fas fa-chevron-left"></i>
            </a>
            <h1 class="header-title">Order History Details</h1>
        </div>

        <!-- Service Card -->
        <div class="service-card-wrapper">
            <div class="service-card">
                <div class="service-logo">
                    <div class="service-logo-box">
                        @php
                        $logoPath = asset('img/' . $payment->package->logoSubscription);
                        $fallbackPath = asset('img/logo_netflix.png');
                        @endphp
                        <img id="serviceLogo" 
                             src="{{ $logoPath }}"
                             alt="{{ $payment->package->serviceName }}">
                    </div>
                    <div>
                        <h2 class="service-title">{{ $payment->package->serviceName }}</h2>
                        <p class="package-info">{{ $payment->package->descriptionDurasi ?? $payment->package->durasiPackage . ' days package' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction Details -->
        <div class="content-grid">
            <div class="section">
                <h3 class="section-title">Transaction Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Order ID</span>
                    <span class="detail-value">TRX-{{ str_pad($payment->paymentID, 8, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order Date</span>
                    <span class="detail-value">{{ \Carbon\Carbon::parse($payment->paymentDate)->format('H.i d F Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Method</span>
                    <span class="detail-value">{{ $payment->paymentMethod->methodName ?? 'N/A' }}</span>
                </div>
            </div>

            <!-- Subscription Details -->
            <div class="section">
                <h3 class="section-title">Subscription Details</h3>
                @if($subscription)
                <span class="status-badge {{ $subscription->status == 'active' ? '' : 'expired' }}">
                    {{ ucfirst($subscription->status) }}
                </span>
                <div class="account-access">
                    <div class="account-info">
                        <span class="account-label">Account Access</span>
                        <span class="account-email">
                            {{ $subscription->accountPackage->usernamePackage ?? 'N/A' }}
                        </span>
                    </div>
                    <i class="fas fa-chevron-right chevron"></i>
                </div>
                @else
                <p class="text-muted">No subscription data available</p>
                @endif
            </div>

            <!-- Payment Summary -->
            <div class="section full-width">
                <h3 class="section-title">Payment Summary</h3>
                <div class="price-row">
                    <span class="price-label">{{ $payment->package->serviceName }} {{ $payment->package->descriptionDurasi }}</span>
                    <span class="price-value">Rp{{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
                <div class="price-row">
                    <span class="price-label">Admin Fee</span>
                    <span class="price-value">Rp{{ number_format($payment->adminFee ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="price-row">
                    <span class="price-label">Discount Voucher</span>
                    <span class="price-value">
                        @if($payment->discount)
                        - Rp{{ number_format($payment->discount->discountValue, 0, ',', '.') }}
                        @else
                        -
                        @endif
                    </span>
                </div>
                <div class="total-row">
                    <span class="total-label">Total Price</span>
                    <span class="total-value">
                        Rp{{ number_format($payment->amount + ($payment->adminFee ?? 0) - ($payment->discount->discountValue ?? 0), 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Buy Again Button -->
        <a href="{{ route('homepage') }}" class="buy-again-btn" style="display: block; text-align: center; text-decoration: none;">
            Buy Again
        </a>
    </div>

    <script>
        // Handle image error fallback
        document.getElementById('serviceLogo').onerror = function() {
            this.onerror = null;
            this.src = '{{ asset("img/logo_netflix.png") }}';
        };
        
        // Handle buy again button
        document.getElementById('buyAgainBtn').addEventListener('click', function() {
            window.location.href = '{{ route("homepage") }}';
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>