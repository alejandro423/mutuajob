<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class experiencia extends Model
{
    protected $fillable = [
    'perfil_id',
    'empresa',
    'cargo',
    'tipo_empleo',
    'ubicacion',
    'fecha_inicio',
    'fecha_fin',
    'trabajo_actual',
    'descripcion',
];
    public function perfil()
{
    return $this->belongsTo(Perfil::class);
}
}
