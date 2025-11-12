<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name', 'Stream.in') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #F9FAFB;
            min-height: 100vh;
            padding-bottom: 80px;
        }

        /* Dashboard Wrapper */
        .dashboard-wrapper {
            max-width: 480px;
            margin: 0 auto;
            padding: 16px;
        }

        /* Profile Card */
        .profile-card {
            background: linear-gradient(135deg, #B91C2E 0%, #E85D6F 100%);
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(185, 28, 46, 0.25);
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .profile-content {
            position: relative;
            z-index: 1;
        }

        .avatar-container {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: white;
            padding: 3px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .user-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile-name {
            font-size: 18px;
            font-weight: 600;
            color: white;
            margin: 0;
        }

        .profile-points {
            display: flex;
            align-items: center;
            gap: 6px;
            color: white;
            font-size: 14px;
        }

        .point-badge {
            font-size: 8px;
            color: white;
        }

        .btn-order-history {
            background: white;
            border: none;
            border-radius: 24px;
            padding: 10px 18px;
            color: #B91C2E;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-order-history:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .icon-history {
            width: 16px;
            height: 16px;
        }

        .profile-badges {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .badge-label {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            padding: 6px 14px;
            border-radius: 16px;
            color: white;
            font-size: 12px;
            font-weight: 500;
        }

        .badge-name {
            background: #DC2626;
            padding: 8px 18px;
            border-radius: 20px;
            color: white;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.3);
        }

        /* Packages Section */
        .packages-section {
            margin-top: 24px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 16px;
        }

        .packages-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        /* Package Item */
        .package-item {
            background: white;
            border-radius: 16px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            border: 1px solid #F3F4F6;
        }

        .package-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: #E5E7EB;
        }

        .package-logo-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #F9FAFB;
            border-radius: 14px;
            flex-shrink: 0;
        }

        .package-logo {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }

        .package-details {
            flex: 1;
            min-width: 0;
        }

        .package-title {
            font-size: 17px;
            font-weight: 600;
            color: #1F2937;
            margin: 0 0 4px 0;
        }

        .package-duration {
            font-size: 13px;
            color: #6B7280;
            margin: 0 0 8px 0;
        }

        .package-expiry {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .expiry-date {
            font-size: 12px;
            color: #DC2626;
            font-weight: 500;
        }

        .package-chevron {
            flex-shrink: 0;
            opacity: 0.4;
        }

        /* Empty State */
        .empty-packages {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-image {
            width: 140px;
            height: 140px;
            margin: 0 auto 20px;
            opacity: 0.6;
        }

        .empty-text {
            color: #6B7280;
            font-size: 15px;
            margin-bottom: 24px;
        }

        .btn-browse {
            background: linear-gradient(135deg, #B91C2E 0%, #E85D6F 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px 32px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(185, 28, 46, 0.3);
        }

        .btn-browse:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(185, 28, 46, 0.4);
        }

        /* Bottom Navigation */
        .bottom-navigation {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            display: flex;
            justify-content: space-around;
            padding: 12px 0 20px;
            box-shadow: 0 -2px 16px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            border-top: 1px solid #F3F4F6;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            color: #9CA3AF;
            transition: color 0.3s ease;
            padding: 8px 16px;
            border-radius: 12px;
            min-width: 70px;
        }

        .nav-item:hover {
            color: #6B7280;
        }

        .nav-item.active {
            color: #B91C2E;
            background: rgba(185, 28, 46, 0.08);
        }

        .nav-icon {
            width: 24px;
            height: 24px;
        }

        .nav-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize;
        }

        /* Bootstrap Gap Utilities */
        .gap-3 {
            gap: 1rem !important;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .align-items-start {
            align-items: flex-start !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .flex-grow-1 {
            flex-grow: 1 !important;
        }

        .mb-1 {
            margin-bottom: 0.25rem !important;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .dashboard-wrapper {
                padding: 24px;
            }

            .bottom-navigation {
                max-width: 480px;
                left: 50%;
                transform: translateX(-50%);
                border-radius: 24px 24px 0 0;
            }
        }

        @media (max-width: 375px) {
            .profile-card {
                padding: 20px;
            }

            .btn-order-history {
                padding: 8px 14px;
                font-size: 12px;
            }

            .package-item {
                padding: 14px;
            }

            .nav-item {
                padding: 6px 12px;
                min-width: 60px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .package-item {
            animation: fadeInUp 0.4s ease-out;
        }

        .package-item:nth-child(1) { animation-delay: 0.1s; }
        .package-item:nth-child(2) { animation-delay: 0.2s; }
        .package-item:nth-child(3) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-content">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar-container">
                            @php
                                $avatar = null;
                                if (Auth::check()) {
                                    $avatar = Auth::user()->fotoProfil;
                                } elseif (isset($dummyUser)) {
                                    $avatar = $dummyUser->avatar ?? null;
                                }
                            @endphp
                            <img src="{{ $avatar ?? asset('img/default-avatar.png') }}" alt="Avatar" class="user-avatar">
                        </div>
                        <div>
                            @php
                                $userName = 'Guest';
                                $userPoints = 250;

                                if (Auth::check()) {
                                    $userName = Auth::user()->usernamePengguna;
                                    $userPoints = Auth::user()->points ?? 250;
                                } elseif (isset($dummyUser)) {
                                    $userName = $dummyUser->name;
                                    $userPoints = $dummyUser->points ?? 250;
                                }
                            @endphp
                            <h2 class="profile-name mb-1">{{ $userName }}</h2>
                            <div class="profile-points">
                                <span class="point-badge">●</span>
                                <span>{{ $userPoints }} Point</span>
                            </div>
                        </div>
                    </div>
                    <button class="btn-order-history" onclick="window.location.href='#'">
                        <img src="{{ asset('img/history-icon.png') }}" alt="history" class="icon-history" onerror="this.style.display='none'">
                        Order History
                    </button>
                </div>

                <div class="profile-badges">
                    <span class="badge-label">Badge</span>
                    @php
                        $badgeName = 'The Watcher';
                        if (Auth::check() && isset(Auth::user()->badge)) {
                            $badgeName = Auth::user()->badge;
                        } elseif (isset($dummyUser->badge)) {
                            $badgeName = $dummyUser->badge;
                        }
                    @endphp
                    <span class="badge-name">{{ $badgeName }}</span>
                </div>
            </div>
        </div>

        <!-- Active Packages Section -->
        <div class="packages-section">
            <h3 class="section-title">Active package</h3>

            <div class="packages-list">
                @forelse($activePackages ?? [] as $package)
                <div class="package-item" onclick="window.location.href='#'">
                    <div class="package-logo-wrapper">
                        <img src="{{ asset('img/platforms/' . strtolower($package->platform_name) . '.png') }}"
                             alt="{{ $package->platform_name }}"
                             class="package-logo"
                             onerror="this.src='{{ asset('img/default-platform.png') }}'">
                    </div>

                    <div class="package-details flex-grow-1">
                        <h4 class="package-title">{{ $package->platform_name }}</h4>
                        <p class="package-duration">{{ $package->duration }} days package</p>
                        <div class="package-expiry">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span class="expiry-date">{{ \Carbon\Carbon::parse($package->expires_at)->format('d F Y H.i') }}</span>
                        </div>
                    </div>

                    <div class="package-chevron">
                        <svg width="8" height="14" viewBox="0 0 8 14" fill="none">
                            <path d="M1 1L7 7L1 13" stroke="#D1D5DB" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
                @empty
                <div class="empty-packages">
                    <img src="{{ asset('img/empty-box.png') }}" alt="No packages" class="empty-image" onerror="this.style.display='none'">
                    <p class="empty-text">You don't have any active packages</p>
                    <button class="btn-browse" onclick="window.location.href='#'">
                        Browse Packages
                    </button>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <nav class="bottom-navigation">
        <a href="#" class="nav-item">
            <svg class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="nav-label">Home</span>
        </a>

        <a href="#" class="nav-item active">
            <svg class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="3" width="7" height="7" rx="1" fill="currentColor"/>
                <rect x="14" y="3" width="7" height="7" rx="1" fill="currentColor"/>
                <rect x="14" y="14" width="7" height="7" rx="1" fill="currentColor"/>
                <rect x="3" y="14" width="7" height="7" rx="1" fill="currentColor"/>
            </svg>
            <span class="nav-label">Dashboard</span>
        </a>

        <a href="#" class="nav-item">
            <svg class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="nav-label">Chat</span>
        </a>

        <a href="#" class="nav-item">
            <svg class="nav-icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="nav-label">Profile</span>
        </a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
