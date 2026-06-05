<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Certificacion;

class Perfil extends Model
{
    protected $table = 'perfil';

    protected $fillable = [

        'user_id',

        'nombre',

        'apellido',

        'dni',

        'fecha_nacimiento',

        'sexo',

        'foto',

        'telefono',

        'ubicacion',

        'email',

        'profesion',

        'resumen_profesional',

        'cv',

        'linkedin',

        'github',

        'portafolio',

        'disponibilidad',

        'modalidad',

        'salario_esperado',

        'estado',

    ];

    /*
    |--------------------------------------------------------------------------
    | RELACION USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | HABILIDADES
    |--------------------------------------------------------------------------
    */

    public function habilidades()
    {
        return $this->belongsToMany(
            Habilidad::class,
            'perfil_habilidad',
            'perfil_id',
            'habilidad_id'
        )->withPivot('nivel')
         ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | IDIOMAS
    |--------------------------------------------------------------------------
    */

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

    /*
    |--------------------------------------------------------------------------
    | CERTIFICACIONES
    |--------------------------------------------------------------------------
    */

    public function certificaciones()
    {
        return $this->belongsToMany(
            Certificacion::class,
            'perfil_certificaciones',
            'perfil_id',
            'certificacion_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | EXPERIENCIAS
    |--------------------------------------------------------------------------
    */

    public function experiencias()
    {
        return $this->hasMany(Experiencia::class);
    }

    /*
    |--------------------------------------------------------------------------
    | METODOS PERSONALIZADOS
    |--------------------------------------------------------------------------
    */

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
}