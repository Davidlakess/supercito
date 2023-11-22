<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\domicilio_envio;
use App\Models\DetalleCarritos;
use App\Models\CarritoModel;
use App\Models\DetalleVentas;
use Illuminate\Support\Facades\DB;
class VentasModel extends Model
{
    use HasFactory;

    protected $table = "ventas";
    
    static public function Agregarventa ($propina,$id_localidad, $TipoEntrega, $tipo_pago, $fecha_entrega, $id_domicilio) {
        $fecha = '';
        if ($TipoEntrega == 1) {
             
            $envio=DetalleCarritos::from('localidades')
            ->select('envio','name')
            ->where('id_localidad',$id_localidad)
            ->first();
            $fecha = ($fecha_entrega) ? $fecha_entrega : date('Y-m-d H:i:s');
        }else{
            $fecha = date('Y-m-d H:i:s');
            $envio = 0;   
        }

            $id_venta='v'.time();
            $venta = new  VentasModel();
            $venta->id_usuario=auth()->id();
            $venta->propina=$propina;
            $venta->envio=$envio->envio;
            $venta->id_domicilio = $id_domicilio;
            $venta->id_venta=$id_venta;
            $venta->fecha_entrega=$fecha;
            $venta->tipo_pago = $tipo_pago;
            $venta->save();
            return $id_venta;
            //descomentar en servidor
            // $this->enviar_correo($id_venta);   

    }
    static public function insertarDetalleVentas ($id_venta,$id_carrito) {
        $data=DetalleCarritos::from('detallecarritos as dc')-> select('dc.cantidad','dc.precio','dc.id_producto','p.name')
        ->Join('productos as p', 'dc.id_producto', '=','p.id' ,'left')
        ->where('dc.id_carrito',$id_carrito)
        ->get();

        $pro=[];
        $detalles = [];
        $size=sizeof($data);
        $subtotal=0;
        for($i =0;$i<$size;$i++){  
                VentasModel::restar_stock($data[$i]->cantidad,$data[$i]->id_producto);
                $detalle['cantidad'] = $data[$i]->cantidad;
                $detalle['precio'] = $data[$i]->precio;
                $detalle['id_producto']=$data[$i]->id_producto;
                $detalle['id_venta'] = $id_venta;
                // Agregar el id de domicilio o conseguirlo 
                $detalles[] = $detalle;
                $subtotal2=$data[$i]->cantidad*$data[$i]->precio;
                $pro[]= array(
                            'name'=>$data[$i]->name,
                            'precio'=>$data[$i]->precio,
                            'cantidad'=>$data[$i]->cantidad,
                            'subtotal'=>$subtotal2
                );
                $subtotal+=$subtotal2;
            }
        DetalleVentas::insert($detalles);
        // VACIAR CARRITO
        DB::table('carritos')->where('id_carrito','=',$id_carrito)->delete();
        return $pro;
    }
    static public function restar_stock($cantidad,$id_producto){

            try {

            $sql="update productos set stock = stock - ? where id = ?";
            
            DB::update($sql, array($cantidad,$id_producto));

            } catch (Exception $e) {
                
            }
    }
    static public function getdetalle($id){
           
           $venta = VentasModel::select(
                'status as statusventa',
                'created_at as fecha',
                'envio',
                'propina'
            )
            ->where('ventas.id_venta',$id)   
            ->first();
            
        if(isset($venta->statusventa)){

        $detalle= VentasModel::from('detalle_ventas')->select(
            'productos.name as descripcion',
            'productos.id as ids',
            'detalle_ventas.cantidad',
            'detalle_ventas.precio',
            'detalle_ventas.status',
            'detalle_ventas.status_entrega',
            'users.name',
            'users.telefono',
            'imgs.src as img'
        )
        ->Join('productos', 'productos.id', '=', 'detalle_ventas.id_producto','left')
        ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
        ->Join('users', 'users.id', '=', 'productos.id_usuario','left')
        ->join('domicilio_envio','users.id','=','domicilio_envio.id_usuario','left')
        ->where('detalle_ventas.id_venta',$id)->get();

         return array(
                'venta'=>$venta,
                'detalle'=>$detalle
            );
        
        }else{

         return array('status'=>false);

        }
    }
    static public function getCompras(){
        // $id = auth()->id()
        /* NUEVA CONSULTA PARA OBTENER LAS COMPRAS DE UN USUARIO PARA SER ESCALABLE Y EN CASO DE AGREGAR VARIOS DOMICILIOS ASI SE MUESTRE...
        SELECT * FROM ventas LEFT JOIN domicilio_envio ON domicilio_envio.`id_domicilio` = ventas.`id_domicilio` 
        WHERE ventas.`id_usuario` = '42' AND ventas.`id_domicilio` = ventas.`id_domicilio` 
        */


        // $id = '43';
        $id = auth()->id();
        $ventas = VentasModel::select(
        'ventas.id_venta',
        'ventas.status',
        'ventas.updated_at',
        'dm.calle',
        'dm.numero_e',
        'dm.numero_i',
        'dm.calle_1',
        'dm.calle_2',
        DB::raw("(SELECT COUNT(detalle_ventas.id_detalle) FROM detalle_ventas WHERE detalle_ventas.id_venta=ventas.id_venta) AS cantidadart"))
        ->Join('domicilio_envio as dm', 'dm.id_domicilio', '=','ventas.id_domicilio' ,'left')
        ->where('ventas.id_usuario',$id)   
        ->orderBy('ventas.created_at', 'desc')
        ->get();

        return $ventas;
    }
}
