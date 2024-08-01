<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        return Inventario::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'color' => 'required|string|max:50',
            'cantidad' => 'required|integer|min:0',
        ]);

        $inventario = Inventario::create($request->all());

        return response()->json([
            'message' => 'Inventario creado exitosamente',
            'inventario' => $inventario
        ], 201);
    }

    public function show($id)
    {
        return Inventario::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $inventario = Inventario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'color' => 'required|string|max:50',
            'cantidad' => 'required|integer|min:0',
        ]);

        $inventario->update($request->all());

        return response()->json([
            'message' => 'Inventario actualizado exitosamente',
            'inventario' => $inventario
        ], 200);
    }

    public function destroy($id)
    {
        $inventario = Inventario::findOrFail($id);
        $inventario->delete();

        return response()->json([
            'message' => 'Inventario eliminado exitosamente'
        ], 200);
    }
}
