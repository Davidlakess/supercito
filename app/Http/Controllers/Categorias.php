<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use Illuminate\Http\JsonResponse;
class Categorias extends Controller
{
    public function buscar_producto_descripcion($q){
        
            $res = CategoriasModel::buscar_descripcion($q);
            return view('categorias/buscar_producto')->with('result',$res);         
}

    public static function getAllCategorias(){

         $categorias = CategoriasModel::getallcategorias();

          return response()->json($categorias);

    }
    public function getlocalidades(){

        
        $localidades=CategoriasModel::from('localidades')
        ->select('name','id_localidad')
        ->where('status','=',1)
        ->orderBy('name', 'asc')
        ->get();
        return response()->json($localidades);
    }
    public function getcategorias(){
       
           $categorias = CategoriasModel::getcategoriasmenu();

        echo json_encode($categorias);
      
    }

}
