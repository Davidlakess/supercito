<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoModel;
use App\Models\domicilio_envio;

class Carrito extends Controller
{
        public function index()
    {

        $id_carrito=CarritoModel::select('id_carrito')
        ->where('id_usuario',auth()->id())->get();                 
        $carrito=[];
        if(isset($id_carrito[0])){
            $carrito = CarritoModel::getCarrito($id_carrito[0]->id_carrito);       
        }
        // dd($carrito);
                return view('carrito')->with('carrito',$carrito);
    }

    public function checkoutweb(Request $request){
         $id =$request->id;
        $propina=$request->tip;
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
                'domicilio_envio.numero_e',
                'domicilio_envio.numero_i',
                'domicilio_envio.calle_1',
                'domicilio_envio.calle_2',
                'domicilio_envio.id_localidad'  
            )
            ->where('id_usuario',auth()->id())->first();

                $ev=[];
                $adr='0';
                if(isset($domicilio['id_localidad'])){
                    $ev = domicilio_envio::from('localidades')->select('envio','name')
                    ->where('id_localidad',$domicilio->id_localidad)->first();
                    $adr=$domicilio;
                    $adr->name=$ev->name;
                }


            $detalle= array(
                'carrito' =>$carrito,
                'propina'=>$propina,
                'envio'=>(isset($ev->name))?$ev->envio:0,
                'id_carrito'=>$id,
                'adress'=> $adr
            );  
     
            return view('pagarview')->with('detalle',$detalle);
        }else{
            return  redirect('/carrito');
        }
    }

    public function addcarrito(Request $request)
    {       
            if ($request->id_producto != '' && $request->cant != ''){
                $result = CarritoModel::addCarrito($request->id_producto, $request->cant);
                return response()->json($result);
            } else {
                 return response()->json(array('res' => false));
            }
    }

    public function getcarrito(){
        
        $result = CarritoModel::getCarrito();
        echo json_encode($result);
    
    }
    public function getFavoritos() {
        $result = CarritoModel::getFavoritos();
        return response()->json(array('res' => false, 'fav' => $result ));
    }
    public function  addfavoritos(Request $request){
        CarritoModel::addfavoritos($request->id);
        return response()->json(['res' => true]);
    }
    public function  delfavoritos(Request $request){
        CarritoModel::delfavoritos($request->id);
        return response()->json(['res' => true]);
    }
    public function checkout($propina, $id){
        
        $data = CarritoModel::checkout($propina, $id);
        return response()->json($data);

    }
    public function addcantidad(Request $request){

        $result = CarritoModel::addCantidad($request->id_detalle, $request->cantidad);
         // json_encode($result);
        return response()->json($result);
    }

    public function remove_carrito_item(Request $request){
        
        CarritoModel::remove_carrito_item($request);
    }
}
