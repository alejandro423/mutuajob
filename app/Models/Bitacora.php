<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';

    protected $fillable = [
        'user_id',
        'accion',
        'tabla',
        'registro_id',
        'descripcion',
        'ip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}