<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inbox - {{ config('app.name', 'Stream.in') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #fff;
            margin: 0 auto;
            min-height: 100vh;
        }

        header {
            background-color: #fff;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
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
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .page-subtitle {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .report-cta {
            background: linear-gradient(135deg, #fff5f7 0%, #ffe0e6 100%);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .report-cta-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.2;
        }

        .report-cta-content {
            position: relative;
            z-index: 1;
        }

        .report-cta h3 {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
        }

        .report-cta p {
            font-size: 13px;
            color: #666;
            margin-bottom: 16px;
            line-height: 1.4;
            max-width: 60%;
        }

        .report-btn {
            background: linear-gradient(135deg, #c9184a 0%, #a4133c 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: transform 0.2s;
        }

        .report-btn:active {
            transform: scale(0.95);
        }

        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
        }

        .reports-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .report-item {
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

        .report-item:active {
            transform: scale(0.98);
        }

        .report-icon {
            width: 56px;
            height: 56px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
            background-color: #f9f9f9;
        }

        .report-icon img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .report-details {
            flex: 1;
            min-width: 0;
        }

        .report-title {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 6px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .report-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .report-date {
            font-size: 12px;
            color: #999;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-resolved {
            background-color: #d4edda;
            color: #155724;
        }

        .status-in_progress {
            background-color: #d1ecf1;
            color: #0c5460;
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

        .report-item {
            animation: fadeInUp 0.4s ease-out;
        }

        .report-item:nth-child(1) {
            animation-delay: 0.05s;
        }

        .report-item:nth-child(2) {
            animation-delay: 0.1s;
        }

        .report-item:nth-child(3) {
            animation-delay: 0.15s;
        }

        .report-item:nth-child(n+4) {
            animation-delay: 0.2s;
        }
    </style>
</head>

<body>
    <header>
        <a href="{{ route('homepage') }}" class="back-btn">
            <i class="fas fa-chevron-left"></i>
        </a>
        <h1 class="header-title">Inbox</h1>
    </header>

    <div class="content">
        <div class="page-header">
            <h1>Stay updated<br>with your reports.</h1>
            <p class="page-subtitle">
                Here you'll find responses and updates from our support team regarding the issues you've submitted.
            </p>
        </div>

        <div class="report-cta">
            <div class="report-cta-icon">
                <i class="fas fa-exclamation" style="font-size: 40px; color: white;"></i>
            </div>
            <div class="report-cta-content">
                <h3>Find Another Issue?</h3>
                <p>Report a problem and help us improve your streaming experience.
                </p>
                <a href="{{ route('dashboard') }}" class="report-btn">
                    <i class="fas fa-flag"></i>
                    Report Trouble
                </a>
            </div>
        </div>

        <h2 class="section-title">Your Reports</h2>

        <div class="reports-list">
            @forelse($reports ?? [] as $report)
                <a href="{{ route('report.detail', $report->reportID) }}" class="report-item">
                    <div class="report-icon">
                        @if ($report->subscription && $report->subscription->package)
                            <img src="{{ asset('img/' . $report->subscription->package->logoSubscription) }}"
                                alt="{{ $report->subscription->package->serviceName }}"
                                onerror="this.src='{{ asset('img/default-platform.png') }}'">
                        @else
                            <i class="fas fa-box" style="font-size: 24px; color: #999;"></i>
                        @endif
                    </div>
                    <div class="report-details">
                        <div class="report-title">{{ $report->issueCategory }}</div>
                        <div class="report-meta">
                            <div class="report-date">
                                <i class="fas fa-calendar" style="font-size: 10px;"></i>
                                <span>{{ \Carbon\Carbon::parse($report->createdAt)->format('d F Y') }}</span>
                            </div>

                            @if ($report->status === 'pending')
                                <span class="status-badge status-pending">
                                    <i class="fas fa-clock"></i>
                                    Pending Review
                                </span>
                            @elseif($report->status === 'resolved')
                                <span class="status-badge status-resolved">
                                    <i class="fas fa-check-circle"></i>
                                    Resolved
                                </span>
                            @elseif($report->status === 'in_progress')
                                <span class="status-badge status-in_progress">
                                    <i class="fas fa-tools"></i>
                                    In Progress
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <p class="empty-text">No reports yet</p>
                    <p class="empty-subtext">Your issue reports will appear here</p>
                </div>
            @endforelse
        </div>
    </div>
</body>

</html>
