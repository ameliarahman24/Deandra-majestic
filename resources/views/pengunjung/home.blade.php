@php
    $userNotifications = collect();
    if (auth()->check()) {
        $userNotifications = \Illuminate\Support\Facades\DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->where('bookings.email', auth()->user()->email)
            ->whereIn('bookings.status', ['confirmed', 'cancelled'])
            ->orderBy('bookings.updated_at', 'desc')
            ->get();
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deandra — Premium Wedding Venue</title>
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
            --wedding-white: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            overflow-x: hidden;
            position: relative;
        }

        /* --- BACKGROUND DEKORASI: LOVE & BUNGA ELEGAN --- */
        .bg-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
            background-color: var(--bg-dark);
        }
        
        .particle {
            position: absolute;
            bottom: -30px;
            animation: floatUp 15s infinite linear;
            opacity: 0;
            filter: drop-shadow(0 0 4px rgba(255, 182, 193, 0.3));
            user-select: none;
        }
        
        .particle:nth-child(1) { font-size: 14px; left: 8%; animation-delay: 0s; color: var(--wedding-gold); animation-duration: 14s; }
        .particle:nth-child(2) { font-size: 18px; left: 22%; animation-delay: 3s; color: var(--wedding-pink); animation-duration: 18s; }
        .particle:nth-child(3) { font-size: 12px; left: 40%; animation-delay: 1s; color: rgba(255,255,255,0.3); animation-duration: 16s; }
        .particle:nth-child(4) { font-size: 16px; left: 65%; animation-delay: 6s; color: var(--wedding-pink); animation-duration: 15s; }
        .particle:nth-child(5) { font-size: 15px; left: 82%; animation-delay: 2s; color: var(--wedding-gold); animation-duration: 17s; }
        .particle:nth-child(6) { font-size: 13px; left: 52%; animation-delay: 8s; color: var(--wedding-pink); animation-duration: 19s; }
        .particle:nth-child(7) { font-size: 16px; left: 92%; animation-delay: 4s; color: rgba(255,255,255,0.2); animation-duration: 13s; }
        
        @keyframes floatUp {
            0% { transform: translateY(0) rotate(0deg) scale(0.6); opacity: 0; }
            15% { opacity: 0.35; }
            85% { opacity: 0.35; }
            100% { transform: translateY(-115vh) rotate(360deg) scale(1.1); opacity: 0; }
        }

        /* NAVBAR STYLING */
        .navbar {
            background-color: rgba(7, 7, 8, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 1.2rem 2rem;
            position: relative;
            z-index: 10;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: #ffffff !important;
            letter-spacing: -0.5px;
        }
        .navbar-brand span {
            color: var(--wedding-gold);
        }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            font-size: 0.95rem;
            transition: color 0.3s ease;
            padding: 0.5rem 1.2rem !important;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--wedding-pink) !important;
        }
        .btn-book-nav {
            background-color: var(--wedding-gold);
            color: #070708 !important;
            font-weight: 700;
            border-radius: 30px;
            padding: 0.6rem 1.4rem;
            border: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .btn-book-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(223, 174, 98, 0.3);
        }

        /* DROPDOWN CUSTOM */
        .dropdown-menu-dark-custom {
            background-color: var(--card-dark);
            border: 1px solid rgba(223, 174, 98, 0.2);
            border-radius: 12px;
            padding: 0.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        .dropdown-item-custom {
            color: #e1e1e6 !important;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }
        .dropdown-item-custom:hover {
            background: var(--gold-gradient);
            color: #070708 !important;
        }
        .dropdown-item-custom-notif {
            color: #e1e1e6 !important;
            border-radius: 8px;
            transition: all 0.2s ease;
            background: transparent;
        }
        .dropdown-item-custom-notif:hover {
            background: rgba(255, 255, 255, 0.03) !important;
        }
        .no-caret::after {
            display: none !important;
        }

        /* HERO SECTION */
        .hero-section {
            padding: 6rem 0 4rem 0;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .hero-badge {
            background: rgba(255, 182, 193, 0.08);
            border: 1px solid rgba(255, 182, 193, 0.2);
            color: var(--wedding-pink);
            padding: 0.4rem 1.2rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            display: inline-block;
            margin-bottom: 1.5rem;
        }
        
        .hero-title {
            font-size: 5.5rem;
            font-weight: 800;
            letter-spacing: -2px;
            line-height: 1.05;
            margin-bottom: 2rem;
            background: linear-gradient(45deg, var(--wedding-pink) 10%, var(--wedding-gold) 50%, var(--wedding-white) 90%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        
        .hero-subtitle {
            color: #d1d1d6;
            max-width: 620px;
            margin: 0 auto 3rem auto;
            font-size: 1.15rem;
            line-height: 1.6;
        }
        .btn-hero-main {
            background-color: var(--wedding-gold);
            color: #070708;
            font-weight: 700;
            padding: 0.9rem 2.2rem;
            border-radius: 30px;
            border: none;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            margin-right: 1rem;
            display: inline-block;
        }
        .btn-hero-main:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(223, 174, 98, 0.35);
            color: #070708;
        }
        .btn-hero-sub {
            background: transparent;
            color: #ffffff;
            border: 1px solid rgba(255, 182, 193, 0.3);
            font-weight: 600;
            padding: 0.9rem 2.2rem;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .btn-hero-sub:hover {
            background: rgba(255, 182, 193, 0.05);
            border-color: var(--wedding-pink);
        }

        /* COUNTER STATISTICS */
        .stats-section {
            padding: 4rem 0;
            position: relative;
            z-index: 2;
        }
        .stat-number {
            font-size: 3.2rem;
            font-weight: 800;
            color: var(--wedding-gold);
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .stat-label {
            color: var(--wedding-pink);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* CARA KERJA SECTION */
        .section-padding {
            padding: 6rem 0;
            position: relative;
            z-index: 2;
        }
        .section-tag {
            color: var(--wedding-pink);
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 1rem;
            display: block;
        }
        .section-heading {
            font-size: 3.2rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 3.5rem;
            background: linear-gradient(to right, #ffffff, var(--wedding-gold));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .step-card {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 3rem 2rem;
            height: 100%;
            transition: all 0.3s ease;
        }
        .step-card:hover {
            border-color: rgba(255, 182, 193, 0.3);
            transform: translateY(-5px);
        }
        .step-number-circle {
            width: 45px;
            height: 45px;
            background-color: rgba(255, 182, 193, 0.05);
            border: 1px solid rgba(255, 182, 193, 0.2);
            color: var(--wedding-pink);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 2rem;
        }
        .step-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--wedding-gold);
        }
        .step-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        /* VENUE CARDS */
        .venue-card {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            overflow: hidden;
            height: 100%;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            flex-direction: column;
        }
        .venue-icon-wrapper {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .bg-grand { background: radial-gradient(circle at center, rgba(223,174,98,0.08) 0%, rgba(0,0,0,0) 70%); }
        .bg-crystal { background: radial-gradient(circle at center, rgba(255,182,193,0.08) 0%, rgba(0,0,0,0) 70%); }
        .bg-garden { background: radial-gradient(circle at center, rgba(40,167,69,0.08) 0%, rgba(0,0,0,0) 70%); }

        .venue-card i.main-icon {
            font-size: 4rem;
            transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .icon-grand { color: var(--wedding-gold); }
        .icon-crystal { color: var(--wedding-pink); }
        .icon-garden { color: #5cdb7d; }

        .venue-card:hover {
            transform: translateY(-8px);
            border-color: rgba(255, 182, 193, 0.3);
            box-shadow: 0 15px 35px rgba(0,0,0,0.6);
        }

        .venue-card:hover i.icon-grand { transform: rotateY(180deg) scale(1.1); }
        .venue-card:hover i.icon-crystal { animation: crystalGlow 1s ease-in-out infinite alternate; }
        .venue-card:hover i.icon-garden { animation: leafSway 0.6s ease-in-out infinite alternate; }

        @keyframes crystalGlow {
            0% { transform: scale(1); filter: drop-shadow(0 0 2px var(--wedding-pink)); }
            100% { transform: scale(1.18); filter: drop-shadow(0 0 15px var(--wedding-pink)); }
        }
        @keyframes leafSway {
            0% { transform: rotate(-8deg) scale(1.05); }
            100% { transform: rotate(8deg) scale(1.05); }
        }

        .venue-body {
            padding: 2rem;
            padding-top: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .venue-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #ffffff;
        }
        .venue-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        .venue-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .venue-price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border-color);
            padding-top: 1.5rem;
        }
        .price-label {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--wedding-gold);
        }
        .price-label span {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 400;
            display: block;
        }
        .btn-select-venue {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .venue-card:hover .btn-select-venue {
            background-color: var(--wedding-gold);
            color: #070708;
            border-color: var(--wedding-gold);
        }

        /* FOOTER */
        footer {
            border-top: 1px solid var(--border-color);
            padding: 2rem 0;
            color: #5c5c64;
            font-size: 0.85rem;
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body>

    <div class="bg-particles">
        <div class="particle">🌸</div>
        <div class="particle">♥</div>
        <div class="particle">🌸</div>
        <div class="particle">♥</div>
        <div class="particle">🌸</div>
        <div class="particle">♥</div>
        <div class="particle">🌸</div>
    </div>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-md-4">
            <a class="navbar-brand" href="{{ url('/home') }}">Deandra<span>.</span></a>
            
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="{{ url('/home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/booking') }}">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/jadwal') }}">Jadwal</a></li>
                    </ul>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <a href="{{ url('/jadwal') }}" class="text-white-50 text-decoration-none small d-none d-md-inline">Cek Tanggal</a>
                
                @guest
                    <a href="{{ url('/login') }}" class="text-white text-decoration-none small">Login</a>
                    <a href="{{ url('/register') }}" class="text-white text-decoration-none small border border-secondary px-3 py-1 rounded-pill d-none d-sm-inline">Sign Up</a>
                @else
                    <!-- Notification Bell (Bootstrap 5) -->
                    <div class="dropdown me-2">
                        <button class="btn btn-link text-white position-relative p-1 text-decoration-none dropdown-toggle no-caret" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
                            <i class="fa-solid fa-bell fs-5" style="color: var(--wedding-gold);"></i>
                            @if($userNotifications->count() > 0)
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 5px; margin-left: -5px;">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom py-2 text-left" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 300px; overflow-y: auto; z-index: 1050;">
                            <li class="dropdown-header text-white-50 border-bottom border-secondary pb-2 mb-2 font-weight-bold">Notifikasi Reservasi</li>
                            @forelse($userNotifications as $notif)
                                @php
                                    $isConfirmed = strtolower($notif->status) === 'confirmed';
                                @endphp
                                <li>
                                    <div class="dropdown-item dropdown-item-custom-notif py-2 px-3 text-wrap" style="font-size: 0.82rem; line-height: 1.4;">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="badge {{ $isConfirmed ? 'bg-success text-white' : 'bg-danger text-white' }}" style="font-size: 0.65rem; padding: 3px 6px;">
                                                {{ $isConfirmed ? 'Dikonfirmasi' : 'Dibatalkan' }}
                                            </span>
                                            <small class="text-white-50" style="font-size: 0.65rem;">{{ date('d M Y', strtotime($notif->updated_at)) }}</small>
                                        </div>
                                        <div class="text-white font-weight-bold">#BK-{{ str_pad($notif->id, 4, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-white-50 small font-medium">{{ $notif->nama_ruangan }}</div>
                                        <div class="text-white-50 small mt-1" style="font-size: 0.75rem;">
                                            {{ $isConfirmed ? 'Reservasi Anda telah disetujui! Silakan hubungi admin.' : 'Reservasi Anda ditolak/dibatalkan. Hubungi admin.' }}
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center py-3 text-white-50 small">Belum ada notifikasi baru</li>
                            @endforelse
                        </ul>
                    </div>

                    <span class="text-white-50 small"><i class="fa-solid fa-user me-1"></i> {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form-home" class="d-none">
                        @csrf
                    </form>
                    <a href="#" class="text-white text-decoration-none small ms-3" onclick="event.preventDefault(); document.getElementById('logout-form-home').submit();">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                    </a>
                @endguest
                <a href="{{ url('/booking') }}" class="btn btn-book-nav">Book Sekarang</a>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container d-flex flex-column align-items-center">
            <div class="hero-badge">
                <i class="fa-solid fa-sparkles me-2"></i>Venue Pernikahan Premium Jakarta
            </div>
            
            <h1 class="hero-title">Your Dream<br>Wedding Venue.</h1>
            <p class="hero-subtitle">Reservasi ballroom pernikahan impianmu dalam hitungan minutes. Transparan, mudah, dan tanpa ribet.</p>
            <div class="d-flex justify-content-center">
                <a href="{{ url('/booking') }}" class="btn btn-hero-main">Book Sekarang &rarr;</a>
                <a href="{{ url('/jadwal') }}" class="btn btn-hero-sub">Lihat Jadwal</a>
            </div>
        </div>
    </section>

    <section class="stats-section bg-black">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Pasangan Bahagia</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Ballroom Premium</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Kepuasan Klien</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-number">5&starf;</div>
                    <div class="stat-label">Rating Google</div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <span class="section-tag">Cara Kerja</span>
            <h2 class="section-heading">Booking dalam<br>4 Langkah Mudah</h2>
            
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number-circle">1</div>
                        <h4 class="step-title">Pilih Ruangan</h4>
                        <p class="step-desc">Browse koleksi ballroom kami dan temukan yang paling sesuai dengan visimu.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number-circle">2</div>
                        <h4 class="step-title">Cek Tanggal</h4>
                        <p class="step-desc">Lihat kalender ketersediaan real-time dan pilih tanggal pernikahanmu.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number-circle">3</div>
                        <h4 class="step-title">Isi Form</h4>
                        <p class="step-desc">Lengkapi detail pemesanan, pilih paket dan add-on sesuai kebutuhan.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number-circle">4</div>
                        <h4 class="step-title">Konfirmasi</h4>
                        <p class="step-desc">Terima kode booking dan konfirmasi dari tim kami dalam 1x24 jam.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding" style="background-color: #0b0b0e;">
        <div class="container">
            <span class="section-tag">Pilihan Ruangan</span>
            <h2 class="section-heading">Ballroom untuk<br>Setiap Momen</h2>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="venue-card">
                        <div class="venue-icon-wrapper bg-grand">
                            <i class="fa-solid fa-hotel main-icon icon-grand"></i>
                        </div>
                        <div class="venue-body">
                            <div>
                                <h3 class="venue-title">Grand Ballroom</h3>
                                <p class="venue-desc">Ruangan mewah klasik dengan kapasitas besar, cocok untuk resepsi megah dan berkesan.</p>
                                <div class="venue-meta">
                                    <span><i class="fa-solid fa-users me-1"></i> 300-500 tamu</span>
                                    <span><i class="fa-solid fa-maximize me-1"></i> 1.200 m²</span>
                                </div>
                            </div>
                            <div class="venue-price-row">
                                <div class="price-label">Rp 45jt <span>per hari</span></div>
                                <a href="{{ url('/booking?venue=grand') }}" class="btn-select-venue">Pilih &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="venue-card">
                        <div class="venue-icon-wrapper bg-crystal">
                            <i class="fa-solid fa-gem main-icon icon-crystal"></i>
                        </div>
                        <div class="venue-body">
                            <div>
                                <h3 class="venue-title">Crystal Hall</h3>
                                <p class="venue-desc">Sentuhan modern dengan pencahayaan kristal dramatis, ideal untuk intimate wedding yang elegan.</p>
                                <div class="venue-meta">
                                    <span><i class="fa-solid fa-users me-1"></i> 100-200 tamu</span>
                                    <span><i class="fa-solid fa-maximize me-1"></i> 600 m²</span>
                                </div>
                            </div>
                            <div class="venue-price-row">
                                <div class="price-label">Rp 28jt <span>per hari</span></div>
                                <a href="{{ url('/booking?venue=crystal') }}" class="btn-select-venue">Pilih &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="venue-card">
                        <div class="venue-icon-wrapper bg-garden">
                            <i class="fa-solid fa-leaf main-icon icon-garden"></i>
                        </div>
                        <div class="venue-body">
                            <div>
                                <h3 class="venue-title">Garden Terrace</h3>
                                <p class="venue-desc">Venue semi-outdoor dengan taman tropis, sempurna untuk pernikahan bernuansa alam.</p>
                                <div class="venue-meta">
                                    <span><i class="fa-solid fa-users me-1"></i> 50-150 tamu</span>
                                    <span><i class="fa-solid fa-maximize me-1"></i> 400 m²</span>
                                </div>
                            </div>
                            <div class="venue-price-row">
                                <div class="price-label">Rp 18jt <span>per hari</span></div>
                                <a href="{{ url('/booking?venue=garden') }}" class="btn-select-venue">Pilih &rarr;</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <footer>
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Deandra Majestic Venue. All rights reserved.</p>
        </div>
    </footer>

    <!-- Modal Success Booking -->
    @if(session('success'))
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--card-dark); border: 1px solid rgba(223, 174, 98, 0.3); border-radius: 20px;">
                <div class="modal-body text-center p-5">
                    <div class="mb-4" style="color: var(--wedding-gold); font-size: 4rem;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <h3 class="modal-title mb-3" style="font-weight: 800; color: #ffffff;">Booking Berhasil!</h3>
                    <p class="text-gray-400 mb-4" style="font-size: 0.95rem;">{{ session('success') }}</p>
                    <button type="button" class="btn btn-hero-main w-100" data-bs-dismiss="modal" style="border-radius: 30px;">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('successModal'), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
    @endif
</body>
</html>