<template>	
		<b-card>
			<div style="text-align: center;font-size: 23px;font-weight: 600;margin-bottom: 20px;">Mis compras</div>
		<b-row>
			<template  v-for="compra in compras">
		  <b-col cols="12" style="margin-bottom: 20px; border-top: 1px solid rgba(0, 0, 0, 0.21);padding: 10px;">
			  <b-col cols="12">
				<b-row>
				  <template v-if="compra.status==1">
					<b-col  cols="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="info">Por Entregar..</b-badge>
			  		</b-col>
			  		<b-col cols="6" style="text-align: end;">
			  			<div style="display: inline-grid;">	
			  		 	    <!-- <b-badge pill variant="warning" style="margin-bottom: 10px;">Pendiente</b-badge> -->
			  		 	    <b-button size="sm" :href="ruta + 'detallecompra/'+compra.id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>

		    	<template v-if="compra.status==2">
					<b-col  cols="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="info">Enviado</b-badge>
			  		</b-col>
			  		<b-col cols="6"  style="text-align: end;">
			  				<div style="display: inline-grid;">	
			  		 	    <b-badge pill variant="primary" style="margin-bottom: 10px;">En camino..</b-badge>
			  		 	    <b-button size="sm" style="text-align: end;"  :href="ruta + 'detallecompra/'+compra.id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>

		    	<template v-if="compra.status==3">
					<b-col  cols="12" class="text-center" 
					style="font-size: 15px; font-weight: 600; margin-bottom: 5px;" >
			  		 	 <span >{{getfecha(compra.updated_at)}}</span>
			  		</b-col>
					<b-col  cols="6" class="text-lg-left" >
			  		 	  <b-badge pill variant="success">Entregado</b-badge>
			  		</b-col>
			  		<b-col cols="6" style="text-align: end;">
			  				<div style="display: inline-grid;">	
			  		 	
			  		 	    <b-button size="sm" style="text-align: end;" :href="'detallecompra/'+compra.id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
		  				</div>
		  		</b-col>
				</template>


	    		<template v-if="compra.status==4">
					<b-col  cols="6" class="text-lg-left" >
			  		 	    <b-badge pill variant="danger">Cancelado</b-badge>
			  		</b-col>
			  		<b-col cols="6" style="text-align: end;" >
			  		 	    <b-button size="sm" style="text-align: end;"  :href="ruta + 'detallecompra/'+compra.id_venta" variant="outline-primary" >
				            	Ver Detalle
				          	</b-button>
			  		</b-col>
				</template>

				</b-row>
			  </b-col>
			  <b-col cols="12" class="text-center">
			  		<i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:30px;"></i>
			  </b-col>
			  <b-col cols="12" class="text-center" style="display: flex;flex-direction: column;">
			  	<span>Cantidad de Articulos</span>
			  	<span style="font-size: 18px;font-weight: 600;">#{{compra.cantidadart}}</span>
			  </b-col>
			  <b-col cols="12" class="text-center" style="display: flex;flex-direction: column;">
			  	<span style="font-weight: 600;">Domicilio:</span>
			  	<span>{{domicilio.calle}} - ext #{{domicilio.numero_e}} - in #{{domicilio.numero_i}}</span>
			  	<span style="font-weight: 600;" >Entre calles</span>
			  	<span>{{domicilio.calle_1}} - {{domicilio.calle_2}}</span>
			  </b-col>
		  </b-col>
			</template>
		</b-row>
		
		</b-card>		
</template>

<script type="text/javascript">
	export default {    
	props:['compras','domicilio'],
	data(){
			return {
			ruta: url
			}
		},
		created() {
			
		},
		mounted (){
			// console.log(this.compras)

		},	
	methods:{
	 getfecha(fecha){

        moment.locale('es');
        return  moment(fecha).format('dddd LL');
      },
	}
}
</script>