@extends('layouts.app')

@section('title', $title ?? 'Judul Default')

@section('content')
<div class="py-12 px-4 sm:px-6 flex flex-col">
    <!-- Centered Card -->
    <div class="bg-white shadow-md rounded-lg px-4 sm:px-6 py-6 w-full max-w-lg mx-auto">
        <form method="GET" action="{{ route('hasil.audio') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <input type="hidden" name="language" value="{{ $language ?? '' }}">

            <div class="relative flex-grow">
                <input
                    type="text"
                    name="keyword"
                    value="{{ $keyword ?? '' }}"
                    placeholder="Ketik kata kunci judul, atau penulis ..."
                    class="w-full border border-gray-900 rounded-md pl-3 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445]"
                >
            </div>

            <button
                type="submit"
                class="focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 flex hover:cursor-pointer items-center justify-center gap-2 bg-[#090445] text-white px-4 py-2 rounded-md hover:bg-[#090445e0]"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                Cari
            </button>
        </form>
    </div>

    <div class="mt-8 w-full px-4 sm:px-6 md:px-16">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Hasil Pencarian</h2>

        @if($keyword ?? false)
            <p class="text-sm text-gray-600 mb-4">
                Menampilkan {{ $results->total() ?? 0 }} hasil untuk kata kunci <strong>“{{ $keyword }}”</strong>.
            </p>
        @endif

        <div class="bg-white shadow-md rounded-lg p-4 sm:p-6">
            @forelse ($results as $index => $audio)
                <div class="flex flex-col md:flex-row items-start md:items-center md:gap-2 py-4">
                    <!-- Metadata -->
                    <div class="flex-1">
                        <p class="text-base font-semibold break-words">
                            {{ \Illuminate\Support\Str::limit($audio->collection->judul_tugas_akhir ?? 'Judul tidak tersedia', 100) }}
                        </p>
                        <p class="text-sm text-gray-600 mt-1 italic">
                            {{ $audio->collection->nama_penulis ?? 'Penulis tidak tersedia' }} |
                            {{ $audio->collection->tahun_terbit ?? 'Tahun tidak tersedia' }} |
                            {{ $audio->collection->program_studi ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Play Button + Ellipsis -->
                    <div class="w-full md:w-64 flex-shrink-0 flex justify-end items-center gap-2 relative">
                        <!-- Audio Player -->
                        <audio id="audio-{{ $index }}">
                            <source src="data:audio/{{ strtolower($audio->format ?? 'mp3') }};base64,{{ $audio->base64 ?? '' }}"
                                    type="audio/{{ ($audio->format ?? '') === 'LINEAR16' ? 'wav' : strtolower($audio->format ?? 'mp3') }}">
                            Your browser does not support the audio element.
                        </audio>

                        <!-- Play Button -->
                        <button
                            data-audio-id="audio-{{ $index }}"
                            id="btn-{{ $index }}"
                            class="w-13 h-13 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 hover:cursor-pointer rounded-full bg-[#090445] text-white flex items-center justify-center shadow-md transition duration-300 hover:bg-[#090445]"
                        >
                            <svg id="icon-{{ $index }}" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" /> <!-- Play Icon -->
                            </svg>
                        </button>

                        <!-- Ellipsis Menu Button -->
                        <div class="relative inline-block text-left">
                            <button
                                type="button"
                                id="menu-button-{{ $index }}"
                                class="text-[#090445] focus:outline-none hover:cursor-pointer focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
                                    <path fill-rule="evenodd" d="M10.5 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Zm0 6a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0Z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                id="dropdown-{{ $index }}"
                                class="hidden absolute right-0 z-10 mt-2 w-44 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                            >
                                <div class="py-1 text-sm text-gray-700">
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 0.25)"
                                    >Kecepatan 0.25x</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 0.5)"
                                    >Kecepatan 0.5x</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 0.75)"
                                    >Kecepatan 0.75x</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 1.0)"
                                    >Kecepatan Normal</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 1.5)"
                                    >Kecepatan 1.5x</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 1.75)"
                                    >Kecepatan 1.75x</button>
                                    <button
                                        class="block w-full text-left px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                        onclick="setPlaybackRate('audio-{{ $index }}', 2.0)"
                                    >Kecepatan 2.0x</button>
                                    @php
                                        $audioFormat = strtoupper($audio->format ?? 'MP3');
                                        $downloadExt = $audioFormat === 'LINEAR16' ? 'wav' : strtolower($audioFormat);
                                        $mimeType = $downloadExt;
                                    @endphp

                                    <a
                                        href="data:audio/{{ $mimeType }};base64,{{ $audio->base64 ?? '' }}"
                                        download="audio_{{ $index }}.{{ $downloadExt }}"
                                        class="block px-4 py-2 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2"
                                    >
                                        Unduh Audio
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Request Text Button -->
                    <div class="w-full md:w-auto">
                        <a
                            href="{{ route('permintaan.teks.lengkap', ['audioId' => $audio->id ?? 0]) }}"
                            class="block focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 text-center px-4 py-2 rounded-md bg-[#090445] text-white font-semibold hover:bg-[#090445e0]"
                        >
                            Minta Teks Lengkap
                        </a>
                    </div>
                </div>

                <!-- Script per item -->
                <script>
                    (() => {
                        const audio = document.getElementById('audio-{{ $index }}');
                        const button = document.getElementById('btn-{{ $index }}');
                        const icon = document.getElementById('icon-{{ $index }}');
                        const menuButton = document.getElementById('menu-button-{{ $index }}');
                        const dropdown = document.getElementById('dropdown-{{ $index }}');

                        let isPlaying = false;

                        button.addEventListener('click', () => {
                            if (isPlaying) {
                                audio.pause();
                            } else {
                                audio.play();
                            }
                        });

                        audio.addEventListener('play', () => {
                            isPlaying = true;
                            icon.innerHTML = '<path d="M6 4h4v16H6zm8 0h4v16h-4z" />';
                        });

                        audio.addEventListener('pause', () => {
                            isPlaying = false;
                            icon.innerHTML = '<path d="M8 5v14l11-7z" />';
                        });

                        menuButton.addEventListener('click', (e) => {
                            e.stopPropagation();
                            dropdown.classList.toggle('hidden');
                        });

                        document.addEventListener('click', (e) => {
                            if (!dropdown.contains(e.target) && !menuButton.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    })();

                    function setPlaybackRate(audioId, rate) {
                        const audio = document.getElementById(audioId);
                        if (audio) {
                            audio.playbackRate = rate;
                        }
                    }
                </script>

                @if (!$loop->last)
                    <hr class="border-t border-gray-300" />
                @endif
            @empty
                <p class="mt-4 text-gray-600">Tidak ada hasil ditemukan.</p>
            @endforelse

        </div>

        <div class="mt-4 flex flex-col sm:flex-row items-start sm:items-center justify-between text-sm text-gray-700 gap-2">
            <div>
                Menampilkan <span class="font-semibold">{{ $results->firstItem() ?? 0 }}</span> -
                <span class="font-semibold">{{ $results->lastItem() ?? 0 }}</span> dari
                <span class="font-semibold">{{ $results->total() ?? 0 }}</span> data
            </div>

            <div>
                {{ $results->links('vendor.pagination.custom-tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection
