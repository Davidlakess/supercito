<template>
	<div>	
	<b-card no-body class="overflow-hidden" >
			<div style="padding: 15px;text-align: center;background-color: #ed4646;color: #fff;">
			   Opciones de envio a
			</div>
		<b-card-body>	
			   <b-container style="padding: 15px;">
      			<div style="font-weight: 600;font-size: 16px;">
              <span >Domicilio</span>
            </div>	
        			<div class="normal-direccion" style="margin-top: 10px;">
        				<span>
	                {{detalledomicilio()}}
	            	</span>
        			</div>  	
         	</b-container>
          	<b-container style="padding: 10px;">
	          <div style="padding: 15px;border-radius: 10px;border: 1px solid #e1dddd;">

	          	<div class="decorate-pro" v-for="item in items">
					<b-col cols="3"  sm="1" lg="1" style="padding: 0;">
						<figure class="card card-product"  style=" border: none;">
				      <div> 
				         <b-img  style="height: 65px;" :src="ruta + '/uploads/'+item.img"></b-img>
				      </div>
				    </figure>
					</b-col>
				  	<b-col style="margin:0;padding: 0;"  class="card-item"> 
				 		<div><span>{{item.name}}</span></div>
				 		<div><span>Cantidad: {{item.cantidad}}</span></div>
			 			<div><span>$ {{item.precio}} c/u</span></div>
				 	</b-col>
				</div>

			</div>
			</b-container>
   		</b-card-body>
	</b-card>
              <div  >
                 <div style="font-size: 15px;font-weight: 400;display: grid; margin-bottom: 5px;">
                 	<span>Subtotal Total: $ {{formatPrice(subtotal)}}</span>
                </div>
                <div style="font-size: 15px;font-weight: 400;display: grid; margin-bottom: 5px;">
                  <span>Costo de Envio: $ {{formatPrice(envio)}}</span>
                </div>
                <div style="font-size: 15px;font-weight: 400;display: grid; margin-bottom: 5px;">
                  <span>Propina: $ {{formatPrice(propina)}}</span>
                </div>
                <div style="font-size: 18px;font-weight: 600;display: grid; margin-bottom: 15px;">
                  <span>Total: $ {{formatPrice(totalventa)}}</span>
                </div>
                <div>
                	<b-button :disabled="spinner" @click="hacer_pedido()" variant="outline-primary btn-block">
                    <div v-if="!spinner">
                      Finalizar
                    </div>
                    <div v-else>
                    <b-spinner></b-spinner>
                    </div>
                </b-button>
                </div>
              </div>  

	</div>	

</template>
<script>	
// import $ from 'jquery';
export default {
    props:['precioenvio','adress','propina','items','idcarrito'],  
    data(){
      return {
      	domicilio_si:true,
      	direccion:{},
      	id_carrito:this.idcarrito,
      	id_localidad:0,
      	envio:0,
        ruta: url,
      	totalventa:0,
      	subtotal:0,
        spinner:false
      }
    },
    mounted() {
    	this.direccion=this.adress;
    	this.verificardomicilio();
    	this.envio=this.precioenvio;
    	this.getresumen();
    },
     created() {
      eventBus.$on('adddomicilio', (data) => {
        	this.domicilio_si=true;
        	this.direccion=data;
        	this.id_localidad=data.id_localidad;
      })
    	eventBus.$on('setenvio', (envio) => {    
          this.envio=envio; 
	    });
      },

    methods: {
       detalledomicilio(){
        var str='Calle: '+this.direccion.calle+' - numero-exterior: '+this.direccion.numero_e
        str+=(this.direccion.numero_i)?' - interior: '+this.direccion.numero_i:''
        str+=(this.direccion.calle_1)?' - entre '+this.direccion.calle_1:''
        str+=(this.direccion.calle_2)?' y '+this.direccion.calle_2:''
        str+=(this.direccion.telefono)?' telefono: '+this.direccion.telefono:''
        str+='-'+this.direccion.name+',Michoacán'

                return str;
       },
    	 getresumen(){
      		var size=this.items.length;
       		for(var i=0;i<size;i++ ){	
       			this.subtotal+=parseFloat(this.items[i].precio)* parseFloat(this.items[i].cantidad);
    		
    		}
	    	let aux= parseFloat(this.envio) + parseFloat(this.propina);
	    	this.totalventa=parseFloat(aux) + parseFloat(this.subtotal);
    	},
    	hacer_pedido(){
      if(this.domicilio_si){
        // alert('holi');
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
                   this.spinner=true;
                   this.enviar_pedido(0);
                 }else if(result.dismiss=='cancel') {
                   
                 
                 }
            })
          }else{

             swal.fire(
                '¡Agrega el Domicilio de Envio!',
                '',
                'info'
                )

          }
  },enviar_pedido(cambio){

    let formd=new FormData;
        formd.append('tip',this.propina);
        formd.append('id_carrito',this.id_carrito);
        // formd.append('exchange',cambio);
        
            axios.post(url+"orden.venta",formd).then((data) => {
              if(data.status== 200){
                   swal.fire(
                      '¡Pedido Enviado!',
                      '¡Gracias!',
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

                this.spinner=false;

              }

              
            }).catch(error => {
              this.spinner=false;
                 swal.fire(
                  '¡Error al Enviar!',
                  'Intenta nuevamente :(',
                  'error'
                  )   
            });
      },
      async recogercambio(){
        var total=parseFloat(this.totalventa);

          const {value: mont} = await swal.fire({
            title:'Calcular cambio ',
            input: 'number',
            inputAttributes: {
              min:total,
              max:total*2
          },
            target:'.mn',
            inputValue:'',
            inputPlaceholder: 'Pagas con ?',
            inputValidator: (value) => {
              
              value=parseFloat(value);
              
              if (total>=value) {

                return 'Introduce una catidad mayor a '+total
              
              }
            }
          });
          if (mont){    
            this.enviar_pedido(mont-total);
          }    
      
  },
    	formatPrice(value) {
              let val = (value/1).toFixed(2).replace(',', '.')
              return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      },
		
	}

}
</script>
