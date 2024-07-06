<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud_analisis extends Model
{
    use HasFactory;

    protected $table = 'solicitud_analisis';

    protected $fillable = ['cliente_id', 'gestion_id',
                            'glosario', 'fecha_muestreo',
                            'cultivo_anterior', 'cultivo_actual',
                            'lugar_muestreo'
                        ];


    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function gestion(){
        return $this->belongsTo(Gestion::class);
    }
}
