@extends('admin.layout')

@section('title', 'Manajemen Tamu')

@section('content')

    <!-- CONTENT -->
    <main class="flex-1 p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-start mb-8">

            <div>
            <h2 class="text-4xl font-bold text-gray-800">
                Manajemen Data Tamu
            </h2>

            <p class="text-gray-500 mt-2">
                Kelola seluruh data tamu yang telah mendaftar dalam sistem
            </p>

        </div>
        <!-- KANAN -->
                <div class="flex items-center gap-3">

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
                            name="bidang"
                            onchange="this.form.submit()"
                            class="border rounded-2xl px-3 py-4 shadow-sm bg-white">

                            <option value=""
                                {{ request('bidang') == '' ? 'selected' : '' }}>
                                Semua Bidang
                            </option>

                            <option value="Konsultasi Layanan"
                                {{ request('bidang') == 'Konsultasi Layanan' ? 'selected' : '' }}>
                                Konsultasi Layanan
                            </option>

                            <option value="Pengaduan/Keluhan"
                                {{ request('bidang') == 'Pengaduan/Keluhan' ? 'selected' : '' }}>
                                Pengaduan/Keluhan
                            </option>

                            <option value="Pengajuan Permohonan"
                                {{ request('bidang') == 'Pengajuan Permohonan' ? 'selected' : '' }}>
                                Pengajuan Permohonan
                            </option>

                            <option value="Mencari Informasi"
                                {{ request('bidang') == 'Mencari Informasi' ? 'selected' : '' }}>
                                Mencari Informasi
                            </option>

                            <option value="Survey/Penelitian"
                                {{ request('bidang') == 'Survey/Penelitian' ? 'selected' : '' }}>
                                Survey/Penelitian
                            </option>

                            <option value="Layanan Terpadu"
                                {{ request('bidang') == 'Layanan Terpadu' ? 'selected' : '' }}>
                                Layanan Terpadu
                            </option>

                            <option value="Meeting"
                                {{ request('bidang') == 'Meeting' ? 'selected' : '' }}>
                                Meeting
                            </option>

                            <option value="Lainnya"
                                {{ request('bidang') == 'Lainnya' ? 'selected' : '' }}>
                                Lainnya
                            </option>

                        </select>
                    </form>

                    <a href="/admin/export-csv?periode={{ request('periode') }}&bidang={{ request('bidang') }}"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-5 py-4 rounded-2xl shadow">
                            Export Excel
                    </a>
                    </div>
                </div>

        

        <!-- STATISTIK -->
        <div class="grid md:grid-cols-4 gap-5 mb-8">

            <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Total Tamu
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $totalTamu }}
                        </h3>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-pink-100 flex items-center justify-center text-2xl">
                        👥
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-4xl p-6 shadow-sm border border-gray-100">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 text-sm">
                            Hari Ini
                        </p>

                        <h3 class="text-3xl font-bold text-gray-800 mt-2">
                            {{ $hariIni }}
                        </h3>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-green-100 flex items-center justify-center text-2xl">
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

                        <h3 class="text-4xl font-bold text-gray-800 mt-2">
                            {{ $uploadFile }}
                        </h3>

                    </div>

                    <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-2xl">
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

                        <a href="/form"
                        class="bg-blue-100 text-blue-600 px-5 py-2.5 rounded-xl hover:bg-blue-200 transition">

                            + Tambah Tamu

                        </a>

                    <button onclick="openServiceModal()"
                        class="bg-purple-100 hover:bg-purple-200 text-purple-600 px-6 py-3 rounded-2xl transition">

                        ⚙ Kelola Layanan

                    </button>

                    <button onclick="location.reload()"
                            class="bg-blue-100 text-blue-600 px-5 py-2.5 rounded-xl hover:bg-blue-200 transition">

                        ↻ Refresh

                    </button>
                    

                </div>
        
            <!-- FILTER -->
<form method="GET" action="/admin/manajemen-tamu">

    <div class="grid md:grid-cols-4 gap-4">

        <!-- Search -->
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau instansi ..."
            onkeyup="this.form.submit()"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

        <!-- Status -->
        <select
            name="status"
            onchange="this.form.submit()"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

            <option value="">Semua Status</option>
            <option value="Menunggu" {{ request('status')=='Menunggu'?'selected':'' }}>Menunggu</option>
            <option value="Terjadwal" {{ request('status')=='Terjadwal'?'selected':'' }}>Terjadwal</option>
            <option value="Datang" {{ request('status')=='Datang'?'selected':'' }}>Datang</option>
            <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>

        </select>

        <!-- Waktu -->
        <select
            name="waktu"
            onchange="this.form.submit()"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

            <option value="">Semua Waktu</option>
            <option value="Hari Ini" {{ request('waktu')=='Hari Ini'?'selected':'' }}>Hari Ini</option>
            <option value="Minggu Ini" {{ request('waktu')=='Minggu Ini'?'selected':'' }}>Minggu Ini</option>
            <option value="Bulan Ini" {{ request('waktu')=='Bulan Ini'?'selected':'' }}>Bulan Ini</option>

        </select>

        <!-- Per Halaman -->
        <select
            name="per_page"
            onchange="this.form.submit()"
            class="w-full border border-gray-200 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-200">

            <option value="10" {{ request('per_page',10)==10?'selected':'' }}>10 per halaman</option>
            <option value="25" {{ request('per_page')==25?'selected':'' }}>25 per halaman</option>
            <option value="50" {{ request('per_page')==50?'selected':'' }}>50 per halaman</option>

        </select>

    </div>

</form>    
            
            <!-- TABLE -->
            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50">

                        <tr class="text-left text-gray-500 text-sm">

                            <th class="p-5 font-medium">No</th>
                            <th class="p-5 font-medium">Nama</th>
                            <th class="p-5 font-medium">Instansi</th>
                            <th class="p-5 font-medium">Tujuan</th>
                            <th class="p-5 font-medium">Status</th>
                            <th class="p-5 font-medium">Tanggal</th>
                            <th class="p-5 font-medium">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($guests as $guest)

                        <tr class="border-t hover:bg-gray-50 transition">

                            <td class="p-5">
                                {{ $guests->firstItem() + $loop->index }}
                            </td>

                            <td class="p-5 font-medium text-gray-800">
                                {{ $guest->nama }}
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

                            <span
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-semibold

                                {{ $guest->status_kunjungan == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}

                                {{ $guest->status_kunjungan == 'Terjadwal' ? 'bg-blue-100 text-blue-700' : '' }}

                                {{ $guest->status_kunjungan == 'Datang' ? 'bg-purple-100 text-purple-700' : '' }}

                                {{ $guest->status_kunjungan == 'Selesai' ? 'bg-green-100 text-green-700' : '' }}">

                                {{ $guest->status_kunjungan }}

                            </span>

                        </td>

                            <td class="p-5 text-gray-500">
                                {{ \Carbon\Carbon::parse($guest->waktu_dibuat)->format('d M Y') }}
                            </td>

                            
                            <td class="p-5">
                                <a
                                    href="{{ route('guest.detail', $guest->id) }}"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-4 py-2 rounded-lg text-sm transition">

                                    Detail

                                </a>

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
                <div class="flex justify-between items-center px-6 py-5 border-t bg-white">

                    <p class="text-sm text-gray-500">
                        Menampilkan
                        {{ $guests->firstItem() ?? 0 }}
                        sampai
                        {{ $guests->lastItem() ?? 0 }}
                        dari
                        {{ $guests->total() }}
                        data
                    </p>

                    {{ $guests->links() }}

                </div>

            </div>

            </div>
        </div>
<!-- =========================
     SERVICE MODAL
========================= -->

<div id="serviceModal"
    class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl relative overflow-hidden">
        <!-- CLOSE -->
        <button
            onclick="closeServiceModal()"
            class="absolute right-6 top-5 text-3xl text-gray-400 hover:text-red-500">
            ×
        </button>

        <div class="px-8 pt-7 pb-5">

        <h2 class="text-2xl font-bold text-gray-800">           
            Manajemen Layanan
        </h2>
        </div>

        <!-- TAB -->
        <div class="flex gap-8 px-8 border-b mb-6">

            <button
                id="tabUmum"
                onclick="showUmum()"
                class="pb-4 border-b-[3px] border-pink-500 text-pink-500 font-semibold transition ">
                Layanan
            </button>

            <button
                id="tabBidang"
                onclick="showBidang()"
                class="pb-4 border-b-[3px] border-transparent text-gray-400 hover:text-blue-500 transition">
                Bidang
            </button>

        </div>
        
        <!-- =========================
            CONTENT LAYANAN
        ========================= -->
        <div id="contentUmum" class="px-8 pb-8">
        <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 mb-5">

            <h3 class="font-semibold mb-4">
                Tambah Layanan
            </h3>

            <form
                action="{{ route('layanan.store') }}"
                method="POST"
                class="flex items-center gap-3">

                @csrf

                <input
                    type="hidden"
                    name="jenis"
                    value="umum">

                <input
                    type="text"
                    name="nama_layanan"
                    placeholder="Nama layanan..."
                    class="w-[74%] border rounded-xl px-4 py-3">

                <button
                class="bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 h-10 min-w-[110px] rounded-xl">
                    Tambah
                </button>

            </form>
        </div>

        <div class="max-h-80 overflow-y-auto">
            @foreach($layananUmum as $layanan)

            <div 
                class="flex justify-between items-center py-1 border-b border-gray-200">
                <span>

                    {{ $layanan->nama_layanan }}

                </span>

                <div class="flex gap-3">

                    <button
                        type="button"
                        onclick="editLayanan(
                            {{ $layanan->id }},
                            '{{ $layanan->nama_layanan }}'
                        )"
                        class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 text-blue-600">
                        ✏
                    </button>

                    <form
                        id="delete-form-{{ $layanan->id }}"
                        action="{{ route('layanan.destroy', $layanan->id) }}"
                        method="POST">

                        @csrf
                        @method('DELETE')

                        <button
                            type="button"
                            onclick="hapusLayanan({{ $layanan->id }})"
                            class="w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-600">
                            🗑
                        </button>

                    </form>

                </div>

            </div>

            @endforeach

        </div>
        </div>
        <!-- =========================
            CONTENT BIDANG
        ========================= -->
        <div id="contentBidang" class="hidden px-8 pt-2 pb-8">
            <div class="bg-gray-50 border border-gray-200 rounded-2xl px-6 py-4 mb-5">

                <h3 class="font-semibold mb-4">
                    Tambah Bidang
                </h3>

                    <form action="{{ route('bidang.store') }}"
                        method="POST"
                        class="flex items-center gap-3">

                        @csrf

                        <input
                            type="text"
                            name="bidang"
                            placeholder="Nama bidang..."
                            class="w-[78%] border rounded-xl px-4 py-3"
                            required>

                        <button
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 h-10 min-w-[110px] rounded-xl">  
                            Tambah

                        </button>

                    </form>
            </div>

        <div class="max-h-80 overflow-y-auto">
            @foreach($bidangTujuan as $bidang)

            <div class="flex justify-between items-center py-1 border-b border-gray-200">
                <span>

                    {{ $bidang->bidang }}

                </span>

                <div class="flex gap-3">

                    <button
                        type="button"
                        onclick="editBidang(
                            {{ $bidang->id }},
                            '{{ $bidang->bidang }}'
                        )"
                        class="w-10 h-10 rounded-xl bg-blue-100 hover:bg-blue-200 text-blue-600 transition">

                        ✏

                    </button>

                    <button
                        type="button"
                        onclick="hapusBidang({{ $bidang->id }})"
                        class="w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-600 transition">

                        🗑

                    </button>

                </div>

            </div>

            @endforeach
        </div>
        </div>
    </div>
    <form
        id="editLayananForm"
        method="POST"
        style="display:none;">

        @csrf
        @method('PUT')

        <input
            type="hidden"
            name="nama_layanan"
            id="editNamaLayanan">

    </form>
    <form
        id="editBidangForm"
        method="POST"
        style="display:none;">

        @csrf
        @method('PUT')

        <input
            type="hidden"
            name="bidang"
            id="editNamaBidang">

    </form>
    <form
        id="deleteBidangForm"
        method="POST"
        style="display:none;">

        @csrf
        @method('DELETE')

    </form>
</div>


<!-- SCRIPT MODAL -->
@if(session('success'))

<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
});
</script>

@endif
<script>
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
    function showUmum(){

        document.getElementById('contentUmum').classList.remove('hidden');
        document.getElementById('contentBidang').classList.add('hidden');

        document.getElementById('tabUmum').className =
            "pb-3 border-b-2 border-pink-500 text-pink-500 font-semibold";

        document.getElementById('tabBidang').className =
            "pb-3 text-gray-400 font-semibold";

    }

    function showBidang(){

        document.getElementById('contentUmum').classList.add('hidden');
        document.getElementById('contentBidang').classList.remove('hidden');

        document.getElementById('tabBidang').className =
            "pb-3 border-b-2 border-pink-500 text-pink-500 font-semibold";

        document.getElementById('tabUmum').className =
            "pb-3 text-gray-400 font-semibold";

    }

    function hapusLayanan(id){

        Swal.fire({
            title: 'Hapus layanan?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if(result.isConfirmed){

                document
                    .getElementById('delete-form-' + id)
                    .submit();

            }

        });

    }

    function editLayanan(id, nama){

        Swal.fire({
            title: 'Edit Layanan',
            input: 'text',
            inputValue: nama,
            inputPlaceholder: 'Masukkan nama layanan',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#ec4899',
            cancelButtonColor: '#6b7280',
            inputValidator: (value) => {
                if (!value) {
                    return 'Nama layanan tidak boleh kosong!';
                }
            }

        }).then((result) => {

            if(result.isConfirmed){

                document
                    .getElementById('editNamaLayanan')
                    .value = result.value;

                const form =
                    document.getElementById('editLayananForm');

                form.action =
                    "/admin/layanan/" + id;

                form.submit();

            }

        });

    }
    function editBidang(id, nama){

        Swal.fire({
            title: 'Edit Bidang',
            input: 'text',
            inputValue: nama,
            inputPlaceholder: 'Masukkan nama bidang',
            showCancelButton: true,
            confirmButtonText: 'Simpan',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#3B82F6',
            cancelButtonColor: '#6B7280',
            inputValidator: (value) => {
                if (!value) {
                    return 'Nama bidang tidak boleh kosong!';
                }
            }

        }).then((result) => {

            if(result.isConfirmed){

                document.getElementById('editNamaBidang').value = result.value;

                const form = document.getElementById('editBidangForm');

                form.action = "/admin/bidang/" + id;

                form.submit();

            }

        });

    }
    function hapusBidang(id){

        Swal.fire({
            title: 'Hapus Bidang?',
            text: 'Data bidang akan dihapus permanen.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#6B7280'

        }).then((result)=>{

            if(result.isConfirmed){

                const form = document.getElementById('deleteBidangForm');

                form.action = "/admin/bidang/" + id;

                form.submit();

            }

        });

    }
</script>

@endsection

