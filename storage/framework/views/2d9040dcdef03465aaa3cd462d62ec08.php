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
    <title>Deandra - Your Dream Wedding Venue</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-[#0b0b0b] text-white antialiased">

    <nav class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div class="flex items-center gap-12">
            <a href="<?php echo e(url('/home')); ?>" class="text-2xl font-bold tracking-tight text-white">
                Deandra<span class="text-amber-400">.</span>
            </a>
            
            <?php if(auth()->check() && auth()->user()->role === 'admin'): ?>
                <div class="hidden md:flex items-center gap-8 text-gray-400 text-sm font-medium">
                    <a href="<?php echo e(url('/admin/dashboard')); ?>" class="<?php echo e(request()->is('admin/dashboard') ? 'text-white' : 'hover:text-white transition'); ?>">Dashboard</a>
                    <a href="<?php echo e(url('/admin/bookings')); ?>" class="<?php echo e(request()->is('admin/bookings') ? 'text-white' : 'hover:text-white transition'); ?>">Data Booking</a>
                    <a href="<?php echo e(url('/jadwal')); ?>" class="<?php echo e(request()->is('jadwal') ? 'text-white' : 'hover:text-white transition'); ?>">Jadwal</a>
                </div>
            <?php else: ?>
                <div class="hidden md:flex items-center gap-8 text-gray-400 text-sm font-medium">
                    <a href="<?php echo e(url('/home')); ?>" class="<?php echo e(request()->is('home') ? 'text-white' : 'hover:text-white transition'); ?>">Home</a>
                    <a href="<?php echo e(url('/booking')); ?>" class="<?php echo e(request()->is('booking') ? 'text-white' : 'hover:text-white transition'); ?>">Booking</a>
                    <a href="<?php echo e(url('/jadwal')); ?>" class="<?php echo e(request()->is('jadwal') ? 'text-white' : 'hover:text-white transition'); ?>">Jadwal</a>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="flex items-center gap-5">
            <a href="<?php echo e(url('/jadwal')); ?>" class="text-sm font-medium hover:text-gray-300 transition">Cek Tanggal</a>
            
            <?php if(auth()->guard()->guest()): ?>
                <div class="flex items-center gap-4 border-l border-gray-800 pl-4">
                    <a href="<?php echo e(url('/login')); ?>" class="text-sm font-medium text-gray-300 hover:text-white transition">Login</a>
                    <a href="<?php echo e(url('/register')); ?>" class="text-sm font-medium border border-gray-700 hover:border-gray-500 px-4 py-2 rounded-full transition">Sign Up</a>
                </div>
            <?php else: ?>
                <div class="flex items-center gap-4 border-l border-gray-800 pl-4">
                    <!-- Notification Bell -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="relative p-1.5 text-gray-400 hover:text-white transition focus:outline-none flex items-center justify-center">
                            <i class="fa-solid fa-bell text-lg text-amber-400"></i>
                            <?php if(isset($userNotifications) && $userNotifications->count() > 0): ?>
                                <span class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-black"></span>
                            <?php endif; ?>
                        </button>
                        
                        <div x-show="open" @click.outside="open = false" 
                             x-transition:enter="transition ease-out duration-100" 
                             x-transition:enter-start="transform opacity-0 scale-95" 
                             x-transition:enter-end="transform opacity-100 scale-100" 
                             x-transition:leave="transition ease-in duration-75" 
                             x-transition:leave-start="transform opacity-100 scale-100" 
                             x-transition:leave-end="transform opacity-0 scale-95" 
                             class="absolute right-0 mt-3 w-80 bg-[#121214] border border-gray-800 rounded-xl shadow-xl z-50 py-3 text-sm text-left" 
                             style="display: none;">
                            <div class="px-4 pb-2 border-b border-gray-800 font-bold text-gray-300">Notifikasi Reservasi</div>
                            <div class="max-h-60 overflow-y-auto divide-y divide-gray-800/50">
                                <?php $__empty_1 = true; $__currentLoopData = $userNotifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <?php
                                        $isConfirmed = strtolower($notif->status) === 'confirmed';
                                    ?>
                                    <div class="px-4 py-3 hover:bg-white/[0.02] transition">
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold <?php echo e($isConfirmed ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-red-500/10 text-red-400 border border-red-500/20'); ?>">
                                                <?php echo e($isConfirmed ? 'Dikonfirmasi' : 'Dibatalkan'); ?>

                                            </span>
                                            <span class="text-xs text-gray-500"><?php echo e(date('d M Y', strtotime($notif->updated_at))); ?></span>
                                        </div>
                                        <div class="font-semibold text-white mt-1">#BK-<?php echo e(str_pad($notif->id, 4, '0', STR_PAD_LEFT)); ?></div>
                                        <div class="text-xs text-gray-400 mt-1 font-medium"><?php echo e($notif->nama_ruangan); ?></div>
                                        <div class="text-xs text-gray-500 mt-1">
                                            <?php echo e($isConfirmed ? 'Reservasi Anda telah disetujui! Silakan hubungi admin.' : 'Reservasi Anda ditolak/dibatalkan. Hubungi admin.'); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="px-4 py-6 text-center text-gray-500 italic">Belum ada notifikasi baru</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <span class="text-sm text-gray-300 font-medium">
                        <i class="fa-solid fa-user mr-1 text-[#f0b852]"></i> <?php echo e(auth()->user()->name); ?>

                    </span>
                    <form action="<?php echo e(route('logout')); ?>" method="POST" id="logout-form-app" class="hidden">
                        <?php echo csrf_field(); ?>
                    </form>
                    <a href="#" class="text-sm text-gray-400 hover:text-white transition" onclick="event.preventDefault(); document.getElementById('logout-form-app').submit();">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i> Keluar
                    </a>
                </div>
            <?php endif; ?>

            <a href="<?php echo e(url('/booking')); ?>" class="bg-[#f0b852] text-black text-sm font-semibold px-5 py-2.5 rounded-full hover:bg-[#dba33f] transition">Book Sekarang</a>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/layouts/app.blade.php ENDPATH**/ ?>