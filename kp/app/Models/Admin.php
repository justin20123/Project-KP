<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    //one on one relation with user
    public function admin()
    {
        return $this->belongsTo(Users::class)->withTrashed();
    }
}
