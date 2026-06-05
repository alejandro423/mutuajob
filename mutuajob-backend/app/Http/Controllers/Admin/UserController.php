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

    public function pdf()
    {
        $users = User::with('roles')
            ->where('estado', 1)
            ->orderBy('id', 'desc')
            ->get();

        $pdf = Pdf::loadView('administrador.usuarios.pdf', compact('users'));

        return $pdf->download('usuarios_activos.pdf');
    }

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
    'roles' => 'required|array|min:1',
    'roles.*' => 'exists:roles,id',
], [
    'name.required' => 'El nombre es obligatorio.',
    'email.required' => 'El correo es obligatorio.',
    'email.email' => 'Ingresa un correo válido.',
    'email.unique' => 'Este correo ya existe.',
    'password.required' => 'La contraseña es obligatoria.',
    'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
    'roles.required' => 'Al menos un rol es obligatorio.',
    'roles.array' => 'Los roles deben ser un array.',
    'roles.min' => 'Debe seleccionar al menos un rol.',
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
        return redirect()
    ->route('admin.usuarios.index')
    ->with('success', 'Usuario creado correctamente.');

    }

    public function show(string $id)
    {
        $user = User::with('roles')->findOrFail($id);
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
public function forceDelete(int $id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->forceDelete();

        Bitacora::create([
            'user_id' => Auth::id(),
            'accion' => 'Eliminar usuario',
            'tabla' => 'users',
            'registro_id' => $user->id,
            'descripcion' => 'Eliminó permanentemente usuario '.$user->name,
            'ip' => request()->ip()
        ]);

        return back()->with('success', 'Usuario eliminado permanentemente.');
    }
    
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