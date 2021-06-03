<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $table = "bidang";

    public function opd(){
        return $this->belongsTo(Opd::class);
    }

    public function sub_bidang(){
        return $this->hasMany(Sub_bidang::class);
    }
}
