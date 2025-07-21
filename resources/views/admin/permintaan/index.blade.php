@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
  <h1 class="text-2xl font-semibold text-[#06003F]">Data Permintaan Audio</h1>
</div>

<form method="GET" id="searchForm" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 mb-4">
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
      placeholder="Cari ..."
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
    <option value="status_asc" {{ request('sort') == 'status_asc' ? 'selected' : '' }}>Status Belum Dikirm</option>
    <option value="status_desc" {{ request('sort') == 'status_desc' ? 'selected' : '' }}>Status Terkirim</option>
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


<h1 class="text-2xl font-semibold text-[#06003F] py-4 pt-8">Kelola Permintaan</h1>

<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th class="px-6 py-3">No</th>
                <th class="px-6 py-3">Tgl. Permintaan</th>
                <th class="px-6 py-3">NIM</th>
                <th class="px-6 py-3">Nama Madif</th>
                <th class="px-6 py-3">Judul Tugas Akhir</th>
                <th class="px-6 py-3">Prodi/Fakultas</th>
                <th class="px-6 py-3">Nomor WhatsApp</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($audios as $index => $item)
                @php
                    $audio = $item->audio;
                    $collection = $audio?->collection;
                @endphp
                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="px-6 py-4">{{ $audios->firstItem() + $index }}</td>
                    <td class="px-6 py-4">{{ $item->created_at->locale('id')->translatedFormat('d F Y') ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $item->nim }}</td>
                    <td class="px-6 py-4">{{ $item->nama }}</td>
                    <td class="px-6 py-4">{{ $collection->judul_tugas_akhir ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $item->prodi }}</td>
                    <td class="px-6 py-4">{{ $item->whatsapp }}</td>
                    <td class="px-6 py-4 align-middle">
                        @php
                            $status = $item->status ?? 'N/A';
                            $statusClass = match($status) {
                                'Terkirim' => 'bg-green-100 text-green-800 border border-green-400',
                                default => 'bg-gray-100 text-gray-800 border border-gray-400',
                            };
                        @endphp

                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap {{ $statusClass }}">
                            {{ ucfirst($status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 flex items-center">
                        @if ($item)
                            <input 
                            type="checkbox" 
                            id="sentCheckbox{{ $item->id }}" 
                            class="sent-checkbox cursor-pointer"
                            data-item-id="{{ $item->id }}"
                            {{ (strtolower($item->status ?? '') === 'terkirim') ? 'checked' : '' }}
                            style="width: 24px; height: 24px;"
                            >
                        @else
                            <span class="text-gray-400 italic">Tidak ada status</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center py-4">Tidak ada data permintaan.</td>
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
  document.getElementById('sortButton').addEventListener('click', function () {
    document.getElementById('searchForm').submit();
  });

  document.getElementById('searchInput').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
      e.preventDefault(); // prevent default to avoid double submit
      document.getElementById('searchForm').submit();
    }
  });
</script>

<script>
    document.querySelectorAll('.sent-checkbox').forEach(checkbox => {
  checkbox.addEventListener('change', function() {
    if (this.checked) {
      const itemId = this.dataset.itemId;
      const row = this.closest('tr');
      const nama = row.querySelector('td:nth-child(4)').innerText.trim();
      const whatsapp = row.querySelector('td:nth-child(7)').innerText.trim();

      Swal.fire({
        title: 'Anda yakin sudah mengirim link akses full teks ke nomor WhatsApp ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak',
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            // Update status via API
            const response = await fetch(`/admin/permintaan/${itemId}`, {
              method: 'PATCH',
              headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
              },
              body: JSON.stringify({ status: 'Terkirim' })
            });

            if (!response.ok) {
              throw new Error('Gagal memperbarui status.');
            }

            // Open WhatsApp link with prefilled message
            const message = encodeURIComponent(`Halo kak ${nama}, berikut teks fullnya`);
            const waNumber = whatsapp.replace(/\D/g, ''); // remove non-digit characters for WhatsApp
            window.open(`https://wa.me/${waNumber}?text=${message}`, '_blank');

            // Optionally update status label on page (you can refresh or just update UI)
            const statusSpan = row.querySelector('td:nth-child(8) span');
            statusSpan.textContent = 'Terkirim';
            statusSpan.className = 'inline-block px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap bg-green-100 text-green-800 border border-green-400';

            Swal.fire('Berhasil!', 'Status sudah diperbarui dan WhatsApp terbuka.', 'success');

          } catch (error) {
            Swal.fire('Error', error.message, 'error');
            this.checked = false; // revert checkbox on failure
          }
        } else {
          this.checked = false; // revert checkbox if canceled
        }
      });
    }
  });
});

</script>

@endsection
