<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'daftar_tamu';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [

        'nama',
        'email',
        'nomor_telp',
        'alamat',
        'jenis_kelamin',
        'profesi_id',
        'pendidikan_terakhir_id',
        'asal_instansi',
        'bidang_tujuan_id',
        'keperluan',

        'catatan_tambahan',

        'file_upload',
        'file_name',

        'status_kunjungan',

        'waktu_dibuat'
    ];
}