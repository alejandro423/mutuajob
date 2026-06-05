<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Perfil;

class PerfilSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('name', 'trabajador')->first();

        if ($user) {

            Perfil::create([
                'user_id' => $user->id,
                'nombre' => 'trabajador',
                'apellido' => null,
                'foto' => null,
                'telefono' => null,
                'ubicacion' => null,
                'email' => 'trabajador@gmail.com',
                'resumen_profesional' => null,
            ]);

        }
    }
}