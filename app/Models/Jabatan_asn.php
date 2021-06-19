<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan_asn extends Model
{
    use HasFactory;
    protected $table = "jabatan_asn";
    public $incrementing = false;

    public function opd_jabatan(){
        return $this->belongsTo(Opd_jabatan::class);
    }

    public function asn(){
        return $this->belongsTo(Asn::class, 'id_asn');
    }
}
