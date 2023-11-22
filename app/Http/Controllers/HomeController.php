<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use App\Models\Productos;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function welcome () {
        

        // $id=auth()->id();
        // $datos=[];
        $pro=[];
        // $historial = NULL;

        // if($id){
        //   $historial = Productos::historial($id);
        // }else{
        //   $historial = false;
        // }

        $pro=CategoriasModel::get_productos_categoria();
        // $productos_nuevos=Productos::getproductos_nuevos();

        // $datos=array(
        //    'productos'=>json_encode(array($pro)),
        //    'historial'=>json_encode($historial),
        //    'pronuevos'=>$productos_nuevos
        //   );
        // echo "<pre>";
        // dd($pro);
        // echo "</pre>";
        return response()->json($pro);
          
    }
}
