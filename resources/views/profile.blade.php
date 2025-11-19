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
            background-color: #f5f5f5;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            max-width: 480px;
            margin: 0 auto;
            min-height: 100vh;
        }

        .screen {
            display: none;
            background: white;
            min-height: 100vh;
            padding-bottom: 100px;
        }

        .screen.active { display: block; }

        /* PROFILE SCREEN */
        .mobile-container {
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 1px solid #f0f0f0;
            position: relative;
            margin: -20px -20px 20px -20px;
        }

        .back-btn {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            font-size: 20px;
            color: white;
            cursor: pointer;
        }

        .profile-card {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            border-radius: 20px;
            padding: 20px;
            width: 100%;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .profile-info { display: flex; align-items: center; gap: 15px; }
        .profile-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .edit-btn {
            background: white;
            border: none;
            padding: 10px;
            border-radius: 12px;
            width: 40px;
            height: 40px;
            cursor: pointer;
        }

        .menu-list { margin-top: 10px; }
        .menu-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 5px;
            width: 100%;
            background: white;
            border: none;
            cursor: pointer;
            transition: .2s;
        }
        .menu-item:hover { background-color: #f8f8f8; }
        .menu-item-content { display: flex; align-items: center; gap: 15px; }
        .menu-icon { font-size: 20px; color: #333; }
        .menu-text { font-size: 16px; font-weight: 500; }

        .dropdown-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #eee;
            margin-top: -10px;
            margin-bottom: 10px;
            padding: 10px 5px;
            display: none;
        }
        .dropdown-box.show { display: block; }

        .logout-btn {
            margin-top: 20px;
            width: 100%;
            padding: 16px;
            background: white;
            border: 1px solid #f0f0f0;
            border-radius: 12px;
            color: #dc3545;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
        }

        /* PHOTO SELECTION SCREENS */
        .photo-screen {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            min-height: 100vh;
            padding: 20px;
            color: white;
        }

        .photo-header {
            text-align: center;
            padding: 15px 0 30px;
            font-size: 18px;
            font-weight: 600;
            position: relative;
        }

        .photo-preview {
            display: flex;
            justify-content: center;
            margin: 40px 0;
        }

        .avatar-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-circle i {
            font-size: 80px;
            color: #a94064;
        }

        .photo-action-btn {
            width: 100%;
            padding: 16px;
            background: white;
            color: #a94064;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 40px;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        /* PHOTO GRID */
        .photo-grid-container {
            display: flex;
            justify-content: center;
            margin: 40px 0;
        }

        .photo-grid {
            background: white;
            padding: 15px;
            border-radius: 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            max-width: 300px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .photo-option {
            width: 80px;
            height: 80px;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s;
        }

        .photo-option:hover {
            transform: scale(1.05);
            border-color: #a94064;
        }

        .photo-option.selected {
            border-color: #a94064;
            transform: scale(0.95);
        }

        .photo-option img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* FILE INPUT */
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        /* BOTTOM NAV */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            max-width: 480px;
            width: 100%;
            background: white;
            border-top: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-around;
            padding: 12px 0 20px;
            z-index: 100;
        }

        .nav-item {
            color: #999;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 12px;
        }
        .nav-item.active { color: #a94064; }
        .nav-item i { font-size: 20px; margin-bottom: 4px; }
    </style>
</head>
<body>

<!-- SCREEN 1: PROFILE PAGE -->
<div id="profileScreen" class="screen active">
    <div class="mobile-container">
        <div class="header">Profile</div>

        <div class="profile-card">
            <div class="profile-info">
                <div class="profile-avatar">
                    <img id="mainProfileImg" src="" alt="" style="display:none;">
                    <i id="mainProfileIcon" class="fas fa-user fa-2x" style="color:#a94064;"></i>
                </div>
                <div class="profile-details">
                    <h5 style="margin:0;">John Doe</h5>
                    <p style="margin:0; opacity:0.9;">johndoe@email.com</p>
                </div>
            </div>
            <button class="edit-btn" onclick="showScreen('avatarScreen')">
                <i class="fas fa-pen" style="color:#a94064;"></i>
            </button>
        </div>

        <div class="menu-list">
            <button class="menu-item" onclick="toggleDropdown('settingsBox')">
                <div class="menu-item-content">
                    <i class="fas fa-cog menu-icon"></i>
                    <span class="menu-text">Settings</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>

            <div id="settingsBox" class="dropdown-box">
                <button class="menu-item" onclick="alert('Customer Service')" style="padding-left:40px;">
                    <div class="menu-item-content">
                        <i class="fas fa-headset menu-icon"></i>
                        <span class="menu-text">Customer Service</span>
                    </div>
                </button>
                <button class="menu-item" onclick="alert('Privacy Policy')" style="padding-left:40px;">
                    <div class="menu-item-content">
                        <i class="fas fa-shield-alt menu-icon"></i>
                        <span class="menu-text">Privacy Policy</span>
                    </div>
                </button>
            </div>

            <button class="menu-item" onclick="toggleDropdown('notifBox')">
                <div class="menu-item-content">
                    <i class="fas fa-bell menu-icon"></i>
                    <span class="menu-text">Notifications</span>
                </div>
                <i class="fas fa-chevron-down"></i>
            </button>

            <div id="notifBox" class="dropdown-box">
                <button class="menu-item" onclick="alert('Hide Notification')" style="padding-left:40px;">
                    <div class="menu-item-content">
                        <i class="fas fa-eye-slash menu-icon"></i>
                        <span class="menu-text">Hide Notification</span>
                    </div>
                </button>
            </div>
        </div>

        <button class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Log Out
        </button>
    </div>
</div>

<!-- SCREEN 2: AVATAR SELECTION -->
<div id="avatarScreen" class="screen">
    <div class="photo-screen">
        <div class="photo-header">
            <button class="back-btn" onclick="showScreen('profileScreen')">
                <i class="fas fa-chevron-left"></i>
            </button>
            Profile
        </div>

        <div class="photo-preview">
            <div class="avatar-circle">
                <i class="fas fa-user-circle" style="font-size: 120px; color: #a94064;"></i>
            </div>
        </div>

        <button class="photo-action-btn" onclick="showScreen('gridScreen')">
            Choose Your Photo
        </button>
    </div>
</div>

<!-- SCREEN 3: PHOTO GRID SELECTION -->
<div id="gridScreen" class="screen">
    <div class="photo-screen">
        <div class="photo-header">
            <button class="back-btn" onclick="showScreen('avatarScreen')">
                <i class="fas fa-chevron-left"></i>
            </button>
            Profile
        </div>

        <div class="photo-grid-container">
            <div class="photo-grid" id="photoGrid">
                <!-- Photos will be generated here -->
            </div>
        </div>

        <button class="photo-action-btn" onclick="selectFromGrid()">
            Choose
        </button>
    </div>
</div>

<!-- SCREEN 4: SELECTED PHOTO PREVIEW -->
<div id="previewScreen" class="screen">
    <div class="photo-screen">
        <div class="photo-header">
            <button class="back-btn" onclick="showScreen('gridScreen')">
                <i class="fas fa-chevron-left"></i>
            </button>
            Profile
        </div>

        <div class="photo-preview">
            <div class="avatar-circle">
                <img id="previewImg" src="" alt="Preview">
            </div>
        </div>

        <button class="photo-action-btn" onclick="confirmSelection()">
            Choose
        </button>
    </div>
</div>

<!-- SCREEN 5: UPLOAD YOUR PHOTO -->
<div id="uploadScreen" class="screen">
    <div class="photo-screen">
        <div class="photo-header">
            <button class="back-btn" onclick="showScreen('avatarScreen')">
                <i class="fas fa-chevron-left"></i>
            </button>
            Profile
        </div>

        <div class="photo-preview">
            <div class="avatar-circle">
                <img id="uploadPreviewImg" src="" alt="Upload Preview" style="display:none;">
                <i id="uploadIcon" class="fas fa-camera" style="font-size: 80px; color: #a94064;"></i>
            </div>
        </div>

        <div class="file-input-wrapper">
            <button class="photo-action-btn" onclick="document.getElementById('fileInput').click()">
                Upload Your Photo
            </button>
            <input type="file" id="fileInput" accept="image/*" onchange="handleFileSelect(event)">
        </div>
    </div>
</div>

<!-- BOTTOM NAVIGATION -->
<div class="bottom-nav">
    <a href="#" class="nav-item">
        <i class="fas fa-home"></i>
        <span>Home</span>
    </a>
    <a href="#" class="nav-item">
        <i class="fas fa-th"></i>
        <span>Dashboard</span>
    </a>
    <a href="#" class="nav-item">
        <i class="fas fa-comment"></i>
        <span>Chat</span>
    </a>
    <a href="#" class="nav-item active">
        <i class="fas fa-user"></i>
        <span>Profile</span>
    </a>
</div>

<script>
    let selectedPhoto = null;

    // Sample photo data (using placeholder images)
    const samplePhotos = [
        'https://i.pravatar.cc/150?img=1',
        'https://i.pravatar.cc/150?img=2',
        'https://i.pravatar.cc/150?img=3',
        'https://i.pravatar.cc/150?img=4',
        'https://i.pravatar.cc/150?img=5',
        'https://i.pravatar.cc/150?img=6',
        'https://i.pravatar.cc/150?img=7',
        'https://i.pravatar.cc/150?img=8',
        'https://i.pravatar.cc/150?img=9'
    ];

    // Initialize photo grid
    function initPhotoGrid() {
        const grid = document.getElementById('photoGrid');
        grid.innerHTML = '';
        samplePhotos.forEach((photo, index) => {
            const div = document.createElement('div');
            div.className = 'photo-option';
            div.onclick = () => selectPhoto(index, photo);
            div.innerHTML = `<img src="${photo}" alt="Photo ${index + 1}">`;
            grid.appendChild(div);
        });
    }

    // Select photo from grid
    function selectPhoto(index, photoUrl) {
        document.querySelectorAll('.photo-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        document.querySelectorAll('.photo-option')[index].classList.add('selected');
        selectedPhoto = photoUrl;
    }

    // Show selected photo in preview
    function selectFromGrid() {
        if (selectedPhoto) {
            document.getElementById('previewImg').src = selectedPhoto;
            showScreen('previewScreen');
        } else {
            alert('Please select a photo first');
        }
    }

    // Confirm selection and go back to profile
    function confirmSelection() {
        const mainImg = document.getElementById('mainProfileImg');
        const mainIcon = document.getElementById('mainProfileIcon');
        mainImg.src = selectedPhoto;
        mainImg.style.display = 'block';
        mainIcon.style.display = 'none';
        showScreen('profileScreen');
    }

    // Handle file upload
    function handleFileSelect(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const uploadPreview = document.getElementById('uploadPreviewImg');
                const uploadIcon = document.getElementById('uploadIcon');
                uploadPreview.src = e.target.result;
                uploadPreview.style.display = 'block';
                uploadIcon.style.display = 'none';
                
                // Update main profile after a short delay
                setTimeout(() => {
                    const mainImg = document.getElementById('mainProfileImg');
                    const mainIcon = document.getElementById('mainProfileIcon');
                    mainImg.src = e.target.result;
                    mainImg.style.display = 'block';
                    mainIcon.style.display = 'none';
                    showScreen('profileScreen');
                }, 1000);
            };
            reader.readAsDataURL(file);
        }
    }

    // Toggle dropdown
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle('show');
    }

    // Show screen
    function showScreen(screenId) {
        document.querySelectorAll('.screen').forEach(screen => {
            screen.classList.remove('active');
        });
        document.getElementById(screenId).classList.add('active');
        
        if (screenId === 'gridScreen') {
            initPhotoGrid();
        }
    }

    // Initialize on load
    window.onload = function() {
        initPhotoGrid();
    };
</script>

</body>
</html>