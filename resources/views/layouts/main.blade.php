<!DOCTYPE html>
<html lang="id">
<head>
    <title>Smart Infusion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            background: #f5f6fa;
        }

        /* SIDEBAR */
        .sidebar {
            height: 100vh;
            background: #1e2a38;
            color: white;
            position: fixed;
            width: 250px;
            padding: 20px 15px; 
            box-shadow: 2px 0 8px rgba(0,0,0,0.15);
        }

        .sidebar h3 {
            font-size: 1.4rem;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none !important;
            display: flex;
            align-items: center;

            padding: 12px 18px;      
            margin-bottom: 6px;      
            border-radius: 8px;      
            transition: all 0.2s ease-in-out;
            font-size: 0.95rem;
        }

        .sidebar a i {
            width: 22px;
        }

        .sidebar a:hover {
            background: #2d3d50;
            color: #fff;
            transform: translateX(3px);
        }

        .sidebar .active {
            background: #3498db !important;
            color: #fff !important;
        }

        .text-section {
            font-size: 0.75rem;
            color: #bdc3c7;
            margin: 18px 0 8px 4px; 
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        /* Digital Display */
        .digital-font {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            font-size: 3rem;
            background: #000;
            color: #00ff00;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            letter-spacing: 2px;
            box-shadow: inset 0 0 6px rgba(0,255,0,0.5), 0 0 10px rgba(0,255,0,0.3);
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h3 class="text-center py-4 border-bottom">SMART INFUS</h3>
    
    <div class="text-muted small px-3 mt-3">MENU UTAMA</div>
    
    <a href="{{ route('monitoring.index') }}" class="{{ request()->is('monitoring*') ? 'active' : '' }}">
        <i class="fas fa-heartbeat me-2"></i> Monitoring
    </a>
    
    <a href="{{ route('devices.index') }}" class="{{ request()->is('devices*') ? 'active' : '' }}">
        <i class="fas fa-hospital me-2"></i> Data Ruangan & Alat
    </a>
    
    <div class="text-muted small px-3 mt-3">AKUN</div>
    
    <form action="{{ route('logout') }}" method="POST" class="d-inline">
        @csrf
        <button class="btn btn-link text-white text-decoration-none w-100 text-start px-3 py-2">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
