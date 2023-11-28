<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CategoriasModel extends Model
{
    use HasFactory;
    protected $table = "categorias";
public static function getcategoriasmenu(){
     // $categorias=CategoriasModel::
     //         selectRaw("categorias.name AS padre,GROUP_CONCAT(child.name,'-',child.ids SEPARATOR ',') AS hijos")
     //        ->Join('categorias as child', 'categorias.ids', '=','child.parent_id' ,'left')
     //        ->whereIn('categorias.ids',['MNL5523'])
     //        ->limit(4)->orderBy('child.name', 'asc')->get();
            return [];
    }

    public static function getallcategorias(){
        $categorias=CategoriasModel::select('name','ids')
        ->where('status',1)
        ->where('nivel',1)
        ->get();

        $categorias_total=[];

        foreach ($categorias as $key => $categoria) {

            $subcategorias=CategoriasModel::from('categorias as c')
            ->select('name','ids')
            ->where('parent_id',$categoria->ids)
            ->get();
            // ->where('nivel',2)

            $Categorias_total[$key]=
            array(
                'name'=>$categoria->name,
                'id'=>$categoria->ids,
                'items'=>$subcategorias
            );
        } 
        return $Categorias_total;
    }
    public static function get_productos_categoria($limit=150){
        
        $pro = productos::from('productos as p')
                ->select(
                    'p.id as ids',
                    'imgs.src as img',
                    'p.name','p.precio',
                    'p.stock'
                )
                ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                ->where('p.status', 1)
                ->where('p.stock','>=', 1)
                ->inRandomOrder()
                // ->orderBy('p.id_categoria', 'desc')
                ->limit($limit)->get();
        return  array ('data' => $pro);
    }
    public  static function getProductosdeCategoria($id,$limit){

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
            }else{

              $ids = $id;
            
            }

            if(isset($catego[0])){      
                $pro = productos::from('productos as p')
                ->select('p.id as ids','imgs.src as img','p.name','p.precio')
                ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                ->whereIn('p.id_categoria',$ids)
                ->inRandomOrder()->where('status','=',1)->limit($limit)->get();
            }else{

                $pro = productos::from('productos as p')
                ->select('p.id as ids','imgs.src as img','p.name','p.precio')
                ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
                ->where('p.id_categoria',$ids)
                ->inRandomOrder()->where('status','=',1)->limit($limit)->get();
            }
            

        return $pro;

    }
public  static function buscar_descripcion($q){
 $palabra=str_replace("+", " ", $q);
        $id_user=auth()->id();
        $sql="";
        if($id_user){
            $slq ="select precio,name,id as id_producto,src as img,id_categoria,( select w.id_producto from wishlist as w where w.id_producto= productos.id and w.id_usuario=?) AS wish , match (name,descripcion) against (?  IN BOOLEAN MODE) as relevancia from productos left join imgs on productos.id=imgs.id_producto  where match( name,descripcion) against (?  IN BOOLEAN MODE) and status=? order by relevancia desc  limit ?";
            $pro = DB::select($slq, array($id_user,$palabra, $palabra,1,'50'));
        }else{
            $slq ="select precio,name,id as id_producto,src as img,id_categoria, match (name,descripcion) against (?  IN BOOLEAN MODE) as relevancia from productos left join imgs on productos.id=imgs.id_producto  where match( name,descripcion) against (?  IN BOOLEAN MODE) and status=? order by relevancia desc  limit ?";
            $pro = DB::select($slq, array($palabra, $palabra,1,'50'));
        }
        
        if(isset($pro[0])){   
        $promisma = Productos::select('precio','name','id as id_producto','src as img')->where('id_categoria',$pro[0]->id_categoria)
            ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
              ->inRandomOrder()->where('status','=','1')->limit(12)->get();
        $prootra = Productos::select('precio','name','id as id_producto','src as img')->where('id_categoria','!=',$pro[0]->id_categoria)
            ->Join('imgs', 'productos.id', '=','imgs.id_producto' ,'left')
            ->inRandomOrder()->where('status','=','1')->limit(12)->get();
            // $child_categorias=$this->get_count_all_producto_per_category($categorias);
            $categorias=CategoriasModel::count_categoria_general_per_producto();
            
            return $res = array(
                'productos'=>json_encode($pro),
                'prodmiscate'=>json_encode( array_chunk( $promisma->toArray(),4)),
                'prodotracate'=>json_encode( array_chunk( $prootra->toArray(),4)),
                'categorias'=>json_encode($categorias),
                'q'=>$palabra
            );   

        }else{
            return array('productos'=>false);
        }
}

static private function count_categoria_general_per_producto(){
            return CategoriasModel::from('categorias as c')->select('c.name','c.ids')
                    ->where('c.parent_id','=','0')
                    ->get();
}
}
