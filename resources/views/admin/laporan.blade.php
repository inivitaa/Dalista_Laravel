@extends('admin.layout')

@section('content')

    <div class="px-10 py-6">
        <div>
            <div class="flex items-center justify-between mb-8">

                <!-- KIRI -->
                <div>

                    <h1 class="text-5xl font-bold text-gray-800">
                        Laporan & Analitik
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Dashboard analitik DALISTA
                    </p>

                </div>

                <!-- KANAN -->
                <div class="flex items-center gap-4">

                    <select class="border rounded-2xl px-6 py-4 shadow-sm">

                        <option>7 Hari Terakhir</option>
                        <option>30 Hari Terakhir</option>
                        <option>90 Hari Terakhir</option>       

                    </select>

                    <!-- FILTER BIDANG -->
                    <select class="border rounded-2xl px-6 py-4 shadow-sm bg-white">

                        <option>Semua Bidang</option>

                        <option>Konsultasi Layanan</option>
                        <option>Pengaduan/Keluhan</option>
                        <option>Pengajuan Permohonan</option>
                        <option>Mencari Informasi</option>
                        <option>Survey/Penelitian</option>
                        <option>Layanan Terpadu</option>
                        <option>Meeting</option>
                        <option>Lainnya</option>

                    </select>

                    <button class="bg-green-500 hover:bg-green-600 text-white font-bold px-8 py-4 rounded-2xl shadow">

                        Export PDF

                    </button>

                </div>

            </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-4 mb-8">

                <!-- TOTAL KUNJUNGAN -->
                <div class="bg-white rounded-3xl p-4 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-400 mb-2">
                                Total Kunjungan
                            </p>

                            <h2 class="text-2xl font-bold text-gray-800">

                                {{ $totalKunjungan }}

                            </h2>

                            <p class="text-sm text-red-400 mt-2">
                                ↓ Data kunjungan tamu
                            </p>

                        </div>

                        <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">

                            👥

                        </div>

                    </div>

                </div>

                <!-- RERATA -->
                <div class="bg-white rounded-3xl p-4 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-400 mb-2">
                                Rerata Tamu Harian
                            </p>

                            <h2 class="text-2xl font-bold text-gray-800">

                                {{ $rerataHarian }}

                            </h2>

                            <p class="text-sm text-orange-400 mt-2">
                                ↑ Statistik harian
                            </p>

                        </div>

                        <div class="w-12 h-12 bg-orange-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">

                            📈

                        </div>

                    </div>

                </div>

                <!-- WAKTU -->
                <div class="bg-white rounded-3xl p-4 shadow">

                    <div class="flex items-center justify-between">

                        <div>

                            <p class="text-gray-400 mb-2">
                                Waktu Rata-rata
                            </p>

                            <h2 class="text-2xl font-bold text-gray-800">

                                {{ $waktuRata }}

                            </h2>

                            <p class="text-sm text-green-400 mt-2">
                                ⏱️ Durasi kunjungan
                            </p>

                        </div>

                        <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center text-white text-lg shadow-lg">

                            🕒

                        </div>

                    </div>

                </div>

            </div>
        </div>


    </div>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

        <!-- TOTAL TAMU -->
        <div class="bg-white rounded-3xl p-4 shadow">

            <p class="text-gray-400 mb-2">
                Total Tamu
            </p>

            <h2 class="text-4xl font-bold text-blue-600">

                {{ $totalTamu }}

            </h2>

        </div>

        <!-- TOTAL SURVEY -->
        <div class="bg-white rounded-3xl p-4 shadow">

            <p class="text-gray-400 mb-2">
                Total Survey
            </p>

            <h2 class="text-4xl font-bold text-green-500">

                {{ $totalSurvey }}

            </h2>

        </div>

        <!-- RATING -->
        <div class="bg-white rounded-3xl p-4 shadow">

            <p class="text-gray-400 mb-2">
                Rating Rata-rata
            </p>

            <h2 class="text-4xl font-bold text-yellow-500">

                ⭐ {{ $avgRating }}

            </h2>

        </div>

        <!-- LAYANAN -->
        <div class="bg-white rounded-3xl p-4 shadow">

            <p class="text-gray-400 mb-2">
                Layanan Terbanyak
            </p>

            <h2 class="text-2xl font-bold text-purple-500">

                {{ $layananTerbanyak->layanan_diakses ?? '-' }}

            </h2>

        </div>

    </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-4">

    <!-- CHART KUNJUNGAN -->
    <div class="bg-white rounded-3xl p-4 shadow">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Grafik Survey
        </h2>

        <div class="h-80">

            <canvas id="surveyChart"></canvas>

        </div>

    </div>

    <!-- PIE CHART -->
    <div class="bg-white rounded-3xl p-4 shadow">

            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                Jenis Layanan
            </h2>

            <div class="h-80">

                <canvas id="layananChart"></canvas>

            </div>

        </div>

    </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>

        const surveyCtx = document
            .getElementById('surveyChart');

        new Chart(surveyCtx, {

            type: 'bar',

            data: {

                labels: [

                    'Buruk',

                    'Kurang',

                    'Cukup',

                    'Puas',

                    'Hebat'

                ],

                datasets: [{

                    label: 'Jumlah Survey',

                    data: [

                        {{ $surveys->where('rating',1)->count() }},

                        {{ $surveys->where('rating',2)->count() }},

                        {{ $surveys->where('rating',3)->count() }},

                        {{ $surveys->where('rating',4)->count() }},

                        {{ $surveys->where('rating',5)->count() }}

                    ],

                    backgroundColor: [

                        '#ef4444',

                        '#f97316',

                        '#eab308',

                        '#22c55e',

                        '#3b82f6'

                    ],

                    borderRadius: 12

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,
                plugins: {

                    legend: {

                        display: true

                    }

                },
                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {
                            stepSize: 1,
                            precision: 0

                        }

                    }

                }
            }

        });

        const layananCtx = document
            .getElementById('layananChart');

        new Chart(layananCtx, {

            type: 'bar',

            data: {

                labels: [

                    'Konsultasi',

                    'Pengaduan',

                    'Permohonan',

                    'Informasi',

                    'Survey',

                    'Terpadu',

                    'Meeting',

                    'Lainnya'

                ],

                datasets: [{

                    label: 'Jumlah Layanan',

                    data: [

                        {{ $surveys->where('layanan_diakses','Konsultasi Layanan')->count() }},

                        {{ $surveys->where('layanan_diakses','Pengaduan/Keluhan')->count() }},

                        {{ $surveys->where('layanan_diakses','Pengajuan Permohonan')->count() }},

                        {{ $surveys->where('layanan_diakses','Mencari Informasi')->count() }},

                        {{ $surveys->where('layanan_diakses','Survey/Penelitian')->count() }},

                        {{ $surveys->where('layanan_diakses','Layanan Terpadu')->count() }},

                        {{ $surveys->where('layanan_diakses','Meeting')->count() }},

                        {{ $surveys->where('layanan_diakses','Lainnya')->count() }}

                    ],

                    backgroundColor: [

                        '#3b82f6',

                        '#ef4444',

                        '#22c55e',

                        '#a855f7',

                        '#f59e0b',

                        '#14b8a6',

                        '#6366f1',

                        '#64748b'

                    ],

                    borderRadius: 10

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                indexAxis: 'y',

                plugins: {

                    legend: {

                        display: false

                    }

                },

                scales: {

                    x: {

                        beginAtZero: true,

                        ticks: {
                            stepSize: 1,
                            precision: 0

                        }

                    }

                }

            }

        });

        </script>

</div>
</div>
@endsection