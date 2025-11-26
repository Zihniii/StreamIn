<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Details - {{ $package->serviceName }}</title>
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
            position: relative;
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
            position: relative;
        }

        .step-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            z-index: 2;
        }

        .step.active .step-circle {
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
            background: #e0e0e0;
        }

        .step:last-child .step-line {
            display: none;
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
            transition: background 0.3s ease;
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
            padding: 20px;
            padding-bottom: 120px;
        }

        /* Package Info */
        .package-info {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            background: #f8f8f8;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .package-logo {
            width: 56px;
            height: 56px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: white;
            border: 1px solid #e0e0e0;
        }

        .package-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .package-details h3 {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 4px;
        }

        .package-details p {
            font-size: 13px;
            color: #666;
        }

        .change-package-btn {
            background: white;
            border: 1px solid #c1184a;
            color: #c1184a;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            margin-left: auto;
            transition: all 0.3s ease;
        }

        .change-package-btn:hover {
            background: #fff5f8;
        }

        /* Section */
        .section {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }

        /* Payment Method */
        .payment-method-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .payment-method-item:hover {
            border-color: #c1184a;
            box-shadow: 0 2px 8px rgba(193, 24, 74, 0.1);
        }

        .payment-method-item.selected {
            border-color: #c1184a;
            background: #fff5f8;
        }

        .payment-method-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .payment-icon {
            width: 48px;
            height: 32px;
            object-fit: contain;
        }

        .payment-name {
            font-size: 15px;
            font-weight: 500;
            color: #333;
        }

        .radio-button {
            width: 20px;
            height: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            transition: all 0.3s ease;
        }

        .payment-method-item.selected .radio-button {
            border-color: #c1184a;
        }

        .payment-method-item.selected .radio-button::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background: #c1184a;
            border-radius: 50%;
        }

        /* Voucher Section */
        .voucher-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .voucher-card:hover {
            border-color: #c1184a;
        }

        .voucher-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .voucher-icon {
            width: 32px;
            height: 32px;
            background: #c1184a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .voucher-text {
            font-size: 14px;
            color: #666;
        }

        .voucher-arrow {
            color: #c1184a;
        }

        /* Payment Detail Summary */
        .payment-summary {
            background: #f8f8f8;
            border-radius: 12px;
            padding: 16px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 14px;
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
        }

        .total-label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .total-value {
            font-size: 20px;
            font-weight: 700;
            color: #c1184a;
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
        }

        .checkout-button {
            width: 100%;
            background: #c1184a;
            color: white;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .checkout-button:hover:not(:disabled) {
            background: #a01340;
            box-shadow: 0 4px 12px rgba(193, 24, 74, 0.3);
        }

        .checkout-button:disabled {
            background: #e0e0e0;
            color: #999;
            cursor: not-allowed;
        }

        /* Modal Voucher */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: flex-end;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px 20px 0 0;
            padding: 24px;
            max-width: 480px;
            width: 100%;
            max-height: 70vh;
            overflow-y: auto;
            animation: slideUp 0.3s ease;
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
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .modal-close {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #666;
        }

        .referral-input-wrapper {
            margin-bottom: 20px;
        }

        .referral-label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        .referral-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .referral-input:focus {
            outline: none;
            border-color: #c1184a;
        }

        .voucher-section-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }

        .discount-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            margin-bottom: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .discount-item:hover {
            border-color: #c1184a;
        }

        .discount-item.selected {
            border-color: #c1184a;
            background: #fff5f8;
        }

        .discount-item.used {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .discount-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .discount-icon {
            width: 32px;
            height: 32px;
            background: #c1184a;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .discount-info h4 {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-bottom: 2px;
        }

        .discount-info p {
            font-size: 12px;
            color: #666;
        }

        .used-badge {
            background: #e0e0e0;
            color: #666;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }

        .confirm-voucher-btn {
            width: 100%;
            background: #c1184a;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 16px;
            transition: all 0.3s ease;
        }

        .confirm-voucher-btn:hover {
            background: #a01340;
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

            .bottom-fixed {
                border-radius: 0 0 16px 16px;
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
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <!-- Progress Steps -->
            <div class="progress-steps">
                <div class="step active">
                    <div class="step-circle">
                        <span class="material-icons" style="font-size: 20px;">shopping_cart</span>
                    </div>
                </div>
                <div class="step-line"></div>
                <div class="step inactive">
                    <div class="step-circle">
                        <span class="material-icons" style="font-size: 20px;">credit_card</span>
                    </div>
                </div>
                <div class="step-line"></div>
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
                <!-- Package Info -->
                <div class="package-info">
                    <div class="package-logo">
                        <img src="{{ asset('img/' . $package->logoSubscription) }}" alt="{{ $package->serviceName }}">
                    </div>
                    <div class="package-details">
                        <h3>{{ $package->serviceName }}</h3>
                        <p>{{ $package->descriptionDurasi }}</p>
                    </div>
                    <button class="change-package-btn" onclick="history.back()">Change Package</button>
                </div>

                <!-- Payment Method Section -->
                <div class="section">
                    <h2 class="section-title">Payment Method</h2>
                    @foreach($paymentMethods as $method)
                        <div class="payment-method-item" onclick="selectPaymentMethod(this, {{ $method->paymentMethodID }})">
                            <div class="payment-method-left">
                                <img src="{{ asset('img/' . $method->icon) }}" alt="{{ $method->methodName }}" class="payment-icon">
                                <span class="payment-name">{{ $method->methodName }}</span>
                            </div>
                            <div class="radio-button"></div>
                        </div>
                    @endforeach
                </div>

                <!-- Voucher Section -->
                <div class="section">
                    <div class="voucher-card" onclick="openVoucherModal()">
                        <div class="voucher-left">
                            <div class="voucher-icon">
                                <span class="material-icons" style="font-size: 20px;">confirmation_number</span>
                            </div>
                            <span class="voucher-text" id="voucherText">Use your voucher and special offers</span>
                        </div>
                        <span class="material-icons voucher-arrow">chevron_right</span>
                    </div>
                </div>

                <!-- Payment Detail Summary -->
                <div class="section">
                    <h2 class="section-title">Payment Detail</h2>
                    <div class="payment-summary">
                        <div class="summary-row">
                            <span class="summary-label">{{ $package->serviceName }} ({{ $package->descriptionDurasi }})</span>
                            <span class="summary-value" id="originalPrice">Rp{{ number_format($originalPrice, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row" id="discountRow" style="display: none;">
                            <span class="summary-label">Discount Voucher</span>
                            <span class="summary-value discount" id="discountValue">-Rp0</span>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="total-row">
                            <span class="total-label">Total Price</span>
                            <span class="total-value" id="totalPrice">Rp{{ number_format($originalPrice, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Fixed Checkout -->
            <div class="bottom-fixed">
                <button class="checkout-button" id="checkoutBtn" onclick="processCheckout()" disabled>
                    Checkout
                </button>
            </div>
        </div>
    </div>

    <!-- Voucher Modal -->
    <div class="modal" id="voucherModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Voucher</h3>
                <button class="modal-close" onclick="closeVoucherModal()">
                    <span class="material-icons">close</span>
                </button>
            </div>

            <!-- Referral Code Input -->
            <div class="referral-input-wrapper">
                <label class="referral-label">Referral Code</label>
                <input type="text" class="referral-input" placeholder="Insert your referral code" id="referralCodeInput">
            </div>

            <!-- Your Voucher List -->
            <h4 class="voucher-section-title">Your Voucher</h4>
            @foreach($discounts as $discount)
                <div class="discount-item" onclick="selectDiscount(this, {{ $discount->discountID }}, '{{ $discount->discountType }}', {{ $discount->discountValue }})">
                    <div class="discount-left">
                        <div class="discount-icon">
                            <span class="material-icons" style="font-size: 18px;">local_offer</span>
                        </div>
                        <div class="discount-info">
                            <h4>
                                @if($discount->discountType === 'percentage')
                                    {{ $discount->discountValue }}% Off
                                @elseif($discount->discountType === 'cashback')
                                    Rp{{ number_format($discount->discountValue * 1000, 0, ',', '.') }} Cashback
                                @endif
                            </h4>
                            <p>{{ $discount->discountDescription }}</p>
                        </div>
                    </div>
                    <div class="radio-button"></div>
                </div>
            @endforeach

            <button class="confirm-voucher-btn" onclick="confirmVoucher()">Confirm</button>
        </div>
    </div>

    <script>
        // Data
        let selectedPaymentMethodId = null;
        let selectedDiscountId = null;
        let selectedDiscountType = null;
        let selectedDiscountValue = 0;
        const originalPrice = {{ $originalPrice }};
        const packageId = {{ $package->packageID }};
        let referralCode = '';

        // Select Payment Method
        function selectPaymentMethod(element, methodId) {
            document.querySelectorAll('.payment-method-item').forEach(item => {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
            selectedPaymentMethodId = methodId;
            updateCheckoutButton();
        }

        // Open Voucher Modal
        function openVoucherModal() {
            document.getElementById('voucherModal').classList.add('active');
        }

        // Close Voucher Modal
        function closeVoucherModal() {
            document.getElementById('voucherModal').classList.remove('active');
        }

        // Select Discount
        function selectDiscount(element, discountId, discountType, discountValue) {
            document.querySelectorAll('.discount-item').forEach(item => {
                item.classList.remove('selected');
            });
            element.classList.add('selected');
            selectedDiscountId = discountId;
            selectedDiscountType = discountType;
            selectedDiscountValue = discountValue;
        }

        // Confirm Voucher
        function confirmVoucher() {
            referralCode = document.getElementById('referralCodeInput').value;
            
            // Calculate discount
            let discountAmount = 0;
            if (selectedDiscountType === 'percentage') {
                discountAmount = (originalPrice * selectedDiscountValue) / 100;
            } else if (selectedDiscountType === 'cashback') {
                discountAmount = selectedDiscountValue * 1000;
            }

            const finalPrice = originalPrice - discountAmount;

            // Update UI
            if (discountAmount > 0) {
                document.getElementById('discountRow').style.display = 'flex';
                document.getElementById('discountValue').textContent = '-Rp' + formatNumber(discountAmount);
                document.getElementById('totalPrice').textContent = 'Rp' + formatNumber(finalPrice);
                
                // Update voucher text
                if (selectedDiscountType === 'percentage') {
                    document.getElementById('voucherText').textContent = `Discount ${selectedDiscountValue}% applied`;
                } else {
                    document.getElementById('voucherText').textContent = `Cashback Rp${formatNumber(discountAmount)} applied`;
                }
            }

            closeVoucherModal();
            updateCheckoutButton();
        }

        // Update Checkout Button
        function updateCheckoutButton() {
            const btn = document.getElementById('checkoutBtn');
            if (selectedPaymentMethodId) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }

        // Process Checkout
        function processCheckout() {
            if (!selectedPaymentMethodId) {
                alert('Please select payment method');
                return;
            }

            // Calculate final price
            let discountAmount = 0;
            if (selectedDiscountType === 'percentage') {
                discountAmount = (originalPrice * selectedDiscountValue) / 100;
            } else if (selectedDiscountType === 'cashback') {
                discountAmount = selectedDiscountValue * 1000;
            }
            const finalPrice = originalPrice - discountAmount;

            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("payment.checkout") }}';

            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);

            // Add data
            const fields = {
                package_id: packageId,
                payment_method_id: selectedPaymentMethodId,
                discount_id: selectedDiscountId,
                referral_code: referralCode,
                final_price: finalPrice
            };

            for (const [key, value] of Object.entries(fields)) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = value || '';
                form.appendChild(input);
            }

            document.body.appendChild(form);
            form.submit();
        }

        // Format Number
        function formatNumber(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Close modal when clicking outside
        document.getElementById('voucherModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVoucherModal();
            }
        });
    </script>
</body>
</html>