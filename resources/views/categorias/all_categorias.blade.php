@extends('layouts.app')

@section('content')

	<b-container fluid md="12">
		<b-row align-h="center">
    	<b-col md="12">
    		<div class="title-raleway" style="margin-top: 10px; text-align: left;">
  				<span>Categorías para comprar</span>
  			</div>
    	</b-col>
<!-- 
    	<pre>
    		{{print_r($categorias)}}
    	</pre> -->
        <all-categorias :categorias="{{$categorias}}" ></all-categorias>

    </b-row>
	</b-container>

@endsection
