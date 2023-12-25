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

Route::group(['middleware' => 'auth'], function () {
    Route::get('carrito',[App\Http\Controllers\Carrito::class,'index'])->name('carrito');;
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/misproductos', [App\Http\Controllers\MisProductosController::class,'index'])->name('misproductos');
    Route::get('/perfil',[App\Http\Controllers\Users::class,'get_info_user'])->name('perfil');
    Route::get('/miscompras', [App\Http\Controllers\MisComprasController::class,'index'])->name('miscompras');
    Route::post('addcarrito', [App\Http\Controllers\Carrito::class, 'addcarrito']);
    Route::post('addcantidad',[App\Http\Controllers\Carrito::class, 'addcantidad']);
    Route::get('/favoritos', [App\Http\Controllers\Carrito::class, 'favoritos'])->name('favoritos');
    Route::post('addfavoritos', [App\Http\Controllers\Carrito::class, 'addfavoritos'])->name('addfavoritos');
    Route::post('delfavoritos', [App\Http\Controllers\Carrito::class, 'delfavoritos'])->name('delfavoritos');
    Route::get('checkout/pagarview/', [App\Http\Controllers\Carrito::class, 'checkoutweb']);
    Route::get('detallecompra/{id}/', [App\Http\Controllers\MisComprasController::class,'detalle_compras']);
});
// admin routes
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
// admin routes Fin

    Route::get('contacto',[App\Http\Controllers\WelcomeController::class,'contactoview'])->name('contacto');
    Route::post('addcontacto',[App\Http\Controllers\WelcomeController::class,'addcontacto'])->name('addcontacto');
    Route::post('/coleccion',[App\Http\Controllers\WelcomeController::class,'cambiar_collection']);
    Route::get('item/{id}',[App\Http\Controllers\DetalleController::class,'index'])->name('item');
    Route::get('getcategorias',[App\Http\Controllers\Categorias::class,'getcategorias'])->name('getcategorias');
    Route::post('registrar',[App\Http\Controllers\Auth\RegisterController::class, 'registrar']);
    Route::get('search/{q}',[App\Http\Controllers\Categorias::class,'buscar_producto_descripcion']);
    Route::get('c/{categoria}/{c}',[App\Http\Controllers\Categorias::class,'producto_por_categoria']);
    Route::get('/AllCategorias',[App\Http\Controllers\Categorias::class,'AllCategorias']);