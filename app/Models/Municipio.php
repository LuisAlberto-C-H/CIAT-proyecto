<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'municipio';

    protected $fillable = ['provincia_id', 'nombre', 'estado'];


    public function provincia(){
        return $this->belongsTo(Provincia::class);
    }

    public function propiedades(){
        return $this->hasMany(Propiedad::class);
    }

}
