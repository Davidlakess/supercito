<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasModel;
use App\Models\DetalleVentas;
use App\Models\domicilio_envio;
use Illuminate\Support\Facades\DB;

class MisComprasController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
    	$ventas = VentasModel::select(
		'ventas.id_venta','ventas.status','ventas.updated_at',
		DB::raw("(SELECT COUNT(detalle_ventas.id_detalle) FROM detalle_ventas WHERE detalle_ventas.id_venta=ventas.id_venta) AS cantidadart"))
		->where('ventas.id_usuario',auth()->id())   
        ->orderBy('ventas.created_at', 'desc')
        ->get();
        
        //Corregir y poner el id domicilio por si tiene mas domicilios de envio

        $domicilio = domicilio_envio::select(
            'calle',
            'numero_e',
            'numero_i',
            'calle_1',
            'calle_2'
        )
            ->where('id_usuario',auth()->id())->get();

        $compras= array(
            'ventas' =>(isset($ventas[0]))?$ventas:false,
            'domicilio'=>(isset($domicilio[0]))?$domicilio[0]:0,

        );  
        // dd($compras);

        return view('miscompras')->with('compras',$compras);
    }
    public function detalle_compras($id)
    {
            $venta = VentasModel::select(
                'status as statusventa',
                'status_entrega',
                'created_at as fecha',
                'envio',
                'propina'
            )
            ->where('ventas.id_venta',$id)   
            ->get();

            // dd($venta);
        if(isset($venta[0])){

    	$detalle= DetalleVentas::select(
    		'productos.name as descripcion',
            'productos.id as ids',
    		'detalle_ventas.cantidad',
    		'detalle_ventas.precio',
            'detalle_ventas.status_entrega as status',
    		'users.name',
            'users.telefono',
    		'imgs.src as img'
    	)
    	->Join('productos', 'productos.id', '=', 'detalle_ventas.id_producto','left')
        ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
        ->Join('users', 'users.id', '=', 'productos.id_usuario','left')
        ->join('domicilio_envio','users.id','=','domicilio_envio.id_usuario','left')
    	->where('detalle_ventas.id_venta',$id)->get();

         return view('detalle_compras')->with('detalles',array(
                'venta'=>json_encode($venta[0]),
                'detalle'=>$detalle
            ));
        
        }else{

         return view('detalle_compras')->with('detalles',array('status'=>false));

        }
    }
}
