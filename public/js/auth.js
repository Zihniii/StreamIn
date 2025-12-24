
// =============================================
// Coded by: Bagas Rafi Dewantara
// NRP: 5026231091
// ============================================= 
// Toggle Password Visibility
function togglePassword(inputId, iconElement) {
    const input = document.getElementById(inputId);
    const img = iconElement.querySelector('img');

    if (input.type === 'password') {
        input.type = 'text';
        img.src = '/img/eye-open.png';
    } else {
        input.type = 'password';
        img.src = '/img/eye-close.png';
    }
}

// Email Validation Helper
function isValidEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Handle Login Form - Client-side validation only
function handleLogin(e) {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
    
    if (!isValidEmail(email) || password.length < 6) {
        document.getElementById('loginError').style.display = 'block';
        document.getElementById('loginEmail').classList.add('is-invalid');
        document.getElementById('loginPassword').classList.add('is-invalid');
        e.preventDefault();
        return false;
    }
    
    return true; // Allow form submission to Laravel
}

// Handle Signup Form - Client-side validation only
function handleSignup(e) {
    const emailInput = document.getElementById('signupEmail');
    const emailVal = emailInput.value;
    const password = document.getElementById('signupPassword').value;
    const confirm = document.getElementById('signupConfirmPassword').value;
    
    let isValid = true;
    
    // 1. Reset semua error dulu
    document.getElementById('signupEmailError').style.display = 'none'; // Reset error email JS
    document.getElementById('signupPasswordError').style.display = 'none';
    document.getElementById('signupConfirmError').style.display = 'none';
    
    // Hapus class invalid jika ada
    emailInput.classList.remove('is-invalid');
    document.getElementById('signupPassword').classList.remove('is-invalid');
    document.getElementById('signupConfirmPassword').classList.remove('is-invalid');

    // 2. Validasi Email (TAMBAHAN BARU)
    if (!isValidEmail(emailVal)) {
        document.getElementById('signupEmailError').style.display = 'block';
        emailInput.classList.add('is-invalid');
        isValid = false;
    }
    
    // 3. Validate password
    if (password.length < 8 || !/\d/.test(password) || !/[!@#$%^&*]/.test(password)) {
        document.getElementById('signupPasswordError').style.display = 'block';
        document.getElementById('signupPassword').classList.add('is-invalid');
        isValid = false;
    }
    
    // 4. Validate password match
    if (password !== confirm) {
        document.getElementById('signupConfirmError').style.display = 'block';
        document.getElementById('signupConfirmPassword').classList.add('is-invalid');
        isValid = false;
    }
    
    if (!isValid) {
        e.preventDefault();
        return false; // Stop form submission
    }
    
    return true; // Allow form submission to Laravel

   
}

// Real-time Email Validation
document.addEventListener('input', function(e) {
    if (e.target.type === 'email') {
        const input = e.target;
        const icon = input.parentElement.querySelector('.input-icon.success');

        if (input.value === '') {
            input.classList.remove('is-valid', 'is-invalid');
            if (icon) icon.style.display = 'none';
            return;
        }

        if (isValidEmail(input.value)) {
            input.classList.add('is-valid');
            input.classList.remove('is-invalid');
            if (icon) icon.style.display = 'flex';
        } else {
            input.classList.add('is-invalid');
            input.classList.remove('is-valid');
            if (icon) icon.style.display = 'none';
        }
    }
});

// Toast Notification Functions
function closeToast() {
    const toast = document.getElementById('successToast');
    if (toast) {
        toast.style.animation = 'fadeOut 0.3s ease-in forwards';
        setTimeout(() => {
            toast.remove();
        }, 300);
    }
}

// Auto close toast after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const toast = document.getElementById('successToast');
    if (toast) {
        setTimeout(() => {
            closeToast();
        }, 5000);
    }
});