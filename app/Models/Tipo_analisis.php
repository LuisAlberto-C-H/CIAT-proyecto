<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_analisis extends Model
{
    use HasFactory;

    protected $table ="tipo_analisis";

    protected $fillable = ['nombre'];

    public function articulos(){
        return $this->hasMany(Articulo::class);
    }

}
