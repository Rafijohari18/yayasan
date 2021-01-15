<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $guarded = [];

    protected $casts = [
        'prestasi'    => 'array',
        'penghargaan' => 'array',
        'pelatihan'   => 'array',
    ];
    
}
