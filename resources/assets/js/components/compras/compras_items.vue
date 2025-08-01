<template>
	<b-col cols="11"  style="margin-bottom: 5%;">
		<b-card style="border-radius: 11px; border-left: 5px solid #ffce0e4d;">
			<b-row  style="padding-bottom: 15px;">
		    
					<b-col  cols="12" lg="6" class="text-lg-left" >
			  		 	<v-chip  :color="get_variante(status)" text-color="white">{{get_Estatus(status)}}</v-chip>
			  		</b-col>
			  		<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
			  				<div style="display: inline-grid;">	
			  		 	    <v-chip  :color="get_variante(status)" text-color="white">{{get_Estatus(status)}}</v-chip>
			  		 	    <b-button :href="ruta+'detallecompra/'+id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
		  	</b-row>
			<b-row align-h="justify">
			 	<b-col cols="12" lg="2">
	          <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:30px;"></i>
			 	</b-col>
				<b-col cols="12" lg="5">
				 		<div style=" height: 100%;display: inline-grid;text-align: center;">
				 			<b-col cols="12"><strong> Cantidad de Articulos</strong></b-col>
				 			<b-col cols="12">#{{cantidadart}}</b-col>
				 		</div> 
				</b-col>
				<b-col cols="12" lg="5">
				 	<div style=" height: 100%;display: inline-grid; text-align: center;">
				 			<b-col cols="12"><strong>Domicilio</strong></b-col>
				 			<b-col cols="12">{{calle}}  #{{numero_e}} - #{{numero_i}}</b-col>
			 			<b-col cols="12">{{calle_1}} - {{calle_2}}</b-col>
			 	 </div>
			</b-col>
		</b-row>
	</b-card>
</b-col>
</template>
<script type="text/javascript">
	export default {
		props:['id_venta',
		'status',
		'cantidadart',
		'calle','calle_1',
		'calle_2',
		'numero_i',
		'numero_e',
		'fecha'],

		 data() {  	
      return {
    		ruta:url
      }
    },

    mounted() {
    
    },
    created() {
        
    },
	methods: { 
		get_variante(estatus){
      switch (estatus) {
        case 1:
          return "warning"
          break;
        case 2:
          return "blue"
          break;
        
        case 3:
          return "green"
          break;
        case 4:
          return "red"
          break;
      }
    },
    get_Estatus(estatus){
      switch (estatus) {
        case 1:
          return "Pendiente"
          break;
        case 2:
          return "Enviado"
          break;
        
        case 3:
          return "Entregado"
          break;
        case 4:
          return "Cancelado"
          break;             
      }
    },
    getfecha(){

        moment.locale('es');
        return  moment(this.fecha).format('dddd LL');
      },
	}
	}

</script>