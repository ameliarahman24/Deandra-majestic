

<?php $__env->startSection('content'); ?> 
<main class="max-w-7xl mx-auto px-6 mt-10 mb-20" x-data="kalenderJadwal">

    <div class="mb-8">
        <span class="text-xs text-[#5c85ff] font-bold tracking-widest uppercase block mb-1">✦ KETERSEDIAAN</span>
        <h1 class="text-3xl font-extrabold tracking-tight text-white">Kalender Jadwal</h1>
    </div>

    <div class="mb-8 bg-[#121214] p-1.5 rounded-xl inline-flex border border-gray-800 text-xs font-semibold">
        <button type="button" @click="venueTerpilih = 'semua'" 
                :class="venueTerpilih === 'semua' ? 'bg-[#f0b852] text-black' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2.5 rounded-lg transition duration-200">Semua</button>
                
        <button type="button" @click="venueTerpilih = 'grand-ballroom'" 
                :class="venueTerpilih === 'grand-ballroom' ? 'bg-[#f0b852] text-black' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2.5 rounded-lg transition duration-200">Grand Ballroom</button>
                
        <button type="button" @click="venueTerpilih = 'crystal-hall'" 
                :class="venueTerpilih === 'crystal-hall' ? 'bg-[#f0b852] text-black' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2.5 rounded-lg transition duration-200">Crystal Hall</button>
                
        <button type="button" @click="venueTerpilih = 'garden-terrace'" 
                :class="venueTerpilih === 'garden-terrace' ? 'bg-[#f0b852] text-black' : 'text-gray-400 hover:text-white'"
                class="px-4 py-2.5 rounded-lg transition duration-200">Garden Terrace</button>
    </div>

    <div class="flex flex-col lg:flex-row gap-8 items-start w-full">
        <div class="bg-[#121214] border border-gray-800 rounded-2xl p-6 w-full lg:w-[65%] text-white">
            
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold" x-text="namaBulan[currentDate.getMonth()] + ' ' + currentDate.getFullYear()"></h3>
                <div class="flex gap-2 text-gray-400">
                    <button type="button" @click="pindahBulan(-1)" class="p-2 hover:text-white bg-white/5 rounded-lg border border-gray-800 select-none">◀</button>
                    <button type="button" @click="pindahBulan(1)" class="p-2 hover:text-white bg-white/5 rounded-lg border border-gray-800 select-none">▶</button>
                </div>
            </div>

            <div class="grid grid-cols-7 gap-2 text-center text-xs font-bold text-gray-500 mb-4">
                <div>MIN</div><div>SEN</div><div>SEL</div><div>RAB</div><div>KAM</div><div>JUM</div><div>SAB</div>
            </div>

            <div class="grid grid-cols-7 gap-2 text-center text-sm font-medium">
                <template x-for="i in kosongAwal" :key="'empty-'+i">
                    <div class="p-4 bg-transparent"></div>
                </template>
                
                <template x-for="tgl in hariDalamBulan" :key="'day-'+tgl">
                    <button type="button"
                            @click="pilihTanggal(tgl)" 
                            :class="{
                                'p-4 rounded-xl relative transition duration-200': true,
                                'bg-[#f0b852] text-black font-extrabold shadow-lg shadow-amber-500/10': isAktif(tgl),
                                'bg-red-950/40 border border-red-800/60 text-red-400 font-bold': !isAktif(tgl) && (cekStatus(tgl) === 'booked'),
                                'bg-blue-950/40 border border-blue-800/60 text-blue-400 font-bold': !isAktif(tgl) && (cekStatus(tgl) === 'pending'),
                                'bg-white/5 text-white border border-gray-800/50 hover:border-amber-400/50': !isAktif(tgl) && (cekStatus(tgl) === 'available')
                            }">
                        
                        <span x-text="tgl"></span>

                        <span x-show="cekStatus(tgl) === 'booked' && !isAktif(tgl)" 
                              class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                        
                        <span x-show="cekStatus(tgl) === 'pending' && !isAktif(tgl)" 
                              class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                    </button>
                </template>
            </div>

            <div class="mt-6 p-4 bg-white/5 rounded-xl border border-gray-800 text-xs min-h-[60px] flex justify-between items-center">
                <div class="w-full flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <span x-show="tanggalTerpilih !== null" class="text-gray-400 block">
                            Tanggal Terpilih: 
                            <strong class="text-white text-sm" x-text="tanggalTerpilih + ' ' + namaBulan[currentDate.getMonth()] + ' ' + currentDate.getFullYear()"></strong>
                        </span>
                        
                        <span x-show="tanggalTerpilih === null" class="text-gray-500 italic">
                            Silakan pilih tanggal pada kalender...
                        </span>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->role === 'user'): ?>
                            <template x-if="tanggalTerpilih !== null">
                                <a :href="'<?php echo e(url('/booking')); ?>?tanggal=' + currentDate.getFullYear() + '-' + String(currentDate.getMonth() + 1).padStart(2, '0') + '-' + String(tanggalTerpilih).padStart(2, '0')" 
                                class="bg-[#f0b852] hover:bg-amber-500 text-black font-bold px-5 py-2.5 rounded-xl transition duration-200 text-center text-xs tracking-wide shadow-md shadow-amber-500/10">
                                    ✦ Book Tanggal Ini
                                </a>
                            </template>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-gray-800/60 flex flex-wrap gap-6 text-xs text-gray-400">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-white/10 border border-gray-700 rounded-full"></span> Tersedia
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-red-500 rounded-full"></span> Sudah Dibooking
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 bg-blue-500 rounded-full"></span> Pending Konfirmasi
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[35%] flex flex-col gap-4 self-stretch">
            <div class="bg-[#121214] border border-gray-800 rounded-2xl p-4">
                <h4 class="text-sm font-bold text-[#f0b852] mb-1">✦ Deandra Wedding Gallery</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Lihat gambaran kemegahan setup ballroom kami untuk menyempurnakan pesta pernikahan Anda.</p>
            </div>
            <div class="grid grid-cols-2 gap-3 flex-grow">
                <div class="relative overflow-hidden rounded-2xl border border-gray-800 row-span-2 min-h-[250px]">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600" class="w-full h-full object-cover">
                </div>
                <div class="relative overflow-hidden rounded-2xl border border-gray-800 min-h-[120px]">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=600" class="w-full h-full object-cover">
                </div>
                <div class="relative overflow-hidden rounded-2xl border border-gray-800 min-h-[120px]">
                    <img src="https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=600" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    window.calendarBookings = <?php echo json_encode($formattedBookings, 15, 512) ?>;
</script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('kalenderJadwal', () => ({
            currentDate: new Date(2026, 5, 1), // Default langsung mengarah ke Juni 2026
            tanggalTerpilih: null,
            namaBulan: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            venueTerpilih: 'semua',
            bookingData: window.calendarBookings || {},

            get hariDalamBulan() {
                return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0).getDate();
            },

            get kosongAwal() {
                return new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1).getDay();
            },

            pindahBulan(arah) {
                this.currentDate = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + arah, 1);
                this.tanggalTerpilih = null;
            },

            pilihTanggal(tgl) {
                this.tanggalTerpilih = tgl;
            },

            cekStatus(tgl) {
                let yyyy = this.currentDate.getFullYear();
                let mm = String(this.currentDate.getMonth() + 1).padStart(2, '0');
                let dd = String(tgl).padStart(2, '0');
                let key = `${yyyy}-${mm}-${dd}`;

                if (this.venueTerpilih === 'semua') {
                    let statusGedung = Object.values(this.bookingData).map(v => v[key]).filter(Boolean);
                    if (statusGedung.includes('booked')) return 'booked';
                    if (statusGedung.includes('pending')) return 'pending';
                    return 'available';
                }

                return this.bookingData[this.venueTerpilih]?.[key] || 'available';
            },

            isAktif(tgl) {
                return this.tanggalTerpilih === tgl;
            }
        }));
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/pengunjung/jadwal.blade.php ENDPATH**/ ?>