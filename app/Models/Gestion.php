<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;

    protected $table = 'gestion';
    protected $fillable = ['nombre'];

    public function solicitud_analisis(){
        return $this->hasMany(Solicitud_analisis::class);
    }

}
