<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $serviceName }} - Pilih Paket</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        /* CSS DISAMAKAN DENGAN PRIME AGAR KONSISTEN */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f5f5; min-height: 100vh; color: #333; }
        .container { max-width: 100%; margin: 0 auto; background: #f5f5f5; min-height: 100vh; }
        .card-wrapper { max-width: 1000px; margin: 0 auto; background: white; min-height: 100vh; }
        .header { display: flex; align-items: center; padding: 16px 20px; background: white; border-bottom: 1px solid #e0e0e0; }
        .back-btn { background: none; border: none; cursor: pointer; padding: 8px; display: flex; align-items: center; color: #333; border-radius: 50%; }
        .header-title { flex: 1; text-align: center; font-size: 18px; font-weight: 600; padding-right: 40px; }
        .banner-section { padding: 24px; }
        .banner { width: 100%; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); }
        .banner img { width: 100%; height: auto; display: block; }
        .service-info { padding: 0 24px 24px; }
        .service-title { font-size: 24px; font-weight: 700; color: #333; }
        .service-description { font-size: 14px; color: #666; line-height: 1.6; text-align: justify; }
        .package-tabs { display: flex; padding: 0 24px; border-bottom: 1px solid #e0e0e0; background: white; overflow-x: auto; }
        .tab-button { padding: 12px 0; margin-right: 32px; background: transparent; border: none; color: #999; font-size: 14px; font-weight: 500; cursor: pointer; border-bottom: 2px solid transparent; white-space: nowrap; }
        .tab-button.active { color: #c1184a; border-bottom-color: #c1184a; }
        .package-list { display: none; padding: 24px; gap: 12px; }
        .package-list.active { display: grid; }
        @media (min-width: 768px) { .package-list.active { grid-template-columns: repeat(2, 1fr); } }
        .package-item { display: flex; align-items: center; justify-content: space-between; padding: 16px; border: 2px solid #e0e0e0; border-radius: 12px; cursor: pointer; background: white; position: relative; }
        .package-item.selected { border-color: #c1184a; background: #fff5f8; }
        .package-item.is-saved::after { content: 'SAVED'; position: absolute; top: 8px; right: 8px; background: #4caf50; color: white; padding: 4px 10px; border-radius: 12px; font-size: 10px; font-weight: 700; }
        .duration-badge { display: flex; align-items: center; gap: 6px; padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: #e0e0e0; color: #666; }
        .package-item.selected .duration-badge { background: #c1184a; color: white; }
        .package-price { font-size: 15px; font-weight: 700; margin-left: 12px; }
        .radio-button { width: 20px; height: 20px; border: 2px solid #e0e0e0; border-radius: 50%; position: relative; }
        .package-item.selected .radio-button::after { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 100%; height: 100%; background: #c1184a; border-radius: 50%; border: 4px solid #fff5f8; }
        .button-container { padding: 24px; background: white; border-top: 1px solid #e0e0e0; display: flex; gap: 12px; }
        .action-button { flex: 1; padding: 16px; border: none; border-radius: 12px; font-size: 16px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .save-button { background: white; color: #c1184a; border: 2px solid #c1184a; flex: 1 !important; }
        .choose-button { background: #c1184a; color: white; flex: 2 !important; }
        .action-button:disabled { opacity: 0.5; cursor: not-allowed; }
        .toast-notification { position: fixed; bottom: -100px; left: 50%; transform: translateX(-50%); background: #333; color: white; padding: 14px 24px; border-radius: 8px; z-index: 1000; transition: bottom 0.3s; }
        .toast-notification.show { bottom: 24px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card-wrapper">
            <div class="header">
                <button class="back-btn" onclick="window.location.href='{{ route('homepage') }}'">
                    <span class="material-icons">chevron_left</span>
                </button>
                <h1 class="header-title">{{ $serviceName }}</h1>
            </div>

            <div class="content">
                <div class="banner-section">
                    <div class="banner">
                        <img src="{{ asset('img/banner_' . strtolower(str_replace(' ', '', $serviceName)) . '.png') }}"
                             onerror="this.src='{{ asset('img/banner_netflix.png') }}'" alt="Banner">
                    </div>
                </div>

                <div class="service-info">
                    <h2 class="service-title">{{ $serviceName }}</h2>
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
                            <div class="package-item {{ in_array($package->packageID, $savedPackageIds ?? []) ? 'is-saved' : '' }}"
                                 data-duration="{{ $package->durasiPackage }}"
                                 data-package-id="{{ $package->packageID }}"
                                 onclick="selectPackage(this, {{ $package->packageID }}, {{ $package->hargaPackage }})">

                                <div style="display: flex; align-items: center; gap: 12px; flex: 1;">
                                    <div class="duration-badge">
                                        <span class="material-icons">schedule</span>
                                        <span>{{ $package->durasiPackage }} {{ $type === 'Hourly' ? 'Hour' : ($type === 'Daily' ? 'Day' : 'Month') }}</span>
                                    </div>
                                    <div class="package-price">Rp{{ number_format($package->hargaPackage, 0, ',', '.') }}</div>
                                </div>
                                <div class="radio-button"></div>
                            </div>
                        @empty
                            <div style="text-align: center; padding: 40px; color: #999;">Tidak ada paket tersedia</div>
                        @endforelse
                    </div>
                @endforeach

                <div class="button-container">
                    <button class="action-button save-button" id="saveButton" onclick="savePackage()" disabled>
                        <span class="material-icons">bookmark</span> Save
                    </button>
                    <button class="action-button choose-button" id="chooseButton" onclick="submitPackage()" disabled>
                        Choose Package
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
    let selectedPackageId = null;

    // Fungsi helper untuk baca URL
    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    function switchTab(tabName, event) {
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        if(event) event.target.classList.add('active');

        document.querySelectorAll('.package-list').forEach(list => list.classList.remove('active'));
        const targetList = document.getElementById(tabName + '-list');
        if(targetList) targetList.classList.add('active');

        resetSelection();
    }

    function selectPackage(element, packageId) {
        document.querySelectorAll('.package-item').forEach(item => item.classList.remove('selected'));
        element.classList.add('selected');
        selectedPackageId = packageId;
        document.getElementById('chooseButton').disabled = false;
        document.getElementById('saveButton').disabled = false;
    }

    function resetSelection() {
        selectedPackageId = null;
        document.getElementById('chooseButton').disabled = true;
        document.getElementById('saveButton').disabled = true;
    }

    function submitPackage() {
        if (!selectedPackageId) return;
        window.location.href = '{{ route("payment.details") }}?package=' + selectedPackageId;
    }

    // AUTO-SELECT LOGIC (Sama seperti Prime Video agar Netflix tidak blank)
    document.addEventListener('DOMContentLoaded', function() {
        const tabParam = getUrlParameter('tab');
        const durationParam = getUrlParameter('duration');

        if (tabParam) {
            const tabName = tabParam.charAt(0).toUpperCase() + tabParam.slice(1).toLowerCase();
            const tabBtn = Array.from(document.querySelectorAll('.tab-button')).find(t => t.textContent.trim() === tabName);

            if (tabBtn) {
                tabBtn.click();
                if (durationParam) {
                    setTimeout(() => {
                        const list = document.getElementById(tabParam.toLowerCase() + '-list');
                        const item = list.querySelector(`[data-duration="${durationParam}"]`);
                        if (item) item.click();
                    }, 300);
                }
            }
        }
    });
    </script>
</body>
</html>
