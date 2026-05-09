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
    }
}