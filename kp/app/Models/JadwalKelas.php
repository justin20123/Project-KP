<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    protected $fillable = ['nomor_pertemuan', 'jenis_pertemuan', 'tanggal_absensi', 'idperiode'];

    protected $table = 'jadwal_kelas';

    use HasFactory;
}
