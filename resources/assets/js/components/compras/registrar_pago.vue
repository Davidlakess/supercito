<template>
	<b-row  v-if="status != 1">
	  	<b-col cols="10" style="font-size: 27px;text-align: left;font-weight: 600;margin-bottom:5px; margin-top: 30px;">
				<div style="font-size: 27px; text-align: left;">Detallado de Pedido</div>
		</b-col>
		<b-col cols="10" style="margin-top: 15px;">
			<b-card style="margin-bottom: 25px;">
				<b-col cols="12" style="margin-top: 10px;">
					<div>
			      		<span>Fecha de pedido:</span> 
			      		<span style="font-weight: bold;">{{getfecha(venta.fecha)}}</span>
			      	</div>
			  		<time-line :mobil="false" v-if="status!=4" :status="venta.status_entrega" ></time-line>
			        <div class="divcancel" v-if="status==4"><span class="cancel">Pedido Cancelado</span></div>
			        <!-- <div style="text-align: end;margin: 10px;">
			          <b-button v-if="status==1" @click="cancelar_pedido()" variant="outline-danger">
			             Cancelar Pedido
			          </b-button>  
			        </div> -->
			    </b-col>
				<template v-for="item in items">
					<b-col cols="12" style="margin: 10px;
border-top: 2px solid #eeee;">
						<items-detalle-compra
						:vendedor="item.name"
						:cantidad="item.cantidad"
						:descripcion="item.descripcion"
						:precio="item.precio"
						:img="item.img"
						:telefono="item.telefono"
						:statuspro="item.status"
						:id="item.ids"
						></items-detalle-compra>
					</b-col>	
				</template>
				<b-col cols="12" class="detalle-info" style="margin-top: 18px;border-top: 2px solid #eeee; ">
				<span>subtotal:</span>
				<span>${{formatPrice(detalle.subtotal)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-info">
				<span>propina:</span>
				<span>$ {{formatPrice(detalle.propina)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-info">
				<span>envio:</span>
				<span>$ {{formatPrice(detalle.envio)}}</span>
				</b-col>
				<b-col cols="12" class="detalle-total">
				<span>Total:</span>
				<span>$ {{formatPrice(detalle.total)}}</span>
				</b-col>
			</b-card>
		</b-col>
	</b-row>
	<b-row v-else  style="margin-bottom:10%; margin-top: 10px;">
		<div style="text-align: center;">
			<v-icon style="color: green;font-size: 80px;">check_circle</v-icon>
					<div>
			      		<span>Fecha de pedido:</span> 
			      		<span style="font-weight: bold;">{{getfecha()}}</span>
			      	</div>
			<div style="font-size: 20px;margin-bottom: 10px; margin-top: 10px;">
				<b-alert show variant="info">
				 		Autorizar tu pedido.  
        </b-alert>
        <b-alert show variant="danger">
          Tienes 24hrs para realizar tu pago provicional
        </b-alert>

			</div>
				
				    <b-table
				      :items="info"
				      thead-tr-class="d-none"
				      :striped="true"
				      :bordered="true"
				      :fields="fields"
				    ></b-table>
		
		<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <template v-slot:activator="{ on }">
        <v-btn dark block style="background-color: #000 !important;" v-on="on">Registrar Pago</v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Registrar Pago</span></v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md4>
                <v-text-field
                  label="monto"
                  hint=""
                  persistent-hint
                  required
                ></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field label="Fecha" required></v-text-field>
              </v-flex>
              <v-flex xs12>
                <v-text-field label="imagen" type="password" required></v-text-field>
              </v-flex>
             
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
          <v-btn color="blue darken-1" flat @click="dialog = false">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-layout>
  </div>
	</b-row>
</template>
<script>

  import timeline from '../generico/timeline.vue'
  import detalle_compra from '../compras/item_detalle_compra.vue'
  export default {
  	
    components: {
       'time-line':timeline,
       'items-detalle-compra':detalle_compra
    }, 
  	props:['items','venta'],
    data() {
      return {
      	status:1,
      	dialog:false,
      	fields: ['clave', 'valor'],
      	info:[
      		{
	      		clave: 'Banco',
	      		valor: 'Azteca'
      		},
      		{
	      		clave: 'Cuenta',
	      		valor: '123443'
      		},
      		{
	      		clave: 'clave interbancaria',
	      		valor: '98328382382839238'
      		},
      		{
	      		clave: 'Beneficiario',
	      		valor: 'Alejandro David Gaytan Sanchez'
      		},
      		{
	      		clave: 'Monto',
	      		valor: '$50.00'
      		},
      		{
	      		clave: 'Concepto',
	      		valor: 'v1909090'
      		},

      	],
      	detalle:{
      	   envio:0,
           propina:0,
           subtotal:0,
           total:0
      	}
      }
    },
    created(){

    	this.status=this.venta.statusventa;
    	console.log(this.ventas)
    },
    mounted(){
    	this.$nextTick(() => {
      		this.sumarproductos();
    	});
    },
    methods: {
    	sumarproductos(){
          const propina = this.venta.propina;
          const envio =this.venta.envio;
          var subto=0;
          for(var i=0;i<this.items.length;i++){
            subto+=this.items[i].precio*this.items[i].cantidad;
          }
          var total = subto;
          total+= parseInt(envio) + parseInt(propina);        
           this.detalle.envio=envio;
           this.detalle.propina=propina;
           this.detalle.subtotal=subto;
           this.detalle.total= total;
    	},
    	cancelar_pedido(){


        swal.fire({
                title: '¡tu pedido casi esta listo!',
                text: "¿Quieres cancelarlo ? :( ",
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'continuar',
                cancelButtonText: 'cancelar pedido'
              }).then((result) => {

                if (result.value) {

                     swal.fire(
                        '¡Tu pedido estara pronto contigo!',
                        ':)',
                        'success'
                        )
                 }else if(result.dismiss=='cancel') {
                      
                     swal.fire(
                        '¡Pedido cancelado!',
                        ':(',
                        'error'
                        )
                     // .then(() =>{ 
                     //      window.location.href=url+'miscompras'; 
                     //  });

                 }
            })
        
      },
      getfecha(fecha){

        moment.locale('es');
        return  moment(fecha).format('dddd LL');
      },
      formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
  }
}
</script>

<style type="text/css">
	.detalle-info{
		text-align: end;
		font-size: 30px;
		font-weight: 300;
		text-transform: capitalize;
	}
	.detalle-total{
		text-align: end;
		font-size: 30px;
		text-transform: capitalize;
		font-weight: 600;
	}

#tableinfo thead {
  float: left;   
}

#tableinfo thead th {
  display: block;   
}

#tableinfo tbody {
  float: right;   
}
</style>