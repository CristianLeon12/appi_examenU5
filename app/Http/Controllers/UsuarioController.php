<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use App\Mail\Video; 

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::all();
    }

    public function login(Request $request)
    {
        $request->validate([
            'correo_electronico' => 'required|string|email',
            'contrasena' => 'required|string',
        ]);
    
        $usuario = Usuario::where('correo_electronico', $request->correo_electronico)->first();
    
        if (!$usuario) {
            return response()->json([
                'message' => 'El correo electrónico no existe'
            ], 401);
        }
    
        if (!Hash::check($request->contrasena, $usuario->contrasena)) {
            return response()->json([
                'message' => 'Contraseña incorrecta'
            ], 401);
        }
    
        return response()->json([
            'message' => 'Inicio de sesión exitoso',
            'usuario' => $usuario
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required|string|max:255',
            'correo_electronico' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:usuarios',
                // 'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
                 'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|itoaxaca\.edu\.mx)$/'
            ],
            'contrasena' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', 
                'regex:/[A-Z]/', 
                'regex:/[0-9]/', 
                'regex:/[@$!%*?&]/', 
                'confirmed'
            ],
        ]);
    
        $usuario = new Usuario([
            'nombre_completo' => $request->nombre_completo,
            'correo_electronico' => $request->correo_electronico,
            'contrasena' => Hash::make($request->contrasena),
        ]);
    
        $usuario->save();
        Mail::to($usuario->correo_electronico)->send(new Video($usuario->nombre_completo));
    
        return response()->json([
            'message' => 'Usuario creado exitosamente',
            'id' => $usuario->id 
        ], 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return Usuario::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'sometimes|required|string|max:255',
            'correo_electronico' => [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                'unique:usuarios,correo_electronico,' . $usuario->id,
                'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/'
            ],
            // 'contrasena' => [
            //     'sometimes',
            //     'required',
            //     'string',
            //     'min:8',
            //     'regex:/[a-z]/', // debe contener al menos una letra minúscula
            //     'regex:/[A-Z]/', // debe contener al menos una letra mayúscula
            //     'regex:/[0-9]/', // debe contener al menos un número
            //     'regex:/[@$!%*?&]/', // debe contener al menos un carácter especial
            //     'confirmed'
            // ],
        ]);

        if ($request->has('nombre_completo')) {
            $usuario->nombre_completo = $request->nombre_completo;
        }

        if ($request->has('correo_electronico')) {
            $usuario->correo_electronico = $request->correo_electronico;
        }

        if ($request->has('contrasena')) {
            $usuario->contrasena = Hash::make($request->contrasena);
        }

        $usuario->save();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente',
            'usuario' => $usuario
        ], 200);
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente'
        ], 200);
    }
}
