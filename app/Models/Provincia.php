<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'provincia';

    protected $fillable = ['departamento_id','nombre','estado'];

    

    public function departamento(){
        return $this->belongsTo(Departamento::class);
    }

    public function municipios(){
        return $this->hasMany(Municipio::class);;
    }
}
