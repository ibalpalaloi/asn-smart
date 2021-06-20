<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = "tugas";
    public $incrementing = false;

    public function surat_tugas(){
        return $this->belongsTo(Surat_tugas::class);
    }
}
