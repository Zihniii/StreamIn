<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Search</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
        }
        .mobile-container {
            width: 100%;
            min-height: 100vh;
            background: white;
        }

        /* Tablet & Desktop */
        @media (min-width: 768px) {
            .mobile-container {
                max-width: 420px;
                margin: 0 auto;
                box-shadow: 0 0 20px rgba(0,0,0,0.08);
                border-radius: 16px;
            }
        }

        .search-header {
            padding: 12px 16px;
            background: white;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search-input-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-input-wrapper {
            position: relative;
            flex: 1;
        }
        .search-input {
            width: 100%;
            background: #f5f5f5;
            border: none;
            border-radius: 8px;
            padding: 10px 12px 10px 40px;
            font-size: 14px;
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
        }
        .package-card {
            display: flex;
            gap: 12px;
            padding: 16px;
            border-bottom: 1px solid #eee;
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
        }
        .package-duration {
            font-size: 13px;
            color: #666;
        }
        .package-price {
            font-weight: 700;
            color: #8b2332;
            margin-top: 6px;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }
    </style>
</head>

<body>
<div class="mobile-container">

    <!-- Search Header -->
    <div class="search-header">
        <div class="search-input-group">
            <button class="back-btn" onclick="window.history.back()">
                <i class="bi bi-chevron-left"></i>
            </button>
            <div class="search-input-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input
                    type="text"
                    id="searchInput"
                    class="search-input"
                    placeholder="Search your package"
                    value="{{ $query ?? '' }}"
                >
            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="contentArea">

        <div id="emptyState" class="empty-state">
            <h5>What are you<br>looking for today?</h5>
        </div>

        <div id="searchResults" style="display:none;"></div>

    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // 🔥 data dari controller (AMAN)
    const packages = @json($packages);

    const searchInput = document.getElementById('searchInput');
    const emptyState  = document.getElementById('emptyState');
    const resultsDiv  = document.getElementById('searchResults');

    function renderResults(items) {
        emptyState.style.display = items.length ? 'none' : 'block';
        resultsDiv.style.display = items.length ? 'block' : 'none';

        if (!items.length) {
            resultsDiv.innerHTML = '';
            return;
        }

        resultsDiv.innerHTML = items.map(pkg => `
            <a href="${pkg.url}" style="text-decoration:none;color:inherit;">
                <div class="package-card">
                    <img src="${pkg.image}" class="package-image"
                         onerror="this.src='https://via.placeholder.com/80'">
                    <div>
                        <div class="package-title">${pkg.name}</div>
                        <div class="package-duration">
                            <i class="bi bi-clock"></i> ${pkg.duration}
                        </div>
                        <div class="package-price">${pkg.price}</div>
                    </div>
                </div>
            </a>
        `).join('');
    }

    // realtime filter
    searchInput.addEventListener('input', function () {
        const value = this.value.toLowerCase().trim();

        if (!value) {
            renderResults([]);
            return;
        }

        const filtered = packages.filter(pkg =>
            pkg.name.toLowerCase().includes(value)
        );

        renderResults(filtered);
    });

    // kalau halaman dibuka dengan query
    if (searchInput.value.trim() !== '') {
        renderResults(packages.filter(pkg =>
            pkg.name.toLowerCase().includes(searchInput.value.toLowerCase())
        ));
    }
</script>

</body>
</html>
