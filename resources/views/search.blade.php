<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .mobile-container {
            max-width: 375px;
            margin: 0 auto;
            background: white;
            min-height: 100vh;
            position: relative;
        }
        .status-bar {
            background: white;
            padding: 8px 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            font-weight: 600;
        }
        .search-header {
            padding: 12px 16px;
            background: white;
            border-bottom: 1px solid #e0e0e0;
        }
        .search-input-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-input {
            flex: 1;
            background: #f5f5f5;
            border: none;
            border-radius: 8px;
            padding: 10px 12px 10px 40px;
            font-size: 14px;
        }
        .search-input-wrapper {
            position: relative;
            flex: 1;
        }
        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        .back-btn {
            background: none;
            border: none;
            font-size: 20px;
            color: #333;
            padding: 0;
        }
        .filter-chips {
            display: flex;
            gap: 8px;
            padding: 12px 16px;
            overflow-x: auto;
            white-space: nowrap;
            border-bottom: 1px solid #e0e0e0;
        }
        .filter-chips::-webkit-scrollbar {
            display: none;
        }
        .filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 20px;
            border: 1px solid #ddd;
            background: white;
            font-size: 13px;
            white-space: nowrap;
        }
        .filter-chip.active {
            background: #8b2332;
            color: white;
            border-color: #8b2332;
        }
        .filter-toggle {
            background: none;
            border: 1px solid #ddd;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }
        .package-card {
            display: flex;
            gap: 12px;
            padding: 16px;
            border-bottom: 1px solid #e0e0e0;
            background: white;
        }
        .package-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
        .package-info {
            flex: 1;
        }
        .package-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 4px;
        }
        .package-duration {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #666;
            font-size: 13px;
            margin-bottom: 8px;
        }
        .package-price {
            color: #8b2332;
            font-weight: 700;
            font-size: 16px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
        .empty-illustration {
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }
        .empty-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .last-search-section {
            padding: 16px;
        }
        .last-search-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .last-search-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .last-search-item {
            text-align: left;
        }
        .last-search-image {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
            object-fit: cover;
            margin-bottom: 8px;
        }
        .last-search-name {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 2px;
        }
        .last-search-duration {
            font-size: 11px;
            color: #666;
        }
        .last-search-price {
            font-size: 13px;
            color: #8b2332;
            font-weight: 600;
        }
        .modal-header {
            border-bottom: none;
            padding: 20px 16px 12px;
        }
        .modal-title {
            font-size: 18px;
            font-weight: 600;
            margin: 0 auto;
        }
        .filter-section {
            padding: 16px;
            border-bottom: 1px solid #e0e0e0;
        }
        .filter-section-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 12px;
        }
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .filter-option {
            padding: 8px 16px;
            border: 1px solid #ddd;
            border-radius: 20px;
            background: white;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-option.selected {
            background: #8b2332;
            color: white;
            border-color: #8b2332;
        }
        .form-check-input:checked {
            background-color: #8b2332;
            border-color: #8b2332;
        }
        .modal-footer {
            border-top: none;
            padding: 16px;
            gap: 12px;
        }
        .btn-clear {
            flex: 1;
            background: white;
            border: 1px solid #8b2332;
            color: #8b2332;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-confirm {
            flex: 1;
            background: #8b2332;
            border: none;
            color: white;
            padding: 12px;
            border-radius: 8px;
            font-weight: 600;
        }
        .recent-search-item {
            padding: 12px 16px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .close-icon {
            color: #999;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="mobile-container">
        <!-- Status Bar -->
        <div class="status-bar">
            <span>9:41</span>
            <div>
                <i class="bi bi-reception-4"></i>
                <i class="bi bi-wifi"></i>
                <i class="bi bi-battery-full"></i>
            </div>
        </div>

        <!-- Search Header -->
        <div class="search-header">
            <div class="search-input-group">
                <button class="back-btn" onclick="window.location.href='{{ route('homepage') }}'">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <div class="search-input-wrapper">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search your package" id="searchInput">
                </div>
            </div>
        </div>

        <!-- Filter Chips -->
        <div class="filter-chips" id="filterChips" style="display: none;">
            <button class="filter-toggle" onclick="showFilterModal()">
                <i class="bi bi-funnel"></i>
            </button>
            <span class="filter-chip active" id="durationChip">
                <i class="bi bi-x-circle-fill" style="cursor: pointer;" onclick="removeFilter('duration')"></i>
                Duration
            </span>
            <span class="filter-chip active" id="applicationChip">
                <i class="bi bi-x-circle-fill" style="cursor: pointer;" onclick="removeFilter('application')"></i>
                Application
            </span>
            <span class="filter-chip active" id="priceChip">
                <i class="bi bi-x-circle-fill" style="cursor: pointer;" onclick="removeFilter('price')"></i>
                Price range
            </span>
        </div>

        <!-- Content Area -->
        <div id="contentArea">
            <!-- Empty State (Default) -->
            <div id="emptyState" class="empty-state">
                <div class="empty-illustration">
                    <svg viewBox="0 0 200 200" fill="none">
                        <circle cx="100" cy="80" r="50" fill="#f5f5f5" stroke="#ddd" stroke-width="2"/>
                        <path d="M75 70 Q75 60 85 60 L115 60 Q125 60 125 70 L125 90 Q125 100 115 100 L85 100 Q75 100 75 90 Z" fill="#fff" stroke="#333" stroke-width="2"/>
                        <circle cx="90" cy="78" r="3" fill="#333"/>
                        <circle cx="110" cy="78" r="3" fill="#333"/>
                        <path d="M90 88 Q100 93 110 88" stroke="#333" stroke-width="2" stroke-linecap="round" fill="none"/>
                        <path d="M55 105 L70 120 L70 140 M145 105 L130 120 L130 140" stroke="#333" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <div class="empty-title">What are you<br>looking for today?</div>
            </div>

            <!-- Last Search Section -->
            <div id="lastSearchSection" style="display: none;">
                <div class="last-search-section">
                    <div class="last-search-title">Last search</div>
                    <div class="last-search-grid">
                        <div class="last-search-item">
                            <img src="https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" alt="Netflix" class="last-search-image">
                            <div class="last-search-name">Netflix</div>
                            <div class="last-search-duration">1 Hour</div>
                            <div class="last-search-price">Rp 3.000</div>
                        </div>
                        <div class="last-search-item">
                            <img src="https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=200" alt="Prime Video" class="last-search-image">
                            <div class="last-search-name">Prime Video</div>
                            <div class="last-search-duration">3 Hour</div>
                            <div class="last-search-price">Rp 5.000</div>
                        </div>
                        <div class="last-search-item">
                            <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=200" alt="Viu" class="last-search-image">
                            <div class="last-search-name">Viu</div>
                            <div class="last-search-duration">5 Hour</div>
                            <div class="last-search-price">Rp 8.000</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Search -->
            <div id="recentSearch" style="display: none;">
                <div class="recent-search-item">
                    <span>Netflix</span>
                    <i class="bi bi-x close-icon"></i>
                </div>
            </div>

            <!-- Search Results -->
            <div id="searchResults" style="display: none;"></div>
        </div>
    </div>

    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Filter</h5>
                </div>
                <div class="modal-body p-0">
                    <!-- Application Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">
                            <i class="bi bi-app" style="color: #8b2332;"></i>
                            Application
                        </div>
                        <div class="filter-options">
                            <button class="filter-option" onclick="toggleFilter(this)">Netflix</button>
                            <button class="filter-option" onclick="toggleFilter(this)">Prime Video</button>
                            <button class="filter-option" onclick="toggleFilter(this)">VIU</button>
                            <button class="filter-option" onclick="toggleFilter(this)">Disney+ Hotstar</button>
                            <button class="filter-option" onclick="toggleFilter(this)">Vidio</button>
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">
                            <i class="bi bi-cash-stack" style="color: #8b2332;"></i>
                            Price Range
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priceRange" id="price1">
                                <label class="form-check-label" for="price1">
                                    <i class="bi bi-currency-dollar"></i> Under Rp10,000
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priceRange" id="price2">
                                <label class="form-check-label" for="price2">
                                    <i class="bi bi-currency-dollar"></i><i class="bi bi-currency-dollar"></i> Rp10,000 until Rp20,000
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="priceRange" id="price3">
                                <label class="form-check-label" for="price3">
                                    <i class="bi bi-currency-dollar"></i><i class="bi bi-currency-dollar"></i><i class="bi bi-currency-dollar"></i> Above Rp20,000
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Duration Filter -->
                    <div class="filter-section">
                        <div class="filter-section-title">
                            <i class="bi bi-clock" style="color: #8b2332;"></i>
                            Duration
                        </div>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="duration" id="hourly" checked>
                                <label class="form-check-label" for="hourly">
                                    Hourly
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="duration" id="daily">
                                <label class="form-check-label" for="daily">
                                    Daily
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="duration" id="monthly">
                                <label class="form-check-label" for="monthly">
                                    Monthly
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-clear" data-bs-dismiss="modal">Clear</button>
                    <button type="button" class="btn-confirm" onclick="applyFilters()">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const packages = [
            { name: 'Netflix', duration: '3 hour package', price: 'Rp 10.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' },
            { name: 'Netflix', duration: '3 days package', price: 'Rp 12.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' },
            { name: 'Netflix', duration: '8 hour package', price: 'Rp 13.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' },
            { name: 'Netflix', duration: '12 hour package', price: 'Rp 15.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' },
            { name: 'Netflix', duration: '18 hour package', price: 'Rp 18.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' },
            { name: 'Netflix', duration: '3 days package', price: 'Rp 25.000', image: 'https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200' }
        ];

        const searchInput = document.getElementById('searchInput');

        searchInput.addEventListener('focus', function() {
            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('lastSearchSection').style.display = 'block';
            document.getElementById('recentSearch').style.display = 'block';
        });

        searchInput.addEventListener('input', function(e) {
            if (e.target.value.length > 0) {
                showSearchResults();
            } else {
                document.getElementById('searchResults').style.display = 'none';
                document.getElementById('lastSearchSection').style.display = 'block';
            }
        });

        function showSearchResults() {
            const resultsDiv = document.getElementById('searchResults');
            resultsDiv.innerHTML = packages.map(pkg => `
                <div class="package-card">
                    <img src="${pkg.image}" alt="${pkg.name}" class="package-image">
                    <div class="package-info">
                        <div class="package-title">${pkg.name}</div>
                        <div class="package-duration">
                            <i class="bi bi-clock"></i>
                            ${pkg.duration}
                        </div>
                        <div class="package-price">${pkg.price}</div>
                    </div>
                </div>
            `).join('');
            resultsDiv.style.display = 'block';
            document.getElementById('lastSearchSection').style.display = 'none';
            document.getElementById('recentSearch').style.display = 'none';
        }

        function showFilterModal() {
            const modal = new bootstrap.Modal(document.getElementById('filterModal'));
            modal.show();
        }

        function toggleFilter(element) {
            element.classList.toggle('selected');
        }

        function applyFilters() {
            document.getElementById('filterChips').style.display = 'flex';
            const modal = bootstrap.Modal.getInstance(document.getElementById('filterModal'));
            modal.hide();
            showSearchResults();
        }

        function removeFilter(type) {
            document.getElementById(type + 'Chip').style.display = 'none';
        }
    </script>
</body>
</html>
