<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentasModel;
class VentasController extends Controller
{
    public function misCompras(){
        $compras = VentasModel::getCompras();
        return response()->json($compras);
    }


    public function AgregarVenta(Request $request){

        $TipoEntrega = $request->tipoentrega;
        $MetodoPago = $request->metodopago;
        $fecha_entrega = $request->fecha_entrega;
        $id_carrito = $request->id_carrito;
        $propina = $request->propina;
        $id_domicilio =$request->id_domicilio;
        $id_localidad = $request->id_localidad;

        $id_venta = VentasModel::Agregarventa( $propina, $id_localidad, $TipoEntrega, $MetodoPago,$fecha_entrega, $id_domicilio);
       
        $pro = VentasModel::insertarDetalleVentas($id_venta, $id_carrito);


        return response()->json(array('res' => true, 'pro' => $pro));

    }

    public function getDetalle($id){
        $detalle = VentasModel::getDetalle($id);
        return response()->json($detalle);
    }


}
