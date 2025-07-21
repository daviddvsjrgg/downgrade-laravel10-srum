<nav class="space-y-2 text-white">
    <h2 class="text-lg font-semibold mb-4">Admin Menu</h2>

    <a href="{{ route('admin.dashboard') }}"
       class="flex items-center gap-2 px-2 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-[#1C1A6F]' : '' }} hover:bg-[#1C1A6F]">
        <span class="bg-white p-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-[#06003F]" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M13 9V3h8v6zM3 13V3h8v10zm10 8V11h8v10zM3 21v-6h8v6z" />
            </svg>
        </span>
        Dashboard
    </a>

    <a href="{{ route('admin.koleksi.index') }}"
       class="flex items-center gap-2 px-2 py-2 rounded {{ request()->routeIs('admin.koleksi.index') ? 'bg-[#1C1A6F]' : '' }} hover:bg-[#1C1A6F]">
        <span class="bg-white p-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-[#06003F]" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M12 11q3.75 0 6.375-1.175T21 7t-2.625-2.825T12 3T5.625 4.175T3 7t2.625 2.825T12 11m0 2.5q1.025 0 2.563-.213t2.962-.687t2.45-1.237T21 9.5V12q0 1.1-1.025 1.863t-2.45 1.237t-2.962.688T12 16t-2.562-.213t-2.963-.687t-2.45-1.237T3 12V9.5q0 1.1 1.025 1.863t2.45 1.237t2.963.688T12 13.5m0 5q1.025 0 2.563-.213t2.962-.687t2.45-1.237T21 14.5V17q0 1.1-1.025 1.863t-2.45 1.237t-2.962.688T12 21t-2.562-.213t-2.963-.687t-2.45-1.237T3 17v-2.5q0 1.1 1.025 1.863t2.45 1.237t2.963.688T12 18.5" />
            </svg>
        </span>
        Kelola Data Koleksi
    </a>

    <a href="{{ route('admin.audio.index') }}"
       class="flex items-center gap-2 px-2 py-2 rounded {{ request()->routeIs('admin.audio.index') ? 'bg-[#1C1A6F]' : '' }} hover:bg-[#1C1A6F]">
        <span class="bg-white p-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-[#06003F]" width="24" height="24" viewBox="0 0 24 24">
                <path fill="currentColor" d="M10.75 19q.95 0 1.6-.65t.65-1.6V13h3v-2h-4v3.875q-.275-.2-.587-.288t-.663-.087q-.95 0-1.6.65t-.65 1.6t.65 1.6t1.6.65M4 22V2h10l6 6v14zm9-13h5l-5-5z" />
            </svg>
        </span>
        Data Audio
    </a>

    {{-- <a href="{{ route('admin.mahasiswa') }}"
       class="flex items-center gap-2 px-2 py-2 rounded {{ request()->routeIs('admin.mahasiswa') ? 'bg-[#1C1A6F]' : '' }} hover:bg-[#1C1A6F]">
        <span class="bg-white p-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-[#06003F]" width="24" height="24" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="m19 5l-7-3l-7 3l3.5 1.5v2S9.667 8 12 8s3.5.5 3.5.5v-2zm0 0v4m-3.5-.5v1a3.5 3.5 0 1 1-7 0v-1m-.717 8.203c-1.1.685-3.986 2.082-2.229 3.831C6.413 21.39 7.37 22 8.571 22h6.858c1.202 0 2.158-.611 3.017-1.466c1.757-1.749-1.128-3.146-2.229-3.83a7.99 7.99 0 0 0-8.434 0"
                      color="currentColor" />
            </svg>
        </span>
        Data Mahasiswa
    </a> --}}

    <a href="{{ route('admin.permintaan.index') }}"
       class="flex items-center gap-2 px-2 py-2 rounded {{ request()->routeIs('admin.permintaan.index') ? 'bg-[#1C1A6F]' : '' }} hover:bg-[#1C1A6F]">
        <span class="bg-white p-1 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-[#06003F]" width="24" height="24" viewBox="0 0 24 24">
                <g fill="currentColor" fill-rule="evenodd" clip-rule="evenodd">
                    <path d="M11.32 6.176H5c-1.105 0-2 .949-2 2.118v10.588C3 20.052 3.895 21 5 21h11c1.105 0 2-.948 2-2.118v-7.75l-3.914 4.144A2.46 2.46 0 0 1 12.81 16l-2.681.568c-1.75.37-3.292-1.263-2.942-3.115l.536-2.839c.097-.512.335-.983.684-1.352z" />
                    <path d="M19.846 4.318a2.2 2.2 0 0 0-.437-.692a2 2 0 0 0-.654-.463a1.92 1.92 0 0 0-1.544 0a2 2 0 0 0-.654.463l-.546.578l2.852 3.02l.546-.579a2.1 2.1 0 0 0 .437-.692a2.24 2.24 0 0 0 0-1.635M17.45 8.721L14.597 5.7L9.82 10.76a.54.54 0 0 0-.137.27l-.536 2.84c-.07.37.239.696.588.622l2.682-.567a.5.5 0 0 0 .255-.145l4.778-5.06Z" />
                </g>
            </svg>
        </span>
        Permintaan Full Akses
    </a>
</nav>
