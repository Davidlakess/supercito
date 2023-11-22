<template>
	<b-col md="12" v-if="items.length!=0" style="margin-top: 15px;">
		<div class="super-titulo"><span>Productos nuevos en MyNegocioLocal..</span></div>
		  <v-carousel>
		    <template v-for="(item,indx) in items">  
		    <v-carousel-slide :index="indx">
	          <div class="row">
	            <div class="col-sm-3"  v-for="slider in item">
	              <producto-carousel
	              :idproducto="slider.id_producto"
	              :img="slider.img"
	              :name="slider.name"
	              :precio="slider.precio"
	              >
	              </producto-carousel>
	            </div>
	          </div>
	    </v-carousel-slide>
	    </template>
	  </v-carousel>
	</b-col>
</template>
<script>
	export default {
		props:['items'],
			data(){
			return {
				// pro:[],
				mdruta:"/middlecarrito"
			}
		},
		methods:{
			addcarrito(id){

				eventBus.$emit('addcarrito',id); 
			}
		}
	}
</script>
