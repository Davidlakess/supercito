<template>
  <div style="margin: 10px;">
      <b-row  style="padding-bottom: 15px;">
  		 	<b-col cols="12" lg="6" class="text-lg-left" >
            <b-badge v-if="statuspro==0" pill variant="warning" class="f14">Pendiente</b-badge>
  		 	    <b-badge v-if="statuspro==1" pill variant="success" class="f14">Entregado</b-badge>
            <b-badge v-if="statuspro==2" pill variant="danger"  class="f14">No Enviado</b-badge>
  		 	</b-col>

  		 	<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
  		 	   <b-button v-if="statuspro==1" variant="outline-primary" :href="ruta+'item/'+id+'-'+descripcion">
            Volver a Comprar
          </b-button>
  		 	</b-col>
  		 </b-row>

  		 <b-row align-h="justify">
				<b-col cols="12" lg="2">
  		 	   <img width="90" height="90" :src="ruta+'/uploads/'+img" alt="">
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
  		 			<b-col cols="12" >{{telefono}}</b-col>
  		 	</div>
       </b-col>
  		</b-row>
  </div>
</template>	
<script>
export default {
      
  	props:[
    'vendedor',
    'cantidad',
    'descripcion',
    'precio',
    'img',
    'telefono',
    'statuspro',
    'id'
    ],
    data() {
      return {
        ruta:url
      }
    },
    methods: {
      
    	
    }
  }
</script>
<style type="text/css">
  .f14{
  font-size: 14px;
  }
  .cancel{
    background-color: red;
color: white;
padding: 10px;
border-radius: 37px;
font-weight: bold;
  }
  .divcancel{
    margin-bottom: 12px;
margin-top: 12px;
text-align: center;
  }
</style>