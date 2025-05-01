<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moduls extends Model
{
    use HasFactory;

    protected $table = 'moduls';
    protected $primaryKey = 'id';
    // public $incrementing = true;
    public $timestamps = false;

    public function cicles()
    {
        return $this->belongsTo(Cicles::class, 'cicles_id');
    }

    public function resultats_aprenentatge()
    {
        return $this->hasMany(Resultats_Aprenentatge::class, 'moduls_id');
    }

    public function usuaris()
    {
        return $this->belongsToMany(Usuaris::class, 'usuaris_has_moduls', 'moduls_id', 'usuaris_id');
    }
}

