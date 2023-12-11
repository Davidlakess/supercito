@extends('layouts.app')

@section('content')
  @if($compras['ventas'])  
    <compras :compras="{{$compras['ventas']}}" :domicilio="{{$compras['domicilio']}}"></compras>
   @else
<b-container   fluid>
    <div id="empti">
      <h1>¡Aun no tienes Compras!</h1>
      <b-button href="{{ url('/')}}" variant="link">Ver Productos</b-button>
    </div>
  </b-container>
  @endif
@endsection
<style>
#foot1 {
    position: absolute !important;
}
#empti{
/*   height: 67%;*/
  text-align: center;
  display: inline-block;
  margin-top: 20px;
  width: 100%;
}
</style>
              