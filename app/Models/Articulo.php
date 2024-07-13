<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;

    protected $table = "articulo";
    protected $fillable = ['nombre', 'precio', 'tipo_analisis_id'];

    public function tipo_analisis(){
        return $this->belongsTo(Tipo_analisis::class);
    }
}
