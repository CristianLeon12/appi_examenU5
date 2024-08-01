<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'inventario_id', 'fecha', 'cantidad_productos', 'precio', 'tipo_pago', 'monto_total'
    ];

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
}
