<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'nama',
        'guest_id', 
        'rating', 'ulasan', 'layanan_diakses'];
}
