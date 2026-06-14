<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Perfil;

class PerfilSeeder extends Seeder
{
    public function run(): void
    {
        $trabajadores = User::whereHas('roles', function ($query) {
            $query->where('nombre', 'trabajador');
        })->get();

        foreach ($trabajadores as $user) {

            Perfil::firstOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'nombre' => $user->name,
                    'email' => $user->email,
                ]
            );
        }
    }
}