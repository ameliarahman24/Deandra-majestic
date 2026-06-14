<?php
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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deandra — Book Your Wedding Venue</title>
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
            --wedding-white: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            /* AMBIENT ROMANTIS BACKGROUND EFFECT */
            background-image: 
                radial-gradient(circle at 80% 20%, rgba(223, 174, 98, 0.06) 0%, transparent 40%),
                radial-gradient(circle at 15% 70%, rgba(255, 182, 193, 0.04) 0%, transparent 45%);
            background-attachment: fixed;
            color: #ffffff;
            overflow-x: hidden;
            scroll-behavior: smooth;
        }

        /* NAVBAR STYLING */
        .navbar {
            background-color: rgba(7, 7, 8, 0.9);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 1.2rem 2rem;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.6rem;
            color: #ffffff !important;
            letter-spacing: -0.5px;
        }
        .navbar-brand span { color: var(--wedding-gold); }
        .nav-link {
            color: var(--text-muted) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link.active { color: #ffffff !important; }
        .btn-cek-tanggal {
            border: 1px solid rgba(255,255,255,0.1);
            color: #ffffff;
            border-radius: 30px;
            padding: 0.4rem 1.2rem;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-cek-tanggal:hover { background: rgba(255,255,255,0.05); }
        .btn-book-nav {
            background-color: var(--wedding-gold);
            color: #070708 !important;
            font-weight: 700;
            border-radius: 30px;
            padding: 0.4rem 1.4rem;
            font-size: 0.85rem;
            text-decoration: none;
        }

        /* MAIN WRAPPER */
        .main-container {
            padding: 3rem 0;
        }
        .section-tag {
            color: var(--wedding-gold);
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 0.5rem;
        }
        .main-heading {
            font-size: 2.8rem;
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 2.5rem;
        }

        /* LEFT SIDE PANELS */
        .panel-box {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            backdrop-filter: blur(8px);
        }
        .panel-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--wedding-gold);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            padding-bottom: 0.75rem;
        }

        /* INTERACTIVE VENUE SELECTION CARDS */
        .venue-selector-card {
            background-color: rgba(255,255,255,0.02);
            border: 1px solid rgba(255,255,255,0.05);
            border-radius: 14px;
            padding: 1.5rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
        }
        .venue-selector-card i {
            font-size: 1.8rem;
            margin-bottom: 0.8rem;
            display: block;
            transition: transform 0.3s ease;
        }
        .venue-selector-card h5 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .venue-selector-card p {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        /* VENUE SELECTION ACTIVE ANIMATION STATES */
        .venue-selector-card.active[data-venue="grand"] {
            border-color: var(--wedding-gold);
            box-shadow: 0 0 20px rgba(223, 174, 98, 0.2);
            background: linear-gradient(180deg, rgba(223, 174, 98, 0.05) 0%, rgba(0,0,0,0) 100%);
            transform: translateY(-4px);
        }
        .venue-selector-card.active[data-venue="grand"] i { color: var(--wedding-gold); transform: scale(1.15); }

        .venue-selector-card.active[data-venue="crystal"] {
            border-color: var(--wedding-pink);
            box-shadow: 0 0 20px rgba(255, 182, 193, 0.2);
            background: linear-gradient(180deg, rgba(255, 182, 193, 0.05) 0%, rgba(0,0,0,0) 100%);
            transform: translateY(-4px);
        }
        .venue-selector-card.active[data-venue="crystal"] i { color: var(--wedding-pink); transform: scale(1.15); }

        .venue-selector-card.active[data-venue="garden"] {
            border-color: #5cdb7d;
            box-shadow: 0 0 20px rgba(92, 219, 125, 0.2);
            background: linear-gradient(180deg, rgba(92, 219, 125, 0.05) 0%, rgba(0,0,0,0) 100%);
            transform: translateY(-4px);
        }
        .venue-selector-card.active[data-venue="garden"] i { color: #5cdb7d; transform: scale(1.15); }

        /* FORM INPUT STYLES */
        .form-label-custom {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }
        .form-control-custom {
            background-color: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.06);
            color: #ffffff;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        .form-control-custom:focus {
            background-color: rgba(255,255,255,0.05);
            border-color: var(--wedding-gold);
            box-shadow: 0 0 0 3px rgba(223, 174, 98, 0.1);
            outline: none;
        }
        .form-control-custom::-webkit-calendar-picker-indicator {
            filter: invert(1) sepia(50%) saturate(1000%) hue-rotate(330deg);
            cursor: pointer;
        }
        select.form-control-custom option {
            background-color: var(--card-dark);
            color: #ffffff;
        }

        /* RIGHT SIDE: SUMMARY PANEL STICKY */
        .summary-sticky {
            position: sticky;
            top: 6rem;
        }
        .summary-card {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            backdrop-filter: blur(8px);
        }
        .summary-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .summary-list {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
        }
        .summary-item .label { color: var(--text-muted); }
        .summary-item .value { 
            font-weight: 600; 
            color: #ffffff;
            transition: all 0.3s ease;
        }
        
        /* Animasi update data ringkasan */
        .value-updated {
            animation: textPop 0.4s ease-out;
            color: var(--wedding-pink) !important;
        }
        @keyframes textPop {
            0% { transform: scale(1); }
            50% { transform: scale(1.08); }
            100% { transform: scale(1); }
        }

        /* ADD-ON LAYANAN CHECKBOXES */
        .addon-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--wedding-gold);
            letter-spacing: 1px;
            margin-bottom: 1.2rem;
            text-transform: uppercase;
        }
        .addon-item {
            background-color: rgba(255,255,255,0.01);
            border: 1px solid rgba(255,255,255,0.03);
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .addon-item:hover {
            background-color: rgba(255,255,255,0.03);
            border-color: rgba(255,182,193,0.1);
        }
        .addon-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .addon-checkbox {
            width: 17px;
            height: 17px;
            border-radius: 4px;
            border: 1px solid rgb(255, 255, 255);
            appearance: none;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.2s ease;
        }
        .addon-checkbox:checked {
            background-color: var(--wedding-gold);
            border-color: var(--wedding-gold);
        }
        .addon-checkbox:checked::after {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 0.65rem;
            color: #070708;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .addon-info span {
            font-size: 0.85rem;
            font-weight: 600;
            display: block;
        }
        .addon-info small {
            font-size: 0.75rem;
            color: var(--text-muted);
        }
        .addon-price {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-muted);
        }
        .addon-item.active-addon {
            border-color: rgba(223, 174, 98, 0.3);
            background-color: rgba(223, 174, 98, 0.03);
        }
        .addon-item.active-addon .addon-price {
            color: var(--wedding-gold);
        }

        /* ESTIMASI TOTAL ROW */
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }
        .total-label {
            font-size: 1rem;
            font-weight: 700;
        }
        .total-amount {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--wedding-gold);
            transition: all 0.3s ease;
        }
        .dp-note {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
            text-align: right;
            display: block;
        }

        /* BUTTONS WITH HOVER EFFECT */
        .btn-confirm {
            background: var(--gold-gradient);
            color: #070708;
            font-weight: 700;
            font-size: 0.95rem;
            width: 100%;
            border: none;
            padding: 0.9rem;
            border-radius: 12px;
            margin-top: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(223, 174, 98, 0.3);
        }
        .btn-confirm i {
            transition: transform 0.4s ease;
        }
        .btn-confirm:hover i {
            transform: rotate(180deg) scale(1.2);
        }

        /* CHAT ADMIN BUTTON STYLING */
        .btn-chat-admin {
            background-color: transparent;
            color: #25D366;
            border: 1px solid rgba(37, 211, 102, 0.3);
            font-weight: 600;
            font-size: 0.9rem;
            width: 100%;
            padding: 0.8rem;
            border-radius: 12px;
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-chat-admin:hover {
            background-color: rgba(37, 211, 102, 0.05);
            border-color: #25D366;
            color: #25D366;
            transform: translateY(-2px);
        }
        /* DROPDOWN CUSTOM */
        .dropdown-menu-dark-custom {
            background-color: var(--card-dark);
            border: 1px solid rgba(223, 174, 98, 0.2);
            border-radius: 12px;
            padding: 0.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
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
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid px-md-4">
            <a class="navbar-brand" href="<?php echo e(url('/home')); ?>">Deandra<span>.</span></a>
            <div class="collapse navbar-collapse justify-content-center">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/home')); ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo e(url('/booking')); ?>">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(url('/jadwal')); ?>">Jadwal</a></li>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo e(url('/jadwal')); ?>" class="text-white-50 text-decoration-none small d-none d-md-inline">Cek Tanggal</a>
                
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(url('/login')); ?>" class="text-white text-decoration-none small">Login</a>
                    <a href="<?php echo e(url('/register')); ?>" class="text-white text-decoration-none small border border-secondary px-3 py-1 rounded-pill d-none d-sm-inline">Sign Up</a>
                <?php else: ?>
                    <!-- Notification Bell (Bootstrap 5) -->
                    <div class="dropdown me-2">
                        <button class="btn btn-link text-white position-relative p-1 text-decoration-none dropdown-toggle no-caret" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow: none;">
                            <i class="fa-solid fa-bell fs-5" style="color: var(--wedding-gold);"></i>
                            <?php if($userNotifications->count() > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 5px; margin-left: -5px;">
                                    <span class="visually-hidden">New alerts</span>
                                </span>
                            <?php endif; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark-custom py-2 text-left" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 300px; overflow-y: auto; z-index: 1050;">
                            <li class="dropdown-header text-white-50 border-bottom border-secondary pb-2 mb-2 font-weight-bold">Notifikasi Reservasi</li>
                            <?php $__empty_1 = true; $__currentLoopData = $userNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $isConfirmed = strtolower($notif->status) === 'confirmed';
                                ?>
                                <li>
                                    <div class="dropdown-item dropdown-item-custom-notif py-2 px-3 text-wrap" style="font-size: 0.82rem; line-height: 1.4;">
                                        <div class="d-flex align-items-center justify-content-between mb-1">
                                            <span class="badge <?php echo e($isConfirmed ? 'bg-success text-white' : 'bg-danger text-white'); ?>" style="font-size: 0.65rem; padding: 3px 6px;">
                                                <?php echo e($isConfirmed ? 'Dikonfirmasi' : 'Dibatalkan'); ?>

                                            </span>
                                            <small class="text-white-50" style="font-size: 0.65rem;"><?php echo e(date('d M Y', strtotime($notif->updated_at))); ?></small>
                                        </div>
                                        <div class="text-white font-weight-bold">#BK-<?php echo e(str_pad($notif->id, 4, '0', STR_PAD_LEFT)); ?></div>
                                        <div class="text-white-50 small font-medium"><?php echo e($notif->nama_ruangan); ?></div>
                                        <div class="text-white-50 small mt-1" style="font-size: 0.75rem;">
                                            <?php echo e($isConfirmed ? 'Reservasi Anda telah disetujui! Silakan hubungi admin.' : 'Reservasi Anda ditolak/dibatalkan. Hubungi admin.'); ?>

                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="text-center py-3 text-white-50 small">Belum ada notifikasi baru</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <span class="text-white-50 small"><i class="fa-solid fa-user me-1"></i> <?php echo e(auth()->user()->name); ?></span>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" id="logout-form-booking" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a href="#" class="text-white text-decoration-none small ms-3" onclick="event.preventDefault(); document.getElementById('logout-form-booking').submit();">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Keluar
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(url('/booking')); ?>" class="btn btn-book-nav">Book Sekarang</a>
            </div>
        </div>
    </nav>

    <div class="container main-container">
        <form action="<?php echo e(route('pengunjung.booking.store')); ?>" method="POST" id="form-booking">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="venue_id" id="input-venue-id">
            <input type="hidden" name="total_estimasi" id="input-total-estimasi" value="0">
            <div class="row">
                
                <div class="col-lg-7">
                    <span class="section-tag"><i class="fa-solid fa-sparkles me-1"></i> Reservasi</span>
                    <h1 class="main-heading">Buat Booking Baru</h1>
    
                    <div class="panel-box">
                        <div class="panel-title">Pilih Ruangan</div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="venue-selector-card" data-id="1" data-venue="grand" data-price="45000000" data-name="Grand Ballroom">
                                    <i class="fa-solid fa-hotel" style="color: var(--wedding-gold);"></i>
                                    <h5>Grand Ballroom</h5>
                                    <p>300-500 tamu</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="venue-selector-card" data-id="2" data-venue="crystal" data-price="28000000" data-name="Crystal Hall">
                                    <i class="fa-gem fa-solid" style="color: var(--wedding-pink);"></i>
                                    <h5>Crystal Hall</h5>
                                    <p>100-200 tamu</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="venue-selector-card" data-id="3" data-venue="garden" data-price="18000000" data-name="Garden Terrace">
                                    <i class="fa-leaf fa-solid" style="color: #5cdb7d;"></i>
                                    <h5>Garden Terrace</h5>
                                    <p>50-150 tamu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="panel-box" id="section-detail">
                    <div class="panel-title">Detail Acara</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Tanggal Acara</label>
                            <input type="date" class="form-control form-control-custom" id="input-tanggal" name="tanggal_acara" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Sesi</label>
                            <select class="form-control form-control-custom form-select" id="input-sesi" name="sesi" required>
                                <option value="" selected disabled>-- Pilih Sesi --</option>
                                <option value="Pagi (08:00 - 13:00)">Pagi (08:00 - 13:00)</option>
                                <option value="Malam (17:00 - 22:00)">Malam (17:00 - 22:00)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Estimasi Tamu</label>
                            <input type="number" class="form-control form-control-custom" id="input-tamu" name="estimasi_tamu" placeholder="cth: 250" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Tema Dekorasi</label>
                            <select class="form-control form-control-custom form-select" id="input-tema" name="tema_dekorasi" required>
                                <option value="" selected disabled>-- Pilih Tema --</option>
                                <option value="Modern Elegant">Modern Elegant</option>
                                <option value="Rustic Nature">Rustic Nature</option>
                                <option value="Traditional Royal">Traditional Royal</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="panel-box">
                    <div class="panel-title">Data Pemesan</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Mempelai Pria</label>
                            <input type="text" class="form-control form-control-custom" id="input-pria" name="nama_mempelai_pria" placeholder="Ahmad Rizky" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Mempelai Wanita</label>
                            <input type="text" class="form-control form-control-custom" id="input-wanita" name="nama_mempelai_wanita" placeholder="Siti Rahayu" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Email</label>
                            <input type="email" class="form-control form-control-custom" id="input-email" name="email" placeholder="nama@email.com" value="<?php echo e(auth()->check() ? auth()->user()->email : ''); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">No. Whatsapp</label>
                            <input type="tel" class="form-control form-control-custom" id="input-wa" name="no_whatsapp" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Catatan Tambahan</label>
                            <textarea class="form-control form-control-custom" id="input-catatan" name="catatan_tambahan" rows="3" placeholder="Ada permintaan khusus? Tulis di sini..."></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-5">
                <div class="summary-sticky">
                    <div class="summary-card">
                        
                        <h3 class="summary-title">Ringkasan Booking</h3>
                        
                        <ul class="summary-list">
                            <li class="summary-item">
                                <span class="label">Ruangan</span>
                                <span class="value" id="review-ruangan">—</span>
                            </li>
                            <li class="summary-item">
                                <span class="label">Harga Ruangan</span>
                                <span class="value" id="review-harga-ruangan">Rp 0</span>
                            </li>
                            <li class="summary-item">
                                <span class="label">Tanggal</span>
                                <span class="value" id="review-tanggal">—</span>
                            </li>
                            <li class="summary-item">
                                <span class="label">Sesi</span>
                                <span class="value" id="review-sesi">—</span>
                            </li>
                            <li class="summary-item">
                                <span class="label">Tamu</span>
                                <span class="value" id="review-tamu">—</span>
                            </li>
                        </ul>

                        <div class="addon-title">Add-On Layanan</div>

                        <div class="addon-item" data-price="8000000">
                            <div class="addon-left">
                                <input type="checkbox" class="addon-checkbox">
                                <div class="addon-info">
                                    <span>Catering Prasmanan</span>
                                    <small>+ Rp 8jt</small>
                                </div>
                            </div>
                            <div class="addon-price">Rp 8jt</div>
                        </div>

                        <div class="addon-item" data-price="5000000">
                            <div class="addon-left">
                                <input type="checkbox" class="addon-checkbox">
                                <div class="addon-info">
                                    <span>Foto & Video</span>
                                    <small>+ Rp 5jt</small>
                                </div>
                            </div>
                            <div class="addon-price">Rp 5jt</div>
                        </div>

                        <div class="addon-item" data-price="3000000">
                            <div class="addon-left">
                                <input type="checkbox" class="addon-checkbox">
                                <div class="addon-info">
                                    <span>MC Profesional</span>
                                    <small>+ Rp 3jt</small>
                                </div>
                            </div>
                            <div class="addon-price">Rp 3jt</div>
                        </div>

                        <div class="addon-item" data-price="6000000">
                            <div class="addon-left">
                                <input type="checkbox" class="addon-checkbox">
                                <div class="addon-info">
                                    <span>Live Band / Musik</span>
                                    <small>+ Rp 6jt</small>
                                </div>
                            </div>
                            <div class="addon-price">Rp 6jt</div>
                        </div>

                        <div class="total-row">
                            <span class="total-label">Total Estimasi</span>
                            <span class="total-amount" id="total-price">Rp 0</span>
                        </div>
                        <small class="dp-note">*DP 30% dibayar saat konfirmasi booking</small>

                        <button class="btn-confirm" id="btn-konfirmasi">
                            Konfirmasi Booking <i class="fa-solid fa-sparkles"></i>
                        </button>

                        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Ruvoo,%20saya%20ingin%20bertanya%20mengenai%20ketersediaan%20gedung%20wedding." 
                           target="_blank" 
                           class="btn-chat-admin" 
                           id="btn-whatsapp-admin">
                            <i class="fa-brands fa-whatsapp"></i> Chat Admin Via WA
                        </a>

                    </div>
                </div>
            </div>

        </div>
        </form>
    </div>

    <script>
        let selectedVenuePrice = 0;

        // Fungsi Memformat Angka Ke Rupiah
        function formatRupiah(number) {
            if(number === 0) return "Rp 0";
            return "Rp " + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        // Fungsi Utama Hitung Total Harga
        function calculateTotal() {
            let total = selectedVenuePrice;

            // Tambahkan harga dari setiap Add-On yang dicentang
            document.querySelectorAll('.addon-item').forEach(item => {
                const checkbox = item.querySelector('.addon-checkbox');
                if(checkbox.checked) {
                    total += parseInt(item.getAttribute('data-price'));
                }
            });

            // Perbarui Elemen Total Beserta Efek Pop Animasi Singkat
            const totalElement = document.getElementById('total-price');
            totalElement.innerText = formatRupiah(total);
            totalElement.classList.add('value-updated');
            setTimeout(() => totalElement.classList.remove('value-updated'), 300);

            // Perbarui input hidden total estimasi untuk form Laravel
            document.getElementById('input-total-estimasi').value = total;
        }

        // 1. Logika Klik Pilihan Ruangan (Card Selector)
        document.querySelectorAll('.venue-selector-card').forEach(card => {
            card.addEventListener('click', function() {
                document.querySelectorAll('.venue-selector-card').forEach(c => c.classList.remove('active'));
                
                this.classList.add('active');
                
                selectedVenuePrice = parseInt(this.getAttribute('data-price'));
                const venueName = this.getAttribute('data-name');
                const venueId = this.getAttribute('data-id');

                // Perbarui input hidden venue_id untuk form Laravel
                document.getElementById('input-venue-id').value = venueId;

                const reviewRuangan = document.getElementById('review-ruangan');
                reviewRuangan.innerText = venueName;
                reviewRuangan.classList.add('value-updated');
                setTimeout(() => reviewRuangan.classList.remove('value-updated'), 400);

                const reviewHargaRuangan = document.getElementById('review-harga-ruangan');
                reviewHargaRuangan.innerText = formatRupiah(selectedVenuePrice);
                reviewHargaRuangan.classList.add('value-updated');
                setTimeout(() => reviewHargaRuangan.classList.remove('value-updated'), 400);

                calculateTotal();
                updateWhatsAppTemplate();
            });
        });

        // 2. Logika Interaktif Untuk Checkbox Add-On Layanan
        document.querySelectorAll('.addon-item').forEach(item => {
            const checkbox = item.querySelector('.addon-checkbox');
            
            item.addEventListener('click', function(e) {
                if (e.target !== checkbox) {
                    checkbox.checked = !checkbox.checked;
                }
                
                if(checkbox.checked) {
                    item.classList.add('active-addon');
                } else {
                    item.classList.remove('active-addon');
                }
                calculateTotal();
                updateWhatsAppTemplate();
            });
        });

        // 3. Sinkronisasi Live Input Form ke Ringkasan Kanan
        document.getElementById('input-tanggal').addEventListener('input', function() {
            const el = document.getElementById('review-tanggal');
            if(this.value) {
                const d = new Date(this.value);
                el.innerText = d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
            } else {
                el.innerText = "—";
            }
            el.classList.add('value-updated');
            setTimeout(() => el.classList.remove('value-updated'), 400);
            updateWhatsAppTemplate();
        });

        document.getElementById('input-sesi').addEventListener('change', function() {
            const el = document.getElementById('review-sesi');
            el.innerText = this.value ? this.value.split(' ')[0] : "—";
            el.classList.add('value-updated');
            setTimeout(() => el.classList.remove('value-updated'), 400);
            updateWhatsAppTemplate();
        });

        document.getElementById('input-tamu').addEventListener('input', function() {
            const el = document.getElementById('review-tamu');
            el.innerText = this.value ? this.value + " Pax" : "—";
            el.classList.add('value-updated');
            setTimeout(() => el.classList.remove('value-updated'), 400);
            updateWhatsAppTemplate();
        });

        // Event listener tambahan data pemesan untuk update template WA otomatis
        ['input-pria', 'input-wanita', 'input-tema'].forEach(id => {
            document.getElementById(id).addEventListener('input', updateWhatsAppTemplate);
        });

        // 4. Logika Tombol Konfirmasi Booking (Premium Modal)
        document.getElementById('btn-konfirmasi').addEventListener('click', function(e) {
            e.preventDefault();
            const ruangan = document.getElementById('review-ruangan').innerText;
            const tanggal = document.getElementById('review-tanggal').innerText;
            const sesi = document.getElementById('review-sesi').innerText;
            const totalHarga = document.getElementById('total-price').innerText;

            if (ruangan === "—" || tanggal === "—" || sesi === "—") {
                alert("Mohon lengkapi Ruangan, Tanggal, dan Sesi terlebih dahulu!");
                return;
            }

            const pria = document.getElementById('input-pria').value.trim();
            const wanita = document.getElementById('input-wanita').value.trim();
            const email = document.getElementById('input-email').value.trim();
            const wa = document.getElementById('input-wa').value.trim();
            const tamu = document.getElementById('input-tamu').value.trim();
            const tema = document.getElementById('input-tema').value;

            if (!pria || !wanita || !email || !wa || !tamu || !tema) {
                alert("Mohon lengkapi data pemesan dan detail acara terlebih dahulu!");
                return;
            }

            // Populate data to Custom Modal
            document.getElementById('modal-confirm-pengantin').innerText = `${pria} & ${wanita}`;
            document.getElementById('modal-confirm-ruangan').innerText = ruangan;
            document.getElementById('modal-confirm-tanggal').innerText = tanggal;
            document.getElementById('modal-confirm-sesi').innerText = sesi;
            document.getElementById('modal-confirm-tamu').innerText = tamu + " Pax";
            document.getElementById('modal-confirm-total').innerText = totalHarga;

            // Show Custom Modal
            if (typeof bootstrap !== 'undefined') {
                var confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                confirmModal.show();
            } else {
                if (confirm(`Konfirmasi Pemesanan:\n\n• Pengantin: ${pria} & ${wanita}\n• Venue: ${ruangan}\n• Tanggal: ${tanggal}\n• Sesi: ${sesi}\n• Tamu: ${tamu} Pax\n• Total: ${totalHarga}\n\nApakah data pemesanan di atas sudah benar?`)) {
                    document.getElementById('form-booking').submit();
                }
            }
        });

        // Pastikan DOM sudah termuat sepenuhnya sebelum mencari tombol modal submit
        document.addEventListener('DOMContentLoaded', function() {
            const submitBtn = document.getElementById('btn-modal-submit');
            if (submitBtn) {
                submitBtn.addEventListener('click', function() {
                    document.getElementById('form-booking').submit();
                });
            }
        });

        // 5. Otomatisasi Teks Chat WhatsApp Sesuai Isi Formulir
        function updateWhatsAppTemplate() {
            const namaPria = document.getElementById('input-pria').value || '...';
            const namaWanita = document.getElementById('input-wanita').value || '...';
            const ruangan = document.getElementById('review-ruangan').innerText;
            const tanggal = document.getElementById('review-tanggal').innerText;
            const sesi = document.getElementById('review-sesi').innerText;
            const totalHarga = document.getElementById('total-price').innerText;

            // Ganti nomor dibawah dengan nomor WhatsApp Admin aslimu (Gunakan kode negara: 62)
            const nomorWA = "6285168796253"; 
            
            const teksPesan = `Halo Admin Ruvoo, saya ingin berkonsultasi mengenai booking venue:\n\n` +
                              `• Pengantin: ${namaPria} & ${namaWanita}\n` +
                              `• Ruangan Venue: ${ruangan}\n` +
                              `• Tanggal Acara: ${tanggal}\n` +
                              `• Pilihan Sesi: ${sesi}\n` +
                              `• Total Estimasi: ${totalHarga}\n\n` +
                              `Apakah pada tanggal tersebut slot masih tersedia? Terima kasih.`;

            const linkWA = `https://wa.me/${nomorWA}?text=${encodeURIComponent(teksPesan)}`;
            document.getElementById('btn-whatsapp-admin').setAttribute('href', linkWA);
        }
    </script>

    <!-- Modal Konfirmasi Booking Kustom (Premium Dark Theme) -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: var(--card-dark); border: 1px solid rgba(223, 174, 98, 0.3); border-radius: 20px;">
                <div class="modal-body text-center p-5">
                    <div class="mb-4" style="color: var(--wedding-gold); font-size: 4rem;">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </div>
                    <h3 class="modal-title mb-4" style="font-weight: 800; color: #ffffff; letter-spacing: -0.5px;">Konfirmasi Pemesanan</h3>
                    
                    <div class="text-start p-4 rounded-3 mb-4" style="background-color: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.05); font-size: 0.9rem;">
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary-subtle">
                            <span class="text-white-50">Nama Pengantin:</span>
                            <span class="fw-bold text-white" id="modal-confirm-pengantin">—</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary-subtle">
                            <span class="text-white-50">Venue:</span>
                            <span class="fw-bold text-white" id="modal-confirm-ruangan">—</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary-subtle">
                            <span class="text-white-50">Tanggal Acara:</span>
                            <span class="fw-bold text-white" id="modal-confirm-tanggal">—</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary-subtle">
                            <span class="text-white-50">Sesi:</span>
                            <span class="fw-bold text-white" id="modal-confirm-sesi">—</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2 pb-2 border-bottom border-secondary-subtle">
                            <span class="text-white-50">Estimasi Tamu:</span>
                            <span class="fw-bold text-white" id="modal-confirm-tamu">—</span>
                        </div>
                        <div class="d-flex justify-content-between pt-1">
                            <span class="text-white-50 font-semibold">Total Estimasi:</span>
                            <span class="fw-extrabold" style="color: var(--wedding-gold); font-size: 1.1rem;" id="modal-confirm-total">—</span>
                        </div>
                    </div>
                    
                    <p class="text-white-50 mb-4" style="font-size: 0.85rem;">Apakah data pemesanan di atas sudah benar? Klik tombol di bawah untuk mengirim ke database.</p>
                    
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-secondary w-50" data-bs-dismiss="modal" style="border-radius: 30px; font-weight: 600; background-color: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: #fff;">Batal</button>
                        <button type="button" class="btn btn-hero-main w-50" id="btn-modal-submit" style="border-radius: 30px; font-weight: 700;">Ya, Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/pengunjung/pelanggan_booking.blade.php ENDPATH**/ ?>