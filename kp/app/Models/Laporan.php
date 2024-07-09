<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $primaryKey = ['id_peserta', 'idperiode'];

    protected $fillable = [
        'evaluasi',
    ];

    protected $table = 'laporan';

    use HasFactory;
}
