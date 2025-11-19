<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - {{ config('app.name', 'Stream.in') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f5;
            max-width: 480px;
            margin: 0 auto;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #fff;
            padding: 12px 20px;
            text-align: center;
            font-size: 17px;
            font-weight: 600;
            border-bottom: 1px solid #e0e0e0;
        }

        .content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            padding-bottom: 80px;
        }

        .profile-card {
            background: linear-gradient(135deg, #e85d75 0%, #d63851 100%);
            border-radius: 16px;
            padding: 20px;
            color: white;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(230, 93, 117, 0.3);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .profile-pic {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #fff;
            border: 3px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-pic-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }

        .profile-info h2 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .profile-info p {
            font-size: 14px;
            opacity: 0.95;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .point-icon {
            width: 6px;
            height: 6px;
            background-color: #ffd700;
            border-radius: 50%;
            display: inline-block;
        }

        .profile-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 16px;
        }

        .badge-section {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
        }

        .badge-icon {
            width: 20px;
            height: 20px;
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }

        .badge-text {
            font-size: 12px;
            opacity: 0.95;
        }

        .order-history-btn {
            background-color: white;
            color: #e85d75;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .order-history-btn:hover {
            opacity: 0.9;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .package-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .package-item {
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .package-item:active {
            transform: scale(0.98);
        }

        .package-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .package-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .package-details {
            flex: 1;
        }

        .package-name {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .package-duration {
            font-size: 13px;
            color: #666;
            margin-bottom: 6px;
        }

        .package-expiry {
            font-size: 12px;
            color: #999;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .calendar-icon {
            width: 14px;
            height: 14px;
            color: #dc3545;
        }

        .arrow-right {
            width: 8px;
            height: 8px;
            border-top: 2px solid #ccc;
            border-right: 2px solid #ccc;
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        .empty-packages {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-text {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn-browse {
            background: linear-gradient(135deg, #e85d75 0%, #d63851 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-browse:hover {
            opacity: 0.9;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            max-width: 480px;
            margin: 0 auto;
            background: white;
            padding: 0.75rem 0 1.5rem 0;
            box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.08);
        }

        .nav-container {
            display: flex;
            text-align: center;
        }

        .nav-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #999;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 0.5rem;
        }

        .nav-item.active {
            color: #b91d4e;
        }

        .nav-item i {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }
    </style>
</head>

<body>

    <header>Dashboard</header>

    <div class="content">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-pic">
                    @php
                        $avatar = null;
                        $userName = 'Guest';
                        $userPoints = 0;
                        $badgeName = 'The Watcher';

                        if (Auth::check()) {
                            $avatar = Auth::user()->fotoProfil;
                            $userName = Auth::user()->usernamePengguna;
                            $userPoints = Auth::user()->points ?? 0;
                            $badgeName = Auth::user()->badge ?? 'The Watcher';
                        } elseif (isset($dummyUser)) {
                            $avatar = $dummyUser->avatar ?? null;
                            $userName = $dummyUser->name ?? 'Guest';
                            $userPoints = $dummyUser->points ?? 0;
                            $badgeName = $dummyUser->badge ?? 'The Watcher';
                        }
                    @endphp

                    @if ($avatar)
                        <img src="{{ $avatar }}" alt="Avatar">
                    @else
                        <div class="profile-pic-placeholder">
                            {{ strtoupper(substr($userName, 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div class="profile-info">
                    <h2>{{ $userName }}</h2>
                    <p><span class="point-icon"></span> {{ $userPoints }} Point</p>
                </div>
            </div>

            <div class="profile-footer">
                <div class="badge-section">
                    <div class="badge-icon">🏆</div>
                    <div>
                        <div class="badge-text">Badge</div>
                        <div class="badge-text" style="font-weight: 600;">{{ $badgeName }}</div>
                    </div>
                </div>
                {{-- <a href="{{ route('order.history') ?? '#' }}" class="order-history-btn">
                    <i class="fas fa-history"></i>
                    Order History
                </a> --}}
            </div>
        </div>

        <h3 class="section-title">Active package</h3>

        <div class="package-list">
            @forelse($activePackages ?? [] as $package)
                <a href="{{ route('dashboard.packages.detail', $package->id ?? '#') }}" class="package-item">
                    <div class="package-icon">
                        <img src="{{ asset('img/' . $package->package->logoSubscription) }}"
                            alt="{{ $package->package->serviceName }}"
                            onerror="this.src='{{ asset('img/default-platform.png') }}'">
                    </div>
                    <div class="package-details">
                        <div class="package-name">{{ $package->package->serviceName }}</div>

                        <div class="package-duration">
                            {{ $package->package->descriptionDurasi ?? $package->package->durasiPackage . ' days' }}
                        </div>

                        <div class="package-expiry">
                            <svg class="calendar-icon" ...></svg>
                            <span>{{ \Carbon\Carbon::parse($package->endDate)->format('d F Y H.i') }}</span>
                        </div>
                    </div>
                    <div class="arrow-right"></div>
                </a>
            @empty
                <div class="empty-packages">
                    <p class="empty-text">You don't have any active packages</p>
                    <a href="{{ route('homepage') ?? '#' }}" class="btn-browse">
                        Browse Packages
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="nav-container">
            <a href="{{ route('homepage') }}" class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                Home
            </a>

            <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                Dashboard
            </a>

            <a href="{{ route('chat.index') }}"
                class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                <i class="fas fa-comments"></i>
                Chat
            </a>

            <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                Profile
            </a>
        </div>
    </div>

</body>

</html>
