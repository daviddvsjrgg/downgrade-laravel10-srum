<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title')</title>

    {{-- Tab Icon --}}
    <link rel="icon" href="{{ asset('images/logoum.webp') }}" type="image/webp">

    {{-- Fonts & Tailwind CSS --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans&display=swap" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite('resources/css/app.css')
</head>
<body class="flex flex-col min-h-screen bg-white text-gray-900 font-sans">

    {{-- Navbar --}}
    <header class="fixed top-0 left-0 right-0 z-50 bg-[#1E3A8A]">
        @include('partials.admin.navbar')
    </header>


    <div class="flex flex-1 pt-16"> {{-- pt-16 = navbar height --}}
        {{-- Sidebar --}}
        <aside id="sidebar" class="fixed top-16 left-0 h-[calc(100vh-4rem)] w-64 bg-[#06003F] p-4 border-r border-gray-800 overflow-y-auto
                                   transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-40">
            @include('partials.admin.sidebar')
        </aside>

        {{-- Main content --}}
        <main class="flex-1 ml-0 lg:ml-64 p-4 overflow-auto">
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-800 text-white">
            @include('partials.admin.footer')
        </div>
    </footer>

    @yield('script')
    
    @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
    @endif

    <script>
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Aksi ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#9ca3af',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batalkan'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        
        document.getElementById('ubah-btn').addEventListener('click', function () {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Perubahan akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });

        document.getElementById('tambah-btn').addEventListener('click', function(event) {
            event.preventDefault(); // Stop default submit

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data koleksi akan disimpan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#9ca3af',
                confirmButtonText: 'Ya, simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form manually if confirmed
                    this.closest('form').submit();
                }
            });
        });
    </script>

</body>
</html>
