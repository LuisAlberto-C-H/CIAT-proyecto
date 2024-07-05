<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pais';

    protected $fillable = ['nombre','estado'];

    // protected $casts = [
    //     'estado' => 'boolean',
    // ];

    public function departamentos(){
        return $this->hasMany(Departamento::class);
    }

}
