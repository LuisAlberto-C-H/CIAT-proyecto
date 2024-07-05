<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = "cliente";

    protected $fillable = [
        'persona_id',
        'propiedad_id',
        'institucion',
        'nit',
        'estado'
    ];

    public function persona(){
        return $this->belongsTo(Persona::class);
    }
    
    public function propiedad(){
        return $this->belongsTo(Propiedad::class);
    }

    public function solicitud_analisis(){
        return $this->hasMany(Solicitud_analisis::class);
    }

}
