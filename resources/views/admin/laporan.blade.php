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

                    <form method="GET">

                        <select
                            name="periode"
                            onchange="this.form.submit()"
                            class="border rounded-2xl px-5 py-4 shadow-sm">
                            <option value=""
                                {{ request()->filled('periode') ? '' : 'selected' }}>
                                Semua Waktu
                            </option>
                            <option value="7"
                                {{ request('periode') == 7 ? 'selected' : '' }}>
                                7 Hari Terakhir
                            </option>

                            <option value="30"
                                {{ request('periode') == 30 ? 'selected' : '' }}>
                                30 Hari Terakhir
                            </option>

                            <option value="90"
                                {{ request('periode') == 90 ? 'selected' : '' }}>
                                90 Hari Terakhir
                            </option>

                        </select>
                    <!-- FILTER BIDANG -->
                        <select
                            name="layanan"
                            onchange="this.form.submit()"
                            class="border rounded-2xl px-3 py-4 shadow-sm bg-white">

                            <option value="">Semua Layanan</option>

                            @foreach($layananUmum as $layanan)

                                <option
                                    value="{{ $layanan->nama_layanan }}"
                                    {{ request('layanan') == $layanan->nama_layanan ? 'selected' : '' }}>

                                    {{ $layanan->nama_layanan }}

                                </option>

                            @endforeach

                        </select>
                    </form>

                    <a href="{{ route('laporan.pdf') }}?periode={{ request('periode') }}&bidang={{ request('bidang') }}"
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-4 rounded-2xl shadow">
                        Export PDF
                    </a>

                    <a href="/admin/export-csv?periode={{ request('periode') }}&bidang={{ request('bidang') }}"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-4 rounded-2xl shadow">
                            Export Excel
                    </a>

                </div>

            </div>

 <!-- RINGKASAN STATISTIK -->
<div class="mb-10">
    <div class="grid grid-cols-1 md:grid-cols-6 gap-5">

        <!-- TOTAL KUNJUNGAN -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Total Kunjungan
            </p>

            <h2 class="text-2xl font-bold text-slate-800">
                {{ $totalKunjungan }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                Data kunjungan tamu
            </p>

        </div>

        <!-- RERATA -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Rerata Harian
            </p>

            <h2 class="text-2xl font-bold text-slate-800">
                {{ $rerataHarian }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                Statistik harian
            </p>

        </div>

        <!-- WAKTU -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Waktu Rata-rata
            </p>

            <h2 class="text-2xl font-bold text-slate-800">
                {{ $waktuRata }}
            </h2>

            <p class="text-xs text-gray-400 mt-2">
                Durasi kunjungan
            </p>

        </div>

        <!-- TOTAL SURVEY -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Total Survey
            </p>

            <h2 class="text-2xl font-bold text-slate-800">
                {{ $totalSurvey }}
            </h2>

        </div>

        <!-- RATING -->
       <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Rating
            </p>

            <h2 class="text-2xl font-bold text-slate-800">
                ⭐ {{ number_format($avgRating, 1) }}
            </h2>

        </div>

        <!-- LAYANAN -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <p class="text-gray-400 text-sm mb-3">
                Layanan Terbanyak
            </p>

            <h2 class="text-base font-bold text-blue-800 leading-snug">
                {{ $layananTerbanyak ? $layananTerbanyak->layanan_diakses : '-' }}
            </h2>

        </div>

    </div>

</div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-4">

    <!-- CHART -->

      <div class="bg-white rounded-3xl p-4 shadow">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Status Kunjungan
        </h2>

        <div class="h-64">

            <canvas id="statusChart"></canvas>

        </div>

    </div>

    <div class="bg-white rounded-3xl p-4 shadow">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            Grafik Survey
        </h2>

        <div class="h-64">

            <canvas id="surveyChart"></canvas>

        </div>

    </div>
    
    <div class="bg-white rounded-3xl p-4 shadow">

            <h2 class="text-xl font-bold text-gray-800 mb-6">
                Jenis Layanan
            </h2>

            <div class="h-64">

                <canvas id="layananChart"></canvas>

            </div>

        </div>
        <div class="bg-white rounded-3xl p-4 shadow">

    <h2 class="text-xl font-bold text-gray-800 mb-6">
        Bidang Tujuan
    </h2>

    <div class="h-64">

        <canvas id="bidangChart"></canvas>

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
        const statusCtx = document
    .getElementById('statusChart');

new Chart(statusCtx, {

    type: 'pie',

    data: {

        labels: [
            'Menunggu',
            'Terjadwal',
            'Datang',
            'Selesai'
        ],

        datasets: [{

            data: [
                {{ $statusChart[0] }},
                {{ $statusChart[1] }},
                {{ $statusChart[2] }},
                {{ $statusChart[3] }}
            ],

            backgroundColor: [
                '#f59e0b',
                '#3b82f6',
                '#10b981',
                '#8b5cf6'
            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false

    }

});
const bidangCtx = document
    .getElementById('bidangChart');

new Chart(bidangCtx, {

    type: 'pie',

    data: {

        labels: [
            'Kepala Dinas',
            'Sekretariat',
            'Pelatihan Kerja',
            'Hubungan Industrial',
            'Pengawasan',
            'Penempatan'
        ],

        datasets: [{

            data: [
                {{ $bidangChart[0] }},
                {{ $bidangChart[1] }},
                {{ $bidangChart[2] }},
                {{ $bidangChart[3] }},
                {{ $bidangChart[4] }},
                {{ $bidangChart[5] }}
            ],

            backgroundColor: [
                '#3b82f6',
                '#10b981',
                '#f59e0b',
                '#ef4444',
                '#8b5cf6',
                '#14b8a6'
            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false

    }

});
        </script>

</div>
</div>
@endsection