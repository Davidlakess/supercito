<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CategoriasModel;
use App\Models\Productos;
use App\Models\VentasModel;
use Illuminate\Http\JsonResponse;
class AdminController extends Controller
{

    public function __construct()
    {

    }
    public function getUsers(){
         $users = User::getUsers();
         return response()->json(array('res' => true,'data'=> $users));
    }
    public function getcategorias(){
         $categorias = CategoriasModel::getCategorias();
         return response()->json(array('res' => true,'data'=> $categorias));
    }
    public function getProductosbajos(){
        $probajos = Productos::getProductosbajos();
         return response()->json(array('res' => true,'data'=> $probajos));
    }
    public function getProductos(){
        $pro = Productos::getProductos();
         return response()->json(array('res' => true,'data'=> $pro));
    }
    public function getProducto($id){
       $pro = Productos::getproductosolo($id);
       $img = Productos::getImgs($id);
       $attrp = Productos::getAtributosProducto($id);
       $attr= CategoriasModel::attributo_categoria($pro->id_categoria);
        return response()->json(array('res' => true,
            'data'=>[ 
                'pro'=> $pro,
                'atributosp'=> $attrp, 
                'img'=>$img,
                'atributos' =>$attr
            ]
        )
        );
    }
    public function getVentas(){
        $ventas = VentasModel::getVentas();
        return response()->json(array('res' => true,'data'=> $ventas));
    }
    public function getVentadetalle($id){
        $venta = VentasModel::getVenta($id);
        // dd($venta);
        $productos = VentasModel::getProductosEnVenta($id);
        $domicilio = VentasModel::getDomicilioVenta($venta['id_usuario']);

        return response()->json(array('res' => true,'data'=>[
            'venta' => $venta,
            'productos' => $productos,
            'domicilio'=> $domicilio
        ]));   
    }

    public function cancelar_producto(Request $request) {
        $res = VentasModel::cancelar_producto_pedido($request->id_detalle);
         return response()->json(array('res' => true,'data'=>[$res]));   

    }

    public function authorizar_producto(Request $request) {
         $res = VentasModel::authorizar_producto_pedido();
    }
    public function newproducto(Request $request){
        $producto = new  Productos();
            $producto->id=$request->id;
            $producto->name=$request->name;
            $producto->descripcion=$request->descripcion;
            $producto->precio = $request->precio;
            $producto->stock=$request->stock;
            $producto->id_usuario=auth()->id();
            $producto->id_categoria=$request->id_categoria;
            $producto->save();
            return response()->json(array('res' => true));   
    }
    public function getnewproducto (){
        $idProducto = time();
        $categorias = CategoriasModel::getselectCategorias();
         return response()->json(array('res' => true,'data'=>[
         'id' => $idProducto,
         'categorias' => $categorias,
        ]));  
    }
}
