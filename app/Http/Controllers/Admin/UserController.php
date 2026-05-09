<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Bitacora;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('administrador.usuarios.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('administrador.usuarios.create', compact('roles'));
    }

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
        ]);

        // GUARDAR ROLES
        if ($request->has('roles')) {
            $user->roles()->attach($request->roles);
        }

        // BITACORA CREAR
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Crear usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'El administrador creó al usuario '.$user->name,
            'ip' => $request->ip()
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('administrador.usuarios.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::with('roles')->findOrFail($id);

        $roles = Role::all();

        return view('administrador.usuarios.edit', compact('user', 'roles'));
    }

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

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // ACTUALIZAR ROLES
        $user->roles()->sync($request->roles ?? []);

        // BITACORA EDITAR
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Editar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'El administrador editó al usuario '.$user->name,
            'ip' => $request->ip()
        ]);

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // BITACORA ELIMINAR
        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Eliminar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'El administrador eliminó al usuario '.$user->name,
            'ip' => request()->ip()
        ]);

        $user->delete();

        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}