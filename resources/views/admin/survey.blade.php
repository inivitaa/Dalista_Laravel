@extends('admin.layout')

@section('content')

<div class="p-8">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-4xl font-bold text-gray-800">
            Survey Kepuasan
        </h1>

        <p class="text-gray-500 mt-2">
            Data hasil penilaian dan kepuasan pengunjung.
        </p>

    </div>

    <!-- CARD -->
    <!-- CARD STATISTIK -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-4xl font-bold text-slate-800">
                            {{ $totalSurvey }}
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Total Survey
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-3xl">
                        📋
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-4xl font-bold text-yellow-500">
                            {{ number_format($avgRating,1) }}
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Rating Rata-rata
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-yellow-50 flex items-center justify-center text-3xl">
                        ⭐
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-4xl font-bold text-green-500">
                            {{ $hebat }}
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Rating Hebat
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-50 flex items-center justify-center text-3xl">
                        😍
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl border border-gray-100 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-4xl font-bold text-red-500">
                            {{ $buruk }}
                        </h3>

                        <p class="text-gray-500 mt-1">
                            Rating Buruk
                        </p>
                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center text-3xl">
                        😢
                    </div>
                </div>
            </div>

        </div>

        <!-- CHART -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-8">

            <div class="mb-5">

                <h2 class="text-3xl font-bold text-slate-800">
                    Statistik Rating
                </h2>

                <p class="text-gray-500 mt-1">
                    Distribusi penilaian kepuasan pengunjung
                </p>

            </div>

            <div class="h-[280px]">
                <canvas id="ratingChart"></canvas>
            </div>

        </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <div class="px-6 py-5 border-b">

            <div>

                <h2 class="text-3xl font-bold text-slate-800">
                    Data Survey Pengunjung
                </h2>   

                <p class="text-gray-500 text-sm mt-1">
                    Daftar seluruh penilaian dan kepuasan layanan
                </p>

            </div>

        </div>

        <!-- FILTER -->
        <form method="GET" action="" id="filterForm">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- SEARCH -->
                <input 
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama..."
                    onkeyup="submitFilter()"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                <!-- FILTER LAYANAN -->
                <select 
                    name="layanan"
                    onchange="submitFilter()"              
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                   <option value="">
                        Semua Layanan
                    </option>

                    <option value="Konsultasi Layanan"
                    {{ request('layanan') == 'Konsultasi Layanan' ? 'selected' : '' }}
                    >
                        Konsultasi Layanan
                    </option>

                    <option value="Pengaduan/Keluhan"
                    {{ request('layanan') == 'Pengaduan/Keluhan' ? 'selected' : '' }}
                    >
                        Pengaduan/Keluhan
                    </option>

                    <option value="Pengajuan Permohonan"
                    {{ request('layanan') == 'Pengajuan Permohonan' ? 'selected' : '' }}
                    >
                        Pengajuan Permohonan
                    </option>

                    <option value="Mencari Informasi"
                    {{ request('layanan') == 'Mencari Informasi' ? 'selected' : '' }}
                    >
                        Mencari Informasi
                    </option>

                    <option value="Survey/Penelitian"
                    {{ request('layanan') == 'Survey/Penelitian' ? 'selected' : '' }}
                    >
                        Survey/Penelitian
                    </option>

                    <option value="Layanan Terpadu"
                    {{ request('layanan') == 'Layanan Terpadu' ? 'selected' : '' }}
                    >
                        Layanan Terpadu
                    </option>

                    <option value="Meeting"
                    {{ request('layanan') == 'Meeting' ? 'selected' : '' }}
                    >
                        Meeting
                    </option>

                    <option value="Lainnya"
                    {{ request('layanan') == 'Lainnya' ? 'selected' : '' }}
                    >
                        Lainnya
                    </option>
                </select>
                
                <!-- FILTER RATING -->
                <select 
                    name="rating"
                    onchange="submitFilter()" 
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"               
                    >

                    <option value="">
                        Semua Rating
                    </option>

                    <option value="1"{{ request('rating') == '1' ? 'selected' : '' }}>
                        😢 Buruk
                    </option>

                    <option value="2"{{ request('rating') == '2' ? 'selected' : '' }}>
                        😕 Kurang
                    </option>

                    <option value="3"{{ request('rating') == '3' ? 'selected' : '' }}>
                        🙂 Cukup
                    </option>

                    <option value="4"{{ request('rating') == '4' ? 'selected' : '' }}>
                        😊 Puas
                    </option>

                    <option value="5"{{ request('rating') == '5' ? 'selected' : '' }}>
                        🤩 Hebat
                    </option>

                </select>

                <a href="/admin/survey/export"
                class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-3 rounded-2xl shadow-sm font-medium text-center transition">

                    Export CSV

                </a>
            </div>

        </form>

    </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-200">

                    <tr>

                        <th class="p-4 text-left font-bold text-gray-800">
                            Nama
                        </th>

                        <th class="p-4 text-left font-bold text-gray-800">
                            Layanan
                        </th>

                        <th class="p-4 text-left font-bold text-gray-800">
                            Rating
                        </th>

                        <th class="p-4 text-left font-bold text-gray-800">
                            Saran
                        </th>

                        <th class="p-4 text-left font-bold text-gray-800">
                            Tanggal
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($surveys as $survey)

                    <tr class="border-t border-gray-100 hover:bg-slate-50 transition">

                        <!-- NAMA -->
                        <td class="p-4 font-semibold text-gray-700">

                            {{ $survey->nama }}

                        </td>

                        <!-- LAYANAN -->
                        <td class="p-4">

                            <span class="bg-sky-50 text-sky-700 px-3 py-1 rounded-full text-sm">

                                {{ $survey->layanan_diakses }}

                            </span>

                        </td>

                        <!-- RATING -->
                        <td class="p-4">

                            @if($survey->rating == 5)

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">
                                    🤩 Hebat
                                </span>

                            @elseif($survey->rating >= 3)

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-bold">
                                    🙂 Cukup
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                    😢 Buruk
                                </span>

                            @endif

                        </td>

                        <!-- SARAN -->
                        <td class="p-4 text-gray-600 max-w-xs">

                            {{ $survey->ulasan ?? '-' }}

                        </td>

                        <!-- TANGGAL -->
                        <td class="p-4 text-gray-400 text-sm">

                            {{ $survey->created_at->format('d M Y') }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5" class="p-10 text-center">

                            <div class="text-6xl mb-4">
                                📭
                            </div>

                            <h2 class="text-xl font-bold text-gray-700 mb-2">
                                Belum ada survey
                            </h2>

                            <p class="text-gray-400">
                                Data survey akan muncul di sini.
                            </p>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>
            <div class="px-6 py-4 border-t bg-white">

                {{ $surveys->links() }}

            </div>
        </div>

    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('ratingChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            '⭐ Buruk',

            '⭐ Kurang',

            '⭐ Cukup',

            '⭐ Puas',

            '⭐ Hebat'

        ],

        datasets: [{

            label: 'Jumlah Rating',

            data: [

                {{ $surveys->where('rating',1)->count() }},

                {{ $surveys->where('rating',2)->count() }},

                {{ $surveys->where('rating',3)->count() }},

                {{ $surveys->where('rating',4)->count() }},

                {{ $surveys->where('rating',5)->count() }}

            ],

            borderRadius: 12,

            backgroundColor: [

                '#ef4444',

                '#f97316',

                '#eab308',

                '#22c55e',

                '#3b82f6'

            ]

        }]

    },

    options: {

        responsive: true,

        maintainAspectRatio: false,

        plugins: {

            legend: {

                display: false

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

function submitFilter(){

    document
        .getElementById('filterForm')
        .submit();

}

</script>

@endsection