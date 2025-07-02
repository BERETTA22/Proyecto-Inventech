<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AddUserController extends Controller
{
    /**
     * Muestra la lista de usuarios.
     */
    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();

        // Retornar la vista con los usuarios
        return view('usuarios.ver_usuarios', compact('users'));
    }

    /**
     * Muestra el formulario de creación de usuarios.
     */
    public function create()
    {
        // Obtener todos los roles para mostrarlos en el formulario
        $roles = Role::all();

        // Retornar la vista con los roles
        return view('usuarios.create_user', compact('roles'));
    }

    /**
     * Maneja la solicitud de creación de un usuario.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
    'name'     => ['required', 'string', 'max:255', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúñÑ ]{2,}$/'],
    'username' => ['required', 'string', 'max:255', 'unique:users,username', 'regex:/^(?=.*[A-Za-z])[A-Za-z0-9_]{4,}$/'],
    'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[\w\.-]+@[\w\.-]+\.com$/'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'role'     => ['required', 'exists:roles,id'],
], [
    'name.regex'     => 'El nombre solo puede contener letras y espacios, mínimo 2 caracteres.',
    'username.regex' => 'El username debe tener letras y puede incluir números o guiones bajos.',
    'email.regex'    => 'El correo debe ser válido y terminar en ".com".'
]);


        // Crear el usuario con el rol seleccionado
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role, // Asignar el rol al usuario
        ]);

        // Disparar el evento de registro
        event(new Registered($user));

    

        // Redirigir a la lista de usuarios
        return redirect()->route('usuarios.ver_usuarios')
                         ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Muestra el formulario de edición de usuario.
     */
    public function edit($id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Obtener todos los roles
        $roles = Role::all();

        // Retornar la vista de edición con los datos del usuario y los roles
        return view('usuarios.edit_user', compact('user', 'roles'));
    }

    /**
     * Maneja la solicitud de actualización de un usuario.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role' => ['required', 'exists:roles,id'],
        ]);

        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role_id' => $request->role,
        ]);

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.ver_usuarios')
                         ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Elimina un usuario.
     */
    public function destroy($id)
    {
        // Buscar al usuario por su ID
        $user = User::findOrFail($id);

        // Eliminar al usuario
        $user->delete();

        // Redirigir a la lista de usuarios con un mensaje de éxito
        return redirect()->route('usuarios.ver_usuarios')
                         ->with('success', 'Usuario eliminado correctamente.');
    }
}
