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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[App\Http\Controllers\WelcomeController::class,'welcome']);
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

    Route::get('/misproductos', [App\Http\Controllers\MisProductosController::class,'index'])->name('misproductos');

    Route::get('/perfil',[App\Http\Controllers\Userscontroller::class,'get_info_user'])->name('perfil');
Route::get('/miscompras', [App\Http\Controllers\MisComprasController::class,'index'])->name('miscompras');
    Route::get('/carrito', [App\Http\Controllers\CarritoController::class,'index'])->name('carrito');
    Route::post('/coleccion',[App\Http\Controllers\WelcomeController::class,'cambiar_collection']);
    Route::get('item/{id}',[App\Http\Controllers\DetalleController::class,'index'])->name('item');
    Route::get('/carrito',[App\Http\Controllers\Carrito::class,'index'])->name('carrito');
Route::post('addcarrito', [App\Http\Controllers\Carrito::class, 'addcarrito']);
Route::post('addcantidad',[App\Http\Controllers\Carrito::class, 'addcantidad']);
Route::post('getcategorias',[App\Http\Controllers\Categorias::class,'getcategorias'])->name('getcategorias');

Route::get('search/{q}',[App\Http\Controllers\Categorias::class,'buscar_producto_descripcion']);
Route::get('/favoritos', 'CarritoController@favoritos')->name('favoritos');
Route::get('/middlecarrito', function () {
    return view('middlecarrito');
})->middleware('mdcarrito')->name('middlecarrito');