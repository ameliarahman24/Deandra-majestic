<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruvoo Admin — Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-dark: #070708;
            --card-dark: #111115;
            --gold-text: #dfae62;
            --gold-gradient: linear-gradient(135deg, #dfae62 0%, #b8860b 100%);
            --text-muted: #7c7c85;
            --border-color: rgba(255, 255, 255, 0.05);
            
            --wedding-gold: #dfae62;
            --wedding-pink: #ffb6c1;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            overflow-x: hidden;
        }

        /* SIDEBAR STYLING */
        .sidebar {
            height: 100vh;
            width: 260px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--card-dark);
            border-right: 1px solid var(--border-color);
            padding: 2rem 1.5rem;
            z-index: 100;
        }
        .sidebar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: #ffffff;
            text-decoration: none;
            display: block;
            margin-bottom: 3rem;
        }
        .sidebar-brand span { color: var(--wedding-gold); }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-menu-item {
            margin-bottom: 0.5rem;
        }
        .nav-menu-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: var(--text-muted);
            text-decoration: none;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .nav-menu-link:hover, .nav-menu-link.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.03);
        }
        .nav-menu-link.active {
            border-left: 3px solid var(--wedding-gold);
            border-radius: 0 10px 10px 0;
            padding-left: 0.8rem;
        }

        /* MAIN CONTENT AREA */
        .main-content {
            margin-left: 260px;
            padding: 2.5rem 3rem;
            min-height: 100vh;
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
        }
        .admin-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gold-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #070708;
            font-weight: 700;
        }

        /* NOTIFICATION BOX */
        .notification-card {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1.25rem;
            transition: transform 0.2s ease;
        }
        .notification-card:hover {
            transform: translateX(4px);
            border-color: rgba(223, 174, 98, 0.2);
        }
        .notif-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            flex-shrink: 0;
        }
        .notif-info {
            flex-grow: 1;
        }
        .notif-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.25rem;
        }
        .notif-desc {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            line-height: 1.5;
        }
        .notif-time {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <a class="sidebar-brand" href="{{ url('/admin/dashboard') }}">Deandra<span>.</span></a>
        <ul class="nav-menu">
            <li class="nav-menu-item">
                <a href="{{ url('/admin/dashboard') }}" class="nav-menu-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            </li>
            <li class="nav-menu-item">
                <a href="{{ url('/admin/bookings') }}" class="nav-menu-link"><i class="fa-solid fa-calendar-check"></i> Data Booking</a>
            </li>
            <li class="nav-menu-item">
                <a href="{{ url('/admin/venues') }}" class="nav-menu-link"><i class="fa-solid fa-hotel"></i> Kelola Gedung</a>
            </li>
            <li class="nav-menu-item">
                <a href="{{ url('/admin/notifications') }}" class="nav-menu-link active"><i class="fa-solid fa-bell"></i> Notifikasi</a>
            </li>
            <li class="nav-menu-item" style="margin-top: 15rem;">
                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                    @csrf
                </form>
                <a href="#" class="nav-menu-link" style="color: #ff6b6b;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="top-bar">
            <div>
                <h2 class="fw-extrabold mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Pemberitahuan & Aktivitas</h2>
                <p class="text-muted small mb-0" style="color: var(--text-muted);">Pantau booking masuk dan konfirmasi terupdate secara berkala</p>
            </div>
            <div class="admin-profile">
                <div class="text-end">
                    <span class="d-block fw-bold small">Administrator</span>
                    <small style="color: var(--wedding-gold); font-size: 0.75rem;">Deandra Venue</small>
                </div>
                <div class="admin-avatar">A</div>
            </div>
        </div>

        <div class="mt-4">
            @forelse($notifications as $notif)
                @php
                    $isConfirmed = strtolower($notif->status ?? '') === 'confirmed';
                    $isCancelled = strtolower($notif->status ?? '') === 'cancelled';
                    
                    if ($isConfirmed) {
                        $bgIcon = 'rgba(25, 135, 84, 0.1)';
                        $colorIcon = '#5cdb7d';
                        $iconClass = 'fa-solid fa-circle-check';
                        $title = 'Booking Dikonfirmasi';
                        $desc = "Reservasi #BK-" . str_pad($notif->id, 4, '0', STR_PAD_LEFT) . " atas nama {$notif->nama_mempelai_pria} & {$notif->nama_mempelai_wanita} untuk {$notif->nama_ruangan} telah disetujui.";
                    } elseif ($isCancelled) {
                        $bgIcon = 'rgba(220, 53, 69, 0.1)';
                        $colorIcon = '#ff6b6b';
                        $iconClass = 'fa-solid fa-circle-xmark';
                        $title = 'Booking Dibatalkan';
                        $desc = "Reservasi #BK-" . str_pad($notif->id, 4, '0', STR_PAD_LEFT) . " atas nama {$notif->nama_mempelai_pria} & {$notif->nama_mempelai_wanita} untuk {$notif->nama_ruangan} telah dibatalkan.";
                    } else {
                        $bgIcon = 'rgba(255, 193, 7, 0.1)';
                        $colorIcon = '#ffc107';
                        $iconClass = 'fa-solid fa-hourglass-half';
                        $title = 'Permintaan Booking Baru';
                        $desc = "Klien {$notif->nama_mempelai_pria} & {$notif->nama_mempelai_wanita} mengajukan reservasi baru untuk {$notif->nama_ruangan} pada tanggal " . date('d M Y', strtotime($notif->tanggal_acara)) . ".";
                    }
                @endphp
                <div class="notification-card">
                    <div class="notif-icon" style="background-color: {{ $bgIcon }}; color: {{ $colorIcon }};">
                        <i class="{{ $iconClass }}"></i>
                    </div>
                    <div class="notif-info">
                        <div class="notif-title">{{ $title }}</div>
                        <div class="notif-desc">{{ $desc }}</div>
                        <div class="notif-time"><i class="fa-solid fa-clock me-1"></i> {{ date('d/m/Y H:i', strtotime($notif->created_at)) }}</div>
                    </div>
                </div>
            @empty
                <div class="bg-[#111115] border border-gray-800 p-5 rounded-2xl text-center text-muted">
                    <i class="fa-solid fa-bell-slash d-block fs-3 mb-3 text-secondary"></i> Belum ada aktivitas notifikasi.
                </div>
            @endforelse
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
