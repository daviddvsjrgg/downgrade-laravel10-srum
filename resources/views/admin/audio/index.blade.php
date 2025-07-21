@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
  <h1 class="text-2xl font-semibold text-[#06003F]">Data Audio</h1>
</div>
<form method="GET" id="searchForm" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0">
  <div class="relative w-full md:w-1/2">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
      </svg>
    </span>
    <input
      id="searchInput"
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Cari Judul atau Nomor Registrasi..."
      class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
    >
  </div>

  <select
    id="sortSelect"
    name="sort"
    class="px-2 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-auto"
  >
    <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
    <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Urutkan: Terlama</option>
    <option value="judul_asc" {{ request('sort') == 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
    <option value="judul_desc" {{ request('sort') == 'judul_desc' ? 'selected' : '' }}>Judul Z-A</option>
    <option value="bahasa_asc" {{ request('sort') == 'bahasa_asc' ? 'selected' : '' }}>Bahasa A-Z</option>
    <option value="bahasa_desc" {{ request('sort') == 'bahasa_desc' ? 'selected' : '' }}>Bahasa Z-A</option>
    <option value="durasi_asc" {{ request('sort') == 'durasi_asc' ? 'selected' : '' }}>Durasi Terpendek</option>
    <option value="durasi_desc" {{ request('sort') == 'durasi_desc' ? 'selected' : '' }}>Durasi Terpanjang</option>
    <option value="format_asc" {{ request('sort') == 'format_asc' ? 'selected' : '' }}>Format A-Z</option>
    <option value="format_desc" {{ request('sort') == 'format_desc' ? 'selected' : '' }}>Format Z-A</option>
  </select>

  <button
    type="button"
    id="sortButton"
    class="p-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition cursor-pointer"
  >
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
            d="M3 9h11M3 15h7M3 3h16m-.5 18V9m0 12c-.7 0-2.009-1.994-2.5-2.5m2.5 2.5c.7 0 2.009-1.994 2.5-2.5" />
    </svg>
  </button>
</form>

<h1 class="text-2xl font-semibold text-[#06003F] py-4 pt-8">Kelola Data Audio</h1>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">No.</th>
                <th scope="col" class="px-6 py-3">No Registrasi</th>
                <th scope="col" class="px-6 py-3">Judul Tugas Akhir/Karya</th>
                <th scope="col" class="px-6 py-3">Bahasa Audio</th>
                <th scope="col" class="px-6 py-3">Durasi</th>
                <th scope="col" class="px-6 py-3">Format</th>
                <th scope="col" class="px-6 py-3">Tanggal Dibuat</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($audios as $index => $audio)
                <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $audios->firstItem() + $index }}</td>
                    <td class="px-6 py-4">{{ $audio->collection->nomer_reg ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $audio->collection->judul_tugas_akhir ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $audio->bahasa === "id-ID" ? "Indonesia" : "Inggris" }}</td>
                    <td class="px-6 py-4">{{ $audio->durasi }}</td>
                    <td class="px-6 py-4">{{ $audio->format === "LINEAR16" ? "WAV" : $audio->format }}</td>
                    <td class="px-6 py-4">{{ $audio->created_at ? $audio->created_at->format('Y-m-d') : '-' }}</td>
                    <td class="px-6 py-4 flex items-center space-x-4">
                        @if (!empty($audio->base64))
                           <audio controls class="max-w-xs">
                                <source src="data:audio/{{ strtolower($audio->format) }};base64,{{ $audio->base64 }}" 
                                        type="audio/{{ $audio->format === 'LINEAR16' ? 'wav' : strtolower($audio->format) }}">
                                Your browser does not support the audio element.
                            </audio>
                        @else
                            <span class="text-gray-500">No audio</span>
                        @endif

                        <form 
                            action="{{ route('admin.audio.destroy', $audio->id) }}" 
                            method="POST" 
                            class="delete-form"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="text-red-600 hover:text-red-800 cursor-pointer" 
                                title="Delete"
                            >
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 24 24" 
                                    fill="currentColor" 
                                    class="w-5 h-5"
                                >
                                    <path 
                                        fill-rule="evenodd" 
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" 
                                        clip-rule="evenodd" 
                                    />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="bg-white border-b border-gray-200">
                    <td colspan="8" class="px-6 py-4 text-center">Tidak ada data audio.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(method_exists($audios, 'links'))
<div class="mt-4 flex items-center justify-between text-sm text-gray-700">
    <div>
        Menampilkan <span class="font-semibold">{{ $audios->firstItem() }}</span> -
        <span class="font-semibold">{{ $audios->lastItem() }}</span> dari
        <span class="font-semibold">{{ $audios->total() }}</span> data
    </div>
    <div>
        {{ $audios->links('vendor.pagination.custom-tailwind') }}
    </div>
</div>
@endif

<script>
  document.getElementById('sortButton').addEventListener('click', function() {
    document.getElementById('searchForm').submit();
  });

  document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      document.getElementById('searchForm').submit();
    }
  });
</script>
@endsection

