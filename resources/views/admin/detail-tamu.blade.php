@extends('admin.layout')

@section('title', 'Detail Tamu')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-8">

    <!-- HEADER -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-sm p-6 md:p-8 mb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <!-- Kiri -->
            <div class="flex flex-col sm:flex-row items-center sm:items-start md:items-center gap-4 sm:gap-6 text-center sm:text-left">
                <!-- Avatar -->
                <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center text-3xl font-bold text-blue-600 shrink-0">
                    {{ strtoupper(substr($guest->nama,0,1)) }}
                </div>

                <!-- Informasi -->
                <div>
                    <h2 class="text-2xl md:text-4xl font-bold text-gray-900 break-words">
                        {{ $guest->nama }}
                    </h2>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 mt-2">
                        <span class="px-4 py-1 rounded-full text-sm font-semibold inline-block
                            {{ $guest->status_kunjungan == 'Menunggu' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $guest->status_kunjungan == 'Terjadwal' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ $guest->status_kunjungan == 'Datang' ? 'bg-green-100 text-green-700' : '' }}
                            {{ $guest->status_kunjungan == 'Selesai' ? 'bg-gray-100 text-gray-700' : '' }}">
                            {{ $guest->status_kunjungan }}
                        </span>
                    </div>
                    <div class="mt-3 text-sm text-gray-500 space-y-0.5">
                        <p><span class="font-medium">ID :</span> {{ $guest->id }}</p>
                        <p class="break-all"><span class="font-medium">Tracking :</span> {{ $guest->tracking_code }}</p>
                    </div>
                </div>
            </div>

            <!-- Kanan -->
            <a href="/admin/manajemen-tamu" class="w-full md:w-auto text-center bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl whitespace-nowrap shadow transition">
                ← Kembali
            </a>
        </div>
    </div>
        
    <div class="space-y-8">

        {{-- ========================= DATA DIRI ========================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 md:px-8 py-5 border-b bg-slate-50">
                <h2 class="text-lg md:text-xl font-bold text-slate-800">👤 Data Diri</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi identitas tamu.</p>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Nama</p>
                    <p class="font-semibold text-slate-800">{{ $guest->nama }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Email</p>
                    <p class="font-semibold text-slate-800 break-all">{{ $guest->email }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Nomor HP</p>
                    <p class="font-semibold text-slate-800">{{ $guest->nomor_telp }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Jenis Kelamin</p>
                    <p class="font-semibold text-slate-800">{{ $guest->jenis_kelamin }}</p>
                </div>
                <div class="space-y-1 sm:col-span-2">
                    <p class="text-sm text-slate-500">Alamat</p>
                    <p class="font-semibold text-slate-800">{{ $guest->alamat }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Profesi</p>
                    <p class="font-semibold text-slate-800">{{ $guest->profesi->nama_profesi ?? '-' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Instansi</p>
                    <p class="font-semibold text-slate-800">{{ $guest->asal_instansi }}</p>
                </div>
            </div>
        </div>

        {{-- ========================= INFORMASI KUNJUNGAN ========================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 md:px-8 py-5 border-b bg-slate-50">
                <h2 class="text-lg md:text-xl font-bold text-slate-800">📋 Informasi Kunjungan</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi yang diisi tamu saat melakukan pendaftaran.</p>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2 space-y-1">
                    <p class="text-sm text-slate-500">Tujuan Kunjungan</p>
                    <p class="font-semibold text-slate-800">{{ $guest->keperluan }}</p>
                </div>
                <div class="sm:col-span-2 space-y-1">
                    <p class="text-sm text-slate-500">Keterangan</p>
                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                        <p class="text-slate-700 text-sm md:text-base whitespace-pre-line">{{ $guest->catatan_tambahan ?: '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ========================= PENANGANAN ADMIN ========================== --}}
        <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-6 md:px-8 py-5 border-b bg-slate-50">
                <h2 class="text-lg md:text-xl font-bold text-slate-800">🏢 Informasi Pelayanan</h2>
                <p class="text-sm text-slate-500 mt-1">Informasi layanan dan penanganan oleh admin.</p>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Bidang Tujuan</p>
                    <p class="font-semibold text-slate-800">{{ $guest->bidangTujuan->bidang ?? '-' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Layanan Disnaker</p>
                    <p class="font-semibold text-slate-800">{{ $guest->layanan->nama_layanan ?? '-' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">ASN yang Ditemui</p>
                    <p class="font-semibold text-slate-800">{{ $guest->asn_dituju ?? '-' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Status Kunjungan</p>
                    <div>
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-semibold
                            @if($guest->status_kunjungan=='Menunggu') bg-yellow-100 text-yellow-700
                            @elseif($guest->status_kunjungan=='Terjadwal') bg-blue-100 text-blue-700
                            @elseif($guest->status_kunjungan=='Datang') bg-green-100 text-green-700
                            @elseif($guest->status_kunjungan=='Selesai') bg-gray-200 text-gray-700
                            @endif">
                            {{ $guest->status_kunjungan }}
                        </span>
                    </div>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Jadwal Check-in</p>
                    <p class="font-semibold text-slate-800">
                        {{ $guest->jadwal_checkin ? \Carbon\Carbon::parse($guest->jadwal_checkin)->format('d M Y • H:i') : 'Belum dijadwalkan' }}
                    </p>
                </div>
                <div class="space-y-1">
                    <p class="text-sm text-slate-500">Waktu Datang</p>
                    <p class="font-semibold text-gray-900">
                        {{ $guest->waktu_checkin ? \Carbon\Carbon::parse($guest->waktu_checkin)->format('d M Y • H:i') : 'Belum datang' }}
                    </p>
                </div>
                <div class="space-y-1 sm:col-span-2">
                    <p class="text-sm text-slate-500">Waktu Selesai</p>
                    <p class="font-semibold text-gray-900">
                        {{ $guest->waktu_checkout ? \Carbon\Carbon::parse($guest->waktu_checkout)->format('d M Y • H:i') : 'Belum selesai' }}
                    </p>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center sm:justify-between mt-10">
            <!-- Kiri -->
            <div class="flex flex-col sm:flex-row gap-3">
                {{-- MENUNGGU --}}
                @if($guest->status_kunjungan == 'Menunggu')
                    <button type="button" onclick="openJadwalModal()" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-blue-500 text-white hover:bg-blue-600 transition text-center font-medium">
                        Jadwalkan
                    </button>
                @endif
                
                {{-- TERJADWAL --}}
                @if($guest->status_kunjungan == 'Terjadwal')
                    <button type="button" onclick="openDatangModal()" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-green-500 text-white hover:bg-green-600 transition text-center font-medium">
                        Tandai Datang
                    </button>
                @endif
                
                {{-- DATANG --}}
                @if($guest->status_kunjungan == 'Datang')
                    <button type="button" onclick="openSelesaiModal()" class="w-full sm:w-auto px-6 py-3 rounded-xl bg-green-500 text-white hover:bg-green-600 transition text-center font-medium">
                        Selesai
                    </button>
                @endif
            </div>

            <!-- Kanan -->
            <button class="w-full sm:w-auto px-6 py-3 rounded-xl bg-red-500 text-white hover:bg-red-600 transition font-medium">
                Hapus Data
            </button>
        </div>

    </div>
</div>

<!-- ========================== MODAL JADWALKAN ========================== -->
<div id="jadwalModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl my-8">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Jadwalkan Kunjungan</h2>
            <button type="button" onclick="closeJadwalModal()" class="text-3xl text-gray-400 hover:text-red-500 transition">&times;</button>
        </div>

        <!-- Isi -->
        <form id="jadwalForm" method="POST">
            @csrf
            <div class="p-6 space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal" class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Jam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jam Kunjungan</label>
                        <input type="time" name="jam" class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Bidang Tujuan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bidang Tujuan</label>
                        <select id="bidang" name="bidang_tujuan_id" class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">-- Pilih Bidang --</option>
                            @foreach($bidangTujuan as $bidang)
                                <option value="{{ $bidang->id }}">{{ $bidang->bidang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Layanan -->
                    <div>
                        <div id="layananGroup">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Layanan</label>
                            <select id="layanan" name="layanan_disnaker_id" class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="">-- Pilih Layanan --</option>
                            </select>
                        </div>
                    </div>

                    <!-- ASN -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">ASN yang Ditemui</label>
                        <input type="text" name="asn_dituju" placeholder="Masukkan nama ASN" class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t">
                    <button type="button" onclick="closeJadwalModal()" class="order-2 sm:order-1 px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit" class="order-1 sm:order-2 px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">Simpan Jadwal</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL TANDAI DATANG --}}
<div id="datangModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl my-8">
        <!-- Header -->
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Tandai Tamu Datang</h2>
            <button type="button" onclick="closeDatangModal()" class="text-3xl text-gray-400 hover:text-red-500 transition">&times;</button>
        </div>

        <!-- Isi -->
        <form id="datangForm" method="POST">
            @csrf
            <div class="p-6">
                <p class="text-gray-500 mb-5 text-sm md:text-base">
                    Pilih cara tamu mendapatkan salinan informasi <span class="text-gray-400">(Opsional)</span>.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach($mendapatkanSalinan as $opsi)
                        <label class="flex items-center gap-3 rounded-xl border border-gray-200 px-4 py-3 hover:bg-blue-50 hover:border-blue-300 cursor-pointer transition">
                            <input type="checkbox" name="cara_salinan[]" value="{{ $opsi->id }}" class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-gray-700 text-sm md:text-base">{{ $opsi->nama_opsi }}</span>
                        </label>
                    @endforeach
                </div>

                <div class="flex flex-col sm:flex-row justify-end gap-3 pt-6 mt-6 border-t">
                    <button type="button" onclick="closeDatangModal()" class="order-2 sm:order-1 px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Batal</button>
                    <button type="submit" class="order-1 sm:order-2 px-6 py-3 rounded-xl bg-green-600 hover:bg-green-700 text-white transition">Tandai Datang</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- MODAL SELESAI --}}
<div id="selesaiModal" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 border-b flex justify-between items-start">
            <div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800">Selesaikan Kunjungan</h2>
                <p class="text-gray-500 mt-2 text-sm">Konfirmasi bahwa proses kunjungan tamu telah selesai.</p>
            </div>
            <button type="button" onclick="closeSelesaiModal()" class="text-3xl text-gray-400 hover:text-red-500 transition">&times;</button>
        </div>

        <form id="selesaiForm" method="POST">
            @csrf
            <div class="p-6 flex flex-col sm:flex-row justify-end gap-3">
                <button type="button" onclick="closeSelesaiModal()" class="order-2 sm:order-1 px-6 py-3 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">Batal</button>
                <button type="submit" class="order-1 sm:order-2 px-6 py-3 rounded-xl bg-emerald-700 text-white hover:bg-emerald-800 transition">Ya, Selesai</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openJadwalModal(){
        document.getElementById('jadwalForm').action = '/admin/manajemen-tamu/{{ $guest->id }}/jadwal';
        document.getElementById('jadwalModal').classList.remove('hidden');
        document.getElementById('jadwalModal').classList.add('flex');
    }

    function closeJadwalModal(){
        document.getElementById('jadwalModal').classList.remove('flex');
        document.getElementById('jadwalModal').classList.add('hidden');
    }

    const layananGroup = document.getElementById('layananGroup');
    const layananData = @json($layananDisnaker);
    const bidangSelect = document.getElementById('bidang');
    const layananSelect = document.getElementById('layanan');

    bidangSelect.addEventListener('change', function () {
        const bidangId = this.value;
        layananSelect.innerHTML = '<option value="">-- Pilih Layanan --</option>';

        if (!bidangId) {
            layananSelect.disabled = false;
            return;
        }

        const namaBidang = bidangSelect.options[bidangSelect.selectedIndex].text;

        // Kepala Dinas & Sekretariat tidak punya layanan
        if (namaBidang === 'Kepala Dinas' || namaBidang === 'Sekretariat') {
            layananSelect.innerHTML = '<option value="">Tidak ada layanan</option>';
            layananGroup.classList.add('hidden');
            return;
        }
        
        layananGroup.classList.remove('hidden');
        layananSelect.disabled = false;

        const hasil = layananData.filter(function(item){
            return item.bidang_id == bidangId;
        });

        hasil.forEach(function(item){
            layananSelect.innerHTML += `<option value="${item.id}">${item.nama_layanan}</option>`;
        });
    });

    function openDatangModal() {
        document.getElementById('datangForm').action = '/admin/manajemen-tamu/{{ $guest->id }}/datang';
        document.getElementById('datangModal').classList.remove('hidden');
        document.getElementById('datangModal').classList.add('flex');
    }

    function closeDatangModal() {
        document.getElementById('datangModal').classList.remove('flex');
        document.getElementById('datangModal').classList.add('hidden');
    }

    function openSelesaiModal() {
        document.getElementById('selesaiForm').action = '/admin/manajemen-tamu/{{ $guest->id }}/selesai';
        document.getElementById('selesaiModal').classList.remove('hidden');
        document.getElementById('selesaiModal').classList.add('flex');
    }

    function closeSelesaiModal() {
        document.getElementById('selesaiModal').classList.remove('flex');
        document.getElementById('selesaiModal').classList.add('hidden');
    }
</script>
@endsection