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
            background: #fff;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto;
            margin: 0;
        }

        /* Mobile: centered container */
        .page-wrapper {
            max-width: 480px;
            margin: 0 auto;
            padding-bottom: 120px;
            background: #fff;
            min-height: 100vh;
        }

        /* Laptop: FULL WIDTH seperti homepage */
        @media (min-width: 768px) {
            .page-wrapper {
                max-width: 100%;
                padding-bottom: 140px;
            }
        }

        /* Header */
        .header {
            text-align: center;
            padding: 18px 0;
            font-size: 20px;
            font-weight: 700;
        }

        @media (min-width: 768px) {
            .header {
                font-size: 28px;
                padding: 32px 0;
            }
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

        @media (min-width: 768px) {
            .profile-card {
                padding: 40px 60px;
                margin: 30px 80px;
                border-radius: 30px;
            }
        }

        @media (min-width: 1200px) {
            .profile-card {
                margin: 30px 120px;
                padding: 45px 80px;
            }
        }

        .profile-left {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        @media (min-width: 768px) {
            .profile-left {
                gap: 30px;
            }
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

        @media (min-width: 768px) {
            .profile-avatar {
                width: 110px;
                height: 110px;
            }
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
            transition: transform 0.2s;
        }

        @media (min-width: 768px) {
            .edit-btn {
                width: 60px;
                height: 60px;
                border-radius: 16px;
            }

            .edit-btn:hover {
                transform: scale(1.05);
            }
        }

        .edit-btn i {
            color: #aa3154;
            font-size: 18px;
        }

        @media (min-width: 768px) {
            .edit-btn i {
                font-size: 24px;
            }
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

        @media (min-width: 768px) {
            .profile-name {
                font-size: 26px;
            }
        }

        .profile-email {
            margin: 0;
            opacity: .9;
            font-size: 14px;
        }

        @media (min-width: 768px) {
            .profile-email {
                font-size: 18px;
                margin-top: 4px;
            }
        }

        /* Menu List */
        .menu-list {
            background: white;
            margin-top: 25px;
        }

        @media (min-width: 768px) {
            .menu-list {
                margin: 40px 80px;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            }
        }

        @media (min-width: 1200px) {
            .menu-list {
                margin: 40px 120px;
            }
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
            transition: background 0.2s;
        }

        @media (min-width: 768px) {
            .menu-item {
                padding: 28px 40px;
                font-size: 19px;
            }

            .menu-item:hover {
                background: #f8f8f8;
            }
        }

        .menu-left {
            display: flex;
            gap: 16px;
            align-items: center;
        }

        @media (min-width: 768px) {
            .menu-left {
                gap: 24px;
            }
        }

        .menu-left i {
            font-size: 20px;
            color: #333;
        }

        @media (min-width: 768px) {
            .menu-left i {
                font-size: 24px;
                width: 30px;
            }
        }

        .chevron-icon {
            font-size: 16px;
            color: #666;
        }

        @media (min-width: 768px) {
            .chevron-icon {
                font-size: 20px;
            }
        }

        /* Bagas Rafi - Logout */
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
            transition: all 0.2s;
            width: calc(100% - 40px);
        }

        @media (min-width: 768px) {
            .logout-btn {
                padding: 20px;
                margin: 50px 80px;
                font-size: 19px;
                border-radius: 18px;
                width: calc(100% - 160px);
            }

            .logout-btn:hover {
                background: #fff5f5;
                border-color: #c03434;
            }
        }

        @media (min-width: 1200px) {
            .logout-btn {
                margin: 50px 120px;
                width: calc(100% - 240px);
            }
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
            position: relative;
            overflow: hidden;
        }

        /* FULL RED BACKGROUND */
        .photo-screen::before {
            content: "";
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            z-index: -1;
        }

        @media (min-width: 768px) {
            .photo-screen {
                padding: 40px 80px;
            }
        }

        @media (min-width: 1200px) {
            .photo-screen {
                padding: 40px 120px;
            }
        }

        .photo-header {
            text-align: center;
            position: relative;
            padding-top: 10px;
            padding-bottom: 25px;
            font-size: 18px;
            font-weight: 600;
        }

        @media (min-width: 768px) {
            .photo-header {
                font-size: 28px;
                padding-top: 20px;
                padding-bottom: 45px;
            }
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 10px;
            font-size: 20px;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        @media (min-width: 768px) {
            .back-btn {
                font-size: 28px;
                left: 80px;
                top: 20px;
            }

            .back-btn:hover {
                opacity: 0.8;
            }
        }

        @media (min-width: 1200px) {
            .back-btn {
                left: 120px;
            }
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

        @media (min-width: 768px) {
            .avatar-circle {
                width: 320px;
                height: 320px;
                margin: 60px auto;
            }
        }

        .photo-action-btn {
            width: 100%;
            display: block;
            padding: 16px;
            background: white;
            color: #a94064;
            font-weight: 700;
            border-radius: 30px;
            text-align: center;
            margin: 40px auto 0;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        @media (min-width: 768px) {
            .photo-action-btn {
                padding: 22px;
                font-size: 19px;
                margin: 50px auto 0;
                max-width: 500px;
            }

            .photo-action-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
            }
        }

        /* --Bagas Rafi - Logout Modal Styles --- */
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

        @media (min-width: 768px) {
            .modal-content {
                max-width: 450px;
                padding: 45px 35px;
            }
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

        @media (min-width: 768px) {
            .modal-icon {
                width: 90px;
                height: 90px;
                margin-bottom: 25px;
            }
        }

        .modal-icon i {
            font-size: 32px;
            color: white;
        }

        @media (min-width: 768px) {
            .modal-icon i {
                font-size: 40px;
            }
        }

        .modal-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 12px 0;
        }

        @media (min-width: 768px) {
            .modal-title {
                font-size: 26px;
                margin-bottom: 16px;
            }
        }

        .modal-text {
            font-size: 15px;
            color: #666;
            line-height: 1.5;
            margin: 0 0 28px 0;
        }

        @media (min-width: 768px) {
            .modal-text {
                font-size: 17px;
                line-height: 1.6;
                margin-bottom: 35px;
            }
        }

        .modal-actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        @media (min-width: 768px) {
            .modal-actions {
                gap: 15px;
            }
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

        @media (min-width: 768px) {

            .btn-cancel,
            .btn-confirm {
                padding: 18px;
                font-size: 18px;
                border-radius: 14px;
            }
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

        /* Bottom navbar */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 10px 0 18px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
        }

        @media (min-width: 768px) {
            .bottom-nav {
                padding: 18px 0 25px 0;
            }
        }

        .bottom-nav .container-nav {
            max-width: 480px;
            margin: 0 auto;
            padding: 0 20px;
        }

        @media (min-width: 768px) {
            .bottom-nav .container-nav {
                max-width: 100%;
                padding: 0 80px;
            }
        }

        @media (min-width: 1200px) {
            .bottom-nav .container-nav {
                padding: 0 120px;
            }
        }

        .bottom-nav .nav-item {
            text-align: center;
            color: #999;
            font-size: 13px;
            text-decoration: none;
            display: block;
            transition: color 0.2s;
        }

        @media (min-width: 768px) {
            .bottom-nav .nav-item {
                font-size: 15px;
            }

            .bottom-nav .nav-item:hover {
                color: #b91d4e;
            }
        }

        .bottom-nav .nav-item.active {
            color: #b91d4e;
        }

        .bottom-nav i {
            font-size: 20px;
            display: block;
            margin-bottom: 4px;
        }

        @media (min-width: 768px) {
            .bottom-nav i {
                font-size: 24px;
                margin-bottom: 6px;
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

            <!-- Bagas Rafi - LOGOUT BUTTON -->
            <button class="logout-btn" onclick="showLogoutModal()">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </button>

            <!-- Bagas Rafi - Form logout tersembunyi -->
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
                    <img id="previewImg" style="display:none; width:100%; height:100%; object-fit:cover;">
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

        <!-- Bagas Rafi - LOGOUT CONFIRMATION MODAL -->
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

    </div> <!-- Close .page-wrapper -->

    <!-- Bagas Rafi - BOTTOM NAV (DILUAR page-wrapper AGAR FIXED POSITION BENAR) -->
    <div class="bottom-nav">
        <div class="container-nav">
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

        function showLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function hideLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function confirmLogout() {
            document.getElementById('logoutForm').submit();
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideLogoutModal();
            }
        });
    </script>

</body>

</html>