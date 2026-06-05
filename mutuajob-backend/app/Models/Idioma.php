<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idioma extends Model
{
    protected $table = 'idiomas';

    protected $fillable = ['nombre'];

    // 🔗 relación con perfiles (pivot con nivel)
    public function perfiles()
    {
        return $this->belongsToMany(Perfil::class, 'perfil_idiomas')
                    ->withPivot('nivel')
                    ->withTimestamps();
    }
}