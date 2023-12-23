@extends('layouts.app')

@section('content')
  @if($compras['ventas'])  
    <compras :compras="{{$compras['ventas']}}" :domicilio="{{$compras['domicilio']}}"></compras>
   @else
    <div class="empti">
      <h1>¡Aun no tienes Compras!</h1>
      <b-button href="{{ url('/')}}" variant="link">Ver Productos</b-button>
    </div>
  @endif
@endsection             