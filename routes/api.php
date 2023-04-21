<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\DirectorioController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('altaElemento', [DirectorioController::class, 'store']);
Route::get('todosElementos', [DirectorioController::class, 'index']);
Route::post('actualizaElemento/{id}', [DirectorioController::class, 'update']);
Route::post('detalleElemento/{id}', [DirectorioController::class, 'show']);
Route::post('eliminaElemento/{id}', [DirectorioController::class, 'destroy']);
