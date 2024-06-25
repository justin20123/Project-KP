<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = ['nomor_pertemuan','nomor_angkatan','tanggal_absensi','idpelatihan'];

    protected $table = 'absensi';

    use HasFactory;
}
