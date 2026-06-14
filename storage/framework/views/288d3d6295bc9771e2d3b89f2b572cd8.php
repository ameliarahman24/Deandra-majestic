<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deandra - Your Dream Wedding Venue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        /* Memastikan video menutup seluruh background dengan sempurna */
        .video-bg {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
        }
    </style>
</head>
<body class="relative flex items-center justify-center h-screen overflow-hidden font-sans antialiased text-white bg-[#0b0b0b]">

    <video autoplay loop muted playsinline class="video-bg z-0">
        <source src="<?php echo e(asset('videos/bg.mp4')); ?>" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <div class="absolute inset-0 bg-black/65 z-10"></div>

    <div class="relative z-20 text-center max-w-2xl px-6">
        
        <div class="mb-4 inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
            <span class="flex h-2 w-2 rounded-full bg-amber-400 animate-pulse"></span>
            <span class="text-xs font-medium tracking-wide text-gray-300 uppercase">VENUE PERNIKAHAN PREMIUM JAKARTA</span>
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6 drop-shadow-lg leading-tight">
            Your Dream <br class="hidden sm:inline"> <span class="text-[#f0b852]">Wedding Venue.</span>
        </h1>
        
        <p class="text-base md:text-lg text-gray-300 mb-10 max-w-lg mx-auto drop-shadow-md leading-relaxed">
            Reservasi ballroom pernikahan impianmu dalam hitungan menit. Transparan, mudah, dan tanpa ribet bersama <span class="font-semibold text-white">Deandra</span>.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 w-full">
            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->role === 'admin'): ?>
                    <a href="<?php echo e(url('/admin/dashboard')); ?>" 
                    class="w-full sm:w-auto px-8 py-3.5 bg-[#f0b852] hover:bg-[#dba33f] text-black font-bold rounded-full transition duration-300 shadow-xl text-center transform hover:-translate-y-0.5">
                        Ke Dashboard Admin &rarr;
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(url('/home')); ?>" 
                    class="w-full sm:w-auto px-8 py-3.5 bg-[#f0b852] hover:bg-[#dba33f] text-black font-bold rounded-full transition duration-300 shadow-xl text-center transform hover:-translate-y-0.5">
                        Ke Halaman Utama &rarr;
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <!-- Tetap mengarah ke halaman login -->
                <a href="<?php echo e(url('/login')); ?>" 
                class="w-full sm:w-auto px-8 py-3.5 bg-[#f0b852] hover:bg-[#dba33f] text-black font-bold rounded-full transition duration-300 shadow-xl text-center transform hover:-translate-y-0.5">
                    Log In
                </a>

                <!-- SEKARANG: Langsung mengarah ke URL /register asli -->
                <a href="<?php echo e(url('/register')); ?>" 
                class="w-full sm:w-auto px-8 py-3.5 bg-transparent hover:bg-white/10 text-white font-semibold rounded-full border border-gray-500 hover:border-white transition duration-300 shadow-lg text-center backdrop-blur-sm">
                    Sign Up
                </a>
            <?php endif; ?>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/pengunjung/welcome.blade.php ENDPATH**/ ?>