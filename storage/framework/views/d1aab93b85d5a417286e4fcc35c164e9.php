<?php $__env->startSection('content'); ?>
<main class="max-w-7xl mx-auto px-6 mt-8 mb-20">
    
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 items-start">
        
        <div class="bg-[#121214] border border-gray-800 rounded-2xl p-4 space-y-1">
            <p class="text-[10px] font-bold text-gray-500 px-3 uppercase tracking-wider mb-2">Admin Panel</p>
            <a href="<?php echo e(url('/admin/dashboard')); ?>" class="flex items-center gap-3 <?php echo e(request()->is('admin/dashboard') ? 'bg-white/5 text-white' : 'text-gray-400 hover:text-white'); ?> text-xs font-bold px-4 py-3 rounded-xl border border-gray-800 transition">
                <i class="fa-solid fa-chart-pie me-2"></i> Overview
            </a>
            <a href="<?php echo e(url('/admin/bookings')); ?>" class="flex items-center gap-3 <?php echo e(request()->is('admin/bookings') ? 'bg-white/5 text-white' : 'text-gray-400 hover:text-white'); ?> text-xs font-medium px-4 py-3 rounded-xl transition">
                <i class="fa-solid fa-calendar-check me-2"></i> Reservasi
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-400 hover:text-white text-xs font-medium px-4 py-3 rounded-xl transition">
                <i class="fa-solid fa-hotel me-2"></i> Ruangan
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-400 hover:text-white text-xs font-medium px-4 py-3 rounded-xl transition">
                <i class="fa-solid fa-file-invoice me-2"></i> Laporan
            </a>
        </div>

        <div class="lg:col-span-3 space-y-8">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight">Admin Panel Dashboard</h1>
                <p class="text-xs text-gray-400 mt-1">Pantau performa bisnis dan manajemen booking venue dalam satu tempat.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-[#121214] border border-gray-800 rounded-xl p-5">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider block mb-1">Total Reservasi</span>
                    <div class="text-2xl font-black mb-1">48</div>
                    <span class="text-[10px] text-green-400 font-semibold"><i class="fa-solid fa-arrow-up me-1"></i> +12% bulan ini</span>
                </div>
                <div class="bg-[#121214] border border-gray-800 rounded-xl p-5">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider block mb-1">Konfirmasi Pending</span>
                    <div class="text-2xl font-black text-amber-400 mb-1">7</div>
                    <span class="text-[10px] text-gray-400 font-medium">Perlu tindakan</span>
                </div>
                <div class="bg-[#121214] border border-gray-800 rounded-xl p-5">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider block mb-1">Pendapatan Bulan Ini</span>
                    <div class="text-2xl font-black mb-1">Rp 312Jt</div>
                    <span class="text-[10px] text-green-400 font-semibold"><i class="fa-solid fa-arrow-up me-1"></i> +8% vs bulan lalu</span>
                </div>
                <div class="bg-[#121214] border border-gray-800 rounded-xl p-5">
                    <span class="text-[10px] text-gray-500 uppercase font-bold tracking-wider block mb-1">Tingkat Hunian</span>
                    <div class="text-2xl font-black mb-1">78%</div>
                    <span class="text-[10px] text-green-400 font-semibold"><i class="fa-solid fa-arrow-up me-1"></i> +5% vs bulan lalu</span>
                </div>
            </div>

            <div class="bg-[#121214] border border-gray-800 rounded-2xl p-6">
                <h3 class="text-sm font-bold mb-4">Booking Terbaru</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-gray-300">
                        <thead>
                            <tr class="border-b border-gray-800 text-gray-500 font-bold uppercase tracking-wider">
                                <th class="pb-3">Klien & Venue</th>
                                <th class="pb-3">Tanggal Acara</th>
                                <th class="pb-3 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-900">
                            <tr>
                                <td class="py-4">
                                    <div class="font-bold text-white">Budi & Sari</div>
                                    <div class="text-[10px] text-gray-500">Grand Ballroom</div>
                                </td>
                                <td class="py-4 text-gray-400">14 Jun 2026</td>
                                <td class="py-4 text-right">
                                    <span class="bg-green-950/60 text-green-400 border border-green-800/40 px-2.5 py-1 rounded-md font-semibold text-[10px]"><i class="fa-solid fa-check me-1"></i> Konfirmasi</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4">
                                    <div class="font-bold text-white">Dian & Reza</div>
                                    <div class="text-[10px] text-gray-500">Crystal Hall</div>
                                </td>
                                <td class="py-4 text-gray-400">21 Jun 2026</td>
                                <td class="py-4 text-right">
                                    <span class="bg-green-950/60 text-green-400 border border-green-800/40 px-2.5 py-1 rounded-md font-semibold text-[10px]"><i class="fa-solid fa-check me-1"></i> Konfirmasi</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4">
                                    <div class="font-bold text-white">Rino & Hendra</div>
                                    <div class="text-[10px] text-gray-500">Garden Terrace</div>
                                </td>
                                <td class="py-4 text-gray-400">25 Jun 2026</td>
                                <td class="py-4 text-right">
                                    <span class="bg-amber-950/60 text-amber-400 border border-amber-800/40 px-2.5 py-1 rounded-md font-semibold text-[10px]"><i class="fa-solid fa-hourglass-half me-1"></i> Pending</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/layouts/admin.blade.php ENDPATH**/ ?>