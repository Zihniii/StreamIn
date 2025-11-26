<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - {{ config('app.name', 'Stream.in') }}</title>
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

        header {
            background-color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #1a1a1a;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .back-btn:hover {
            opacity: 0.7;
        }

        .header-title {
            font-size: 17px;
            font-weight: 600;
            flex: 1;
            text-align: center;
            margin-right: 28px;
        }

        .content {
            padding: 20px;
            min-height: calc(100vh - 60px);
        }

        .order-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .order-item {
            background-color: white;
            border-radius: 12px;
            padding: 16px;
            display: flex;
            gap: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
            color: inherit;
        }

        .order-item:active {
            transform: scale(0.98);
        }

        .order-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        .order-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }

        .order-details {
            flex: 1;
        }

        .order-name {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
            color: #1a1a1a;
        }

        .order-duration {
            font-size: 13px;
            color: #666;
            margin-bottom: 8px;
        }

        .order-date {
            font-size: 13px;
            color: #e50914;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .calendar-icon {
            width: 14px;
            height: 14px;
            color: #e50914;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 16px;
        }

        .empty-text {
            font-size: 15px;
            color: #666;
            margin-bottom: 8px;
        }

        .empty-subtext {
            font-size: 13px;
            color: #999;
        }

        /* Animation */
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

        .order-item {
            animation: fadeInUp 0.4s ease-out;
        }

        .order-item:nth-child(1) {
            animation-delay: 0.05s;
        }

        .order-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .order-item:nth-child(3) {
            animation-delay: 0.15s;
        }

        .order-item:nth-child(n+4) {
            animation-delay: 0.2s;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <header>
        <a href="{{ route('dashboard') }}" class="back-btn">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h1 class="header-title">Order History</h1>
    </header>

    <!-- Content -->
    <div class="content">
        <div class="order-list">
            @forelse($orderHistory ?? [] as $order)
                <a href="{{ route('dashboard.packages.detail', $order->id) }}" class="order-item">
                    <div class="order-icon">
                        <img src="{{ asset('img/' . $order->package->logoSubscription) }}"
                            alt="{{ $order->package->serviceName }}"
                            onerror="this.src='{{ asset('img/default-platform.png') }}'">
                    </div>
                    <div class="order-details">
                        <div class="order-name">{{ $order->package->serviceName }}</div>
                        <div class="order-duration">
                            {{ $order->package->descriptionDurasi ?? $order->package->durasiPackage . ' days package' }}
                        </div>
                        <div class="order-date">
                            <svg class="calendar-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            <span>
                                {{ \Carbon\Carbon::parse($order->startDate)->format('d F Y H.i') }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <p class="empty-text">No order history yet</p>
                    <p class="empty-subtext">Your order history will appear here</p>
                </div>
            @endforelse
        </div>
    </div>

</body>

</html>
