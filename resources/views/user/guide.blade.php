@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="max-w-6xl mx-auto px-4 py-10 text-[#06003F]">
    <h1 class="text-center text-4xl font-bold mb-10">Panduan Pengguna</h1>

    <ol class="list-decimal list-inside space-y-4 prose prose-lg text-justify text-lg mx-auto max-w-3xl mb-4">
        <li>Buka situs VoiceLib melalui browser pada perangkat Anda.</li>
        <li>Klik tombol <strong>“Mulai Sekarang”</strong> di halaman utama (beranda).</li>
        <li>Pilih bahasa audio yang Anda inginkan untuk mendengarkan abstrak.</li>
        <li>Masukkan kata kunci, misalnya judul, subjek, atau nama penulis.</li>
        <li>Nikmati koleksi audio abstrak tugas akhir yang tersedia di UPT Perpustakaan UM.</li>
        <li>Jika ingin melihat dokumen lengkap, klik <strong>“Minta Teks Lengkap”</strong>, lalu isi data seperti nama, NIM, program studi/fakultas, dan nomor WhatsApp Anda.</li>
        <li>Selanjutnya, datang langsung ke UPT Perpustakaan UM untuk verifikasi sebagai mahasiswa tuna netra. Sampaikan kepada petugas bahwa Anda telah mengajukan permintaan akses teks lengkap melalui VoiceLib. Setelah verifikasi selesai, tautan teks lengkap akan dikirimkan ke WhatsApp Anda.</li>
    </ol>
</section>
@endsection
