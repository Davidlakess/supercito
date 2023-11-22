<template>
	<b-row align-h="center">
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
</template>
<script type="text/javascript">
	export default {
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
    
	}
	}

</script>