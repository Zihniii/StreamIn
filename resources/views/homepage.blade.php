<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Homepage</title>

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

            background: #f5f5f5;

            overflow-x: hidden;

        }



        .container {

            max-width: 430px;

            margin: 0 auto;

            background: white;

            min-height: 100vh;

            position: relative;

            padding-bottom: 80px;

        }



        /* Header */

        .header {

            background: linear-gradient(135deg, #9B1636 0%, #E23C64 100%);

            padding: 30px 24px 24px;

            border-radius: 0 0 24px 24px;

            color: white;

            position: relative;

        }



        .status-bar {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 12px;

            font-size: 15px;

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



        .user-section {

            display: flex;

            justify-content: space-between;

            align-items: center;

            margin-bottom: 40px;

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



        /* Active Package Card */

        .active-package {

            background: white;

            border-radius: 20px;

            padding: 20px;

            margin: -40px 24px 0;

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



        /* Search */
        .search-box {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 1rem 1rem 1rem 3rem;
            box-shadow: var(--card-shadow);
            margin: 1.5rem 0;
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 1.5rem 0 1rem 0;
        }


        /* Applications */
        .applications-section {

            padding: 0 24px 24px;

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



        /* Recommended */

        .recommended-section {

            padding: 0 24px 24px;

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

        }



        .recommendation-image {

            width: 200px;

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



        /* Bottom Navigation */
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

    </style>

</head>

<body>

    <div class="container">

        <!-- Header -->

        <div class="header">





            <div class="user-section">

                <div class="user-info">

                    <div class="user-avatar">

                        <img src="{{ asset('img/img_profile.png') }}" alt="Profile">

                    </div>

                    <div class="user-name">Hai, John Doe!</div>

                </div>

                <button class="icon-btn">

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



        <!-- Active Package -->

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



        <!-- Search Box -->
        <div class="position-relative" onclick="window.location.href='{{ route('search') }}'" style="cursor:pointer;">
            <i class="fas fa-search search-icon"></i>
            <input type="text" class="form-control search-box" placeholder="Search your package" readonly>
        </div>

        <!-- Applications -->
        <div class="applications-section">
            <div class="section-title">Applications</div>
            <div class="apps-grid">
                <div class="app-item">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_netflix.png') }}" alt="Netflix">
                    </div>
                    <div class="app-name">Netflix</div>
                </div>
                <div class="app-item">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_prime.png') }}" alt="Prime">
                    </div>
                    <div class="app-name">Prime</div>
                </div>
                <div class="app-item">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_viu.png') }}" alt="VIU">
                    </div>
                    <div class="app-name">VIU</div>
                </div>
                <div class="app-item">
                    <div class="app-icon">
                        <img src="{{ asset('img/logo_vidio.png') }}" alt="Vidio">
                    </div>
                    <div class="app-name">Vidio</div>
                </div>

                <div class="app-item">

                    <div class="app-icon">

                        <img src="{{ asset('img/logo_disney.png') }}" alt="Hotstar">

                    </div>

                    <div class="app-name">Hotstar</div>

                </div>

            </div>

        </div>



        <!-- Recommended -->

        <div class="recommended-section">

            <div class="section-title">Recomended for You</div>



            <div class="filter-tabs">

                <button class="filter-tab active">Hourly</button>

                <button class="filter-tab">Daily</button>

                <button class="filter-tab">Monthly</button>

            </div>



            <div class="recommendations-grid">

                <div class="recommendation-card">

                    <div class="recommendation-image">

                        <img src="{{ asset('img/banner_netflix.png') }}" alt="Netflix Content">

                        <div class="recommendation-overlay">

                            <div class="recommendation-logo">

                                <img src="{{ asset('img/logo_netflix.png') }}" alt="Netflix">

                            </div>

                        </div>

                    </div>

                    <div class="recommendation-info">

                        <div class="recommendation-header">

                            <span class="recommendation-name">Netflix</span>

                            <span class="recommendation-duration">1 Hour</span>

                        </div>

                        <div class="recommendation-price">Rp 3.000</div>

                    </div>

                </div>



                <div class="recommendation-card">

                    <div class="recommendation-image">

                        <img src="{{ asset('img/banner_prime.png') }}" alt="Prime Content">

                        <div class="recommendation-overlay">

                            <div class="recommendation-logo">

                                <img src="{{ asset('img/logo_prime.png') }}" alt="Prime">

                            </div>

                        </div>

                    </div>

                    <div class="recommendation-info">

                        <div class="recommendation-header">

                            <span class="recommendation-name">Prime Video</span>

                            <span class="recommendation-duration">3 Hour</span>

                        </div>

                        <div class="recommendation-price">Rp 5.000</div>

                    </div>

                </div>



                <div class="recommendation-card">

                    <div class="recommendation-image">

                        <img src="{{ asset('img/banner_viu.png') }}" alt="VIU Content">

                        <div class="recommendation-overlay">

                            <div class="recommendation-logo">

                                <img src="{{ asset('img/logo_viu.png') }}" alt="VIU">

                            </div>

                        </div>

                    </div>

                    <div class="recommendation-info">

                        <div class="recommendation-header">

                            <span class="recommendation-name">VIU</span>

                            <span class="recommendation-duration">2 Hour</span>

                        </div>

                        <div class="recommendation-price">Rp 4.000</div>

                    </div>

                </div>

            </div>

        </div>



        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <div class="row g-0">
                <div class="col">
                    <a href="{{ route('homepage') }}" class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        Dashboard
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('chat.index') }}" class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                        <i class="fas fa-comments"></i>
                        Chat
                    </a>
                </div>
                <div class="col">
                    <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </div>
            </div>
        </div>


    <script>

        // Filter tabs functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
            });
        });
