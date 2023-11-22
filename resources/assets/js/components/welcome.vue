<template>

	<div v-if="isMobil()" >
		<welcome-mobil
			:productos="productos"
			:productosnuevos="productosnuevos"
			:historial="historial"
			:logeado="logeado"
		>
		</welcome-mobil>
	</div>
	<div v-else>
		<welcome-web 
			:productos="productos"
			:productosnuevos="chunk(productosnuevos,4)"
			:categorias="chunk(categorias,12)"
			:collection="collection"
			:historial="chunk(historial,4)"
			:logeado="logeado"
		></welcome-web>
	</div>
</template>
<script>
	
	import welcome_web  from '../components/welcome/welcome_web.vue'
 	import welcome_mobil  from '../components/mobile/welcome_mobil.vue'
	
	export default {
	props:['productos','productosnuevos','categorias','collection','historial','logeado'],
	data(){
			return {
				pro:[],
				mdruta:"/middlecarrito",
				// ismobil:false,
			}
		},	
		methods:{
		chunk(array,chunkSize){
        var R = [];
        for (var i = 0; i < array.length; i += chunkSize)
          R.push(array.slice(i, i + chunkSize));
        return R;
		},
		productoschunk(){

							

		},
		categoriaschunk(size){
			return this.categorias.chunk(size);
		},
		productosnuevoschunk(size){
			return this.productosnuevos.chunk(size);
		},
		isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
    	} 
	},
	
	components: {
		'welcome-web':welcome_web,
		'welcome-mobil':welcome_mobil
	}
}
</script>

<!-- // items:[
				
				// 		{
				// 			wishlist:false,
				// 			img:'examples/images/products/ipad.jpg',
				// 			name:'Apple iPad',
				// 			stars:[1,1,1,1,0],
				// 			precio:13,
				// 			descuento:15,
				// 		},
				// 		{
				// 			wishlist:false,
				// 			img:'examples/images/products/headphone.jpg',
				// 			name:'Apple iPad',
				// 			stars:[1,1,1,1,0],
				// 			precio:13,
				// 			descuento:15,
				// 		},
				// 		{
				// 			wishlist:false,
				// 			img:'examples/images/products/macbook-air.jpg',
				// 			name:'Apple iPad',
				// 			stars:[1,1,1,1,0],
				// 			precio:13,
				// 			descuento:15,
				// 		},
				// 		{
				// 			wishlist:false,
				// 			img:'examples/images/products/nikon.jpg',
				// 			name:'Apple iPad',
				// 			stars:[1,1,1,1,0],
				// 			precio:13,
				// 			descuento:15,
				// 		}
					

				
				// 	{
				// 		wishlist:false,
				// 		img:'examples/images/products/play-station.jpg',
				// 		name:'Apple iPad',
				// 		stars:[1,1,1,1,0],
				// 		precio:13,
				// 		descuento:15,
				// 	},
				// 	{
				// 		wishlist:false,
				// 		img:'examples/images/products/macbook-pro.jpg',
				// 		name:'Apple iPad',
				// 		stars:[1,1,1,1,0],
				// 		precio:13,
				// 		descuento:15,
				// 	},
				// 	{
				// 		wishlist:false,
				// 		img:'examples/images/products/speaker.jpg',
				// 		name:'Apple iPad',
				// 		stars:[1,1,1,1,0],
				// 		precio:13,
				// 		descuento:15,
				// 	},
				// 	{
				// 		wishlist:false,
				// 		img:'examples/images/products/galaxy.jpg',
				// 		name:'Apple iPad',
				// 		stars:[1,1,1,1,0],
				// 		precio:13,
				// 		descuento:15,
				// 	}

				// ]--> 



