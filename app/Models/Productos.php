<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoriasModel;
use Illuminate\Support\Facades\DB;
class Productos extends Model
{
    use HasFactory;

    public static function historial($id){

        $result = DB::from("historial as c")->select('p.id as ids','p.name','imgs.src as img','p.precio')
          ->Join('productos as p', 'historial.id_producto', '=','p.id' ,'left')
          ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
          ->where('historial.id_usuario','=',$id)
          ->orderBy('historial.created_at', 'desc')
          ->limit($limit)
          ->get();

        return $result;
    }
    public static function get_productodetalle($id){
            $id_user=auth()->id();

            return Productos::from('productos as p')->select(DB::raw('p.id as ids,p.name,p.descripcion AS des,p.precio,p.stock,p.id_categoria AS id_c ,GROUP_CONCAT(imgs.src SEPARATOR ",") AS imgs,( SELECT w.id_producto FROM wishlist as w WHERE w.id_producto= p.id AND w.id_usuario='.$id_user.') AS wish'))
                ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
              ->where('p.id','=',$id)
              ->where('p.status','=',1)
              ->groupBy('p.id')->get();
               
    }
    public static function getcollection_categoria($id){
            $categorias=CategoriasModel::from('categorias as c')
            ->select('c.ids','name','img')
            ->where('c.ids',$id)->get();

         $categorias[0]->items= Productos::get_productos_de_categoria($categorias[0]->ids);
            // return Productos::get_productos_de_categoria($categorias[0]->ids);

        return $categorias;
    }
    public static function getcategoriaspopular($limit){
        return $categorias=CategoriasModel::from('categorias as c')
            ->select('c.ids','c.name')
            ->where('c.nivel','3')
            ->inRandomOrder()->limit($limit)->get();
    }
    public static function get_productos_de_categoria($id,$mobi=false,$limit=8){

        $catego=CategoriasModel::from("categorias as c")
              ->select(DB::raw('c.ids AS padre, GROUP_CONCAT(hijos.ids SEPARATOR ",") AS hijos'))
              ->Join('categorias as hijos', 'c.ids', '=','hijos.parent_id' ,'left')
              ->where('c.parent_id',$id)
              ->groupBy('c.ids')
              ->get();



             $pro=[];
             $ids='';   
             if(isset($catego[0])){

                $cadena='';
                foreach ($catego as $key => $cat) {
                    if($key==count($catego)-1){
                        $cadena.=$cat->padre;
                    }else if($cat->padre!=''){
                        $cadena.=$cat->padre.',';
                    }
                    $str=explode(',', $cat->hijos);

                    foreach ($str as $key => $hijo) {
                        if($hijo!=null){
                            $cadena.=$hijo.',';
                        }
                    }



                }
             $ids=explode(',', $cadena);
        // $ids=$cadena;
            }else{

                $ids=$id;
            }

            // return $ids;
            if($mobi){

            $pro=Productos::from('productos as p')
            ->select('p.id as ids','imgs.src as img','p.name','p.precio')
            ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
            ->whereIn('p.id_categoria',$ids)
            ->inRandomOrder()->where('status','=',1)->limit($limit)->get();
            
            }else{

                if(isset($catego[0])){      
                    $pro=Productos::from('productos as p')
                    ->select('p.id as ids','imgs.src as img','p.name','p.precio')
                    ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                    ->whereIn('p.id_categoria',$ids)
                    ->inRandomOrder()->where('status','=',1)->limit($limit)->get();
                }else{

                    $pro=Productos::from('productos as p')
                    ->select('p.id as ids','imgs.src as img','p.name','p.precio')
                    ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                    ->where('p.id_categoria',$ids)
                    ->inRandomOrder()->where('status','=',1)->limit($limit)->get();
                }
            }

        return $pro;

    }
    public static function get_parents_category($id){
            $parents=[];            
            $i=0;       
            $id_c=$id;
            while(true){
                $parent_categori="";
                $parent=CategoriasModel::from("categorias as c")
                    ->select(DB::raw("(SELECT CONCAT(categorias.ids,'-',categorias.name,'-',c.name,'-',c.ids) FROM categorias  WHERE categorias.ids=c.parent_id and categorias.ids !='0')AS parent"))
                    ->where('c.ids','=',$id_c)
                    ->get();
                if(!isset($parent[0])){
                    return false;
                    break;
                }else if($parent[0]->parent==NULL){
                    break;
                }else{

                    $parent_categori=explode('-',$parent[0]->parent);   
                    $id_c=$parent_categori[0];
                    if($i==0){
                        
                        $parents['items'][$i]=array(
                                'id'=>$parent_categori[3],
                                'name'=>$parent_categori[2]
                        );
                        $i++;
                    }

                    $parents['items'][$i]=array(
                            'id'=>$parent_categori[0],
                            'name'=>$parent_categori[1]
                );             
            }   
                    $i++;   
        }
        if(isset($parents['items'])){
                return array_reverse($parents['items']);
        }else{
            return $parents;
        }               
    }
    public static function getproducto($IdProducto){

            return Productos::from('productos as p')->select(DB::raw('p.id as ids,p.name,p.descripcion AS des,p.precio,p.stock,p.id_categoria AS id_c ,GROUP_CONCAT(imgs.src SEPARATOR ",") AS imgs,0 as wish'))
            ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
            ->where('p.id','=',$IdProducto)
            ->groupBy('p.id')
            ->first();
    }
     //Obtiene las caracteristicas del productos(marca,tipo venta)
    public static function getcaracteristicas($IdProducto){
        return Productos::from('atributos_producto as atp')
          ->select(DB::raw('att.name AS clave,atp.valor,att.unidades'))
          ->Join('atributos_categoria as atc', 'atp.id_atributo', '=','atc.id' ,'left')
          ->Join('atributos as att', 'atc.id_atributo', '=','att.id_atributo' ,'left')
          ->where('atp.id_producto','=',$IdProducto)->get();    
    }
    // Obtienes otros productos de la misma categoria del producto id
    public static function getextras($IdProducto, $IdCatergoria){
          return Productos::select(
            'id as ids','name','src as img' ,'precio','id_categoria')
            ->Join('imgs', 'id', '=','id_producto' ,'left')
            ->where('id','!=',$IdProducto)
            ->where('id_categoria','=',$IdCatergoria)
            ->inRandomOrder()->limit(20)->get();
      
    } 
public static function getproductos_nuevos(){
       
        $fecha_actual = date("Y-m-d");
        $nuevafecha = strtotime ( "-10 day" , strtotime ( $fecha_actual ));
        $nuevafecha =date ( "Y-m-j" , $nuevafecha );
        $fechahoy=strtotime ( "+1 day" , strtotime ( $fecha_actual ));
        $fechahoy=date ( "Y-m-j" , $fechahoy );
        $productos_nuevos=null;


        $productos_nuevos= Productos::select('id as id_producto','name','imgs.src as img','precio')
          ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
          ->whereBetween('productos.created_at', array($nuevafecha,$fechahoy))
          ->where('status','=',1)
           ->orderBy('productos.created_at', 'desc')
            ->limit(24)
            ->get();
      
        return $productos_nuevos;
    }

    public static function addhistorial($id_producto, $id_usuario){
        $producto_id = Productos::from('historial')->select('id_producto')
        ->where('id_producto','=',$id_producto)->get();
        if(!isset($producto_id[0])){
            DB::insert('insert into historial (id_producto, id_usuario ) values (?, ?)', [$id_producto, $id_usuario]);
        }
    }
    public static function buscar_producto($str){
       
       // return Productos::select('productos.precio','productos.name','productos.id as id_producto','imgs.src as img','productos.id_categoria')
       // ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
       // ->where('productos.name', 'LIKE', "%{$str}%") 
       // ->orWhere('productos.descripcion', 'LIKE', "%{$str}%") 
       // ->where('productos.status','=',1)
       // ->orderBy('productos.name', 'desc')
       // ->limit(50)
       // ->get();

       $slq ="select precio,name,id as id_producto,src as img,id_categoria, match (name,descripcion) against (?  IN BOOLEAN MODE) as relevancia from productos left join imgs on productos.id=imgs.id_producto  where match( name,descripcion) against (?  IN BOOLEAN MODE) and status=? order by relevancia desc  limit ?";
           
        return  DB::select($slq, array($str, $str,1,'30'));    
    
    }  
}
