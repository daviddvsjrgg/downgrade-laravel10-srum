@extends('layouts.admin.app')

@section('title', $title)

@section('content')
<div class="p-6 space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>

    <!-- Ringkasan Data Card -->
    <div class="bg-white shadow rounded-2xl p-6">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Ringkasan Data</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="flex items-center p-4 bg-blue-100 rounded-xl">
                <div class="text-blue-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Koleksi Abstrak Skripsi (Teks)</p>
                    <p class="text-lg font-bold text-gray-800">{{ $textCollectionsCount }}</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-green-100 rounded-xl">
                <div class="text-green-600 mr-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 19V6l12-2v13" /></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Koleksi Abstrak Skripsi (Audio)</p>
                    <p class="text-lg font-bold text-gray-800">{{ $audioCollectionsCount }}</p>
                </div>
            </div>

            <div class="flex items-center p-4 bg-yellow-100 rounded-xl">
                <div class="text-yellow-600 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Permintaan Tertunda</p>
                    <p class="text-lg font-bold text-gray-800">{{ $pendingRequestsCount }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Konversi Card -->
    <div class="bg-white shadow rounded-2xl p-6">
        @php
            $currentRange = request('range', 7);
        @endphp
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Aktivitas Konversi Audio {{ $currentRange }} Hari Terakhir</h2>
        <div class="flex gap-2 mb-4">
            <a href="?range=7" class="px-4 py-2 rounded-lg text-sm font-medium {{ $currentRange == 7 ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                7 Hari
            </a>
            <a href="?range=30" class="px-4 py-2 rounded-lg text-sm font-medium {{ $currentRange == 30 ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700' }}">
                30 Hari
            </a>
        </div>

        <!-- Line Chart -->
        <div class="w-full">
            <canvas id="conversionChart" height="100"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const conversionLabels = @json($conversionData->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M')));
    const conversionCounts = @json($conversionData->pluck('total'));

    const ctx = document.getElementById('conversionChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: conversionLabels,
            datasets: [{
                label: 'Konversi per Hari',
                data: conversionCounts,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#fff',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

@endsection
