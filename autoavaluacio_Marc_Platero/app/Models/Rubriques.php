<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubriques extends Model
{
    use HasFactory;

    protected $table = 'rubriques';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = false;

    public function criteris_avaluacio()
    {
        return $this->belongsTo(Rubriques::class, 'criteris_avaluacio_id');
    }
}
