<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebVisitor extends Model
{
    protected $fillable = ['ip_address', 'device_type', 'browser', 'platform'];
}