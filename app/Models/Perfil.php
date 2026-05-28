<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificacion;

class Perfil extends Model
{
    protected $table = 'perfil';

   protected $fillable = [

    'nombre',
    'email',
    'apellido',
    'telefono',
    'ubicacion',
    'resumen_profesional',
    'foto',

];

    public function habilidades()
{
    return $this->belongsToMany(
        Habilidad::class,
        'perfil_habilidad',
        'perfil_id',   // FK de ESTE modelo
        'habilidad_id'      // FK del otro modelo
    )->withPivot('nivel')
     ->withTimestamps();
}

    public function idiomas()
{
    return $this->belongsToMany(
        Idioma::class,
        'perfil_idiomas',
        'perfil_id',
        'idioma_id'
    )->withPivot('nivel')
     ->withTimestamps();
}

    public static function listar()
    {
        return self::all();
    }

    public static function obtenerPorId(int $id)
    {
        return self::findOrFail($id);
    }

    public static function crear(array $datos)
    {
        return self::create($datos);
    }

    public function actualizar(array $datos)
    {
        return $this->update($datos);
    }

    public function eliminar()
    {
        return $this->delete();
    }
    public function certificaciones()
{
    return $this->belongsToMany(
        Certificacion::class,
        'perfil_certificaciones',
        'perfil_id',
    );
}
public function experiencias()
{
    return $this->hasMany(Experiencia::class);
}

}