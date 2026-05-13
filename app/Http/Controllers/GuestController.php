<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Profesi;
use App\Models\Pendidikan;
use App\Models\BidangTujuan;

class GuestController extends Controller
{
    public function store(Request $request)
    {
        // VALIDASI
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

        // upload file
        $fileName = null;

        if ($request->hasFile('file_upload')) {

            $file = $request->file('file_upload');

            $fileName = time().'_'.$file->getClientOriginalName();

            $file->storeAs('public/file_upload', $fileName);
        }

        // simpan database
            $profesi = $request->profesi;

        if($request->profesi == "Lainnya"){
            $profesi = $request->profesi_lainnya;
        }

        $profesiId = null;

        if($request->profesi){

            $profesi = Profesi::where(
                'nama_profesi',
                trim($request->profesi)
            )->first();

            if($profesi){

                $profesiId = $profesi->id;

            }

        }

        $pendidikanId = null;

        if($request->pendidikan){

            $pendidikan = Pendidikan::where(
                'pendidikan_terakhir',
                trim($request->pendidikan)
            )->first();

            if($pendidikan){

                $pendidikanId = $pendidikan->id;

            }

        }

        $bidangId = null;

        if($request->tujuan){

            $bidang = BidangTujuan::where(
                'bidang',
                trim($request->tujuan)
            )->first();

            if($bidang){

                $bidangId = $bidang->id;

            }

        }

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
    
    public function index(Request $request)
    {
        $query = Guest::query();

        // SEARCH
        if($request->search){

            $search = $request->search;

            $query->where(function($q) use ($search){

                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('profesi_id', 'like', "%{$search}%")
                ->orWhere('asal_instansi', 'like', "%{$search}%");

            });

        }

        // FILTER STATUS
        if (!empty($request->status)) {

            $query->where('status_kunjungan', $request->status);

        }

        // FILTER WAKTU
        if($request->waktu){

            if($request->waktu == 'Hari Ini'){

                $query->whereDate('waktu_dibuat', today());

            }

            elseif($request->waktu == 'Minggu Ini'){

                $query->whereBetween('waktu_dibuat', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);

            }

            elseif($request->waktu == 'Bulan Ini'){

                $query->whereMonth('waktu_dibuat', now()->month);

            }

        }

        $guests = $query
            ->orderByRaw("
                CASE
                    WHEN status_kunjungan = 'Selesai' THEN 1
                    ELSE 0
                END
            ")
            ->orderBy('waktu_dibuat', 'desc')
            ->get();

        return view('admin.manajemen-tamu', compact('guests'));
    }
    
    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);

        $guest->delete();

        return redirect()->back()
            ->with('success', 'Data tamu berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);

        $guest->status_kunjungan = $request->status;
        $guest->save();

        return redirect()->back();
    }
    public function dashboard()
{
    $total = Guest::count();

    $menunggu = Guest::where('status_kunjungan', 'Menunggu')->count();

    $terjadwal = Guest::where('status_kunjungan', 'Terjadwal')->count();

    $selesai = Guest::where('status_kunjungan', 'Selesai')->count();

    $recentGuests = Guest::orderBy('waktu_dibuat', 'desc' )
        ->take(5)
        ->get();

    $chartData = [];

    for ($i = 1; $i <= 12; $i++) {

    $chartData[] = Guest::whereMonth('waktu_dibuat', $i)->count();

}

    return view('admin.dashboard', compact(
        'total',
        'menunggu',
        'terjadwal',
        'selesai',
        'recentGuests',
        'chartData'
    ));
}

}