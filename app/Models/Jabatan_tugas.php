<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan_tugas extends Model
{
    use HasFactory;
    protected $table = "jabatan_tugas";
    public $incrementing = false;

    public function jabatan(){
        return $this->belongsTo(Jabatan::class);
    }
}
