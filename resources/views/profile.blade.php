<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;
            margin: 0;
        }

        /* Center container but flexible */
        .page-wrapper {
            max-width: 480px;
            margin: 0 auto;
            padding-bottom: 120px;
            background: #fff;
            min-height: 100vh;
        }

        /* Header */
        .header {
            text-align: center;
            padding: 18px 0;
            font-size: 20px;
            font-weight: 700;
        }

        /* Profile Card */
        .profile-card {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            padding: 22px;
            border-radius: 22px;
            margin: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .profile-left {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .profile-avatar {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            overflow: hidden;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .edit-btn {
            background: white;
            border: none;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .edit-btn i {
            color: #aa3154;
            font-size: 18px;
        }

        .profile-text {
            display: flex;
            flex-direction: column;
            color: white;
        }

        .profile-name {
            font-size: 17px;
            font-weight: 700;
            margin: 0;
        }

        .profile-email {
            margin: 0;
            opacity: .9;
            font-size: 14px;
        }

        /* Menu List */
        .menu-list {
            background: white;
            margin-top: 25px;
        }

        .menu-item {
            width: 100%;
            padding: 18px 20px;
            background: white;
            border: none;
            border-bottom: 1px solid #ececec;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            cursor: pointer;
        }

        .menu-left {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        .menu-left i {
            font-size: 20px;
            color: #333;
        }

        .chevron-icon {
            font-size: 16px;
            color: #666;
        }

        /* Logout */
        .logout-btn {
            background: #fff;
            border: 1px solid #ddd;
            padding: 16px;
            text-align: center;
            border-radius: 14px;
            margin: 40px 20px;
            color: #c03434;
            font-weight: 600;
            cursor: pointer;
            display: block;
            width: calc(100% - 40px);
        }

        /* Upload Screens */
        .screen {
            display: none;
        }

        .screen.active {
            display: block;
        }

        .photo-screen {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            min-height: 100vh;
            padding: 20px;
            color: white;
        }

        .photo-header {
            text-align: center;
            position: relative;
            padding-top: 10px;
            padding-bottom: 25px;
            font-size: 18px;
            font-weight: 600;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 10px;
            font-size: 20px;
            background: none;
            border: none;
            color: white;
        }

        .avatar-circle {
            width: 220px;
            height: 220px;
            background: white;
            border-radius: 50%;
            margin: 40px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .photo-action-btn {
            width: 100%;
            padding: 16px;
            background: white;
            color: #a94064;
            font-weight: 700;
            border-radius: 30px;
            text-align: center;
            margin-top: 40px;
            cursor: pointer;
            border: none;
        }

        /* Bottom navbar */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 10px 0 18px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .bottom-nav .nav-item {
            text-align: center;
            color: #999;
            font-size: 13px;
            text-decoration: none;
            display: block;
        }

        .bottom-nav .nav-item.active {
            color: #b91d4e;
        }

        .bottom-nav i {
            font-size: 20px;
            display: block;
        }

        /* Logout Modal Styles */
        .logout-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.2s ease-in-out;
        }

        .modal-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            position: relative;
            background: white;
            border-radius: 24px;
            padding: 32px 24px;
            margin: 0 20px;
            max-width: 360px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease-out;
            z-index: 10000;
        }

        .modal-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-icon i {
            font-size: 32px;
            color: white;
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 12px 0;
        }

        .modal-text {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
            margin: 0 0 28px 0;
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn-cancel,
        .btn-confirm {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #f5f5f5;
            color: #333;
        }

        .btn-cancel:hover {
            background: #e8e8e8;
        }

        .btn-confirm {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(169, 64, 100, 0.3);
        }

        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(169, 64, 100, 0.4);
        }

        .btn-confirm:active {
            transform: translateY(0);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="page-wrapper">

        <div id="mainScreen" class="screen active">

            <div class="header">Profile</div>

            <!-- PROFILE CARD -->
            <div class="profile-card">
                <div class="profile-left">

                    <div class="profile-avatar">
                        @php
                        $fotoPath = public_path('img/profile/' . $user->fotoProfil);
                        @endphp

                        @if ($user->fotoProfil && file_exists($fotoPath))
                        <img src="{{ asset('img/profile/'.$user->fotoProfil) }}">
                        @else
                        <img src="https://i.pravatar.cc/150?u={{ $user->id }}">
                        @endif
                    </div>

                    <div class="profile-text">
                        <div class="profile-name">{{ $user->name }}</div>
                        <div class="profile-email">{{ $user->email }}</div>
                    </div>

                </div>

                <button class="edit-btn" onclick="showScreen('avatarScreen')">
                    <i class="fas fa-pen"></i>
                </button>
            </div>

            <!-- MENU LIST -->
            <div class="menu-list">

                <button class="menu-item">
                    <div class="menu-left"><i class="fas fa-cog"></i> Settings</div>
                    <i class="fas fa-chevron-right chevron-icon"></i>
                </button>

                <button class="menu-item">
                    <div class="menu-left"><i class="fas fa-bell"></i> Notifications</div>
                    <i class="fas fa-chevron-right chevron-icon"></i>
                </button>

                <button class="menu-item">
                    <div class="menu-left"><i class="fas fa-headset"></i> Customer Service</div>
                    <i class="fas fa-chevron-right chevron-icon"></i>
                </button>

                <button class="menu-item">
                    <div class="menu-left"><i class="fas fa-shield-alt"></i> Privacy Policy</div>
                    <i class="fas fa-chevron-right chevron-icon"></i>
                </button>

                <button class="menu-item" style="border-bottom:none;">
                    <div class="menu-left">About Us</div>
                    <i class="fas fa-external-link-alt chevron-icon"></i>
                </button>

            </div>

            <!-- LOGOUT BUTTON -->
            <button class="logout-btn" onclick="showLogoutModal()">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </button>

            <!-- Form logout tersembunyi -->
            <form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none;">
                @csrf
            </form>

        </div>

        <!-- AVATAR SCREEN -->
        <div id="avatarScreen" class="screen">
            <div class="photo-screen">

                <div class="photo-header">
                    <button class="back-btn" onclick="showScreen('mainScreen')">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    Profile
                </div>

                <div class="avatar-circle">
                    @if ($user->fotoProfil && file_exists($fotoPath))
                    <img src="{{ asset('img/profile/'.$user->fotoProfil) }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                    <i class="fas fa-user-circle" style="font-size:120px; color:#a94064;"></i>
                    @endif
                </div>

                <button class="photo-action-btn" onclick="showScreen('uploadScreen')">Choose Your Photo</button>

            </div>
        </div>

        <!-- UPLOAD SCREEN -->
        <div id="uploadScreen" class="screen">
            <div class="photo-screen">

                <div class="photo-header">
                    <button class="back-btn" onclick="showScreen('avatarScreen')">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    Upload Photo
                </div>

                <div class="avatar-circle">
                    <img id="previewImg" style="display:none;">
                    <i id="previewIcon" class="fas fa-camera" style="font-size:80px; color:#a94064;"></i>
                </div>

                <form id="uploadForm" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input id="fileInput" type="file" hidden name="foto" accept="image/*" onchange="readPhoto(event)">
                </form>

                <button class="photo-action-btn" onclick="document.getElementById('fileInput').click()">
                    Upload from Gallery
                </button>

                <button id="saveBtn" class="photo-action-btn"
                    style="display:none; background:#ffe6ec; color:#a94064; margin-top:20px;"
                    onclick="document.getElementById('uploadForm').submit()">
                    Save Photo
                </button>

            </div>
        </div>

        <!-- LOGOUT CONFIRMATION MODAL -->
        <div id="logoutModal" class="logout-modal" style="display: none;">
            <div class="modal-overlay" onclick="hideLogoutModal()"></div>
            <div class="modal-content">
                <div class="modal-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <h3 class="modal-title">Log Out of Your Account?</h3>
                <p class="modal-text">Are you sure you want to log out? You will need to log back in to access your account features</p>

                <div class="modal-actions">
                    <button class="btn-cancel" onclick="hideLogoutModal()">Stay Logged In</button>
                    <button class="btn-confirm" onclick="confirmLogout()">Log Out</button>
                </div>
            </div>
        </div>

    </div>

    <!-- BOTTOM NAV -->
    <div class="bottom-nav">
        <div class="row text-center">
            <div class="col">
                <a href="{{ route('homepage') }}" class="nav-item {{ request()->routeIs('homepage') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Home
                </a>
            </div>
            <div class="col">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i> Dashboard
                </a>
            </div>
            <div class="col">
                <a href="{{ route('chat.index') }}" class="nav-item {{ request()->routeIs('chat.index') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i> Chat
                </a>
            </div>
            <div class="col">
                <a href="{{ route('profile') }}" class="nav-item {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profile
                </a>
            </div>
        </div>
    </div>

    <script>
        function showScreen(id) {
            document.querySelectorAll(".screen").forEach(s => s.classList.remove("active"));
            document.getElementById(id).classList.add("active");
        }

        function readPhoto(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = "block";
                previewIcon.style.display = "none";
                saveBtn.style.display = "block";
            };
            reader.readAsDataURL(file);
        }

        // ✅ TAMBAHKAN FUNCTION-FUNCTION INI
        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
            // Re-enable body scroll
            document.body.style.overflow = 'auto';
        }

        function confirmLogout() {
            // Submit the hidden logout form
            document.getElementById('logoutForm').submit();
        }

        // Close modal when pressing ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideLogoutModal();
            }
        });
    </script>

</body>

</html>