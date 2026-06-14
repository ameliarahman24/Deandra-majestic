<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth/login', ['mode' => 'login']);    
    }

    public function registerView()
    {
        return view('auth/login', ['mode' => 'register']);    
    }

    public function register(Request $request)
    {
        // a. Validasi Data Form Pendaftaran
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'], // Wajib ada input password_confirmation di form
        ], [
            // Custom pesan error bahasa Indonesia
            'email.unique' => 'Email ini sudah terdaftar, silakan gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        // b. Menyimpan Data ke Tabel Users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password wajib di-hash/enkripsi
            'role' => 'user', // Otomatis mendaftar sebagai pelanggan/user biasa
        ]);

        // c. Otomatis Login setelah berhasil mendaftar
        Auth::login($user);

        // d. Regenerasi Session & Alihkan ke Halaman Home Pengunjung
        $request->session()->regenerate();

        return redirect()->route('pengunjung.home')->with('success', 'Akun berhasil dibuat! Selamat datang di Deandra.');
    }

    public function login(Request $request)
    {
        // 1. Validasi Input Form
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // 2. Proses Autentikasi (Hanya masuk ke dalam IF jika email & password COCOK)
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            
            $request->session()->regenerate();

            // Mengambil data user yang sukses login (PASTI TIDAK NULL di dalam sini)
            $user = Auth::user();

            // Pengalihan halaman sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('pengunjung.home');
        }

        // 3. JIKA GAGAL LOGIN (Email/Password salah)
        // Dilempar ke luar ke halaman login lagi dengan pesan error, tidak akan membaca properti 'role'
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
 
        return redirect()->route('pengunjung.home');
    }
}
