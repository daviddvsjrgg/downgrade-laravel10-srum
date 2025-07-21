@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
  <h1 class="text-2xl font-semibold text-[#06003F]">Data Koleksi Abstrak</h1>
  <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
    <!-- Tambah Data Button -->
    <a href="{{ route('admin.koleksi.create') }}"
       class="px-4 py-2 text-white rounded-lg shadow hover:opacity-90 transition bg-[#090445] text-center">
      + Tambah Data Baru
    </a>

    <!-- Import Data Button with Icon -->
    <a href="{{ route('admin.koleksi.show.import') }}"
       class="flex items-center justify-center px-4 py-2 bg-white border border-gray-400 text-black rounded-lg shadow hover:bg-gray-100 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 50 50">
        <path d="M 28.875 0 C 28.855469 0.0078125 28.832031 0.0195313 28.8125 0.03125 L 0.8125 5.34375 C 0.335938 5.433594 -0.0078125 5.855469 0 6.34375 L 0 43.65625 C -0.0078125 44.144531 0.335938 44.566406 0.8125 44.65625 L 28.8125 49.96875 C 29.101563 50.023438 29.402344 49.949219 29.632813 49.761719 C 29.859375 49.574219 29.996094 49.296875 30 49 L 30 44 L 47 44 C 48.09375 44 49 43.09375 49 42 L 49 8 C 49 6.90625 48.09375 6 47 6 L 30 6 L 30 1 C 30.003906 0.710938 29.878906 0.4375 29.664063 0.246094 C 29.449219 0.0546875 29.160156 -0.0351563 28.875 0 Z M 28 2.1875 L 28 6.53125 C 27.867188 6.808594 27.867188 7.128906 28 7.40625 L 28 42.8125 C 27.972656 42.945313 27.972656 43.085938 28 43.21875 L 28 47.8125 L 2 42.84375 L 2 7.15625 Z M 30 8 L 47 8 L 47 42 L 30 42 L 30 37 L 34 37 L 34 35 L 30 35 L 30 29 L 34 29 L 34 27 L 30 27 L 30 22 L 34 22 L 34 20 L 30 20 L 30 15 L 34 15 L 34 13 L 30 13 Z M 36 13 L 36 15 L 44 15 L 44 13 Z M 6.6875 15.6875 L 12.15625 25.03125 L 6.1875 34.375 L 11.1875 34.375 L 14.4375 28.34375 C 14.664063 27.761719 14.8125 27.316406 14.875 27.03125 L 14.90625 27.03125 C 15.035156 27.640625 15.160156 28.054688 15.28125 28.28125 L 18.53125 34.375 L 23.5 34.375 L 17.75 24.9375 L 23.34375 15.6875 L 18.65625 15.6875 L 15.6875 21.21875 C 15.402344 21.941406 15.199219 22.511719 15.09375 22.875 L 15.0625 22.875 C 14.898438 22.265625 14.710938 21.722656 14.5 21.28125 L 11.8125 15.6875 Z M 36 20 L 36 22 L 44 22 L 44 20 Z M 36 27 L 36 29 L 44 29 L 44 27 Z M 36 35 L 36 37 L 44 37 L 44 35 Z"></path>
      </svg>
      Import Data
    </a>
  </div>
</div>

<form method="GET" id="searchForm" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0">
  <!-- Search Input (optional, keep if needed) -->
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
      placeholder="Cari..."
      class="pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full"
    >
  </div>

  <!-- Sort select (no onchange) -->
  <select
    id="sortSelect"
    name="sort"
    class="px-2 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-full sm:w-auto"
  >
    <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Urutkan: Terbaru</option>
    <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Urutkan: Terlama</option>
    <option value="judul_asc" {{ request('sort') === 'judul_asc' ? 'selected' : '' }}>Judul A-Z</option>
    <option value="judul_desc" {{ request('sort') === 'judul_desc' ? 'selected' : '' }}>Judul Z-A</option>
    <option value="tahun_terbit_desc" {{ request('sort') === 'tahun_terbit_desc' ? 'selected' : '' }}>Tahun Terbit Terbaru</option>
    <option value="tahun_terbit_asc" {{ request('sort') === 'tahun_terbit_asc' ? 'selected' : '' }}>Tahun Terbit Terlama</option>
    <option value="status_desc" {{ request('sort') === 'status_desc' ? 'selected' : '' }}>Status: Tersedia</option>
    <option value="status_asc" {{ request('sort') === 'status_asc' ? 'selected' : '' }}>Status: Belum Tersedia</option>
  </select>

  <!-- Submit sort manually on button click -->
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

{{-- Table --}}
<h1 class="text-2xl font-semibold text-[#06003F] py-4 pt-8">Kelola Data Koleksi</h1>
<div class="relative overflow-x-auto">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">No.</th>
                <th scope="col" class="px-6 py-3">Judul Tugas Akhir</th>
                <th scope="col" class="px-6 py-3">Nama Penulis</th>
                <th scope="col" class="px-6 py-3">Nama Pembimbing</th>
                <th scope="col" class="px-6 py-3">Program Studi</th>
                <th scope="col" class="px-6 py-3">Fakultas</th>
                <th scope="col" class="px-6 py-3">Tahun Terbit</th>
                <th scope="col" class="px-6 py-3">Tanggal Unggah</th> <!-- New Upload Date header -->
                <th scope="col" class="px-6 py-3">Detail</th>
                <th scope="col" class="px-6 py-3">Aksi</th>
                <th scope="col" class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($collections as $index => $collection)
            <tr class="bg-white border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-4">{{ $collections->firstItem() + $index }}</td>
                <td class="px-6 py-4">{{ $collection->judul_tugas_akhir }}</td>
                <td class="px-6 py-4">{{ $collection->nama_penulis }}</td>
                <td class="px-6 py-4">{{ $collection->nama_pembimbing }}</td>
                <td class="px-6 py-4">{{ $collection->program_studi }}</td>
                <td class="px-6 py-4">{{ $collection->fakultas }}</td>
                <td class="px-6 py-4">{{ $collection->tahun_terbit }}</td>
                <td class="px-6 py-4">{{ $collection->tanggal_unggah ? $collection->tanggal_unggah->format('Y-d-m') : '-' }}</td> <!-- Upload Date cell -->
                <td class="px-6 py-4">
                    <button
                        onclick="openModal({{ $collection->id }})"
                        class="inline-flex items-center px-3 py-1 border cursor-pointer border-gray-300 text-black bg-white rounded hover:bg-gray-100 transition"
                        title="Detail"
                        type="button"
                    >
                        <!-- Eye Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Detail
                    </button>
                </td>
                <td class="px-6 py-4">
                    <!-- Edit Button -->
                    <div class="mb-2">
                        <a href="{{ route('admin.koleksi.edit', $collection->id) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                    </div>

                    <!-- Delete Button -->
                    <div class="py-1">
                        <form action="{{ route('admin.koleksi.destroy', $collection->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                            <button 
                                type="submit" 
                                class="text-red-600 hover:text-red-800 cursor-pointer" 
                                title="Delete"
                            >
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 24 24" 
                                    fill="currentColor" 
                                    class="size-5"
                                >
                                    <path 
                                        fill-rule="evenodd" 
                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" 
                                        clip-rule="evenodd" 
                                    />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @php
                        // Get existing audio bahasa codes for each collection, map to 'id' or 'en'
                        // (Assuming you are inside a loop where $collection is available)
                        $existingLanguages = \App\Models\Audio::where('collection_id', $collection->id)
                            ->pluck('bahasa')
                            ->map(function($lang) {
                                if ($lang === 'id-ID') return 'id';
                                if ($lang === 'en-US') return 'en';
                                return null;
                            })
                            ->filter()
                            ->unique()
                            ->values()
                            ->all();
                    @endphp
                    <!-- Trigger Button -->
                    <div>
                        <a href="javascript:void(0)" 
                          onclick="openLangModal({{ $collection->id }}, '{{ addslashes($collection->judul_tugas_akhir) }}', {{ json_encode($existingLanguages) }})" 
                          title="Bahasa"
                          class="inline-flex items-center">
                          <!-- Your SVG icon -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.47 4.47a.75.75 0 0 1 1.06 0l2 2a.75.75 0 0 1 0 1.06l-2 2a.75.75 0 1 1-1.06-1.06l.72-.72h-1.793c-.844 0-1.424 0-1.88.045c-.44.043-.706.122-.927.247c-.22.125-.426.313-.689.668c-.272.368-.572.865-1.006 1.589l-2.523 4.205c-.41.685-.747 1.245-1.068 1.679c-.335.453-.688.816-1.155 1.08s-.96.38-1.52.435c-.538.052-1.191.052-1.99.052H2a.75.75 0 0 1 0-1.5h3.603c.844 0 1.424 0 1.88-.045c.44-.043.706-.122.927-.247c.22-.125.426-.313.689-.668c.272-.368.571-.865 1.006-1.589l2.523-4.205c.41-.685.747-1.245 1.068-1.679c.335-.453.688-.816 1.155-1.08s.96-.38 1.52-.435c.538-.052 1.191-.052 1.99-.052h1.828l-.72-.72a.75.75 0 0 1 0-1.06M7.73 7.79c-.196-.038-.418-.041-1.063-.041H2a.75.75 0 0 1 0-1.5h4.74c.546 0 .922 0 1.278.07a3.75 3.75 0 0 1 2.071 1.172c.243.27.436.592.717 1.06l.037.062a.75.75 0 1 1-1.286.772c-.332-.554-.45-.742-.583-.89a2.25 2.25 0 0 0-1.243-.705m5.683 6.566a.75.75 0 0 1 1.03.257c.331.554.448.742.582.89c.327.364.763.611 1.243.705c.196.038.418.041 1.063.041h2.857l-.72-.72a.75.75 0 1 1 1.061-1.06l2 2a.75.75 0 0 1 0 1.06l-2 2a.75.75 0 1 1-1.06-1.06l.72-.72h-2.931c-.545 0-.92 0-1.277-.07a3.75 3.75 0 0 1-2.071-1.172c-.243-.27-.436-.592-.717-1.06l-.037-.062a.75.75 0 0 1 .257-1.03"/>
                          </svg>
                        </a>
                    </div>
                </td>
                <td class="px-6 py-4 align-middle">
                    @php
                        $status = $collection->status ?? 'N/A';
                        $statusClass = match($status) {
                            'Tersedia' => 'bg-green-100 text-green-800 border border-green-400',
                            default => 'bg-gray-100 text-gray-800 border border-gray-400',
                        };
                    @endphp

                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full whitespace-nowrap {{ $statusClass }}">
                        {{ ucfirst($status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

<div class="mt-4 flex items-center justify-between text-sm text-gray-700">
    <!-- Left: Showing items summary -->
    <div>
        Menampilkan <span class="font-semibold">{{ $collections->firstItem() }}</span> -
        <span class="font-semibold">{{ $collections->lastItem() }}</span> dari
        <span class="font-semibold">{{ $collections->total() }}</span> data
    </div>

    <!-- Right: Pagination links -->
    <div>
        {{ $collections->links('vendor.pagination.custom-tailwind') }}
    </div>
</div>

{{-- Modal --}}
@foreach ($collections as $collection)
    <x-collection-detail-modal :collection="$collection" />
@endforeach

<!-- Modal -->
<div id="langModal" class="hidden fixed inset-0 z-50 bg-black/40 flex items-center justify-center" onclick="closeLangModal(event)">
  <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md" onclick="event.stopPropagation()">
    <div class="flex justify-between items-center mb-6">
      <h3 class="text-xl font-semibold">
        Pilih Teks Untuk Aih Media<br />
        <span id="collectionTitle" class="text-sm text-gray-500 hidden"></span>
      </h3>
      <button onclick="closeLangModal()" class="text-gray-500 hover:text-gray-700 text-2xl leading-none font-bold">&times;</button>
    </div>
    <form id="langForm">
      <input type="hidden" name="collection_id" id="hiddenCollectionId" value="" />
      <div class="space-y-5">
       <!-- Bahasa Indonesia -->
        <label class="flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" data-language="id" class="lang-checkbox form-checkbox h-5 w-5 text-[#090445] rounded focus:ring-[#090445]" />
            <span class="text-sm font-medium text-gray-700">Bahasa Indonesia</span>
        </label>

        <!-- Bahasa Inggris -->
        <label class="flex items-center space-x-3 cursor-pointer">
            <input type="checkbox" data-language="en" class="lang-checkbox form-checkbox h-5 w-5 text-[#090445] rounded focus:ring-[#090445]" />
            <span class="text-sm font-medium text-gray-700">Bahasa Inggris</span>
        </label>
      </div>
    </form>
  </div>
</div>

<!-- JS -->
<script>
  function openLangModal(collectionId, collectionTitle, existingLanguages = []) {
    // Show modal
    const modal = document.getElementById("langModal");
    modal.classList.remove("hidden");

    // Set collection title and hidden input value
    const titleElem = document.getElementById("collectionTitle");
    titleElem.textContent = collectionTitle || "";
    titleElem.classList.remove("hidden");
    document.getElementById("hiddenCollectionId").value = collectionId || "";

    // Uncheck all checkboxes first
    document.querySelectorAll('.lang-checkbox').forEach(cb => cb.checked = false);

    // Check checkboxes for existing languages
    existingLanguages.forEach(lang => {
      const checkbox = document.querySelector(`.lang-checkbox[data-language="${lang}"]`);
      if (checkbox) checkbox.checked = true;
    });
  }

  function closeLangModal(event) {
    const modal = document.getElementById("langModal");
    if (!event || event.target === modal) {
      modal.classList.add("hidden");
    }
  }

  document.querySelectorAll('.lang-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
      if (this.checked) {
        const selectedLanguage = this.dataset.language;
        const collectionId = document.getElementById("hiddenCollectionId").value;

        if (selectedLanguage && collectionId) {
          const url = `/admin/audio/by-koleksi/create/${collectionId}?language=${selectedLanguage}`;
          window.location.href = url;
        }
      }
    });
  });
</script>

<script>
    function openModal(id) {
        document.getElementById(`modal-${id}`).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(`modal-${id}`).classList.add('hidden');
    }
</script>

<script>
    document.getElementById('sortButton').addEventListener('click', function () {
        document.getElementById('searchForm').submit();
    });
</script>

@endsection
