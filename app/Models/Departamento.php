<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'departamento';

    protected $fillable = ['pais_id','nombre','estado'];

    public function pais(){
        return $this->belongsTo(Pais::class);
    }

    public function provincias(){
        return $this->hasMany(Provincia::class);
    }

}
