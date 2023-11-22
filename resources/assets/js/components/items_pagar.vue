<template>
	<div>	
	<b-card style="margin-top: 25px;">
		<b-row  style="padding-bottom: 15px;">
		 	<b-col cols="12" lg="6" class="text-lg-left" >
		 		<span style="font-size: 18px;">Productos: </span>
		 	</b-col>
		 	<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
		 	  <span>$93 Envio</span>
		 	</b-col>
			<b-col cols="12" style="margin-bottom: 7px;">
		 	  <hr>
		 	</b-col>
			<template v-for="item in items">
				<item-pagar
				 :name="item.name"
				 :img="'/uploads/'+item.img"
				 :cantidad="item.cantidad"
				 :precio="item.precio"
				></item-pagar>
			</template>	
		</b-row>
	</b-card>
		<b-row style="margin-top: 20px;margin-top: 4% !important; display: none;" class="d-lg-block">
				<b-col cols="12" style="text-align: end;">
					<b-button variant="primary" size="lg" v-on:click.stop="hacer_pedido" >Continuar</b-button>		
				</b-col>
		</b-row>
	</div>
</template>
<script type="text/javascript">
	export default {

		props:['items'],
		methods: {
	    hacer_pedido(){
		  	eventBus.$emit('finpedido'); 
			},
		
	}
}
</script>