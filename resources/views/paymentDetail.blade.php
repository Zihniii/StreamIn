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
        <!-- Header -->
        <div class="header">
            <a href="#" class="back-btn">‹</a>
            <h1>Payment Details</h1>
            <div style="width: 18px;"></div>
        </div>

        <!-- Progress Bar -->
        <div class="progress-bar-container">
            <div class="progress-circle active">1</div>
            <div class="progress-line filled"></div>
            <div class="progress-circle inactive">2</div>
            <div class="progress-line"></div>
            <div class="progress-circle inactive">3</div>
        </div>

        <!-- Netflix Package -->
        <div class="netflix-package">
            <div class="netflix-logo">N</div>
            <div class="package-info">
                <h3>Netflix</h3>
                <p>📅 3 days package</p>
            </div>
            <button class="change-package-btn">Change Package</button>
        </div>

        <!-- Payment Method -->
        <div class="section-title">Payment Method</div>

        <div class="payment-method-item" onclick="selectPayment(this)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/2560px-QRIS_logo.svg.png" alt="QRIS" class="payment-logo" style="width: 50px;">
            <span class="payment-name">QRIS</span>
            <div class="payment-radio"></div>
        </div>

        <div class="payment-method-item" onclick="selectPayment(this)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/2560px-Bank_Central_Asia.svg.png" alt="BCA" class="payment-logo">
            <span class="payment-name">Bank BCA</span>
            <div class="payment-radio"></div>
        </div>

        <div class="payment-method-item" onclick="selectPayment(this)">
            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/2560px-BNI_logo.svg.png" alt="BNI" class="payment-logo">
            <span class="payment-name">Bank BNI</span>
            <div class="payment-radio"></div>
        </div>

        <div class="payment-method-item" onclick="selectPayment(this)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/2560px-Bank_Mandiri_logo_2016.svg.png" alt="Mandiri" class="payment-logo">
            <span class="payment-name">Bank Mandiri</span>
            <div class="payment-radio"></div>
        </div>

        <!-- Voucher Section -->
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

        <!-- Payment Detail Summary -->
        <div class="payment-summary">
            <div class="section-title" style="margin: 0 0 16px 0;">Payment Detail</div>
            <div class="summary-row">
                <span class="summary-label">Netflix Packages (3 Days)</span>
                <span class="summary-value">Rp30.000</span>
            </div>

            <div class="total-row">
                <span class="total-label">Total Price</span>
                <span class="total-value">Rp30.000</span>
            </div>
        </div>

        <!-- Checkout Button -->
        <button class="checkout-btn">Checkout</button>
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
                        <input type="text" placeholder="Insert your referral code">
                    </div>

                    <div class="section-title" style="margin: 16px 16px 8px;">Your Voucher</div>

                    <div class="voucher-list">
                        <div class="voucher-item" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">75% Off</p>
                                <p class="voucher-item-desc">Only for new user</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>

                        <div class="voucher-item" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">Rp1.000 Cashback</p>
                                <p class="voucher-item-desc">Min. transaction cashback</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>

                        <div class="voucher-item" onclick="selectVoucher(this)">
                            <div class="voucher-item-icon">🎟</div>
                            <div class="voucher-item-info">
                                <p class="voucher-item-title">10% Discount</p>
                                <p class="voucher-item-desc">Min. 100.000 purchase</p>
                            </div>
                            <div class="payment-radio"></div>
                        </div>
                    </div>

                    <button class="confirm-btn" data-bs-dismiss="modal">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectPayment(element) {
            // Remove selected class from all payment methods
            document.querySelectorAll('.payment-method-item .payment-radio').forEach(radio => {
                radio.classList.remove('selected');
            });

            // Add selected class to clicked payment method
            element.querySelector('.payment-radio').classList.add('selected');
        }

        function selectVoucher(element) {
            // Remove selected class from all vouchers
            document.querySelectorAll('.voucher-item .payment-radio').forEach(radio => {
                radio.classList.remove('selected');
            });

            // Add selected class to clicked voucher
            element.querySelector('.payment-radio').classList.add('selected');
        }
    </script>
</body>
</html>
