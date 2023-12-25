<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use App\Models\Productos;
use App\Models\logs;
class WelcomeController extends Controller
{
     public function welcome(Request $request){
            
            // $browser=$_SERVER['HTTP_USER_AGENT'];
            // $ref=isset($_SERVER['HTTP_REFERER']);
            // $ip=$request->ip();

            // $log=logs::select('ip')
            // ->where('ip',$ip)
            // ->get();
            
            // if(!isset($log[0])){
            //     $logs=new logs();
            //     $logs->navegador=$browser;
            //     $logs->url_referencia=$ref;
            //     $logs->ip=$ip;
            //     $logs->tipo_log='visitante';
            //     $logs->save();
            // }

            $limit=12;
            $limitcat=24;
            $datos=null;
            $limithistory=16;
              $datos= $this->set_datos_welcome($limit,$limitcat,$limithistory,0);    
         
            // dd($datos);
            return view('welcome')->with('data',$datos);

        }
        public function contactoview () {
            return view('contacto');
        }
        public function addcontacto () {

        }
        public function cambiar_collection(Request $request){
            $collection=$this->getcollection_categoria($request->id);
            echo json_encode($collection);
        }
        public function getcollection_categoria($id){
            $categorias=CategoriasModel::from('categorias as c')
            ->select('c.ids','name','img')
            ->where('c.ids',$id)->get();

             $categorias[0]->items= Productos::get_productos_de_categoria($categorias[0]->ids);
            return $categorias;
        }
        private function set_datos_welcome($limit,$limitcat,$limithistory,$ismobil){
/* 
                    ++CONSULTA PARA TRAER TODOS LOS PRODUCTOS CON SU WISLIST DEL USUARIO++
                    SELECT productos.id,productos.name,imgs.src AS img,productos.precio,( SELECT id_producto FROM wishlist WHERE id_producto= productos.`id` AND id_usuario='1') AS wish FROM productos 
                    LEFT JOIN imgs ON productos.`id`=imgs.`id_producto`
                    WHERE productos.id_usuario !='1'
                    GROUP BY productos.`id`
                */

            $id=auth()->id();
            $datos=[];
            $pro=[];
            $historial=[];

            if($id){
                  $historial =Productos::from('historial')->select('p.id as ids','p.name','imgs.src as img','p.precio','p.stock')
                      ->Join('productos as p', 'historial.id_producto', '=','p.id' ,'left')
                      ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                      ->where('historial.id_usuario','=',$id)
                      ->orderBy('historial.created_at', 'desc')
                      ->limit($limithistory)
                      ->get();
            }else{
                $historial = false;
            }
         
          // $promos=$this->getpromociones();
            // $datos=[];
          
                // MNL6841
                  $pro=$this->get_productos_categoria('MNL7890',$ismobil,12);
                  $categoriaspopulares=Productos::getcategoriaspopular($limitcat);
                  $collection=Productos::getcollection_categoria('MNL6841');
                  $productos_nuevos=Productos::getproductos_nuevos();
                  $pro_nuevo=(isset($productos_nuevos[0]))?json_encode($productos_nuevos):'false';
                  $pro_2=$this->get_productos_categoria('MNL8293',$ismobil,12);
                  $pro_3=$this->get_productos_categoria('MNL5278',$ismobil,12);

                $datos=array(
                 'productos'=>json_encode(array($pro,$pro_2,$pro_3)),
                 'historial'=>json_encode($historial),
                 'pronuevos'=>$pro_nuevo,
                 'categorias'=>json_encode($categoriaspopulares),
                 'collection'=>json_encode($collection)
                );
          
            // dd($collection);
        return $datos;
    
    }
    
    public function get_productos_categoria($id=NULL,$mobil=false,$limit=8,$chunck=true){
            $categoria=[];

            if($id!=NULL){
                $categoria=CategoriasModel::from('categorias as c')
                ->select('c.ids','c.name')
                ->where('c.ids',$id)
                ->where('c.status','=','1')
                ->get()[0];
            }else{
                $categoria=CategoriasModel::from('categorias as c')
                ->select('c.ids','c.name')
                ->inRandomOrder()
                ->where('c.status','=','1')
                ->where('c.nivel','=','1')
                ->first();
            }

         // descomentar esta linea dinamico
         // $res= Productos::get_productos_de_categoria($categorias[0]->ids,true);
         $res= Productos::get_productos_de_categoria($categoria->ids,$mobil,$limit);
         // return $res;

         if($chunck){
            $res=array_chunk($res->toArray(),4);
         }

        return array('categoria'=>$categoria,'items'=>$res);
    }

    public function ProductosNuevos(){        
            
            // $id=auth()->id();
            $fecha_actual = date("Y-m-d");
            $nuevafecha = strtotime ( "-5 day" , strtotime ( $fecha_actual ));
            $nuevafecha =date ( "Y-m-j" , $nuevafecha );
            $fechahoy=strtotime ( "-1 day" , strtotime ( $fecha_actual ));
            $fechahoy=date ( "Y-m-j" , $fechahoy );
            $productos_nuevos=[];
        // dd(array('fecha_actual' => $fecha_actual, 'nuevafecha'=> $nuevafecha, 'fechahoy' =>$fechahoy));
            // if($id){
            //    $productos_nuevos= Productos::select('id as id_producto','name','imgs.src as img','precio', 'stock')
            //     ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            //     ->whereBetween('productos.created_at', array($nuevafecha,$fechahoy))
            //     ->where('id_usuario','!=',$id)
            //     ->orderBy('productos.created_at', 'desc')
            //     ->where('status','=',1)
            //     ->limit(24)
            //     ->get();
            // }else{
                $productos_nuevos = Productos::select('id as ids','name','imgs.src as img','precio', 'stock')
                    ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
                    ->whereBetween('productos.created_at', array($nuevafecha,$fechahoy))
                    ->where('status','=',1)
                   ->orderBy('productos.created_at', 'desc')
                    ->limit(24)
                    ->get();
            // }

                    // dd($productos_nuevos);
          return response()->json(array('data'=>$productos_nuevos));

    }
    public function HistorialProductos(){
            
            $id=auth()->id();
            // $id='42';
          $historial =Productos::from('historial')
          ->select('p.id as ids','p.name','imgs.src as img','p.precio', 'p.stock')
                      ->Join('productos as p', 'historial.id_producto', '=','p.id' ,'left')
                      ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                      ->where('historial.id_usuario','=',$id)
                      ->orderBy('historial.created_at', 'desc')
                      ->limit(20)
                      ->get();
        return response()->json(array('data'=>$historial));
    }
}
