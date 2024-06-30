<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;

    protected $fillable = ['nama','alamat', 'email' ,'id_peserta', 'umur'];

    protected $table = 'users';

    public function peserta()
    {
        return $this->belongsTo(Users::class)->withTrashed();
    }
}
