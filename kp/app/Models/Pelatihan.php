<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatihan extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'jumlah_pertemuan'];

    protected $table = 'pelatihan';

    use HasFactory;
}
