<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cicles extends Model
{
    use HasFactory;

    protected $table = 'cicles';
    protected $primaryKey = 'id';
    // protected $incrementing = true;
    public $timestamps = false;

    public function moduls()
    {
        return $this->hasMany(Moduls::class, 'cicles_id');
    }
}
