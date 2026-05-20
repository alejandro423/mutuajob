<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\HabilidadController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\PerfilHabilidadController;
use App\Http\Controllers\PerfilIdiomaController;
use App\Http\Controllers\CertificacionController;
use App\Http\Controllers\ExperienciaController;
use App\Http\Controllers\OfertaController;
use App\Models\TrabPerfil;
use App\Models\Habilidad;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return view('inicio');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/create', function () {
    return view('create');
});
Route::get('/cuenta', function () {
    return view('cuenta');
})->middleware('auth');

#login insano
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
#registrer
Route::post('/register', [AuthController::class, 'register']);
#logout
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/inicio');
})->name('logout');
#amiddleware
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index']);
});
Route::get('/administrador/inicio', function () {
    return view('administrador.inicio');
})->middleware(['auth', 'role:administrador']);
#modulo de usuarios
Route::get('/administrador/usuarios', function () {
    return view('administrador.usuarios.index');
})->middleware(['auth', 'role:administrador']);
Route::middleware(['auth', 'role:administrador'])
    ->prefix('administrador')
    ->name('admin.')
    ->group(function () {
        Route::resource('usuarios', UserController::class);
    });
#modulo bitacora
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/bitacora', [BitacoraController::class, 'index'])
        ->name('bitacora.index');
    Route::get('/administrador/bitacora', [BitacoraController::class, 'index'])
    ->name('bitacora.index');
});
#perfil
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil', [PerfilController::class, 'index'])
        ->name('perfil.index');
    Route::get('/perfil/{id}/edit', [PerfilController::class, 'edit'])
        ->name('perfil.edit');
    Route::put('/perfil/{id}', [PerfilController::class, 'update'])
        ->name('perfil.update');
#habilidad
Route::middleware(['auth'])->group(function () {
    Route::get('/habilidades', [HabilidadController::class, 'index'])
        ->name('habilidades.index');
    Route::get('/habilidades/create', [HabilidadController::class, 'create'])
        ->name('habilidades.create');
    Route::post('/habilidades', [HabilidadController::class, 'store'])
        ->name('habilidades.store');
    Route::get('/habilidades/{id}/edit', [HabilidadController::class, 'edit'])
        ->name('habilidades.edit');
    Route::put('/habilidades/{id}', [HabilidadController::class, 'update'])
        ->name('habilidades.update');
    Route::delete('/habilidades/{id}', [HabilidadController::class, 'destroy'])
        ->name('habilidades.destroy');
    Route::get('/perfil-habilidad/create', [PerfilHabilidadController::class, 'create'])
        ->name('perfil_habilidad.create');
    Route::post('/perfil-habilidad', [PerfilHabilidadController::class, 'store'])
        ->name('perfil_habilidad.store');
    Route::get('/perfil-habilidad/{id}/edit', [PerfilHabilidadController::class, 'edit'])
        ->name('perfil_habilidad.edit');
    Route::put('/perfil-habilidad/{id}', [PerfilHabilidadController::class, 'update'])
        ->name('perfil_habilidad.update');
    Route::delete('/perfil-habilidad/{id}', [PerfilHabilidadController::class, 'destroy'])
        ->name('perfil_habilidad.destroy');
});
});
    // IDIOMAS
Route::middleware(['auth'])->group(function () {
    Route::get('/idiomas', [IdiomaController::class, 'index'])
        ->name('idiomas.index');
    Route::get('/idiomas/create', [IdiomaController::class, 'create'])
        ->name('idiomas.create');
    Route::post('/idiomas', [IdiomaController::class, 'store'])
        ->name('idiomas.store');
    Route::get('/idiomas/{id}/edit', [IdiomaController::class, 'edit'])
        ->name('idiomas.edit');
    Route::put('/idiomas/{id}', [IdiomaController::class, 'update'])
        ->name('idiomas.update');
    Route::delete('/idiomas/{id}', [IdiomaController::class, 'destroy'])
        ->name('idiomas.destroy');
    Route::get('/perfil-idioma/create', [PerfilIdiomaController::class, 'create'])
        ->name('perfil.idioma_create');
    Route::post('/perfil-idioma', [PerfilIdiomaController::class, 'store'])
        ->name('perfil_idioma.store');
    Route::get('/perfil-idioma/{id}/edit', [PerfilIdiomaController::class, 'edit'])
        ->name('perfil_idioma.edit');
    Route::put('/perfil-idioma/{id}', [PerfilIdiomaController::class, 'update'])
        ->name('perfil_idioma.update');
    Route::delete('/perfil-idioma/{id}', [PerfilIdiomaController::class, 'destroy'])
        ->name('perfil_idioma.destroy');

});
#certificaciones
Route::middleware(['auth'])->group(function () {
    Route::get('/certificaciones', function () {
        return view('certificaciones');
    });
    Route::get('/certificacion/certificacion_create', function () {
        return view('perfil.certificacion_create');
    })->name('perfil.certificacion_create');
     Route::get('/perfil/certificacion/create', [CertificacionController::class, 'create'])
        ->name('perfil.certificacion_create');
    Route::get('/perfil/certificacion/{id}/edit', [CertificacionController::class, 'edit'])
        ->name('perfil.certificacion_edit');
    Route::put('/perfil/certificacion/{id}', [CertificacionController::class, 'update'])
        ->name('perfil.certificacion_update');
    Route::post('/perfil/certificacion/store', [CertificacionController::class, 'store'])
        ->name('perfil.certificacion_store');
    Route::delete('/perfil/certificacion/{id}', [CertificacionController::class, 'destroy'])
        ->name('perfil.certificacion_destroy');

});
#experiencias
Route::middleware(['auth'])->group(function () {
    Route::get('/perfil/experiencia/create', [ExperienciaController::class, 'create'])
        ->name('perfil.experiencia_create');
    Route::post('/perfil/experiencia/store', [ExperienciaController::class, 'store'])
        ->name('perfil.experiencia_store');
    Route::get('/perfil/experiencia/{id}/edit', [ExperienciaController::class, 'edit'])
        ->name('perfil.experiencia_edit');
    Route::put('/perfil/experiencia/{id}', [ExperienciaController::class, 'update'])
        ->name('perfil.experiencia_update');
    Route::delete('/perfil/experiencia/{id}', [ExperienciaController::class, 'destroy'])
        ->name('perfil.experiencia_destroy');
});
   // OFERTAS
Route::middleware(['auth'])->group(function () {

    Route::get('/oferta', [OfertaController::class, 'index'])
        ->name('oferta.index');

    Route::get('/oferta/create', [OfertaController::class, 'create'])
        ->name('oferta.create');

    Route::post('/oferta/store', [OfertaController::class, 'store'])
        ->name('oferta.store');

    Route::get('/oferta/{id}', [OfertaController::class, 'show'])
        ->name('oferta.show');

    Route::get('/oferta/{id}/edit', [OfertaController::class, 'edit'])
        ->name('oferta.edit');

    Route::put('/oferta/{id}', [OfertaController::class, 'update'])
        ->name('oferta.update');

    Route::delete('/oferta/{id}', [OfertaController::class, 'destroy'])
        ->name('oferta.destroy');

});
