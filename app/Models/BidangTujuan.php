<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidangTujuan extends Model
{
    protected $table = 'bidang_tujuan';

    public $timestamps = false;

    protected $fillable = [
        'bidang'
    ];
}