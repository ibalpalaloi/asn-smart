<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_tugas extends Model
{
    use HasFactory;
    protected $table = "surat_tugas";

    public function tugas(){
        return $this->hasMany(Tugas::class);
    }

}
