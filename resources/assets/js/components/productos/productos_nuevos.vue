<template>
	<div v-if="items.length!=0" style="margin-top: 15px; width: 100%;">
		<div class="super-titulo"><span>Productos nuevos en Supercito...</span></div>
		<v-carousel  :cycle="false" class ="carousel-pro" :interval="6000"  light hide-delimiters Default style="box-shadow: none;">
		<template v-for="(item,indx) in items"> 
	      <v-carousel-item :key="indx">
	        <v-container fluid grid-list-sm>
	          <v-layout>
	          	<template v-for="(slider,key) in item">
	          	<v-flex xs3 md3 :key="key">
	            	<v-card height="auto" style="padding: 10px; margin: 9px; box-shadow: none;"> 
	         		    <producto-carousel
		              :idproducto="slider.id_producto"
		              :img="slider.img"
		              :name="slider.name"
		              :precio="slider.precio"
		              :logeado="logeado"
		              >
		              </producto-carousel>
	            	</v-card>
	        		</v-flex>
	          	</template>
	      		</v-layout>
	    		</v-container>
	      </v-carousel-item>
    	</template>
    </v-carousel>
	</div>
</template>
<script>
	export default {
		props:['items','logeado']
	}
</script>
