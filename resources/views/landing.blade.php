@extends('layouts.app')

@section('title', $title)

@section('content')
    {{-- Section: Hero / Jumbotron --}}
    <section class="bg-gray-50/25 pt-18 px-6">
        <div class="container mx-auto flex flex-col-reverse md:flex-row items-center gap-12 px-4 md:px-8">
            <div class="md:w-1/2 w-full text-center md:text-left">
                <h1 class="text-5xl font-bold text-[#06003F] leading-tight mb-6">
                    Selamat Datang di <span class="text-[#090445]">VoiceLib</span>
                </h1>
                <p class="text-lg text-gray-900 font-medium leading-relaxed mb-8 text-justify">
                    VoiceLib hadir untuk mendukung layanan perpustakaan yang inklusif bagi mahasiswa disabilitas netra di Universitas Negeri Malang. Situs VoiceLib menghadirkan pengalaman baru dengan menyediakan abstrak tugas akhir yang telah diubah menjadi audio. Jelajahi kemudahan dalam mengakses informasi perpustakaan, kapan pun dan di mana pun.
                </p>
                <a href="{{ route('landing.pilih.bahasa') }}"
                   class="inline-block py-4 px-6 bg-[#090445] text-white text-lg font-semibold rounded-lg hover:bg-indigo-900 transition duration-300 focus:outline-none focus:ring-4 focus:ring-yellow-400">
                    Mulai Sekarang
                </a>
            </div>

            <!-- Image Content -->
            <div class="md:w-1/2 w-full flex justify-center items-center">
                <img src="{{ asset('images/hero2.webp') }}"
                     alt="Ilustrasi mahasiswa tunanetra laki-laki memakai kacamata hitam dan headphone kuning, sedang menggunakan laptop dan membaca buku braille"
                     class="w-full md:w-1/2">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 pt-18 px-6 mt-4">
        <div class="container mx-auto px-4 py-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#06003F]">
                Panduan Penggunaan VoiceLib
            </h2>
            <p class="text-gray-900 text-lg leading-relaxed font-medium py-6">
                Pelajari langkah-langkah menggunakan VoiceLib untuk mencari dan mendengarkan koleksi audio
            </p>
            <a href="{{ route('landing.guide') }}"
               class="inline-block py-4 px-6 bg-[#090445] text-white text-lg font-semibold rounded-lg hover:bg-indigo-900 transition duration-300 focus:outline-none focus:ring-4 focus:ring-yellow-400">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    {{-- Section: About / Tentang Kami --}}
    <section class="py-8 md:py-12 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#06003F] mb-8">Tentang Kami</h2>
            <div class="max-w-3xl mx-auto">
                <p class="text-gray-900 text-lg leading-relaxed font-medium text-justify">
                    <strong>VoiceLib</strong> adalah platform “perpustakaan digital” yang mengonversi teks menjadi audio secara otomatis. Dikembangkan untuk mendukung mahasiswa tunanetra di Universitas Negeri Malang, VoiceLib diharapkan dapat menghadirkan akses informasi akademik yang lebih mudah, fleksibel, dan ramah pengguna.
                </p>
                <a href="{{ route('landing.about') }}"
                   class="inline-block mt-10 py-4 px-6 bg-[#090445] text-white text-md font-semibold rounded-lg hover:bg-indigo-900 transition duration-300 focus:outline-none focus:ring-4 focus:ring-yellow-400">
                    Simak lebih lanjut tentang kami
                </a>
            </div>
        </div>
    </section>
@endsection
