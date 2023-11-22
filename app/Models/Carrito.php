<?php

namespace App\Models;
use App\Models\DetalleCarritos;
use App\Models\Productos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    public static function addCantidad($id_detalle){
        $detalle=DetalleCarritos::select('id_producto','cantidad')
            ->where('id_detalle',$id_detalle)->first();

        $stock=Productos::select('stock')
        ->where('id',$detalle->id_producto)->first();        
                
        $cantidad=$request->cantidad;
        
        if($cantidad<=$stock->stock){
            DetalleCarritos::where('id_detalle',$id_detalle)->update(['cantidad' => $cantidad]);
            return array('status'=>true,'cant'=>$cantidad,'stock'=>$stock->stock);
        }else{
            return array('status'=>false,'cant'=>$stock->stock);
        }
    }

    public static function addCarrito($id_producto, $cantidad){

        $id=Carrito::select('id_carrito')->where('id_usuario',auth()->id())->get();
            $id_carro=0;
     
            $detalle=Productos::select('imgs.src as img','productos.precio')
            ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            ->where('productos.id',$id_producto)
            ->get();

            $detalle[0]->cantidad=($cantidad)?$cantidad:1;
            $detalle[0]->id_producto=$id_producto;

        if(!isset($id[0])){
   
            $id_carro =rand(1000,9999);
            $carrito=new Carrito();
            $carrito->id_usuario=auth()->id();
            $carrito->id_carrito=$id_carro;
            $carrito->save();
            $this->insertardetalle($detalle[0],$id_carro);
         
         }else{
        
            $id_carro=$id[0]->id_carrito;
            $stock=Productos::select('stock')->where('id',$id_producto)->get();        
            $id_detalle=DetalleCarrito::select('id_detalle','cantidad')
            ->where('id_producto',$detalle[0]->id_producto)
            ->where('id_carrito',$id_carro)
            ->get();
            
            if(isset($id_detalle[0])){
                $cant_total=$id_detalle[0]->cantidad+$detalle[0]->cantidad;
                if($cant_total <= $stock[0]->stock){
                    DetalleCarrito::where(
                        'id_detalle',$id_detalle[0]->id_detalle)
                    ->update(['cantidad' =>$cant_total]);
                    return array('res' => true);
                }else{
                    return array('res'=>false);
                }
            }else{
                $this->insertardetalle($detalle[0],$id_carro);
            }
    
         }
    }

    public static function insertardetalle(){
        $dcarrito = new DetalleCarrito();
        $dcarrito->img=$detalle->img;
        $dcarrito->precio=$detalle->precio;
        $dcarrito->cantidad=$detalle->cantidad;
        $dcarrito->id_producto=$detalle->id_producto;
        $dcarrito->id_carrito=$id_carro;
        $dcarrito->save();
    }
}
