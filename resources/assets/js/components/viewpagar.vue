<template>
		<b-container v-if="isMobil">
		<ckeckoutmobil
		:adress="adress"
		:items="items"
		:precioenvio="envio" 
		:propina="propina"
		:idcarrito="idcarrito" 
		>
		</ckeckoutmobil>
	</b-container>
		<b-container v-else style="min-width: 100%;padding-left:3%;padding-right: 3%;cursor: auto !important; margin-bottom: 8%;" >
			<b-row align-h="center" >
				<b-col cols="12" lg="8" style="padding-top: 0%;" >
					<v-card>
						<v-card-title primary-title>
							<div style="  font-weight: 501;font-size: 18px; padding-left: 10px;margin-top: 15px;">Tipo de entrega... {{adress}}</div>
						</v-card-title>
						 <v-card-text>
      			<v-expansion-panel>


         			<v-radio-group v-model="radioentrega" @change="a()" :mandatory="false">
        			<v-expansion-panel-content
			          :key="i"
			          expand-icon="mdi-menu-down">
			          <template v-slot:header>
			            <v-radio class="pago" style="font-weight: bold; text-transform: uppercase;" :label="tiposentrega[0].name" :value="tiposentrega[0].id">
			            </v-radio>
			          </template>
			          	<div v-if ="adress != 0">
					         <div style="margin-bottom: 2%; font-size: 20px;margin-left: 25px;" cols="12">
											<span>Enviar a...</span>		
									</div>
									<div style="display: grid;text-transform: uppercase; font-size: 13px; margin-left: 30px; margin-bottom: 10px;">
			              <span><strong>Localidad: </strong> {{domicilio.name}} ,Michoacán</span>
			              <span><strong>Calle: </strong> {{domicilio.calle}}</span>
			              <span><strong>Numero Exterior: </strong> #{{domicilio.numero_e}}</span>
			              <span><strong>Numero Interior: </strong> #{{domicilio.numero_i}} </span>
			              <span><strong>Entre Calles: </strong> {{domicilio.calle_1}}</span>
			              <span><strong>Y:</strong> {{domicilio.calle_2}}</span>
			              <span><strong>Referencia: </strong> {{domicilio.referencia}}</span>
										</div>
     							</div>
     	     	<div v-else >
     	     		 <v-btn small color="primary" dark>Agrega una direccion</v-btn>
     	     	</div>
		        </v-expansion-panel-content>

		        	<v-expansion-panel-content
			          :key="i"
			          expand-icon="mdi-menu-down">
			          <template v-slot:header>
			            <v-radio class="pago" style="font-weight: bold; text-transform: uppercase;" :label="tiposentrega[1].name" :value="tiposentrega[1].id">
			            </v-radio>
			          </template>


			          	  <v-menu
					          v-model="menu"
					          :close-on-content-click="false"
					          full-width
					          style="margin-right: 10px;"
					        >
					          <template v-slot:activator="{ on }">
					            <v-text-field
					              :value="computedDateFormattedMomentjs()"
					              clearable
					              prepend-icon="event"
					              label="Fecha de entrega"
					              readonly
					              v-on="on"
					            ></v-text-field>
					          </template>
					          <v-date-picker

					            color="red lighten-1"
					            v-model="date"
					            :min="dateaux"
					            @change="menu = false"
					            locale="es"
					          ></v-date-picker>
					        </v-menu>
		        </v-expansion-panel-content>
		      </v-radio-group>
		    </v-expansion-panel>
		  </v-card-text>
		</v-card>
		<b-row align-h="center" >
			<items-pagar :items="items"></items-pagar>
				<div style="margin-bottom: 25px !important;margin-top: 4% !important; width: 100%;">
					  <v-btn block dark style="background-color: #000 !important;margin-bottom: 10px;"  @click="hacer_pedido()">Enviar</v-btn>
				</div>
		</b-row>
	</b-col>
				<!-- DIVICION  -->
		<b-col cols="12" lg="4">	
			<b-card no-body class="text-justify static" id="resumencontent" 
				  style="background-color: #f5f5f5;" > 
		<b-container style="margin-top: 20px; padding-top: 45px">
			<span style="margin-bottom: 20px; font-weight: 600;"> Resumen de compra</span>
		    	<hr>
			<b-row>
				<b-col cols="7" lg="6" class="mb-10">
			        	<span>Productos ({{countproductos}})</span>
						  </b-col>
						  <b-col cols="5 tl-end" lg="6">
						  	<span>$ {{formatPrice(totalproductos)}}</span>
						  </b-col>
						  <b-col cols="6" class="mb-10">
						  	<span>Envio</span>
						  </b-col>
						  <b-col cols="6 tl-end" >
						  	<span>$ {{formatPrice(auxenvio)}}</span>
						  </b-col>
						  <b-col cols="6" class="mb-10">
						  	<span>Propina</span>
						  </b-col>
						  <b-col cols="6 tl-end" >
						  	<span>$ {{formatPrice(propina)}} </span>
						  </b-col>
						  <b-col cols="6" class="mb-10 mt-22">
						  	<span>Total</span>
						  </b-col>
						  <b-col cols="6 tl-end mt-22" >
						  	<span>$ {{formatPrice(totalventa)}}</span>
						  </b-col>
						</b-row>
					</b-container>
				</b-card>      
				</b-col>
			</b-row>		
		</b-container>
</template>
<script>
export default {
	props:['idcarrito','envio','propina','items','adress'],
	computed:{
		isMobil(){
			return window.isMobil()
		}
	},
	mounted() {
    this.domicilio=this.adress
  },
	data() {
      return {
        domicilio:{},
      	productos:[],
        totalproductos:0,
        countproductos:0,
        totalventa:0,
        menu:false,
        spinner:true,
        radioentrega: 1,
        btn:false,
        auxenvio: 0,
        date: new Date().toISOString().substr(0, 10),
        dateaux: new Date().toISOString().substr(0, 10),
        tiposentrega: [
        {
          name: 'A Domicilio',
          id: 1
        },
        {
          name: 'Recoger en Tienda',
          id: 2
        }
      	]
      }
    },
    created(){
    	this.auxenvio = this.envio
    	this.getresumen();
    },
    methods: {
    	 a(){
    	 	if (this.radioentrega == 1) {
    	 			this.auxenvio = this.envio
    	 	}else {
    	 		this.auxenvio = 0
    	 	}
    	 	this.getresumen()
    	 },
    	 hacer_pedido(){
         console.log()
    	   swal.fire({
                title: '¡estas a punto de enviar tu pedido!',
                text: "",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hacer pedido',
                cancelButtonText: 'cancelar'
              }).then((result) => {

                if (result.value) {
                   // this.recogercambio();
                 	 this.enviar_pedido(0);
                 }else if(result.dismiss=='cancel') {   
                 }
          	})
	},enviar_pedido(cambio){

    	// eventBus.$emit('btn-disable'); 
    	let formd=new FormData;        
        formd.append('propina',this.propina);
        formd.append('id_localidad',this.adress.id_localidad);
        formd.append('id_domicilio',this.adress.id_domicilio);
        formd.append('id_carrito',this.idcarrito);
        formd.append('fecha_entrega',this.date);
              formd.append('tipo_entrega',this.radioentrega);

            axios.post(url+"pedido",formd).then((data) => {
              if(data.status== 200){
                   swal.fire(
                      '¡Pedido Enviado!',
                      'Te enviamos el detalle a tu correo ¡Gracias!',
                      'success'
                      ).then(() =>{ 
                          window.location.href=url+'miscompras'; 
                      })
              }else{
                swal.fire(
                  '¡Ooops!',
                  'Algo salio mal :(',
                  'error'
                )
              }              
            }).catch(error => {
                eventBus.$emit('btn-disable'); 
	                swal.fire(
	                  '¡hubo un error!',
	                  'Intenta mas tarde :(',
	                  'error'
	                )   
            });
       },
    	 getresumen(){
      	var size=this.items.length;
       	this.countproductos = size;
       	this.totalproductos = 0
       	for(var i=0;i<size;i++ ){
       		this.totalproductos+=parseFloat(this.items[i].precio)* parseFloat(this.items[i].cantidad);
    		}
	    	let aux = parseFloat(this.auxenvio) + parseFloat(this.propina);
	    	this.totalventa=parseFloat(aux) + parseFloat(this.totalproductos);
    	},
    	computedDateFormattedMomentjs () {
    	 	 window.moment.locale('es')      
    	 	 	return this.date ? window.moment(this.date).format('dddd, MMMM Do YYYY') : ''
    	},
    	formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      }
  }
}
</script>