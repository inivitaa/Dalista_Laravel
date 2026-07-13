<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Guest;
use App\Models\Profesi;
use App\Models\Pendidikan;
use App\Models\BidangTujuan;
use App\Models\Layanan; // Import model Layanan
use App\Models\Survey; // Import model Survey
use App\Models\LayananDisnaker; // Import model LayananDisnaker
use Barryvdh\DomPDF\Facade\Pdf; // Import PDF facade
use App\Models\Admin;
use App\Models\WebVisitor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class GuestController extends Controller
{
    public function loginForm()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $admin = Admin::where(
            'email',
            $request->email
        )->first();

        if (!$admin) {

            return back()
                ->with('error', 'Email tidak ditemukan');

        }

        if (!Hash::check(
            $request->password,
            $admin->password
        )) {

            return back()
                ->with('error', 'Password salah');

        }

        session([
            'admin_id' => $admin->id,
            'admin_nama' => $admin->nama_lengkap
        ]);

        return redirect('/admin/dashboard');
    }
    public function profil()
    {
        $admin = Admin::find(
            session('admin_id')
        );

        return view(
            'admin.profil',
            compact('admin')
        );
    }
    public function logout()
    {
        session()->flush();

        return redirect('/admin/login');
    }
        public function welcome()
    {
        $visitorHariIni = WebVisitor::whereDate(
            'created_at',
            today()
        )->count();

        $totalVisitor = WebVisitor::count();

        return view(
            'pengunjung.welcome',
            compact(
                'visitorHariIni',
                'totalVisitor'
            )
        );
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Admin::find(session('admin_id'));

        if (!Hash::check(
            $request->old_password,
            $admin->password
        )) {

            return back()->with(
                'error',
                'Password lama tidak sesuai'
            );
        }

        $admin->password = Hash::make(
            $request->new_password
        );

        $admin->save();

        return back()->with(
            'success',
            'Password berhasil diperbarui'
        );
    }
        // 1. FUNGSI SIMPAN DATA TAMU (STEP FORM)
    public function form()
    {
        $tujuanKunjungan = Layanan::all();

        return view(
            'pengunjung.form',
            compact('tujuanKunjungan')
        );
    }
    public function survey()
    {
        $layananUmum = Layanan::all();

        return view(
            'pengunjung.survey',
            compact('layananUmum')
        );
    }

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
        $bidangId = null;
        $guest = Guest::create([
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
            'tracking_code' => 'DLT-' . date('Y') . '-' . str_pad(rand(1,9999), 4, '0', STR_PAD_LEFT)
        ]); 

        return redirect()->back()->with([
            'success' => true,
            'tracking_code' => $guest->tracking_code
        ]);    
}

    // 2. FUNGSI HALAMAN MANAJEMEN TAMU (ADMIN)
    public function index(Request $request)
    {
        $query = Guest::with([
            'profesi', 
            'bidangTujuan', 
            'layanan'
            ]);

            // $guests = $query
            // ->orderBy('waktu_dibuat', 'desc')
            // ->paginate($perPage)
            // ->withQueryString();

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

        $filteredQuery = clone $query;

        $perPage = $request->per_page ?: 10;
        
        $guests = $query
            ->orderBy('waktu_dibuat', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        $totalTamu = (clone $filteredQuery)->count();

        $hariIni = (clone $filteredQuery)
            ->whereDate('waktu_dibuat', today())
            ->count();

        $uploadFile = (clone $filteredQuery)
            ->whereNotNull('file_upload')
            ->count();


        $layananUmum = Layanan::all();
        $bidangTujuan = BidangTujuan::all();
        $layananDisnaker = LayananDisnaker::all();

        return view(
            'admin.manajemen-tamu', 
            compact('guests',
                'totalTamu', 
                'hariIni', 
                'uploadFile',
                'layananUmum',
                'bidangTujuan',
                'layananDisnaker'
            ));
    }

    public function destroyLayanan($id)
    {
        BidangTujuan::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Layanan berhasil dihapus'
        );
    }

    public function updateLayanan(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255'
        ]);

        $layanan = BidangTujuan::findOrFail($id);

        $layanan->update([
            'bidang' => $request->nama_layanan
        ]);

        return back()->with(
            'success',
            'Layanan berhasil diperbarui'
        );
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
        $currentYear = date('Y');
        $monthlyData = WebVisitor::select(
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', $currentYear)
            ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
            ->orderBy('month', 'asc')
            ->pluck('count', 'month')
            ->toArray();

        // Menyusun array 12 bulan (Jan - Des) dengan default nilai 0 jika bulan kosong
        $visitorCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $visitorCounts[] = $monthlyData[$i] ?? 0;
        }

        // 2. Ambil data tipe perangkat untuk Doughnut Chart
        $deviceData = WebVisitor::select('device_type', DB::raw('COUNT(*) as count'))
            ->groupBy('device_type')
            ->pluck('count', 'device_type')
            ->toArray();

        // Sesuaikan urutan array dengan label JavaScript: ['Desktop', 'Mobile', 'Tablet']
        $deviceCounts = [
            $deviceData['Desktop'] ?? 0,
            $deviceData['Mobile'] ?? 0,
            $deviceData['Tablet'] ?? 0,
        ];

        // Return view dengan menyertakan variabel visitorCounts dan deviceCounts
        return view('admin.dashboard', compact(
            'total', 'menunggu', 'datang', 'terjadwal', 'selesai', 
            'recentGuests', 'avgRating', 'recentSurveys',
            'visitorCounts', 'deviceCounts','pieData'
        ));
    }

    public function storeSurvey(Request $request) 
    {
        // Tambahkan validasi untuk 5 aspek pertanyaan dari frontend
        $request->validate([
            'nama' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:500',
            'layanan' => 'required',
            'pertanyaan_0' => 'required|string',
            'pertanyaan_1' => 'required|string',
            'pertanyaan_2' => 'required|string',
            'pertanyaan_3' => 'required|string',
            'pertanyaan_4' => 'required|string',
        ]);
    
        // Simpan semua data termasuk p1 sampai p5
        Survey::create([
            'nama' => $request->nama,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'layanan_diakses' => $request->layanan,
            'guest_id' => $request->guest_id, // atau gunakan auth()->id() jika tamu harus login
            'p1' => $request->pertanyaan_0,
            'p2' => $request->pertanyaan_1,
            'p3' => $request->pertanyaan_2,
            'p4' => $request->pertanyaan_3,
            'p5' => $request->pertanyaan_4,
        ]);
    
        return redirect('/')->with('success_survey', 'Terima kasih atas penilaian Anda!');
    }

    public function destroy($id)
    {
        Guest::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data tamu berhasil dihapus');
    }

    public function checkStatus(Request $request)
    {
        $guest = Guest::where(
            'tracking_code',
            $request->tracking_code
        )->first();

        return view('pengunjung.status', compact('guest'));
    }

    public function exportCsv(Request $request)
    {
        $periode = $request->periode;
        $guests = Guest::query();
        $bidang = $request->bidang;

        if ($periode) {
            $guests->where(
                'waktu_dibuat', 
                '>=', 
                now()->subDays($periode)
            );
        }

        if ($bidang) {
            $guests->where(
                'keperluan',
                $bidang
            );
        }

        $guests = $guests->get();
        $fileName = $periode
            ? 'Laporan-DALISTA-' . $periode . '-hari.csv'
            : 'Laporan-DALISTA.csv';
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
                'Keperluan',
                'Status',
                'Tanggal'
            ]);

            foreach ($guests as $guest) {

                fputcsv($file, [
                    $guest->nama,
                    $guest->email,
                    '"' . $guest->nomor_telp,
                    $guest->asal_instansi,
                    $guest->keperluan,
                    $guest->status_kunjungan,
                    $guest->waktu_dibuat
                ]);

            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function lupaToken(Request $request)
    {
        $guest = Guest::where(
            'email',
            $request->email
        )->first();

        return view(
            'pengunjung.lupa-token',
            compact('guest')
        );
    }

        public function surveyAdmin()
        {
            $query = Survey::query();

            if(request('periode')){
                $query->where('created_at', '>=', now()->subDays(request('periode')));
            }
            if(request('bidang')){
                $query->where('layanan_diakses', request('bidang'));
            }
            if(request('search')){
                $query->where('nama', 'like', '%' . request('search') . '%');
            }
            if(request('layanan')){
                $query->where('layanan_diakses', request('layanan'));
            }
            if(request('rating')){
                $query->where('rating', request('rating'));
            }

            $chartData = [
                (clone $query)->where('rating', 1)->count(),
                (clone $query)->where('rating', 2)->count(),
                (clone $query)->where('rating', 3)->count(),
                (clone $query)->where('rating', 4)->count(),
                (clone $query)->where('rating', 5)->count(),
            ];

            $totalSurvey = $query->count();
            $avgRating = round($query->avg('rating') ?? 0, 1);
            $hebat = (clone $query)->where('rating', 5)->count();
            $buruk = (clone $query)->where('rating', 1)->count();

            $caseExpression = function($column) {
                return "AVG(CASE 
                    WHEN $column = 'SS' THEN 5 
                    WHEN $column = 'S' THEN 4 
                    WHEN $column = 'KS' THEN 3 
                    WHEN $column = 'TS' THEN 2 
                    WHEN $column = 'STS' THEN 1 
                    ELSE 0 
                END)";
            };

            $avgAspekRaw = (clone $query)->selectRaw("
                {$caseExpression('p1')} as p1,
                {$caseExpression('p2')} as p2,
                {$caseExpression('p3')} as p3,
                {$caseExpression('p4')} as p4,
                {$caseExpression('p5')} as p5
            ")->first();

            $avgAspek = [
                'p1' => round($avgAspekRaw->p1 ?? 0, 1),
                'p2' => round($avgAspekRaw->p2 ?? 0, 1),
                'p3' => round($avgAspekRaw->p3 ?? 0, 1),
                'p4' => round($avgAspekRaw->p4 ?? 0, 1),
                'p5' => round($avgAspekRaw->p5 ?? 0, 1),
            ];

            $perPage = request('per_page', 10);
            $surveys = $query->latest()->paginate($perPage)->withQueryString();
            $layananUmum = Layanan::all();
            return view('admin.survey', compact(
                'surveys', 'totalSurvey', 'avgRating', 'hebat', 'buruk', 'chartData', 'avgAspek','layananUmum'
            ));
        }
        public function exportSurvey()
        {
            $periode = request('periode');
            $bidang = request('bidang');

            $surveys = Survey::query();
            if ($periode) {

                $surveys->where(
                    'created_at',
                    '>=',
                    now()->subDays($periode)
                );

            }
            if ($bidang) {
                $surveys->where(
                    'layanan_diakses',
                    $bidang
                );

            }
            $surveys = $surveys->get();

            $fileName = $periode
                ? "laporan-survey-{$periode}-hari.csv"
                : "laporan-survey.csv";


            $headers = [

                "Content-type" => "text/csv",

                "Content-Disposition" => "attachment; filename=$fileName",

                "Pragma" => "no-cache",

                "Cache-Control" => "must-revalidate",

                "Expires" => "0"

            ];

            $columns = [

                'Nama',

                'Layanan',

                'Rating',

                'Ulasan',

                'Tanggal'

            ];

            $callback = function() use($surveys, $columns) {

                $file = fopen('php://output', 'w');

                fputcsv($file, $columns);

                foreach($surveys as $survey){

                    fputcsv($file, [

                        $survey->nama,

                        $survey->layanan_diakses,

                        match($survey->rating){

                            1 => 'Buruk',

                            2 => 'Kurang',

                            3 => 'Cukup',

                            4 => 'Puas',

                            5 => 'Hebat',

                            default => '-'

                            },

                        $survey->ulasan,

                        $survey->created_at->format('d-m-Y')

                    ]);

                }

                fclose($file);

            };

            return response()->stream(
                $callback,
                200,
                $headers
            );
        }
        

        public function laporanAdmin()
        {
            $periode = request('periode');
            $bidang = request('bidang');
            // QUERY TAMU
            $guestQuery = Guest::query();

            if ($periode) {

                $guestQuery->where(
                    'waktu_dibuat',
                    '>=',
                    now()->subDays($periode)
                );
            }
            if ($bidang) {

                $guestQuery->whereHas('bidangTujuan', function ($q) use ($bidang) {
                    $q->where('bidang', $bidang
                    );
                }
                );

            }

            $totalTamu = $guestQuery->count();

            $totalKunjungan = $totalTamu;

            // QUERY SURVEY
            $surveyQuery = Survey::query();

            if ($periode) {

                $surveyQuery->where(
                    'created_at',
                    '>=',
                    now()->subDays($periode)
                );
            }
            if ($bidang) {

                $surveyQuery->where(
                    'layanan_diakses',
                    $bidang
                );
            }
            

            $surveys = $surveyQuery->get();

            $totalSurvey = $surveys->count();

            // AMAN JIKA SURVEY KOSONG
            $avgRating = $surveys->count()
                ? round($surveys->avg('rating'), 1)
                : 0;

            // LAYANAN TERBANYAK
            $layananTerbanyak = Survey::query();

            if ($periode) {

                $layananTerbanyak->where(
                    'created_at',
                    '>=',
                    now()->subDays($periode)
                );
            
            }
                if ($bidang) {
    
                    $layananTerbanyak->where(
                        'layanan_diakses',
                        $bidang
                    );
    
                }

            $layananTerbanyak = $layananTerbanyak
                ->select('layanan_diakses')
                ->selectRaw('COUNT(*) as total')
                ->groupBy('layanan_diakses')
                ->orderByDesc('total')
                ->first();

            // RERATA HARIAN
            $jumlahHari = $periode ?: 30;

            $rerataHarian = $totalTamu
                ? round($totalTamu / $jumlahHari, 1)
                : 0;

            $waktuRata = '15 Menit';

            $statusChart = [
                Guest::where('status_kunjungan', 'Menunggu')->count(),
                Guest::where('status_kunjungan', 'Terjadwal')->count(),
                Guest::where('status_kunjungan', 'Datang')->count(),
                Guest::where('status_kunjungan', 'Selesai')->count(),
            ];
            $bidangChart = [
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Kepala Dinas'))->count(),
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Sekretariat'))->count(),
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Bidang Pelatihan Kerja dan Produktivitas'))->count(),
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Bidang Hubungan Industrial dan Jaminan Sosial'))->count(),
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Bidang Pengawasan Ketenagakerjaan'))->count(),
                Guest::whereHas('bidangTujuan', fn($q) => $q->where('bidang', 'Bidang Penempatan dan Transmigrasi'))->count(),
            ];
            $layananUmum = Layanan::all();
            return view(
                'admin.laporan',
                compact(
                    'periode',
                    'bidang',
                    'totalTamu',
                    'totalSurvey',
                    'surveys',
                    'avgRating',
                    'layananTerbanyak',
                    'totalKunjungan',
                    'rerataHarian',
                    'waktuRata',
                    'statusChart',
                    'bidangChart',
                    'layananUmum'
                )
            );
        }
    

    public function exportPdf()
    {
        $periode = request('periode');
        $layanan = request('layanan');

        $guestQuery = Guest::query();

        if ($periode) {

            $guestQuery->where(
                'waktu_dibuat',
                '>=',
                now()->subDays($periode)
            );

        }

        $surveyQuery = Survey::query();

        if ($periode) {

            $surveyQuery->where(
                'created_at',
                '>=',
                now()->subDays($periode)
            );

        }

        if ($layanan) {

            $surveyQuery->where(
                'layanan_diakses',
                $layanan
            );

        }

        $guests = $guestQuery->get();

        $surveys = $surveyQuery->get();

        $totalTamu = $guests->count();

        $totalKunjungan = $totalTamu;

        $totalSurvey = $surveys->count();

        $avgRating = $surveys->count()
            ? round($surveys->avg('rating'), 1)
            : 0;

        $layananTerbanyak = clone $surveyQuery;

        $layananTerbanyak = $layananTerbanyak
            ->select('layanan_diakses')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('layanan_diakses')
            ->orderByDesc('total')
            ->first();

        $jumlahHari = $periode ?: 30;

        $rerataHarian = $totalTamu
            ? round($totalTamu / $jumlahHari, 1)
            : 0;

        $waktuRata = '15 Menit';

        $menunggu = $guests
            ->where('status_kunjungan', 'Menunggu')
            ->count();

        $terjadwal = $guests
            ->where('status_kunjungan', 'Terjadwal')
            ->count();

        $datang = $guests
            ->where('status_kunjungan', 'Datang')
            ->count();

        $selesai = $guests
            ->where('status_kunjungan', 'Selesai')
            ->count();

        $statusTerbanyak =collect([
            'Menunggu' => $menunggu,
            'Terjadwal' => $terjadwal,
            'Datang' => $datang,
            'Selesai' => $selesai
        ])->sortDesc()->keys()->first();

        $jumlahIsiSurvey = $totalSurvey;
        $jumlahBelumIsiSurvey = $totalTamu - $totalSurvey;
        $persentaseSurvey = $totalTamu
            ? round(($totalSurvey / $totalTamu) * 100, 1)
            : 0;
        $pieData = [
            'Menunggu' => $menunggu,
            'Terjadwal' => $terjadwal,
            'Datang' => $datang,
            'Selesai' => $selesai,
        ];
        // =====================

// ===============================
// Statistik Layanan
// ===============================

$layananStatistik = Guest::select(
        'keperluan',
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('keperluan')
    ->orderByDesc('total')
    ->get();

$bidangStatistik = Guest::select(
        'bidang_tujuan_id',
        DB::raw('COUNT(*) as total')
    )
    ->whereNotNull('bidang_tujuan_id')
    ->with('bidangTujuan')
    ->groupBy('bidang_tujuan_id')
    ->orderByDesc('total')
    ->get();

// ===============================
// Statistik Layanan Disnaker
// ===============================

$layananDisnakerStatistik = Guest::select(
        'layanan_disnaker_id',
        DB::raw('COUNT(*) as total')
    )
    ->whereNotNull('layanan_disnaker_id')
    ->with('layanan')
    ->groupBy('layanan_disnaker_id')
    ->orderByDesc('total')
    ->get();

        $pdf = Pdf::loadView(
            'admin.pdf.laporan',
            compact(
                'periode',
                'layanan',
                'totalTamu',
                'totalSurvey',
                'avgRating',
                'layananTerbanyak',
                'totalKunjungan',
                'rerataHarian',
                'waktuRata',
                'guests',
                'surveys',
                'menunggu',
                'terjadwal',
                'datang',
                'selesai',
                'statusTerbanyak',
                'persentaseSurvey',
                'jumlahIsiSurvey',
                'jumlahBelumIsiSurvey',
                'pieData',
                'layananStatistik',
                'persentaseSurvey',
                'bidangStatistik'
            )
        );

        return $pdf->download(
            'Laporan-DALISTA.pdf'
        );
    }

}