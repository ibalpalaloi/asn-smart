<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd_jabatan extends Model
{
    use HasFactory;

    protected $table = "opd_jabatan";

    public function opd(){
        return $this->belongsTo(Opd::class);
    }

    public function bidang(){
        return $this->belongsTo(Bidang::class);
    }

    public function sub_bidang(){
        return $this->belongsTo(Sub_bidang::class);
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class);
    }
}
