<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data booking dari database
        $bookings = Booking::all();

        // 2. Siapkan wadah kosong untuk masing-masing slug venue
        $formattedBookings = [
            'grand-ballroom'  => [],
            'crystal-hall'    => [],
            'garden-terrace'  => []
        ];

        // 3. Lakukan perulangan untuk memetakan data sesuai kebutuhan kalender
        foreach ($bookings as $booking) {
            $venueSlug = '';

            // Petakan venue_id (angka) ke dalam slug (string)
            if ($booking->venue_id == 1) {
                $venueSlug = 'grand-ballroom';
            } elseif ($booking->venue_id == 2) {
                $venueSlug = 'crystal-hall';
            } elseif ($booking->venue_id == 3) {
                $venueSlug = 'garden-terrace';
            }

            // Jika slug venue ditemukan, masukkan tanggal dan statusnya jika tidak dibatalkan
            if ($venueSlug) {
                // Ubah teks status menjadi huruf kecil semua (case-insensitive)
                $statusAsli = strtolower($booking->status ?? 'pending');

                if ($statusAsli !== 'cancelled') {
                    // Konversi status 'confirmed' dari DB agar terbaca sebagai 'booked' di kalender
                    $statusKalender = ($statusAsli === 'confirmed') ? 'booked' : 'pending';

                    // Simpan dengan format array: ['YYYY-MM-DD' => 'status']
                    $formattedBookings[$venueSlug][$booking->tanggal_acara] = $statusKalender;
                }
            }
        }

        // 4. Kirim hasil pemetaan data ke halaman view jadwal
        return view('pengunjung.jadwal', compact('formattedBookings'));
    }
}