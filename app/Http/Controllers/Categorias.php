<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use App\Models\Productos;
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
    public function producto_por_categoria($categoria,$id){
        
        $categoria_format=str_replace("-", " ",$categoria);     
        
        $categorias = CategoriasModel::from('categorias as c')->select('c.name','c.ids','c.ids as padre')
        ->where('c.parent_id','=',$id)->get();

        $childs=$this->getchildcategory($categorias);                   
        // $count_pro_category=$this->get_count_all_producto_per_category($categorias);         
        $productos=$this->get_productos_de_categoria($childs,$id);


        if(isset($productos[0])){

            $nav=$this->get_breadcrumb($categoria_format,$id);
        
            $response=array(
                'productos'=>json_encode($productos),
                'categorias'=>$categorias,
                'query'=>$categoria_format,
                'nav'=>json_encode($nav)
            );

        return view('categorias/producto_por_categoria')->with('response',$response);   

        }else{

            return view('generico/error_view');
        
        }
    }

    public function getchildcategory($categorias){

        $category=[];
        $categoryall=[];
        $indx=0;
        if(isset($categorias[0])){
            // echo "<pre>";
            for($i=0;$i<count($categorias);$i++){
                
                
                $category=$this->get_categorias_child($categorias[$i]->padre);
                    
                // print_r($category);
                if(isset($category[0])){

                    for($j=0;$j <count($category);$j++ ){
                    
                        if($category[$j]->hijos){
                                
                                $hijos=$this->ponercomillas($category[$j]->hijos);
                                
                                for($e=0;$e <count($hijos);$e++ ){

                                    $categoryall[$indx]=$hijos[$e];
                                    $indx++;
                                }

                        }else{
                        
                            $categoryall[$indx]="{$category[$j]->padre}";   
                             // $categoryall[$indx]=array('id'=>$category[$j]->padre,'name'=>$category[$j]->name);
                            $indx++;
                        }

                }
        
            }else{

                            $categoryall[$indx]="{$categorias[$i]->padre}"; 
                            // $categoryall[$indx]=array('id'=>$categorias[$i]->padre,'name'=>$categorias[$i]->name);   
                            $indx++;
                                            
            }
        }
                // echo "</pre>";
        }else{
            
            for($i=0;$i<count($categorias);$i++){

                $categoryall[$i]="{$categorias[$i]->padre}";
                // $categoryall[$i]=array('id'=>$categorias[$i]->padre,'name'=>$categorias[$i]->name);  
            }
            
        }
            // echo "<pre>";
            // print_r($categoryall);
        return $categoryall;
            // echo "</pre>";
}
public function get_categorias_child($id){
        return CategoriasModel::from('categorias as c')->selectRaw('c.ids as padre,c.name,GROUP_CONCAT(child.ids SEPARATOR ",") AS hijos ')
        ->Join('categorias as child', 'c.ids', '=','child.parent_id' ,'left')
        ->where('c.parent_id','=',$id)
        ->groupBy('c.ids')
        ->get();
}
public function get_productos_de_categoria($categorys,$id){

    if(isset($categorys[0])){
            
        return Productos::from('productos as p')->selectRaw('p.id as ids,p.name,p.precio,imgs.src as img')
        ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
        ->where('p.status','=','1')
        ->whereIn("p.id_categoria",$categorys)
        ->orderBy('p.name', 'desc')
        ->get();

        }else{

            return Productos::from('productos as p')->select('p.id as ids','p.name','p.precio','imgs.src as img')
            ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
            ->where('p.id_categoria',$id)
            ->where('p.status','=','1')
            ->orderBy('p.name', 'desc')
            ->get();        
    }
}
public function get_breadcrumb($categoria,$id){

        $breadcumb=Productos::get_parents_category($id);        
        return $breadcumb;
}
public function ponercomillas($str){

     $datos=explode(',',$str);

    $aux=[];
    $size=sizeof($datos);

    for($i=0 ;$i<$size;$i++){
            
        $aux[$i]="{$datos[$i]}";
        // $dato=explode('-',$datos[$i]);
        // $aux[$i]=array('id'=>$dato[0],'name'=>$dato[1]); 
        
    }

    return $aux;
}

}
