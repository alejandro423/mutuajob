<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Idioma;

class IdiomaSeeder extends Seeder
{
    public function run(): void
    {
        $idiomas = [
            'Español',
            'Inglés',
            'Portugués',
            'Francés',
            'Alemán',
            'Italiano',
            'Chino Mandarín',
            'Japonés',
            'Coreano',
            'Ruso'
        ];

        foreach ($idiomas as $nombre) {
            Idioma::create([
                'nombre' => $nombre
            ]);
        }
    }
}