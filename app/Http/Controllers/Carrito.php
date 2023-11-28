<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarritoModel;

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
