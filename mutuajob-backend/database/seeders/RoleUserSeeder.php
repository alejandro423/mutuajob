<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RoleUserSeeder extends Seeder
{
    public function run(): void
    {
        // ROLES BASE DEL SISTEMA
        $adminRole = Role::firstOrCreate(['nombre' => 'administrador']);
        $trabajadorRole = Role::firstOrCreate(['nombre' => 'trabajador']);
        $empleadorRole = Role::firstOrCreate(['nombre' => 'empleador']);

        // USUARIO ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin123@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('admin123'),
            ]
        );

        $admin->roles()->syncWithoutDetaching([$adminRole->id]);

        // USUARIO TRABAJADOR
        $trabajador = User::firstOrCreate(
            ['email' => 'trabajador@gmail.com'],
            [
                'name' => 'Trabajador',
                'password' => Hash::make('trabajador123'),
            ]
        );

        $trabajador->roles()->syncWithoutDetaching([$trabajadorRole->id]);

        // USUARIO EMPLEADOR
        $empleador = User::firstOrCreate(
            ['email' => 'empleador@gmail.com'],
            [
                'name' => 'Empleador',
                'password' => Hash::make('empleador123'),
            ]
        );

        $empleador->roles()->syncWithoutDetaching([$empleadorRole->id]);

        // USUARIOS EXTRA

$usuarios = [

    [
        'name' => 'Juan Perez',
        'email' => 'juan@gmail.com',
        'role' => $adminRole
    ],

    [
        'name' => 'Maria Lopez',
        'email' => 'maria@gmail.com',
        'role' => $adminRole
    ],

    [
        'name' => 'Carlos Rojas',
        'email' => 'carlos@gmail.com',
        'role' => $trabajadorRole
    ],

    [
        'name' => 'Ana Gutierrez',
        'email' => 'ana@gmail.com',
        'role' => $empleadorRole
    ],

    [
        'name' => 'Luis Fernandez',
        'email' => 'luis@gmail.com',
        'role' => $trabajadorRole
    ],

    [
        'name' => 'Sofia Vargas',
        'email' => 'sofia@gmail.com',
        'role' => $empleadorRole
    ],

    [
        'name' => 'Diego Ramirez',
        'email' => 'diego@gmail.com',
        'role' => $trabajadorRole
    ],

    [
        'name' => 'Camila Flores',
        'email' => 'camila@gmail.com',
        'role' => $empleadorRole
    ],

    [
        'name' => 'Jorge Castillo',
        'email' => 'jorge@gmail.com',
        'role' => $trabajadorRole
    ],

    [
        'name' => 'Valeria Mendoza',
        'email' => 'valeria@gmail.com',
        'role' => $empleadorRole
    ],

];

foreach ($usuarios as $data) {

    $nombreEmail = explode('@', $data['email'])[0];

    $user = User::firstOrCreate(
        ['email' => $data['email']],
        [
            'name' => $data['name'],
            'password' => Hash::make($nombreEmail . '123'),
            'two_factor_secret' => null
        ]
    );

    $user->roles()->syncWithoutDetaching([
        $data['role']->id
    ]);
}
    }
}