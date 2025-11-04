<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .payment-container {
            max-width: 428px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .page {
            display: none;
        }

        .page.active {
            display: block;
        }

        .header {
            padding: 12px 16px;
            border-bottom: 1px solid #e5e5e5;
            display: flex;
            align-items: center;
            background-color: white;
        }

        .header h1 {
            font-size: 17px;
            font-weight: 600;
            margin: 0;
            flex: 1;
            text-align: center;
        }

        .back-btn {
            font-size: 18px;
            color: #333;
            text-decoration: none;
            cursor: pointer;
        }

        .progress-bar-container {
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .progress-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: white;
        }

        .progress-circle.active {
            background-color: #e50914;
        }

        .progress-circle.inactive {
            background-color: #999;
        }

        .progress-line {
            flex: 1;
            height: 2px;
            background-color: #e5e5e5;
            position: relative;
        }

        .progress-line.filled::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            background-color: #e50914;
        }

        .netflix-package {
            margin: 16px;
            padding: 16px;
            background-color: #f8f8f8;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .netflix-logo {
            width: 48px;
            height: 48px;
            background-color: #e50914;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: 900;
            color: white;
            font-family: 'Helvetica Neue', sans-serif;
        }

        .package-info h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .package-info p {
            font-size: 12px;
            color: #666;
            margin: 4px 0 0 0;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .change-package-btn {
            margin-left: auto;
            color: #e50914;
            font-size: 13px;
            font-weight: 500;
            border: 1px solid #e50914;
            padding: 6px 16px;
            border-radius: 4px;
            background-color: white;
            cursor: pointer;
        }

        .section-title {
            font-size: 15px;
            font-weight: 600;
            margin: 20px 16px 12px;
        }

        .payment-method-item {
            display: flex;
            align-items: center;
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            position: relative;
        }

        .payment-method-item:hover {
            background-color: #f8f8f8;
        }

        .payment-logo {
            width: 40px;
            height: 24px;
            object-fit: contain;
            margin-right: 12px;
        }

        .payment-name {
            font-size: 14px;
            color: #333;
            flex: 1;
        }

        .payment-radio {
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-radius: 50%;
            position: relative;
        }

        .payment-radio.selected {
            border-color: #e50914;
        }

        .payment-radio.selected::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #e50914;
            border-radius: 50%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .voucher-section {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .voucher-section:hover {
            background-color: #f8f8f8;
        }

        .voucher-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .voucher-icon {
            width: 24px;
            height: 24px;
            background-color: #e50914;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .voucher-text {
            font-size: 14px;
            color: #333;
        }

        .voucher-desc {
            font-size: 11px;
            color: #999;
            display: block;
        }

        .payment-summary {
            margin-top: 24px;
            padding: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .summary-label {
            font-size: 13px;
            color: #666;
        }

        .summary-value {
            font-size: 13px;
            color: #333;
            font-weight: 500;
        }

        .discount-row {
            color: #e50914;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding-top: 16px;
            border-top: 1px solid #e5e5e5;
            margin-top: 16px;
        }

        .total-label {
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .total-value {
            font-size: 20px;
            font-weight: 700;
            color: #e50914;
        }

        .checkout-btn {
            background-color: #8b1538;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            width: calc(100% - 32px);
            margin: 0 16px 24px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #a01842;
        }

        .checkout-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Payment Detail Page */
        .payment-detail-box {
            background-color: #f8f8f8;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .detail-label {
            font-size: 13px;
            color: #666;
        }

        .detail-value {
            font-size: 13px;
            color: #e50914;
            font-weight: 600;
        }

        .payment-provider-box {
            margin: 24px 16px;
            text-align: center;
        }

        .provider-logo-large {
            width: 120px;
            height: auto;
            margin: 0 auto 16px;
        }

        .provider-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .timer-box {
            background-color: #fff3cd;
            border: 1px solid #ffc107;
            border-radius: 8px;
            padding: 12px;
            margin: 16px;
            text-align: center;
        }

        .timer-label {
            font-size: 12px;
            color: #856404;
            margin-bottom: 4px;
        }

        .timer-value {
            font-size: 24px;
            font-weight: 700;
            color: #856404;
            font-family: 'Courier New', monospace;
        }

        .qr-code-box {
            text-align: center;
            margin: 24px 16px;
        }

        .qr-code {
            width: 200px;
            height: 200px;
            margin: 0 auto 16px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
        }

        .qr-download-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #e50914;
            font-size: 13px;
            font-weight: 500;
            margin-top: 12px;
            cursor: pointer;
            text-decoration: none;
        }

        .account-number-box {
            background-color: #f8f8f8;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .account-number {
            font-size: 18px;
            font-weight: 600;
            font-family: 'Courier New', monospace;
        }

        .copy-btn {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 13px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .copy-btn:hover {
            background-color: #f8f8f8;
        }

        .change-method-btn {
            background-color: white;
            color: #8b1538;
            border: 2px solid #8b1538;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            width: calc(50% - 24px);
            margin: 0 8px 24px;
            cursor: pointer;
        }

        .confirm-payment-btn {
            background-color: #8b1538;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            width: calc(50% - 24px);
            margin: 0 8px 24px;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            padding: 0 8px;
        }

        /* Success Page */
        .success-container {
            text-align: center;
            padding: 60px 24px;
        }

        .success-icon {
            width: 120px;
            height: 120px;
            background-color: #8b1538;
            border-radius: 50%;
            margin: 0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .checkmark {
            width: 60px;
            height: 60px;
            border: 6px solid white;
            border-left: none;
            border-top: none;
            transform: rotate(45deg);
            margin-top: -12px;
        }

        .success-title {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }

        .success-message {
            font-size: 14px;
            color: #666;
            margin-bottom: 32px;
        }

        .dashboard-btn {
            background-color: #8b1538;
            color: white;
            border: none;
            padding: 14px 48px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        /* Modal Styles */
        .voucher-modal .modal-content {
            border-radius: 16px 16px 0 0;
            border: none;
        }

        .voucher-modal .modal-header {
            border-bottom: 1px solid #e5e5e5;
            padding: 16px;
        }

        .voucher-modal .modal-title {
            font-size: 17px;
            font-weight: 600;
        }

        .voucher-input-group {
            padding: 16px;
        }

        .voucher-input-group label {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
            display: block;
        }

        .voucher-input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }

        .voucher-list {
            padding: 0 16px;
        }

        .voucher-item {
            display: flex;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
        }

        .voucher-item-icon {
            width: 32px;
            height: 32px;
            background-color: #e50914;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            margin-right: 12px;
        }

        .voucher-item-info {
            flex: 1;
        }

        .voucher-item-title {
            font-size: 14px;
            font-weight: 500;
            margin: 0;
        }

        .voucher-item-desc {
            font-size: 11px;
            color: #999;
            margin: 2px 0 0 0;
        }

        .confirm-btn {
            background-color: #8b1538;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            width: calc(100% - 32px);
            margin: 16px 16px 24px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <!-- Page 1: Payment Selection -->
        <div id="page1" class="page active">
            <div class="header">
                <a href="#" class="back-btn">‹</a>
                <h1>Payment Details</h1>
                <div style="width: 18px;"></div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-circle active">1</div>
                <div class="progress-line filled"></div>
                <div class="progress-circle inactive">2</div>
                <div class="progress-line"></div>
                <div class="progress-circle inactive">3</div>
            </div>

            <div class="netflix-package">
                <div class="netflix-logo">N</div>
                <div class="package-info">
                    <h3>Netflix</h3>
                    <p>📅 3 days package</p>
                </div>
                <button class="change-package-btn">Change Package</button>
            </div>

            <div class="section-title">Payment Method</div>

            <div class="payment-method-item" data-method="qris" onclick="selectPayment(this)">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/2560px-QRIS_logo.svg.png" alt="QRIS" class="payment-logo" style="width: 50px;">
                <span class="payment-name">QRIS</span>
                <div class="payment-radio"></div>
            </div>

            <div class="payment-method-item" data-method="bca" onclick="selectPayment(this)">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" alt="BCA" class="payment-logo">
                <span class="payment-name">Bank BCA</span>
                <div class="payment-radio"></div>
            </div>

            <div class="payment-method-item" data-method="bni" onclick="selectPayment(this)">
                <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/2560px-BNI_logo.svg.png" alt="BNI" class="payment-logo">
                <span class="payment-name">Bank BNI</span>
                <div class="payment-radio"></div>
            </div>

            <div class="payment-method-item" data-method="mandiri" onclick="selectPayment(this)">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="payment-logo">
                <span class="payment-name">Bank Mandiri</span>
                <div class="payment-radio"></div>
            </div>

            <div class="voucher-section" data-bs-toggle="modal" data-bs-target="#voucherModal">
                <div class="voucher-left">
                    <div class="voucher-icon">🎟</div>
                    <div>
                        <div class="voucher-text">Voucher</div>
                        <span class="voucher-desc">Use your voucher and get special offers</span>
                    </div>
                </div>
                <span>›</span>
            </div>

            <div class="payment-summary">
                <div class="section-title" style="margin: 0 0 16px 0;">Payment Detail</div>
                <div class="summary-row">
                    <span class="summary-label">Netflix Packages (3 Days)</span>
                    <span class="summary-value">Rp30.000</span>
                </div>
                <div id="discountRow" class="summary-row discount-row" style="display: none;">
                    <span class="summary-label">Discount</span>
                    <span class="summary-value" id="discountAmount">-Rp3.000</span>
                </div>

                <div class="total-row">
                    <span class="total-label">Total Price</span>
                    <span class="total-value" id="totalPrice">Rp30.000</span>
                </div>
            </div>

            <button class="checkout-btn" id="checkoutBtn" disabled onclick="goToPaymentDetail()">Checkout</button>
        </div>

        <!-- Page 2: Payment Detail (QRIS) -->
        <div id="pageQRIS" class="page">
            <div class="header">
                <span class="back-btn" onclick="goToPage('page1')">‹</span>
                <h1>Payment Details</h1>
                <div style="width: 18px;"></div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-circle active">1</div>
                <div class="progress-line filled"></div>
                <div class="progress-circle active">2</div>
                <div class="progress-line"></div>
                <div class="progress-circle inactive">3</div>
            </div>

            <div class="payment-detail-box">
                <div class="section-title" style="margin: 0 0 16px 0;">Payment Detail</div>
                <div class="detail-row">
                    <span class="detail-label">Netflix Packages (3 Days)</span>
                    <span class="detail-value">Rp30.000</span>
                </div>
                <div class="detail-row" id="qrisDiscountRow" style="display: none;">
                    <span class="detail-label">Discount</span>
                    <span class="detail-value" id="qrisDiscountAmount">-Rp3.000</span>
                </div>
                <div class="detail-row" style="padding-top: 12px; border-top: 1px solid #ddd;">
                    <span class="detail-label" style="font-weight: 600;">Total Price</span>
                    <span class="detail-value" style="font-size: 16px;" id="qrisTotalPrice">Rp30.000</span>
                </div>
            </div>

            <div class="payment-provider-box">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/2560px-QRIS_logo.svg.png" alt="QRIS" style="width: 100px;">
            </div>

            <div class="timer-box">
                <div class="timer-label">Time remaining</div>
                <div class="timer-value" id="qrisTimer">00:09:10</div>
            </div>

            <div class="qr-code-box">
                <div class="qr-code">
                    <svg viewBox="0 0 200 200">
                        <rect width="200" height="200" fill="white"/>
                        <g fill="black">
                            <!-- QR Code Pattern -->
                            <rect x="0" y="0" width="60" height="60"/>
                            <rect width="40" height="40" x="10" y="10" fill="white"/>
                            <rect width="20" height="20" x="20" y="20"/>
                            <rect x="140" y="0" width="60" height="60"/>
                            <rect width="40" height="40" x="150" y="10" fill="white"/>
                            <rect width="20" height="20" x="160" y="20"/>
                            <rect x="0" y="140" width="60" height="60"/>
                            <rect width="40" height="40" x="10" y="150" fill="white"/>
                            <rect width="20" height="20" x="20" y="160"/>
                            <rect x="80" y="20" width="20" height="20"/>
                            <rect x="120" y="20" width="20" height="20"/>
                            <rect x="80" y="60" width="40" height="20"/>
                            <rect x="140" y="80" width="20" height="40"/>
                            <rect x="80" y="100" width="20" height="40"/>
                            <rect x="120" y="140" width="40" height="20"/>
                            <rect x="80" y="160" width="20" height="20"/>
                        </g>
                    </svg>
                </div>
                <a href="#" class="qr-download-btn">
                    <span>📥</span>
                    <span>Download QR Code</span>
                </a>
            </div>

            <div class="button-group">
                <button class="change-method-btn" onclick="goToPage('page1')">Change Method</button>
                <button class="confirm-payment-btn" onclick="goToSuccess()">Confirm Payment</button>
            </div>
        </div>

        <!-- Page 3: Payment Detail (Bank Transfer) -->
        <div id="pageBankTransfer" class="page">
            <div class="header">
                <span class="back-btn" onclick="goToPage('page1')">‹</span>
                <h1>Payment Details</h1>
                <div style="width: 18px;"></div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-circle active">1</div>
                <div class="progress-line filled"></div>
                <div class="progress-circle active">2</div>
                <div class="progress-line"></div>
                <div class="progress-circle inactive">3</div>
            </div>

            <div class="payment-detail-box">
                <div class="section-title" style="margin: 0 0 16px 0;">Payment Detail</div>
                <div class="detail-row">
                    <span class="detail-label">Netflix Packages (3 Days)</span>
                    <span class="detail-value">Rp30.000</span>
                </div>
                <div class="detail-row" id="bankDiscountRow" style="display: none;">
                    <span class="detail-label">Discount</span>
                    <span class="detail-value" id="bankDiscountAmount">-Rp3.000</span>
                </div>
                <div class="detail-row" style="padding-top: 12px; border-top: 1px solid #ddd;">
                    <span class="detail-label" style="font-weight: 600;">Total Price</span>
                    <span class="detail-value" style="font-size: 16px;" id="bankTotalPrice">Rp30.000</span>
                </div>
            </div>

            <div class="payment-provider-box">
                <img id="bankLogo" src="" alt="Bank" style="width: 100px;">
                <div class="provider-title" id="bankName">BCA Virtual Account</div>
            </div>

            <div class="timer-box">
                <div class="timer-label">Time remaining</div>
                <div class="timer-value" id="bankTimer">00:09:10</div>
            </div>

            <div class="account-number-box">
                <div>
                    <div style="font-size: 12px; color: #666; margin-bottom: 4px;">Virtual Account Number</div>
                    <div class="account-number" id="accountNumber">1220989765432</div>
                </div>
                <button class="copy-btn" onclick="copyAccountNumber()">
                    <span>📋</span>
                    <span>Copy</span>
                </button>
            </div>

            <div class="button-group">
                <button class="change-method-btn" onclick="goToPage('page1')">Change Method</button>
                <button class="confirm-payment-btn" onclick="goToSuccess()">Confirm Payment</button>
            </div>
        </div>

        <!-- Page 4: Success -->
        <div id="pageSuccess" class="page">
            <div class="header">
                <div style="width: 18px;"></div>
                <h1>Payment Details</h1>
                <div style="width: 18px;"></div>
            </div>

            <div class="progress-bar-container">
                <div class="progress-circle active">1</div>
                <div class="progress-line filled"></div>
                <div class="progress-circle active">2</div>
                <div class="progress-line filled"></div>
                <div class="progress-circle active">3</div>
            </div>

            <div class="success-container">
                <div class="success-icon">
                    <div class="checkmark"></div>
                </div>
                <h2 class="success-title">Payment Successful</h2>
                <p class="success-message">Your package is ready!</p>
                <a href="#" class="dashboard-btn">Go to Dashboard</a>
            </div>
        </div>
    </div>

    <!-- Voucher Modal -->
    <div class="modal fade voucher-modal" id="voucherModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-bottom modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="voucher-input-group">
                        <label>Referral Code</label>
                        <input type="text" placeholder="Insert your referral code" id="referralCode">
                    </div>

                    <div class="section-title" style="margin: 16px 16px 8px;">Your Voucher</div>

                    <div class="voucher-list">
                        <div class="voucher-item" data-discount="22500" data-name="75% Off" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">75% Off</p>
                                <p class="voucher-item-desc">Only for new user</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>

                        <div class="voucher-item" data-discount="1000" data-name="Rp1.000 Cashback" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">Rp1.000 Cashback</p>
                                <p class="voucher-item-desc">Min. transaction cashback</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>

                        <div class="voucher-item" data-discount="3000" data-name="10% Discount" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">10% Discount</p>
                                <p class="voucher-item-desc">Min. 100.000 purchase</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>
                    </div>

                    <button class="confirm-btn" onclick="applyVoucher()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedPaymentMethod = null;
        let selectedVoucher = null;
        let voucherModal = null;

        // Timer variables
        let timerInterval = null;
        let timeRemaining = 550; // 9:10 in seconds

        document.addEventListener('DOMContentLoaded', function() {
            voucherModal = new bootstrap.Modal(document.getElementById('voucherModal'));
        });

        function selectPayment(element) {
            // Remove selected class from all payment methods
            document.querySelectorAll('.payment-method-item .payment-radio').forEach(radio => {
                radio.classList.remove('selected');
            });

            // Add selected class to clicked payment method
            element.querySelector('.payment-radio').classList.add('selected');

            // Store selected payment method
            selectedPaymentMethod = element.getAttribute('data-method');

            // Enable checkout button
            document.getElementById('checkoutBtn').disabled = false;
        }

        function selectVoucher(element) {
            // Remove selected class from all vouchers
            document.querySelectorAll('.voucher-item .payment-radio').forEach(radio => {
                radio.classList.remove('selected');
            });

            // Add selected class to clicked voucher
            element.querySelector('.payment-radio').classList.add('selected');

            // Store selected voucher
            selectedVoucher = {
                discount: parseInt(element.getAttribute('data-discount')),
                name: element.getAttribute('data-name')
            };
        }

        function applyVoucher() {
            if (selectedVoucher) {
                const originalPrice = 30000;
                const discountAmount = selectedVoucher.discount;
                const totalPrice = originalPrice - discountAmount;

                // Update page 1
                document.getElementById('discountRow').style.display = 'flex';
                document.getElementById('discountAmount').textContent = '-Rp' + discountAmount.toLocaleString('id-ID');
                document.getElementById('totalPrice').textContent = 'Rp' + totalPrice.toLocaleString('id-ID');

                // Update QRIS page
                document.getElementById('qrisDiscountRow').style.display = 'flex';
                document.getElementById('qrisDiscountAmount').textContent = '-Rp' + discountAmount.toLocaleString('id-ID');
                document.getElementById('qrisTotalPrice').textContent = 'Rp' + totalPrice.toLocaleString('id-ID');

                // Update Bank Transfer page
                document.getElementById('bankDiscountRow').style.display = 'flex';
                document.getElementById('bankDiscountAmount').textContent = '-Rp' + discountAmount.toLocaleString('id-ID');
                document.getElementById('bankTotalPrice').textContent = 'Rp' + totalPrice.toLocaleString('id-ID');
            }

            // Close modal
            voucherModal.hide();
        }

        function goToPaymentDetail() {
            if (!selectedPaymentMethod) {
                alert('Please select a payment method');
                return;
            }

            if (selectedPaymentMethod === 'qris') {
                goToPage('pageQRIS');
            } else {
                // Setup bank transfer page
                setupBankTransferPage(selectedPaymentMethod);
                goToPage('pageBankTransfer');
            }

            // Start timer
            startTimer();
        }

        function setupBankTransferPage(bank) {
            const bankLogos = {
                'bca': 'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png',
                'bni': 'https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/2560px-BNI_logo.svg.png',
                'mandiri': 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png'
            };

            const bankNames = {
                'bca': 'BCA Virtual Account',
                'bni': 'BNI Virtual Account',
                'mandiri': 'Mandiri Virtual Account'
            };

            const accountNumbers = {
                'bca': '1220989765432',
                'bni': '1220989765432',
                'mandiri': '1220989765432'
            };

            document.getElementById('bankLogo').src = bankLogos[bank];
            document.getElementById('bankName').textContent = bankNames[bank];
            document.getElementById('accountNumber').textContent = accountNumbers[bank];
        }

        function goToPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });

            // Show selected page
            document.getElementById(pageId).classList.add('active');

            // Reset timer when going back to page 1
            if (pageId === 'page1') {
                stopTimer();
                timeRemaining = 550;
            }
        }

        function startTimer() {
            stopTimer(); // Clear any existing timer
            timeRemaining = 550; // Reset to 9:10

            timerInterval = setInterval(() => {
                timeRemaining--;

                const minutes = Math.floor(timeRemaining / 60);
                const seconds = timeRemaining % 60;
                const timeString = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

                // Update both timers
                const qrisTimer = document.getElementById('qrisTimer');
                const bankTimer = document.getElementById('bankTimer');

                if (qrisTimer) qrisTimer.textContent = timeString;
                if (bankTimer) bankTimer.textContent = timeString;

                if (timeRemaining <= 0) {
                    stopTimer();
                    alert('Payment time expired!');
                    goToPage('page1');
                }
            }, 1000);
        }

        function stopTimer() {
            if (timerInterval) {
                clearInterval(timerInterval);
                timerInterval = null;
            }
        }

        function copyAccountNumber() {
            const accountNumber = document.getElementById('accountNumber').textContent;

            // Copy to clipboard
            navigator.clipboard.writeText(accountNumber).then(() => {
                // Show feedback
                const copyBtn = event.currentTarget;
                const originalText = copyBtn.innerHTML;
                copyBtn.innerHTML = '<span>✓</span><span>Copied</span>';
                copyBtn.style.backgroundColor = '#d4edda';
                copyBtn.style.borderColor = '#28a745';
                copyBtn.style.color = '#28a745';

                setTimeout(() => {
                    copyBtn.innerHTML = originalText;
                    copyBtn.style.backgroundColor = '';
                    copyBtn.style.borderColor = '';
                    copyBtn.style.color = '';
                }, 2000);
            }).catch(err => {
                alert('Failed to copy: ' + err);
            });
        }

        function goToSuccess() {
            stopTimer();
            goToPage('pageSuccess');
        }
    </script>
</body>
</html>
