<template>
	<div>	
		<template v-if="isMobil()">	
			<detalle-compra-mobil
			:items="detalle"
			:venta="venta"
			>
			</detalle-compra-mobil>
		</template>
		<template v-else>	
			<b-container   fluid>	
					<detalle-compra-web
					:items="detalle"
					:venta="venta"
				></detalle-compra-web>
			</b-container>
		</template>
	</div>
</template>
<script>

  import detalle_compra from '../compras/items_comprados.vue'
  import detalle_compra_mobil from '../mobile/detalle_compra_mobil.vue'
   
  export default {
  	props:['detalle','venta'],
    components: {
       'detalle-compra-web':detalle_compra,
       'detalle-compra-mobil':detalle_compra_mobil
    }, 
    data() {
      return {

      	}
    },
    created(){
    },
    mounted(){
    	 
    },
    methods: {
    	isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }
    	
    }
}
</script>