<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\imgs;
use App\Models\Productos;
use Image;
class StorageController extends Controller
{
    public function save(Request $request)
    { 

      // if($request->hasFile('file')) {
      //   $manager = new ImageManager(new Driver());

          $foto = $request->file('file'); 
          $imagen=Image::make($foto); 
          $ancho=$imagen->width();
          $alto=$imagen->height();

        if($ancho >= 500 || $alto >= 500 ){
            $prefix=time();
            $imagenName= $foto->getClientOriginalName();
            $prefijo = 'SMX';
            $filename = pathinfo($imagenName, PATHINFO_FILENAME);
            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();
            
            $principal = $prefijo.'_'.$prefix.'.'.$extension;
            
            $normal = $prefijo.'_'.$prefix.'-N.'.$extension;
            
            $thumbnail = $prefijo.'_'.$prefix.'-R.'.$extension;
            
            $bigthumbnail = $prefijo.'_'.$prefix.'-B.'.$extension;

            $bigthumbnailpath ='thumbnail/'.$bigthumbnail;
            $normalpath ='thumbnail/'.$normal;
           
           if($ancho <= 1200 || $alto <= 1200 ){
              $this->createbigThumbnail($imagen,$bigthumbnailpath, $ancho, $alto);
           }else{

              $this->createbigThumbnail($imagen,$bigthumbnailpath,1200,1200);
           }

           $this->createThumbnail($imagen,$normalpath,500,500);
           $this->createThumbnail($imagen,$principal,224,224);
          
            $img=new imgs();
            $img->src=$principal;
            $img->save();
            $id_img =$img->id;
            echo json_encode(array('error'=>false,'img'=>$principal,'id'=>$id_img));
            $thumbnailpath ='thumbnail/'.$thumbnail;
            $this->createThumbnail($imagen,$thumbnailpath,70,70);
        }else{
         
          echo "{error:'Verifica que la imagen tenga como minimo 500px en uno de los lados, es recomendable una imagen de 1200x1200 para poder hacer zoom',img:''}";

        }

      }
    
    public function createbigThumbnail($img,$path,$width,$height)
    {
      $img->resize($width, $height, function ($constraint) {
          $constraint->aspectRatio();
          // $constraint->upsize();
      });
      $img->encode('jpg',75);
      \Storage::disk('uploads')->put($path,$img->stream());  
    }
    public function createThumbnail($img,$path, $width, $height)
    {
          $img->resize($width, $height, function ($constraint) {
              $constraint->aspectRatio();
          });
          $img->encode('jpg',75);
          \Storage::disk('uploads')->put($path,$img->stream());  
    }
}
