<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MendapatkanSalinan extends Model
{
    protected $table = 'mendapatkan_salinan';

    protected $fillable = [
        'nama_opsi',
    ];

    public $timestamps = false;
}