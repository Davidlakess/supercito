<template>	
	<b-row align-h="center">

	 	<b-col md="12">
			<div class="super-titulo"><span>Productos que te Pueden Interesar</span></div>
			   <v-carousel>
			    <template v-for="(item,indx) in prodm">  
			    <v-carousel-slide :index="indx">
		          <div class="row">
		            <div class="col-sm-3"  v-for="slider in item">
		                   <producto-carousel
	              :idproducto="slider.id_producto"
	              :img="slider.img"
	              :name="slider.name"
	              :precio="slider.precio"
	              :logeado="false"
	              >
	              </producto-carousel>
		            </div>
		          </div>
		    </v-carousel-slide>
		    </template>
		  </v-carousel>
		</b-col>


		<b-col md="12">
			<div class="super-titulo"><span>Otros Productos</span></div>
			  <v-carousel>
			    <template v-for="(item,indx) in prodo">  
			    <v-carousel-slide :index="indx">
		          <div class="row">
		            <div class="col-sm-3"  v-for="slider in item">
		                   <producto-carousel
	              :idproducto="slider.id_producto"
	              :img="slider.img"
	              :name="slider.name"
	              :precio="slider.precio"
	              :logeado="false"
	              >
	              </producto-carousel>
		            </div>
		          </div>
		    </v-carousel-slide>
		    </template>
		  </v-carousel>
		</b-col>
</b-row>
</template>
<script type="text/javascript">
export default {
	props:['prodm','prodo','logeado'],
		data(){
			return {
				pro:[],
				mdruta:"/middlecarrito"
			}
		},
	methods:{
		 
	}
}
</script>