@section('script')
<script>
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
    });
</script>
@endsection

<nav class="bg-[#1E3A8A] text-white shadow">
    <div class="w-full flex justify-between px-4 py-3">
        {{-- Brand name with line break --}}
        <a href="{{ route('landing.index') }}" class="block no-underline text-inherit">
            <div class="leading-tight">
                <div class="flex items-center gap-1 text-2xl font-bold">
                VoiceLib
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-white">
                    <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                    <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                </svg>
                </div>
                <div class="text-md font-bold">UPT Perpustakaan UM</div>
            </div>
        </a>
        <div class="space-x-8 text-sm sm:text-base font-bold flex items-center">
            <a href="{{ route('admin.guide') }}" 
            class="relative hidden sm:inline-block pb-1 border-b-3 border-transparent
                    {{ request()->routeIs('admin.guide') ? 'border-white' : 'hover:text-gray-300' }}">
                Panduan Admin
            </a>

            <a href="{{ route('admin.profile') }}" 
            class="relative hidden sm:inline-block pb-1 border-b-3 border-transparent
                    {{ request()->routeIs('admin.profile') ? 'border-white' : 'hover:text-gray-300' }}">
                {{ auth()->check() ? auth()->user()->name : 'Guest' }}
            </a>

            <form action="{{ route('auth.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="relative hidden sm:inline-flex hover:text-gray-300 items-center pb-1 bg-transparent border-none text-white hover:border-b-3 hover:border-white cursor-pointer font-bold text-sm sm:text-base">
                    Logout
                    <svg class="w-6 h-6 ml-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H4m12 0-4 4m4-4-4-4m3-4h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2"/>
                    </svg>
                </button>
            </form>
        </div>
        <button id="sidebarToggle" class="lg:hidden text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</nav>
