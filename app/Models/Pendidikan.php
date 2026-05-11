<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'pendidikan_terakhir';

    public $timestamps = false;

    protected $fillable = [
        'pendidikan_terakhir'
    ];
}