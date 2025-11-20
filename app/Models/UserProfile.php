<!-- === PROFILE PAGE KAMU === -->
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

        .mobile-container { padding: 20px; }
        .header { text-align: center; padding: 15px 0; font-size: 18px; font-weight: 600; }
        .profile-card {
            background: linear-gradient(135deg, #a94064 0%, #c85a7a 100%);
            border-radius: 20px; padding: 20px;
            display: flex; justify-content: space-between; color: white;
        }
        .profile-avatar { width: 60px; height: 60px; border-radius: 50%; overflow: hidden; background:white; }
        .profile-avatar img { width:100%; height:100%; object-fit:cover; }
        .edit-btn{ background:white;border:none;width:40px;height:40px;border-radius:12px;cursor:pointer;}

        /* photo screens unchanged */
        .photo-screen{
            background:linear-gradient(135deg,#a94064 0%,#c85a7a 100%);
            min-height:100vh;padding:20px;color:white;
        }
        .photo-grid{ background:white;padding:15px;border-radius:20px;
            display:grid;grid-template-columns:repeat(3,1fr);gap:10px;max-width:300px;}
        .photo-option{width:80px;height:80px;border-radius:15px;overflow:hidden;cursor:pointer;}
    </style>
</head>
<body>

<!-- PROFILE SCREEN -->
<div id="profileScreen" class="screen active">
    <div class="mobile-container">
        <div class="header">Profile</div>

        <div class="profile-card">
            <div class="profile-info">
                <div class="profile-avatar">
                    <img id="mainProfileImg"
                         src="{{ $user->fotoProfil ? asset('storage/profile/'.$user->fotoProfil) : '' }}"
                         style="{{ $user->fotoProfil ? '' : 'display:none;' }}">

                    @if(!$user->fotoProfil)
                    <i id="mainProfileIcon" class="fas fa-user fa-2x" style="color:#a94064;"></i>
                    @endif
                </div>

                <div class="profile-details">
                    <h5 style="margin:0;">{{ $user->usernamePengguna }}</h5>
                    <p style="margin:0;">{{ $user->emailPengguna }}</p>
                </div>
            </div>

            <button class="edit-btn" onclick="showScreen('avatarScreen')">
                <i class="fas fa-pen" style="color:#a94064;"></i>
            </button>
        </div>

        <button class="logout-btn" onclick="document.getElementById('logoutForm').submit()">Logout</button>
        <form id="logoutForm" action="{{ route('logout') }}" method="POST">@csrf</form>
    </div>
</div>


<!-- AVATAR SCREEN -->
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

        <button class="photo-action-btn" onclick="showScreen('gridScreen')">Choose Your Photo</button>
        <button class="photo-action-btn" onclick="showScreen('uploadScreen')">Upload From Device</button>
    </div>
</div>


<!-- GRID SCREEN -->
<div id="gridScreen" class="screen">
    <div class="photo-screen">
        <div class="photo-header">
            <button class="back-btn" onclick="showScreen('avatarScreen')">
                <i class="fas fa-chevron-left"></i>
            </button>
            Profile
        </div>

        <div class="photo-grid-container">
            <div class="photo-grid" id="photoGrid"></div>
        </div>

        <button class="photo-action-btn" onclick="selectFromGrid()">Choose</button>
    </div>
</div>


<!-- UPLOAD SCREEN -->
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
                <img id="uploadPreviewImg" style="display:none;">
                <i id="uploadIcon" class="fas fa-camera" style="font-size:80px;color:#a94064;"></i>
            </div>
        </div>

        <button class="photo-action-btn" onclick="document.getElementById('fileInput').click()">Upload Your Photo</button>

        <form id="uploadForm" action="{{ route('profile.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="fileInput" name="foto" accept="image/*" style="display:none;" onchange="handleFileSelect(event)">
        </form>

    </div>
</div>


<script>
    function showScreen(id){
        document.querySelectorAll('.screen').forEach(s=>s.classList.remove('active'));
        document.getElementById(id).classList.add('active');
    }

    function handleFileSelect(event){
        const file = event.target.files[0];
        if(!file) return;

        let preview = document.getElementById("uploadPreviewImg");
        let icon = document.getElementById("uploadIcon");

        let reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.style.display = "block";
            icon.style.display = "none";
        }
        reader.readAsDataURL(file);

        // otomatis upload ke server
        setTimeout(() => {
            document.getElementById("uploadForm").submit();
        }, 500);
    }
</script>

</body>
</html>
