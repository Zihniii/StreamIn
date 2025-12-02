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

        .container {
            max-width: 100%;
            margin: 0 auto;
            background: #f5f5f5;
            min-height: 100vh;
        }

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
            position: relative;
        }

        .package-item:hover {
            border-color: #c1184a;
            box-shadow: 0 2px 8px rgba(193, 24, 74, 0.1);
        }

        .package-item.selected {
            border-color: #c1184a;
            background: #fff5f8;
        }

        .package-item.is-saved::after {
            content: 'SAVED';
            position: absolute;
            top: 8px;
            right: 8px;
            background: #4caf50;
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.5px;
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
            display: flex;
            gap: 12px;
        }

        .action-button {
            flex: 1;
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

        .save-button {
            background: white;
            color: #c1184a;
            border: 2px solid #c1184a;
        }

        .save-button:hover:not(:disabled) {
            background: #fff5f8;
        }

        .save-button:disabled {
            background: #f5f5f5;
            color: #ccc;
            border-color: #e0e0e0;
            cursor: not-allowed;
        }

        .choose-button {
            background: #c1184a;
            color: white;
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

        .toast-notification {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 14px 24px;
            border-radius: 8px;
            font-size: 14px;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            transition: bottom 0.3s ease;
            max-width: 90%;
            text-align: center;
        }

        .toast-notification.show {
            bottom: 24px;
        }

        .toast-notification.success {
            background: #4caf50;
        }

        .toast-notification.error {
            background: #f44336;
        }

        @media (max-width: 767px) {
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
                flex-direction: column;
            }

            .action-button {
                padding: 14px;
                font-size: 15px;
            }
        }

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

        /* TAMBAHAN: perbandingan lebar tombol Save : Choose Package = 1 : 2 */
        .button-container .save-button { flex: 1; }
        .button-container .choose-button { flex: 2; }
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
                        <img src="{{ asset('img/banner_prime.png') }}" alt="Prime Video Banner">
                    </div>
                </div>

                <div class="service-info">
                    <div class="service-title-row">
                        <h2 class="service-title">{{ $serviceName }}</h2>
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
                            <div class="package-item {{ in_array($package->packageID, $savedPackageIds ?? []) ? 'is-saved' : '' }}" 
                                 data-duration="{{ $package->durasiPackage }}"
                                 data-package-id="{{ $package->packageID }}"
                                 onclick="selectPackage(this, {{ $package->packageID }}, {{ $package->hargaPackage }})">
                                
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
                    <button class="action-button save-button" id="saveButton" onclick="savePackage()" disabled>
                        <span class="material-icons">bookmark</span>
                        Save
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
    let selectedPackagePrice = null;

    function getUrlParameter(name) {
        name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        const regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        const results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    }

    function switchTab(tabName, event) {
        document.querySelectorAll('.tab-button').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');

        document.querySelectorAll('.package-list').forEach(list => {
            list.classList.remove('active');
        });
        document.getElementById(tabName + '-list').classList.add('active');

        selectedPackageId = null;
        selectedPackagePrice = null;
        document.getElementById('chooseButton').disabled = true;
        document.getElementById('saveButton').disabled = true;
        document.querySelectorAll('.package-item').forEach(item => {
            item.classList.remove('selected');
        });
    }

    function selectPackage(element, packageId, price) {
        document.querySelectorAll('.package-item').forEach(item => {
            item.classList.remove('selected');
        });

        element.classList.add('selected');
        selectedPackageId = packageId;
        selectedPackagePrice = price;
        
        document.getElementById('chooseButton').disabled = false;
        document.getElementById('saveButton').disabled = false;
    }

    function savePackage() {
        if (!selectedPackageId) {
            showToast('Silakan pilih paket terlebih dahulu', 'error');
            return;
        }

        const saveBtn = document.getElementById('saveButton');
        const originalText = saveBtn.innerHTML;
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<span class="material-icons">hourglass_empty</span> Saving...';

        fetch('{{ route("saved.toggle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                packageID: selectedPackageId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast(data.message, 'success');
                
                const selectedItem = document.querySelector(`[data-package-id="${selectedPackageId}"]`);
                if (data.action === 'saved') {
                    selectedItem.classList.add('is-saved');
                } else if (data.action === 'removed') {
                    selectedItem.classList.remove('is-saved');
                }
            } else {
                showToast(data.message || 'Terjadi kesalahan', 'error');
            }
            
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Gagal terhubung ke server', 'error');
            saveBtn.disabled = false;
            saveBtn.innerHTML = originalText;
        });
    }

    function submitPackage() {
        if (!selectedPackageId) {
            alert('Silakan pilih paket terlebih dahulu');
            return;
        }
        window.location.href = '{{ route("payment.details") }}?package=' + selectedPackageId;
    }

    function showToast(message, type = 'success') {
        const existingToast = document.querySelector('.toast-notification');
        if (existingToast) {
            existingToast.remove();
        }
        
        const toast = document.createElement('div');
        toast.className = `toast-notification ${type}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const tabParam = getUrlParameter('tab');
        const durationParam = getUrlParameter('duration');
        
        console.log('=== PRIME VIDEO AUTO-SELECT DEBUG ===');
        console.log('URL Parameters - Tab:', tabParam, 'Duration:', durationParam);
        
        if (tabParam) {
            const tabName = tabParam.charAt(0).toUpperCase() + tabParam.slice(1).toLowerCase();
            const tabs = document.querySelectorAll('.tab-button');
            let foundTab = null;
            
            tabs.forEach(tab => {
                if (tab.textContent.trim() === tabName) {
                    foundTab = tab;
                }
            });
            
            if (foundTab) {
                tabs.forEach(t => t.classList.remove('active'));
                foundTab.classList.add('active');
                
                document.querySelectorAll('.package-list').forEach(list => {
                    list.classList.remove('active');
                });
                
                const listId = tabParam.toLowerCase() + '-list';
                const targetList = document.getElementById(listId);
                
                if (targetList) {
                    targetList.classList.add('active');
                    
                    if (durationParam) {
                        setTimeout(() => {
                            const packageItems = targetList.querySelectorAll('.package-item');
                            
                            packageItems.forEach((item) => {
                                const itemDuration = item.getAttribute('data-duration');
                                
                                if (itemDuration === durationParam || itemDuration == durationParam) {
                                    console.log('✅ MATCH FOUND! Auto-selecting Prime Video package');
                                    item.click();
                                    
                                    setTimeout(() => {
                                        item.scrollIntoView({ 
                                            behavior: 'smooth', 
                                            block: 'center' 
                                        });
                                    }, 100);
                                }
                            });
                        }, 300);
                    }
                }
            }
        }
        
        console.log('=== END DEBUG ===');
    });
    </script>
</body>
</html>
