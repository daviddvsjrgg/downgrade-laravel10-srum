@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-8 md:py-24 p-6 flex flex-col justify-center items-center bg-[#06003F]">
    <h1 class="text-4xl text-white max-w-xl text-center font-bold mb-8">
        Permintaan Teks Lengkap
    </h1>

    <div class="bg-white shadow-md rounded-lg px-6 py-4 w-full max-w-2xl">
        <p id="deskripsiForm" class="text-gray-900 mb-6">
            Silakan isi Nama, NIM, Program Studi/Fakultas, dan Nomor WhatsApp Anda. Setelah data terkirim, harap datang ke Perpustakaan UM untuk verifikasi tunanetra. Tautan teks lengkap akan dikirimkan melalui WhatsApp setelah verifikasi selesai.
        </p>

        <form aria-describedby="deskripsiForm" method="POST" action="{{ route('kirim.permintaan.teks.lengkap', ['audioId' => $audio->id]) }}">
            @csrf
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-1">Nama</label>
                <input id="nama" name="nama" type="text" 
                       placeholder="Masukkan Nama"
                       autocomplete="name"
                       value="{{ old('nama') }}"
                       class="w-full border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('nama') border-red-500 @enderror">
                @error('nama')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nim" class="block text-gray-700 font-semibold mb-1">NIM</label>
                <input id="nim" name="nim" 
                    type="text"
                    inputmode="numeric"
                    pattern="\d*"
                    placeholder="Masukkan NIM"
                    autocomplete="username"
                    value="{{ old('nim') }}"
                    class="w-full border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('nim') border-red-500 @enderror">
                @error('nim')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="prodi" class="block text-gray-700 font-semibold mb-1">Program Studi / Fakultas</label>
                <input id="prodi" name="prodi" type="text" 
                       placeholder="Masukkan Program Studi"
                       autocomplete="organization"
                       value="{{ old('prodi') }}"
                       class="w-full border border-gray-700 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('prodi') border-red-500 @enderror">
                @error('prodi')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="whatsapp" class="block text-gray-700 font-semibold mb-1">No WhatsApp (62)</label>
                <div class="flex rounded-md shadow-sm">
                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-700 bg-gray-100 text-gray-700 text-sm">62</span>
                    <input id="whatsapp" name="whatsapp" type="text"
                        placeholder="81234567890"
                        autocomplete="tel"
                        value="{{ old('whatsapp') }}"
                        class="w-full border border-gray-700 rounded-r-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#090445] @error('whatsapp') border-red-500 @enderror"
                        oninput="cleanWhatsApp(this)">
                </div>
                @error('whatsapp')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="w-1/2 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 mx-auto block bg-[#090445] text-white font-semibold px-4 py-2 hover:cursor-pointer rounded-md hover:bg-[#090445] focus:outline-none"
            >
                Kirim
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[method="POST"]');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Loading...';
    });
});

document.getElementById('nim').addEventListener('input', function (e) {
    this.value = this.value.replace(/\D/g, ''); // Remove non-digits
});

document.getElementById('whatsapp').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, ''); // Remove all non-digit characters
});

function cleanWhatsApp(input) {
    let val = input.value;
    // Remove all non-digit characters
    val = val.replace(/\D/g, '');

    // Remove leading 0 or 62
    if (val.startsWith('0')) {
        val = val.slice(1);
    } else if (val.startsWith('62')) {
        val = val.slice(2);
    }

    input.value = val;
}
</script>
@endsection
