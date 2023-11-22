<template>
	<b-col cols="11"  style="margin-bottom: 15px;">
		<b-card style="border-radius: 11px; border-left: 5px solid #ffce0e4d;">
			<b-row  style="padding-bottom: 15px;">
		    	<template v-if="status==1">
					<b-col  cols="12" lg="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="success">Por Entregar..</b-badge>
			  		</b-col>
			  		<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
			  				<div style="display: inline-grid;">	
			  		 	    <b-badge pill variant="warning" style="margin-bottom: 10px;">Pendiente</b-badge>
			  		 	    <b-button :href="'/detallecompra/'+id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>

		    	<template v-if="status==2">
					<b-col  cols="12" lg="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="info">Enviado</b-badge>
			  		</b-col>
			  		<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
			  				<div style="display: inline-grid;">	
			  		 	    <b-badge pill variant="primary" style="margin-bottom: 10px;">En camino..</b-badge>
			  		 	    <b-button :href="'/detallecompra/'+id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>

		    	<template v-if="status==3">
					<b-col  cols="12" lg="6" class="text-lg-left" >
			  		 	  <b-badge pill variant="success">Entregado</b-badge><span style="font-size: 18px;"> el {{getfecha()}}</span>
			  		</b-col>
			  		<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
			  				<div style="display: inline-grid;">	
			  		 	    <!-- <b-badge pill variant="warning" style="margin-bottom: 10px;">Pendiente</b-badge> -->
			  		 	    <b-button :href="'/detallecompra/'+id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>


	    		<template v-if="status==4">
					<b-col  cols="12" lg="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="danger">Cancelado</b-badge>
			  		</b-col>
			  		<b-col cols="12" lg="6" class="text-lg-right btn-v-c">
			  				<!-- <div style="display: inline-grid;">	 -->
			  		 	    <!-- <b-badge pill variant="warning" style="margin-bottom: 10px;">Pendiente</b-badge> -->

			  		 	    <b-button :href="'/detallecompra/'+id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
			  				<!-- </div> -->
			  		</b-col>
				</template>
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
    		
      }
    },

    mounted() {
    
    },
    created() {
        
    },
	methods: { 
      getfecha(){

        moment.locale('es');
        return  moment(this.fecha).format('dddd LL');
      },
	}
	}

</script>