<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    public function jabatan() {

    }

    public function family() {
        return $this->hasMany(Family::class);
    }

}
