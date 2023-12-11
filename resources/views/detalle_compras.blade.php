@extends('layouts.app')

@section('content')
<!-- class="mc-content" -->
	
	<detalle-compra 
	:detalle="{{$detalles['detalle']}}" 
	:venta="{{$detalles['venta']}}"
	
	></detalle-compra>

@endsection









