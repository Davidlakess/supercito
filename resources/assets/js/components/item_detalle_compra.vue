<template>
		<b-card>
  		<b-row  style="padding-bottom: 15px;">
  		 	<b-col cols="12" lg="6" class="text-lg-left" >
  		 	    <b-badge pill variant="success" style="font-size: 14px;">Entregado</b-badge>
  		 	</b-col>
  		 	<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
  		 	   <b-button variant="outline-primary" >
            Volver a Comprar
          </b-button>
  		 	</b-col>
  		 </b-row>
  		 <b-row align-h="justify">
				<b-col cols="12" lg="2">
  		 	   <img width="90" height="90" :src="'/uploads/'+img" alt="">
  		 </b-col>
  		 <b-col cols="12" lg="5">
  		 		<div style=" height: 100%;display: inline-grid;">
  		 			<b-col cols="12">{{descripcion}}</b-col>
  		 			<b-col cols="12">		Cantidad: #{{cantidad}}</b-col>
  		 			<b-col cols="12">		$ {{precio}} x 1 unidad</b-col>
  		 			<!-- <b-col cols="12"> Color NEGROS, Voltaje 110 </b-col> -->
  		 		</div>
  		 </b-col>
  		 <b-col cols="12" lg="5">
  		 	<div style=" height: 100%;display: inline-grid;">
  		 			<b-col cols="12"><strong>Vendedor</strong></b-col>
  		 			<b-col cols="12">{{vendedor}}</b-col>
  		 			<b-col cols="12">55 47651618</b-col>
  		 		</div>
  		 </b-col>
  		</b-row>
  	</b-card>
</template>	
<script>
export default {
  	props:['vendedor','cantidad','descripcion','precio','img'],
    data() {
      return {
      }
    },
    methods: {
    	
    }
  }
</script>