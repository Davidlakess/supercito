<template>	
	<b-row align-h="center">

		<div class="super-titulo"><span>Productos que te Pueden Interesar</span></div>
		<v-carousel  class ="carousel-pro" :interval="6000"  light hide-delimiters Default style="box-shadow: none;">
			  <template v-for="(item,indx) in  prodm"> 
      <v-carousel-item :key="indx">
        <v-container fluid grid-list-sm>
          <v-layout>
          	<template v-for="(slider,key) in item">
          	<v-flex xs3 md3 :key="key">
            	<v-card height="auto" style=" margin: 9px; box-shadow: none;"> 
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
	
		<div class="super-titulo"><span>Otros Productos</span></div>
		<v-carousel  class ="carousel-pro" :interval="6001"  light hide-delimiters Default style="box-shadow: none;">
			  <template v-for="(item,indx) in prodo"> 
      <v-carousel-item :key="indx">
        <v-container fluid grid-list-sm>
          <v-layout>
          	<template v-for="(slider,key) in item">
          	<v-flex xs3 md3 :key="key">
            	<v-card height="auto" style="margin: 9px; box-shadow: none;"> 
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