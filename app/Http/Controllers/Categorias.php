<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasModel;
use App\Models\Productos;
use Illuminate\Http\JsonResponse;
class Categorias extends Controller
{
    protected $concat;
    protected $debug;
public $categorias = [
        'todas' => [
            1 => ['ids'=>1,'nombre' => 'Categoría 1', 'parent_id' => 0],
            2 => ['ids'=>2, 'nombre' => 'Subcategoría 1', 'parent_id' => 1],
            3 => ['ids'=>3, 'nombre' => 'Categoría 2', 'parent_id' => 0],
            4 => ['ids'=>4, 'nombre' => 'Subcategoría 2', 'parent_id' => 3],
            5 => ['ids'=>5, 'nombre' => 'Subsubcategoría 1', 'parent_id' => 4]
        ],
        0 => [1, 3], // Categorías principales
        1 => [2],    // Subcategorías de "Categoría 1"
        3 => [4],    // Subcategorías de "Categoría 2"
        4 => [5]     // Subcategorías de "Subcategoría 2"
        ];



public $categoria;

    public function buscar_producto_descripcion($q){
        
            $res = CategoriasModel::buscar_descripcion($q);
            return view('categorias/buscar_producto')->with('result',$res);         
}
    public function getDebug() {
        return $this->debug;
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
    public function AllCategorias(){

        $categorias=CategoriasModel::select('*')
        ->where('status',1)
        ->where('ids','!=','0')
        ->get();
        $categorias_total=[];
        $subcategorias =[];
        foreach ($categorias as $key => $categoriaid) {
            if($categoriaid->nivel == 1){
                foreach ($categorias as $k => $categoria) { 
                    if($categoria->parent_id == $categoriaid->ids ){
                        $subcategorias[] = $categoria;
                    }
                } 
                $Categorias_total[]=
                array(
                    'name'=>$categoriaid->name,
                    'id'=>$categoriaid->ids,
                    'items'=>$subcategorias
                );
                $subcategorias = [];
            }
        }

       return view('categorias/all_categorias')->with('categorias',json_encode($Categorias_total)); 
    }

    protected function generatePassword($length)
    {
        $key = "";
        $pattern = "1234567890";
        $max = strlen($pattern)-1;
        for($i = 0; $i < $length; $i++){
            $key .= substr($pattern, mt_rand(0,$max), 1);
        }
        return $key;
    }

    public function getcategorias(){
        // $categorias = CategoriasModel::getcategoriasmenu();
        // $cat = $this->getSelectCategorias();
        // echo json_encode($cat);
        

        //  $categorias=CategoriasModel::select('*')
        // ->where('status',1)
        // ->where('ids','!=','0')
        // ->get();
        // $categorias_total=[];
        // $subcategorias =[];
        // foreach ($categorias as $key => $categoriaid) {
        //     if($categoriaid->nivel == 1){
        //         foreach ($categorias as $k => $categoria) { 
        //             if($categoria->parent_id == $categoriaid->ids ){
        //                 $subcategorias[] = $categoria;
        //             }
        //         } 
        //         $Categorias_total[]=
        //         array(
        //             'name'=>$categoriaid->name,
        //             'id'=>$categoriaid->ids,
        //             'items'=>$subcategorias
        //         );
        //         $subcategorias = [];
        //     }
        // }
        //  return response()->json($Categorias_total);

        // $this->sendSMS('+524434126238',
            // 'Su Codigo de verificacion para Supercitomx es: 123456');
        echo $this->generatePassword(6);
    }
    public function logMsg($msg) {
        if ($this->getDebug()===true){
            echo(date(DATE_RFC2822)." : ".$msg."</br>");
            error_log("\n".date(DATE_RFC2822)." : ".$msg."\r\n", 3, "app.log");
        }
    }

    public function sendSMS($destination, $message) {

        $return=false;
        $timeout=60;
        $url = 'https://www.altiria.net:8443/api/http';
        $password = 'hyec3caf';
        $login = 'lakess00511@gmail.com';
        $apikey='vkazel3rMA';
        $senderId='';
        $Apisecret ='ctf4ut5ygr';
       
        // Set the curl parameters.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded; charset=UTF-8'));
        curl_setopt($ch, CURLOPT_HEADER, false);
        
        // Max timeout in seconds to complete http request  
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        $COMANDO='';
        if (!isset($apikey) || empty($apikey)) {
           $COMANDO='cmd=sendsms&login='.$login.'&passwd='.$password;
        }else{
           $COMANDO='cmd=sendsms&apikey='.$apikey.'&apisecret='.$Apisecret;
        }
        $COMANDO.='&msg='.urlencode($message);

        //Como destinatarios se admite un array de teléfonos, una cadena de teléfonos separados por comas o un único teléfono
        if (is_array($destination)){
            foreach ($destination as $telefono) {
                $this->logMsg("Add destination ".$telefono);
                $COMANDO.='&dest='.$telefono;
            }
        }else{
            if( strpos($destination, ',') !== false ){
                $destinationTmp= '&dest='.str_replace(',','&dest=',$destination).'&';
                $COMANDO .=$destinationTmp;
                $this->logMsg("Add destination ".$destinationTmp);
             }else{
                $COMANDO.='&dest='.$destination;
             }
        }

        //No es posible utilizar el remitente en América pero sí en España y Europa
        if (!isset($senderId) || empty($senderId)) {
            $this->logMsg("NO senderId ");
        }else{              
            $COMANDO.='&senderId='.$senderId;
            $this->logMsg("Add senderId ".$senderId);
        }

        //Concat. Valores posibles true. Si no se especifica o es false, no se envía
        $concat='';
        if (!isset($concat) || empty($concat) || $concat===false) {
            $this->logMsg("NO concat ");
        }else{              
            $COMANDO.='&concat=true';
            $this->logMsg("Add concat true");
        }

        //No es posible utilizar el remitente en América pero sí en España y Europa
        $encoding='';
        if (!isset($encoding) || empty($encoding)) {
            $this->logMsg("NO encoding");
        }else{
            if ($encoding==='unicode'){
                $COMANDO.='&encoding='.$encoding;
                $this->logMsg("Add encoding ".$encoding);               
            }else{
                $this->logMsg("Ignoring encoding. Encoding has no allowed value: ".$encoding);              
            }
        }

        // Set the request as a POST FIELD for curl.
        curl_setopt($ch, CURLOPT_POSTFIELDS, $COMANDO);

        // Get response from the server.
        $httpResponse = curl_exec($ch);
        if(curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200){
            $this->logMsg("Server Altiria response: ".$httpResponse);
            if (strstr($httpResponse,"ERROR errNum")){
                $this->logMsg("Error sending SMS: ".$httpResponse);
                return false;
            }else
                $return = $httpResponse;
        }else{
            $this->logMsg("Error sending SMS: ".curl_error($ch).'('.curl_errno($ch).')'.$httpResponse);
            $return = false;
        }
        curl_close($ch);
        return $return;
    }

    public function optionsCategorias($padre, $nivel) {
        // Inicializar salida
        $ret = '';
        // Crear prefijo para indentar subcategorías
        $prefijo = ($nivel == 0) ? '' : str_pad('', $nivel, '-') . ' ';
        // Recorrer categorías en el padre para mostrar
        // dd($this->categorias[$key]);

        foreach($this->categorias[$key] as $key1 =>  $id) {
            // Generar option
              $ret .= "<pre>$prefijo{$this->categorias[$id]['name']}</pre>";
            // ¿La categoría tiene hijos?
            // ¿La categoría tiene hijos?
            if(isset($this->categorias[$id])) {
                // Agregar opciones para cada hijo
                $ret .= $this->optionsCategorias($id, $nivel + 1);
            }
        }
        return $ret;
    }

    public function getSelectCategorias() {
        // Inicializar arreglo
        // Para evitar inconsistencias, deberías definir la propiedad en la clase
        // $arrData = CategoriasModel::select('*')
        // ->where('ids','!=','0')     
        // ->get();
        // echo '<pre>';
        // print_r($arrData);
        // echo '</pre>';
        
        $this->categoria = ['todas' => []];

        $this->categorias = $arrData;
        // Recorrer para armar arreglo
            foreach($arrData as $key => $cat) {
                  // dd($cat);
                // Insertar arreglo en "todas" con ID como índice
                $this->categoria['todas'][$cat['ids']] = $cat;
                // Forzar a que sea entero
                $padre = $cat['parent_id'];
                // Verificar que existe el arreglo de hijos
                if(!isset($this->categorias[$padre])) {
                    $this->categoria[$padre] = [];
                }
                // Agregar como hijo
                $this->categoria[$padre][] = $cat['ids'];
            
            echo $this->optionsCategorias($cat['ids'],0,$key);
            
            }
        // Iniciar con categorías principales
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
             $response=array(
                'productos'=>false,
            );
            return view('categorias/producto_por_categoria')->with('response',$response);
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
            
        return Productos::from('productos as p')->selectRaw('p.id as ids,p.name,p.precio,imgs.src as img,p.stock')
        ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
        ->where('p.status','=','1')
        ->whereIn("p.id_categoria",$categorys)
        ->orderBy('p.name', 'asc')
        ->get();

        }else{

            return Productos::from('productos as p')->select('p.id as ids','p.name','p.precio','imgs.src as img','p.stock')
            ->Join('imgs', 'p.id', '=','imgs.id_producto' ,'left')
            ->where('p.id_categoria',$id)
            ->where('p.status','=','1')
            ->orderBy('p.name', 'asc')
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
