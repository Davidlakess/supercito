<template>
	<div>
		<template v-if="isMobil()">
			<compras-mobil :compras="compras" :domicilio="domicilio" ></compras-mobil>
		</template>
		<template v-else>
			
	<b-container  class="mc-content" fluid>
		<b-row align-h="center" style="margin-bottom: 15px;">
		  <b-col cols="11" >
				<div style="font-size: 27px;text-align: left;font-weight: 600;margin-bottom:25px; margin-top: 30px;">Compras</div>
			</b-col>
			<template v-for="compra in compras">
			<compras-items
				:id_venta="compra.id_venta"
				:status="compra.status"
				:fecha="compra.updated_at"
				:cantidadart="compra.cantidadart"
				:calle="domicilio.calle"
				:calle_1="domicilio.calle_1"
				:calle_2="domicilio.calle_2"
				:numero_i="domicilio.numero_i"
				:numero_e="domicilio.numero_e"
			>
			</compras-items>
		</template>
  
  		</b-row>
  	</b-container>
		</template>

	</div>
</template>
<script type="text/javascript">
  import comprasweb from '../compras/compras_items.vue'
  import comprasmobil from '../mobile/mis_compras_mobil.vue'
	export default {
		  components:{
		    'compras-items':comprasweb,
		    'compras-mobil':comprasmobil
		    },
		props:['compras','domicilio'],
		 data() {  	
      return {
    		
      }
    },

    mounted() {
    
    },
    created() {
        
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


 
