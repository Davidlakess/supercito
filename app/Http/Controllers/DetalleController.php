<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Productos;
use App\Models\historial;
use Illuminate\Support\Facades\DB;
class DetalleController extends Controller
{
    public function index($ids)
    {

        $aux=explode("-", $ids);
        $id=$aux[0];
        $productos=[];
        $producto=[];
        $logeado=\auth::check();

        if($logeado){
            $producto=Productos::get_productodetalle($id);

        }else{

        $producto=Productos::from('productos as p')->select(DB::raw('p.id as ids,p.name,p.descripcion AS des,p.precio,p.stock,p.id_categoria AS id_c ,GROUP_CONCAT(imgs.src SEPARATOR ",") AS imgs,0 as wish'))
            ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
            ->where('p.id','=',$id)
            ->groupBy('p.id')
            ->get();

        }

        // print_r($producto[0]);
        if(isset($producto[0]->ids)){

            $breadcum=Productos::get_parents_category($producto[0]->id_c);
            // productos extra de la misma categooria  20items

            $infoproducto=Productos::from('atributos_producto as atp')
            ->select(DB::raw('att.name AS clave,atp.valor,att.unidades'))
            ->Join('atributos_categoria as atc', 'atp.id_atributo', '=','atc.id' ,'left')
            ->Join('atributos as att', 'atc.id_atributo', '=','att.id_atributo' ,'left')
            ->where('atp.id_producto','=',$producto[0]->ids)->get();
            
            $proextra= Productos::select('id as ids','name','stock','src as img' ,'precio','id_categoria')
            ->Join('imgs', 'id', '=','id_producto' ,'left')
            ->where('id','!=',$producto[0]->ids)
            ->where('id_categoria','=',$producto[0]->id_c)
            ->inRandomOrder()->limit(20)->get();

            $productos= Productos::select('id as ids','name','stock','src as img' ,'precio','id_categoria')
            ->Join('imgs', 'id', '=','id_producto' ,'left')
            ->where('id_categoria','!=',$producto[0]->id_c)
            ->inRandomOrder()->limit(20)->get();

            $detalle=array(
                'producto'=>json_encode($producto[0]),
                'caracteristicas'=>json_encode($infoproducto),
                'productos'=>json_encode($productos),
                'nav'=>($breadcum)?json_encode($breadcum):'false',
                'extra'=>json_encode($proextra)
            );

            if($logeado){
                $producto_id=historial::select('id_producto')
                ->where('id_producto','=',$producto[0]->ids)->get();
                if(!isset($producto_id[0])){

                    $history = new  historial();
                    $history->id_usuario=auth()->id();
                    $history->id_producto=$producto[0]->ids;
                    $history->save();
                }
            }
            return view('Productos/detalle')->with('data',$detalle);
        }else{
          return redirect('/home');
        }
    }
}
