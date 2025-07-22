<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile | Feedback Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom Dashboard CSS -->
    <link href="@vite(['resources/css/dashboard.css'])" rel="stylesheet">
    <!-- Additional CSS for profile page -->
    <style>
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .profile-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
            font-weight: 600;
            margin-right: 2rem;
            position: relative;
            overflow: hidden;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }
        
        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .avatar-upload {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 0.5rem;
            font-size: 0.8rem;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .profile-avatar:hover .avatar-upload {
            opacity: 1;
        }
        
        .profile-title {
            color: white;
            margin-bottom: 0.5rem;
        }
        
        .profile-subtitle {
            color: var(--text-light);
            margin-bottom: 1rem;
        }
        
        .form-label {
            color: white;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.25);
            color: white;
        }
        
        .btn-save {
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 70%;
            transform: translateY(-50%);
            cursor: pointer;
            color: white;
        }
        
        .password-input-group {
            position: relative;
        }
        
        .error-message {
            color: var(--danger-color);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .success-message {
            color: #4ade80;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-avatar {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="bi bi-chat-square-text"></i> FeedbackTracker
            </div>
            <div class="logo-subtitle">Professional Analytics</div>
        </div>

        <div class="sidebar-nav">
            <div class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('feedbacks') }}" class="nav-link">
                    <i class="bi bi-chat-left-text"></i>
                    Feedbacks
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('analytics') }}" class="nav-link">
                    <i class="bi bi-graph-up-arrow"></i> 
                    Analytics
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link active">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
            </div>
        </div>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
                </div>
                <div class="user-details">
                    <h6>{{ auth()->user()->name ?? 'User' }}</h6>
                    <small>Business Owner</small>
                </div>
            </div>
            <form method="GET" action="{{ route('logout') }}">
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- Overlay for mobile -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        <!-- Top Navigation -->
        <div class="top-navbar">
            <button class="mobile-toggle" id="mobileToggle">
                <i class="bi bi-list"></i>
            </button>
            <h1 class="page-title">Profile Settings</h1>
        </div>

        <!-- Profile Content -->
        <div class="profile-container">
            <!-- Business Profile Card -->
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar" id="avatarContainer">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture">
                        @else
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @endif
                        <div class="avatar-upload" id="avatarUploadTrigger">
                            <i class="bi bi-camera-fill"></i> Change Photo
                        </div>
                        <input type="file" id="avatarUpload" accept="image/*" style="display: none;">
                    </div>
                    <div>
                        <h2 class="profile-title">{{ auth()->user()->name }}</h2>
                        <p class="profile-subtitle">Business Owner</p>
                    </div>
                </div>
                
                <form id="businessProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="businessName" class="form-label">Business Name</label>
                            <input type="text" class="form-control" id="businessName" name="business_name" 
                                   value="{{ auth()->user()->business_name ?? '' }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ auth()->user()->name ?? '' }}" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="businessDescription" class="form-label">Business Description</label>
                        <textarea class="form-control" id="businessDescription" name="business_description" 
                                  rows="4">{{ auth()->user()->business_description ?? '' }}</textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    
                    <button type="submit" class="btn btn-save">Save Changes</button>
                    
                    @if(session('profile_success'))
                        <div class="success-message mt-2">{{ session('profile_success') }}</div>
                    @endif
                    
                    @if($errors->any())
                        <div class="error-message mt-2">
                            @foreach($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                </form>
            </div>
            
            <!-- Change Password Card -->
            <div class="profile-card">
                <h3 class="profile-title mb-4">Change Password</h3>
                
                <form id="changePasswordForm" action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3 password-input-group">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="currentPassword" name="current_password" required>
                        <i class="bi bi-eye-slash password-toggle" id="toggleCurrentPassword"></i>
                        @error('current_password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 password-input-group">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        <i class="bi bi-eye-slash password-toggle" id="toggleNewPassword"></i>
                        @error('new_password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3 password-input-group">
                        <label for="confirmPassword" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation" required>
                        <i class="bi bi-eye-slash password-toggle" id="toggleConfirmPassword"></i>
                    </div>
                    
                    <button type="submit" class="btn btn-save">Update Password</button>
                    
                    @if(session('password_success'))
                        <div class="success-message mt-2">{{ session('password_success') }}</div>
                    @endif
                </form>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const mainContent = document.getElementById('mainContent');

        mobileToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Navigation link active state
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Auto-hide sidebar on mobile when clicking nav links
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });

        // Profile picture upload
        const avatarUploadTrigger = document.getElementById('avatarUploadTrigger');
        const avatarUpload = document.getElementById('avatarUpload');
        const avatarContainer = document.getElementById('avatarContainer');

        avatarUploadTrigger.addEventListener('click', function() {
            avatarUpload.click();
        });

        avatarUpload.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(event) {
                    // Create image element if it doesn't exist
                    let img = avatarContainer.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        avatarContainer.innerHTML = '';
                        avatarContainer.appendChild(img);
                        avatarContainer.appendChild(avatarUploadTrigger);
                    }
                    img.src = event.target.result;
                }
                
                reader.readAsDataURL(e.target.files[0]);
                
                // Submit the form when a new image is selected
                document.getElementById('businessProfileForm').submit();
            }
        });

        // Password toggle functionality
        function setupPasswordToggle(toggleId, inputId) {
            const toggle = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            
            toggle.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggle.classList.remove('bi-eye-slash');
                    toggle.classList.add('bi-eye');
                } else {
                    input.type = 'password';
                    toggle.classList.remove('bi-eye');
                    toggle.classList.add('bi-eye-slash');
                }
            });
        }

        setupPasswordToggle('toggleCurrentPassword', 'currentPassword');
        setupPasswordToggle('toggleNewPassword', 'newPassword');
        setupPasswordToggle('toggleConfirmPassword', 'confirmPassword');
    </script>
</body>
</html>