<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Pilih Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
            padding-bottom: 20px;
        }
        .header {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border-bottom: 1px solid #e0e0e0;
        }
        .back-btn {
            position: absolute;
            left: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        .header h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }
        .status-bar {
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
        }
        .status-icons {
            display: flex;
            gap: 5px;
            align-items: center;
        }
        .netflix-banner {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .netflix-logo {
            font-size: 64px;
            font-weight: 900;
            color: #e50914;
            letter-spacing: 5px;
            z-index: 2;
        }
        .content-wrapper {
            padding: 0 20px;
        }
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .title-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }
        .bookmark-btn {
            background: none;
            border: 2px solid #c41e3a;
            color: #c41e3a;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 20px;
        }
        .description {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }
        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background-color: #f0f0f0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .tab-btn.active {
            background-color: #fce4ec;
            color: #c41e3a;
            font-weight: 600;
        }
        .pricing-card {
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.3s;
            background-color: white;
        }
        .pricing-card:hover {
            border-color: #c41e3a;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.1);
        }
        .pricing-card.selected {
            border-color: #c41e3a;
            background-color: white;
        }
        .time-badge {
            background-color: #9e9e9e;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            min-width: 100px;
            justify-content: center;
        }
        .pricing-card.selected .time-badge {
            background-color: #c41e3a;
        }
        .pricing-info h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }
        .pricing-info p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }
        .radio-btn {
            width: 24px;
            height: 24px;
            border: 2px solid #c41e3a;
            border-radius: 50%;
            position: relative;
        }
        .radio-btn.selected::after {
            content: '';
            width: 14px;
            height: 14px;
            background-color: #c41e3a;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .choose-btn {
            width: 100%;
            padding: 18px;
            background-color: #c41e3a;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .choose-btn:hover {
            background-color: #a01729;
        }
        .packages-container {
            display: none;
        }
        .packages-container.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <button class="back-btn" onclick="window.location.href='{{ route('homepage') }}'">
                <i class="bi bi-chevron-left"></i>
            </button>
            <h1>{{ $serviceName }}</h1>
        </div>

        <div class="netflix-banner">
            <div class="netflix-logo">{{ strtoupper($serviceName) }}</div>
        </div>

        <div class="content-wrapper">
            <div class="title-section">
                <h2>{{ $serviceName }}</h2>
                <button class="bookmark-btn">
                    <i class="bi bi-bookmark"></i>
                </button>
            </div>

            <p class="description">
                {{ $serviceDescription }}
            </p>

            <div class="tab-buttons">
                @foreach(['Hourly', 'Daily', 'Monthly'] as $type)
                    <button class="tab-btn {{ (request('tab') == strtolower($type) || ($type == 'Hourly' && !request('tab'))) ? 'active' : '' }}"
                            onclick="switchTab('{{ strtolower($type) }}')">
                        {{ $type }}
                    </button>
                @endforeach
            </div>

            @foreach(['Hourly', 'Daily', 'Monthly'] as $type)
            <div id="{{ strtolower($type) }}-packages" class="packages-container {{ (request('tab') == strtolower($type) || ($type == 'Hourly' && !request('tab'))) ? 'active' : '' }}">
                @if(isset($packages[$type]))
                    @foreach($packages[$type] as $index => $pkg)
                        <div class="pricing-card" onclick="selectCard('{{ strtolower($type) }}', {{ $pkg->packageID }})">
                            <div class="d-flex align-items-center gap-3">
                                <div class="time-badge">
                                    <i class="bi {{ $type == 'Monthly' ? 'bi-calendar' : 'bi-clock' }}"></i>
                                    <span>{{ $pkg->durasiPackage }} {{ $type == 'Hourly' ? 'Hour' : ($type == 'Daily' ? 'Day' : 'Month') }}</span>
                                </div>
                                <div class="pricing-info">
                                    <h3>Rp{{ number_format($pkg->hargaPackage, 0, ',', '.') }}</h3>
                                    <p>{{ $pkg->descriptionPackage ?? 'Streaming access' }}</p>
                                </div>
                            </div>
                            <div class="radio-btn" id="radio-{{ $pkg->packageID }}"></div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-muted">No {{ $type }} packages available.</p>
                @endif
            </div>
            @endforeach

            <form id="purchase-form" action="{{ route('payment.show') }}" method="POST">
                @csrf
                <input type="hidden" name="packageID" id="selected-package-id">
                <button type="button" class="choose-btn" onclick="submitPurchase()">Choose Package</button>
            </form>
        </div>
    </div>

    <script>
        let selectedID = null;

        function switchTab(tab) {
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
                if(btn.innerText.toLowerCase() === tab) btn.classList.add('active');
            });

            document.querySelectorAll('.packages-container').forEach(c => c.classList.remove('active'));
            document.getElementById(tab + '-packages').classList.add('active');
        }

        function selectCard(tab, packageID) {
            // Reset semua card
            document.querySelectorAll('.pricing-card').forEach(c => c.classList.remove('selected'));
            document.querySelectorAll('.radio-btn').forEach(r => r.classList.remove('selected'));

            // Set yang dipilih
            event.currentTarget.classList.add('selected');
            document.getElementById('radio-' + packageID).classList.add('selected');

            selectedID = packageID;
            document.getElementById('selected-package-id').value = packageID;
        }

        function submitPurchase() {
            if (!selectedID) {
                alert('Silakan pilih paket terlebih dahulu!');
                return;
            }
            document.getElementById('purchase-form').submit();
        }
    </script>
</body>
</html>
