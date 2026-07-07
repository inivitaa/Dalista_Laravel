@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')

<!-- HEADER -->
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-4xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-500 mt-2">Ringkasan aktivitas dan data kunjungan tamu</p>
    </div>
    <button onclick="location.reload()" class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-3 rounded-2xl transition shadow">
        ↻ Refresh Data
    </button>
</div>

<!-- WELCOME CARD -->
<div 
class="bg-gradient-to-r bg-gradient-to-r from-slate-800 to-slate-700 rounded-3xl p-8 mb-8 text-white shadow-lg">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-bold">Selamat Datang Admin Dalista 👋</h2>
            <p class="mt-3 text-slate-200 text-lg">Berikut ringkasan aktivitas dan kunjungan tamu hari ini.</p>
        </div>
        <div class="hidden md:flex w-20 h-20 bg-white/10 rounded-3xl items-center justify-center text-4xl backdrop-blur-sm">

    📊

</div>
    </div>
</div>

<!-- STATISTIK (Update: Sekarang 5 Kolom agar Rating SKM Muat) -->
<div class="grid md:grid-cols-5 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs">Total Tamu</p>
        <h2 class="text-4xl font-bold text-gray-800 mt-2">{{ $total }}</h2>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs text-yellow-600">Menunggu</p>
        <h2 class="text-4xl font-bold text-yellow-500 mt-2">{{ $menunggu }}</h2>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs text-blue-600">Terjadwal</p>
        <h2 class="text-4xl font-bold text-blue-500 mt-2">{{ $terjadwal }}</h2>
    </div>
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <p class="text-gray-400 text-xs text-green-600">Selesai</p>
        <h2 class="text-4xl font-bold text-green-500 mt-2">{{ $selesai }}</h2>
    </div>
    <!-- KOTAK RATING SKM BARU -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <p class="text-slate-400 text-xs font-bold uppercase">Rating SKM</p>
        <h2 class="text-4xl font-bold text-slate-700 mt-2">⭐ {{ $avgRating }}</h2>
    </div>
</div>

<!-- CHART -->
<div class="grid lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">
        <h3 class="text-2xl font-bold text-gray-800">Statistik Kunjungan</h3>
        <p class="text-gray-400 text-sm mt-1 mb-6">Jumlah tamu berdasarkan bulan</p>
        <div class="h-96"><canvas id="visitorChart"></canvas>
    </div>
</div>

<!-- PIE CHART -->
<div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 mb-8">
    <div class="flex items-center justify-between mb-6">

        <div>

            <h3 class="text-2xl font-bold text-gray-800">
                Status Kunjungan
            </h3>

            <p class="text-gray-400 text-sm mt-1">
                Statistik berdasarkan status tamu
            </p>

        </div>

    </div>

    <div class="h-96 flex items-center justify-center">

        <canvas id="statusChart"></canvas>

    </div>

</div>
</div>

<!-- GRID BAWAH -->
<div class="grid lg:grid-cols-3 gap-6">
    <!-- AKTIVITAS TERBARU -->
    <div class="lg:col-span-2 bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-sm transition">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Aktivitas Terbaru</h3>
        <div class="space-y-4">
            @foreach($recentGuests as $guest)
            <div class="flex items-center justify-between border border-gray-100 hover:shadow-sm transition rounded-2xl p-4">
                <div>
                    <h4 class="font-semibold text-gray-800">{{ $guest->nama }}</h4>
                    <p class="text-sm text-gray-400 mt-1">{{ $guest->keperluan }}</p>
                </div>
                <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($guest->waktu_dibuat)->diffForHumans() }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ULASAN SURVEY TERBARU (BARU) -->
    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-2xl font-bold text-gray-800 mb-6">Ulasan SKM</h3>
        <div class="space-y-4">
            @forelse($recentSurveys as $srv)
            <div class="bg-slate-50 rounded-2xl p-4 border border-gray-100">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-bold text-blue-600">{{ $srv->layanan_diakses }}</span>
                    <span class="text-xs text-slate-500 font-bold">⭐ {{ $srv->rating }}</span>
                </div>
                <p class="text-gray-600 text-sm italic">"{{ $srv->ulasan ?? 'Tidak ada ulasan teks' }}"</p>
                <p class="text-[10px] text-gray-400 mt-2">{{ $srv->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <p class="text-gray-400 text-center py-10">Belum ada ulasan masuk</p>
            @endforelse
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. GRAFIK KUNJUNGAN WEBSITE (LINE CHART)
    const ctx = document.getElementById('visitorChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{
                label: 'Total Visitor', // Mengubah label
                data: @json($visitorCounts), // Menggunakan data visitorCounts dari backend baru
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: { 
                legend: { 
                    display: false 
                } 
            }
        }
    });

    // 2. GRAFIK PERANGKAT PENGUNJUNG (DOUGHNUT CHART)
    // Mengubah id target canvas ke 'deviceChart' sesuai elemen HTML yang baru
    const deviceCtx = document.getElementById('deviceChart');

    new Chart(deviceCtx, {
        type: 'doughnut',
        data: {
            labels: [
                'Desktop',
                'Mobile',
                'Tablet'
            ], // Mengubah kategori status tamu manual menjadi tipe perangkat
            datasets: [{
                data: @json($deviceCounts), // Menggunakan data deviceCounts dari backend baru
                backgroundColor: [
                    '#3b82f6', // Biru untuk Desktop
                    '#22c55e', // Hijau untuk Mobile
                    '#facc15'  // Kuning untuk Tablet
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
</script>

@endsection