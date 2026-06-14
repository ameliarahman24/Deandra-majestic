<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // WAJIB: Untuk mengaktifkan query ke database asli

class BookingController extends Controller
{
    // =========================================================================
    // 👤 SISI PENGUNJUNG / PELANGGAN
    // =========================================================================

    /**
     * 1. Menampilkan halaman form booking untuk pelanggan
     */
    public function booking() 
    { 
        // Mengambil data ruangan/venue dari database agar bisa dipilih di dropdown form pelanggan
        $venues = DB::table('venues')->get();
        
        // PERBAIKAN DI SINI: Diarahkan ke pelanggan_booking.blade.php sesuai struktur foldermu
        return view('pengunjung.pelanggan_booking', compact('venues')); 
    }

    public function store(Request $request)
    {
        // Validasi input dari form pelanggan
        $request->validate([
            'venue_id'             => 'required|integer|exists:venues,id',
            'tanggal_acara'        => 'required|date',
            'sesi'                 => 'required|string',
            'estimasi_tamu'        => 'required|integer|min:1',
            'tema_dekorasi'        => 'required|string',
            'nama_mempelai_pria'   => 'required|string|max:255',
            'nama_mempelai_wanita' => 'required|string|max:255',
            'email'                => 'required|email|max:255',
            'no_whatsapp'          => 'required|string|max:255',
            'total_estimasi'       => 'required|numeric|min:0',
        ]);

        // Simpan data secara langsung ke tabel 'bookings'
        DB::table('bookings')->insert([
            'venue_id'             => $request->venue_id,
            'tanggal_acara'        => $request->tanggal_acara,
            'sesi'                 => $request->sesi,
            'estimasi_tamu'        => $request->estimasi_tamu,
            'tema_dekorasi'        => $request->tema_dekorasi,
            'nama_mempelai_pria'   => $request->nama_mempelai_pria,
            'nama_mempelai_wanita' => $request->nama_mempelai_wanita,
            'email'                => $request->email,
            'no_whatsapp'          => $request->no_whatsapp,
            'total_estimasi'       => $request->total_estimasi,
            'status'               => 'pending', // Status default ketika pesanan baru masuk
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

        // Kembalikan pelanggan ke halaman home dengan membawa pesan sukses
        return redirect()->route('pengunjung.home')->with('success', 'Booking ruangan berhasil dibuat! Menunggu konfirmasi admin.');
    }


    // =========================================================================
    // 👑 SISI ADMIN
    // =========================================================================

    /**
     * 3. Menampilkan dashboard utama overview admin
     */
    public function adminOverview()
    {
        // Mengambil seluruh data booking terbaru untuk grafik atau statistik ringkas admin
        $bookings = DB::table('bookings')->orderBy('created_at', 'desc')->get();
        
        // Mengarahkan ke file resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', compact('bookings'));
    }

    /**
     * 4. Menampilkan tabel daftar pesanan lengkap di panel kelola data admin
     */
    public function adminBookings()
    {
        // Mengambil data dari tabel bookings, digabungkan dengan tabel venues untuk mengambil 'nama_ruangan'
        $bookings = DB::table('bookings')
            ->leftJoin('venues', 'bookings.venue_id', '=', 'venues.id')
            ->select('bookings.*', 'venues.nama_ruangan')
            ->orderBy('bookings.created_at', 'desc')
            ->get();

        // Mengarahkan ke file resources/views/admin/bookings.blade.php
        return view('admin.bookings', compact('bookings'));
    }
}