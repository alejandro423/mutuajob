<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Habilidad;

class HabilidadSeeder extends Seeder
{
    public function run(): void
    {
        $habilidades = [
            ['nombre' => 'PHP'],
            ['nombre' => 'Laravel'],
            ['nombre' => 'JavaScript'],
            ['nombre' => 'HTML'],
            ['nombre' => 'CSS'],
            ['nombre' => 'MySQL'],
            ['nombre' => 'Python'],
            ['nombre' => 'Java'],
            ['nombre' => 'C++'],
            ['nombre' => 'Diseño Web'],
            ['nombre' => 'Redes'],
            ['nombre' => 'Soporte Técnico'],
        ];

        foreach ($habilidades as $habilidad) {

            Habilidad::create([
                'nombre' => $habilidad['nombre']
            ]);

        }
    }
}