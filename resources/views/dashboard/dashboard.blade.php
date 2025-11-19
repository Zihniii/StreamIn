<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tambahkan ini biar icon muncul -->
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
            max-width: 375px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .status-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 20px;
            background-color: #fff;
            font-size: 14px;
            font-weight: 600;
        }

        .status-icons {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .status-icons span {
            font-size: 12px;
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

        .balance-section {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            padding: 12px 16px;
            margin-bottom: 16px;
        }

        .balance-label {
            font-size: 12px;
            opacity: 0.9;
            margin-bottom: 4px;
        }

        .balance-amount {
            font-size: 18px;
            font-weight: 700;
        }

        .profile-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }

        .search-icon {
            width: 14px;
            height: 14px;
            border: 2px solid #e85d75;
            border-radius: 50%;
            position: relative;
        }

        .search-icon::after {
            content: '';
            position: absolute;
            width: 2px;
            height: 6px;
            background-color: #e85d75;
            bottom: -4px;
            right: -3px;
            transform: rotate(45deg);
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
            font-weight: 700;
        }

        .netflix-icon {
            background-color: #e50914;
            color: white;
            font-size: 26px;
            font-weight: 800;
        }

        .prime-icon {
            background-color: #00a8e1;
            color: white;
            font-size: 9px;
            flex-direction: column;
            line-height: 1;
        }

        .prime-text {
            font-weight: 700;
            font-size: 11px;
        }

        .video-text {
            font-weight: 400;
            font-size: 8px;
        }

        .viu-icon {
            background-color: #ffd400;
            color: white;
            font-size: 24px;
            font-weight: 700;
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

        .package-price {
            font-size: 12px;
            color: #e50914;
            font-weight: 600;
        }

        .package-expiry {
            font-size: 12px;
            color: #999;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .calendar-icon {
            width: 12px;
            height: 12px;
            background-color: #dc3545;
            border-radius: 2px;
            position: relative;
        }

        .calendar-icon::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            right: 2px;
            bottom: 2px;
            background-color: white;
            border-radius: 1px;
        }

        .arrow-right {
            width: 8px;
            height: 8px;
            border-top: 2px solid #ccc;
            border-right: 2px solid #ccc;
            transform: rotate(45deg);
            flex-shrink: 0;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 0.75rem 0 1.5rem 0;
            box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.08);
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #999;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .nav-item.active {
            color: #b91d4e;
        }

        .nav-item i {
            font-size: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .home-icon {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            background-color: currentColor;
            opacity: 0.5;
        }

        .dashboard-icon {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3px;
            width: 20px;
            height: 20px;
        }

        .dashboard-dot {
            width: 8px;
            height: 8px;
            background-color: currentColor;
            border-radius: 2px;
        }

        .chat-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: currentColor;
            opacity: 0.5;
            position: relative;
        }

        .chat-icon::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 2px;
            width: 6px;
            height: 6px;
            background-color: currentColor;
            transform: rotate(45deg);
        }

        .profile-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: currentColor;
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <header>Dashboard</header>

    <div class="content">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-pic">
                    <div class="profile-pic-placeholder">JD</div>
                </div>
                <div class="profile-info">
                    <h2>John Doe</h2>
                    <p><span class="point-icon"></span> 250 Point</p>
                </div>
            </div>

            <div class="balance-section">
                <div class="balance-label">Balance</div>
                <div class="balance-amount">Rp 0</div>
            </div>

            <div class="profile-footer">
                <div class="badge-section">
                    <div class="badge-icon">🏆</div>
                    <div>
                        <div class="badge-text">Badge</div>
                        <div class="badge-text" style="font-weight: 600;">The Watcher</div>
                    </div>
                </div>
                <button class="order-history-btn">
                    <div class="search-icon"></div>
                    Order History
                </button>
            </div>
        </div>

        <h3 class="section-title">Active package</h3>

        <div class="package-list">
            <a href="{{ route('active.package') }}" class="package-item" style="text-decoration:none; color:inherit;">
                <div class="package-icon netflix-icon">N</div>
                <div class="package-details">
                    <div class="package-name">Netflix</div>
                    <div class="package-duration">3 days package</div>
                    <div class="package-price">Rp 15.000 - Rp 8k</div>
                </div>
                <div class="arrow-right"></div>
            </a>

            <a href="{{ route('active.package') }}" class="package-item" style="text-decoration:none; color:inherit;">
                <div class="package-icon prime-icon">
                    <span class="prime-text">prime</span>
                    <span class="video-text">video</span>
                </div>
                <div class="package-details">
                    <div class="package-name">Prime Video</div>
                    <div class="package-duration">3 days package</div>
                    <div class="package-price">Rp 15.000 - Rp 8k</div>
                </div>
                <div class="arrow-right"></div>
            </a>

            <a href="{{ route('active.package') }}" class="package-item" style="text-decoration:none; color:inherit;">
                <div class="package-icon viu-icon">▶</div>
                <div class="package-details">
                    <div class="package-name">Viu</div>
                    <div class="package-duration">3 days package</div>
                    <div class="package-price">Rp 15.000 - Rp 8k</div>
                </div>
                <div class="arrow-right"></div>
            </a>
        </div>
    </div>

    <!-- Bottom Navigation -->
    <div class="bottom-nav">
        <div class="row g-0" style="display:flex; text-align:center;">
            <div class="col" style="flex:1;">
                <a href="{{ route('homepage') }}" class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    Home
                </a>
            </div>

            <div class="col" style="flex:1;">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    Dashboard
                </a>
            </div>

            <div class="col" style="flex:1;">
                <a href="{{ route('chat.index') }}" class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    Chat
                </a>
            </div>

            <div class="col" style="flex:1;">
                <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
            </div>
        </div>
    </div>



</body>
</html>
