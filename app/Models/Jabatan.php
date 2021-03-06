<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = "jabatan";
    public $incrementing = false;

    public function jabatan_tugas(){
        return $this->hasMany(Jabatan_tugas::class);
    }
}

