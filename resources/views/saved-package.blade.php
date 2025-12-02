<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Package</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        .container {
            max-width: 430px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            position: relative;
        }

        .header {
            padding: 20px 24px;
            background: white;
            border-bottom: 1px solid #f0f0f0;
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #333;
            flex: 1;
        }

        .package-list {
            padding: 16px 24px;
        }

        .package-card {
            background: white;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .package-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        }

        .package-content {
            display: flex;
            align-items: center;
            gap: 16px;
            flex: 1;
        }

        .package-logo {
            width: 56px;
            height: 56px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .package-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .package-info {
            flex: 1;
        }

        .package-name {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }

        .package-duration {
            font-size: 14px;
            color: #999;
        }

        .bookmark-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #b91d4e;
            cursor: pointer;
            padding: 8px;
            transition: transform 0.2s ease;
        }

        .bookmark-btn:hover {
            transform: scale(1.1);
        }

        .bookmark-btn.active {
            color: #b91d4e;
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
            color: #999;
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 16px;
            color: #ddd;
        }

        .empty-state p {
            font-size: 16px;
            margin: 0;
        }

        @media (min-width: 768px) {
            body {
                background: white;
            }

            .container {
                max-width: 100%;
            }

            .header {
                border-bottom: 1px solid #e0e0e0;
            }

            .package-list {
                max-width: 1200px;
                margin: 0 auto;
                padding: 32px 48px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 24px;
            }

            .package-card {
                margin-bottom: 0;
            }
        }

        @media (min-width: 1024px) {
            .package-list {
                grid-template-columns: repeat(3, 1fr);
                gap: 32px;
            }

            .package-card {
                flex-direction: column;
                text-align: center;
                padding: 32px 24px;
            }

            .package-content {
                flex-direction: column;
                width: 100%;
            }

            .package-logo {
                width: 80px;
                height: 80px;
            }

            .bookmark-btn {
                position: absolute;
                top: 16px;
                right: 16px;
            }

            .package-card {
                position: relative;
            }
        }

        @media (min-width: 1400px) {
            .package-list {
                grid-template-columns: repeat(4, 1fr);
                max-width: 1400px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <button class="back-btn" onclick="window.location.href='{{ route('homepage') }}'">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="header-title">Saved Package</div>
        </div>

        <!-- Package List -->
        <div class="package-list">
            @forelse($savedPackages as $wishlist)
                <div class="package-card" onclick="goToPackageDetail('{{ $wishlist->package->serviceName }}', '{{ $wishlist->package->packageType }}', '{{ $wishlist->package->durasiPackage }}')">
                    <div class="package-content">
                        <div class="package-logo">
                            @php
                                // Mapping service name ke nama file logo
                                $logoMap = [
                                    'Netflix' => 'logo_netflix.png',
                                    'Prime Video' => 'logo_prime.png',
                                    'Viu' => 'logo_viu.png',
                                    'Vidio' => 'logo_vidio.png',
                                    'Hotstar' => 'logo_disney.png',
                                    'Disney+ Hotstar' => 'logo_disney.png',
                                ];
                                $logoFile = $logoMap[$wishlist->package->serviceName] ?? 'logo_default.png';
                            @endphp
                            <img src="{{ asset('img/' . $logoFile) }}" alt="{{ $wishlist->package->serviceName }}">
                        </div>
                        <div class="package-info">
                            <div class="package-name">{{ $wishlist->package->serviceName }}</div>
                            <div class="package-duration">
                                {{ $wishlist->package->durasiPackage }} 
                                {{ $wishlist->package->packageType === 'Hourly' ? 'Hour' : ($wishlist->package->packageType === 'Daily' ? 'Day' : 'Month') }}
                            </div>
                        </div>
                    </div>
                    <button class="bookmark-btn active" onclick="toggleBookmark(event, {{ $wishlist->wishlistID }})">
                        <i class="fas fa-bookmark"></i>
                    </button>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-bookmark"></i>
                    <p>No saved packages yet</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function goToPackageDetail(serviceName, packageType, duration) {
            event.stopPropagation();
            
            const serviceMap = {
                'Netflix': 'netflix',
                'Prime Video': 'primevideo',
                'Viu': 'viu',
                'Vidio': 'vidio',
                'Hotstar': 'hotstar',
                'Disney+ Hotstar': 'hotstar'
            };
            
            const serviceSlug = serviceMap[serviceName] || serviceName.toLowerCase().replace(/\s+/g, '-');
            let url = `/package/${serviceSlug}`;
            
            if (packageType && duration) {
                url += `?tab=${packageType.toLowerCase()}&duration=${duration}`;
            }
            
            window.location.href = url;
        }

        function toggleBookmark(event, wishlistID) {
            event.stopPropagation();
            
            if (!confirm('Hapus paket ini dari wishlist?')) {
                return;
            }

            fetch('{{ route("saved.remove") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    wishlistID: wishlistID
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the card with animation
                    const card = event.target.closest('.package-card');
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'translateX(-100%)';
                    
                    setTimeout(() => {
                        location.reload();
                    }, 300);
                } else {
                    alert(data.message || 'Gagal menghapus paket');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan');
            });
        }
    </script>
</body>
</html>