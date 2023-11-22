<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetalleCarritos;
use App\Models\Productos;
use App\Models\domicilio_envio;
use App\Models\FavoritosModel;

use Illuminate\Support\Facades\DB;
class CarritoModel extends Model
{
    use HasFactory;
    protected $table = "carritos";

    public static function addCantidad($id_detalle, $cantidad){
        $detalle=DetalleCarritos::select('id_producto','cantidad')
            ->where('id_detalle',$id_detalle)->first();

        $stock=Productos::select('stock')
        ->where('id',$detalle->id_producto)->first();        
        
        if($cantidad<=$stock->stock){
            DetalleCarritos::where('id_detalle',$id_detalle)->update(['cantidad' => $cantidad]);
            return array('status'=>true,'cant'=>$cantidad,'stock'=>$stock->stock);
        }else{
            return array('status'=>false,'cant'=>$stock->stock);
        }
    }

    public static function remove_carrito_item($request){

        if($request->size != 1){
            DetalleCarritos::where('id_detalle','=',$request->id_detalle)->delete();
        } else {
            $id_carrito = $request->id_carrito;
            CarritoModel::where('id_carrito','=',$id_carrito)->delete();
        }
    }
    public static function checkout($propina, $id){
        $detalle=[];
        $carrito = CarritoModel::select(
            'detallecarritos.id_producto',
            'productos.name',
            'detallecarritos.precio',
            'detallecarritos.cantidad',
            'detallecarritos.img',
            'productos.id_usuario'
        )
        ->Join('detallecarritos', 'detallecarritos.id_carrito', '=', 'carritos.id_carrito','left')
        ->Join('productos', 'productos.id', '=', 'detallecarritos.id_producto','left')
        ->where('carritos.id_carrito',$id)->get();

        if(isset($carrito[0])){

        // $this->add_Notificacion($carrito);

            $domicilio = domicilio_envio::select(
                'domicilio_envio.calle',
                'domicilio_envio.id_domicilio',
                'domicilio_envio.numero_e',
                'domicilio_envio.numero_i',
                'domicilio_envio.calle_1',
                'domicilio_envio.calle_2',
                'domicilio_envio.id_localidad'  
            )
            ->where('id_usuario',auth()->id())->first();

                $ev=[];
                $adr='0';
                if($domicilio['id_localidad'] != null){
                    $ev = domicilio_envio::from('localidades')->select('envio','name')
                    ->where('id_localidad',$domicilio->id_localidad)->first();
                    $adr=$domicilio;
                    $adr->name=$ev->name;
                }

            return $detalle= array(
                'carrito' =>$carrito,
                'envio'=>(isset($ev->name))?$ev->envio:0,
                'adress'=> $adr,
            );
        }
    }

    public static function getCarrito(){

        $id_carrito=CarritoModel::select('id_carrito')
        ->where('id_usuario',auth()->id())->get();         
        
        $carrito=[];

        if(isset($id_carrito[0])){

            $carrito = DetalleCarritos::select(DB::raw(
            'detallecarritos.id_carrito,
            detallecarritos.id_detalle,
            productos.name as producto,
            detallecarritos.precio,
            CONVERT(detallecarritos.cantidad,UNSIGNED INTEGER) as cantidad,
            detallecarritos.img,
            1 AS disabled, 
            detallecarritos.id_producto,
            CONVERT(productos.stock,UNSIGNED INTEGER) as stock'))
            // ->Join('carritos', 'carritos.id_carrito', '=', 'detallecarritos.id_carrito','left')
            ->Join('productos', 'productos.id', '=', 'detallecarritos.id_producto','left')
            ->where('detallecarritos.id_carrito',$id_carrito[0]->id_carrito)->get();  

            return array('res' => true, 'data' => $carrito);       
        }
        return array ('res' => false);
    }
    public static function  getfavoritos(){
        $id=auth()->id();
        
        return $lista = DetalleCarritos::from('wishlist')
            ->select('productos.id as id_producto','productos.name','productos.precio','imgs.src as img')
            ->Join('productos', 'productos.id', '=', 'wishlist.id_producto','left')
            ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            ->where('wishlist.id_usuario',$id)->get();    
    }
    public static function  addfavoritos($IdProducto){
            
        $id=auth()->id();
        $favorito=new FavoritosModel();
        $favorito->id_producto=$IdProducto;
        $favorito->id_usuario=$id;
        $favorito->save();

    }
    
    public static function  delfavoritos($IdProducto){

        $id=auth()->id();
        $id_fav= FavoritosModel::select('id_wish')
         ->where('id_producto',$request->id)
         ->where('id_usuario',$id)    
         ->get(); 

        FavoritosModel::where('id_wish',$id_fav[0]->id_wish)->delete();
    }

    public static function addCarrito($id_producto, $cantidad){

        $id = CarritoModel::select('id_carrito')->where('id_usuario',auth()->id())->get();
            $id_carro = 0;
     
            $detalle = Productos::select('imgs.src as img','productos.precio')
            ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            ->where('productos.id',$id_producto)
            ->first();

            $detalle->cantidad = $cantidad;
            $detalle->id_producto = $id_producto;

        if(!isset($id[0])){
   
            $id_carro = rand(1000,9999);
            $carrito = new CarritoModel();
            $carrito->id_usuario=auth()->id();
            $carrito->id_carrito=$id_carro;
            $carrito->save();

            $dcarrito = new DetalleCarritos();
            $dcarrito->img = $detalle->img;
            $dcarrito->precio=$detalle->precio;
            $dcarrito->cantidad = $detalle->cantidad;
            $dcarrito->id_producto=$detalle->id_producto;
            $dcarrito->id_carrito=$id_carro;
            $dcarrito->save();
            return array('res' => true);
         
         }else{
        
            $id_carro=$id[0]->id_carrito;
            $stock=Productos::select('stock')->where('id',$id_producto)->first();        
            $id_detalle=DetalleCarritos::select('id_detalle','cantidad')
            ->where('id_producto',$detalle->id_producto)
            ->where('id_carrito',$id_carro)
            ->get();
            
            if(isset($id_detalle[0]->cantidad)){
                $cant_total = $id_detalle[0]->cantidad + $detalle->cantidad;
                
                if($cant_total <= $stock->stock){
                    DetalleCarritos::where(
                        'id_detalle',$id_detalle[0]->id_detalle)
                    ->update(['cantidad' =>$cant_total]);
                    return array('res' => true);
                }else{
                    return array('res'=>false , 'stock' => $stock->stock);
                }

            }else{
              $dcarrito = new DetalleCarritos();
              $dcarrito->img = $detalle->img;
              $dcarrito->precio=$detalle->precio;
              $dcarrito->cantidad = $detalle->cantidad;
              $dcarrito->id_producto=$detalle->id_producto;
              $dcarrito->id_carrito=$id_carro;
              $dcarrito->save();
              return array('res' => true);
            }
    
         }
    }
}
