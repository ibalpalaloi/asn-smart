<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asn extends Model
{
    use HasFactory;
    protected $table = 'asn';
    public $incrementing = false;

    public function biodata_asn(){
        return $this->belongsTo(Biodata_asn::class);
    }

    public function jabatan_asn(){
        return $this->hasOne(Jabatan_asn::class, 'id_asn');
    }
}
