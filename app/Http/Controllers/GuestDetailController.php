<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\BidangTujuan;
use App\Models\LayananDisnaker;

class GuestDetailController extends Controller
{
    public function show($id)
    {
        $guest = Guest::with([
            'profesi',
            'pendidikan',
            'bidangTujuan',
            'layanan'
        ])->findOrFail($id);

        $bidangTujuan = BidangTujuan::all();

        $layananDisnaker = LayananDisnaker::all();

        return view(
            'admin.detail-tamu',
            compact(
                'guest',
                'bidangTujuan',
                'layananDisnaker'
            )
        );
    }
}
