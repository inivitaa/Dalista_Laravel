<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'guest_id', 
        'nama',
        'rating', 
        'ulasan', 
        'layanan_diakses',
        'p1', 'p2', 'p3', 'p4', 'p5'
    ];
}