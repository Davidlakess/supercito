<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use App\Models\Productos;
class WelcomeController extends Controller
{
     public function Welcome () {

        $pro=[];
        $pro=CategoriasModel::get_productos_categoria();
        return response()->json($pro);  
    
    }
    public function ProductosNuevos(){        
            
            // $id=auth()->id();
            $fecha_actual = date("Y-m-d");
            $nuevafecha = strtotime ( "-5 day" , strtotime ( $fecha_actual ));
            $nuevafecha =date ( "Y-m-j" , $nuevafecha );
            $fechahoy=strtotime ( "-1 day" , strtotime ( $fecha_actual ));
            $fechahoy=date ( "Y-m-j" , $fechahoy );
            $productos_nuevos=[];
        // dd(array('fecha_actual' => $fecha_actual, 'nuevafecha'=> $nuevafecha, 'fechahoy' =>$fechahoy));
            // if($id){
            //    $productos_nuevos= Productos::select('id as id_producto','name','imgs.src as img','precio', 'stock')
            //     ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            //     ->whereBetween('productos.created_at', array($nuevafecha,$fechahoy))
            //     ->where('id_usuario','!=',$id)
            //     ->orderBy('productos.created_at', 'desc')
            //     ->where('status','=',1)
            //     ->limit(24)
            //     ->get();
            // }else{
                $productos_nuevos = Productos::select('id as ids','name','imgs.src as img','precio', 'stock')
                    ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
                    ->whereBetween('productos.created_at', array($nuevafecha,$fechahoy))
                    ->where('status','=',1)
                   ->orderBy('productos.created_at', 'desc')
                    ->limit(24)
                    ->get();
            // }

                    // dd($productos_nuevos);
          return response()->json(array('data'=>$productos_nuevos));

    }
    public function HistorialProductos(){
            
            $id=auth()->id();
            // $id='42';
          $historial =Productos::from('historial')
          ->select('p.id as ids','p.name','imgs.src as img','p.precio', 'p.stock')
                      ->Join('productos as p', 'historial.id_producto', '=','p.id' ,'left')
                      ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                      ->where('historial.id_usuario','=',$id)
                      ->orderBy('historial.created_at', 'desc')
                      ->limit(20)
                      ->get();
        return response()->json(array('data'=>$historial));
    }
}
