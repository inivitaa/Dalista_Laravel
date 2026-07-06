<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LayananDisnaker;

class LayananDisnaker extends Model
{
    protected $table = 'layanan_disnaker';
    
    protected $fillable = [
        'nama_layanan',
        'bidang_id'
    ];
}
