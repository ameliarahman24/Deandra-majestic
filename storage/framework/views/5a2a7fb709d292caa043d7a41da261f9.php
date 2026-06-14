 <?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-[#0b0b0c] text-gray-200 p-6">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div class="flex items-center gap-4">
            <img src="<?php echo e(asset('javanese_wedding_couple.png')); ?>" class="w-16 h-16 object-contain" alt="Javanese Wedding Couple">
            <div>
                <span class="text-xs text-[#f0b852] font-bold tracking-widest uppercase block mb-1">
                    ✦ <i class="fa-solid fa-crown text-[#f0b852] me-1"></i> PANEL KONTROL
                </span>
                <h1 class="text-3xl font-extrabold tracking-tight text-white">Dashboard Admin</h1>
                <p class="text-sm text-gray-400 mt-1">Selamat datang kembali! Berikut adalah ringkasan aktivitas reservasi venue hari ini.</p>
            </div>
        </div>
        
        <div class="flex gap-3">
            <a href="<?php echo e(url('/admin/chat')); ?>" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition shadow-lg shadow-indigo-500/10">
                <i class="fa-solid fa-comment-dots mr-2"></i> Buka Kotak Pesan
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-[#121214] border border-gray-800/70 p-6 rounded-2xl flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <i class="fa-solid fa-chart-simple me-1 text-gray-400"></i> Total Reservasi
                </p>
                <h3 class="text-2xl font-bold text-white mt-1"><?php echo e($bookings->count()); ?></h3>
            </div>
            <div class="w-12 h-12 bg-amber-500/10 rounded-xl flex items-center justify-center text-[#f0b852]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>

        <div class="bg-[#121214] border border-gray-800/70 p-6 rounded-2xl flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <i class="fa-solid fa-circle-check me-1 text-green-400"></i> Selesai Dikonfirmasi
                </p>
                <h3 class="text-2xl font-bold text-green-400 mt-1">
                    <?php echo e($bookings->filter(fn($b) => strtolower($b->status ?? '') === 'confirmed')->count()); ?>

                </h3>
            </div>
            <div class="w-12 h-12 bg-green-500/10 rounded-xl flex items-center justify-center text-green-400">
                <svg xmlns="http://www.w3.org/2000/xl" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-[#121214] border border-gray-800/70 p-6 rounded-2xl flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <i class="fa-solid fa-hourglass-half me-1 text-blue-400"></i> Menunggu (Pending)
                </p>
                <h3 class="text-2xl font-bold text-blue-400 mt-1">
                    <?php echo e($bookings->filter(fn($b) => in_array(strtolower($b->status ?? 'pending'), ['pending', '']))->count()); ?>

                </h3>
            </div>
            <div class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <div class="bg-[#121214] border border-gray-800/70 p-6 rounded-2xl flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <i class="fa-solid fa-circle-xmark me-1 text-red-400"></i> Dibatalkan
                </p>
                <h3 class="text-2xl font-bold text-red-400 mt-1">
                    <?php echo e($bookings->filter(fn($b) => strtolower($b->status ?? '') === 'cancelled')->count()); ?>

                </h3>
            </div>
            <div class="w-12 h-12 bg-red-500/10 rounded-xl flex items-center justify-center text-red-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-[#121214] border border-gray-800/70 rounded-2xl overflow-hidden shadow-xl">
        <div class="px-6 py-5 border-b border-gray-800/70 flex items-center justify-between">
            <h2 class="text-lg font-bold text-white tracking-tight">
                <i class="fa-solid fa-list-check text-[#f0b852] me-2"></i> Log Reservasi Gedung Terbaru
            </h2>
            <span class="text-xs bg-white/5 border border-gray-800 text-gray-400 px-3 py-1 rounded-full">
                <i class="fa-solid fa-bolt text-[#f0b852] me-1"></i> Real-time Data
            </span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-800 bg-white/[0.02] text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-4"><i class="fa-solid fa-key me-1"></i> ID Booking</th>
                        <th class="px-6 py-4"><i class="fa-solid fa-hotel me-1"></i> Nama Ruangan / Venue</th>
                        <th class="px-6 py-4"><i class="fa-solid fa-calendar-days me-1"></i> Tanggal Acara</th>
                        <th class="px-6 py-4"><i class="fa-solid fa-clock me-1"></i> Waktu Dibuat</th>
                        <th class="px-6 py-4 text-center"><i class="fa-solid fa-thumbtack me-1"></i> Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800/50 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-white/[0.01] transition duration-150">
                            <td class="px-6 py-4 font-mono text-[#f0b852] font-semibold">
                                #BK-<?php echo e(str_pad($booking->id, 4, '0', STR_PAD_LEFT)); ?>

                            </td>
                            <td class="px-6 py-4 font-semibold text-white">
                                <i class="fa-solid fa-hotel text-gray-500 me-1"></i> <?php echo e($booking->nama_ruangan); ?>

                            </td>
                            <td class="px-6 py-4 text-gray-300">
                                <i class="fa-solid fa-calendar text-gray-500 me-1"></i> <?php echo e(date('d M Y', strtotime($booking->tanggal_acara ?? $booking->created_at))); ?>

                            </td>
                            <td class="px-6 py-4 text-xs text-gray-500">
                                <i class="fa-solid fa-clock text-gray-500 me-1"></i> <?php echo e(date('d/m/Y H:i', strtotime($booking->created_at))); ?>

                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php if(strtolower($booking->status ?? 'pending') == 'confirmed'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                        <i class="fa-solid fa-circle-check me-1"></i> Confirmed
                                    </span>
                                <?php elseif(strtolower($booking->status ?? 'pending') == 'cancelled'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-500/10 text-red-400 border border-red-500/20">
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Cancelled
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                                        <i class="fa-solid fa-hourglass me-1"></i> Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">
                                <i class="fa-solid fa-magnifying-glass me-2"></i> Belum ada data reservasi gedung yang masuk.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>