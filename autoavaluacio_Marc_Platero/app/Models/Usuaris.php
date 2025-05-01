<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuaris extends Authenticatable
{
    use HasFactory;

    protected $table = 'usuaris';
    protected $primaryKey = 'id';
    // public $incrementing = true;
    public $timestamps = false;

    //S'utilitza per especificar quins camps poden ser omplerts de forma massiva amb dades provinents de formularis web o altres entrades de l'usuari
    protected $fillable = ['actiu'];

    public function tipus_usuaris()
    {
        return $this->belongsTo(Tipus_Usuaris::class, 'tipus_usuaris_id');
    }

    public function moduls()
    {
        return $this->belongsToMany(Moduls::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function criteris_avaluacio()
    {
        return $this->belongsToMany(Criteris_Avaluacio::class, 'alumnes_has_criteris_avaluacio', 'usuaris_id', 'criteris_avaluacio_id')->withPivot("nota");
    }

    //Comprova si l'usuari té dades relacionades amb altres models de la aplicació
    public function hasRelatedData()
    {
        return $this->moduls()->exists() || $this->criteris_avaluacio()->exists();
    }
}
