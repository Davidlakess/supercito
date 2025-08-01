<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasModel;
use App\Models\domicilio_envio;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
  protected $user;

    public function __construct()
    {
       
    }
	public function detalle_pedido($id){
		$id_venta=$id;

			$venta=VentasModel::select('users.id as user_id','users.name as user','ventas.propina','ventas.envio','ventas.status','ventas.created_at')
			->Join('users','users.id','=','ventas.id_usuario','left')
		  ->where('ventas.id_venta',$id_venta)->get();
			
			$detalle=VentasModel::from('detalle_ventas')->select('productos.descripcion','detalle_ventas.cantidad','detalle_ventas.precio','imgs.src as img')
			->Join('productos','productos.id','=','detalle_ventas.id_producto','left')
			->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
     	->where('detalle_ventas.id_venta',$id_venta)
     	->get();
		
			$domicilio = domicilio_envio::select(
            'calle',
            'numero_e',
            'numero_i',
            'calle_1',
            'calle_2'
        )
        ->where('id_usuario',$venta[0]->user_id)->get();

 				$domicilio[0]->name=$venta[0]->user;

	 			$detallado= array(
	            'detalle' =>$detalle,
	            'domicilio'=>$domicilio[0],
	            'id_venta'=> $id_venta,
	            'id_usuario'=> 64,
	            'envio'=>$venta[0]->envio,
	            'fecha'=>$venta[0]->created_at,
	            'propina'=>$venta[0]->propina,
	            'status'=>$venta[0]->status
	      );  

	 			// dd($detallado);

	 	return view('admin/detalle_pedido')->with('detalle',$detallado);	
	
	}

}
