<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Http\JsonResponse;
class Products extends Controller
{
    //Obtiene el Producto 
    public static function getproducto($IdProducto){
        
        $str = explode("-", $IdProducto);
        $pro = Productos::getproducto($str[0]);
        $infoproducto = Productos::getcaracteristicas($pro->ids);
        $proextra = Productos::getextras($pro->ids, $pro->id_c);
        $breadcumb = Productos::get_parents_category($pro->id_c);
        $detalle = array(
            'producto'=>$pro,
            'info'=>$infoproducto,
            'extra'=>$proextra,
            'breadcrumb' => $breadcumb
        );
        Productos::addhistorial($IdProducto, auth()->id());
        return response()->json($detalle);
    }
    public function addHistorial($id_producto){
        $producto_id = historial::select('id_producto')
        ->where('id_producto','=',$id_producto)->get();
        if(!isset($producto_id[0])){
            $history = new  historial();
            $history->id_usuario=auth()->id();
            $history->id_producto=$id_producto;
            $history->frecuencia = 1;
            $history->save();
        }
    }
    public function buscarProducto ($str) {

       $res = Productos::buscar_producto($str);
        return response()->json($res);
    }
}
