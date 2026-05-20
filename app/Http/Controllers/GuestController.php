<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Profesi;
use App\Models\Pendidikan;
use App\Models\BidangTujuan;
use App\Models\Survey; // Import model Survey

class GuestController extends Controller
{
    // 1. FUNGSI SIMPAN DATA TAMU (STEP FORM)
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'nohp' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'profesi' => 'required',
            'pendidikan' => 'required',
            'tujuan' => 'required',
            'informasi' => 'required',
            'keterangan' => 'required',
        ]);

        $fileName = null;
        if ($request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $fileName = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/file_upload', $fileName);
        }

        // Cari ID Relasi
        $profesiId = Profesi::where('nama_profesi', trim($request->profesi))->first()?->id;
        $pendidikanId = Pendidikan::where('pendidikan_terakhir', trim($request->pendidikan))->first()?->id;
        $bidangId = BidangTujuan::where('bidang', trim($request->tujuan))->first()?->id;

        Guest::create([
            'nama' => $request->nama,
            'profesi_id' => $profesiId,
            'email' => $request->email,
            'nomor_telp' => $request->nohp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jk,
            'pendidikan_terakhir_id' => $pendidikanId,
            'asal_instansi' => $request->instansi,
            'keperluan' => $request->tujuan,
            'bidang_tujuan_id' => $bidangId,
            'catatan_tambahan' => $request->keterangan,
            'file_upload' => $fileName,
            'file_name' => $fileName,
            'status_kunjungan' => 'Menunggu',
            'waktu_dibuat' => now()
        ]); 

        return redirect()->back()->with('success', 'Data berhasil dikirim');
    }

    // 2. FUNGSI HALAMAN MANAJEMEN TAMU (ADMIN)
    public function index(Request $request)
    {
        $query = Guest::query();

        if($request->search){
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('asal_instansi', 'like', "%{$search}%");
            });
        }

        if (!empty($request->status)) {
            $query->where('status_kunjungan', $request->status);
        }

        if($request->waktu){
            if($request->waktu == 'Hari Ini') $query->whereDate('waktu_dibuat', today());
            elseif($request->waktu == 'Minggu Ini') $query->whereBetween('waktu_dibuat', [now()->startOfWeek(), now()->endOfWeek()]);
            elseif($request->waktu == 'Bulan Ini') $query->whereMonth('waktu_dibuat', now()->month);
        }

        $guests = $query->orderBy('waktu_dibuat', 'desc')->get();
        return view('admin.manajemen-tamu', compact('guests'));
    }

    // 3. FUNGSI DASHBOARD (ADMIN)
    public function dashboard()
    {
        // Statistik Tamu
        $total = Guest::count();
        $menunggu = Guest::where('status_kunjungan', 'Menunggu')->count();
        $datang = Guest::where('status_kunjungan', 'Datang')->count();
        $terjadwal = Guest::where('status_kunjungan', 'Terjadwal')->count();
        $selesai = Guest::where('status_kunjungan', 'Selesai')->count();
        $recentGuests = Guest::orderBy('waktu_dibuat', 'desc')->take(5)->get();

        $pieData = [

            $menunggu,
            $terjadwal,
            $datang,
            $selesai

        ];

        // Statistik Survey (SKM)
        $avgRating = number_format(Survey::query()->avg('rating') ?? 0, 1);
        $recentSurveys = Survey::latest()->take(5)->get();

        // Data Chart
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = Guest::whereMonth('waktu_dibuat', $i)->count();
        }

        return view('admin.dashboard', compact(
            'total', 'menunggu', 'datang', 'terjadwal', 'selesai', 
            'recentGuests', 'chartData', 'avgRating', 'recentSurveys', 'pieData'
        ));
    }

    // 4. FUNGSI SIMPAN SURVEY (SKM)
    public function storeSurvey(Request $request) 
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
            'layanan' => 'required'
        ]);

        Survey::create([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'layanan_diakses' => $request->layanan,
            'guest_id' => $request->guest_id
        ]);

        return redirect('/')->with('success_survey', 'Terima kasih atas penilaian Anda!');
    }

    // 5. UPDATE STATUS & DELETE
    public function updateStatus(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->status_kunjungan = $request->status;
        $guest->save();
        return redirect()->back();
    }

    public function destroy($id)
    {
        Guest::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus');
    }

    public function exportCsv(Request $request)
    {
        $bulan = $request->bulan;

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $guests = Guest::query();

        if ($bulan) {

            $guests->whereMonth('waktu_dibuat', $bulan);

        }

        $guests = $guests->get();

        $fileName = $bulan
            ? 'data_tamu_' . strtolower($namaBulan[$bulan]) . '_2026.csv'
            : 'data_tamu_semua.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
        ];

        $callback = function () use ($guests) {

            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Nama',
                'Email',
                'Nomor Telepon',
                'Instansi',
                'Status'
            ]);

            foreach ($guests as $guest) {

                fputcsv($file, [
                    $guest->nama,
                    $guest->email,
                    '"' . $guest->nomor_telp,
                    $guest->asal_instansi,
                    $guest->status_kunjungan
                ]);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}