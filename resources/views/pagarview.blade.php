@extends('layouts.app')
	@section('content')
		<!-- <b-container style="min-width: 100%;padding-left:3%;padding-right: 3%;cursor: auto !important;" > -->
			<b-row align-h="center" >
				<b-col cols="12" lg="8" style="padding-top: 3%; padding-left: 32px;" >
					<b-row align-h="center" >
						<items-pagar :items="{{$detalle['carrito']}}"></items-pagar>
					</b-row>
				</b-col>

				<!-- DIVICION  -->
				<b-col cols="12" lg="4" style="margin-right: 0; padding-right: 0;">	
						  <resumen-compra 
						   issetdomicilio="1"
						   :precioenvio="{{$detalle['envio']}}" 
						   propina="{{$detalle['propina']}}"
						   :items="{{$detalle['carrito']}}"
						   :idcarrito="{{$detalle['id_carrito']}}" 
						   >
						   </resumen-compra>
				</b-col>
			</b-row>		
		<!-- </b-container> -->

		@endsection


		@if (sizeof($detalle['carrito']) > 1)
			<script>
				window.onscroll = function (){
			    // Obtenemos la posicion del scroll en pantall
			    var scroll = document.documentElement.scrollTop || document.body.scrollTop;
			    // Realizamos alguna accion cuando el scroll este entre la posicion 300 y 400
			    		var element = document.getElementById("resumencontent");
			    if(scroll > 63){
			  			
			    		element.className = element.className.replace(/\bstatic\b/g, "card-fix")
			    }else{
			  			element.className = element.className.replace(/\bcard-fix\b/g,"static");
			    }
			} 

			</script>			 
	    @endif            
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
@media only screen and (min-width: 1264px) {

	.static{

		position:absolute;
		height: 100vh !important;
/*		width: 103% !important;*/
		
	}
	.card-fix{
		height: 100vh !important;
/*		width: 30% !important;*/
		position: fixed !important;
		top: 0 !important;
	}
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
</style>




