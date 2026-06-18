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
use App\Http\Controllers\PerfilUserController;
use App\Http\Controllers\SolicitudesController;
use App\Http\Controllers\HomeController;
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
#version
Route::get('/backend-version', function () {
    return response()->json([
        'app' => config('version.app_name'),
        'backend_version' => config('version.backend_version'),
        'environment' => app()->environment(),
    ]);
});
Route::get('/backend/version', function () {
    return response()->json([
        'data' => [
            'apiVersion' => config('version.backend_version'),
            'framework' => 'Laravel',
            'phpVersion' => PHP_VERSION,
        ],
        'message' => 'BACKEND DE MUTUAJOB',
        'error' => null,
        'responseCode' => 100
    ], 200, [], JSON_PRETTY_PRINT);

});
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
# MODULO DE USUARIOS
Route::middleware(['auth', 'role:administrador'])

    ->prefix('administrador')

    ->name('admin.')

    ->group(function () {

        // LISTA USUARIOS
        Route::get(
            '/usuarios',
            [UserController::class, 'index']
        )->name('usuarios.index');

        // USUARIOS INACTIVOS
        Route::get(
            '/usuarios/inactivos',
            [UserController::class, 'inactivos']
        )->name('usuarios.inactivos');

        // PDF
        Route::get(
            '/usuarios/pdf',
            [UserController::class, 'pdf']
        )->name('usuarios.pdf');

        // FORM CREAR
        Route::get(
            '/usuarios/create',
            [UserController::class, 'create']
        )->name('usuarios.create');

        // GUARDAR
        Route::post(
            '/usuarios',
            [UserController::class, 'store']
        )->name('usuarios.store');
        // DETALLE USUARIO
        Route::get(
            '/usuarios/{id}',
            [UserController::class, 'show']
        )->name('usuarios.show');
        Route::get(
            '/usuarios/{id}/edit',
            [UserController::class, 'edit']
        )->name('usuarios.edit');

        // ACTUALIZAR
        Route::put(
            '/usuarios/{id}',
            [UserController::class, 'update']
        )->name('usuarios.update');
        Route::delete(
            '/usuarios/{id}',
            [UserController::class, 'destroy']
        )->name('usuarios.destroy');

        // HABILITAR USUARIO
        Route::put(
            '/usuarios/{id}/habilitar',
            [UserController::class, 'habilitar']
        )->name('usuarios.habilitar');

        Route::delete(
            '/usuarios/{id}/force-delete',
            [UserController::class, 'forceDelete']
        )->name('usuarios.forceDelete');

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
        Route::get(
    '/perfil/pdf',
    [PerfilController::class, 'pdf']
)->name('perfil.pdf');
});
#perfil_habilidad
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
    #PERFIL_IDIOMAS
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
    Route::put(
    '/perfil/{id}/estado',
    [PerfilController::class, 'toggleEstado']
)->name('perfil.toggleEstado');
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
        Route::get(
    '/ofertas/{id}/pdf',
    [OfertaController::class, 'pdf']
)->name('oferta.pdf');

});
#idiomas
Route::middleware(['auth'])->group(function () {
    Route::get('/idiomas', [IdiomaController::class, 'index'])
        ->name('administrador.idiomas.index');
    Route::get('/idioma/create', [IdiomaController::class, 'create'])
        ->name('administrador.idiomas.create');
    Route::post('/idiomas', [IdiomaController::class, 'store'])
        ->name('administrador.idiomas.store');
    Route::get('/idiomas/{id}/edit', [IdiomaController::class, 'edit'])
        ->name('administrador.idiomas.edit');
    Route::put('/idiomas/{id}', [IdiomaController::class, 'update'])
        ->name('administrador.idiomas.update');
    Route::delete('/idiomas/{id}', [IdiomaController::class, 'destroy'])
        ->name('administrador.idiomas.destroy');
});
// HABILIDADES
Route::middleware(['auth'])->group(function () {

    Route::get('/habilidades', [HabilidadController::class, 'index'])
        ->name('administrador.habilidades.index');

    Route::get('/habilidades/create', [HabilidadController::class, 'create'])
        ->name('administrador.habilidades.create');

    Route::post('/habilidades', [HabilidadController::class, 'store'])
        ->name('administrador.habilidades.store');

    Route::get('/habilidades/{id}/edit', [HabilidadController::class, 'edit'])
        ->name('administrador.habilidades.edit');

    Route::put('/habilidades/{id}', [HabilidadController::class, 'update'])
        ->name('administrador.habilidades.update');

    Route::delete('/habilidades/{id}', [HabilidadController::class, 'destroy'])
        ->name('administrador.habilidades.destroy');
});
#perfiles user
Route::middleware(['auth'])->group(function () {
    Route::get('/perfiles_user', [PerfilUserController::class, 'index'])
        ->name('administrador.perfiles_user.index');
    Route::get('/perfil_user/{id}', [PerfilUserController::class, 'show'])
        ->name('administrador.perfiles_user.show');
    Route::get('/perfil_user/{id}/edit', [PerfilUserController::class, 'edit'])
        ->name('administrador.perfiles_user.edit');
    Route::put('/perfil_user/{id}', [PerfilUserController::class, 'update'])
        ->name('administrador.perfiles_user.update');
Route::post('/admin/perfil/bloquear/{id}', [PerfilUserController::class, 'adminBloquear'])
    ->name('administrador.perfiles_user.bloquear');
Route::post('/admin/perfil/desbloquear/{id}', [PerfilUserController::class, 'adminDesbloquear'])
    ->name('administrador.perfiles_user.desbloquear');    Route::post('/perfiles_user', [PerfilUserController::class, 'store'])
        ->name('administrador.perfiles_user.store');
    
});
#inicios
Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', [HomeController::class, 'index'])->name('inicio');
    Route::get('/oferta/{id}/candidatos', [OfertaController::class, 'candidatos']);
    Route::get('/perfil/{id}', [PerfilController::class, 'show'])
        ->name('perfil.show');
});
# SOLICITUDES
Route::middleware(['auth'])->group(function () {
    Route::get('/solicitudes', [SolicitudesController::class, 'index'])
    ->name('solicitudes.index');
Route::post('/oferta/{ofertaId}/postular', [SolicitudesController::class, 'postular'])
    ->name('solicitudes.postular');
Route::post('/oferta/{ofertaId}/invitar/{perfilId}', [SolicitudesController::class, 'invitar'])
    ->name('solicitudes.invitar');
    Route::post('/solicitud/{id}/estado', [SolicitudesController::class, 'cambiarEstado'])
    ->name('solicitud.estado');
    });