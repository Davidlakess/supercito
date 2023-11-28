@extends('layouts.app')
@section('content')
	@if ($result['productos'])
<div style="background: #ebebeb">
	      
  @if (Auth::guest())
        <buscar-producto :productos="{{$result['productos']}}" 
          :categorias="{{$result['categorias']}}"
          query="{{$result['q'] }}"    :prodm="{{$result['prodmiscate']}}" 
        :prodo="{{$result['prodotracate']}}" 
        :logeado="false"
        ></buscar-producto>

        @else
          <buscar-producto :productos="{{$result['productos']}}" 
            :categorias="{{$result['categorias']}}"
            query="{{$result['q'] }}"    :prodm="{{$result['prodmiscate']}}" 
            :prodo="{{$result['prodotracate']}}" 
            :logeado="true"
        ></buscar-producto>
        @endif     

</div>
          @else
		        <message-error-busqueda></message-error-busqueda>
          @endif        
@endsection
<style>
   .thumb-wrapper {
  padding: 25px 15px;
  background: #fff;
  border-radius: 6px;
  text-align: center;
  position: relative;
  box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
 
 .item-titulo{
    color: #333;
    font-size: 16px;
    font-weight: 300;
    line-height: 1.29;
    margin-bottom: 10px;
    margin-top: 10px;
    height: 40px;
  }
 .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 220px;
    text-align: center; }
  .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }
      

 .item h4 {
  font-size: 18px;
}
 .item h4,  .item p,  .item ul {
  margin-bottom: 5px;
}
 .thumb-content .btn {
  color: #7ac400;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: bold;
    background: none;
    border: 1px solid #7ac400;
    padding: 6px 14px;
    margin-top: 5px;
    line-height: 16px;
    border-radius: 20px;
}
 .thumb-content .btn:hover,  .thumb-content .btn:focus {
  color: #fff;
  background: #7ac400;
  box-shadow: none;
}
 .thumb-content .btn i {
  font-size: 14px;
    font-weight: bold;
    margin-left: 5px;
}

 .item-price {
  font-size: 20px;
  padding: 2px 0;
}
 .item-price strike {
  opacity: 0.7;
  margin-right: 5px;
}


 .wish-icon {
  position: absolute;
  right: 10px;
  top: 10px;
  z-index: 99;
  cursor: pointer;
  font-size: 16px;
  color: #abb0b8;
}
 .wish-icon .fa-heart {
  color: #ff6161;
}
.star-rating li {
  padding: 0;
}
.star-rating i {
  font-size: 14px;
  color: #ffc000;
}
</style>