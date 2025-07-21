@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Tambah Koleksi</h2>

    <div class="bg-white shadow-md rounded-lg p-8">
        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.koleksi.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Row 1: Judul Tugas Akhir + Nama Penulis --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="judul_tugas_akhir" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Judul Tugas Akhir</label>
                    <input type="text" id="judul_tugas_akhir" name="judul_tugas_akhir" value="{{ old('judul_tugas_akhir') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="nama_penulis" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nama Penulis</label>
                    <input type="text" id="nama_penulis" name="nama_penulis" value="{{ old('nama_penulis') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>
            </div>

            {{-- Row 2: Nama Pembimbing + Program Studi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="nama_pembimbing" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nama Pembimbing</label>
                    <input type="text" id="nama_pembimbing" name="nama_pembimbing" value="{{ old('nama_pembimbing') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="program_studi" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Program Studi</label>
                    <input type="text" id="program_studi" name="program_studi" value="{{ old('program_studi') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>
            </div>

            {{-- Row 3: Fakultas + Tahun Terbit --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="fakultas" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Fakultas</label>
                    <input type="text" id="fakultas" name="fakultas" value="{{ old('fakultas') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="tahun_terbit" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Tahun Terbit</label>
                    <input type="number" id="tahun_terbit" name="tahun_terbit" min="1900" max="2099" step="1" value="{{ old('tahun_terbit') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>
            </div>

            {{-- Row 4: Nomor Registrasi + Kata Kunci --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="nomer_reg" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nomor Registrasi</label>
                    <input type="text" id="nomer_reg" name="nomer_reg" value="{{ old('nomer_reg') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>

                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="kata_kunci" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Kata Kunci</label>
                    <input type="text" id="kata_kunci" name="kata_kunci" value="{{ old('kata_kunci') }}" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>
            </div>

            {{-- Row 5: Tanggal Unggah + Status --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                <div class="invisible flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                    <label for="tanggal_unggah" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Tanggal Unggah</label>
                    <input 
                        type="date" 
                        id="tanggal_unggah" 
                        name="tanggal_unggah" 
                        value="{{ old('tanggal_unggah') }}" 
                        class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4 space-y-1 md:space-y-0 invisible">
                    <label for="status" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Status</label>
                    <select id="status" name="status" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">
                        <option value="Belum Tersedia" {{ old('status') == 'Belum Tersedia' ? 'selected' : '' }}>Belum Tersedia</option>
                        <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    </select>
                </div>
            </div>


            {{-- Full width textareas --}}
            <div class="flex flex-col md:flex-row md:items-start md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                <label for="abstrak_indo" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap pt-2">Abstrak (Indonesia)</label>
                <textarea id="abstrak_indo" name="abstrak_indo" rows="4" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">{{ old('abstrak_indo') }}</textarea>
            </div>

            <div class="flex flex-col md:flex-row md:items-start md:justify-end md:space-x-4 space-y-1 md:space-y-0">
                <label for="abstrak_eng" class="font-medium md:text-right w-full md:w-48 whitespace-nowrap pt-2">Abstrak (English)</label>
                <textarea id="abstrak_eng" name="abstrak_eng" rows="4" class="border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 flex-grow">{{ old('abstrak_eng') }}</textarea>
            </div>

            <div class="flex justify-end space-x-4 pt-6">
                <a href="{{ route('admin.koleksi.index') }}" class="px-6 py-2 border rounded border-gray-400 hover:bg-gray-100">Batal</a>
                <button type="submit" id="tambah-btn" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-800 cursor-pointer">Tambah Koleksi</button>
            </div>
        </form>
    </div>
</div>
@endsection
