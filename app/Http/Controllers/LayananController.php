<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    public function store(Request $request)
    {
        Layanan::create([

            'nama_layanan' => $request->nama_layanan,

            'jenis' => $request->jenis,

            'bidang_id' => $request->bidang_id

        ]);

        return back();
    }
}