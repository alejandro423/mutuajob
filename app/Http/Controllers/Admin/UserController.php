<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Bitacora;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    // =========================
    // ACTIVOS
    // =========================
    public function index(Request $request)
    {
        $buscar = $request->buscar;

        $users = User::with('roles')
            ->where('estado', 1)
            ->when($buscar, function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%");
                });

            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('administrador.usuarios.index', compact('users'));
    }

    // =========================
    // PDF USUARIOS ACTIVOS
    // =========================
    public function pdf()
    {
        $users = User::with('roles')
            ->where('estado', 1)
            ->orderBy('id', 'desc')
            ->get();

        $pdf = Pdf::loadView('administrador.usuarios.pdf', compact('users'));

        return $pdf->download('usuarios_activos.pdf');
    }

    // =========================
    // INACTIVOS
    // =========================
    public function inactivos(Request $request)
    {
        $buscar = $request->buscar;

        $users = User::with('roles')
            ->where('estado', 0)
            ->when($buscar, function ($query) use ($buscar) {

                $query->where(function ($q) use ($buscar) {
                    $q->where('name', 'like', "%{$buscar}%")
                      ->orWhere('email', 'like', "%{$buscar}%");
                });

            })
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('administrador.usuarios.inactivos', compact('users'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        $roles = Role::all();
        return view('administrador.usuarios.create', compact('roles'));
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'estado' => 1
        ]);

        if ($request->roles) {
            $user->roles()->attach($request->roles);
        }

    }

    // =========================
    // SHOW
    // =========================
    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        return view('administrador.usuarios.show', compact('user'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();

        return view('administrador.usuarios.edit', compact('user', 'roles'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->roles()->sync($request->roles ?? []);

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Editar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'Editó usuario '.$user->name,
            'ip' => $request->ip()
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    // =========================
    // DESACTIVAR (LOGICO)
    // =========================
    public function destroy(string $id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user = User::findOrFail($id);

        $user->update([
            'estado' => 0
        ]);

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Desactivar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'Desactivó usuario '.$user->name,
            'ip' => request()->ip()
        ]);

        return back()->with('success', 'Usuario desactivado correctamente.');
    }

    // =========================
    // HABILITAR USUARIO
    // =========================
    public function habilitar(string $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'estado' => 1
        ]);

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Habilitar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'Reactivó usuario '.$user->name,
            'ip' => request()->ip()
        ]);

        return back()->with('success', 'Usuario habilitado correctamente.');
    }
}