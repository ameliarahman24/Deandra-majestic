<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruvoo Admin — Kelola Gedung</title>
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
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-block;
        }
        .badge-available { background-color: rgba(25, 135, 84, 0.1); color: #5cdb7d; }
        .badge-unavailable { background-color: rgba(220, 53, 69, 0.1); color: #ff6b6b; }
    </style>
</head>
<body>

    <div class="sidebar">
        <a class="sidebar-brand" href="<?php echo e(url('/admin/dashboard')); ?>">Deandra<span>.</span></a>
        <ul class="nav-menu">
            <li class="nav-menu-item">
                <a href="<?php echo e(url('/admin/dashboard')); ?>" class="nav-menu-link"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            </li>
            <li class="nav-menu-item">
                <a href="<?php echo e(url('/admin/bookings')); ?>" class="nav-menu-link"><i class="fa-solid fa-calendar-check"></i> Data Booking</a>
            </li>
            <li class="nav-menu-item">
                <a href="<?php echo e(url('/admin/venues')); ?>" class="nav-menu-link active"><i class="fa-solid fa-hotel"></i> Kelola Gedung</a>
            </li>
            <li class="nav-menu-item">
                <a href="<?php echo e(url('/admin/notifications')); ?>" class="nav-menu-link"><i class="fa-solid fa-bell"></i> Notifikasi</a>
            </li>
            <li class="nav-menu-item" style="margin-top: 15rem;">
                <form action="<?php echo e(route('logout')); ?>" method="POST" id="logout-form" class="d-none">
                    <?php echo csrf_field(); ?>
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
                <h2 class="fw-extrabold mb-1" style="font-weight: 800; letter-spacing: -0.5px;">Panel Kelola Gedung</h2>
                <p class="text-muted small mb-0" style="color: var(--text-muted);">Manajemen data ballroom, harga, dan ketersediaan</p>
            </div>
            <div class="admin-profile">
                <div class="text-end">
                    <span class="d-block fw-bold small">Administrator</span>
                    <small style="color: var(--wedding-gold); font-size: 0.75rem;">Deandra Venue</small>
                </div>
                <div class="admin-avatar">A</div>
            </div>
        </div>

        <div class="table-panel">
            <div class="panel-header-title"><i class="fa-solid fa-hotel me-2" style="color: var(--wedding-gold);"></i> Daftar Ballroom / Venue</div>
            <div class="table-responsive">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>Nama Ruangan</th>
                            <th>Kapasitas</th>
                            <th>Luas Area</th>
                            <th>Harga per Hari</th>
                            <th>Status Ketersediaan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $venues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $venue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <strong class="d-block text-white"><?php echo e($venue->nama_ruangan); ?></strong>
                                <small class="text-muted"><?php echo e($venue->deskripsi); ?></small>
                            </td>
                            <td><i class="fa-solid fa-users text-gray-500 me-1"></i> <?php echo e($venue->kapasitas_tamu); ?></td>
                            <td><i class="fa-solid fa-maximize text-gray-500 me-1"></i> <?php echo e($venue->luas_area); ?> m²</td>
                            <td><strong>Rp <?php echo e(number_format($venue->harga_per_hari, 0, ',', '.')); ?></strong></td>
                            <td>
                                <span class="status-badge badge-available">
                                    <i class="fa-solid fa-circle-check me-1"></i> <?php echo e($venue->status_ketersediaan); ?>

                                </span>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Belum ada data venue.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH D:\semester 4\Deandra Majestic Final\buruan-nikah\resources\views/admin/venues.blade.php ENDPATH**/ ?>