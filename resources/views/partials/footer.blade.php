<footer class="bg-[#1E3A8A] text-white shadow-inner">
    <div
        class="w-full max-w-screen-xl mx-auto flex flex-col lg:flex-row justify-between gap-6 px-4 sm:px-6 md:px-12 lg:px-20 py-8 text-sm">

        {{-- Logo + Credit Section --}}
        <div class="flex flex-col items-start">
            <div class="flex items-center">
                <img src="{{ asset('images/logoum-2.webp') }}" alt="Logo Universitas Negeri Malang"
                    class="h-20 sm:h-24 mb-2">
                <div class="ml-4 text-left leading-tight">
                    <p class="font-bold text-2xl sm:text-3xl leading-snug">FAKULTAS<br>VOKASI</p>
                </div>
            </div>
            <div class="text-left text-xs sm:text-sm mt-4 ml-1 sm:ml-3">
                <div class="flex gap-1 items-center">
                    <p class="font-bold text-base sm:text-lg">&copy; {{ date('Y') }}</p>
                    <p class="font-bold text-base sm:text-lg">VoiceLib</p>
                </div>
                <p class="font-medium text-sm mt-1">Desain dan Konsep oleh Risa Annisa</p>
                <p class="font-medium text-sm">Pembimbing: Inawati, S.I.P., M.M.</p>
            </div>
        </div>

        {{-- Contact Info Section --}}
        <div class="flex flex-col text-left">
            <p class="font-bold text-xl sm:text-2xl mb-3">UPT Perpustakaan UM</p>

            <div class="mb-4 space-y-1 text-sm sm:text-base">
                <div class="flex">
                    <span class="min-w-[130px] sm:min-w-[160px] font-semibold">Jam Layanan:</span>
                    <span>Senin–Kamis 07.00–18.00</span>
                </div>
                <div class="flex">
                    <span class="min-w-[130px] sm:min-w-[160px]"></span>
                    <span>Jumat 07.00–15.00</span>
                </div>
                <div class="flex">
                    <span class="min-w-[130px] sm:min-w-[160px]"></span>
                    <span>Sabtu 07.00–14.00</span>
                </div>
            </div>

            <div class="space-y-2 text-sm sm:text-base">
                <div class="flex items-center gap-2">
                    <span class="min-w-[130px] sm:min-w-[160px] font-semibold">Hubungi kami lewat:</span>
                    <span class="flex items-center gap-2">
                        <!-- Instagram Icon -->
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M7 2C4.8 2 3 3.8 3 6v12c0 2.2 1.8 4 4 4h10c2.2 0 4-1.8 4-4V6c0-2.2-1.8-4-4-4H7zm0 2h10c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H7c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2zm10.5 1a1 1 0 100 2 1 1 0 000-2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z" />
                        </svg>
                        <a href="https://www.instagram.com/perpustakaan.um/" target="_blank" rel="noreferrer" class="text-white focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">@perpustakaan.um</a>
                    </span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="min-w-[130px] sm:min-w-[160px]"></span>
                    <span class="flex items-center gap-2">
                        <!-- Email Icon -->
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M14.95 3.684L8.637 8.912a1 1 0 0 1-1.276 0l-6.31-5.228A.999.999 0 0 0 1 4v8a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4a.999.999 0 0 0-.05-.316M2 2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2m-.21 1l5.576 4.603a1 1 0 0 0 1.27.003L14.268 3z" />
                        </svg>
                        <a href="mailto:library@um.ac.id" class="hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">library@um.ac.id</a>
                    </span>
                </div>
                
                <div class="flex items-center gap-2">
                    <span class="min-w-[130px] sm:min-w-[160px]"></span>
                    <span class="flex items-center gap-2">
                        <!-- WhatsApp Icon -->
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.52 3.48A11.88 11.88 0 0012 0a11.88 11.88 0 00-8.52 3.48A11.88 11.88 0 000 12c0 2.11.55 4.15 1.6 5.95L0 24l6.23-1.62A11.82 11.82 0 0012 24a11.88 11.88 0 008.52-3.48A11.88 11.88 0 0024 12a11.88 11.88 0 00-3.48-8.52zM12 22c-1.75 0-3.46-.46-4.96-1.33l-.35-.2-3.69.96.99-3.59-.23-.37A9.89 9.89 0 012 12a10 10 0 0110-10 10 10 0 0110 10 10 10 0 01-10 10zm5.28-7.45c-.3-.15-1.77-.87-2.04-.97s-.47-.15-.67.15-.77.97-.94 1.17-.35.22-.65.07a8.01 8.01 0 01-2.34-1.43 8.9 8.9 0 01-1.64-2.03c-.17-.3-.02-.46.13-.61.13-.13.3-.35.44-.52.15-.17.2-.3.3-.5.1-.2.05-.38-.02-.53-.07-.15-.67-1.61-.92-2.2-.24-.56-.5-.49-.67-.5l-.56-.01c-.2 0-.52.07-.8.38s-1.05 1.02-1.05 2.48 1.08 2.87 1.24 3.07c.15.2 2.12 3.24 5.13 4.54.72.31 1.28.5 1.72.64.72.23 1.38.2 1.9.12.58-.09 1.77-.72 2.02-1.41.25-.7.25-1.3.18-1.41-.07-.1-.27-.17-.56-.3z" />
                        </svg>
                        <a href="https://api.whatsapp.com/send?phone=6282140533038&text=" target="_blank"
                            class="hover:underline focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2">082140533038</a>
                    </span>
                </div>
            </div>

        </div>
    </div>
</footer>