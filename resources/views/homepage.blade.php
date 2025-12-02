<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Homepage</title>
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
            padding-bottom: 120px; /* biar aman tidak ketutup navbar profile-style */
        }

        /* RESPONSIVE UNTUK LAPTOP */
        @media (min-width: 768px) {
            body {
                background: white;
            }

            .container {
                max-width: 100% !important;
                padding-bottom: 140px !important;
                min-height: 100vh !important;
            }

            .header {
                border-radius: 0 !important;
            }

            .active-package {
                margin: -32px 24px 24px !important;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08) !important;
                border: none;
            }

            .apps-grid {
                display: grid !important;
                grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
                gap: 24px;
                overflow-x: visible !important;
            }

            .recommendations-grid {
                display: grid !important;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 24px;
                overflow-x: visible !important;
            }

            .recommendation-card {
                min-width: auto !important;
            }

            /* NAVBAR profile-style tetap fixed bawah */
            .bottom-nav {
                position: fixed !important;
                bottom: 0 !important;
            }
        }

        /* RESPONSIVE UNTUK TABLET */
        @media (min-width: 768px) and (max-width: 1024px) {
            .apps-grid {
                grid-template-columns: repeat(5, 1fr) !important;
            }

            .recommendations-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }

        /* RESPONSIVE UNTUK DESKTOP BESAR */
        @media (min-width: 1400px) {
            .apps-grid {
                grid-template-columns: repeat(6, 1fr) !important;
            }

            .recommendations-grid {
                grid-template-columns: repeat(5, 1fr) !important;
            }
        }

        .header {
            background: linear-gradient(135deg, #9B1636 0%, #E23C64 100%);
            padding: 24px 24px 48px;
            border-radius: 0 0 24px 24px;
            color: white;
            position: relative;
        }

        .user-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-name {
            font-size: 20px;
            font-weight: 700;
        }

        .header-actions {
            display: flex;
            gap: 16px;
        }

        .icon-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
        }

        .icon-btn-circle {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .icon-btn-text {
            font-size: 11px;
            font-weight: 500;
        }

        .active-package {
            background: white;
            border-radius: 20px;
            padding: 20px;
            margin: -32px 24px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 10;
        }

        .active-package-title {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 16px;
        }

        .package-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px;
            background: #FAFAFA;
            border-radius: 16px;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .package-content {
            display: flex;
            align-items: center;
            gap: 16px;
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
        }

        .package-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .package-info h3 {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 4px;
        }

        .package-info p {
            font-size: 14px;
            color: #999;
        }

        .package-arrow {
            font-size: 24px;
            color: #DDD;
        }

        .package-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-bottom: 16px;
        }

        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #E0E0E0;
        }

        .dot.active {
            background: #C93866;
            width: 20px;
            border-radius: 3px;
        }

        .package-timer {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            background: #FAFAFA;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            color: #333;
        }

        .search-section {
            padding: 0 24px;
            margin-top: 24px;
            margin-bottom: 24px;
        }

        .search-box {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 1rem 1rem 1rem 3rem;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            width: 100%;
        }

        .search-icon {
            position: absolute;
            left: 2.5rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .applications-section {
            padding: 0 24px;
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 16px;
        }

        .apps-grid {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }

        .apps-grid::-webkit-scrollbar {
            display: none;
        }

        .app-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            min-width: 80px;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .app-item:hover {
            transform: translateY(-4px);
        }

        .app-item:active {
            transform: translateY(-2px);
        }

        .app-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: white;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
        }

        .app-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .app-name {
            font-size: 13px;
            font-weight: 500;
            color: #333;
            text-align: center;
        }

        .recommended-section {
            padding: 0 24px;
            margin-bottom: 24px;
        }

        .filter-tabs {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .filter-tab {
            padding: 10px 24px;
            border-radius: 24px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-tab.active {
            background: #C93866;
            color: white;
        }

        .filter-tab:not(.active) {
            background: #F0F0F0;
            color: #999;
        }

        .recommendations-grid {
            display: flex;
            gap: 16px;
            overflow-x: auto;
            padding-bottom: 8px;
            scrollbar-width: none;
        }

        .recommendations-grid::-webkit-scrollbar {
            display: none;
        }

        .recommendation-card {
            min-width: 200px;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .recommendation-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .recommendation-card:active {
            transform: translateY(-2px);
        }

        .recommendation-image {
            width: 100%;
            height: 200px;
            position: relative;
            overflow: hidden;
        }

        .recommendation-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .recommendation-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .recommendation-logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .recommendation-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .recommendation-info {
            padding: 16px;
        }

        .recommendation-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .recommendation-name {
            font-size: 16px;
            font-weight: 700;
            color: #333;
        }

        .recommendation-duration {
            font-size: 13px;
            color: #999;
        }

        .recommendation-price {
            font-size: 18px;
            font-weight: 700;
            color: #C93866;
        }

        /* =========================================================
           NAVBAR HOMEPAGE -> DISAMAKAN PERSIS DENGAN NAVBAR PROFILE
           (Override navbar homepage yang lama biar ga bentrok)
        ========================================================= */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 10px 0 18px 0;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            z-index: 100;
        }

        @media (min-width: 768px) {
            .bottom-nav {
                padding: 18px 0 25px 0;
            }
        }

        .bottom-nav .container-nav {
            max-width: 480px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (min-width: 768px) {
            .bottom-nav .container-nav {
                max-width: 100%;
                padding: 0 80px;
            }
        }

        @media (min-width: 1200px) {
            .bottom-nav .container-nav {
                padding: 0 120px;
            }
        }

        .bottom-nav .nav-item {
            text-align: center;
            color: #999;
            font-size: 13px;
            text-decoration: none;
            display: block;
            transition: color 0.2s;
        }

        @media (min-width: 768px) {
            .bottom-nav .nav-item {
                font-size: 15px;
            }
            .bottom-nav .nav-item:hover {
                color: #b91d4e;
            }
        }

        .bottom-nav .nav-item.active {
            color: #b91d4e;
        }

        .bottom-nav i {
            font-size: 20px;
            display: block;
            margin-bottom: 4px;
        }

        @media (min-width: 768px) {
            .bottom-nav i {
                font-size: 24px;
                margin-bottom: 6px;
            }
        }
        /* ===================== END NAVBAR PROFILE STYLE ===================== */
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="user-section">
                <div class="user-info">
                    <div class="user-avatar">
                        @php
                            $fotoPath = public_path('img/profile/' . Auth::user()->fotoProfil);
                        @endphp

                        @if (Auth::user()->fotoProfil && file_exists($fotoPath))
                            <img src="{{ asset('img/profile/' . Auth::user()->fotoProfil) }}" alt="Profile">
                        @else
                            <img src="https://i.pravatar.cc/150?u={{ Auth::user()->userID }}" alt="Profile">
                        @endif
                    </div>
                    <div class="user-name">Hai, {{ Auth::user()->name }}!</div>
                </div>
                <div class="header-actions">
                    <button class="icon-btn" onclick="window.location.href='{{ route('saved.index') }}'">
                        <div class="icon-btn-circle">
                            <span class="material-symbols-outlined">bookmark</span>
                        </div>
                        <div class="icon-btn-text">Saved</div>
                    </button>
                    <button class="icon-btn">
                        <div class="icon-btn-circle">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div class="icon-btn-text">Inbox</div>
                    </button>
                </div>
            </div>
        </div>

        <div class="active-package">
            <div class="active-package-title">Active Package</div>
            <div class="package-item">
                <div class="package-content">
                    <div class="package-logo">
                        <img src="{{ asset('img/logo_netflix.png') }}" alt="Netflix">
                    </div>
                    <div class="package-info">
                        <h3>Netflix</h3>
                        <p>3 days package</p>
                    </div>
                </div>
                <div class="package-arrow">›</div>
            </div>
            <div class="package-dots">
                <div class="dot active"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <div class="package-timer">
                <span class="material-symbols-outlined">schedule</span>
                <span>1d 22h 48m</span>
            </div>
        </div>

        <div class="search-section position-relative" onclick="window.location.href='{{ route('search') }}'" style="cursor:pointer;">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="form-control search-box" placeholder="Search your package" readonly>
        </div>

        <div class="applications-section">
            <div class="section-title">Applications</div>
            <div class="apps-grid">
                <div class="app-item" onclick="goToPackageDetails('Netflix')">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_netflix.png') }}" alt="Netflix">
                    </div>
                    <div class="app-name">Netflix</div>
                </div>
                <div class="app-item" onclick="goToPackageDetails('Prime Video')">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_prime.png') }}" alt="Prime">
                    </div>
                    <div class="app-name">Prime</div>
                </div>
                <div class="app-item" onclick="goToPackageDetails('Viu')">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_viu.png') }}" alt="VIU">
                    </div>
                    <div class="app-name">Viu</div>
                </div>
                <div class="app-item" onclick="goToPackageDetails('Vidio')">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_vidio.png') }}" alt="Vidio">
                    </div>
                    <div class="app-name">Vidio</div>
                </div>
                <div class="app-item" onclick="goToPackageDetails('Hotstar')">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_disney.png') }}" alt="Hotstar">
                    </div>
                    <div class="app-name">Hotstar</div>
                </div>
            </div>
        </div>

        <div class="recommended-section">
            <div class="section-title">Recommended for You</div>
            
            <div class="filter-tabs">
                <button class="filter-tab active" data-type="Hourly">Hourly</button>
                <button class="filter-tab" data-type="Daily">Daily</button>
                <button class="filter-tab" data-type="Monthly">Monthly</button>
            </div>
            
            <div class="recommendations-grid" id="recommendationsGrid"></div>
        </div>

        <!-- BOTTOM NAV (SAMA PERSIS SEPERTI PROFILE) -->
        <div class="bottom-nav">
            <div class="container-nav">
                <div class="row text-center">
                    <div class="col">
                        <a href="{{ route('homepage') }}" class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i> Dashboard
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('chat.index') }}" class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i> Chat
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BOTTOM NAV -->
    </div>

    <script>
        const serviceRouteMap = {
            'Netflix': 'netflix',
            'Prime Video': 'prime-video',
            'Viu': 'viu',
            'Vidio': 'vidio',
            'Hotstar': 'hotstar'
        };
        
        function goToPackageDetails(serviceName, packageType = null, duration = null) {
            const serviceSlug = serviceRouteMap[serviceName] || serviceName.toLowerCase().replace(/\s+/g, '-');
            
            let url = `/package/${serviceSlug}`;
            const params = [];
            
            if (packageType) {
                params.push(`tab=${packageType.toLowerCase()}`);
            }
            
            if (duration) {
                const durationValue = typeof duration === 'string' ? duration.split(' ')[0] : duration;
                params.push(`duration=${durationValue}`);
            }
            
            if (params.length > 0) {
                url += '?' + params.join('&');
            }
            
            window.location.href = url;
        }
        
        const packagesData = {
            "Hourly": [
                {
                    serviceName: "Netflix",
                    duration: "1",
                    price: 3000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Netflix",
                    duration: "3",
                    price: 5000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Netflix",
                    duration: "6",
                    price: 7000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Prime Video",
                    duration: "1",
                    price: 3000,
                    image: "{{ asset('img/banner_prime.png') }}",
                    logo: "{{ asset('img/logo_prime.png') }}"
                },
                {
                    serviceName: "Viu",
                    duration: "3",
                    price: 5000,
                    image: "{{ asset('img/banner_viu.png') }}",
                    logo: "{{ asset('img/logo_viu.png') }}"
                }
            ],
            "Daily": [
                {
                    serviceName: "Netflix",
                    duration: "1",
                    price: 20000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Netflix",
                    duration: "3",
                    price: 30000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Prime Video",
                    duration: "1",
                    price: 20000,
                    image: "{{ asset('img/banner_prime.png') }}",
                    logo: "{{ asset('img/logo_prime.png') }}"
                },
                {
                    serviceName: "Viu",
                    duration: "7",
                    price: 40000,
                    image: "{{ asset('img/banner_viu.png') }}",
                    logo: "{{ asset('img/logo_viu.png') }}"
                }
            ],
            "Monthly": [
                {
                    serviceName: "Netflix",
                    duration: "1",
                    price: 50000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Netflix",
                    duration: "3",
                    price: 70000,
                    image: "{{ asset('img/banner_netflix.png') }}",
                    logo: "{{ asset('img/logo_netflix.png') }}"
                },
                {
                    serviceName: "Prime Video",
                    duration: "1",
                    price: 50000,
                    image: "{{ asset('img/banner_prime.png') }}",
                    logo: "{{ asset('img/logo_prime.png') }}"
                },
                {
                    serviceName: "Viu",
                    duration: "3",
                    price: 70000,
                    image: "{{ asset('img/banner_viu.png') }}",
                    logo: "{{ asset('img/logo_viu.png') }}"
                }
            ]
        };

        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        }

        function renderPackages(type) {
            const grid = document.getElementById('recommendationsGrid');
            const packages = packagesData[type] || [];
            
            grid.innerHTML = packages.map(pkg => {
                const unitText = type === 'Hourly' ? 'Hour' : (type === 'Daily' ? 'Day' : 'Month');
                
                return `
                    <div class="recommendation-card" onclick="goToPackageDetails('${pkg.serviceName}', '${type}', '${pkg.duration}')">
                        <div class="recommendation-image">
                            <img src="${pkg.image}" alt="${pkg.serviceName} Content">
                            <div class="recommendation-overlay">
                                <div class="recommendation-logo">
                                    <img src="${pkg.logo}" alt="${pkg.serviceName}">
                                </div>
                            </div>
                        </div>
                        <div class="recommendation-info">
                            <div class="recommendation-header">
                                <span class="recommendation-name">${pkg.serviceName}</span>
                                <span class="recommendation-duration">${pkg.duration} ${unitText}</span>
                            </div>
                            <div class="recommendation-price">${formatPrice(pkg.price)}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const type = this.getAttribute('data-type');
                renderPackages(type);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            renderPackages('Hourly');
        });
    </script>
</body>
</html>
