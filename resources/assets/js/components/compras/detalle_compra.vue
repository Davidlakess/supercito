<template>
	<div>		
			<b-container   fluid>	
					<detalle-compra-web
					:items="detalle"
					:venta="venta"
				></detalle-compra-web>
			</b-container>
	</div>
</template>
<script>

  import detalle_compra from '../compras/items_comprados.vue'
   
  export default {
  	props:['detalle','venta'],
    components: {
       'detalle-compra-web':detalle_compra
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