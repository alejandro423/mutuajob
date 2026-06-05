<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    protected $table = 'habilidades';

    protected $fillable = [
        'nombre'
    ];

    // 🔗 Relación inversa con perfiles
    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_habilidad')
                    ->withPivot('nivel')
                    ->withTimestamps();
    }
}