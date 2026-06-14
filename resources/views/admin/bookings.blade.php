<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruvoo Admin — Management Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            --status-pending: #ffc107;
            --status-success: #198754;
            --status-danger: #dc3545;
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

        /* STATS CARD RECAP */
        .stat-card {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
        .stat-info h6 {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }
        .stat-info h3 {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 0;
        }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        /* TABLE PANELS MANAGEMENT */
        .table-panel {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2rem;
            margin-top: 2.5rem;
        }
        .panel-header-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .custom-table {
            width: 100%;
            margin-bottom: 0;
            color: #ffffff;
            vertical-align: middle;
        }
        .custom-table thead th {
            background-color: rgba(255, 255, 255, 0.02) !important;
            color: var(--text-muted);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        .custom-table tbody td {
            padding: 1.2rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.02);
            font-size: 0.88rem;
            background-color: transparent !important;
            color: #ffffff !important;
        }
        
        /* BADGE STATUS STYLES */
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .badge-pending { background-color: rgba(255, 193, 7, 0.1); color: var(--status-pending); }
        .badge-approved { background-color: rgba(25, 135, 84, 0.1); color: var(--status-success); }
        .badge-rejected { background-color: rgba(220, 53, 69, 0.1); color: var(--status-danger); }

        /* ACTION BUTTONS */
        .btn-action {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            margin-right: 0.25rem;
        }
        .btn-approve { background-color: rgba(25, 135, 84, 0.15); color: #5cdb7d; }
        .btn-approve:hover { background-color: var(--status-success); color: #ffffff; transform: scale(1.05); }
        
        .btn-reject { background-color: rgba(220, 53, 69, 0.15); color: #ff6b6b; }
        .btn-reject:hover { background-color: var(--status-danger); color: #ffffff; transform: scale(1.05); }

        /* ANIMASI BARIS DIUBAH ADMIN */
        .row-update-anim {
            animation: flashRow 0.6s ease-out;
        }
        @keyframes flashRow {
            0% { background-color: rgba(223, 174, 98, 0.05); }
            100% { background-color: transparent; }
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
                <a href="{{ url('/admin/bookings') }}" class="nav-menu-link active"><i class="fa-solid fa-calendar-check"></i> Data Booking</a>
            </li>
            <li class="nav-menu-item">
                <a href="{{ url('/admin/venues') }}" class="nav-menu-link"><i class="fa-solid fa-hotel"></i> Kelola Gedung</a>
            </li>
            <li class="nav-menu-item">
                <a href="{{ url('/admin/notifications') }}" class="nav-menu-link"><i class="fa-solid fa-bell"></i> Notifikasi</a>
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
                <h2 class="fw-extrabold mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Panel Manajemen Booking</h2>
                <p class="text-muted small mb-0" style="color: var(--text-muted);">Konfirmasi & kelola jadwal pernikahan klien</p>
            </div>
            <div class="admin-profile">
                <div class="text-end">
                    <span class="d-block fw-bold small">Administrator</span>
                    <small style="color: var(--wedding-gold); font-size: 0.75rem;">Deandra Venue</small>
                </div>
                <div class="admin-avatar">A</div>
            </div>
        </div>

        @php
            $totalBookings = $bookings->count();
            $pendingBookings = $bookings->filter(fn($b) => in_array(strtolower($b->status ?? 'pending'), ['pending', '']))->count();
            $confirmedBookings = $bookings->filter(fn($b) => strtolower($b->status ?? '') === 'confirmed');
            $omzetDeal = $confirmedBookings->sum('total_estimasi') * 0.3;
        @endphp
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <h6>Total Masuk</h6>
                        <h3 id="stat-total">{{ $totalBookings }} Reservasi</h3>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(223,174,98,0.1); color: var(--wedding-gold);">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <h6>Perlu Konfirmasi</h6>
                        <h3 id="stat-pending" style="color: var(--status-pending);">{{ $pendingBookings }} Pending</h3>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(255,193,7,0.1); color: var(--status-pending);">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-info">
                        <h6>Omzet Deal (DP 30%)</h6>
                        <h3>Rp {{ number_format($omzetDeal, 0, ',', '.') }}</h3>
                    </div>
                    <div class="stat-icon" style="background-color: rgba(25,135,84,0.1); color: #5cdb7d;">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-panel">
            <div class="panel-header-title"><i class="fa-solid fa-list-check me-2" style="color: var(--wedding-gold);"></i> Antrean Permintaan Booking</div>
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Pelanggan / Mempelai</th>
                            <th>Venue Pilihan</th>
                            <th>Tanggal & Sesi</th>
                            <th>Estimasi Harga</th>
                            <th>Status</th>
                            <th class="text-center">Aksi Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr id="booking-row-{{ $booking->id }}">
                            <td>
                                <strong class="d-block">{{ $booking->nama_mempelai_pria }} & {{ $booking->nama_mempelai_wanita }}</strong>
                                <div class="d-flex flex-column gap-1 mt-1">
                                    <small class="text-muted"><i class="fa-solid fa-phone me-1" style="color: #25d366;"></i> {{ $booking->no_whatsapp }}</small>
                                    <small class="text-muted"><i class="fa-solid fa-envelope me-1" style="color: var(--wedding-gold);"></i> {{ $booking->email }}</small>
                                </div>
                            </td>
                            <td>
                                @php
                                    $venueColor = 'var(--wedding-gold)';
                                    if (Str::contains(strtolower($booking->nama_ruangan ?? ''), 'crystal')) {
                                        $venueColor = 'var(--wedding-pink)';
                                    } elseif (Str::contains(strtolower($booking->nama_ruangan ?? ''), 'garden')) {
                                        $venueColor = '#5cdb7d';
                                    }
                                @endphp
                                <span style="color: {{ $venueColor }}; font-weight: 600;">{{ $booking->nama_ruangan ?? 'Venue Lainnya' }}</span>
                            </td>
                            <td>
                                <span>{{ date('d M Y', strtotime($booking->tanggal_acara)) }}</span>
                                <small class="d-block text-muted">Sesi {{ ucfirst($booking->sesi) }}</small>
                            </td>
                            <td><strong>Rp {{ number_format($booking->total_estimasi, 0, ',', '.') }}</strong></td>
                            <td>
                                @if(strtolower($booking->status ?? '') == 'confirmed')
                                    <span class="status-badge badge-approved">Approved</span>
                                @elseif(strtolower($booking->status ?? '') == 'cancelled')
                                    <span class="status-badge badge-rejected">Rejected</span>
                                @else
                                    <span class="status-badge badge-pending">Pending</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(strtolower($booking->status ?? 'pending') == 'pending' || empty($booking->status))
                                    <div class="d-flex justify-content-center gap-1">
                                        <form action="{{ route('admin.bookings.confirm', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-approve" title="Setujui Booking">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-action btn-reject" title="Tolak Booking">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-muted small">Selesai di-review</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada data reservasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        function updateStatus(rowId, action) {
            const row = document.getElementById(`booking-row-${rowId}`);
            const badge = row.querySelector('.status-badge');
            const actionTd = row.querySelector('td:last-child');
            
            // Tambahkan animasi flash highlight pada baris yang dimodifikasi
            row.classList.add('row-update-anim');
            setTimeout(() => row.classList.remove('row-update-anim'), 600);

            if (action === 'approve') {
                // Ubah status ke Approved
                badge.className = "status-badge badge-approved";
                badge.innerText = "Approved";
                
                // Ubah kolom aksi jadi keterangan selesai
                actionTd.innerHTML = '<span class="text-muted small">Selesai di-review</span>';
                
                // Perbarui counter box di atas secara live
                document.getElementById('stat-pending').innerText = "0 Pending";
                document.getElementById('stat-pending').style.color = "var(--text-muted)";
            } else if (action === 'reject') {
                // Ubah status ke Rejected
                badge.className = "status-badge badge-rejected";
                badge.innerText = "Rejected";
                
                // Ubah kolom aksi jadi keterangan selesai
                actionTd.innerHTML = '<span class="text-muted small">Selesai di-review</span>';
                
                // Perbarui counter box di atas secara live
                document.getElementById('stat-pending').innerText = "0 Pending";
                document.getElementById('stat-pending').style.color = "var(--text-muted)";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>