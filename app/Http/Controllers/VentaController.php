<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Inventario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index()
    {
        return Venta::with('inventario')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventario_id' => 'required|exists:inventarios,id',
            'fecha' => 'required|date',
            'cantidad_productos' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'tipo_pago' => 'required|in:credito,contado',
        ]);
    
        $inventario = Inventario::findOrFail($request->inventario_id);
    
        if ($inventario->cantidad < $request->cantidad_productos) {
            return response()->json([
                'message' => 'Cantidad insuficiente en inventario'
            ], 400);
        }
    
        $monto_total = $request->cantidad_productos * $request->precio;
    
        $venta = new Venta([
            'inventario_id' => $request->inventario_id,
            'fecha' => $request->fecha,
            'cantidad_productos' => $request->cantidad_productos,
            'precio' => $request->precio,
            'tipo_pago' => $request->tipo_pago,
            'monto_total' => $monto_total,
        ]);
    
        $venta->save();
    
        
        $inventario->cantidad -= $request->cantidad_productos;
        $inventario->save();
    
        return response()->json([
            'message' => 'Venta registrada exitosamente',
            'venta' => $venta
        ], 201);
    }

    public function show($id)
    {
        return Venta::with('inventario')->findOrFail($id);
    }

    public function update(Request $request, $id)
{
    $venta = Venta::findOrFail($id);

    $request->validate([
        'inventario_id' => 'required|exists:inventarios,id',
        'fecha' => 'required|date',
        'cantidad_productos' => 'required|integer|min:1',
        'precio' => 'required|numeric|min:0',
        'tipo_pago' => 'required|in:credito,contado',
        'monto_total' => 'required|numeric|min:0',
        'originalCantidad' => 'required|integer' 
    ]);

    $inventario = Inventario::findOrFail($request->inventario_id);

    
    $diferenciaCantidad = $request->cantidad_productos - $request->originalCantidad;

    if ($diferenciaCantidad > 0 && $inventario->cantidad < $diferenciaCantidad) {
        return response()->json([
            'message' => 'Cantidad insuficiente en inventario'
        ], 400);
    }

    
    $inventario->cantidad -= $diferenciaCantidad;
    $inventario->save();


    $venta->update([
        'inventario_id' => $request->inventario_id,
        'fecha' => $request->fecha,
        'cantidad_productos' => $request->cantidad_productos,
        'precio' => $request->precio,
        'tipo_pago' => $request->tipo_pago,
        'monto_total' => $request->monto_total,
    ]);

    return response()->json([
        'message' => 'Venta actualizada exitosamente',
        'venta' => $venta
    ], 200);
}

    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);

       
        $inventario = Inventario::findOrFail($venta->inventario_id);
        $inventario->cantidad += $venta->cantidad_productos;
        $inventario->save();

        $venta->delete();

        return response()->json([
            'message' => 'Venta eliminada exitosamente'
        ], 200);
    }
}
