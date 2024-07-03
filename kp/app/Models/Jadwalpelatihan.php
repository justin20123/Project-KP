<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwalpelatihan extends Model
{
    protected $fillable = ['nomor_pertemuan','tanggal_start','jenis_pelatihan','status','jadwal','idjadwalpelatihan','id_pengajar'];

    protected $table = 'jadwal_pelatihan';

    use HasFactory;
}
