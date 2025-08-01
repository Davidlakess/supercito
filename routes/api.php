<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::post('/login',[App\Http\Controllers\Auth\LoginController::class ,'AdminLogin']);
Route::get('/categorias',[App\Http\Controllers\Admin\AdminController::class ,'getcategorias']);
Route::get('/productos',[App\Http\Controllers\Admin\AdminController::class ,'getproductos']);
Route::get('/bajos',[App\Http\Controllers\Admin\AdminController::class ,'getProductosbajos']);
Route::get('/productod/{id}',[App\Http\Controllers\Admin\AdminController::class ,'getProducto']);


Route::get('/sms', [App\Http\Controllers\SmsController::class, 'sendSms']);
Route::post('/verifycode', [App\Http\Controllers\SmsController::class, 'verify']);

Route::post('/sanctum/token',[App\Http\Controllers\Auth\LoginController::class, 'logindevice']);
Route::get('/producto/{id}/', [App\Http\Controllers\Products::class, 'getproducto']);
Route::get('/productosextra', [App\Http\Controllers\Products::class, 'getextras']);
Route::get('/buscar/{str}', [App\Http\Controllers\Products::class, 'buscarProducto']);
Route::get('/getproductos', [App\Http\Controllers\Products::class, 'getproductos']);
Route::get('/allcategorias', [App\Http\Controllers\Categorias::class, 'getAllCategorias']);
Route::get('/getlocalidades',[App\Http\Controllers\Categorias::class,'getlocalidades']);
Route::post('registrar',[App\Http\Controllers\Auth\RegisterController::class, 'registrar']);
Route::get('/noty', [App\Http\Controllers\SmsController::class, 'noty']);

Route::group(['middleware' => 'auth:sanctum'], function () {
Route::post('/storage/create',[App\Http\Controllers\StorageController::class ,'save']);
Route::get('/ventas',[App\Http\Controllers\Admin\AdminController::class ,'getVentas']);
Route::get('/venta/{id}',[App\Http\Controllers\Admin\AdminController::class ,'getVentadetalle']);
    Route::get('/users',[App\Http\Controllers\Admin\AdminController::class ,'getUsers']);
    Route::get('/user', function (Request $request) {
        return response()->json(Auth::user());
    });
    Route::get('/getcompras',[App\Http\Controllers\VentasController::class,'misCompras']);
    Route::get('/checkout/{propina}/{id}',[App\Http\Controllers\Carrito::class,'checkout']);
    Route::get('/compradetalle/{id_venta}',[App\Http\Controllers\VentasController::class,'getDetalle']);
    Route::post('/user', [App\Http\Controllers\Users::class, 'UserUpdate']);
    Route::post('/updateuser', [App\Http\Controllers\Users::class, 'ActualizarUsuario']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logoutDevice']);
    Route::post('/addcarrito', [App\Http\Controllers\Carrito::class, 'addcarrito']);
    Route::post('/addcantidad', [App\Http\Controllers\Carrito::class, 'addcantidad']);
    Route::get('/carrito', [App\Http\Controllers\Carrito::class, 'getcarrito']);
    Route::post('/addfavoritos', [App\Http\Controllers\Carrito::class, 'addfavoritos']);
    Route::post('/delfavoritos', [App\Http\Controllers\Carrito::class, 'delfavoritos']);
    Route::get('/favoritos', [App\Http\Controllers\Carrito::class, 'getFavoritos']);
    Route::post('/removeitem', [App\Http\Controllers\Carrito::class, 'remove_carrito_item']);
    Route::post('/password', [App\Http\Controllers\Users::class, 'CambiarPassword']);
    Route::get('/domicilio', [App\Http\Controllers\Users::class, 'getDomicilio']);
    Route::post('/pedido', [App\Http\Controllers\VentasController::class, 'AgregarVenta']);
       Route::post('/cancelarproducto', [App\Http\Controllers\Admin\AdminController::class, 'cancelar_producto']);
   Route::post('/authorizarproducto', [App\Http\Controllers\Admin\AdminController::class, 'autorizar_producto']);
    Route::get('/getnewproducto', [App\Http\Controllers\Admin\AdminController::class, 'getnewproducto']);
    Route::get('/newproducto', [App\Http\Controllers\Admin\AdminController::class, 'newproducto']);

   // Route::post('cancelarventa', [App\Http\Controllers\Admin\AdminController::class ,'AgregarVenta']);
    //Route::post('authorizarpedido', [App\Http\Controllers\Admin\AdminController::class ,'AgregarVenta']);

     
});
    Route::get('/productosnuevos', [App\Http\Controllers\WelcomeController::class, 'ProductosNuevos']);
    Route::get('/historial', [App\Http\Controllers\WelcomeController::class, 'HistorialProductos']);
    Route::get('/welcome', [App\Http\Controllers\WelcomeController::class, 'Welcome']);
