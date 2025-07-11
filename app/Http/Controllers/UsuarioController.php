<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Importar Hash
use Illuminate\Validation\Rules\Enum; // <-- Importar para validar el Enum
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 2. Obtiene todos los registros de la tabla 'usuarios'
        $usuarios = Usuario::all();

        // 3. Devuelve la vista y le pasa la variable 'usuarios'
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validación de los datos del formulario
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellido' => 'required|string|max:100',
            'Email' => 'required|string|email|max:50|unique:usuarios',
            'Rol' => 'required|in:Administrador,Operario', // Valida que el rol sea uno de los permitidos
            'password' => 'required|string|min:8|confirmed', // 'confirmed' busca un campo 'password_confirmation'
        ]);

        // 2. Creación del usuario en la base de datos
        Usuario::create([
            'Nombre' => $request->Nombre,
            'Apellido' => $request->Apellido,
            'Email' => $request->Email,
            'Rol' => $request->Rol,
            'password' => Hash::make($request->password), // ¡MUY IMPORTANTE! Encriptar la contraseña
        ]);

        // 3. Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Usuario $usuario)
    {
        // 1. Reglas de validación (similares a store, pero con ajustes)
        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Apellido' => 'required|string|max:100',
            // La regla 'unique' ahora ignora el email del usuario actual
            'Email' => ['required', 'string', 'email', 'max:50', Rule::unique('usuarios')->ignore($usuario->id)],
            'Rol' => 'required|in:Administrador,Operario',
            // La contraseña es opcional, solo se valida si se escribe algo
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // 2. Actualizamos los datos del usuario
        $usuario->Nombre = $request->Nombre;
        $usuario->Apellido = $request->Apellido;
        $usuario->Email = $request->Email;
        $usuario->Rol = $request->Rol;

        // 3. Solo actualizamos la contraseña si se proporcionó una nueva
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save(); // Guardamos los cambios

        // 4. Redireccionar con un mensaje de éxito
        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        // Medida de seguridad: impedir que un administrador se elimine a sí mismo.
        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No puedes eliminar tu propio usuario.');
        }

        $usuario->delete(); // Esto ejecuta el borrado suave

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}
