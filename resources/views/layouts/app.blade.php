<!DOCTYPE html>
<html lang="id"> {{-- Ganti bahasa menjadi "id" untuk Bahasa Indonesia --}}
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="VoiceLib adalah layanan perpustakaan inklusif Universitas Negeri Malang untuk mahasiswa disabilitas netra, menyediakan abstrak tugas akhir dalam bentuk audio.">
    <title>@yield('title')</title>

    {{-- Tab Icon --}}
    <link rel="icon" href="{{ asset('images/logoum.webp') }}" type="image/webp">

    {{-- Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 scroll-smooth">

    {{-- Tautan Aksesibilitas: Lewati ke Konten --}}
    <a href="#konten-utama" class="p-2 sr-only focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-white text-blue-800 font-semibold px-4 py-2 rounded shadow z-50">
        Lewati Ke Konten Utama
    </a>

    @include('partials.navbar')

    <main id="konten-utama" class="">
        @yield('content')
    </main>

    @include('partials.footer')

    @yield('script')

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#090445',
            timer: 3000,
            timerProgressBar: true,
        });
    </script>
    @endif

</body>
</html>
