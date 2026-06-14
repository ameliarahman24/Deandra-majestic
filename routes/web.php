<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\VenueController;

/*
|--------------------------------------------------------------------------
| Web Routes - Aplikasi Buruan-Nikah
|--------------------------------------------------------------------------
*/

// =========================================================================
// 1. JALUR AKSES MASUK (AUTENTIKASI)
// =========================================================================
    // Jalur untuk URL /login
    Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

    // Jalur untuk URL /register
    Route::get('/register', [AuthController::class, 'registerView'])->name('register')->middleware('guest');
    Route::post('/register', [AuthController::class, 'register'])->middleware('guest');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// =========================================================================
// 2. JALUR KHUSUS PELANGGAN / PENGUNJUNG (Tanpa awalan /admin)
// =========================================================================
Route::get('/', function () {
    return view('pengunjung.welcome'); // Landing page awal sebelum login
});

// Jalur Utama Menampilkan Dashboard Pengunjung lewat VenueController
Route::get('/home', [VenueController::class, 'index'])->name('pengunjung.home');
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');


// Menampilkan form booking di sisi pelanggan menggunakan Controller
Route::get('/booking', [BookingController::class, 'booking'])->name('pengunjung.booking');

// Memproses pengiriman data form booking dari pelanggan ke database
Route::post('/booking/kirim', [BookingController::class, 'store'])->name('pengunjung.booking.store');


// =========================================================================
// 3. JALUR KHUSUS ADMIN (Semua URL otomatis diawali dengan /admin/...)
// =========================================================================
Route::prefix('admin')->group(function () {
    
    // Halaman Utama Dashboard Panel Admin
    Route::get('/dashboard', function () {
        $bookings = DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        return view('admin.dashboard', compact('bookings')); 
    })->name('admin.dashboard');

    // Halaman Mengelola Data Pesanan Masuk (Menggunakan BookingController)
    Route::get('/bookings', [BookingController::class, 'adminBookings'])->name('admin.bookings');

    // Rute Aksi untuk Menyetujui Booking (Status -> confirmed)
    Route::post('/bookings/{id}/confirm', function ($id) {
        $booking = DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->where('bookings.id', $id)
            ->first();

        if ($booking) {
            DB::table('bookings')
                ->where('id', $id)
                ->update([
                    'status' => 'confirmed', 
                    'updated_at' => now()
                ]);
                
            try {
                Mail::send([], [], function ($message) use ($booking) {
                    $message->to($booking->email)
                        ->subject('Booking Ruangan Disetujui - Deandra Majestic Venue')
                        ->html(view('emails.booking_confirmed', compact('booking'))->render());
                });
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email konfirmasi booking ke ' . $booking->email . ': ' . $e->getMessage());
            }
        }
            
        return redirect()->back()->with('success', 'Booking ruangan berhasil disetujui!');
    })->name('admin.bookings.confirm');

    // Rute Aksi untuk Membatalkan Booking (Status -> cancelled)
    Route::post('/bookings/{id}/cancel', function ($id) {
        $booking = DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->where('bookings.id', $id)
            ->first();

        if ($booking) {
            DB::table('bookings')
                ->where('id', $id)
                ->update([
                    'status' => 'cancelled', 
                    'updated_at' => now()
                ]);
                
            try {
                Mail::send([], [], function ($message) use ($booking) {
                    $message->to($booking->email)
                        ->subject('Booking Ruangan Dibatalkan - Deandra Majestic Venue')
                        ->html(view('emails.booking_cancelled', compact('booking'))->render());
                });
            } catch (\Exception $e) {
                Log::error('Gagal mengirim email pembatalan booking ke ' . $booking->email . ': ' . $e->getMessage());
            }
        }
            
        return redirect()->back()->with('success', 'Booking ruangan telah dibatalkan!');
    })->name('admin.bookings.cancel');
    // Rute Halaman Kotak Masuk Pesan Pengunjung
    Route::get('/chat', function () {
        return view('admin.chat');
    })->name('admin.chat');

    // Rute Halaman Kelola Gedung
    Route::get('/venues', function () {
        $venues = DB::table('venues')->get();
        return view('admin.venues', compact('venues'));
    })->name('admin.venues');

    // Rute Halaman Notifikasi
    Route::get('/notifications', function () {
        $notifications = DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->orderBy('bookings.created_at', 'desc')
            ->get();
        return view('admin.notifications', compact('notifications'));
    })->name('admin.notifications');
    
}); // Akhir grup admin