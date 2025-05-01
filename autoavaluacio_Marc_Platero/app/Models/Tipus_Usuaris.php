<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipus_Usuaris extends Model
{
    use HasFactory;

    protected $table = 'tipus_usuaris';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = false;

    public function usuaris()
    {
        return $this->hasMany(Usuaris::class, 'tipus_usuaris_id');
    }
}
