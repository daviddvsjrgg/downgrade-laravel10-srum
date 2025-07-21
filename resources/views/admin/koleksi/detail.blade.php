@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg p-8 space-y-6">
        <h2 class="text-2xl font-bold mb-6">Detail Koleksi</h2>
        {{-- Row 1 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Judul Tugas Akhir</label>
                <input type="text" value="{{ $collection->judul_tugas_akhir }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nama Penulis</label>
                <input type="text" value="{{ $collection->nama_penulis }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>
        </div>

        {{-- Row 2 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nama Pembimbing</label>
                <input type="text" value="{{ $collection->nama_pembimbing }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Program Studi</label>
                <input type="text" value="{{ $collection->program_studi }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>
        </div>

        {{-- Row 3 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Fakultas</label>
                <input type="text" value="{{ $collection->fakultas }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Tahun Terbit</label>
                <input type="text" value="{{ $collection->tahun_terbit }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>
        </div>

        {{-- Row 4 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Nomor Registrasi</label>
                <input type="text" value="{{ $collection->nomer_reg }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Kata Kunci</label>
                <input type="text" value="{{ $collection->kata_kunci }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>
        </div>

        {{-- Row 5 --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Tanggal Unggah</label>
                <input type="text" value="{{ $collection->tanggal_unggah?->format('Y-m-d') }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-end md:space-x-4">
                <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap">Status</label>
                <input type="text" value="{{ $collection->status }}" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">
            </div>
        </div>

        {{-- Abstrak --}}
        <div class="flex flex-col md:flex-row md:items-start md:justify-end md:space-x-4">
            <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap pt-2">Abstrak (Indonesia)</label>
            <textarea rows="4" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">{{ $collection->abstrak_indo }}</textarea>
        </div>

        <div class="flex flex-col md:flex-row md:items-start md:justify-end md:space-x-4">
            <label class="font-medium md:text-right w-full md:w-48 whitespace-nowrap pt-2">Abstrak (English)</label>
            <textarea rows="4" readonly class="border border-gray-300 rounded px-3 py-2 bg-gray-100 flex-grow">{{ $collection->abstrak_eng }}</textarea>
        </div>
        <div class="flex justify-end space-x-4 pt-6">
            <a href="{{ route('admin.koleksi.index') }}" class="px-6 py-2 border rounded border-gray-400 hover:bg-gray-100">Kembali</a>
        </div>
    </div>
</div>
@endsection
