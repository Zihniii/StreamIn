<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Homepage - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ======================================================
           Created by Muhammad Naufal Erwin E 5026231152
           ====================================================== */

        /* =======================
           Section: Global Reset
           ======================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* =======================
           Section: Body
           ======================= */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* =======================
           Section: Main Container
           ======================= */
        .container {
            max-width: 430px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            position: relative;
            padding-bottom: 120px;
        }

        /* =======================
           Section: Responsive (Tablet & Desktop)
           ======================= */
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

            .bottom-nav {
                position: fixed !important;
                bottom: 0 !important;
            }
        }

        /* =======================
           Section: Responsive (Tablet Landscape)
           ======================= */
        @media (min-width: 768px) and (max-width: 1024px) {
            .apps-grid {
                grid-template-columns: repeat(5, 1fr) !important;
            }

            .recommendations-grid {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }

        /* =======================
           Section: Responsive (Large Desktop)
           ======================= */
        @media (min-width: 1400px) {
            .apps-grid {
                grid-template-columns: repeat(6, 1fr) !important;
            }

            .recommendations-grid {
                grid-template-columns: repeat(5, 1fr) !important;
            }
        }

        /* =======================
           Section: Header
           ======================= */
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

        /* =======================
           Section: Avatar (Container)
           ======================= */
        .user-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: white;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* =======================
           Section: Avatar Placeholder (Initials)
           ======================= */
        .profile-pic-placeholder {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
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

        /* =======================
           Section: Active Package Card
           ======================= */
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
            text-decoration: none;
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

        /* =======================
           Section: Search
           ======================= */
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

        /* =======================
           Section: Applications
           ======================= */
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
            text-decoration: none;
        }

        .app-item:hover {
            transform: translateY(-4px);
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

        /* =======================
           Section: Recommended
           ======================= */
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

        /* =======================
           Section: Bottom Navigation
           ======================= */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 10px 0 18px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        .bottom-nav .container-nav {
            max-width: 480px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .bottom-nav .nav-item {
            text-align: center;
            color: #999;
            font-size: 13px;
            text-decoration: none;
            display: block;
            transition: color 0.2s;
        }

        .bottom-nav .nav-item.active {
            color: #b91d4e;
        }

        .bottom-nav i {
            font-size: 20px;
            display: block;
            margin-bottom: 4px;
        }
    </style>
</head>

<body>
    <!-- =======================
         Section: Main Wrapper
         ======================= -->
    <div class="container">
        <!-- =======================
             Section: Header UI
             ======================= -->
        <div class="header">
            <div class="user-section">
                <div class="user-info">
                    <!-- =======================
                         Section: Photo Profile (Logic disamakan dengan Dashboard)
                         Created by Muhammad Naufal Erwin E 5026231152
                         ======================= -->
                    <div class="user-avatar">
                        @php
                            // Data user login
                            $user = Auth::user();
                            $fotoProfil = $user->fotoProfil ?? null;
                            $userName = $user->usernamePengguna ?? 'Guest';

                            // Path foto
                            $fotoPath = public_path('img/profile/' . $fotoProfil);

                            // Jika foto ada -> pakai foto, jika tidak -> null (pakai inisial)
                            $displayAvatar = ($fotoProfil && file_exists($fotoPath))
                                ? asset('img/profile/' . $fotoProfil)
                                : null;
                        @endphp

                        @if ($displayAvatar)
                            <img src="{{ $displayAvatar }}" alt="Profile">
                        @else
                            <div class="profile-pic-placeholder">
                                {{ strtoupper(substr($userName, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    <!-- =======================
                         Section: Greeting Name
                         ======================= -->
                    <div class="user-name">Hai, {{ explode(' ', $user->usernamePengguna)[0] }}!</div>
                </div>

                <!-- =======================
                     Section: Header Actions
                     ======================= -->
                <div class="header-actions">
                    <button class="icon-btn" onclick="window.location.href='{{ route('saved.index') }}'">
                        <div class="icon-btn-circle">
                            <span class="material-symbols-outlined">bookmark</span>
                        </div>
                        <div class="icon-btn-text">Saved</div>
                    </button>
                    <button class="icon-btn" onclick="window.location.href='{{ route('report.list') }}'">
                        <div class="icon-btn-circle">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                        <div class="icon-btn-text">Inbox</div>
                    </button>
                </div>
            </div>
        </div>

        <!-- =======================
             Section: Active Package
             ======================= -->
        <div class="active-package">
            <div class="active-package-title">Active Package</div>
            @if ($activeSubscriptions && $activeSubscriptions->count() > 0)
                @php $latest = $activeSubscriptions->first(); @endphp
                <a href="{{ route('dashboard.packages.detail', $latest->userSubscriptionID) }}" class="package-item">
                    <div class="package-content">
                        <div class="package-logo">
                            <img src="{{ asset('img/' . $latest->package->logoSubscription) }}"
                                alt="{{ $latest->package->serviceName }}">
                        </div>
                        <div class="package-info">
                            <h3>{{ $latest->package->serviceName }}</h3>
                            <p>{{ $latest->package->descriptionDurasi ?? $latest->package->durasiPackage . ' days package' }}
                            </p>
                        </div>
                    </div>
                    <div class="package-arrow">›</div>
                </a>
                <div class="package-dots">
                    @foreach ($activeSubscriptions as $index => $sub)
                        <div class="dot {{ $index == 0 ? 'active' : '' }}"></div>
                    @endforeach
                </div>
                <div class="package-timer">
                    <span class="material-symbols-outlined">schedule</span>
                    <span>{{ $latest->remainingTime }}</span>
                </div>
            @else
                <div class="text-center py-3 text-muted">No active packages</div>
            @endif
        </div>

        <!-- =======================
             Section: Search Navigation
             ======================= -->
        <div class="search-section position-relative" onclick="window.location.href='{{ route('search') }}'"
            style="cursor:pointer;">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="form-control search-box" placeholder="Search your package" readonly>
        </div>

        <!-- =======================
             Section: Applications List
             ======================= -->
        <div class="applications-section">
            <div class="section-title">Applications</div>
            <div class="apps-grid">
                @foreach ($applications as $app)
                    <a href="javascript:void(0)" class="app-item"
                        onclick="goToPackageDetails('{{ $app->serviceName }}')">
                        <div class="app-icon">
                            <img src="{{ asset('img/' . $app->logoSubscription) }}" alt="{{ $app->serviceName }}">
                        </div>
                        <div class="app-name">{{ $app->serviceName }}</div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- =======================
             Section: Recommended Packages
             ======================= -->
        <div class="recommended-section">
            <div class="section-title">Recommended for You</div>
            <div class="filter-tabs">
                <button class="filter-tab active" data-type="Hourly">Hourly</button>
                <button class="filter-tab" data-type="Daily">Daily</button>
                <button class="filter-tab" data-type="Monthly">Monthly</button>
            </div>
            <div class="recommendations-grid" id="recommendationsGrid"></div>
        </div>

        <!-- =======================
             Section: Bottom Navigation
             ======================= -->
        <div class="bottom-nav">
            <div class="container-nav">
                <div class="row text-center">
                    <div class="col">
                        <a href="{{ route('homepage') }}"
                            class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('dashboard') }}"
                            class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i> Dashboard
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('chat.index') }}"
                            class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                            <i class="fas fa-comments"></i> Chat
                        </a>
                    </div>
                    <div class="col">
                        <a href="{{ route('profile') }}"
                            class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="fas fa-user"></i> Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        /* =======================
           Section: Route Map
           ======================= */
        const serviceRouteMap = {
            'Netflix': 'netflix',
            'Prime Video': 'primevideo',
            'Viu': 'viu',
            'Vidio': 'vidio',
            'Hotstar': 'hotstar'
        };

        /* =======================
           Section: Go To Package Details
           ======================= */
        function goToPackageDetails(serviceName, packageType = null, duration = null) {
            // Ubah 'Prime Video' menjadi 'prime-video' agar sesuai dengan parameter route Laravel
            const serviceSlug = serviceName.toLowerCase().replace(/\s+/g, '-');

            // URL ini sekarang akan cocok dengan Route::get('/package/{service}')
            let url = `/package/${serviceSlug}`;

            const params = [];
            if (packageType) params.push(`tab=${packageType.toLowerCase()}`);
            if (duration) params.push(`duration=${duration}`);

            if (params.length > 0) {
                url += '?' + params.join('&');
            }

            window.location.href = url;
        }

        /* =======================
           Section: Data from Controller
           ======================= */
        const dbPackages = {!! json_encode($recommendedPackages) !!};

        /* =======================
           Section: Filter Packages
           ======================= */
        const packagesData = {
            "Hourly": dbPackages.filter(p => p.packageType === 'Hourly'),
            "Daily": dbPackages.filter(p => p.packageType === 'Daily'),
            "Monthly": dbPackages.filter(p => p.packageType === 'Monthly')
        };

        /* =======================
           Section: Price Formatter
           ======================= */
        function formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        }

        /* =======================
           Section: Render Packages
           ======================= */
        function renderPackages(type) {
            const grid = document.getElementById('recommendationsGrid');
            const packages = packagesData[type] || [];

            if (packages.length === 0) {
                grid.innerHTML = '<div class="text-muted p-3">No packages available</div>';
                return;
            }

            grid.innerHTML = packages.map(pkg => {
                const unitText = type === 'Hourly' ? 'Hour' : (type === 'Daily' ? 'Day' : 'Month');
                return `
                    <div class="recommendation-card" onclick="goToPackageDetails('${pkg.serviceName}', '${type}', '${pkg.durasiPackage}')">
                        <div class="recommendation-image">
                            <img src="{{ asset('img/') }}/${pkg.imagesSubscription || 'banner_netflix.png'}" alt="${pkg.serviceName}">
                            <div class="recommendation-overlay">
                                <div class="recommendation-logo">
                                    <img src="{{ asset('img/') }}/${pkg.logoSubscription}" alt="${pkg.serviceName}">
                                </div>
                            </div>
                        </div>
                        <div class="recommendation-info">
                            <div class="recommendation-header">
                                <span class="recommendation-name">${pkg.serviceName}</span>
                                <span class="recommendation-duration">${pkg.durasiPackage} ${unitText}</span>
                            </div>
                            <div class="recommendation-price">${formatPrice(pkg.hargaPackage)}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        /* =======================
           Section: Filter Tab Events
           ======================= */
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                renderPackages(this.getAttribute('data-type'));
            });
        });

        /* =======================
           Section: Initial Load
           ======================= */
        document.addEventListener('DOMContentLoaded', () => renderPackages('Hourly'));
    </script>
</body>

</html>
