<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public $timestamps = false;

    // Especificar el nombre de la tabla
    protected $table = 'persona';

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'email', 
        'estado',
    ];

    public function cliente(){
        return $this->hasOne(Cliente::class);
    }

}
