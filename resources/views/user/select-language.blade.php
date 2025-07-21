@extends('layouts.app')

@section('title', $title)

@section('content')
<section class="max-w-6xl mx-auto px-4 py-20">
    <h1 class="text-center text-4xl font-bold mb-4 text-[#06003F]">Pilih Bahasa Audio</h1>
    <p class="text-center text-lg mb-10 text-[#06003F]">Silahkan pilih bahasa yang diinginkan untuk mendengar audio abstrak</p>

    <div class="flex flex-col sm:flex-row justify-center gap-16">
        <a href="{{ route('cari.audio', ['language' => 'id']) }}" 
            class="w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 sm:w-48 h-48 bg-[#090445] rounded-2xl p-3 flex flex-col items-center justify-center shadow-lg hover:scale-110 hover:bg-[#1119B3] transition-transform text-center"
            role="button"
            aria-label="Pilih Bahasa Indonesia">
                <h2 class="text-lg font-semibold text-white mb-4">Bahasa Indonesia</h2>
                <img src="{{ asset('images/flag-id.webp') }}" alt="Bendera Indonesia" class="w-14 h-9 mx-auto">
        </a>
        <a href="{{ route('cari.audio', ['language' => 'en']) }}" 
            class="w-full focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 sm:w-48 h-48 bg-[#090445] rounded-2xl p-3 flex flex-col items-center justify-center shadow-lg hover:scale-110 hover:bg-[#1119B3] transition-transform text-center"
            role="button"
            aria-label="Pilih Bahasa Inggris">
                <h2 class="text-lg font-semibold text-white mb-4">Bahasa Inggris</h2>
                <img src="{{ asset('images/flag-uk.webp') }}" alt="Bendera Inggris" class="w-14 h-9 mx-auto">
        </a>
    </div>
</section>
@endsection
