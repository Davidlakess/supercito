<template>
	<b-row align-h="center">
	  <b-col cols="12" >
				<div style="font-size: 27px; text-align: left; margin-bottom: 20px;">Articulos Comprados</div>
		</b-col>
		<template v-for="item in items">
			<b-col cols="12" style="margin-top: 15px;">
				<items-detalle-compra
				:vendedor="item.name"
				:cantidad="item.cantidad"
				:descripcion="item.descripcion"
				:precio="item.precio"
				:img="item.img"
				></items-detalle-compra>
			</b-col>	
		</template>
	</b-row>
</template>
<script>
  export default {
  	props:['items'],
    data() {
      return {
      }
    },
    methods: {
    	
    }
  }
</script>