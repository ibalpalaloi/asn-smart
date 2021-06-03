<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asn extends Model
{
    use HasFactory;
    protected $table = 'asn';

    public function biodata_asn(){
        return $this->belongsTo(Biodata_asn::class);
    }
}
