<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultats_Aprenentatge extends Model
{
    use HasFactory;

    protected $table = 'resultats_aprenentatge';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = false;

    public function moduls()
    {
        return $this->belongsTo(Moduls::class, 'moduls_id');
    }

    public function criteris_avaluacio()
    {
        return $this->hasMany(Criteris_Avaluacio::class, 'resultats_aprenentatge_id');
    }
}
