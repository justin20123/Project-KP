<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;

    protected $fillable = ['nama','alamat', 'email' ,'id_peserta', 'umur'];

    protected $table = 'users';

    //one on one relation with user
    public function pengajar()
    {
        return $this->belongsTo(Users::class)->withTrashed();
    }
}
