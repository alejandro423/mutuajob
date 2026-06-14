<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $table = 'ofertas';

    protected $fillable = [
        'user_id',
        'titulo',
        'descripcion',
        'ubicacion',
        'numero_contacto',
        'email_contacto',
        'requisitos_indispensables',
        'requisitos_deseables',
        'salario',
        'modalidad',
        'tipo_empleo',
        'vacantes',
        'estado',
        'fecha_limite',
    ];

    protected $casts = [
        'fecha_limite' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function solicitudes()
{
    return $this->hasMany(Solicitudes::class);
}

}