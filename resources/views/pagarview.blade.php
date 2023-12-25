@extends('layouts.app')
	@section('content')
 
<!-- 		<ckeckoutmobil
		:adress="{{$detalle['adress']}}"
		:items="{{$detalle['carrito']}}"
		:precioenvio="{{$detalle['envio']}}" 
		:propina="{{$detalle['propina']}}"
		:idcarrito="{{$detalle['id_carrito']}}" 
		>
		</ckeckoutmobil>
 -->
	<wiewpagar
	 :idcarrito="{{$detalle['id_carrito']}}" 
   :envio="{{$detalle['envio']}}" 
   :propina="{{$detalle['propina']}}" 
   :items="{{$detalle['carrito']}}"
   :adres="{{$detalle['adress']}}"
	></wiewpagar>

		@endsection		            
<style>

	body{
		background-color:#eee;
	}
	.mb-10{
		margin-bottom: 15px;
	}
	.tl-end{
		text-align:end;
	}
	.mt-22{
	margin-top: 22px;
	}
	div.white {
		background: #FFF;
		background-color: rgb(255, 255, 255);
		border-radius: 0.8em;
		-moz-border-radius: 0.8em;
		-webkit-border-radius: 0.8em;
		height: 111%;
		padding: 10px;
		font-size: 33px;
		text-align: center;
	}


	.card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden;
    margin-bottom: 10px; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100%;
    text-align: center; 
  }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

}

.card-item{
	margin-left: -37px;
	color: #898989;
	font-weight: 300;
	font-size: 14px;
}
.row{
 margin:0 !important;
}
</style