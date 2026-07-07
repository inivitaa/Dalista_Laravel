<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\BidangTujuan;
use App\Models\LayananDisnaker;
use App\Models\MendapatkanSalinan;

class GuestDetailController extends Controller
{
    public function show($id)
    {
        $guest = Guest::with([
            'profesi',
            'bidangTujuan',
            'layanan'
        ])->findOrFail($id);

        $bidangTujuan = BidangTujuan::all();

        $layananDisnaker = LayananDisnaker::all();
        $mendapatkanSalinan = MendapatkanSalinan::all();
        
        return view(
            'admin.detail-tamu',
            compact(
                'guest',
                'bidangTujuan',
                'layananDisnaker',
                'mendapatkanSalinan'
            )
        );
    }
    public function jadwalkan(Request $request, $id)
    {
    
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'bidang_tujuan_id' => 'required',
            'asn_dituju' => 'required|string|max:255',
        ]);

        $guest = Guest::findOrFail($id);

        $guest->jadwal_checkin =
            $request->tanggal.' '.$request->jam;

        $guest->jadwal_dibuat = now();

        $guest->bidang_tujuan_id =
            $request->bidang_tujuan_id;

        $guest->layanan_disnaker_id =
            $request->layanan_disnaker_id;

        $guest->asn_dituju =
            $request->asn_dituju;

        $guest->status_kunjungan = 'Terjadwal';

        $guest->save();

        return redirect()
            ->route('guest.detail', $guest->id)
            ->with(
                'success',
                'Jadwal berhasil disimpan.'
            );
    }
    public function datang($id)
    {
        $guest = Guest::findOrFail($id);

        $guest->waktu_checkin = now();

        $guest->status_kunjungan = 'Datang';

        $guest->save();

        return redirect()
            ->route('guest.detail', $guest->id)
            ->with(
                'success',
                'Tamu berhasil ditandai datang.'
            );
    }
    public function selesai($id)
    {
        $guest = Guest::findOrFail($id);

        $guest->status_kunjungan = 'Selesai';

        $guest->waktu_checkout = now();

        $guest->save();

        return redirect()
            ->route('guest.detail', $guest->id)
            ->with(
                'success',
                'Kunjungan berhasil diselesaikan.'
            );
    }
}
