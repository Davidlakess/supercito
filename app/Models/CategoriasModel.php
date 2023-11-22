<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class CategoriasModel extends Model
{
    use HasFactory;
    protected $table = "categorias";
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
}
