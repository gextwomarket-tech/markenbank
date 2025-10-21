<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('dashboard.overview') . ' - ' . __('app_name'))</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.js"></script>
    
    <style>
        :root[data-theme="dark"] {
            --primary: #0066FF;
            --secondary: #6C2BD9;
            --accent: #00D9FF;
            --success: #00D1A0;
            --warning: #FF8F3D;
            --danger: #FF4757;
            --bg-dark-1: #1A1D29;
            --bg-dark-2: #252A3A;
            --bg-dark-3: #2D3349;
            --text-primary: #FFFFFF;
            --text-secondary: #A0AEC0;
            --border-color: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --sidebar-bg: #1A1D29;
        }
        
        :root[data-theme="light"] {
            --primary: #0047AB;
            --secondary: #6C2BD9;
            --accent: #00B8D4;
            --success: #00A87E;
            --warning: #FF7720;
            --danger: #E63946;
            --bg-dark-1: #F8F9FD;
            --bg-dark-2: #FFFFFF;
            --bg-dark-3: #F0F2F7;
            --text-primary: #2D3748;
            --text-secondary: #718096;
            --border-color: rgba(0, 0, 0, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.8);
            --glass-border: rgba(0, 0, 0, 0.1);
            --sidebar-bg: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark-1);
            color: var(--text-primary);
            transition: background 0.3s ease;
        }
        
        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .sidebar-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-nav {
            padding: 1rem;
        }
        
        .nav-item {
            margin-bottom: 0.5rem;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: var(--text-secondary);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: var(--glass-bg);
            color: var(--primary);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 1rem;
            font-size: 1.25rem;
        }
        
        .sidebar.collapsed .nav-link span {
            display: none;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }
        
        .sidebar.collapsed ~ .main-content {
            margin-left: 80px;
        }
        
        /* Top Bar */
        .topbar {
            background: var(--bg-dark-2);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .topbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .theme-toggle-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--glass-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .theme-toggle-btn:hover {
            background: var(--glass-bg);
            border-color: var(--primary);
        }
        
        .notification-btn {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--glass-bg);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 20px;
            height: 20px;
            background: var(--danger);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }
        
        .user-profile:hover {
            background: var(--glass-bg);
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary);
        }
        
        .user-info h6 {
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-primary);
        }
        
        .user-info small {
            color: var(--text-secondary);
            font-size: 0.75rem;
        }
        
        /* Content Area */
        .content-area {
            padding: 2rem;
        }
        
        /* Glass Card */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 40px rgba(0, 102, 255, 0.1);
        }
        
        /* Stats Card */
        .stat-card {
            background: var(--glass-bg);
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid var(--glass-border);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }
        
        /* Virtual Card */
        .virtual-card {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .virtual-card:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 60px rgba(0, 102, 255, 0.4);
        }
        
        .virtual-card::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -100px;
            right: -50px;
        }
        
        .card-chip {
            width: 50px;
            height: 40px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        
        .card-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem;
            letter-spacing: 0.2rem;
            margin-bottom: 1rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .topbar {
                padding: 1rem;
            }
            
            .content-area {
                padding: 1rem;
            }
        }
        
        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 50%, var(--accent) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--bg-dark-1);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('home') }}" class="sidebar-logo">
                    <i class="fas fa-landmark"></i>
                    <span class="text-gradient">{{ __('app_name') }}</span>
                </a>
            </div>
            
            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        <span>{{ __('dashboard.overview') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('dashboard.accounts') }}" class="nav-link {{ request()->routeIs('dashboard.accounts*') ? 'active' : '' }}">
                        <i class="fas fa-wallet"></i>
                        <span>{{ __('dashboard.accounts') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('dashboard.transactions.index') }}" class="nav-link {{ request()->routeIs('dashboard.transactions*') ? 'active' : '' }}">
                        <i class="fas fa-exchange-alt"></i>
                        <span>{{ __('dashboard.transactions') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('dashboard.cards.index') }}" class="nav-link {{ request()->routeIs('dashboard.cards*') ? 'active' : '' }}">
                        <i class="fas fa-credit-card"></i>
                        <span>{{ __('dashboard.cards') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('dashboard.topup.index') }}" class="nav-link {{ request()->routeIs('dashboard.topup*') ? 'active' : '' }}">
                        <i class="fas fa-arrow-circle-up"></i>
                        <span>{{ __('dashboard.topup') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="{{ route('dashboard.profile.edit') }}" class="nav-link {{ request()->routeIs('dashboard.profile*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle"></i>
                        <span>{{ __('dashboard.profile') }}</span>
                    </a>
                </div>
                
                <hr style="border-color: var(--border-color); margin: 1rem 0;">
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-headset"></i>
                        <span>{{ __('dashboard.help') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>{{ __('dashboard.settings') }}</span>
                    </a>
                </div>
                
                <div class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{ __('auth.logout') }}</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="topbar">
                <div class="topbar-left">
                    <button class="btn btn-link text-decoration-none p-0" id="sidebarToggle">
                        <i class="fas fa-bars fa-lg" style="color: var(--text-primary);"></i>
                    </button>
                    <h5 class="mb-0 d-none d-md-block">{{ __('dashboard.welcome') }}, {{ auth()->user()->name }} 👋</h5>
                </div>
                
                <div class="topbar-right">
                    <div class="theme-toggle-btn" onclick="toggleTheme()">
                        <i class="fas fa-adjust"></i>
                    </div>
                    
                    <div class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </div>
                    
                    <div class="dropdown">
                        <div class="user-profile" data-bs-toggle="dropdown">
                            @if(auth()->user()->avatar_path)
                                <img src="{{ Storage::url(auth()->user()->avatar_path) }}" alt="Avatar" class="user-avatar">
                            @else
                                <div class="user-avatar bg-gradient-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                            @endif
                            <div class="user-info d-none d-md-block">
                                <h6>{{ auth()->user()->name }}</h6>
                                <small>{{ auth()->user()->email }}</small>
                            </div>
                            <i class="fas fa-chevron-down ms-2 d-none d-md-block"></i>
                        </div>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: var(--bg-dark-2); border: 1px solid var(--border-color); border-radius: 15px; padding: 0.5rem;">
                            <li><a class="dropdown-item" href="{{ route('dashboard.profile.edit') }}" style="color: var(--text-primary); border-radius: 10px;"><i class="fas fa-user me-2"></i>{{ __('profile.title') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('dashboard.accounts') }}" style="color: var(--text-primary); border-radius: 10px;"><i class="fas fa-wallet me-2"></i>{{ __('dashboard.accounts') }}</a></li>
                            <li><hr class="dropdown-divider" style="border-color: var(--border-color);"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger" style="border-radius: 10px;">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('auth.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Theme Toggle
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
        
        // Load saved theme
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
        });
        
        // Sidebar Toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
        });
        
        // Mobile Sidebar Toggle
        if (window.innerWidth <= 768) {
            document.getElementById('sidebarToggle')?.addEventListener('click', function() {
                document.getElementById('sidebar').classList.toggle('show');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
