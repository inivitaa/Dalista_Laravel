<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;
use App\Models\BidangTujuan;

class LayananController extends Controller
{
    // =========================
    // LAYANAN
    // =========================

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required'
        ]);

        Layanan::create([
            'nama_layanan' => $request->nama_layanan,
            'jenis' => 'umum'
        ]);

        return back()->with(
            'success',
            'Layanan berhasil ditambahkan'
        );
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required'
        ]);

        $layanan = Layanan::findOrFail($id);

        $layanan->update([
            'nama_layanan' => $request->nama_layanan
        ]);

        return back()->with(
            'success',
            'Layanan berhasil diperbarui'
        );
    }
    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Layanan berhasil dihapus'
        );
    }

    // =========================
    // BIDANG
    // =========================

    public function storeBidang(Request $request)
    {
        $request->validate([
            'bidang' => 'required'
        ]);

        BidangTujuan::create([
            'bidang' => $request->bidang
        ]);

        return back()->with(
            'success',
            'Bidang berhasil ditambahkan'
        );
    }

    public function updateBidang(Request $request, $id)
    {
        $request->validate([
            'bidang' => 'required'
        ]);

        $bidang = BidangTujuan::findOrFail($id);

        $bidang->update([
            'bidang' => $request->bidang
        ]);

        return back()->with(
            'success',
            'Bidang berhasil diperbarui'
        );
    }

    public function destroyBidang($id)
    {
        BidangTujuan::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Bidang berhasil dihapus'
        );
    }
}