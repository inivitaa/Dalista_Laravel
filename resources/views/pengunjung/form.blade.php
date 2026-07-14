@extends('pengunjung.layout')

@section('content')

<div class="min-h-screen flex justify-center px-2 sm:px-4 py-6 md:py-10">
    <div class="w-full max-w-3xl">

        <!-- HEADER -->
        <div class="text-center mb-6 px-2">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Formulir Pendaftaran Tamu</h1>
            <p class="text-sm sm:text-base text-gray-500 mt-2">Silakan isi formulir di bawah ini untuk mendaftar sebagai tamu. Pastikan semua informasi yang Anda berikan adalah akurat.</p>
        </div>

        <!-- PROGRESS (RESPONSIVE FIX) -->
        <div class="mb-8 md:mb-12 px-2">
            <div class="flex items-center justify-between w-full relative">

                <!-- Step 1 -->
                <div class="flex flex-col items-center z-10">
                    <div id="circle1" class="circle active">1</div>
                    <span class="label active">Data Diri</span>
                </div>

                <!-- Line 1 -->
                <div class="line flex-1 mx-2 sm:mx-4" id="line1"></div>

                <!-- Step 2 -->
                <div class="flex flex-col items-center z-10">
                    <div id="circle2" class="circle">2</div>
                    <span class="label">Informasi</span>
                </div>

                <!-- Line 2 -->
                <div class="line flex-1 mx-2 sm:mx-4" id="line2"></div>

                <!-- Step 3 -->
                <div class="flex flex-col items-center z-10">
                    <div id="circle3" class="circle">3</div>
                    <span class="label">Kunjungan</span>
                </div>

            </div>
        </div>

        <!-- CARD -->
        <div class="bg-white/80 backdrop-blur-2xl rounded-[24px] sm:rounded-[40px] shadow-[0_20px_60px_rgba(0,0,0,0.08)] border border-white/60 p-4 sm:p-6 md:p-10 mx-2 sm:mx-0">
            <form action="/guest/store" 
                  method="POST" 
                  enctype="multipart/form-data"
                  id="formMultiStep">

                  @csrf

                <!-- STEP 1 -->
                <div class="step" id="step1">
                    <h2 class="text-lg sm:text-xl font-semibold mb-4 text-gray-800">Data Diri</h2>

                    <div class="space-y-4">
                        <input id="nama" name="nama" class="input" placeholder="Nama Lengkap">
                        <input id="email" name="email" class="input" placeholder="Email">
                        <input id="nohp" name="nohp" class="input" placeholder="No HP">

                        <select id="jk" name="jk" class="input">
                            <option value="">Jenis Kelamin</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>

                        <input id="alamat" name="alamat" class="input" placeholder="Alamat">
                    </div>
                </div>

                <!-- STEP 2 -->
                <div class="step hidden" id="step2">
                    <h2 class="text-lg sm:text-xl font-semibold mb-4 text-gray-800">Informasi Tambahan</h2>

                    <div class="space-y-4">
                        <select id="profesi" name="profesi" class="input">
                            <option value="">-- Pilih Profesi --</option>
                            <option value="PNS">PNS</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Karyawan Swasta">Karyawan Swasta</option>
                            <option value="Guru/Dosen">Guru/Dosen</option>
                            <option value="TNI/Polri">TNI/Polri</option>
                            <option value="Dokter/Nakes">Dokter/Nakes</option>
                            <option value="Petani">Petani</option>
                            <option value="Buruh">Buruh</option>
                            <option value="Pengacara">Pengacara</option>
                            <option value="Konsultan">Konsultan</option>
                            <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>

                        <input id="profesi_lainnya" name="profesi_lainnya" class="input hidden" placeholder="Tulis profesi lainnya">

                        <select id="pendidikan" name="pendidikan" class="input">
                            <option value="">-- Pendidikan Terakhir --</option>
                            <option>TIDAK SEKOLAH</option>
                            <option>SD</option>
                            <option>SMP</option>
                            <option>SMA/SMK</option>
                            <option>D3</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                        </select>

                        <input name="instansi" class="input" placeholder="Nama Perusahaan/Instansi">
                    </div>
                </div>

                <!-- STEP 3 -->
                <div class="step hidden" id="step3">
                    <h2 class="text-lg sm:text-xl font-semibold mb-4 text-gray-800">Informasi Kunjungan</h2>

                    <div class="space-y-4">
                        <select id="tujuan" name="tujuan" class="input">
                            <option value="">-- Pilih Tujuan Kunjungan --</option>
                            @foreach($tujuanKunjungan as $tujuan)
                                <option value="{{ $tujuan->nama_layanan }}">
                                    {{ $tujuan->nama_layanan }} 
                                </option>
                            @endforeach
                        </select>

                        <input id="tujuan_lainnya"
                            name="tujuan_lainnya"
                            class="input hidden"
                            placeholder="Tulis tujuan kunjungan lainnya">

                        <select id="info" name="informasi" class="input">
                            <option value="">-- Cara memperoleh informasi --</option>
                            <option>Melihat/Membaca/Mendengarkan/Mencatat</option>
                            <option>Mendapatkan Salinan informasi</option>
                        </select>

                        <!-- UPLOAD MODERN -->
                        <div id="uploadBox" class="upload-box p-4 sm:p-8">
                            <input type="file" id="fileInput" name="file_upload" class="hidden">
                            <div class="text-center">
                                <div class="text-4xl sm:text-5xl text-gray-400 mb-2 sm:mb-3">📁</div>
                                <p class="text-blue-600 font-medium text-sm sm:text-base">Klik untuk upload</p>
                                <p class="text-gray-500 text-xs sm:text-sm">atau drag file ke sini</p>
                                <p class="text-gray-400 text-[11px] sm:text-xs mt-2">
                                    Maksimal 1 file, ukuran 5MB. JPG, PNG, PDF
                                </p>
                            </div>
                        </div>

                        <img id="previewImg" class="hidden mt-3 rounded-xl max-h-40 mx-auto">
                        <p id="fileName" class="hidden text-sm mt-2 text-center break-all text-gray-600"></p>

                        <textarea id="keterangan" name="keterangan" class="input h-24 resize-none" placeholder="Keterangan"></textarea>
                    </div>
                </div>

                <!-- ERROR -->
                <p id="errorMsg" class="text-red-500 hidden mt-2 text-sm"></p>

                <!-- BUTTON -->
                <div class="flex justify-between mt-6 gap-4">
                    <button type="button" onclick="prevStep()" id="btnPrev"
                        class="hidden bg-gray-200 text-gray-700 px-5 py-2.5 sm:px-6 sm:py-3 rounded-xl sm:rounded-2xl font-semibold hover:bg-gray-300 transition duration-200 text-sm sm:text-base">
                        Kembali
                    </button>

                    <button type="button" onclick="nextStep()" id="btnNext"
                        class="ml-auto bg-gradient-to-r from-blue-600 to-blue-500 text-white px-6 py-2.5 sm:px-8 sm:py-3 rounded-xl sm:rounded-2xl shadow-lg hover:scale-[1.02] active:scale-95 transition duration-200 font-semibold text-sm sm:text-base">                               
                         Lanjut
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
.input {
    width: 100%;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 12px 16px;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    font-size: 14px;
}
@media (min-width: 640px) {
    .input {
        border-radius: 20px;
        padding: 16px 18px;
        font-size: 15px;
    }
}
.input:focus {
    outline: none;
    border-color: #3b82f6;
    box-shadow: 0 0 0 5px rgba(59,130,246,0.15);
    background: white;
}

/* progress bar responsive */
.circle {
    width: 40px;
    height: 40px;
    border-radius: 9999px;
    border: 2px solid #d1d5db;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
.circle.active {
    background: linear-gradient(to right,#2563eb,#3b82f6);
    color: white;
    border-color: #2563eb;
    transform: scale(1.05);
}
.label {
    font-size: 11px;
    margin-top: 6px;
    color: #6b7280;
    text-align: center;
    white-space: nowrap;
}
.label.active {
    color: #2563eb;
    font-weight: 700;
}

/* Perubahan Krusial: Menggunakan flex-1 dan margin-bottom dikurangi agar lurus dengan lingkaran */
.line {
    height: 4px;
    background: #d1d5db;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 20px; 
}

@media (min-width: 640px) {
    .circle {
        width: 60px;
        height: 60px;
        font-size: 18px;
    }
    .label {
        font-size: 14px;
        margin-top: 10px;
    }
    .line {
        margin-bottom: 28px;
    }
}

.line.active {
    background: #dbeafe;
}

.line.active::after {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle,#2563eb 2px,transparent 2px);
    background-size: 18px 100%;
    animation: dotsMove 1s linear infinite;
}

@keyframes dotsMove {
    from { background-position: 0 0; }
    to { background-position: 18px 0; }
}

/* upload */
.upload-box {
    border: 2px dashed #d1d5db;
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.upload-box:hover {
    border-color: #2563eb;
    background: #eff6ff;
}
</style>

<script>
let step = 1;

function showStep(s){
    document.querySelectorAll('.step').forEach(e => e.classList.add('hidden'));
    document.getElementById('step' + s).classList.remove('hidden');

    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');

    if (s === 1) {
        btnPrev.classList.add('hidden');
    } else {
        btnPrev.classList.remove('hidden');
    }

    if (s === 3) {
        btnNext.innerText = "Kirim Data ✨";
    } else {
        btnNext.innerText = "Lanjut";
    }

    for(let i = 1; i <= 3; i++){
        document.getElementById('circle' + i).classList.toggle('active', i <= s);
        document.querySelectorAll('.label')[i - 1].classList.toggle('active', i <= s);
    }

    if(document.getElementById('line1')) document.getElementById('line1').classList.toggle('active', s > 1);
    if(document.getElementById('line2')) document.getElementById('line2').classList.toggle('active', s > 2);
}

/* VALIDASI + NEXT STEP */
function nextStep(){
    let error = "";

    if(step === 1){
        if(
            !document.getElementById('nama').value.trim() ||
            !document.getElementById('email').value.trim() ||
            !document.getElementById('nohp').value.trim() ||
            !document.getElementById('jk').value.trim() ||
            !document.getElementById('alamat').value.trim()
        ){
            error = "Lengkapi semua data diri!";
        }
    }

    if(step === 2){
        let profesi = document.getElementById('profesi').value.trim();
        let pendidikan = document.getElementById('pendidikan').value.trim();
        let instansi = document.querySelector('input[name="instansi"]').value.trim();

        if(profesi === "" || pendidikan === "" || instansi === ""){
            error = "Lengkapi informasi tambahan!";
        }

        if(profesi === "Lainnya" && document.getElementById('profesi_lainnya').value.trim() === ""){
            error = "Isi profesi lainnya!";
        }
    }

    if(step === 3){
        if(
            !document.getElementById('tujuan').value.trim() ||
            !document.getElementById('info').value.trim() ||
            !document.getElementById('keterangan').value.trim()
        ){
            error = "Lengkapi data kunjungan!";
        }
        if(
            document.getElementById('tujuan').value === "Lainnya" &&
            document.getElementById('tujuan_lainnya').value.trim() === ""
        ){
            error = "Isi tujuan kunjungan lainnya!";
        }
    }

    if(error){
        Swal.fire({
            icon: 'warning',
            title: 'Form belum lengkap',
            text: error,
            confirmButtonColor: '#2563eb'
        });
        return;
    }

    if(step < 3){
        step++;
        showStep(step);
    } else {
        document.getElementById('formMultiStep').submit();
    }
}

function prevStep(){
    step--;
    showStep(step);
}

showStep(step);

/* PROFESI LAINNYA */
document.getElementById('profesi').addEventListener('change', function(){
    document.getElementById('profesi_lainnya').classList.toggle('hidden', this.value !== 'Lainnya');
});

/* TUJUAN LAINNYA */
document.getElementById('tujuan').addEventListener('change', function(){
    document.getElementById('tujuan_lainnya').classList.toggle('hidden', this.value !== 'Lainnya');
});

/* UPLOAD */
const box = document.getElementById('uploadBox');
const input = document.getElementById('fileInput');
const preview = document.getElementById('previewImg');
const fileName = document.getElementById('fileName');

box.onclick = () => input.click();
input.onchange = () => handle(input.files[0]);

function handle(file){
    if(!file) return;

    if(file.size > 5 * 1024 * 1024){
        Swal.fire({
            icon: 'error',
            title: 'File terlalu besar',
            text: 'Maksimal ukuran file 5MB',
            confirmButtonColor: '#2563eb'
        });
        return;
    }

    fileName.innerText = file.name;
    fileName.classList.remove('hidden');

    if(file.type.startsWith('image/')){
        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
    } else {
        preview.classList.add('hidden');
    }
}
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Pendaftaran Berhasil',
    html: `
        <p style="margin-bottom:10px">Data tamu berhasil dikirim.</p>
        <div style="background:#f3f4f6; padding:14px; border-radius:12px; font-size:22px; font-weight:bold; letter-spacing:2px;">
            {{ session('tracking_code') }}
        </div>
        <p style="margin-top:12px; font-size:13px; color:#6b7280;">Simpan kode ini untuk cek status pengajuan.</p>
    `,
    confirmButtonColor: '#2563eb'
});
</script>
@endif

@endsection