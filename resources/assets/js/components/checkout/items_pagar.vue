<template>
	<div style="width: 100%;">	
	<b-card style="margin-top: 25px;">
		<b-row  style="padding-bottom: 15px;">
		 	<b-col cols="12" lg="6" class="text-lg-left" >
		 		<span style="font-size: 18px;">Productos: </span>
		 	</b-col>
		 	<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
		 	  <!-- <span>$93 Envio</span> -->
		 	</b-col>
			<b-col cols="12" style="margin-bottom: 7px;">
		 	  <hr>
		 	</b-col>
		 	<!-- VERIFICAR QUE HAY STOCK UN QUE ESTE EN EL CARRITO -->
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
		<b-row style="margin-bottom: 25px !important;margin-top: 4% !important; display: none;" class="d-lg-block">
				<b-col cols="12" style="text-align: end;">
					<b-button variant="primary" :disabled="btn" size="lg" v-on:click.stop="hacer_pedido" >
						<div v-if="!btn">
						Finalizar
						</div>
						<div v-else>
	        				<b-spinner></b-spinner>
	      				</div>
					</b-button>		
				</b-col>
		</b-row>
	</div>
</template>
<script type="text/javascript">
	export default {

		props:['items'],
		data(){
			return{
				btn:false
			}
		},
		created() {

         eventBus.$on('btn-disable', () => {
           this.btn=!this.btn;
        });
    },
		methods: {
	    hacer_pedido(){
		  	eventBus.$emit('finpedido'); 
			},
		}
}
</script>