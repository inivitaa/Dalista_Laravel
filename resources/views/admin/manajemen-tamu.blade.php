@extends('admin.layout')

@section('title', 'Manajemen Tamu')

@section('content')

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="mb-8">

            <h2 class="text-4xl font-bold text-gray-800">
                Manajemen Data Tamu
            </h2>

            <p class="text-gray-500 mt-2">
                Kelola seluruh data tamu yang telah mendaftar dalam sistem
            </p>

        </div>

        <!-- STATISTIK -->
        <div class="grid md:grid-cols-4 gap-5 mb-8">

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Total Tamu
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $guests->count() }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-pink-100 flex items-center justify-center text-2xl">
                        👥
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Hari Ini
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $guests->where('created_at', '>=', now()->startOfDay())->count() }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
                        📅
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Upload File
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $guests->whereNotNull('berkas')->count() }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                        📁
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Survey
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 mt-2">
                            0
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-yellow-100 flex items-center justify-center text-2xl">
                        ⭐
                    </div>

                </div>

            </div>

        </div>

        <!-- TABLE CARD -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

            <!-- TOP ACTION -->
            <div class="p-6 border-b">

                <div class="flex flex-wrap gap-3 mb-5">

                    <button class="bg-pink-100 text-pink-600 px-5 py-2.5 rounded-xl hover:bg-pink-200 transition">
                        <a href="/form"
                        class="bg-pink-100 text-pink-600 px-5 py-2.5 rounded-xl hover:bg-pink-200 transition">

                            + Tambah Tamu

                        </a>
                    </button>

                    <button class="bg-green-100 text-green-600 px-5 py-2.5 rounded-xl hover:bg-green-200 transition">
                        ⬇ Export Excel
                    </button>

                    <button onclick="location.reload()"
                            class="bg-blue-100 text-blue-600 px-5 py-2.5 rounded-xl hover:bg-blue-200 transition">

                        ↻ Refresh

                    </button>
                    

                </div>

                <!-- FILTER -->
                <div class="grid md:grid-cols-4 gap-4">

                    <form method="GET" action="/admin/manajemen-tamu">

                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               onkeyup="this.form.submit()"
                               placeholder="Cari nama, instansi, atau profesi..."
                               class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

                    </form>

                    <form method="GET" action="/admin/manajemen-tamu">

                    <input type="hidden"
                        name="search"
                        value="{{ request('search') }}">

                    <input type="hidden"
                        name="waktu"
                        value="{{ request('waktu') }}">

                    <select name="status"
                            onchange="this.form.submit()"
                            class="border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

                        <option value="">Semua Status</option>

                        <option value="Menunggu"
                            {{ request('status') == 'Menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="Diterima"
                            {{ request('status') == 'Diterima' ? 'selected' : '' }}>
                            Diterima
                        </option>

                        <option value="Terjadwal"
                            {{ request('status') == 'Terjadwal' ? 'selected' : '' }}>
                            Terjadwal
                        </option>

                        <option value="Selesai"
                            {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                </form>

                    <form method="GET" action="/admin/manajemen-tamu">

                        <input type="hidden"
                            name="search"
                            value="{{ request('search') }}">

                        <input type="hidden"
                            name="status"
                            value="{{ request('status') }}">

                        <select name="waktu"
                                onchange="this.form.submit()"
                                class="border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

                            <option value="">Semua Waktu</option>

                            <option value="Hari Ini"
                                {{ request('waktu') == 'Hari Ini' ? 'selected' : '' }}>
                                Hari Ini
                            </option>

                            <option value="Minggu Ini"
                                {{ request('waktu') == 'Minggu Ini' ? 'selected' : '' }}>
                                Minggu Ini
                            </option>

                            <option value="Bulan Ini"
                                {{ request('waktu') == 'Bulan Ini' ? 'selected' : '' }}>
                                Bulan Ini
                            </option>

                        </select>

                    </form>

                    <select class="border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

                        <option>10 per halaman</option>
                        <option>25 per halaman</option>
                        <option>50 per halaman</option>

                    </select>

                </div>

            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr class="text-left text-gray-500 text-sm">

                            <th class="p-5 font-medium">No</th>
                            <th class="p-5 font-medium">Nama</th>
                            <th class="p-5 font-medium">Profesi</th>
                            <th class="p-5 font-medium">Instansi</th>
                            <th class="p-5 font-medium">Tujuan</th>
                            <th class="p-5 font-medium">Status</th>
                            <th class="p-5 font-medium">Tanggal</th>
                            <th class="p-5 font-medium">Berkas</th>
                            <th class="p-5 font-medium">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($guests as $guest)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="p-5">
                                {{ $loop->iteration }}
                            </td>

                            <td class="p-5 font-medium text-gray-800">
                                {{ $guest->nama }}
                            </td>

                            <td class="p-5 text-gray-600">
                                {{ $guest->profesi }}
                            </td>

                            <td class="p-5 text-gray-600">
                                {{ $guest->instansi }}
                            </td>

                            <td class="p-5">

                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm">
                                    {{ $guest->tujuan }}
                                </span>

                            </td>

                            <td class="p-5">

                            <form method="POST"
                                action="/admin/manajemen-tamu/{{ $guest->id }}/status">

                                @csrf

                                <select name="status"
                                        onchange="this.form.submit()"

                                        class="px-4 py-2 rounded-xl text-sm font-medium border-0 outline-none cursor-pointer

                                        {{ $guest->status == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}

                                        {{ $guest->status == 'Diterima' ? 'bg-blue-100 text-blue-700' : '' }}

                                        {{ $guest->status == 'Terjadwal' ? 'bg-purple-100 text-purple-700' : '' }}

                                        {{ $guest->status == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}
                                ">

                                    <option value="Menunggu"
                                        {{ $guest->status == 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>

                                    <option value="Diterima"
                                        {{ $guest->status == 'Diterima' ? 'selected' : '' }}>
                                        Diterima
                                    </option>

                                    <option value="Terjadwal"
                                        {{ $guest->status == 'Terjadwal' ? 'selected' : '' }}>
                                        Terjadwal
                                    </option>

                                    <option value="Selesai"
                                        {{ $guest->status == 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                </select>
                            </form>

                        </td>

                            <td class="p-5 text-gray-500">
                                {{ $guest->created_at->format('d M Y') }}
                            </td>

                            <td class="p-5">

                                @if($guest->berkas)

                                <a href="{{ asset('storage/berkas/'.$guest->berkas) }}"
                                   target="_blank"
                                   class="bg-gray-100 hover:bg-blue-100 hover:text-blue-600 transition px-4 py-2 rounded-lg text-sm">

                                    Lihat File

                                </a>

                                @else

                                <span class="text-gray-400 text-sm">
                                    Tidak ada
                                </span>

                                @endif

                            </td>

                            <td class="p-5">

                                <button
                                    onclick="openModal(
                                        '{{ $guest->id }}',
                                        '{{ $guest->nama }}',
                                        '{{ $guest->email }}',
                                        '{{ $guest->nohp }}',
                                        '{{ $guest->jk }}',
                                        '{{ $guest->profesi }}',
                                        '{{ $guest->instansi }}',
                                        '{{ $guest->tujuan }}',
                                        '{{ $guest->keterangan }}'
                                    )"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-4 py-2 rounded-lg text-sm transition">

                                    Detail

                                </button>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td colspan="9"
                                class="text-center p-10 text-gray-400">

                                Belum ada data tamu

                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <!-- FOOTER TABLE -->
                <div class="flex flex-col md:flex-row items-center justify-between p-5 border-t bg-white">

                    <p class="text-sm text-gray-500 mb-3 md:mb-0">

                        Menampilkan
                        <span class="font-semibold text-gray-700">1</span>
                        sampai
                        <span class="font-semibold text-gray-700">{{ $guests->count() }}</span>
                        dari
                        <span class="font-semibold text-gray-700">{{ $guests->count() }}</span>
                        data

                    </p>

                    <div class="flex items-center gap-2">

                        <button class="px-4 py-2 rounded-xl border border-gray-200 text-gray-400 bg-gray-50 cursor-not-allowed">
                            Previous
                        </button>

                        <button class="w-10 h-10 rounded-xl bg-blue-500 text-white font-medium">
                            1
                        </button>

                        <button class="px-4 py-2 rounded-xl border border-gray-200 hover:bg-gray-100 transition">
                            Next
                        </button>

                    </div>

                </div>

            </div>


</div>

<!-- MODAL DETAIL -->
<div id="detailModal"
     class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 px-4">

    <div class="bg-white rounded-3xl w-full max-w-2xl p-8 relative shadow-2xl">

        <button onclick="closeModal()"
                class="absolute top-4 right-5 text-gray-400 hover:text-red-500 text-3xl transition">

            ×

        </button>

        <div class="mb-8">

            <h2 class="text-3xl font-bold text-gray-800">
                Detail Data Tamu
            </h2>

            <p class="text-gray-400 mt-1">
                Informasi lengkap data registrasi tamu
            </p>

        </div>

        <div class="grid md:grid-cols-2 gap-6">

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">Nama Lengkap</p>
                <h3 id="d_nama" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">Email</p>
                <h3 id="d_email" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">No HP</p>
                <h3 id="d_nohp" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">Jenis Kelamin</p>
                <h3 id="d_jk" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">Profesi</p>
                <h3 id="d_profesi" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4">
                <p class="text-sm text-gray-400 mb-1">Instansi</p>
                <h3 id="d_instansi" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4 md:col-span-2">
                <p class="text-sm text-gray-400 mb-1">Tujuan Kunjungan</p>
                <h3 id="d_tujuan" class="font-semibold text-gray-800 text-lg"></h3>
            </div>

            <div class="bg-gray-50 rounded-2xl p-4 md:col-span-2">
                <p class="text-sm text-gray-400 mb-1">Keterangan</p>
                <h3 id="d_keterangan" class="font-semibold text-gray-800 leading-relaxed"></h3>
            </div>

        </div>

        <div class="mt-8 flex justify-between">

            <!-- DELETE -->
            <form id="deleteForm"
                method="POST">

                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition">

                    Hapus Data

                </button>

            </form>

            <!-- CLOSE -->
            <button onclick="closeModal()"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition">

                Tutup

            </button>

        </div>

    </div>

</div>

<!-- SCRIPT MODAL -->
<script>
function openModal(
    id,
    nama,
    email,
    nohp,
    jk,
    profesi,
    instansi,
    tujuan,
    keterangan
){

    document.getElementById('deleteForm')
    .action = '/admin/manajemen-tamu/' + id;
    document.getElementById('d_nama').innerText = nama;
    document.getElementById('d_email').innerText = email;
    document.getElementById('d_nohp').innerText = nohp;
    document.getElementById('d_jk').innerText = jk;
    document.getElementById('d_profesi').innerText = profesi;
    document.getElementById('d_instansi').innerText = instansi;
    document.getElementById('d_tujuan').innerText = tujuan;
    document.getElementById('d_keterangan').innerText = keterangan;

    document.getElementById('detailModal')
        .classList.remove('hidden');

    document.getElementById('detailModal')
        .classList.add('flex');

}

function closeModal(){

    document.getElementById('detailModal')
        .classList.remove('flex');

    document.getElementById('detailModal')
        .classList.add('hidden');

}
</script>

@endsection

