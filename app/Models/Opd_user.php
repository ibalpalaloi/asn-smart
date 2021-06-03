<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd_user extends Model
{
    use HasFactory;

    protected $table = 'opd_user';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function opd(){
        return $this->belongsTo(Opd::class);
    }
    
}
