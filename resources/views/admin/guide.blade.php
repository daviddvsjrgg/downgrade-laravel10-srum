@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<section class="max-w-6xl mx-auto px-4 py-10 text-[#06003F]">
    <h1 class="text-center text-4xl font-bold mb-10">Panduan Admin</h1>

    <ol class="list-decimal list-inside space-y-4 prose prose-lg text-justify text-lg mx-auto max-w-3xl mb-4">
        <li><strong>Masuk ke Sistem</strong> "VoiceLib" menggunakan akun admin yang telah terdaftar.</li>
        <li><strong>Gunakan Menu Navigasi</strong> di sebelah kiri layar untuk memilih halaman yang ingin Anda kelola.</li>
        <li>Pada menu <strong>Dashboard</strong>, Anda dapat memantau ringkasan aktivitas sistem secara visual, seperti jumlah koleksi dan total audio.</li>
        <li>Gunakan menu <strong>Kelola Data Koleksi</strong> untuk melakukan manajemen data abstrak, seperti menambah, mengedit, atau menghapus data. Di halaman ini Anda juga dapat melakukan fungsi inti, yaitu <strong>mengalihmediakan (konversi) teks menjadi audio</strong>.</li>
        <li>Pada menu <strong>Data Audio</strong>, Anda dapat meninjau dan mengelola semua file audio yang telah berhasil dibuat, termasuk memutar pratinjau (preview) atau menghapusnya.</li>
        <li>Pada menu <strong>Permintaan Full Akses</strong> Anda dapat melihat dan melacak semua permohonan akses teks lengkap yang telah diajukan oleh mahasiswa.</li>
        <li>Setelah melakukan verifikasi secara langsung di perpustakaan, Anda dapat mengirimkan tautan dokumen lengkap kepada mahasiswa melalui nomor WhatsApp yang tertera pada data permintaan.</li>
    </ol>
</section>
@endsection
