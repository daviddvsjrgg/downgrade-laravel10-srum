@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-16 md:py-36 p-6 flex flex-col justify-center items-center bg-[#06003F]">
    <p class="text-lg font-bold mb-2 text-white text-center">
        {{ $language === 'en' ? 'Pencarian Audio Abstrak Tugas Akhir dalam Bahasa Inggris' : 'Pencarian Audio Abstrak Tugas Akhir dalam Bahasa Indonesia' }}
    </p>
    <h1 class="text-4xl text-white max-w-xl text-center font-bold">
        Cari Audio Abstrak
    </h1>
    <p class="text-lg font-bold mt-2 mb-6 text-white text-center">Ketik kata kunci judul, penulis, atau topik untuk menemukan audio abstrak yang ingin kamu cari</p>

    <div class="bg-white shadow-md rounded-lg px-6 py-6 w-full max-w-lg">
        <form method="GET" action="{{ route('hasil.audio') }}" class="flex items-center gap-3">
            <!-- Include language as hidden input -->
            <input type="hidden" name="language" value="{{ $language }}">
            <div class="relative flex-grow">
                <!-- Mic Icon -->
                <input
                    type="text"
                    name="keyword"
                    placeholder="Ketik kata kunci judul, atau penulis ..."
                    class="w-full border border-gray-900 rounded-md pl-3 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445]"
                >
            </div>

            <!-- Search Button with Icon -->
            <button
                type="submit"
                class="focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 flex items-center gap-2 bg-[#090445] text-white px-6 py-2 rounded-md hover:bg-[#090445e0] hover:cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                </svg>
                Cari
            </button>
        </form>
    </div>
</div>
@endsection
