<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\InformacionController;

Route::apiResource('usuarios', UsuarioController::class);
Route::post('/usuarios/login', [UsuarioController::class, 'login']);


route::apiResource('inventarios', InventarioController::class);
route::apiResource('ventas', VentaController::class);
route::apiResource('informacions',InformacionController::class);
