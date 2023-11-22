<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VentasModel;
use App\Models\domicilio_envio;
use App\Models\Productos;
use App\Models\CategoriasModel;
use App\Models\NotificationsModel;

use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
  protected $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

	        $user = Auth::user();
 
 			if(isset($user->role_id)){

		        if($user->role_id===1){

		            return $next($request);        
		        
		        }else{
		            
		        }
 			}else{
 				return redirect('login');
 			}
        });
    }

    public function usuarios()
    {
	 	return view('admin/usuarios');
	}
	
	public function productos()
    {
    	
    	 $pro = Productos::select(
    	 	'productos.id as ids',
    	 	'productos.name',
    	 	'productos.status',
    	 	'productos.precio',
    	 	'productos.stock'
    	 )
        ->limit(70)
        ->get();

	 	return view('admin/productos')->with('productos',json_encode($pro));
	}

	public function categorias()
    {
	 	return view('admin/categorias');
	}

	public function ventas()
    {
		 	
	 	return view('admin/ventas');
	}
	
	public function getusuarios(){
		$usuarios=User::select('id','name','email')->get();
		echo json_encode($usuarios);
	}
	public function detalle_pedido($id_venta){
		// $id_venta=$id;
			$venta=VentasModel::select('users.id as user_id','users.name as user','ventas.propina','ventas.tipo_pago','ventas.envio','ventas.status','ventas.created_at')
			->Join('users','users.id','=','ventas.id_usuario','left')
		  ->where('ventas.id_venta',$id_venta)->first();
			
			$detalle=VentasModel::from('detalle_ventas')->select('productos.descripcion','detalle_ventas.cantidad','detalle_ventas.precio','imgs.src as img')
			->Join('productos','productos.id','=','detalle_ventas.id_producto','left')
			->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
     	->where('detalle_ventas.id_venta',$id_venta)
     	// ->groupBy('productos.id')
     	->get();
		
        $domicilio = domicilio_envio::select(
                'domicilio_envio.calle',
                'domicilio_envio.numero_e',
                'domicilio_envio.numero_i',
                'domicilio_envio.calle_1',
                'domicilio_envio.calle_2',
                'domicilio_envio.referencia',
                'domicilio_envio.id_localidad',
                'domicilio_envio.long',
                'domicilio_envio.lat',
                'localidades.name as localidad'  
            )
            ->Join('localidades', 'localidades.id_localidad', '=', 'domicilio_envio.id_localidad','left')
            ->where('domicilio_envio.id_usuario',$venta->user_id)->first();

 				$domicilio->name=$venta->user;

	 			$detallado= array(
	            'detalle' =>$detalle,
	            'domicilio'=>$domicilio,
	            'id_venta'=> $id_venta,
	            'id_usuario'=>$venta->user_id,
	            'envio'=>$venta->envio,
	            'fecha'=>$venta->created_at,
	            'propina'=>$venta->propina,
	            'status'=>$venta->status
	      );  

	 			// dd($detallado);

	 	return view('admin/detalle_pedido')->with('detalle',$detallado);	
	
	}

	public function getventas(){
	
		$ventas=VentasModel::select(
			'domicilio_envio.calle',
			'domicilio_envio.numero_e',
			'users.telefono',
			'id_venta','users.name','status')
	->where('status','!=',3)
	->Join('domicilio_envio','domicilio_envio.id_domicilio','=','ventas.id_domicilio','left')
	->Join('users','users.id','=','ventas.id_usuario','left')
	
	->orderBy('ventas.created_at', 'asc')
	->get();
    
     echo json_encode($ventas);
	}


	public function addcategoria(Request $request){
            Categorias::insert(array('name'=>$request->name));
	}
	public function addusuario(Request $request){
	  $user=new User();
	  $usuario=json_decode($request->usuario);
	  $user->name=$usuario->name;
	  $user->email=$usuario->email;
	  $user->password=bcrypt($usuario->pass);
	  $user->id_rol=$usuario->rol;
	  $user->save();
	}
	public function autorizar_pedido(Request $request){  	
	  	  // dd($request);
	  	   VentasModel::where('id_venta',$request->id_venta)
           ->update(['status' =>'2']);

           $token = User::select('f_token')
           ->where('id',$request->id_usuario)
           ->first();
           // Mandar notificacion
           NotificationsModel::SendNotification($token, $request->id_venta, 'enviado');

           echo json_encode(array('token'=>$token, 'id'=>$request->id_usuario));
	}
}
