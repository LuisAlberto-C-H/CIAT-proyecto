<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "propiedad";

    protected $fillable = [
        'municipio_id',
        'nombre',
        'direccion',
        'desmonte', 
        'estado',
    ];


    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function clientes(){
        return $this->hasMany(Cliente::class);
    }

}
