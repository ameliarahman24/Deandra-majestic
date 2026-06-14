@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#0b0b0c] text-gray-200 p-6 max-w-7xl mx-auto mt-8 mb-20">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <span class="text-xs text-[#5c85ff] font-bold tracking-widest uppercase block mb-1">✦ KOTAK MASUK</span>
            <h1 class="text-3xl font-extrabold tracking-tight text-white flex items-center gap-2">Pesan Pengunjung <i class="fa-solid fa-inbox text-lg text-[#5c85ff]"></i></h1>
            <p class="text-sm text-gray-400 mt-1">Manajemen data pesan dan saran yang dikirimkan oleh pengunjung landing page.</p>
        </div>
        
        <div>
            <a href="{{ url('/admin/dashboard') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-gray-800 hover:bg-gray-700 text-white font-semibold text-sm rounded-xl transition border border-gray-700">
                &larr; Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="bg-[#121214] border border-gray-800/70 rounded-2xl p-8 max-w-2xl mx-auto text-center mt-10">
        <div class="mb-6 flex justify-center">
            <img src="{{ asset('postman_mailbox_empty.png') }}" class="w-64 h-64 object-contain" alt="Belum Ada Pesan">
        </div>
        
        <h3 class="text-xl font-bold text-white mb-2">Belum Ada Pesan Masuk</h3>
        <p class="text-sm text-gray-400 leading-relaxed max-w-md mx-auto">
            Saat ini kotak masuk utama kamu kosong. Semua pesan baru atau pertanyaan dari formulir kontak website akan otomatis tersinkronisasi di sini.
        </p>
    </div>

</div>
@endsection
