<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentikasi - Reservasi Pernikahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        :root {
            --bg-dark: #0f0f12;
            --card-dark: #16161e;
            --gold-primary: linear-gradient(135deg, #e5a93b 0%, #b8860b 100%);
            --gold-text: #e5a93b;
            --text-muted: #8e8e93;
            --input-border: #2c2c35;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-dark);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-wrapper {
            background-color: var(--card-dark);
            border: 1px solid #22222a;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 20px 40px rgba(0, 0, 0, 0.5);
        }
        .left-banner {
            background: linear-gradient(rgba(15, 15, 18, 0.85), rgba(15, 15, 18, 0.95)), 
                        url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=1200') no-repeat center center;
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem;
        }
        .left-banner h1 span {
            background: var(--gold-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .form-section {
            padding: 3.5rem 3rem;
        }
        .card-form {
            background-color: #1a1a24;
            border: 1px solid var(--input-border);
            border-radius: 16px;
            padding: 2.5rem 2rem;
        }
        .form-label {
            color: #e1e1e6;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .input-group-text {
            background-color: #121218;
            border: 1px solid var(--input-border);
            color: var(--text-muted);
            border-radius: 10px 0 0 10px;
        }
        .form-control {
            background-color: #121218;
            border: 1px solid var(--input-border);
            color: #ffffff;
            border-radius: 0 10px 10px 0;
            padding: 0.65rem 1rem;
        }
        .form-control:focus {
            background-color: #121218;
            border-color: var(--gold-text);
            color: #ffffff;
            box-shadow: none;
        }
        .btn-gold {
            background: var(--gold-primary);
            color: #0f0f12;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        .btn-gold:hover {
            transform: translateY(-2px);
            opacity: 0.9;
            color: #0f0f12;
        }
        .forgot-link, .signup-link {
            color: var(--gold-text);
            text-decoration: none;
        }
        .forgot-link:hover, .signup-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<!-- Sinkronisasi status form berdasarkan parameter $mode yang dikirim dari controller -->
<body class="bg-[#0b0b0b] text-white antialiased" x-data="{ isLogin: '<?php echo e($mode); ?>' === 'login' }">

<div class="container py-5">
    <div class="row login-wrapper mx-auto col-lg-11 col-xl-10">
        
        <!-- Sisi Banner Kiri -->
        <div class="col-md-6 left-banner d-none d-md-flex text-start">
            <div class="mb-4">
                <span class="badge bg-dark border border-secondary px-3 py-2 rounded-pill text-white" style="font-size: 0.8rem;">
                    <i class="fa-solid fa-heart text-danger me-2"></i>Wedding Organizer
                </span>
            </div>
            <h1 class="display-5 fw-bold mb-3">Selamat <span x-text="isLogin ? 'Datang!' : 'Bergabung!'">Datang!</span></h1>
            <p class="text-white-50 fs-5 mb-0">Rencanakan momen sakral pernikahan impianmu. Masuk atau daftar untuk mengelola reservasi dengan mudah.</p>
        </div>

        <!-- Sisi Form Kanan -->
        <div class="col-md-6 form-section">
            
            <!-- Alert Error Validasi Laravel -->
            <?php if($errors->any()): ?>
                <div class="alert alert-danger border-0 bg-danger text-white small rounded-3 mb-3 py-2">
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card-form">
                
                <!-- CONTAINER FORM LOG IN -->
                <div x-show="isLogin" x-transition>
                    <h3 class="fw-bold mb-1">Log In</h3>
                    <p class="text-muted small mb-4">Silakan masukkan akun untuk melanjutkan akses reservasi</p>

                    <form action="<?php echo e(url('/login')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="form-label mb-0">Password</label>
                                <a href="#" class="forgot-link small" style="color: #ef4444;">Forgot Password?</a>
                            </div>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="d-grid mb-4 mt-4">
                            <button type="submit" class="btn btn-gold">Log In</button>
                        </div>

                        <p class="text-center text-muted small mb-0">
                            Belum punya akun? <a href="<?php echo e(url('/register')); ?>" class="signup-link fw-semibold">Daftar sekarang</a>
                        </p>
                    </form>
                </div>

                <!-- CONTAINER FORM SIGN UP -->
                <div x-show="!isLogin" x-transition style="display: none;">
                    <h3 class="fw-bold mb-1">Sign Up</h3>
                    <p class="text-muted small mb-4">Buat akun baru untuk mulai merencanakan pernikahanmu</p>

                    <form action="<?php echo e(url('/register')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="<?php echo e(old('name')); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" value="<?php echo e(old('email')); ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-shield-halved"></i></span>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <div class="d-grid mb-4 mt-4">
                            <button type="submit" class="btn btn-gold">Daftar Akun</button>
                        </div>

                        <p class="text-center text-muted small mb-0">
                            Sudah punya akun? <a href="<?php echo e(url('/login')); ?>" class="signup-link fw-semibold">Log In di sini</a>
                        </p>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\buruan-nikah\buruan-nikah\resources\views/auth/login.blade.php ENDPATH**/ ?>