@extends('layouts.app')
@section('content')
	@if(isset($wish[0]))
	<wishview :data="{{$wish}}"></wishview>		
	@else
	   	<div id="wempti">
			<h1>¡No Tienes Productos!</h1>
			<b-button href="{{ url('/')}}" variant="link">Agregar Producto a tu Lista</b-button>
		</div>
	@endif        	
@endsection

<style>
	#wempti{
	 height: 77%;
	text-align: center;
	display: inline-block;
	margin-top: 20px;
	width: 100%;
}
</style>