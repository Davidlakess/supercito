<template>
	<b-row align-h="center" >  
		<b-col cols="12">				
			<b-col style="margin-bottom: 2%; font-size: 25px;" cols="12">
				<span>Opciones de envío a </span>		
			</b-col>
			<b-card no-body >
				<b-row align-h="center" style="padding: 20px;background-color: #f5f5f5;">
				 	<b-col lg="1" sm="1" cols="2" rounded="circle" class="white">
				  	<span style="color:#3483fa;"><i class="fa fa-map-marker"></i></span>
			  	</b-col>
					<b-col lg="7" cols="12" style="display: grid;text-transform: uppercase; font-size: 13px;">
             
              <span><strong>Localidad: </strong> {{domicilio.name}} ,Michoacán</span>
              <span><strong>Calle: </strong> {{domicilio.calle}}</span>
              <span><strong>Numero Exterior: </strong> #{{domicilio.numero_e}}</span>
              <span><strong>Numero Interior: </strong> #{{domicilio.numero_i}} </span>
              <span><strong>Entre Calles: </strong> {{domicilio.calle_1}}</span>
              <span><strong>Y:</strong> {{domicilio.calle_2}}</span>
              <span><strong>Referencia: </strong> {{domicilio.referencia}}</span>
         
			  	</b-col>
			  	<!-- <b-col lg="4" cols="12">
				  <b-button variant="link" class="m-1">Editar o Elegir otro</b-button>
			  	</b-col> -->
			  </b-row>
			</b-card>
		</b-col> 
	</b-row>
</template>
<script type="text/javascript">
	export default {
		props:['adress'],
		 data() {  	
      return {
    		domicilio:{}
      }
    },
    mounted() {
    	this.domicilio=this.adress
    },
		methods: {
			detalledomicilio(){
	        var str='Calle: '+this.direccion.calle+' - numero-exterior: '+this.direccion.numero_e
	        str+=(this.direccion.numero_i)?' - interior: '+this.direccion.numero_i:''
	        str+=(this.direccion.calle_1)?' - entre '+this.direccion.calle_1:''
	        str+=(this.direccion.calle_2)?' y '+this.direccion.calle_2:''
	        str+=(this.direccion.telefono)?' telefono: '+this.direccion.telefono:''
	        str+=' - '+this.direccion.name+', Michoacán'
                return str;
      }
		}
	}

</script>