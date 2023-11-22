<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/usuarios',[App\Http\Controllers\AdminController::class,'usuarios']);
    Route::get('categorias',[App\Http\Controllers\AdminController::class,'categorias']);
    Route::get('/ventas',[App\Http\Controllers\AdminController::class,'ventas'])->name('ventas');
    Route::get('productos',[App\Http\Controllers\AdminController::class,'productos'])->name('productos');
    Route::post('getusers',[App\Http\Controllers\AdminController::class,'getusuarios']);
    Route::post('getventas',[App\Http\Controllers\AdminController::class,'getventas']);
    Route::get('pedido/{id}',[App\Http\Controllers\AdminController::class,'detalle_pedido']);
    Route::post('create/categoria',[App\Http\Controllers\AdminController::class,'addcategoria']);
    Route::post('create/usuario',[App\Http\Controllers\AdminController::class,'addusuario']);
    Route::post('/autorizarpedido',[App\Http\Controllers\AdminController::class,'autorizar_pedido']);
