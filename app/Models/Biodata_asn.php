<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata_asn extends Model
{
    use HasFactory;
    protected $table = 'biodata_asn';
    public $incrementing = false;

    public function asn(){
        return $this->hasOne(Biodata_asn::class);
    }
}
