<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificacion extends Model
{
    protected $table = 'certificaciones';

   protected $fillable = [
    'nombre',
    'institucion',
    'descripcion',
    'fecha_obtencion',
    'fecha_expiracion',
    'evidencia'
];

    public function perfiles()
    {
        return $this->belongsToMany(
            Perfil::class,
            'certificacion_trab_perfil'
        );
    }
}