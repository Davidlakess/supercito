<template>
		<b-container v-if="isMobil">
		<ckeckoutmobil
		:adress="adres"
		:items="items"
		:precioenvio="envio" 
		:propina="propina"
		:idcarrito="idcarrito" 
		>
		</ckeckoutmobil>
	</b-container>
		<b-container v-else style="min-width: 100%;padding-left:3%;padding-right: 3%;cursor: auto !important;" >
			<b-row align-h="center" >
				<b-col cols="12" lg="8" style="padding-top: 0%;" >
			<content-domicilio :adres="adress" ></content-domicilio >
					<b-row align-h="center" >
						<items-pagar :items="items"></items-pagar>
					</b-row>
				</b-col>
				<!-- DIVICION  -->
				<b-col cols="12" lg="4">	
						  <resumen-compra 
						  :idcarrito="id_carrito" 
						  :precioenvio="envio" 
						  :propina="propina" 
						  :items="items">
						  </resumen-compra>        
				</b-col>
			</b-row>		
		</b-container>
</template>
<script>
export default {
	props:['idcarrito','envio','propina','items','adres'],
	computed:{
		isMobil(){
			return window.isMobil()
		}
	}
}
</script>