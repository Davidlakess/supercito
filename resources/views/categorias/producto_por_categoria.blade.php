@extends('layouts.app')

@section('content')
   @if ($response['productos'])
   <div style="display: flex;">   
                 <productocategoria 
                :productos="{{$response['productos']}}" 
                :categorias="{{$response['categorias']}}" 
                :nav="{{$response['nav']}}" 
                query="{{$response['query']}}"
                :logeado="{{(Auth::guest()== 1) ? 'false' : 'true'}}" 
                ></productocategoria>
   </div>
        @else
         
          <div>Producto no encontrado</div>
         
        @endif  

@endsection
<style>
  .items-search:after{

  content: "-";
  padding: 0 8px;
}
  
.poner-borde{
  border-bottom: thin solid #eee;
  margin-bottom: 15px;
  padding-bottom: 10px;
}
.lista-breadcum{
    padding: 0 ;
margin-bottom: 10px;
  }
.items-categoria{
  list-style: none;
margin: 0 0 6px;

/*
font-size: 14px;
font-weight: 300;
color: #999;
*/
font-weight: 400;
font-size: 14px;
/*margin-left: 0;*/
white-space: nowrap;
}

.items-categoria a{
  color: #666 !important;
  text-decoration: none !important;
}


  .titulo-breadcrumb{
    color: #333;
    display: block;
    font-size: 26px;
    font-weight: 600;
    line-height: 30px;
    padding-right: 16px;
    position: relative;
    word-wrap: break-word;
    z-index: 1;
  }



 .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 160px;
    text-align: center; 
    margin-top: 15px;
    left: 25;
  }
  
  .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }
      

/*producto solo*/
.thumb-wrapper {
  padding: 25px 15px;
  background: #fff;
  border-radius: 6px;
  text-align: center;
  position: relative;
  box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
 /*

 .item .img-box {
  height: 120px;
  margin-bottom: 20px;
  width: 100%;
  position: relative;
}

 .item img { 
  max-width: 100%;
  max-height: 100%;
  display: inline-block;
  position: absolute;
  bottom: 0;
  margin: 0 auto;
  left: 0;
  right: 0;
}

*/
 
</style>