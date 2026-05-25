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
                            {{ $guests->whereNotNull('file_upload')->count() }}
                        </h3>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
                        📁
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

                    <button onclick="openServiceModal()"
                        class="bg-purple-100 hover:bg-purple-200 text-purple-600 px-6 py-3 rounded-2xl transition">

                        ⚙ Kelola Layanan

                    </button>

                   <div class="relative">

                    <button onclick="toggleExport()"
                        class="bg-green-100 hover:bg-green-200 text-green-600 px-6 py-3 rounded-2xl transition">

                        ⬇ Export Excel

                    </button>

                    <div id="exportDropdown"
                        class="hidden absolute mt-3 bg-white border rounded-2xl shadow-lg p-4 z-50">

                        <form action="/admin/export-csv" method="GET">

                            <select name="bulan"
                                class="border border-gray-200 rounded-xl px-4 py-3 mb-3 w-full">

                                <option value="">Semua Bulan</option>

                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>

                            </select>

                            <button type="submit"
                                class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl w-full">

                                Download

                            </button>

                        </form>

                    </div>

                </div>

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

                        <option value="Datang"
                            {{ request('status') == 'Datang' ? 'selected' : '' }}>
                            Datang
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
                            <th class="p-5 font-medium">file_upload</th>
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
                                {{ $guest->profesi->nama_profesi ?? '-' }}
                            </td>

                            <td class="p-5 text-gray-600">
                                {{ $guest->asal_instansi }}
                            </td>

                            <td class="p-5">

                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-full text-sm">
                                    {{ $guest->keperluan }}
                                </span>

                            </td>

                            <td class="p-5">

                            <form method="POST"
                                action="/admin/manajemen-tamu/{{ $guest->id }}/status">

                                @csrf

                                <select name="status"
                                        onchange="this.form.submit()"
                                        class="px-4 py-2 rounded-xl text-sm font-medium border-0 outline-none cursor-pointer

                                        {{ $guest->status_kunjungan == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}

                                        {{ $guest->status_kunjungan == 'Terjadwal' ? 'bg-blue-100 text-blue-700' : '' }}

                                        {{ $guest->status_kunjungan == 'Datang' ? 'bg-purple-100 text-purple-700' : '' }}

                                        {{ $guest->status_kunjungan == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}">

                                    <option value="Menunggu"
                                        {{ $guest->status_kunjungan == 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>

                                    <option value="Terjadwal"
                                        {{ $guest->status_kunjungan == 'Terjadwal' ? 'selected' : '' }}>
                                        Terjadwal
                                    </option>

                                    <option value="Datang"
                                        {{ $guest->status_kunjungan == 'Datang' ? 'selected' : '' }}>
                                        Datang
                                    </option>

                                    <option value="Selesai"
                                        {{ $guest->status_kunjungan == 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>

                                </select>
                            </form>

                        </td>

                            <td class="p-5 text-gray-500">
                                {{ \Carbon\Carbon::parse($guest->waktu_dibuat)->format('d M Y') }}
                            </td>

                            <td class="p-5">

                                @if($guest->file_upload)

                                <a href="{{ asset('storage/file_upload/'.$guest->file_upload) }}"
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
                                        '{{ $guest->nomor_telp }}',
                                        '{{ $guest->jenis_kelamin }}',
                                        '{{ $guest->profesi->nama_profesi ?? '-' }}',
                                        '{{ $guest->asal_instansi }}',
                                        '{{ $guest->keperluan }}',
                                        '{{ $guest->catatan_tambahan }}'
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

<!-- SERVICE MODAL -->
<div id="serviceModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-3xl rounded-3xl p-8 relative">

        <button onclick="closeServiceModal()"
            class="absolute top-5 right-5 text-gray-400 hover:text-black text-2xl">

            ✕

        </button>

        <h2 class="text-2xl font-bold mb-6">
            Manajemen Layanan
        </h2>

        <!-- TAB -->
        <div class="flex gap-6 border-b mb-6">

            <button id="tabUmum"
                onclick="showUmum()"
                class="pb-3 border-b-2 border-pink-500 text-pink-500 font-medium">

                Layanan Umum

            </button>

            <button id="tabBidang"
                onclick="showBidang()"
                class="pb-3 text-gray-400 font-medium">

                Layanan Bidang

            </button>

        </div>

        <!-- CONTENT UMUM -->
        <form action="{{ route('layanan.store') }}"
        method="POST"
        class="flex gap-3 mb-6">

        @csrf

        <input type="hidden"
            name="jenis"
            value="umum">

        <input type="text"
            name="nama_layanan"
            placeholder="Masukkan nama layanan"
            class="flex-1 border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-pink-200"
            required>

        <button
            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-2xl transition">

            + Tambah

        </button>

    </form>

            <!-- LIST -->
            <div class="space-y-3 max-h-80 overflow-y-auto pr-2">

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Konsultasi Layanan
                    </span>

                    <div class="flex gap-4">

<button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

<button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Pengaduan/Keluhan
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">
                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">
                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Pengajuan Permohonan
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Mencari Informasi
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Meeting/Rapat
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Survey/Penelitian
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

                <!-- ITEM -->
                <div class="flex items-center justify-between border border-gray-100 rounded-2xl px-5 py-4 hover:bg-gray-50 transition">

                    <span class="font-medium text-gray-700">
                        Layanan Terpadu
                    </span>

                    <div class="flex gap-4">

                        <button
                            onclick="alert('Edit layanan')"
                            class="text-blue-500 hover:text-blue-700 transition">                            ✏
                        </button>

                        <button 
                            onclick="alert('Hapus layanan')"
                            class="text-red-500 hover:text-red-700 transition">                            🗑
                        </button>

                    </div>

                </div>

            </div>

        </div>

<!-- CONTENT BIDANG -->
<div id="contentBidang" class="hidden">

    <!-- PILIH BIDANG -->
    <div class="mb-6">

        <label class="block mb-3 font-medium text-gray-700">
            Pilih Bidang
        </label>

        <select
            class="w-full border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-pink-200">

            <option>-- Pilih Bidang --</option>
            <option>Kepala Dinas</option>
            <option>Sekretariat</option>
            <option>Bidang Pelatihan Kerja dan Produktivitas</option>
            <option>Bidang Hubungan Industrial dan Jaminan Sosial</option>
            <option>Bidang Pengawasan Ketenagakerjaan</option>
            <option>Bidang Penempatan dan Transmigrasi</option>

        </select>

    </div>

    <!-- INPUT -->
    <div class="flex gap-3 mb-6">

        <input type="text"
            placeholder="Masukkan nama layanan"
            class="flex-1 border border-gray-200 rounded-2xl px-4 py-3 outline-none focus:ring-2 focus:ring-pink-200">

        <button
            onclick="alert('Tambah layanan')"
            class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-2xl transition">
            + Tambah

        </button>

    </div>

    <!-- EMPTY -->
    <div class="border border-dashed border-gray-200 rounded-2xl py-16 text-center text-gray-400">

        Belum ada layanan di bidang ini

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

function openServiceModal() {

    document.getElementById('serviceModal')
        .classList.remove('hidden');

    document.getElementById('serviceModal')
        .classList.add('flex');

}

function closeServiceModal() {

    document.getElementById('serviceModal')
        .classList.remove('flex');

    document.getElementById('serviceModal')
        .classList.add('hidden');

}

function toggleExport() {

    document
        .getElementById('exportDropdown')
        .classList.toggle('hidden');

}


function showUmum(){

    document.getElementById('contentUmum')
        .classList.remove('hidden');

    document.getElementById('contentBidang')
        .classList.add('hidden');

    document.getElementById('tabUmum')
        .classList.add(
            'border-pink-500',
            'text-pink-500',
            'border-b-2'
        );

    document.getElementById('tabBidang')
        .classList.remove(
            'border-pink-500',
            'text-pink-500',
            'border-b-2'
        );

    document.getElementById('tabBidang')
        .classList.add('text-gray-400');

}

function showBidang(){

    document.getElementById('contentUmum')
        .classList.add('hidden');

    document.getElementById('contentBidang')
        .classList.remove('hidden');

    document.getElementById('tabBidang')
        .classList.add(
            'border-pink-500',
            'text-pink-500',
            'border-b-2'
        );

    document.getElementById('tabUmum')
        .classList.remove(
            'border-pink-500',
            'text-pink-500',
            'border-b-2'
        );

    document.getElementById('tabUmum')
        .classList.add('text-gray-400');

}

</script>

@endsection

