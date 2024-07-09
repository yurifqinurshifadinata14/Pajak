<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pajak()
    {
        return $this->belongsTo(Pajak::class, 'id_pajak', 'id_pajak');
    }
}
