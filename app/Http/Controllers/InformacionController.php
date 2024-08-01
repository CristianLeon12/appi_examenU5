<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;


class InformacionController extends Controller
{
    public function index()
    {
        return Informacion::with('usuario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/images');
    
            $informacion = new Informacion();
            $informacion->usuario_id = $request->usuario_id;
            $informacion->image_path = $path;
            $informacion->save();
    
            return response()->json(['message' => 'Imagen subida correctamente', 'data' => $informacion], 201);
        }
    
        return response()->json(['message' => 'No se pudo subir la imagen'], 400);
    }
    
    public function show($id)
    {
        $informacion = Informacion::with('usuario')->where('usuario_id', $id)->first();
        if (!$informacion) {
            $usuario = Usuario::find($id);
            return response()->json([
                'usuario' => $usuario,
                'image_path' => null
            ], 200);
        }
        return response()->json($informacion, 200);
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $informacion = Informacion::findOrFail($id);

        if ($request->hasFile('image')) {
          
            Storage::delete($informacion->image_path);

            $path = $request->file('image')->store('public/images');
            $informacion->image_path = $path;
        }

        $informacion->usuario_id = $request->usuario_id;
        $informacion->save();

        return response()->json(['message' => 'Imagen actualizada correctamente', 'data' => $informacion], 200);
    }

    public function destroy($id)
    {
        $informacion = Informacion::findOrFail($id);

       
        Storage::delete($informacion->image_path);

        $informacion->delete();

        return response()->json(['message' => 'Imagen eliminada correctamente'], 200);
    }
}
