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
        .package-card {
            display: flex;
            gap: 12px;
            padding: 16px;
            border-bottom: 1px solid #e0e0e0;
            background: white;
            cursor: pointer;
        }
        .package-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
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
        }
        .package-price {
            color: #8b2332;
            font-weight: 700;
            margin-top: 6px;
            font-size: 16px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
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
        .last-search-item img {
            width: 100%;
            aspect-ratio: 1;
            border-radius: 8px;
            object-fit: cover;
        }
        .recent-search-item {
            padding: 12px 16px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #eee;
        }
        .close-icon {
            color: #888;
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
                <input type="text" id="searchInput" class="search-input" placeholder="Search your package">
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div id="contentArea">

        <!-- Empty State -->
        <div id="emptyState" class="empty-state">
            <h5>What are you<br>looking for today?</h5>
        </div>

        <!-- Last Search -->
        <div id="lastSearchSection" style="display:none;">
            <div class="last-search-section">
                <div class="last-search-title">Last Search</div>

                <div class="last-search-grid">
                    <div>
                        <img src="https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200">
                        <div style="font-size:13px;font-weight:600;">Netflix</div>
                        <div style="font-size:11px;color:#666;">1 Hour</div>
                        <div style="color:#8b2332;font-weight:600;">Rp 3.000</div>
                    </div>

                    <div>
                        <img src="https://images.unsplash.com/photo-1522869635100-9f4c5e86aa37?w=200">
                        <div style="font-size:13px;font-weight:600;">Prime Video</div>
                        <div style="font-size:11px;color:#666;">3 Hour</div>
                        <div style="color:#8b2332;font-weight:600;">Rp 5.000</div>
                    </div>

                    <div>
                        <img src="https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=200">
                        <div style="font-size:13px;font-weight:600;">Viu</div>
                        <div style="font-size:11px;color:#666;">5 Hour</div>
                        <div style="color:#8b2332;font-weight:600;">Rp 8.000</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Search -->
        <div id="recentSearch" style="display:none;">
            <div class="recent-search-item">
                <span>Netflix</span>
                <i class="bi bi-x close-icon"></i>
            </div>
        </div>

        <!-- Search Results -->
        <div id="searchResults" style="display:none;"></div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>

    const packages = [
        { name: "Netflix", duration: "3 hour package", price: "Rp 10.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
        { name: "Netflix", duration: "3 days package", price: "Rp 12.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
        { name: "Netflix", duration: "8 hour package", price: "Rp 13.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
        { name: "Netflix", duration: "12 hour package", price: "Rp 15.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
        { name: "Netflix", duration: "18 hour package", price: "Rp 18.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
        { name: "Netflix", duration: "3 days package", price: "Rp 25.000", image: "https://images.unsplash.com/photo-1574375927938-d5a98e8ffe85?w=200" },
    ];

    const searchInput = document.getElementById("searchInput");

    searchInput.addEventListener("focus", () => {
        document.getElementById("emptyState").style.display = "none";
        document.getElementById("lastSearchSection").style.display = "block";
        document.getElementById("recentSearch").style.display = "block";
    });

    searchInput.addEventListener("input", function(e){
        const value = e.target.value.trim().toLowerCase();

        if(value.length === 0){
            document.getElementById("searchResults").style.display = "none";
            document.getElementById("lastSearchSection").style.display = "block";
            return;
        }

        const filtered = packages.filter(p => p.name.toLowerCase().includes(value));

        showSearchResults(filtered);
    });

    function showSearchResults(items){
        const resultsDiv = document.getElementById("searchResults");
        document.getElementById("lastSearchSection").style.display = "none";

        resultsDiv.innerHTML = items.map(pkg => `
            <a href="{{ route('package') }}" style="text-decoration:none; color:inherit;">
                <div class="package-card">
                    <img src="${pkg.image}" class="package-image">
                    <div>
                        <div class="package-title">${pkg.name}</div>
                        <div class="package-duration"><i class="bi bi-clock"></i> ${pkg.duration}</div>
                        <div class="package-price">${pkg.price}</div>
                    </div>
                </div>
            </a>
        `).join("");

        resultsDiv.style.display = "block";
    }

</script>

</body>
</html>
