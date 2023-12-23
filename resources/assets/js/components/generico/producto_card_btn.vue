<template>
	<div :class="['thumb-wrapper', (showbtn) ? 'sombra' : '']" @mouseover="showbtn=true"  @mouseleave="showbtn=false">

		<wishlist :idproducto="id" :logeado="logeado"></wishlist>
		<div class="img-box">
          <a-img :to="id" :src="img" :name="name"></a-img>
		</div>
			<hr>
		<div class="thumb-content">
			<p v-if="logeado" style="font-size:16px;"><!-- <strike>${{slider.descuento}}</strike> --> <b>${{precio}}</b></p>
			<div style="height: 40px;">
			<span style="font-size: 14px;">{{name}}</span>                 
			</div>
			<!--
				<div class="star-rating">
					<ul class="list-inline">
					<template v-for="star in 5">
					<li class="list-inline-item"><i class="fa fa-star"></i></li>
					< <li class="list-inline-item" v-if="star==1"><i class="fa fa-star"></i></li> 
					 <li class="list-inline-item" v-else><i class="fa fa-star-o"></i></li> 
					</template>
					</ul>
				</div>
			-->
		
			<p class="item-price" v-if="logeado"> <!-- <strike>$400.00</strike>--><b>${{precio}}</b></p>
        <p v-else><a :href="ruta+'item/'+id+'-'+name">Ver Precio...</a></p>
  
        <!-- <btn-addcarrito  :logeado="logeado" :id="id"> </btn-addcarrito>  -->
         <div v-if=" parseFloat(stock) !== 0 ">
          	<btn-addcarrito  :logeado="logeado" :id="id" small="true" :style="{display:(showbtn)?'block':'none'}" :block="false"> </btn-addcarrito>
          </div>
          <div v-else>
            <b-alert show variant="danger">Agotado</b-alert>
          </div>
		</div>            
	</div>
</template>
<script type="text/javascript">
	export default {
		data(){
			return{
				showbtn:false,
				ruta: url
			}
		},
		props: {
	    		name: {type: String},
	    		id: {type: String},
	    		precio: {type: String},
	    		img: {type: String},
	    		raiting: {type:String},
	    		stock: {type:String},
	    		logeado: {type:Boolean,default:false}
  		}
	}
</script>
<style type="text/css">
	
	.img-width{
	  max-width: 100%;
	  height: 175px;
	}
	
	.sombra{
		  box-shadow: 0 1px 2px rgba(0,0,0,0.15) !important;
  transition: box-shadow 0.3s ease-in-out !important;
	}

.sombra:hover {
  box-shadow: 0 5px 15px rgba(0,0,0,0.3) !important;
}
</style>



