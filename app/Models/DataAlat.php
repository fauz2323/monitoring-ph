<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataAlat extends Model
{
    protected $fillable = [
        'ph',
        'tds',
        'turbidity',
        'keterangan'
    ];
}
