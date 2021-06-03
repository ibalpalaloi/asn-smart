<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = "opd";

    public function opd_user(){
        return $this->hasMany(Opd_user::class);
    }
}
