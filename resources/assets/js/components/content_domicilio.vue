<template>
	<b-row align-h="center" >
  	<b-col style="margin-bottom: 2%; font-size: 25px;" cols="11" v-if="domicilio_si">
				<b-button v-b-toggle.collapse-2 variant="link" class="m-1">Agregar un domicilio</b-button>
      	<b-collapse id="collapse-2">
        <b-card no-body>
          <viewpagar></viewpagar> 
        </b-card>
     		</b-collapse>
		</b-col>

		<b-col cols="12" v-else >				
			<b-col style="margin-bottom: 2%; font-size: 25px;" cols="12">
				<span>Opciones de envío a </span>		
			</b-col>
			<b-card no-body >
				<b-row align-h="center" style="padding: 20px;background-color: #f5f5f5;">
				 	<b-col lg="1" sm="1" cols="2" rounded="circle" class="white">
				  	<span style="color:#3483fa;"><i class="fa fa-map-marker"></i></span>
			  	</b-col>
					<b-col lg="7" cols="12" style="font-weight: 100; font-size: 14px;">
				  	<span>{{direccion.calle}} - {{direccion.numero_e}} - {{direccion.numero_i}} - {{direccion.calle_1}} - {{direccion.calle_2}} - Alvaro Obregón,
				  	 Michoacán - {{direccion.telefono}} </span>
			  	</b-col>
			  	<b-col lg="4" cols="12">
				  <b-button variant="link" class="m-1">Editar o Elegir otro</b-button>
			  	</b-col>
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
    		domicilio_si:false,
    		direccion:{}
      }
    },

    mounted() {
    	this.direccion=this.adress;
    	this.verificardomicilio();
    },
    created() {
        eventBus.$on('adddomicilio', (data) => {
        	this.domicilio_si=false;
        	this.direccion=data;
      	})
      },
		methods: {
	    verificardomicilio() {
	      if(this.adress=='0'){
	      	this.domicilio_si=true;
	      }
		},
	}
	}

</script>