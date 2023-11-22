<template>
		<b-col md="12">
			<div class="super-titulo"><span>Promociones..</span></div>
		  <v-carousel>
		    <template v-for="(item,indx) in promos">  
		    <v-carousel-slide :index="indx">
	          <div class="row">
	            <div class="col-sm-3"  v-for="slider in item">
	              <div class="thumb-wrapper">
	              	<wishlist :idproducto="slider.id" :logeado="logeado"></wishlist>
	                <div class="img-box">
	                	<a :href="'/detalle/'+slider.id">
	                  		<img :src="'uploads/'+slider.img" class="img-responsive img-fluid" alt="">                  
	              		</a>
	                </div>
	                <div class="thumb-content">
	                  <h4>{{slider.name}}</h4>                 
	                  <!-- <div class="star-rating">
	                    <ul class="list-inline">
	                    	<template v-for="star in slider.stars">
	                      <li class="list-inline-item" v-if="star==1"><i class="fa fa-star"></i></li>
	                      <li class="list-inline-item" v-else><i class="fa fa-star-o"></i></li>
	                    	</template>
	                    </ul>
	                  </div> -->
	                  <p class="item-price"> <!--<strike>${{slider.descuento}}</strike> --> <b>${{slider.precio}}</b></p>
										
	                <btn-addcarrito :logeado="logeado" :id="slider.id"></btn-addcarrito>
	     
	                </div>            
	              </div>
	            </div>
	          </div>
	    </v-carousel-slide>
	    </template>
	  </v-carousel>
	</b-col>
</template>
<script>
	export default {
		props:['promos','logeado'],
			
	}
</script>