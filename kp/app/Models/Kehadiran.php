<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = ['nomor_pertemuan','status', 'sudah_absen' ,'id_peserta', 'absensi_idpelatihan','idabsensi'];

    protected $table = 'kehadiran';

    use HasFactory;
}
