<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix - Pilih Paket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .container {
            max-width: 480px;
            margin: 0 auto;
            background-color: white;
            min-height: 100vh;
            padding-bottom: 20px;
        }
        .header {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border-bottom: 1px solid #e0e0e0;
        }
        .back-btn {
            position: absolute;
            left: 20px;
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
        }
        .header h1 {
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }
        .status-bar {
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
        }
        .status-icons {
            display: flex;
            gap: 5px;
            align-items: center;
        }
        .netflix-banner {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .netflix-logo {
            font-size: 64px;
            font-weight: 900;
            color: #e50914;
            letter-spacing: 5px;
            z-index: 2;
        }
        .content-wrapper {
            padding: 0 20px;
        }
        .title-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .title-section h2 {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
        }
        .bookmark-btn {
            background: none;
            border: 2px solid #c41e3a;
            color: #c41e3a;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 20px;
        }
        .description {
            color: #6c757d;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
        }
        .tab-buttons {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }
        .tab-btn {
            flex: 1;
            padding: 12px;
            border: none;
            background-color: #f0f0f0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        .tab-btn.active {
            background-color: #fce4ec;
            color: #c41e3a;
            font-weight: 600;
        }
        .pricing-card {
            border: 2px solid #e0e0e0;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.3s;
            background-color: white;
        }
        .pricing-card:hover {
            border-color: #c41e3a;
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.1);
        }
        .pricing-card.selected {
            border-color: #c41e3a;
            background-color: white;
        }
        .time-badge {
            background-color: #9e9e9e;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            min-width: 100px;
            justify-content: center;
        }
        .pricing-card.selected .time-badge {
            background-color: #c41e3a;
        }
        .pricing-info h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 5px 0;
        }
        .pricing-info p {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }
        .radio-btn {
            width: 24px;
            height: 24px;
            border: 2px solid #c41e3a;
            border-radius: 50%;
            position: relative;
        }
        .radio-btn.selected::after {
            content: '';
            width: 14px;
            height: 14px;
            background-color: #c41e3a;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .choose-btn {
            width: 100%;
            padding: 18px;
            background-color: #c41e3a;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
        }
        .choose-btn:hover {
            background-color: #a01729;
        }
        .packages-container {
            display: none;
        }
        .packages-container.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="status-bar">
            <div class="status-icons">
            </div>
        </div>

        <div class="header">
            <button class="back-btn" onclick="history.back()">
                <i class="bi bi-chevron-left"></i>
            </button>
            <h1>Netflix</h1>
        </div>

        <div class="netflix-banner">
            <div class="netflix-logo">NETFLIX</div>
        </div>

        <div class="content-wrapper">
            <div class="title-section">
                <h2>Netflix</h2>
                <button class="bookmark-btn">
                    <i class="bi bi-bookmark"></i>
                </button>
            </div>

            <p class="description">
                Nikmati pengalaman menonton tanpa batas dengan paket Netflix khusus. Dapatkan akses ke ribuan film, serial, dan dokumenter terbaik di dunia. Tidak ada iklan, tidak ada gangguan, hanya hiburan berkualitas untuk setiap momen.
            </p>

            <div class="tab-buttons">
                <button class="tab-btn active" onclick="switchTab('hourly')">Hourly</button>
                <button class="tab-btn" onclick="switchTab('daily')">Daily</button>
                <button class="tab-btn" onclick="switchTab('monthly')">Monthly</button>
            </div>

            <!-- Hourly Packages -->
            <div id="hourly-packages" class="packages-container active">
                <div class="pricing-card" onclick="selectCard('hourly', 0)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>1 Hour</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp3.000</h3>
                            <p>Quick watch session</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="hourly-radio-0"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('hourly', 1)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>3 Hour</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp5.000</h3>
                            <p>Great for a movie or more</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="hourly-radio-1"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('hourly', 2)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>6 Hour</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp7.000</h3>
                            <p>Extended viewing time</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="hourly-radio-2"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('hourly', 3)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>12 Hour</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp10.000</h3>
                            <p>All-day streaming access</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="hourly-radio-3"></div>
                </div>
            </div>

            <!-- Daily Packages -->
            <div id="daily-packages" class="packages-container">
                <div class="pricing-card" onclick="selectCard('daily', 0)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>1 Day</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp20.000</h3>
                            <p>24 hour access</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="daily-radio-0"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('daily', 1)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>3 Day</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp25.000</h3>
                            <p>Weekend entertainment</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="daily-radio-1"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('daily', 2)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>5 Day</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp30.000</h3>
                            <p>Work week streaming</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="daily-radio-2"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('daily', 3)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-clock"></i>
                            <span>7 Day</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp40.000</h3>
                            <p>Full week access</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="daily-radio-3"></div>
                </div>
            </div>

            <!-- Monthly Packages -->
            <div id="monthly-packages" class="packages-container">
                <div class="pricing-card" onclick="selectCard('monthly', 0)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-calendar"></i>
                            <span>1 Month</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp50.000</h3>
                            <p>30 days of fun</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="monthly-radio-0"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('monthly', 1)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-calendar"></i>
                            <span>3 Month</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp70.000</h3>
                            <p>Quarter year deal</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="monthly-radio-1"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('monthly', 2)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-calendar"></i>
                            <span>6 Month</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp80.000</h3>
                            <p>Half year of fun</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="monthly-radio-2"></div>
                </div>

                <div class="pricing-card" onclick="selectCard('monthly', 3)">
                    <div class="d-flex align-items-center gap-3">
                        <div class="time-badge">
                            <i class="bi bi-calendar"></i>
                            <span>12 Month</span>
                        </div>
                        <div class="pricing-info">
                            <h3>Rp150.000</h3>
                            <p>Year round streaming</p>
                        </div>
                    </div>
                    <div class="radio-btn" id="monthly-radio-3"></div>
                </div>
            </div>

            <button class="choose-btn" onclick="choosePackage()">Choose Package</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentTab = 'hourly';
        let selectedCardIndex = {
            hourly: -1,
            daily: -1,
            monthly: -1
        };

        function switchTab(tab) {
            // Update active tab button
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Hide all packages and show selected tab
            document.querySelectorAll('.packages-container').forEach(container => {
                container.classList.remove('active');
            });
            document.getElementById(tab + '-packages').classList.add('active');

            currentTab = tab;
        }

        function selectCard(tab, index) {
            const cards = document.querySelectorAll(`#${tab}-packages .pricing-card`);
            const radios = document.querySelectorAll(`#${tab}-packages .radio-btn`);

            cards.forEach((card, i) => {
                if (i === index) {
                    card.classList.add('selected');
                    radios[i].classList.add('selected');
                } else {
                    card.classList.remove('selected');
                    radios[i].classList.remove('selected');
                }
            });

            selectedCardIndex[tab] = index;
        }

        function choosePackage() {
            const selected = selectedCardIndex[currentTab];

            if (selected === -1) {
                alert('Silakan pilih paket terlebih dahulu!');
                return;
            }

            const packages = {
                hourly: [
                    '1 Hour - Rp3.000',
                    '3 Hour - Rp5.000',
                    '6 Hour - Rp7.000',
                    '12 Hour - Rp10.000'
                ],
                daily: [
                    '1 Day - Rp20.000',
                    '3 Day - Rp25.000',
                    '5 Day - Rp30.000',
                    '7 Day - Rp40.000'
                ],
                monthly: [
                    '1 Month - Rp50.000',
                    '3 Month - Rp70.000',
                    '6 Month - Rp80.000',
                    '12 Month - Rp150.000'
                ]
            };

        }
    </script>
</body>
</html>
