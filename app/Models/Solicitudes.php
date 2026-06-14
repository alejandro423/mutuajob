<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $fillable = [
        'perfil_id',
        'oferta_id',
        'tipo',
        'estado',
        'mensaje'
    ];

    public function perfil()
    {
        return $this->belongsTo(Perfil::class);
    }

    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }
}