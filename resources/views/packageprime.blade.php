<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $serviceName }} - Pilih Paket</title>
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

        /* Desktop: Container dengan max-width dan centered */
        .container {
            max-width: 100%;
            margin: 0 auto;
            background: #f5f5f5;
            min-height: 100vh;
        }

        /* Desktop: Card wrapper dengan max-width */
        .card-wrapper {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
        }

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
            justify-content: center;
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

        .content {
            padding: 0;
        }

        .banner-section {
            padding: 24px;
        }

        .banner {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .banner img {
            width: 100%;
            height: auto;
            display: block;
        }

        .service-info {
            padding: 0 24px 24px;
        }

        .service-title-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .service-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .bookmark-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #999;
            transition: color 0.3s ease;
        }

        .bookmark-btn:hover {
            color: #c1184a;
        }

        .bookmark-btn .material-icons {
            font-size: 24px;
        }

        .service-description {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            text-align: justify;
        }

        .package-tabs {
            display: flex;
            padding: 0 24px;
            border-bottom: 1px solid #e0e0e0;
            background: white;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .package-tabs::-webkit-scrollbar {
            display: none;
        }

        .tab-button {
            padding: 12px 0;
            margin-right: 32px;
            background: transparent;
            border: none;
            color: #999;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 2px solid transparent;
            white-space: nowrap;
            position: relative;
        }

        .tab-button.active {
            color: #c1184a;
            border-bottom-color: #c1184a;
        }

        .tab-button:hover {
            color: #c1184a;
        }

        .package-list {
            display: none;
            padding: 24px;
            gap: 12px;
        }

        .package-list.active {
            display: grid;
        }

        /* Desktop: 2 columns grid */
        @media (min-width: 768px) {
            .package-list.active {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .package-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }

        .package-item:hover {
            border-color: #c1184a;
            box-shadow: 0 2px 8px rgba(193, 24, 74, 0.1);
        }

        .package-item.selected {
            border-color: #c1184a;
            background: #fff5f8;
        }

        .package-info-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex: 1;
        }

        .duration-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            min-width: fit-content;
        }

        .package-item.selected .duration-badge {
            background: #c1184a;
            color: white;
        }

        .package-item:not(.selected) .duration-badge {
            background: #e0e0e0;
            color: #666;
        }

        .duration-badge .material-icons {
            font-size: 16px;
        }

        .package-price {
            font-size: 15px;
            font-weight: 700;
            color: #333;
        }

        .radio-button {
            width: 20px;
            height: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 50%;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .package-item.selected .radio-button {
            border-color: #c1184a;
        }

        .package-item.selected .radio-button::after {
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

        .button-container {
            padding: 24px;
            background: white;
            border-top: 1px solid #e0e0e0;
        }

        .choose-button {
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
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .choose-button:hover:not(:disabled) {
            background: #a01340;
            box-shadow: 0 4px 12px rgba(193, 24, 74, 0.3);
        }

        .choose-button:disabled {
            background: #e0e0e0;
            color: #999;
            cursor: not-allowed;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
            grid-column: 1 / -1;
        }

        .empty-state .material-icons {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        /* Mobile Responsive */
        @media (max-width: 767px) {
            /* Mobile: Full screen tanpa max-width */
            .card-wrapper {
                max-width: 100%;
            }

            .header {
                padding: 12px 16px;
            }

            .header-title {
                font-size: 16px;
                padding-right: 32px;
            }

            .banner-section {
                padding: 16px;
            }

            .service-info {
                padding: 0 16px 16px;
            }

            .service-title {
                font-size: 20px;
            }

            .service-description {
                font-size: 13px;
            }

            .package-tabs {
                padding: 0 16px;
            }

            .tab-button {
                margin-right: 24px;
                font-size: 13px;
            }

            .package-list {
                padding: 16px;
                grid-template-columns: 1fr;
            }

            .package-item {
                padding: 12px;
            }

            .duration-badge {
                padding: 5px 10px;
                font-size: 11px;
            }

            .package-price {
                font-size: 14px;
            }

            .button-container {
                padding: 16px;
            }

            .choose-button {
                padding: 14px;
                font-size: 15px;
            }
        }

        /* Extra small devices */
        @media (max-width: 380px) {
            .package-info-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .duration-badge {
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <div class="header">
                <button class="back-btn" onclick="history.back()">
                    <span class="material-icons">chevron_left</span>
                </button>
                <h1 class="header-title">{{ $serviceName }}</h1>
            </div>

            <div class="content">
                <div class="banner-section">
                    <div class="banner">
                        <img src="{{ asset('img/banner_prime.png') }}" alt="{{ $serviceName }} Banner">
                    </div>
                </div>

                <div class="service-info">
                    <div class="service-title-row">
                        <h2 class="service-title">{{ $serviceName }}</h2>
                        <button class="bookmark-btn">
                            <span class="material-icons">bookmark_border</span>
                        </button>
                    </div>
                    <p class="service-description">{{ $serviceDescription }}</p>
                </div>

                <div class="package-tabs">
                    @foreach($packages as $type => $items)
                        <button class="tab-button {{ $loop->first ? 'active' : '' }}" 
                                onclick="switchTab('{{ strtolower($type) }}', event)">
                            {{ $type }}
                        </button>
                    @endforeach
                </div>

                @foreach($packages as $type => $items)
                    <div class="package-list {{ $loop->first ? 'active' : '' }}" id="{{ strtolower($type) }}-list">
                        @forelse($items as $package)
                            <div class="package-item" onclick="selectPackage(this, {{ $package->packageID }}, {{ $package->hargaPackage }})">
                                <div class="package-info-left">
                                    <div class="duration-badge">
                                        <span class="material-icons">schedule</span>
                                        <span>{{ $package->durasiPackage }} {{ $type === 'Hourly' ? 'Hour' : ($type === 'Daily' ? 'Day' : 'Month') }}</span>
                                    </div>
                                    <div class="package-price">Rp{{ number_format($package->hargaPackage, 0, ',', '.') }}</div>
                                </div>
                                <div class="radio-button"></div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <span class="material-icons">inbox</span>
                                <p>Tidak ada paket tersedia</p>
                            </div>
                        @endforelse
                    </div>
                @endforeach

                <div class="button-container">
                    <button class="choose-button" id="chooseButton" onclick="submitPackage()" disabled>
                        Choose Package
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedPackageId = null;
        let selectedPackagePrice = null;

        function switchTab(tabName, event) {
            // Update tab buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');

            // Update package lists
            document.querySelectorAll('.package-list').forEach(list => {
                list.classList.remove('active');
            });
            document.getElementById(tabName + '-list').classList.add('active');

            // Reset selection
            selectedPackageId = null;
            selectedPackagePrice = null;
            document.getElementById('chooseButton').disabled = true;
            document.querySelectorAll('.package-item').forEach(item => {
                item.classList.remove('selected');
            });
        }

        function selectPackage(element, packageId, price) {
            // Remove selection from all items
            document.querySelectorAll('.package-item').forEach(item => {
                item.classList.remove('selected');
            });

            // Add selection to clicked item
            element.classList.add('selected');

            // Store selected package data
            selectedPackageId = packageId;
            selectedPackagePrice = price;

            // Enable choose button
            document.getElementById('chooseButton').disabled = false;
        }

        function submitPackage() {
            if (!selectedPackageId) {
                alert('Silakan pilih paket terlebih dahulu');
                return;
            }

            // Redirect ke halaman checkout atau proses selanjutnya
            console.log('Selected Package ID:', selectedPackageId);
            console.log('Selected Package Price:', selectedPackagePrice);

            // Contoh: redirect ke halaman checkout
            window.location.href = `/checkout?package=${selectedPackageId}&price=${selectedPackagePrice}`;
        }

        function submitPackage() {
            if (!selectedPackageId) {
                alert('Silakan pilih paket terlebih dahulu');
                return;
            }

            // Redirect ke halaman checkout atau proses selanjutnyaaa
            console.log('Selected Package ID:', selectedPackageId);
            console.log('Selected Package Price:', selectedPackagePrice);

            // Contoh: redirect ke halaman checkout
            window.location.href = `/checkout?package=${selectedPackageId}&price=${selectedPackagePrice}`;
        }

        function submitPackage() {
            if (!selectedPackageId) {
            alert('Silakan pilih paket terlebih dahulu');
            return;
        }

        // Redirect ke halaman payment details
            window.location.href = '{{ route("payment.details") }}?package=' + selectedPackageId;
        }
    </script>
</body>
</html>