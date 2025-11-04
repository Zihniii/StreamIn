<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Streaming Subscription App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #b91d4e 0%, #e85d8a 100%);
            --card-shadow: 0 2px 12px rgba(0,0,0,0.08);
        }

        body {
            background: linear-gradient(135deg, #b91d4e 0%, #e85d8a 100%);
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }

        .header {
            padding: 1rem 1.25rem;
            color: white;
        }

        .time {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .greeting {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 1rem;
            margin-bottom: 0;
        }

        .header-icons {
            display: flex;
            gap: 0.75rem;
        }

        .icon-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .icon-btn {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: rgba(255,255,255,0.2);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .icon-label {
            font-size: 0.75rem;
            margin-top: 0.25rem;
            text-align: center;
            white-space: nowrap;
        }

        .content-area {
            background: #f8f9fa;
            border-radius: 24px 24px 0 0;
            padding: 1.5rem;
            margin-top: 1.5rem;
            min-height: calc(100vh - 180px);
        }

        .package-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            margin-bottom: 1rem;
        }

        .netflix-logo {
            width: 48px;
            height: 48px;
            background: #E50914;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            color: white;
            font-size: 2rem;
        }

        .carousel-indicators {
            margin-bottom: 0.5rem;
        }

        .carousel-indicators button {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin: 0 4px;
        }

        .time-badge {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            font-weight: 600;
            color: #333;
        }

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

        .app-icon {
            width: 72px;
            height: 72px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            box-shadow: var(--card-shadow);
            margin-bottom: 0.5rem;
        }

        .app-item {
            text-align: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .filter-tabs .btn {
            border-radius: 24px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border: none;
        }

        .filter-tabs .btn-primary {
            background: #b91d4e;
        }

        .filter-tabs .btn-light {
            background: #e9ecef;
            color: #999;
        }

        .recommendation-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .recommendation-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .recommendation-info {
            padding: 1rem;
        }

        .recommendation-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.25rem;
        }

        .recommendation-duration {
            color: #666;
            font-size: 0.9rem;
        }

        .recommendation-price {
            color: #b91d4e;
            font-weight: 700;
            font-size: 1.25rem;
            margin-top: 0.5rem;
        }

        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 0.75rem 0 1.5rem 0;
            box-shadow: 0 -2px 12px rgba(0,0,0,0.08);
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
    <div class="container-fluid p-0" style="max-width: 480px; margin: 0 auto;">
        <!-- Header -->
        <div class="header">
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="d-flex align-items-center">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed=John" alt="Profile" style="width: 48px; height: 48px; border-radius: 50%; margin-right: 1rem;">
                    <h1 class="greeting mb-0">Hai, John Doe!</h1>
                </div>
                <div class="header-icons">
                    <div class="icon-wrapper">
                        <button class="icon-btn">
                            <i class="far fa-bookmark"></i>
                        </button>
                        <div class="icon-label">Saved</div>
                    </div>
                    <div class="icon-wrapper">
                        <button class="icon-btn">
                            <i class="far fa-envelope"></i>
                        </button>
                        <div class="icon-label">Inbox</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Active Package Card -->
            <div class="package-card">
                <div id="packageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#packageCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#packageCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#packageCarousel" data-bs-slide-to="2"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="netflix-logo me-3">N</div>
                                    <h3 class="mb-0" style="font-weight: 700;">Netflix</h3>
                                </div>
                                <i class="fas fa-chevron-right text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <span class="time-badge">
                        <i class="far fa-clock"></i>
                        1d 22h 48m
                    </span>
                </div>
            </div>

            <!-- Search Box -->
            <div class="position-relative">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="form-control search-box" placeholder="Search your package">
            </div>

            <!-- Applications Section -->
            <h2 class="section-title">Applications</h2>
            <div class="d-flex gap-3 mb-4 overflow-auto pb-2" style="scrollbar-width: none; -ms-overflow-style: none;">
                <div class="app-item" style="min-width: 72px;">
                    <div class="app-icon">
                        <div class="netflix-logo" style="width: 100%; height: 100%; font-size: 2.5rem;">N</div>
                    </div>
                    <div>Netflix</div>
                </div>
                <div class="app-item" style="min-width: 72px;">
                    <div class="app-icon">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/11/Amazon_Prime_Video_logo.svg" alt="Prime" style="width: 80%; height: auto;">
                    </div>
                    <div>Prime</div>
                </div>
                <div class="app-item" style="min-width: 72px;">
                    <div class="app-icon">
                        <i class="fas fa-play-circle" style="font-size: 2.5rem; color: #FFD700;"></i>
                    </div>
                    <div>VIU</div>
                </div>
                <div class="app-item" style="min-width: 72px;">
                    <div class="app-icon">
                        <i class="fas fa-play-circle" style="font-size: 2.5rem; color: #E50914;"></i>
                    </div>
                    <div>Vidio</div>
                </div>
                <div class="app-item" style="min-width: 72px;">
                    <div class="app-icon">
                        <i class="fas fa-star" style="font-size: 2.5rem; color: #00A8E1;"></i>
                    </div>
                    <div>Hotstar</div>
                </div>
            </div>

            <!-- Recommended Section -->
            <h2 class="section-title">Recommended for You</h2>
            <div class="filter-tabs d-flex gap-2 mb-3">
                <button class="btn btn-primary">Hourly</button>
                <button class="btn btn-light">Daily</button>
                <button class="btn btn-light">Monthly</button>
            </div>

            <div class="row g-3" style="margin-bottom: 100px;">
                <div class="col-6">
                    <div class="recommendation-card">
                        <img src="https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=400&h=300&fit=crop" alt="Netflix">
                        <div class="recommendation-info">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="recommendation-title">Netflix</div>
                                <div class="recommendation-duration">1 Hour</div>
                            </div>
                            <div class="recommendation-price">Rp 3.000</div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="recommendation-card">
                        <img src="https://images.unsplash.com/photo-1595769816263-9b910be24d5f?w=400&h=300&fit=crop" alt="Prime Video">
                        <div class="recommendation-info">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="recommendation-title">Prime Video</div>
                                <div class="recommendation-duration">3 Hour</div>
                            </div>
                            <div class="recommendation-price">Rp 5.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation -->
        <div class="bottom-nav">
            <div class="row g-0">
                <div class="col">
                    <a href="#" class="nav-item active">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-chart-bar"></i>
                        Dashboard
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-comments"></i>
                        Chat
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
